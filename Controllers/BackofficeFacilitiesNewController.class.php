<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/EventRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Database/FacilityEventRepository.class.php';
require_once 'Database/FacilityCategoryRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Database/CategoryRepository.class.php';
require_once 'Database/ExcellenceRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Event.class.php';
require_once 'Models/FacilityEvent.class.php';
require_once 'Models/FacilityCategory.class.php';
require_once 'Models/FacilityHotel.class.php';
require_once 'Models/Excellence.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesNewController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $event_repository;
    protected $hotel_repository;
    protected $facility_repository;
    protected $facility_hotel_repository;
    protected $facility_event_repository;
    protected $facitity_category_repository;
    protected $category_repository;
    protected $excellence_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->event_repository = new EventRepository();
        $this->facility_repository = new FacilityRepository();
        $this->hotel_repository = new HotelRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
        $this->facility_event_repository = new FacilityEventRepository();
        $this->facility_category_repository = new FacilityCategoryRepository();
        $this->category_repository = new CategoryRepository();
        $this->excellence_repository = new ExcellenceRepository();
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

        $principal = new Facility();
        $principal->indirizzo = '';
        $principal->email = '';
        $principal->abilitata = 0;
        $principal->lunedi = '0|||||';
        $principal->martedi = '0|||||';
        $principal->mercoledi = '0|||||';
        $principal->giovedi = '0|||||';
        $principal->venerdi = '0|||||';
        $principal->sabato = '0|||||';
        $principal->domenica = '0|||||';
        $principal->telefono = '';
        $principal->tipo_viaggio = 2; // car
        $principal->sito_web = '';
        $principal->indicizza = 0;
        $principal->convenzionato = 0;
        $principal->latitudine = '';
        $principal->longitudine = '';

        if ($user->level <= 2) {
            $rows = $this->hotel_repository->get_all_hotels($language['shortcode_lingua']);
            $hotels = Hotel::hotels($rows);

            $rows = $this->category_repository->get_all_categories($language['shortcode_lingua']);
            $categories = Category::categories($rows);
        } else {
            $hotels = array();
            $categories = array();
        }

        $view_model = new BackOfficeViewModel('backoffice.facilities.create', $title, $languages, $translations);
        $view_model->user = $user;
        $view_model->language = $language;
        //$view_model->facilities = $facilities; // all available languages
        $view_model->principal = $principal;
        $view_model->hotels = $hotels;
        $view_model->categories = $categories;
        $view_model->related_hotels = array();
        $view_model->related_categories = array();
        $view_model->tips = array();

        $view_model->menu_active_btn = 'facilities';

        return new HtmlView($view_model);
    }

    public function http_post(array &$params): IView
    {
        $user = SessionManager::get_user();
        if (User::is_empty($user)) {
            return new HttpRedirectView('/backoffice');
        }

        $languages = new Languages($this->language_repository->list_all());

        $facility_fields = array
        (
            'email',
            'sito_web',
            'telefono',
            'abilitata',
            'indicizza',
            'convenzionato',
            'latitudine',
            'longitudine',
            'tipo_viaggio',
        );
        $facility_fields_remap = array
        (
            'indirizzo' => 'indirizzo_struttura',
            'default_image' => 'immagine_principale',
        );
        $facility_defaults = array
        (
            'indirizzo' => '',
            'default_image' => 0,
        );
        $weekdays = array('lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica');
        $first = true;
        $facility = array();
        $id = 0;
        $created_by = $user->level > 2 ? $user->id : 0;
        foreach ($languages->list_all() as &$language) {
            $abbreviation = $language['abbreviazione'];
            $facility['shortcode_lingua'] = $language['shortcode_lingua'];
            $facility['created_by'] = $created_by;

            foreach ($facility_fields as $facility_field) {
                if ($facility_field == 'convenzionato' && $user->level < 3)
                    continue;
                else if ($facility_field == 'convenzionato')
                    $related['convenzionato'] = $params['convenzionato'];

                if ($facility_field == 'indicizza' && $user->level > 2)
                    continue;

                $facility[$facility_field] = $params[$facility_field];
            }
            foreach ($facility_fields_remap as $post_field => $facility_field) {
                $facility[$facility_field] = $params[$post_field] ?? $facility_defaults[$post_field];
            }

            $facility['immagine_didascalia'] = join('|', $params['img_struttura']) . '|';
            $facility['descrizione'] = $params['descrizione'][$abbreviation] ?? '';
            $facility['nome_struttura'] = $params['nome_struttura'][$abbreviation] ?? '';

            if ($user->level > 2) {
                $facility['descrizione_benefit'] = $params['descrizione_benefit'][$abbreviation];
            }

            $img_didascalia = $params['img_didascalia'] ?? array();
            $facility['real_immagini_didascalia'] = join('|', $img_didascalia) . (empty($img_didascalia) ? '' : '|');

            $tips = array();
            foreach ($params['didascalia_img_didascalia'] ?? array() as $image_tips) {
                $tips[] = join('||', $image_tips) . '||';
            }
            $tips = empty($tips) ? '' : join('&&', $tips) . '&&';
            $facility['real_path_immagini_didascalia'] = $tips;

            foreach ($params['orario_continuato'] as $weekday => $flag) {
                $orari = $params['giorno'][$weekday];
                $prefix = str_repeat('|', empty($orari) ? 0 : 1);
                $content = join('|', $orari);
                $suffix = str_repeat('|', 5 - count($orari));
                $facility['orari_' . $weekday] = $flag . $prefix . $content . $suffix;
            }

            $facility['id'] = $this->facility_repository->add($facility);

            if ($first) {
                $id = $facility['id'];
                $facility['related_id'] = $id;
                $this->facility_repository->update($facility);

                $relation['id_hotel'] = $user->id;
                $relation['id_struttura'] = $id;
                $relation['convenzionato'] = $params['convenzionato'];
                $this->facility_hotel_repository->add($relation);

                $first = false;
            }
        }

        // facility hotels
        $this->facility_hotel_repository->remove_by_facility($id);
        if (isset($params['related_hotels'])) {
            foreach ($params['related_hotels'] as $id_hotel) {
                $facility_hotel = array
                (
                    'id_struttura' => $id,
                    'id_hotel' => $id_hotel,
                    'convenzionato' => $params['convenzionato'],
                );
                $facility_hotel['id'] = $this->facility_hotel_repository->add($facility_hotel);
            }

            // facility categories
            $this->facility_category_repository->remove_by_facility($id);
            foreach ($params['related_categories'] as $id_categoria) {
                $facility_category = array
                (
                    'id_struttura' => $id,
                    'id_categoria' => $id_categoria,
                    'email_struttura' => $facility['email']
                );
                $facility_category['id'] = $this->facility_category_repository->add($facility_category);
            }
        }

        // excellences
        $this->excellence_repository->remove_by_facility($id);
        foreach ($params['nome_eccellenza'] as $position => $names) {
            foreach ($names as $abbreviation => $name) {
                $language = $languages->get_by_field('abbreviazione', $abbreviation);
                $images = array_values($params['img_eccellenza'][$position] ?? array());
                $image = array_pop($images);
                $excellence = array
                (
                    'struttura_collegata' => $id,
                    'titolo' => $name,
                    'testo' => $params['testo'][$position][$abbreviation] ?? '',
                    'immagine' => $image,
                    'shortcode_lingua' => $language['shortcode_lingua'],
                    'abilitato' => $params['abilitato'][$position] ?? 0,
                    'posizione' => $position
                );
                $excellence['id'] = $this->excellence_repository->add($excellence);
            }
        }

        return new HttpRedirectView("/backoffice/facilities/$id/edit");
    }

}