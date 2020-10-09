<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/init.php');

$query = "INSERT INTO `games_list`(`name`, `price`, `disable_delete`) VALUES 
('Fallout', 1.99, 1),
('Don`t Starve', 2.99, 1),
('Baldur`s Gate', 3.99, 1),
('Icewind Dale', 4.99, 1),
('Bloodborne', 5.99, 1)";
$statement = $db->prepare($query);
try {
    if($statement->execute()){
        echo json_encode(array('message' => 'Basic games added.'));
        return true;
    }
} catch(PDOException $exception) {
    $error = $exception->errorInfo;
    if ($error[1] == 1062)
        echo json_encode(array('message' => 'This name of game already exists.'));
    echo json_encode(array('error' => $statement->errorInfo()));
    die();
}
