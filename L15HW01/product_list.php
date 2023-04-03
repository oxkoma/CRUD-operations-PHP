<?php
error_reporting(-1);
require_once ('config/Database.php');
require_once('models/Product.php');
require_once('models/Brand.php');
require_once('models/TypeProduct.php');
require_once('models/Category.php');



$db = new Database();
$product = new Product($db->getConnection());
$brand = new Brand($db->getConnection());
$type_product = new TypeProduct($db->getConnection());
$category = new Category($db->getConnection());

$products = $product->read();

?>

	<?php include_once('views/header.php'); ?>
    <?php include_once('views/navbar.php'); ?>
	<h1>Products</h1>
	<a class="waves-effect waves-light btn" href="product_edit.php?action=insert">Add</a>
	<table>
        <thead>
          <tr>
              <th>Id</th>
              <th>Brand</th>
              <th>Type product</th>
			  <th>Model</th>
              <th>Price</th>
              <th>Old price</th>
			  <th>Status</th>
              <th>Keywords</th>
              <th>Description</th>
			  <th>Category</th>
              <th>About</th>
              <th>Img</th>
			  <th>Hit</th>
              <th>Created at</th>
			  <th></th>
			  <th></th>
          </tr>
        </thead>

        <tbody>
			<?php foreach($products as $item): ?>
				
          <tr>
            <td><?=$item['id']?></td>	
			<td>
				<?php $brands=$brand->read($item['id_brand']);?>
				<?=$brands[0]["title"];?>
			</td>
            <td><?php $type_products=$type_product->read($item['id_type_product']);?>
				<?=$type_products[0]["title"];?>
			</td>
			<td><?=$item['model']?></td>
			<td><?=$item['price']?></td>
			<td><?=$item['old_price']?></td>
			<td><?=$item['status']?></td>
			<td><?=$item['keywords']?></td>
			<td><?=$item['description']?></td>
			
			<td>
				<?php $catesories=$category->read($item['id_category']);?>
				<?=$catesories[0]["title"];?>
			</td>
			<td><?=$item['about']?></td>
			<td><?=$item['img']?></td>
			<td><?=$item['hit']?></td>
			<td><?=$item['created_at']?></td>
			<td><a class="waves-effect waves-light btn" href="product_edit.php?action=edit&id=<?=$item['id']?>">Edit</a></td>
			<td><a class="waves-effect waves-light btn" href="product_edit.php?action=del&id=<?=$item['id']?>">Delete</a></td>
          </tr>
         <?php endforeach;?>
        </tbody>
      </table>
            
	<?php include_once('views/footer.php'); ?>

