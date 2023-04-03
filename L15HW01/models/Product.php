<?php
error_reporting(-1);
class Product {
	private $connection;
	private $tableName = 'products';

	public function __construct($con) {
		$this->connection = $con;
	}

	public function read($id = null) {
		$sql = "SELECT id, id_brand, id_type_product, model, price, old_price, status, keywords, description, id_category, about, img, hit, created_at FROM ".$this->tableName;
		
			if (!empty($id)) {
			$sql.= " WHERE id = :id";
		}
		$res = $this->connection->prepare($sql);
		$res->bindParam(":id", $id, PDO::PARAM_INT);
		$res->execute();
		return $res->fetchAll();
	}

	public function insert($brand, $type_product, $model, $price, 
							$old_price, $status, $keywords, $description, 
							$category, $about, $img, $hit) {
		$brand = htmlspecialchars(strip_tags($brand));
		$type_product = htmlspecialchars(strip_tags($type_product));
		$model = htmlspecialchars(strip_tags($model));
		$price = htmlspecialchars(strip_tags(number_format((float)$price, 2)));
		$old_price = htmlspecialchars(strip_tags(number_format((float)$old_price, 2)));
		$status = htmlspecialchars(strip_tags($status));
		$keywords = htmlspecialchars(strip_tags($keywords));
		$description = htmlspecialchars(strip_tags($description));
		$category = htmlspecialchars(strip_tags($category));
		$about = htmlspecialchars(strip_tags($about));
		$img = htmlspecialchars(strip_tags($img));
		$hit = htmlspecialchars(strip_tags($hit));

	$sql = "INSERT INTO ".$this->tableName.
		" (id_brand, id_type_product, model, price, 
		old_price, status, keywords, description, id_category, 
		about, img, hit) 
		VALUES 
		(:brand, :type_product, :model, :price, 
		:old_price, :status, :keywords, :description, :category,
		:about, :img, :hit)";

	$res = $this->connection->prepare($sql);
	
	$res->bindParam(':brand', $brand, PDO::PARAM_INT);
	$res->bindParam(':type_product', $type_product, PDO::PARAM_INT);
	$res->bindParam(':model', $model, PDO::PARAM_STR);
	$res->bindParam(':price', $price, PDO::PARAM_INT);
	$res->bindParam(':old_price', $old_price, PDO::PARAM_INT);
	$res->bindParam(':status', $status, PDO::PARAM_INT);
	$res->bindParam(':keywords', $keywords, PDO::PARAM_STR);
	$res->bindParam(':description', $description, PDO::PARAM_STR);
	$res->bindParam(':category', $category, PDO::PARAM_INT);
	$res->bindParam(':about', $about, PDO::PARAM_STR);
	$res->bindParam(':img', $img, PDO::PARAM_STR);
	$res->bindParam(':hit', $hit, PDO::PARAM_INT);

	if ($res->execute())
        {
            return true;
        } 
		// var_dump($res->execute());
        return false;
	}

	public function update($id, $brand, $type_product, $model, $price, 
							$old_price, $status, $keywords, $description, 
							$category, $about, $img, $hit) {
		$brand = htmlspecialchars(strip_tags($brand));
		$type_product = htmlspecialchars(strip_tags($type_product));
		$model = htmlspecialchars(strip_tags($model));
		$price = htmlspecialchars(strip_tags(number_format((float)$price, 2)));
		$old_price = htmlspecialchars(strip_tags(number_format((float)$old_price, 2)));
		$status = htmlspecialchars(strip_tags($status));
		$keywords = htmlspecialchars(strip_tags($keywords));
		$description = htmlspecialchars(strip_tags($description));
		$category = htmlspecialchars(strip_tags($category));
		$about = htmlspecialchars(strip_tags($about));
		$img = htmlspecialchars(strip_tags($img));
		$hit = htmlspecialchars(strip_tags($hit));

	$sql = "UPDATE ".$this->tableName.
		" SET id_brand = :brand, 
		id_type_product = :type_product,
		model = :model, 
		price = :price, 
		old_price = :old_price,
		status = :status, 
		keywords = :keywords, 
		description = :description, 
		id_category = :category, 
		about = :about, 
		img = :img, 
		hit = :hit 
		WHERE id = :id";

	$res = $this->connection->prepare($sql);
	
	$res->bindParam(':id', $id, PDO::PARAM_INT);
	$res->bindParam(':brand', $brand, PDO::PARAM_INT);
	$res->bindParam(':type_product', $type_product, PDO::PARAM_INT);
	$res->bindParam(':model', $model, PDO::PARAM_STR);
	$res->bindParam(':price', $price, PDO::PARAM_STR);
	$res->bindParam(':old_price', $old_price, PDO::PARAM_STR);
	$res->bindParam(':status', $status, PDO::PARAM_INT);
	$res->bindParam(':keywords', $keywords, PDO::PARAM_STR);
	$res->bindParam(':description', $description, PDO::PARAM_STR);
	$res->bindParam(':category', $category, PDO::PARAM_INT);
	$res->bindParam(':about', $about, PDO::PARAM_STR);
	$res->bindParam(':img', $img, PDO::PARAM_STR);
	$res->bindParam(':hit', $hit, PDO::PARAM_INT);

	if ($res->execute())
        {
        	return true;
        } return false;
	}

	public function delete($id) {
		$id = htmlspecialchars(strip_tags($id));
		
	$sql = "DELETE FROM ".$this->tableName.
		" WHERE id = :id";

	$res = $this->connection->prepare($sql);
	
	$res->bindParam(':id', $id, PDO::PARAM_INT);

	if ($res->execute())
        {
        	return true;
        } return false;
	}
}