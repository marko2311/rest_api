<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PURGE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/bootstrap.php');

if(isset($_SESSION['CartRepo'])){

    unset($_SESSION['CartRepo']);

    echo json_encode(array("message" => "Cart destroyed!"));
    return true;
}
echo json_encode(array("message" => "First create CartRepo!"));
return false;