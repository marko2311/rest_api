<?php

namespace Api\TableGateways;

class GameGateway
{
    //db config
    private $db;
    private $table = "games_list";

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll(){

        $query = 'SELECT 
                        id, name, price 
                  FROM 
                  '. $this->table;
        try {
            $statement = $this->db->query($query);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        return $statement;
    }

    public function find($id)
    {
        $statement = "
            SELECT 
                id, name, price 
            FROM
                " . $this->table . "
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $input)
    {
        $query = "
            INSERT INTO " . $this->table . " 
                (name, price)
            VALUES
                (:name, :price);
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array(
                'name'  => $input['name'],
                'price' => $input['price']
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update($id, Array $input)
    {
        $exec_array = array(
            'id' => (int) $id
        );
        $query_name = "";
        if(isset($input['name'])){
            $exec_array['name'] = $input['name'];
            $query_name = "name = :name";
        }
        $query_price = "";
        if(isset($input['price'])){
            $exec_array['price'] = $input['price'];
            $query_price = "price = :price";
        }
        $comma = (!isset($input['name']) || !isset($input['name'])) ? "" : ", ";

        $query = "
            UPDATE " . $this->table . "
            SET 
                $query_name$comma
                $query_price
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute($exec_array);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $query = "
            DELETE FROM " . $this->table . "
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

}
