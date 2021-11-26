<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Database/EventRepository.class.php';
require_once 'Database/FacilityEventRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Facility.class.php';
require_once 'Models/FacilityHotel.class.php';
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
    protected $facility_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->event_repository = new EventRepository();
        $this->facility_event_repository = new FacilityEventRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
        $this->facility_repository = new FacilityRepository();
    }

    public function http_get(array &$params): IView
    {

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

        $facilities = array();
        if ($user->level > 2)
        {
            $rows = $this->facility_hotel_repository->get_facilities_by_hotel($user->id);
            $facilities_hotel = FacilityHotel::facilities_hotels($rows);
            $facilities = array_map(function ($fh) { return $fh->id_struttura; }, $facilities_hotel);
        }
        else
        {
            $rows = $this->facility_repository->get_all_facilities($id_lingua);
            $facilities_all = Facility::facilities($rows);
            $facilities = array_map(function ($fh) { return $fh->related_id; }, $facilities_all);
        }

        $view_model = new BackOfficeViewModel('backoffice.events.list', $title, $languages, $translations);
        $view_model->user = $user;
        $view_model->events = $events;
        $view_model->language = $language;
        $view_model->facilities = $facilities;
        $view_model->menu_active_btn = 'events';

        return new HtmlView($view_model);

    }

    public function http_post(array &$params): IView
    {
        if (!isset($params['events'])) {
            return new Html404();
        } else {
            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice/events');
            }

            $languages = new Languages($this->language_repository->list_all());

            $event_fields = array
            (
                'img_evento',
                'data_inizio_evento',
                'data_fine_evento',
                'ora_inizio_evento',
                'ora_fine_evento',
                'recupera_struttura'
            );
            if (!isset($params['recupera_struttura'])) {
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

            $all_facilities_event = $this->facility_event_repository->get_by_event_id($id_evento);

            if ($created_by == 0 || $user->level <= 2)
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
                $facility_events = $this->facility_event_repository->get_related_by_event_and_hotel_without_facility($id_evento, $user->id);
                foreach ($facility_events as &$facility_event)
                {
                    $language = $languages->get_by_field('shortcode_lingua', $facility_event['shortcode_lingua']);
                    $abbreviation = $language['abbreviazione'];

                    $facility_event['testo_convenzione'] = $params['testo_convenzione'][$abbreviation] ?? '';
                    $facility_event['convenzionato'] = $params['convenzionato'] ?? 0;

                    unset($facility_event['nome']);
                    $this->facility_event_repository->update($facility_event);
                }
                return new HttpRedirectView("/backoffice/events/$id_evento/edit");
            }

            // update dell'evento
            foreach ($event_fields as $field) {
                switch ($field) {
                    case 'abilitato':
                    case 'recupera_struttura':
                        $event[$field] = intval($params[$field] ?? 0);
                        break;

                    case 'img_evento':
                        $images = array_values($params[$field] ?? array());
                        $image = array_pop($images);
                        $event[$field] = $image;
                        break;

                    default:
                        $event[$field] = $params[$field] ?? '';
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

                foreach ($languages->list_all() as &$language)
                {
                    $shortcode_lingua = $language['shortcode_lingua'];
                    $abbreviation = $language['abbreviazione'];

                    $matches = array_filter($all_facilities_event, function ($f) use($id_hotel, $id_struttura, $shortcode_lingua) {
                        return
                            $f['id_hotel'] == $id_hotel &&
                            $f['id_struttura'] == $id_struttura &&
                            $f['shortcode_lingua'] == $shortcode_lingua;
                    });
                    $match = array_pop($matches);

                    $convenzionato = $params['convenzionato'] ?? $match['convenzionato'] ?? 0;
                    $nome_evento = $params['nome_evento'][$abbreviation] ?? $match['nome_evento'] ?? '';
                    $descrizione_evento = $params['descrizione_evento'][$abbreviation] ?? $match['descrizione_evento'] ?? '';
                    $testo_convenzione = $params['testo_convenzione'][$abbreviation] ?? $match['testo_convenzione'] ?? '';

                    $facility_event = array
                    (
                        'id_evento' => $id_evento,
                        'shortcode_lingua' => $shortcode_lingua,
                        'testo_convenzione' => $testo_convenzione,
                        'nome_evento' => $nome_evento,
                        'descrizione_evento' => $descrizione_evento,
                        'id_hotel' => $id_hotel,
                        'id_struttura' => $id_struttura,
                        'convenzionato' => $convenzionato
                    );
                    $facility_event['id'] = $this->facility_event_repository->add($facility_event);
                }
            }
        }

        return new HttpRedirectView("/backoffice/events/$id_evento/edit");
    }
}