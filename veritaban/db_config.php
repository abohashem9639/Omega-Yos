<?php
$servername = "localhost";
$username = "root"; // Varsayılan WAMP kullanıcı adı
$password = ""; // Varsayılan WAMP şifresi (boş)
$dbname = "omega_yos"; // Veritabanı adınız

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
