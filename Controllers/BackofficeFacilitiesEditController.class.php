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

class BackofficeFacilitiesEditController
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
        if (isset($params['facilities'])) {
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

            $id = intval($params['facilities']);
            $rows = $this->facility_repository->get_facility_all_langs($id);
            $facilities = Facility::facilities($rows);
            $principal = $facilities[0];

            // compute tips from backward-compatibility format
            $temp_tips = empty($principal->real_path_immagini_didascalia) ? array() : explode('&&', $principal->real_path_immagini_didascalia);
            $tips = array();
            $i = 0;
            foreach ($temp_tips as $temp_tip) {
                $values = empty($temp_tip) ? array() : explode('||', $temp_tip);
                $map = array();
                $j = 0;
                foreach ($languages->list_all() as $language) {
                    $map[$language['abbreviazione']] = $values[$j++] ?? '';
                }
                $tips[$i++] = $map;
            }

            if ($user->level <= 2) {
                $rows = $this->hotel_repository->get_all_hotels($language['shortcode_lingua']);
                $hotels = Hotel::hotels($rows);

                $rows = $this->category_repository->get_all_categories($language['shortcode_lingua']);
                $categories = Category::categories($rows);
            } else {
                $hotels = array();
                $categories = array();
            }

            $rows = $this->facility_hotel_repository->get_related_by_facility_id_and_language_id($principal->related_id, $language['shortcode_lingua']);
            $related_hotels = Hotel::hotels($rows);

            $rows = $this->category_repository->get_by_facility($principal->related_id, $language['shortcode_lingua']);
            $related_categories = Category::categories($rows);

            $rows = $this->excellence_repository->get_by_facility($principal->related_id);
            $instances = $languages->list_all();
            $related_excellences = Excellence::grouped_excellences($rows, $instances);

            $view_model = new BackOfficeViewModel('backoffice.facilities.edit', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->language = $language;
            $view_model->facilities = $facilities; // all available languages
            $view_model->principal = $principal;
            $view_model->hotels = $hotels;
            $view_model->categories = $categories;
            $view_model->related_hotels = $related_hotels;
            $view_model->related_categories = $related_categories;
            $view_model->related_excellences = $related_excellences;
            $view_model->tips = $tips;

            $view_model->menu_active_btn = 'facilities';

            return new HtmlView($view_model);
        }

        return new HttpRedirectView('/backoffice/facilities');
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['facilities'])) {
            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $languages = new Languages($this->language_repository->list_all());

            $id = intval($params['facilities']);
            $facilities = $this->facility_repository->get_facility_all_langs($id);
            $facility_fields = array
            (
                'nome_struttura',
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
            $weekdays = array('lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica');
            foreach ($facilities as &$facility) {
                $language = $languages->get_by_field('shortcode_lingua', $facility['shortcode_lingua']);
                $abbreviation = $language['abbreviazione'];

                if ($user->level > 2 && $facility['created_by'] != $user->id) {
                    $facility['convenzionato'] = $params['convenzionato'];
                    $facility['descrizione_benefit'] = $params['descrizione_benefit'][$abbreviation];
                    $this->facility_repository->update($facility);

                    $this->facility_hotel_repository->delete_relation($user->id, $facility['related_id']);
                    $relation['id_hotel'] = $user->id;
                    $relation['id_struttura'] = $facility['related_id'];
                    $relation['convenzionato'] = $params['convenzionato'];
                    $this->facility_hotel_repository->add($relation);


                } else {

                    foreach ($facility_fields as $facility_field) {
                        if ($facility_field == 'convenzionato' && $user->level < 3)
                            continue;
                        if ($facility_field == 'indicizza' && $user->level > 2)
                            continue;

                        $facility[$facility_field] = $params[$facility_field];

                        foreach ($facility_fields_remap as $post_field => $facility_field) {
                            $facility[$facility_field] = $params[$post_field];
                        }
                    }

                    $facility['immagine_didascalia'] = join('|', $params['img_struttura']) . '|';
                    $facility['descrizione'] = $params['descrizione'][$abbreviation];
                    if ($user->level > 2) {
                        $facility['descrizione_benefit'] = $params['descrizione_benefit'][$abbreviation];
                    }

                    $facility['real_immagini_didascalia'] = join('|', $params['img_didascalia'] ?? array()) . '|';

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

                    $this->facility_repository->update($facility);

                    // facility categories
                    $this->facility_category_repository->remove_by_facility($id);
                    foreach ($params['related_categories'] ?? array() as $id_categoria) {
                        $facility_category = array
                        (
                            'id_struttura' => $id,
                            'id_categoria' => $id_categoria,
                            'email_struttura' => $facility['email']
                        );
                        $facility_category['id'] = $this->facility_category_repository->add($facility_category);
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
                }

            }
            if (isset($params['related_hotels']))
                $this->update_related_items($params, $id);

            return $this->http_get($params);
        }

        return new HttpRedirectView('/backoffice/facilities');
    }

    protected function update_related_items(array $params, int $id_facility): bool
    {
        $facilities_hotels = $this->facility_hotel_repository->get_related_by_facility_id_and_language_id($id_facility, 1);
        for ($i = 0; $i < sizeof($params['related_hotels']); $i++) {

            $related_hotel = $params['related_hotels'][$i];

            $found = array_filter($facilities_hotels, function ($f) use ($related_hotel) {
                return $f['id_hotel'] == $related_hotel;
            });

            $found = array_pop($found);
            if ($found == null) {
                $facility_hotel = array
                (
                    'id_struttura' => $id_facility,
                    'id_hotel' => $related_hotel,
                );
                $id = $this->facility_hotel_repository->add($facility_hotel);
            } else {
                $facilities_hotels = array_filter($facilities_hotels, function ($f) use ($found) {
                    return $f['id_hotel'] != $found['id_hotel'];
                });
            }

        }

        foreach ($facilities_hotels as $hotel) {
            $this->facility_hotel_repository->remove_by_hotel($hotel['id_hotel'], $id_facility);
        }

        return true;
    }
}