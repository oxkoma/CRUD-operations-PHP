<?php

require_once('config/Database.php');
require_once('models/TypeProduct.php');

$database = new Database();
$type_product = new TypeProduct($database->getConnection());

if (!empty($_POST)) {
	if (isset($_POST['btn'])) {
		if ($_POST['btn'] == 'insert') {
			//add
			
			if ($type_product->insert($_POST['title'], $_POST['img'], $_POST['description'])) {
				header("Location: typeproduct_list.php");
				exit;	
			}
		}
		if ($_POST['btn']== 'edit') {
			// var_dump($_POST);
			// die();
			if ($type_product->update($_POST['id'], $_POST['title'], $_POST['img'], $_POST['description'])) {
				header("Location: typeproduct_list.php");
				exit;	
			}
		}
	}
}
if(!empty($_GET)) {
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
			$item = $type_product->read($_GET['id']);

			$id = $item[0]['id'];
			$title = $item[0]['title'];
			$img = $item[0]['img'];
			$description = $item[0]['description'];
		}
		if ($_GET['action'] == 'del' && isset($_GET['id'])) {
			if ($type_product->delete($_GET['id'])) {
				header("Location: typeproduct_list.php");
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
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="title" type="text" class="validate" 
		  name="title" value="<?=isset($title)?$title:''?>">
          <label for="title">title</label>
        </div>
        <div class="input-field col s6">
          <input id="img" type="text" class="validate" 
		  name="img" value="<?=isset($img)?$img:''?>">
          <label for="img">img</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="description" type="text" 
		  class="validate" name="description" value="<?=isset($description)?$description:''?>">
          <label for="description">description</label>
        </div>
      </div>
	  <input type="hidden" name="id" value="<?=isset($id)?$id:''?>">
	  <button class="btn waves-effect waves-light" type="submit" name="btn" value="<?=($_GET['action']=='insert'?'insert':'edit')?>"><?=$_GET['action']=='insert'?'Сохранить':'Обновить'?>
  </button>
    </form>
  </div>
      
  
  <?php include_once('views/footer.php'); ?>