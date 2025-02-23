<?php 

require_once "db.js";

$username = $_POST['username'];
$usia = $_POST['usia'];
$password1 = $_POST['password'];

$sql = "INSERT INTO user (username, usia, password1) VALUES ('".$username."','".$usia."','".$password1."')";

if($conn->query($sql) === TRUE){
	echo "Data telah ditambah";
}

else{
	echo "Error ".$conn->error;
}

$conn->close();

 ?>