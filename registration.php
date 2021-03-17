<?php 
require 'functions.php';

	if(isset($_POST["register"])){
		if(register($_POST) > 0) {
			echo "
				<script> alert('new user has been added');
				</script>
			";
		} else{
			echo mysqli_error($conn);
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
	<style type="text/css">
		label {
			display: block;
		}
	</style>
</head>
<body>
	<h1>Registration</h1>

	<form action="" method="post">
		<ul>
			<li>
				<label for="username">username:</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">password:</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<label for="password2">password:</label>
				<input type="password" name="password2" id="password2">
			</li>
			<li>
				<button type="submit" name="register">Register</button>
			</li>
		</ul>
		
	</form>

</body>
</html>