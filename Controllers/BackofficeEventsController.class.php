<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/EventRepository.class.php';
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

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->event_repository = new EventRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['events'])) {
            return new Html404();
        } else {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_eventi') . ' | ' . $translations->get('nome_sito');

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $rows = $this->event_repository->get_all_events();
            $events = Event::events($rows);
            //$events = array(); // TODO: da recuperare dal DB

            //'d92fgov02dm2jf493fspamwi2d0za201',
            $view_model = new BackOfficeViewModel('backoffice.events.list', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->events = $events;
            $view_model->menu_active_btn = 'events';

            return new HtmlView($view_model);
        }
    }

    public function http_post(array &$params): IView
    {
        if (!isset($params['events']))
            return new Html404();

        else {
            $id_evento = intval($params['events']);
            

        }

        return new JsonView($params);
    }
}