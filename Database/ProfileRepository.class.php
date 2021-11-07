<?php
require_once 'Database/MySQLRepository.class.php';

class ProfileRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('hotel', 'id');
    }
}