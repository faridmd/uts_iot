<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "uts_iot";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
	die("Koneksi gagal : " . mysqli_connect_error());
}

echo "DB connect OK!";

$t = $_POST['temp'];
$h = $_POST['hum'];
$sql = "INSERT INTO dht11 (temperature, humidity) VALUES (".$t.", ".$h.")";

if (mysqli_query($conn, $sql)){
	echo "New record";
} else {
	echo "Error : " . $sql . "<br>" . mysqli_error($conn);
}
?>