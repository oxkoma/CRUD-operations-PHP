<?php

require_once('config/Database.php');
require_once('models/Category.php');

$database = new Database();
$category = new Category($database->getConnection());

$categories = $category->read();
?>
<?php include_once('views/header.php'); ?>
    <?php include_once('views/navbar.php'); ?>

<h1>Категории</h1>
    <a class="waves-effect waves-light btn" href="category_edit.php?action=insert">Добавить</a>
    <table>
        <thead>
          <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Keywords</th>
              <th>Description</th>
			  <th>Created at</th>
              <th></th>
              <th></th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($categories as $item): ?>  
          <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['title']?></td>
            <td><?=$item['keywords']?></td>
            <td><?=$item['description']?></td>
            <td><?=$item['created_at']?></td>
			<td><a 
                    class="waves-effect waves-light btn-small"
                    href="category_edit.php?action=edit&id=<?=$item['id']?>">
                    Edit
                </a>
        </td>
        <td><a 
                    class="waves-effect waves-light btn-small" 
                    href="category_edit.php?action=del&id=<?=$item['id']?>">
                    Del
                </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>


	<?php include_once('views/footer.php'); ?>