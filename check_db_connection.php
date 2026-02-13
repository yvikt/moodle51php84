<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$db   = getenv('DB_NAME');

$link = @mysqli_connect($host, $user, $pass, $db);

if (!$link) {
	    die('Connection error: ' . mysqli_connect_error());
}
echo "✅ Connection is successful!\n";
mysqli_close($link);
