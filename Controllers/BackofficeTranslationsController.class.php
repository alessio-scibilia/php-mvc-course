<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';

class BackofficeTranslationsController
{
    protected $language_repository;
    protected $translation_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
    }

    public function http_get(array &$params): IView
    {
        $user = SessionManager::get_user();
        if (User::is_empty($user)) {
            return new HttpRedirectView('/backoffice');
        }

        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

        if (!isset($params['shortcode_lingua'])) {
            $translations_to_view = new Translations($this->translation_repository->list_by_language($id_lingua));
            $lang_selected = $id_lingua;
        } else {
            $translations_to_view = new Translations($this->translation_repository->list_by_language($params['shortcode_lingua']));
            $lang_selected = $params['shortcode_lingua'];
        }

        $title = $translations->get('titolo_traduzioni') . ' | ' . $translations->get('nome_sito');

        $view_model = new BackOfficeViewModel('backoffice.translations.list', $title, $languages, $translations);
        $view_model->user = $user;
        $view_model->lang_selected = $lang_selected;
        $view_model->translations_to_view = $translations_to_view;
        $view_model->errors = $params['errors'] ?? array();
        $view_model->menu_active_btn = 'translations';

        return new HtmlView($view_model);
    }

    public function http_post(array &$params): IView
    {
        $user = SessionManager::get_user();
        if (User::is_empty($user)) {
            return new HttpRedirectView('/backoffice');
        }

        $mandatories = array('translations', 'valore');
        foreach ($mandatories as $mandatory) {
            if (!isset($params[$mandatory])) {
                $params['errors'][] = "Missing mandatory param '$mandatory'";
            }
        }

        if (empty($params['errors'])) {
            $id = intval($params['translations']);
            $row = $this->translation_repository->get_by_id($id);
            $this->lang_selected = $row->shortcode_lingua;
            if (empty($row)) {
                $params['errors'][] = "Missing translation whose id = $id";
            } else {
                $row['valore'] = $params['valore'];
                $this->translation_repository->update($row);
            }
        }

        return $this->http_get($params);
    }
}