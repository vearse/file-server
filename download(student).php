<?php 
$msg = '';
require_once '../config/db.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	 $query = "SELECT file_name type,size,content FROM upload WHERE id=".$id ;
 	 $result = $conn->query($query) or die('Query Failed') ;

	if ($row = $result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		//$name = $row['name'];
		$type = $row['type'];
		$size = $row['size'];
		$content = $row['content'];
		list($file_name,$type,$size,$content) = $result->fetch_assoc();
		header("Content-length: file_size($size)");
		header("Content-type: $type");
		header("Content-Disposition: attachment; filename= $file_name ");
		echo $content;
		exit();
		}}
	}