<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/CategoryRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Category.class.php';
require_once 'Models/Languages.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesCategoryUpdateController
{
    protected $user_repository;
    protected $category_repository;
    protected $language_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->category_repository = new CategoryRepository();
        $this->language_repository = new LanguageRepository();
    }

    public function http_post(array &$params): IView
    {
        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        if (isset($params['nome']) && isset($params['immagine'])) {

            $i_lang = 0;
            $cat_fields = array
            (
                'nome',
                'immagine',
            );

            $id = intval($params['id_cat']);
            $languages = new Languages($this->language_repository->list_all());
            $cat_fields = array
            (
                'nome',
                'immagine',
            );
            $cat_translations = $this->category_repository->get_by_related_id($id);

            if (empty($cat_translations)) {
                $params['errors'][] = "No hotel translations found";
                return $this->http_get($params);
            }

            foreach ($cat_translations as &$cat_translation) {
                foreach ($cat_fields as $cat_field) {
                    $cat_translation[$cat_field] = $params[$cat_field];
                }

                $language = $languages->get_by_field('shortcode_lingua', $cat_translation['shortcode_lingua']);
                if (!empty($language)) {
                    $abbreviation = $language['abbreviazione'];
                    $cat_translation['immagine'] = $params['immagine'][0];
                    $cat_translation['nome'] = $params['nome'][$abbreviation] ?? $cat_translation['nome'];
                }

                $this->category_repository->update($cat_translation);
            }

            /*
            $categoria['abilitata'] = 0;
            foreach ($languages->list_all() as $lingua) {
                $categoria['nome'] = $params['nome'][$lingua['abbreviazione']];
                $categoria['immagine'] = $params['immagine'][1];
                $categoria['shortcode_lingua'] = $lingua['shortcode_lingua'];

                if ($i_lang == 0) { //add + update per related id
                    $categoria['id'] = $this->category_repository->add($categoria);
                    $related_id = $categoria['id'];
                    $categoria['related_id'] = $related_id;
                    $this->category_repository->update($categoria);
                } else { //add classico
                    $categoria['id'] = $related_id;
                    $this->category_repository->add($categoria);
                }
                $i_lang++;
            }
            */

            return new HttpRedirectView('/backoffice/facilities/categories/' . $id . '/edit');
        }


        return new HttpRedirectView('/backoffice/facilities/categories');
    }
}