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

$brands = $brand->read();
$type_products = $type_product->read();
$categories = $category->read();

if (!empty($_POST)) {
	if (isset($_POST['btn'])) {
		if ($_POST['btn'] == 'insert') {
			//add
			if ($product->insert($_POST['id_brand'], 
								$_POST['id_type_product'],
								$_POST['model'], 
								$_POST['price'],
								$_POST['old_price'], 
								$_POST['status'],
								$_POST['keywords'], 
								$_POST['description'],
								$_POST['id_category'], 
								$_POST['about'],
								$_POST['img'], 
								$_POST['hit'])) {			
				header("Location: product_list.php");
				exit;							
			}
		}
		if ($_POST['btn'] == 'edit') {
			//update
			// var_dump($_POST['id']);
			// die();
			if ($product->update($_POST['id'],
								$_POST['id_brand'], 
								$_POST['id_type_product'],
								$_POST['model'], 
								$_POST['price'],
								$_POST['old_price'], 
								$_POST['status'],
								$_POST['keywords'], 
								$_POST['description'],
								$_POST['id_category'], 
								$_POST['about'],
								$_POST['img'], 
								$_POST['hit'])) {	
			
				header("Location: product_list.php");
				exit;	
			}
		}
	}
}

if (!empty($_GET)) {
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
			$item = $product->read($_GET['id']);

			$id_brand = $item[0]['id_brand'];
			$id_type_product = $item[0]['id_type_product'];
			$model = $item[0]['model'];
			$price = $item[0]['price'];
			$old_price = $item[0]['old_price'];
			$status = $item[0]['status'];
			$keywords = $item[0]['keywords'];
			$description = $item[0]['description'];
			$id_category = $item[0]['id_category'];
			$about = $item[0]['about'];
			$img = $item[0]['img'];
			$hit = $item[0]['hit'];
			$id = $item[0]['id'];
		}
		if ($_GET['action'] == 'del' && isset($_GET['id'])) {
			if ($product->delete($_GET['id'])) {
				header("Location: product_list.php");
				exit;	
			}
		}
	}
}

?>
	<?php include_once('views/header.php'); ?>
    <?php include_once('views/navbar.php'); ?>
	<h1><?=$_GET['action'] == 'insert'?'Create':'Edit'?></h1>

<div class="row">
    <form class="col s12" method="POST">
    	<div class="col s6">
			<label>Brand Select</label>
			<select class="browser-default"  name="id_brand">
				<option value="" disabled selected>Choose your option</option>
				<?php foreach($brands as $item):?>
					<option value="<?=$item['id']?>"
					<?=isset($id_brand) && $id_brand==$item['id']?'selected':''?>>	
							<?=$item['title']?>
					</option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="col s6">
			<label>Type product Select</label>
			<select class="browser-default" name="id_type_product">
				<option value="" disabled selected>Choose your option</option>
				<?php foreach($type_products as $item):?>
					<option value="<?=$item['id']?>"
					<?=isset($id_type_product) && $id_type_product==$item['id']?'selected':''?>>
								<?=$item['title']?>
					</option>
				<?php endforeach;?>
			</select>
		</div>
        <div class="input-field col s6">
          <input id="model" type="text" class="validate"
		  name="model" value="<?=isset($model)?$model:''?>">
          <label for="model">model</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="price" type="text" class="validate"
		  name="price" value="<?=isset($price)?$price:''?>">
          <label for="price">price</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12">
          <input id="old_price" type="text" class="validate"
		  name="old_price" value="<?=isset($old_price)?$old_price:''?>">
          <label for="old_price">old price</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12">
          <input id="status" type="text" class="validate"
		  name="status" value="<?=isset($status)?$status:''?>">
          <label for="status">status</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12">
          <input id="keywords" type="text" class="validate"
		  name="keywords" value="<?=isset($keywords)?$keywords:''?>">
          <label for="keywords">keywords</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12">
          <input id="description" type="text" class="validate"
		  name="description" value="<?=isset($description)?$description:''?>">
          <label for="description">description</label>
        </div>
      </div>
	  <div class="col s6">
			<label>Category Select</label>
			<select class="browser-default" name="id_category">
				<option value="" disabled selected>Choose your option</option>
				<?php foreach($categories as $item):?>
					<option value="<?=$item['id']?>"
					<?=isset($id_category) && $id_category==$item['id']?'selected':''?>>
								<?=$item['title']?>
					</option>
				<?php endforeach;?>
			</select>
		</div>
	 	<div class="row">
        <div class="input-field col s12">
          <input id="about" type="text" class="validate"
		  name="about" value="<?=isset($about)?$about:''?>">
          <label for="about">about</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12">
          <input id="img" type="text" class="validate"
		  name="img" value="<?=isset($img)?$img:''?>">
          <label for="img">img</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12">
          <input id="hit" type="text" class="validate"
		  name="hit" value="<?=isset($hit)?$hit:''?>">
          <label for="hit">hit</label>
        </div>
      </div>
	  <input type="hidden" name="id" value="<?=isset($id)?$id:''?>">
	  <button class="btn waves-effect waves-light" type="submit" name="btn" value="<?=($_GET['action']=='insert'?'insert':'edit')?>"><?=$_GET['action']=='insert'?'Сохранить':'Обновить'?>
    </form>
  </div>
        

  <?php include_once('views/footer.php'); ?>