<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/EventRepository.class.php';
require_once 'Database/FacilityEventRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';
require_once 'Views/JsonView.class.php';

class BackofficeEventsController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $event_repository;
    protected $facility_event_repository;
    protected $facility_hotel_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->event_repository = new EventRepository();
        $this->facility_event_repository = new FacilityEventRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['events'])) {
            return new Html404();
        } else {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);
            $language = $languages->get($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_eventi') . ' | ' . $translations->get('nome_sito');

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $rows = $this->event_repository->get_all_events();
            $events = Event::events($rows);

            $rows = $user->id > 2 ? $this->facility_hotel_repository->get_facilities_by_hotel($user->id) : array();
            $facilities_hotel = FacilityHotel::facilities_hotels($rows);
            $facilities = array_map(function($fh) { return $fh->id_struttura; }, $facilities_hotel);

            $view_model = new BackOfficeViewModel('backoffice.events.list', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->events = $events;
            $view_model->language = $language;
            $view_model->facilities = $facilities;
            $view_model->menu_active_btn = 'events';

            return new HtmlView($view_model);
        }
    }

    public function http_post(array &$params): IView
    {
        if (!isset($params['events']))
        {
            return new Html404();
        }
        else
        {
            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice/events');
            }

            $languages = new Languages($this->language_repository->list_all());

            $event_fields = array
            (
                'img_evento',
                'nome_evento',
                'data_inizio_evento',
                'data_fine_evento',
                'ora_inizio_evento',
                'ora_fine_evento',
                'recupera_struttura'
            );
            if (!isset($params['recupera_struttura']))
            {
                $event_fields_main = array
                (
                    'nome_struttura',
                    'email',
                    'sito_web',
                    'telefono',
                    'indirizzo',
                    'latitudine',
                    'longitudine'
                );
                $event_fields = array_merge($event_fields, $event_fields_main);
            }

            $id_evento = intval($params['events']);
            $event = $this->event_repository->get_by_id($id_evento);
            $created_by = intval($event['created_by']);

            if ($created_by == 0 && $user->level <= 2)
            {
                // rimuovo tutti i dati legati all'evento
                $this->facility_event_repository->remove_by_event_id($id_evento);
            }
            else if ($created_by == $user->id)
            {
                // rimuovo i dati di (evento, hotel)
                $this->facility_event_repository->remove_by_event_id_and_hotel_id($id_evento, $user->id);
            }
            else
            {
                // modifico solo la convenzione, per ciascuna lingua
                $facility_events = $this->facility_event_repository->get_by_event_id_and_hotel_id($id_evento, $user->id);
                foreach ($facility_events as &$facility_event)
                {
                    $language = $languages->get_by_field('shortcode_lingua', $facility_event['id_lingua']);
                    $abbreviation = $language['abbreviazione'];

                    $facility_event['testo_convenzione'] = isset($params['recupera_convenzione']) ? '' : $params['testo_convenzione'][$abbreviation] ?? '';
                    $this->facility_event_repository->update($facility_event);
                }
                return new HttpRedirectView("/backoffice/events/$id_evento/edit");
            }

            // update dell'evento
            foreach ($event_fields as $field)
            {
                switch ($field)
                {
                    case 'abilitato':
                    case 'recupera_struttura':
                        $event[$field] = intval($params[$field]);
                        break;

                    case 'img_evento':
                        $images = array_values($params[$field]);
                        $image = array_pop($images);
                        $event[$field] = $image;
                        break;

                    default:
                        $event[$field] = $params[$field];
                        break;
                }
            }

            $this->event_repository->update($event);

            foreach ($params['related_item'] as $related_item)
            {
                list($type, $id_item) = explode('-', $related_item);
                if ($type == '1')
                {
                    $id_hotel = $id_item;
                    $id_struttura = null;
                }
                else
                {
                    $id_struttura = $id_item;
                    $facility_hotel = $this->facility_hotel_repository->get_by_facility_id($id_struttura);
                    $id_hotel = $facility_hotel['id_hotel'];
                }
                foreach ($params['descrizione_evento'] as $abbreviation => $descrizione_evento)
                {
                    $language = $languages->get_by_field('abbreviazione', $abbreviation);
                    if (!empty($language))
                    {
                        $facility_event = array
                        (
                            'id_evento' => $id_evento,
                            'shortcode_lingua' => $language['shortcode_lingua'],
                            'testo_convenzione' => isset($params['recupera_convenzione']) ? '' : $params['testo_convenzione'][$abbreviation] ?? '',
                            'descrizione_evento' => $descrizione_evento,
                            'id_hotel' => $id_hotel,
                            'id_struttura' => $id_struttura
                        );
                        $this->facility_event_repository->add($facility_event);
                    }
                }
            }
        }

        return new HttpRedirectView("/backoffice/events/$id_evento/edit");
    }
}