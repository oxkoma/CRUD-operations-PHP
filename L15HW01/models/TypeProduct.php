<?php

class TypeProduct {
	private $connection;
	private $tableName = 'type_products';

	public function __construct($con) {
		$this->connection = $con;
	}

	public function read($id = null) {
		$sql = "SELECT id, title, img, description FROM ".$this->tableName;
		if (!empty($id)) {
			$sql.=" WHERE id = :id";
		}
		$res = $this->connection->prepare($sql);
		$res->bindParam(':id', $id, PDO::PARAM_INT);

		$res->execute();

		return $res->fetchAll();
	}

	public function insert($title, $img, $description) {
		$title = htmlspecialchars(strip_tags($title));
        $keywords = htmlspecialchars(strip_tags($keywords));
        $description = htmlspecialchars(strip_tags($description));

		$sql = "INSERT INTO ".$this->tableName. 
				" (title, img, description) 
				VALUES (:title, :img, :description)";
		$res = $this->connection->prepare($sql);
		$res->bindParam(":title", $title, PDO::PARAM_STR);
		$res->bindParam(":img", $img, PDO::PARAM_STR);
		$res->bindParam(":description", $description, PDO::PARAM_STR);
		if ($res->execute()) {
			return true;
		} return false;
	}

	public function update($id, $title, $img, $description) {
		$title = htmlspecialchars(strip_tags($title));
        $img = htmlspecialchars(strip_tags($img));
        $description = htmlspecialchars(strip_tags($description));

		$sql = "UPDATE ".$this->tableName. 
				" SET title = :title, img = :img, description = :description
				WHERE id = :id";
		$res = $this->connection->prepare($sql);
		$res->bindParam(":id", $id, PDO::PARAM_INT);
		$res->bindParam(":title", $title, PDO::PARAM_STR);
		$res->bindParam(":img", $img, PDO::PARAM_STR);
		$res->bindParam(":description", $description, PDO::PARAM_STR);
		if ($res->execute()) {
			return true;
		} return false;
	}

	public function delete($id) {
		$id = htmlspecialchars(strip_tags($id));
       
		$sql = "DELETE FROM ".$this->tableName. 
				" WHERE id = :id";
		$res = $this->connection->prepare($sql);
		$res->bindParam(":id", $id, PDO::PARAM_INT);
	
		if ($res->execute()) {
			return true;
		} return false;
	}
}