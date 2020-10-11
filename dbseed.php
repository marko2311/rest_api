<?php

require 'bootstrap.php';

$query = "CREATE TABLE IF NOT EXISTS `games_list` (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL UNIQUE,
  price DOUBLE (10,2) NOT NULL,
  unique (id, name)
) ENGINE=InnoDB CHARACTER SET utf8;";
if($dbConnection->exec($query))
    echo json_encode(array("message" => "Table games_list created successfully"));

$query = "INSERT INTO `games_list`(`name`, `price`) VALUES 
('Fallout', 1.99),
('Don`t Starve', 2.99),
('Baldur`s Gate', 3.99),
('Icewind Dale', 4.99),
('Bloodborne', 5.99)";
try {
    $dbConnection->exec($query);

} catch (\PDOException $e) {
    exit($e->getMessage());
}
echo json_encode(array("message" => "dbseed created successfully!"));
