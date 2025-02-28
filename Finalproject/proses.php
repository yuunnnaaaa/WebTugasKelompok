<?php 

require_once "functions.php";

$username = $_POST['username'];
$usia = $_POST['usia'];
$password = $_POST['password'];
// enkripsi password
$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (username, usia, password) VALUES ('".$username."','".$usia."','".$password."')";


if($conn->query($sql) === TRUE){
	echo "Akun Anda Terdaftar ";
}

else{
	echo "Error ".$conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Medical Center</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="contaiiner">    
			<div class="popup-success">
        		<div class="popup-content">
				<div class="text"><a href="login.php" style="text-decoration: none;"><br><br> Klik Disini untuk Login</a></div>
            	<script src="akun-terdaftar.js"></script>
				</div>
			</div>
    <div>
</body>
</html>
