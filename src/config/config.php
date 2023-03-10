<?php

$dotenv = Dotenv\Dotenv::createImmutable(realpath('..'));
$dotenv->load();

define('SERVER_HOST',  $_ENV['SERVER_HOST']);
define('SECRET_KEY', $_ENV['SECRET_KEY']);
define('PUBLIC_TOKEN', $_ENV['PUBLIC_TOKEN']);
define('DEVICE_TOKEN', $_ENV['DEVICE_TOKEN']);
define('AUTH_EMAIL', $_ENV['AUTH_EMAIL']);
define('AUTH_PASSWORD', $_ENV['AUTH_PASSWORD']);
define('PHONE_NUMBER_TEST', $_ENV['PHONE_NUMBER_TEST']);
