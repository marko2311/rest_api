<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization, X-Requested-With');

include_once('../core/init.php');

$game = new Game($db);

$data = json_decode(file_get_contents("php://input"));

$game->name = $data->name;
$game->price = $data->price;

if($game->create()){
    echo json_encode(array('message' => 'Post created'));
} else {
    echo json_encode(array('error' => 'Post didn`t create'));
    exit;
}