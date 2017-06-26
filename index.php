<?php 
	$title = "Registeration";
	$msg ='';
	require 'inc/header.php';
//session_start();
if (isset($_SESSION['username'])!="") {
 		header("Location: student/index.php"); 
	}
	// registeration process
	if(isset($_POST['submit'])){
		if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['username']) &&isset($_POST['pass1']) ) {
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$username = $_POST['username']; 
			if (($_POST['pass1'] != $_POST['pass2'])) {
				$error = 'Your confirm password did not  matched';
				echo '<p class="bg-danger">'.$error.'</p>';

			}else{
				# confirm password
				$pass = $_POST['pass1'];
				//register to db
				$fname =$conn->real_escape_string($fname);
				$lname =$conn->real_escape_string($lname);
				$email =$conn->real_escape_string($email);
				$username =$conn->real_escape_string($username);
				$pass =$conn->real_escape_string($pass);
				$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
				//check if email exist
				$check_email = $conn->query("SELECT email FROM student WHERE email='$email'");
				$count = $check_email->num_rows;
				$check_username = $conn->query("SELECT username FROM student WHERE username='$username'");
				$count = $check_username->num_rows;
				$msg = 'This email and password is already used by another user';
				if ($count== 0) {
					//insert the data
				$query ="INSERT INTO student(first_name, last_name, email, username, password) 
				VALUES ('$fname','$lname','$email','$username','$hash_pass')";
					
				$result = $conn->query($query);

				if ($result) {
				header('Location: login.php?reg=success');
					}
				}
				
			}
		}
	}
 ?>
<form id="register" method="post" action="index.php">

	<legend> REGISTER YOUR PROFILE</legend>
	<div class="msg"><h4><?php echo $msg; ?></h4></div>
	<div class="form-inline">
		<label>FIRST NAME</label>
		<input type="text" required="require" name="fname" placeholder="FIRST NAME" >
		<label>LAST NAME</label>
		<input type="text" required="require" name="lname" placeholder="LAST NAME">
	</div>
	<div class="form-inline">
		<label>Email</label>
		<input type="email" required="require" name="email" placeholder="you@mail.com">
	</div>
		<div class="form-inline">
		<label>USERNAME</label>
		<input type="text" required="require" name="username" placeholder="username">
	</div>
	<div class="form-inline">
		<label>Password</label>
		<input type="password" required="require" name="pass1">
	</div>
	<div class="form-inline">
		<label>Confirm Password</label>
		<input type="password" required="require" name="pass2">
	</div>
	<div class="form-submit">
		<input type="submit" value="Register" name="submit">
	</div>
	
</form>

<?php require 'inc/footer.php' ?>