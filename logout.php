<?php
setcookie("loggedin", "val", time() - (120), "/praktikadb");
header("Location: index.php");

?>