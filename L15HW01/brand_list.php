<?php

require_once('config/Database.php');
require_once('models/Brand.php');


$database = new Database();
$brand = new Brand($database->getConnection());

//получить список брендов
$brands = $brand->read();
?>
    <?php include_once('views/header.php'); ?>
    <?php include_once('views/navbar.php'); ?>

    <h1>Бренды</h1>
    <a class="waves-effect waves-light btn" href="brand_edit.php?action=insert">Добавить</a>
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
          <?php foreach($brands as $item): ?>  
          <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['title']?></td>
            <td><?=$item['img']?></td>
            <td><?=$item['description']?></td>
            <td><a 
                    class="waves-effect waves-light btn-small"
                    href="brand_edit.php?action=edit&id=<?=$item['id']?>">
                    Edit
                </a>
        </td>
        <td><a 
                    class="waves-effect waves-light btn-small" 
                    href="brand_edit.php?action=del&id=<?=$item['id']?>">
                    Del
                </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    <?php include_once('views/footer.php'); ?>