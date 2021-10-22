<?php
require_once 'Middlewares/Environment.class.php';

$env = Environment::get();

if ($env == 'dev') echo 'data-debug=true';