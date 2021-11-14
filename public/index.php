<?php
ob_start();




require dirname(__DIR__).'/Core/Exception.php';
require_once dirname(__DIR__).'/vendor/autoload.php';
\App\Core\Session::start();
require __DIR__.'/../Core/Helper.php';
require __DIR__.'/../App/Route/web.php';

