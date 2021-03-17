<?php 
		//connect to database
$conn = mysqli_connect("localhost","root","", "basic php");

function queryDb($query) {
	//query data
	global $conn; // this refers to the above conn because thats how is
	$result = mysqli_query($conn, $query);

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

function addToDatabase($post_input) {
	global $conn;
	//the below code prevents someone to mess with the html input that can change the display as if the system was broken
	$name = htmlspecialchars($post_input["name"]);

	$matricNo = htmlspecialchars($post_input["matricNo"]);
	$email = htmlspecialchars($post_input["email"]);
	$major = htmlspecialchars($post_input["major"]);

	$picture = upload();

	if(!$picture){
		return;
	}

	$query = "INSERT INTO students VALUES ('', '$name', '$matricNo', '$email', '$major', '$picture')";

	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
}

function upload(){
	$fileName = $_FILES['picture']['name'];
	$fileSize = $_FILES['picture']['size'];
	$error = $_FILES['picture']['error'];
	$tmpName = $_FILES['picture']['tmp_name'];

	if($error === 4) {
		echo "<script> 
			alert('select image first');
		</script>";
		return false;
	}

	$validExtension = ['jpg', 'jpeg', 'png'];
	$pictureExtenstion = explode('.', $fileName); // turn the names into array
	$pictureExtenstion = strtolower(end($pictureExtenstion));// get the last element and to lower case

	//check if the extension is in our extension array
	if(!in_array($pictureExtenstion, $validExtension)){
		echo "<script> 
			alert('invalid extension');
		</script>";
	}

	//check file size

	if($fileSize > 1000000){
		echo "<script> 
			alert('size is too big');
		</script>";
	}

	$newFileName = uniqid();
	$newFileName .= ".";
	$newFileName .= $pictureExtenstion;

	//move uploaded file to desired location

	move_uploaded_file($tmpName, 'img/'.$newFileName);


	return $newFileName;


}


function delete($id) {
	global $conn;
	mysqli_query($conn,"DELETE FROM students WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function update($post_input){
	global $conn;
	//the below code prevents someone to mess with the html input that can change the display as if the system was broken
	$id = $post_input["id"];
	$name = htmlspecialchars($post_input["name"]);

	$matricNo = htmlspecialchars($post_input["matricNo"]);
	$email = htmlspecialchars($post_input["email"]);
	$major = htmlspecialchars($post_input["major"]);

	$oldPicture = $post_input["oldPicture"];


	// check if user uploads new pic or not
	if($_FILES["picture"]["error"] === 4){
		$picture = $oldPicture;
	} else{

		$picture = upload();
		unlink('img/'.$oldPicture);
	}

	

	$query = "UPDATE students SET 
			name = '$name',
			matricNo = '$matricNo',
			email = '$email',
			major = '$major',
			picture = '$picture' WHERE id = $id ";
 
	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
}


function find($keyword) {
	$query = "SELECT * FROM students WHERE 
	name LIKE '%$keyword%' OR
	matricNo LIKE '%$keyword%' OR
	email LIKE'%$keyword%' OR
	major LIKE '%$keyword%' 
	";

	return queryDb($query);
}

function register($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["password2"]);

	//check username
	$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' ");
	// var_dump(mysqli_fetch_assoc($result)); die;
	if(mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username is already in the database');
			  </script>
		";
		return false;
	}

	// check pasword
	if($password !== $password2) {
		echo "
			<script>
				alert('password does not match')
			</script>
		";
		return false;
	}


	//encrypt password
	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);
}
 ?>




