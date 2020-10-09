<?php


class Game
{
    //db config
    private $conn;
    private $table = "games_list";
    protected $game_id = 0;

    //game properties
    public $id;
    public $name;
    public $price;
    public $hide;

    public function __construct(PDO $db, int $requested_id = 0)
    {
        $this->conn = $db;
        $requested_id > 0 ? $this->game_id = $requested_id : null;

    }

    public function read(){
        if($this->game_id > 0){
            $query = 'SELECT id, name, price FROM '. $this->table. ' WHERE hide <> 1 AND id = '.addslashes($this->game_id);
        } elseif($this->game_id === 0) {
            $query = 'SELECT id, name, price FROM '. $this->table. ' WHERE hide <> 1';
        } else {
            die();
        }

        $statement = $this->conn->prepare($query);
        $statement->execute();

        return $statement;
    }

}
