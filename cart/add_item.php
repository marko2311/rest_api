<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/init.php');

if(isset($_SESSION['cart'])){
    $cart = unserialize($_SESSION['cart']);

    $data = json_decode(file_get_contents("php://input"));
    $cart->add($data->id, $data->quantity);

    $_SESSION['cart']= serialize($cart);

    echo json_encode(array("message" => "Item added!"));
    return true;
}
echo json_encode(array("message" => "There is no active cart"));
return false;

