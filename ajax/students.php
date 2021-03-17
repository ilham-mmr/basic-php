<?php 
require '../functions.php';

$keyword = $_GET["keyword"];


$query = "SELECT * FROM students WHERE 
	name LIKE '%$keyword%' OR
	matricNo LIKE '%$keyword%' OR
	email LIKE'%$keyword%' OR
	major LIKE '%$keyword%' 
	";
$students = queryDb($query);

?>



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
