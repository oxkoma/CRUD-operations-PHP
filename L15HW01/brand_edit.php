<?php
    require_once('config/Database.php');
    require_once('models/Brand.php');
    
    
    $database = new Database();
    $brand = new Brand($database->getConnection());

    if (!empty($_POST)) {
        if (isset($_POST['btn'])){
            if ($_POST['btn'] == "insert") {
                //Add
                //var_dump($_POST);
                //die();

                if ($brand->insert($_POST['title'], $_POST['img'], $_POST['description'])) {
                    header("Location: brand_list.php");
                    exit;
                }
            }
            if ($_POST['btn'] == "edit") {
                //update
                //$brand->update()
                if ($brand->update($_POST['id'], $_POST['title'], $_POST['img'], $_POST['description'])) {
                    header("Location: brand_list.php");
                    exit;
                }
            }
        }
    }

    if (!empty($_GET)) {
        if (isset($_GET['action'])){
            if ($_GET['action'] == "del"){
                //delete
                //$brand->delete
                if ($brand->delete($_GET['id'])){
                    header("Location: brand_list.php");
                    exit;
                }
            }

            if ($_GET['action'] == "edit" && isset($_GET['id'])) {
                $item = $brand->read($_GET['id']); ///проверка

                //var_dump($item);
                //die();

                $title = $item[0]['title'];
                $img = $item[0]['img'];
                $description = $item[0]['description'];
                $id = $item[0]['id'];
            }
        }
    }

?>
    <?php include_once('views/header.php'); ?>
    <?php include_once('views/navbar.php'); ?>

    <h1><?=($_GET['action'] =="insert"?"Создание":"Редактирование") ?></h1>
    <div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="title" type="text" class="validate" name="title" 
                value="<?=isset($title)?$title:''?>"
          >
          <label for="title">Title</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" name="img"
                value="<?=isset($img)?$img:''?>"
          >
          <label for="last_name">Img</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input  id="description" type="text" class="validate" name="description"
                value="<?=isset($description)?$description:''?>"
          >
          <label for="description">Description</label>
        </div>
      </div>

      <input type="hidden" name="id" value="<?=isset($id)?$id:''?>">
     
      <button class="btn waves-effect waves-light" type="submit" name="btn" 
              value="<?=$_GET['action']=='insert'?"insert":"edit"?>"
            >
            Сохранить
      </button>
    </form>
  </div>

    <?php include_once('views/footer.php'); ?>