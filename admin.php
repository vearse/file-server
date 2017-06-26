<?php 
if (isset($_SESSION['login'])!="") {
 	header("Location: admin/index.php");
}
	$title = 'Admin Login'; $msg = '';
	require 'inc/header.php';
	if (isset($_GET['login'])) {
		if ($_GET['reg'] == 'success') {
			$msg = 'Registration successfull you can now login';
		}
}
	if (isset($_POST['submit'])) {
		if (isset( $_POST['login']) && $_POST['password']) {
			$login = strip_tags($_POST['login']) ;
			$password = strip_tags($_POST['password']);

			$login = $conn->real_escape_string($login);
			$password = $conn->real_escape_string($password);

			$sql =  "SELECT login,password FROM admin WHERE login='$login'";
			$result = $conn->query($sql);
			if ($result) {
				$row =  $result->fetch_array();
				$count= $result->num_rows;
							//verify password
			if (password_verify($password,$row['password']) && $count==1) {
				$msg =  "The password is correct";
				$_SESSION['login'] = $row['login'];
				header('Location: admin/');
			} else {
				$msg = 'Input correct login and password';
				}
			}else{
				$msg = 'There is a problem loging in';
			}
		}
		
	}
 ?>

 <form action="admin.php" method="post" id="login">
 	<legend><h2>ADMIN LOGIN</h2></legend>
 	 <div class="msg"><h4 class="bg-danger"><?php echo $msg; ?></h4></div>
 	<div class="form-inline">
 		<label>login</label>
 		<input type="text" name="login" required="require">
 	</div>
 	 <div class="form-inline">
 		<label>Password</label>
 		<input type="password" name="password" required="require">
 	</div>
 	<div class="form-submit">
 		<input type="submit" name="submit" value="Submit">
 	</div>
 </form>