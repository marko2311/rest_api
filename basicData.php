<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/init.php');

$query = "CREATE TABLE IF NOT EXISTS `games_list` (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  price VARCHAR(30) NOT NULL,
  unique (id, name)
) ENGINE=InnoDB CHARACTER SET utf8;";
$statement = $db->prepare($query);
if($statement->execute())
    echo json_encode(array("message" => "Table games_list created successfully"));

$query = "INSERT INTO `games_list`(`name`, `price`) VALUES 
('Fallout', 1.99),
('Don`t Starve', 2.99),
('Baldur`s Gate', 3.99),
('Icewind Dale', 4.99),
('Bloodborne', 5.99)";
$statement = $db->prepare($query);
try {
    if($statement->execute())
        echo json_encode(array('message' => 'Basic games added.'));
} catch(PDOException $exception) {
    $error = $exception->errorInfo;
    if ($error[1] == 1062)
        echo json_encode(array('message' => 'This name of games already exists.'));
    echo json_encode(array('error' => $statement->errorInfo()));
    die();
}
