<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/init.php');

if(isset($_SESSION['cart'])){

    $cart = unserialize($_SESSION['cart']);

    if($cart->isEmpty()){
        echo json_encode(array("message" => "Cart is empty!"));
        return false;
    }

    $result = $cart->getItems();
    $total_price = number_format($cart->getAttributeTotal('price'), 2, '.', ',');
    $result['total_price'] = $total_price;
    echo json_encode($result);
    return true;
}
echo json_encode(array("message" => "First create cart!"));
return false;

