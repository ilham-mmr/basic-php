<?php 
require 'functions.php';
//start sesstion

session_start();
// if we log in we cant access this page

//check cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key'])){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//check cookie and username
	if($key === hash('sha256', $row['username'])){
		$_SESSION['login'] = true;
	}
}
if(isset($_SESSION["login"])){
	header("Location: index.php");
	exit;
}


	if(isset($_POST["login"])){ 
		$username = mysqli_real_escape_string($conn,$_POST["username"]) ;// use this to prevent sql injection
		$password = $_POST["password"];

		$result=  mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'");

		if(mysqli_num_rows($result) === 1){
			$row = mysqli_fetch_assoc($result);
			if(password_verify($password, $row["password"])){

				// set session
				$_SESSION["login"] = true;
				//check remember me
				if(isset($_POST['remember'])){
					//create cookie
					setcookie('id',$row['id'],time()+60);
					setcookie('key', hash('sha256',$row['username']),time()+60);
				}

				header("Location: index.php");
				exit;
			}
		}

		$error = true;
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>

	<h1>Login</h1>
<?php if(isset($error)) : ?>
	<p style="color: red; font-style: italic;">username/password is incorrect</p>
<?php endif; ?>
	<form action="" method="post">
		<ul>
			<li>
				<label for="username">username:</label>
				<input type="text" name="username">
			</li>
			<li>
				<label for="password">password:</label>
				<input type="password" name="password">
			</li>
			<li>
				<input type="checkbox" name="remember" id="remember">
				<label for="remember">remember me</label>
			</li>
			<li>
				<button type="submit" name="login"> Login </button>
			</li>
		</ul>
	</form>


</body>
</html>