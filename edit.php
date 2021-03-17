 <?php 
require "functions.php";
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
	
	$id = $_GET["id"];
	$student = queryDb("SELECT * FROM students WHERE id = $id")[0];


	//submit 
	if (isset($_POST["submit"])) {
		global $conn;
		$status = update($_POST);
		
		
		if($status != -1) {
			echo "
			<script> 
				alert('data has been updated successfully');
				document.location.href = 'index.php';
			</script>";
			
		} else{
			echo "
			<script> 
				alert('data has NOT been updated successfully');
				document.location.href = 'index.php';
			</script>";
			
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Update page</title>
</head>
<body>
	<h1>Update student data</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $student["id"] ?>">
		<input type="hidden" name="oldPicture" value="<?= $student["picture"] ?>">
		<ul>
			<li>
				<label for="matricNo">Matric:</label>
				<input type="text" name="matricNo" id="matricNo" required="" value="<?= $student["matricNo"] ?>">
			</li>
			<li>
				<label for="name">
					Name:
				</label>
				<input type="text" name="name" id="name" value="<?= $student["name"] ?>">
			</li>
			<li>
				<label for="email">Email:</label>
				<input type="text" name="email" id="email" value="<?= $student["email"] ?>">
			</li>
			<li>
				<label for="major">Major:</label>
				<input type="text" name="major" id="major" value="<?= $student["major"] ?>">
			</li>
			<li>
				<label for="picture">Picture:</label>
				<br>
				<img src="img/<?= $student['picture'] ?>" width="100">
				<input type="file" name="picture" id="picture" >

			</li>
			<li>
				<button type="submit" name="submit">Update data</button>
			</li>
		</ul>
	</form>

</body>
</html>