<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/bootstrap.php');

$cart = new Cart(array(
    'cartMaxItem'      => 3,
    'itemMaxQuantity'  => 10,
    'useCookie'        => false
));
$_SESSION['CartRepo'] = serialize($cart);
echo json_encode(array("message" => "Cart created!"));