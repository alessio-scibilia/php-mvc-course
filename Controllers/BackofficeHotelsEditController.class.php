<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Database/ServiceRepository.class.php';
require_once 'Database/UtilityRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Profile.class.php';
require_once 'Models/Hotel.class.php';
require_once 'Models/Utility.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';
require_once 'Views/JsonView.class.php';

class BackofficeHotelsEditController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $hotel_repository;
    protected $service_repository;
    protected $utility_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->hotel_repository = new HotelRepository();
        $this->service_repository = new ServiceRepository();
        $this->utility_repository = new UtilityRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['hotels'])) {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_ospiti') . ' | ' . $translations->get('nome_sito');

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $id = intval($params['hotels']);
            $row = $this->hotel_repository->get_profile($id_lingua, $id);
            $profile = new Hotel($row);

            $services = array();
            $lingue = $this->language_repository->list_all();
            $rows = $this->service_repository->get_services_by_hotel($id);
            $instances = $languages->list_all();
            $services = Service::grouped_services($rows, $instances);

            $utilities = array();
            $rows = $this->utility_repository->get_utilities_by_hotel($id);
            $utilities = Utility::grouped_utilities($rows, $instances);

            $rows = $this->hotel_repository->get_translations($profile->related_id);
            $hotel_translations = Hotel::hotels($rows);

            //'d92fgov02dm2jf493fspamwi2d0za201',
            $view_model = new BackOfficeViewModel('backoffice.hotels.edit', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->profile = $profile;
            $view_model->language = $languages->get($id_lingua);
            $view_model->hotel_translations = $hotel_translations;
            $view_model->services = $services;
            $view_model->utilities = $utilities;
            $view_model->menu_active_btn = 'hotels';
            $view_model->errors = $params['errors'] ?? array();

            return new HtmlView($view_model);
        }

        return new HttpRedirectView('/backoffice/hotels');
    }

    public function http_post(array &$params): IView
    {


        $id = intval($params['hotels']);
        $languages = new Languages($this->language_repository->list_all());
        $hotel_fields = array
        (
            'nome',
            'email',
            'sito_web',
            'telefono',
            'indirizzo',
            'latitudine',
            'longitudine',
            'abilitato',
            'level',
            'password',
        );
        $hotel_translations = $this->hotel_repository->get_by_related_id($id);
        if (empty($hotel_translations)) {
            $params['errors'][] = "No hotel translations found";
            return $this->http_get($params);
        }

        foreach ($hotel_translations as &$hotel_translation) {
            foreach ($hotel_fields as $hotel_field) {
                if ($hotel_field == 'password' && empty($params['password']))
                    continue;
                else if ($hotel_field == 'password')
                    $hotel_translation[$hotel_field] = md5($params[$hotel_field]);
                else if ($hotel_field == 'level')
                    $hotel_translation[$hotel_field] = $params[$hotel_field] == "1" ? 3 : 0;
                else
                    $hotel_translation[$hotel_field] = $params[$hotel_field];
            }

            $language = $languages->get_by_field('shortcode_lingua', $hotel_translation['shortcode_lingua']);
            if (!empty($language)) {
                $abbreviation = $language['abbreviazione'];
                $hotel_translation['descrizione_ospiti'] = $params['descrizione_ospiti'][$abbreviation] ?? $hotel_translation['descrizione_ospiti'];
            }
            $hotel_translation['immagini_secondarie'] = join('|', $params['img_hotel']) . '|';
            $hotel_translation['immagine_principale'] = $params['default_image'];
            $this->hotel_repository->update($hotel_translation);
        }

        $related_id = $hotel_translations[0]['related_id'];
        $this->service_repository->remove_by_hotel($related_id);

        if (isset($params['hotels']) &&
            isset($params['descrizione']) &&
            isset($params['nome_servizio']) &&
            isset($params['orario_continuato']) &&
            isset($params['giorno']) &&
            isset($params['img_servizio'])
        ) {
            $multiples = array
            (
                'descrizione',
                'nome_servizio',
                'orario_continuato',
                'giorno',
                'img_servizio'
            );
            $n = -1;
            foreach ($multiples as $multiple) {
                if ($n == -1) {
                    $n = count($params[$multiple]);
                } else {
                    if ($n != count($params[$multiple])) {
                        $params['errors'][] = "Count of $multiple does not match";
                        return $this->http_get($params);
                    }
                }
            }

            if (!empty($params['nome_servizio'])) {
                $weekdays = array('lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica');
                foreach ($params['nome_servizio'] as $i => $names) {
                    $images = array_values($params['img_servizio'][$i]);
                    foreach ($names as $abbreviation => $titolo) {
                        $language = $languages->get_by_field('abbreviazione', $abbreviation);

                        $service = array
                        (
                            'hotel_associato' => $related_id,
                            'titolo' => $titolo,
                            'descrizione' => $params['descrizione'][$i][$abbreviation],
                            'immagine' => $images[0], // only 1 image for services
                            'abilitato' => $params['servizio_abilitato'][$i],
                            'shortcode_lingua' => $language['shortcode_lingua'],
                            'posizione' => $params['posizione'][$i]
                        );
                        foreach ($weekdays as $weekday) {
                            $orari = $params['giorno'][$i][$weekday];
                            $flag = $params['orario_continuato'][$i][$weekday];
                            $prefix = str_repeat('|', empty($orari) ? 0 : 1);
                            $content = join('|', $orari);
                            $suffix = str_repeat('|', 5 - count($orari));
                            $service[$weekday] = $flag . $prefix . $content . $suffix;
                        }

                        $service['id'] = $this->service_repository->add($service);
                    }
                }
            }
            unset($params['errors']);
        }

        return $this->http_get($params);
    }
}