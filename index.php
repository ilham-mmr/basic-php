<?php 
require 'functions.php'; // import the file
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}


$students = queryDb("SELECT * FROM students ");

// echo var_dump($result);
//mysqli_fetch_row($result); //returns numeric array
//mysqli_fetch_assoc($result); //return associative array
////mysqli_fetch_array($result); returns both numeric and associative
////mysqli_fetch_object($result);



// while ($fetchedData = mysqli_fetch_assoc($result)) {
// 	echo $fetchedData["name"] ;
// }

if (isset($_POST["findBtn"])) {
	$students = find($_POST["keyword"]);
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
</head>
<body>
<h1>List of students</h1>

<a href="logout.php">Log out</a>

<form action="" method="post">
	<input type="text" name="keyword" size="40" autofocus="" placeholder="Enter search keyword" autocomplete="off" id="keyword">
	<button type="submit" name="findBtn" id="findBtn">Find</button>
 </form>
 <br>

<a href="addpage.php">add student data</a>
<div id="container">
<table border="1" cellpadding="10" cellspacing="">
	<tr>
		<th>No</th>
		<th>Action</th>
		<th>Photo</th>
		<th>Matric</th>
		<th>Name</th>
		<th>Email</th>
		<th>Major</th>
	</tr>

	<?php $no = 1; ?>
	<?php foreach($students as $student) : ?>

	<tr>
		<td><?= $no++ ?></td>
		<td>
			<a href="edit.php?id=<?= $student["id"] ?>">Edit</a> |
			<a href="delete.php?id=<?= $student["id"] ?>" onclick="return confirm('are you sure ?');">Delete</a>
		</td>
		<td><img src="img/<?= $student["picture"] ?>" width="65"></td>
		<td><?= $student["matricNo"] ?></td>
		<td><?= $student["name"] ?></td>
		<td><?= $student["email"] ?></td>
		<td><?= $student["major"] ?></td>

	</tr>
	<?php endforeach; ?>

</table>
</div>

<script src="js/script.js"></script>
</body>
</html>