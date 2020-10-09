<?php


class Game
{
    //db config
    private $conn;
    private $table = "games_list";
    protected $game_id;

    //game properties
    public $id;
    public $name;
    public $price;
    public $hide;

    public function __construct(PDO $db, int $requested_id = 0)
    {
        $this->conn = $db;
        $requested_id > 0 ? $this->game_id = $requested_id : 0;
    }

    public function read(){
        if($this->game_id > 0){
            $query = 'SELECT id, name, price FROM '. $this->table. ' WHERE hide <> 1 AND id = '.addslashes($this->game_id);
        } elseif($this->game_id == 0) {
            $query = 'SELECT id, name, price FROM '. $this->table. ' WHERE hide <> 1';
        } else {
            echo json_encode(array('error' => 'error in id field: wrong value'));
            die();
        }

        $statement = $this->conn->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function create(){
        $query = 'INSERT INTO '. $this->table .' SET name = :name, price = :price';

        $this->name  = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':price', $this->price);

        try {
            if($statement->execute())
                return true;
        } catch(PDOException $exception) {
            $error = $exception->errorInfo;
            if ($error[1] == 1062)
                echo json_encode(array('error' => 'This name of game already exists.'));
            die();
        }

        echo json_encode(array('error' => 'error when trying to create new record'));
        return false;
    }

    public function update(){
        $query = 'UPDATE '. $this->table .' 
                SET name = :name, price = :price 
                WHERE id=:id';

        $this->name  = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':price', $this->price);
        $statement->bindParam(':id', $this->id);

        try {
            if($statement->execute())
                return true;
        } catch(PDOException $exception) {
            $error = $exception->errorInfo;
            if ($error[1] == 1062)
                echo json_encode(array('error' => 'This name of game already exists.'));
            echo json_encode(array('error' => $statement->errorInfo()));
            die();
        }
    }

}