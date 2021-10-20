<?php
require_once 'Models/Language.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/AbstractTemplateViewModel.class.php';

class BackOfficeViewModel extends AbstractTemplateViewModel
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $title;

    /**
     * @var Language
     */
    public $lang;

    public function __construct(User &$user, string $title, Language &$lang) {
        parent::__construct('backoffice');
        $this->user = $user;
        $this->title = $title;
        $this->lang = $lang;
    }

}