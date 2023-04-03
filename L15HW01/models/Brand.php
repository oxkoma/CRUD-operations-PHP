<?php
error_reporting(-1);
class Brand {
    private $connection;
    private $tableName = "brand";

    public function __construct($con){
        $this->connection = $con;
    }

    //Methods READ INSERT DELETE UPDATE

    public function read($id = null) {
        $query = "SELECT id, title, img, description FROM ".$this->tableName;
        if (!empty($id)) {
            $query.= "   WHERE id=:id";
        }

        $res = $this->connection->prepare($query);
        $res->bindParam(":id", $id, PDO::PARAM_INT);
        //$res->execute([':id' => $id]);
        $res->execute();

        return $res->fetchAll();
    }

    public function insert($title, $img, $description){
        $title = htmlspecialchars(strip_tags($title));
        $img = htmlspecialchars(strip_tags($img));
        $description = htmlspecialchars(strip_tags($description));

        $query = "INSERT INTO ".$this->tableName.
                    " (title, img, description) 
                        VALUES 
                        (:title, :img, :description)";
        $res = $this->connection->prepare($query);
        $res->bindParam(":title", $title, PDO::PARAM_STR);
        $res->bindParam(":img", $img, PDO::PARAM_STR);
        $res->bindParam(":description", $description, PDO::PARAM_STR);

        if ($res->execute())
        {
            return true;
        }

        return false;
    }

    public function delete($id){
        $id = htmlspecialchars(strip_tags($id));

        $query = "DELETE FROM ".$this->tableName.
                    " WHERE id=:id";
        $res = $this->connection->prepare($query);
        $res->bindParam(":id", $id, PDO::PARAM_INT);

        if ($res->execute())
        {
            return true;
        }

        return false;
    }

    public function update($id, $title, $img, $description){
        $title = htmlspecialchars(strip_tags($title));
        $img = htmlspecialchars(strip_tags($img));
        $description = htmlspecialchars(strip_tags($description));

        $query = "UPDATE  ".$this->tableName.
                    " SET title = :title, img = :img,  description = :description
                        WHERE id = :id ";
        $res = $this->connection->prepare($query);
        $res->bindParam(":id", $id, PDO::PARAM_INT);
        $res->bindParam(":title", $title, PDO::PARAM_STR);
        $res->bindParam(":img", $img, PDO::PARAM_STR);
        $res->bindParam(":description", $description, PDO::PARAM_STR);

        if ($res->execute())
        {
            return true;
        }

        return false;
    }
}