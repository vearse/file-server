<?php 
	$title = 'Login';
	$msg = '';
	require 'inc/header.php';
	
if (isset($_SESSION['username'])!="") {
 		header("Location: student/index.php"); 
	}
	if (isset($_POST['submit'])) {
		if (isset( $_POST['username']) && $_POST['password']) {
			$username = strip_tags($_POST['username']) ;
			$password = strip_tags($_POST['password']);

			$username = $conn->real_escape_string($username);
			$password = $conn->real_escape_string($password);

			$sql =  "SELECT username,password FROM student WHERE username='$username'";
			$result = $conn->query($sql);
			if ($result) {
				$row =  $result->fetch_array();
				$count= $result->num_rows;
							//verify password
			if (password_verify($password,$row['password']) && $count==1) {
				$_SESSION['username'] = $row['username'];
				header('Location: student/index.php?login=success');
			} else {
				$msg = 'Input correct username and password';
				}
			}
		}
		
	}else{
	if (isset($_GET['reg'])) {
		if ($_GET['reg'] == 'success') {
			$msg = 'Registration successfull you can now login';
		}
	}
}


	
 ?>

 <div class="msg"><h4 class="bg-danger"><?php echo $msg; ?></h4></div>
 <form method="post" action="login.php" id="login">
 	<legend><h2>Student LOGIN</h2></legend>
 	<div class="form-inline">
 		<label>USERNAME</label>
 		<input type="text" name="username" required="require">
 	</div>
 	 <div class="form-inline">
 		<label>Password</label>
 		<input type="password" name="password" required="require">
 	</div>
 	<div class="form-submit">
 		<input type="submit" name="submit" value="Submit">
 	</div>
 </form>

<?php require 'inc/footer.php' ?>