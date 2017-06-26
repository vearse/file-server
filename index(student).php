<?php 

require_once 'header.php';
$level = 100;

if (isset($_GET['submit'])) {
	if ($_GET['level']) {
		$level = $_GET['level'];
		}
	}
 ?>
 
<div id="page">
<div class="msg"><h4 class="bg-danger"><?php echo $msg; ?></h4></div>
	<div class="question_type">
		<form method="get" action="">		
	<div class="form-tb">
		<label>Level</label>
		<select name="level">
			<option value="100">100L</option>
			<option value="200">200L</option>
			<option value="300">300L</option>
		</select>
		<input type="submit" value="Go" name="submit">
	</div>
		
		
		</form>
	</div>
	<div id="files">
	<header><b><?php echo "These are $level level information" ; ?></b></header>
	<?php 
			$query = "SELECT * FROM upload WHERE level=" .$level ;
			$result = $conn->query($query);
			if ($result->num_rows > 0):
			 while ($row = $result->fetch_assoc()) :
			 		$id = $row['id'];
					$name = $row['file_name'];
					$type = $row['type'];
					$size = $row['size'];
					$content = $row['content'];
					$course = $row['course'];
					$code = $row['code'];
					$level = $row['level'];
					if ($type =='application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
						$type = "Word Document";
					}
					if ($type =='application/pdf') {
						$type = "PDF";
					}
					?>
		<div class="file">
			<header><span><h3><?php echo $name; ?><sub><?php echo $type; ?></sub>
			</h3></span></header>
			<p><?php echo $course ?></p>
			<p><?php echo $code ?>:</p>
			<div class="download">
			<a href="download.php?id=<?php echo $id; ?>"><button>Download</button></a>
			</div>
		</div>
		<?php endwhile;	 ?>
			
	<?php 	else:	 ?>
		<p>No content for these level yet </p>
	<?php 	endif ?>

	 
	</div>
</div>
 </body>
 </html>