<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/init.php');

session_start();

$cart = new Cart(array(
    'cartMaxItem'      => 3,
    'itemMaxQuantity'  => 10,
    'useCookie'        => false
));
$_SESSION['cart'] = serialize($cart);
echo json_encode(array("message" => "Cart created!"));