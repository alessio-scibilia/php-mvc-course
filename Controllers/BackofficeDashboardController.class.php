<?php
require_once 'Middlewares/SessionManager.class.php';
require_once 'ViewModels/UserViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';

class BackofficeDashboardController
{
    public function http_get(array &$params): IView
    {
        $user = SessionManager::get_user();
        if ($user == null)
        {
            return new HttpRedirectView('/backoffice');
        }
        $view_model = new UserViewModel('backoffice.dashboard', $user);
        return new HtmlView($view_model);
    }
}