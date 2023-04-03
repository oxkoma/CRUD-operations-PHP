<?php
error_reporting(-1);
require_once('config/Database.php');
require_once('models/Category.php');

$database = new Database();
$category = new Category($database->getConnection());

if (!empty($_POST)) {
	if (isset($_POST['btn'])) {
		if ($_POST['btn'] == 'insert') {
			// var_dump($_POST);
			// die();
			if ($category->insert($_POST['title'], $_POST['keywords'], $_POST['description'])) { 
				header("Location: category_list.php");
				exit;
			}
		}
		if ($_POST['btn'] == 'edit') {
			//update
			if ($category->update($_POST['id'], $_POST['title'],$_POST['keywords'],$_POST['description'] )) {
				header("Location: category_list.php");
				exit;
			}
		}
	}
}
	if (!empty($_GET)) {
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'del' && isset($_GET['id'])){
			//delete
				if ($category->delete($_GET['id'])) {
					header("Location: category_list.php");
					exit;
				}
			}
			if ($_GET['action'] == 'edit' && isset($_GET['id'])){
				$item=$category->read($_GET['id']);
				// var_dump($item[0]['id']);
				// die();

				if (isset($item)) {
					//update
					$title = $item[0]['title'];
					$keywords = $item[0]['keywords'];
					$description = $item[0]['description'];
					$id = $item[0]['id'];
				}
			}			
		}
	}
	
?>

	<?php include_once('views/header.php'); ?>
    <?php include_once('views/navbar.php'); ?>

	
	<h1><?=($_GET['action'] == 'insert'?'Создание':'Редактирование') ?></h1>
  <div class="row">
    <form class="col s12" method="POST">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="title" type="text" class="validate" name="title" value="<?=isset($title)?$title:''?>">
          <label for="title">Title</label>
        </div>
        <div class="input-field col s6">
          <input id="keywords" type="text" class="validate" name="keywords" value="<?=isset($keywords)?$keywords:''?>">
          <label for="keywords">keywords</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="description" type="text" class="validate" name="description" value="<?=isset($description)?$description:''?>">
          <label for="description">description</label>
        </div>
      </div>
     <input type="hidden" name="id" value="<?=isset($id)?$id:''?>">
      </div>
	  <button class="btn waves-effect waves-light" type="submit" name="btn"
	  value="<?=$_GET['action']=='insert'?'insert':'edit'?>"><?=$_GET['action']=='insert'?'Сохранить':'Обновить'?>
  </button>
    </form>
  </div>

  <?php include_once('views/footer.php'); ?>