<?php
require_once('config/Database.php');
require_once('models/User.php');

$db = new Database();
$user = new User($db->getConnection());

$users = $user->read();

?>

<?php include_once('views/header.php')?>
<?php include_once('views/navbar.php')?>

<h1>User</h1>
<a class="waves-effect waves-light btn" href="user_edit.php?action=insert">Add</a>
<table>
        <thead>
          <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
			  <th>Role</th>
			  <th></th>
			  <th></th>
          </tr>
        </thead>

        <tbody>
			<?php foreach($users as $item):?>
          <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['name']?></td>
            <td><?=$item['email']?></td>
			<td><?=$item['role']?></td>
			<td>
			<a class="waves-effect waves-light btn" href="user_edit.php?action=edit&id=<?=$item['id']?>">Edit</a>
			<a class="waves-effect waves-light btn" href="user_edit.php?action=del&id=<?=$item['id']?>">Delete</a>
		</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>





<?php include_once('views/footer.php')?>
