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
require_once 'Models/Service.class.php';
require_once 'Models/Utility.class.php';
require_once 'Models/Hotel.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';
require_once 'Views/JsonView.class.php';

class BackofficeHotelsAddController
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

    public function http_post(array &$params): IView
    {
        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        if (isset($params['descrizione']) &&
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
                'img_servizio',
                'nome_utility',
                'indirizzo',
                'telefono',
                'img_utility',
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

            $i_lang = 0;

            foreach ($languages->list_all() as $hotel_translation) {
                foreach ($hotel_fields as $hotel_field) {
                    if ($hotel_field == 'password' && empty($params['password']))
                        continue;
                    else if ($hotel_field == 'password')
                        $hotel_translation[$hotel_field] = md5($params[$hotel_field]);
                    else if ($hotel_field == 'level') {
                        $hotel_translation[$hotel_field] = $params[$hotel_field] == "1" ? 3 : 0;
                    } else
                        $hotel_translation[$hotel_field] = $params[$hotel_field];

                }
                unset($hotel_translation['nome_lingua']);
                unset($hotel_translation['abbreviazione']);
                unset($hotel_translation['abilitata']);
                unset($hotel_translation['id']);

                $language = $languages->get_by_field('shortcode_lingua', $hotel_translation['shortcode_lingua']);

                if (!empty($language)) {
                    $abbreviation = $language['abbreviazione'];
                    $hotel_translation['descrizione_ospiti'] = $params['descrizione_ospiti'][$abbreviation] ?? $hotel_translation['descrizione_ospiti'];
                }
                $hotel_translation['immagini_secondarie'] = join('|', $params['img_hotel']) . '|';
                $hotel_translation['immagine_principale'] = $params['default_image'];

                if ($i_lang == 0) {
                    $hotel_translation['id'] = $this->hotel_repository->add($hotel_translation);
                    $related_id = $hotel_translation['id'];
                    $hotel_translation['related_id'] = $related_id;
                    $this->hotel_repository->update($hotel_translation);
                } else {
                    $hotel_translation['related_id'] = $related_id;
                    $this->hotel_repository->add($hotel_translation);
                }

                $i_lang++;

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
            } else if (!empty($params['nome_utility'])) {
                foreach ($params['nome_utility'] as $i => $names) {
                    $images = array_values($params['img_servizio'][$i]);
                    foreach ($names as $abbreviation => $titolo) {
                        $language = $languages->get_by_field('abbreviazione', $abbreviation);

                        $utility = array
                        (
                            'hotel_associato' => $related_id,
                            'nome' => $titolo,
                            'indirizzo' => params['indirizzo'][$i][$abbreviation],
                            'telefono' => params['telefono'][$i][$abbreviation],
                            'immagine' => $images[0], // only 1 image for services
                            'shortcode_lingua' => $language['shortcode_lingua'],
                            'posizione' => $params['posizione'][$i]
                        );

                        $utility['id'] = $this->utility_repository->add($utility);
                    }
                }
            }
            unset($params['errors']);
        } else {
            $params['errors'][] = "Missing mandatory field";
        }

        return new HttpRedirectView("/backoffice/hotels/$related_id/edit");
    }
}