<?php
require_once 'Middlewares/Environment.class.php';

$env = Environment::get();

if ($env == 'dev') echo '?XDEBUG_SESSION_START=';