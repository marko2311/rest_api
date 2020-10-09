<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/init.php');

$game = new Game($db);

$result = $game->read();
$num = $result->rowCount();

if($num > 0){
    $game_array = array();
    $game_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $game_item = array(
            'id'    => $id,
            'name'  => $name,
            'price' => $price
        );
        array_push($game_array['data'], $game_item);
    }
    echo json_encode($game_array);
} else {
    echo json_encode(array('message' => 'No posts found'));
}