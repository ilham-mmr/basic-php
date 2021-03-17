<?php 
require "functions.php";
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}

	if (isset($_POST["submit"])) {

		$status = addToDatabase($_POST);
		if($status > 0) {
			echo "
			<script> 
				alert('data has been added successfully');
				document.location.href = 'index.php';
			</script>";
			
		} else{
			echo "
			<script> 
				alert('data has NOT been added successfully');
				document.location.href = 'index.php';
			</script>";
			
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add page</title>
</head>
<body>
	<h1>Add student data</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="matricNo">Matric:</label>
				<input type="text" name="matricNo" id="matricNo" required="">
			</li>
			<li>
				<label for="name">
					Name:
				</label>
				<input type="text" name="name" id="name">
			</li>
			<li>
				<label for="email">Email:</label>
				<input type="text" name="email" id="email">
			</li>
			<li>
				<label for="major">Major:</label>
				<input type="text" name="major" id="major">
			</li>
			<li>
				<label for="picture">Picture:</label>
				<input type="file" name="picture" id="picture">
			</li>
			<li>
				<button type="submit" name="submit">Add data</button>
			</li>
		</ul>
	</form>

</body>
</html>