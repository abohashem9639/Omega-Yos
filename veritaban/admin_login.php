<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminUsername = $_POST['username'];
    $adminPassword = $_POST['password'];

    // Giriş bilgilerinin doğru gönderildiğini kontrol etme
    echo "Kullanıcı Adı: " . $adminUsername . "<br>";
    echo "Şifre: " . $adminPassword . "<br>";

    $sql = "SELECT * FROM admin_users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $adminUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Veritabanından çekilen şifreyi ve girilen şifreyi kontrol etme
        echo "Veritabanındaki Şifre: " . $row['password'] . "<br>";
        if (password_verify($adminPassword, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php");
        } else {
            echo "Yanlış şifre.";
        }
    } else {
        echo "Kullanıcı bulunamadı.";
    }
    $stmt->close();
}
$conn->close();
?>
