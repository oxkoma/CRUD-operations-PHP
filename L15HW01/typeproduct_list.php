<?php

require_once('config/Database.php');
require_once('models/TypeProduct.php');

$database = new Database();
$type_product = new TypeProduct($database->getConnection());

$type_products = $type_product->read();


?>
	<?php include_once('views/header.php'); ?>
    <?php include_once('views/navbar.php'); ?>

	<h1>Type Products</h1>
	<a class="waves-effect waves-light btn" href="typeproduct_edit.php?action=insert">Add</a>
	<table>
	<thead>
          <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Img</th>
			  <th>Description</th>
			  <th></th>
			  <th></th>
          </tr>
        </thead>

        <tbody>
			<?php foreach($type_products as $item):?>
          <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['title']?></td>
            <td><?=$item['img']?></td>
			<td><?=$item['description']?></td>
			<td><a class="waves-effect waves-light btn" href="typeproduct_edit.php?action=edit&id=<?=$item['id']?>">Edit</a></td>
			<td><a class="waves-effect waves-light btn" href="typeproduct_edit.php?action=del&id=<?=$item['id']?>">Delete</a></td>
		</tr>
         <?php endforeach;?>
        </tbody>
</table>

<?php include_once('views/footer.php'); ?>