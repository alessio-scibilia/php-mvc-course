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

class BackofficeFacilitiesCategoriesAddController
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

        if (isset($params['nome']) && isset($params['immagine'])) {

            $i_lang = 0;
            $cat_fields = array
            (
                'nome',
                'immagine',
            );

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


            return new HttpRedirectView('/backoffice/facilities/categories');
        }


        return new HttpRedirectView('/backoffice/facilities/categories');
    }
}