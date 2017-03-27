<?php 


include 'config.php';

echo '<a href="./login.html">login</a><br>';
echo '<a href="./register.html">register</a><br>';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$username = $_POST["user"];
	$password = $_POST["password"];

	$username = mysqli_real_escape_string($database, $username);
	$password = mysqli_real_escape_string($database, $password);

	

	$sql = "SELECT id FROM users WHERE name = '$username' and password = '$password'";

	$result = mysqli_query($database, $sql);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$count = mysqli_num_rows($result);

	if ($count == 1) {

		$_SESSION["login_user"] = $username;
		echo "Logged in<br>";
	} else {
		die("Cant log in");
	}
}