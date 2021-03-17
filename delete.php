<?php 
require 'functions.php';
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
$id = $_GET["id"];

if(delete($id) != -1){
		echo "
			<script> 
				alert('data has been deleted successfully');
				document.location.href = 'index.php';
			</script>";
		} else{
				echo "
			<script> 
				alert('data has NOT been deleted successfully');
				document.location.href = 'index.php';
			</script>";
			
		}

 ?>