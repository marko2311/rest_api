<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/init.php');

$game = new Game($db);

$data = json_decode(file_get_contents("php://input"));

$game->id = $data->id;

if($game->delete()){
    echo json_encode(array('message' => 'Game deleted'));
} else {
    echo json_encode(array('message' => 'Game didn`t delete'));
    exit;
}