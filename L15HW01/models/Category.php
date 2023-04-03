<?php
error_reporting(-1);

class Category {
	private $connection;
	private $tableName = 'categories';

	public function __construct($con) {
		$this->connection = $con;
	}

	public function read($id = null) {
		$sql = 'SELECT id, title, keywords, description, created_at FROM '.$this->tableName;
		if (!empty($id)) {
			$sql.= ' WHERE id = :id';
		}

		$res = $this->connection->prepare($sql);
		$res->bindParam(':id', $id, PDO::PARAM_INT);
		$res->execute();
		return $res->fetchAll();
	}

	public function insert($title, $keywords, $description) {
		$title = htmlspecialchars(strip_tags($title));
        $keywords = htmlspecialchars(strip_tags($keywords));
        $description = htmlspecialchars(strip_tags($description));

		$sql = "INSERT INTO ".$this->tableName.
			" (title, keywords, description) 
			VALUES 
			(:title, :keywords, :description)";

		$res = $this->connection->prepare($sql);
		$res->bindParam(':title', $title, PDO::PARAM_STR);
		$res->bindParam(':keywords', $keywords, PDO::PARAM_STR);
		$res->bindParam(':description', $description, PDO::PARAM_STR);
		if ($res->execute()) {
			return true;
		} return false;
	}

	public function delete($id) {
		$id = htmlspecialchars(strip_tags($id));
        
		$sql = "DELETE FROM ".$this->tableName.
			" WHERE id=:id";

		$res = $this->connection->prepare($sql);
		$res->bindParam(':id', $id, PDO::PARAM_INT);

		if ($res->execute()) {
			return true;
		} return false;
	}
	public function update($id, $title, $keywords, $description) {
		$title = htmlspecialchars(strip_tags($title));
        $keywords = htmlspecialchars(strip_tags($keywords));
        $description = htmlspecialchars(strip_tags($description));

		$sql = "UPDATE ".$this->tableName.
			" SET title = :title, keywords = :keywords , description = :description
			WHERE id = :id";

		$res = $this->connection->prepare($sql);
		$res->bindParam(':id', $id, PDO::PARAM_INT);
		$res->bindParam(':title', $title, PDO::PARAM_STR);
		$res->bindParam(':keywords', $keywords, PDO::PARAM_STR);
		$res->bindParam(':description', $description, PDO::PARAM_STR);
		if ($res->execute()) {
			return true;
		} return false;
	}

}