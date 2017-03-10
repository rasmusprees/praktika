<?php
$cookie_name = "loggedin";

$servername = "localhost";
$username = "root";
$password = "";
$database = "praktika";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
	die("Database connection failed: ".mysql_connect_error());
}

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM users WHERE username='$username'";
	$result = $conn->query($sql);

	if ($result->num_rows === 1) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		if (password_verify($password, $row['password'])) {
			$cookie_value = $username;
			setcookie($cookie_name, $cookie_value, time()+ 180, "/praktikadb");
			header("Location: personal.php");
		}
		
	}
	else {
		echo 'Username or password is incorrect!';
	}
}

else if (isset($_POST['register'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$password = password_hash($password, PASSWORD_BCRYPT);

	$sql = "INSERT INTO users VALUES ('', '$username', '$password')";

		$query = mysqli_query($conn, $sql);
		if($query) {
			echo "User created!";
		}
else{
	die('There was an error running the query[' .$conn->error .']'); //mis asja see teeb??????
}
}

?>