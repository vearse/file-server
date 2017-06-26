<?php
require_once '../config/db.php';
$msg = '';

if (!isset($_SESSION['username'])) {
	header('Location: ../login.php');
}
?>

<!DOCTYPE html>
 <html>
 <head>
 	<title>WELCOME</title>
 	<link rel="stylesheet" type="text/css" href="../css/styles.css">
 </head>
 <body id="main">
 	<nav class="nav-main">
		<div class="logo">FILE SERVER</div>
		<div class="right">
		<ul class="nav-link ">
 		
			<li class="nav-item"><a href="logout.php?logout">LOG OUT</a></li>
		</ul>
		</div>		
 	</nav>