<?php
require_once 'Middlewares/Environment.class.php';

$env = Environment::get();

if ($env == 'dev') { ?>&XDEBUG_SESSION_START<?php } ?>