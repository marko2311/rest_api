<?php

$db_user     = "root";
$db_password = "";
$db_name     = "games";

$db = new PDO('mysql:host=127.0.0.1;dbname='.$db_name.';charset=utf8', $db_user, $db_password);
