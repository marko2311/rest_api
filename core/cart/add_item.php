<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/bootstrap.php');

if(isset($_SESSION['CartRepo'])){
    $cart = unserialize($_SESSION['CartRepo']);

    $data = json_decode(file_get_contents("php://input"));

    $query = "SELECT name, price FROM games_list WHERE id = " . $data->id . ";";
    $statement = $db->prepare($query);
    if(!$statement->execute()){
        echo json_encode(array("message" => 'Error with getting game info'));
        return false;
    }
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    if(empty($record)){
        echo json_encode(array("message" => 'Cannot find requested game'));
        return false;
    }
    extract($record);
    $cart->add($data->id, $data->quantity, array("name" => $name, "price" => $price));

    $_SESSION['CartRepo']= serialize($cart);

    echo json_encode(array("message" => "Game added!"));
    return true;
}
echo json_encode(array("message" => "There is no active CartRepo"));
return false;

