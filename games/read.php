<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/init.php');

$requested_id = isset($_GET['id']) ? $_GET['id'] : 0;
$game = new Game($db, $requested_id);

$result = $game->read();
$num = $result->rowCount();
// number of pages
$pages = ceil($num / 3);

if($num > 0){
    $game_array = array();
    $game_array['data'] = array();
    $page_number = 1;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        isset($game_array['data'][$page_number]) ? null : $game_array['data'][$page_number] = array();
        extract($row);
        $game_item = array(
            'id'    => $id,
            'name'  => $name,
            'price' => $price
        );
        array_push($game_array['data'][$page_number], $game_item);
        if(count($game_array['data'][$page_number]) == 3)
            $page_number++;
    }
    echo json_encode($game_array);
} else {
    echo json_encode(array('message' => 'No game found'));
}