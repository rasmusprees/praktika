<?php 
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


	$username = $_POST["user"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];


	$username = mysqli_real_escape_string($database, $username);
	$password = mysqli_real_escape_string($database, $password);
	$password2 = mysqli_real_escape_string($database, $password2);

	if ($password != $password2) {
		echo "Passwords missmach";
		echo "<button onclick='window.history.back();'>Back</button>";
		die(-1);
	}

	$password = password_hash($password, PASSWORD_BCRYPT);


	$sql = "INSERT INTO users (name, password) VALUES ('$username', '$password')";

	$result = mysqli_query($database, $sql);

	die("Loodud kasutaja: " .$username . ". Võite sisse logida.");
}