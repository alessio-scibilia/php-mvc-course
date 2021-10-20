<?php
require_once 'ViewModels/AbstractTemplateViewModel.class.php';

class DashboardViewModel extends AbstractTemplateViewModel
{
    /**
     * @var User
     */
    public $user;

    public $title;

    public function __construct(User &$user, string $title) {
        parent::__construct('dashboard');
        $this->user = $user;
        $this->title = $title;
    }

}