<?php

class User {
	private $connection;
	private $tableName = 'users';

	public function __construct($con) {
		$this->connection = $con;
	}

	public function read($id=null) {
		$query = "SELECT id, name, email, email_verified_at, password, role, 
		remember_token FROM ".$this->tableName;
		if (!empty($id)) {
			$query.= " WHERE id = :id";
		}
		$res = $this->connection->prepare($query);
		$res->bindParam(':id', $id, PDO::PARAM_INT);
		$res->execute();
		return $res->fetchAll();
	}

	public function insert($name, $email, $password, $role, $token) {
		$name = htmlspecialchars(strip_tags($name));
		$email = htmlspecialchars(strip_tags($email));
		$password = htmlspecialchars(strip_tags($password));
		$role = htmlspecialchars(strip_tags($role));
		$token = htmlspecialchars(strip_tags($token));
		$query = "INSERT INTO "	.$this->tableName. 
		" (name, email, password, role, remember_token)
		VALUES (:name, :email, :password, :role, :token)";
	
		$res = $this->connection->prepare($query);
		$res->bindParam(':name', $name, PDO::PARAM_STR);
		$res->bindParam(':email', $email, PDO::PARAM_STR);
		$res->bindParam(':password', $password, PDO::PARAM_STR);
		$res->bindParam(':role', $role, PDO::PARAM_STR);
		$res->bindParam(':token', $token, PDO::PARAM_STR);
	
		if ($res->execute()) {
			return true;
		} return false;
	}

	public function delete($id) {
		$query = "DELETE FROM ".$this->tableName." WHERE id = :id";
		$res = $this->connection->prepare($query);
		$res->bindParam(':id', $id, PDO::PARAM_INT);
		if ($res->execute()) {
			return true;
		} return false;
	}

	public function update($id, $name, $email, 
						$password, $role, $token) {

		$name = htmlspecialchars(strip_tags($name));
		$email = htmlspecialchars(strip_tags($email));
		$password = htmlspecialchars(strip_tags($password));
		$role = htmlspecialchars(strip_tags($role));
		$token = htmlspecialchars(strip_tags($token));
		
		$query = "UPDATE ".$this->tableName.
				" SET name = :name, email = :email, 
				password = :password, role = :role, 
				remember_token = :token WHERE id = :id";
		$res = $this->connection->prepare($query);
		$res->bindParam(':id', $id, PDO::PARAM_INT);
		$res->bindParam(':name', $name, PDO::PARAM_STR);
		$res->bindParam(':email', $email, PDO::PARAM_STR);
		$res->bindParam(':password', $password, PDO::PARAM_STR);
		$res->bindParam(':role', $role, PDO::PARAM_STR);
		$res->bindParam(':token', $token, PDO::PARAM_STR);
			
			if ($res->execute()) {
				return true;
			} return false;
	}
}