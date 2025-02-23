<?php 

require_once "functions.php";

$username = $_POST['username'];
$usia = $_POST['usia'];
$password = $_POST['password'];

$sql = "INSERT INTO user (username, usia, password) VALUES ('".$username."','".$usia."','".$password."')";

if($conn->query($sql) === TRUE){
	echo "Data telah ditambah";
}

else{
	echo "Error ".$conn->error;
}

$conn->close();

 ?>