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

class BackofficeEventsAddController
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

    public function http_post(array &$params): IView
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
            'recupera_struttura',
            'recupera_convenzione',
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

        $event = array
        (
            'created_by' => $user->level <= 2 ? 0 : $user->id,
            'struttura_collegata' => $params['related_item'][0] ?? '',
            'tipo_struttura_collegata' => 0
        );

        // update dell'evento
        foreach ($event_fields as $field)
        {
            switch ($field)
            {
                case 'abilitato':
                    $event[$field] = intval($params[$field]);
                    break;

                case 'img_evento':
                    $images = array_values($params[$field]);
                    $image = array_pop($images);
                    $event[$field] = $image;
                    break;

                case 'recupera_struttura':
                    $event[$field] = intval($params[$field]);
                    break;

                case 'recupera_convenzione':
                    $event[$field] = intval($params[$field]);
                    break;

                default:
                    $event[$field] = $params[$field];
                    break;
            }
        }

        $id_evento = $this->event_repository->add($event);

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
                    $shortcode_lingua = $language['shortcode_lingua'];

                    $convenzionato = $params['convenzionato'] ?? $match['convenzionato'] ?? 0;
                    $testo_convenzione = $params['testo_convenzione'][$abbreviation] ?? $match['testo_convenzione'] ?? '';

                    $facility_event = array
                    (
                        'id_evento' => $id_evento,
                        'shortcode_lingua' => $shortcode_lingua,
                        'testo_convenzione' => $testo_convenzione,
                        'descrizione_evento' => $descrizione_evento,
                        'id_hotel' => $id_hotel,
                        'id_struttura' => $id_struttura,
                        'convenzionato' => $convenzionato
                    );

                    $id = $this->facility_event_repository->add($facility_event);
                }
            }
        }

        return new HttpRedirectView("/backoffice/events/$id_evento/edit");
    }
}