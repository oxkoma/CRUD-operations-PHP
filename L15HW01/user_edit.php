<?php
require_once('config/Database.php');
require_once('models/User.php');

$db = new Database();
$user = new User($db->getConnection());

if (!empty($_POST)) {
	if (isset($_POST['btn'])){
		if ($_POST['btn'] == 'insert') {
			if (!empty($_POST['name']) && 
				!empty($_POST['email']) &&
				!empty($_POST['password'])) {
					//add
				if ($user->insert($_POST['name'], 
					$_POST['email'],
					$_POST['password'],
					$_POST['role'],
					$_POST['token'])) {
					header("Location: user_list.php");
					exit;
				}
			} echo 'Attention!';
		}
		if ($_POST['btn'] == 'edit') {
			if (!empty($_POST['name']) && 
				!empty($_POST['email']) &&
				!empty($_POST['password'])) {
				if ($user->update($_POST['id'],
					$_POST['name'], 
					$_POST['email'],
					$_POST['password'],
					$_POST['role'],
					$_POST['token'])) {
					header("Location: user_list.php");
					exit;
					}
			}
		}
	}
}
if (!empty($_GET)) {
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'del' && isset($_GET['id'])) {
			if ($user->delete($_GET['id'])) {
				header("Location: user_list.php");
				exit;
			}
		}
		if ($_GET['action'] == 'edit' && isset($_GET['id'])) {
			$item = $user->read($_GET['id']);
			$name = $item[0]['name'];
			$email = $item[0]['email'];
			$password = $item[0]['password'];
			$role = $item[0]['role'];
			$token = $item[0]['token'];
			$id = $item[0]['id'];
		}
	}
}


?>

<?php include_once('views/header.php')?>
<?php include_once('views/navbar.php')?>

<h1>Create User</h1>
<div class="row">
    <form class="col s12" method='POST'>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="name" 
		  type="text" name="name" class="validate"
		  value=<?=isset($name)?$name:''?>>
          <label for="name">User Name</label>
        </div>
        <div class="input-field col s6">
          <input id="email" type="email" class="validate" 
		  name="email" value=<?=isset($email)?$email:''?>>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password" type="password" class="validate"
		  name="password" value=<?=isset($password)?$password:''?>>
          <label for="password">Password</label>
        </div>
		<div class="input-field col s6">
          <input placeholder="Placeholder" id="role" 
		  type="text" name="role" class="validate"
		  value=<?=isset($role)?$role:''?>>
          <label for="role">Role</label>
        </div>
      </div>
	  <div class="row">
       	<div class="input-field col s6">
          <input placeholder="Placeholder" id="token" 
		  type="text" name="token" class="validate"
		  value=<?=isset($token)?$token:''?>>
          <label for="token">Remember token</label>
        </div>
		<input type="hidden" name="id" value="<?=isset($id)?$id:''?>">
      </div>
	  <button class="btn waves-effect waves-light" type="submit" name="btn" value="<?=($_GET['action']=='insert'?'insert':'edit')?>"><?=($_GET['action']=='insert'?'Добавить':'Обновить')?>
  </button>
    </form>
  </div>


<?php include_once('views/footer.php')?>