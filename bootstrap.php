<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Api\System\DatabaseConnector;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

$connector = new DatabaseConnector();
$dbConnection = $connector->getConnection();

