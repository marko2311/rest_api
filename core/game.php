<?php


class Game
{
    //db config
    private $conn;
    private $table = "games_list";

    //post properties
    public $id;
    public $name;
    public $price;
    public $hide;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT id, name, price FROM '. $this->table. ' WHERE hide <> 1';
        ECHO $query;
        $statement = $this->conn->prepare($query);
        $statement->execute();

        return $statement;
    }
}
