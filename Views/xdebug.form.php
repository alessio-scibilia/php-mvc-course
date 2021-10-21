<?php
require_once 'Middlewares/Environment.class.php';

$env = Environment::get();

if ($env == 'dev') { ?><input type="hidden" name="XDEBUG_SESSION_START"><?php } ?>