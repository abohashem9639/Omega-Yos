<?php
include 'db_config.php';

// Kullanıcı adı ve şifreyi burada belirleyin
$adminUsername = "admin";
$adminPassword = password_hash("admin123", PASSWORD_DEFAULT); // Şifreyi hash'liyoruz

// Eski kullanıcıyı silme
$sqlDelete = "DELETE FROM admin_users WHERE username = ?";
$stmtDelete = $conn->prepare($sqlDelete);
$stmtDelete->bind_param("s", $adminUsername);
$stmtDelete->execute();
$stmtDelete->close();

// Yeni kullanıcıyı ekleme
$sqlInsert = "INSERT INTO admin_users (username, password) VALUES (?, ?)";
$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("ss", $adminUsername, $adminPassword);

if ($stmtInsert->execute()) {
    echo "Admin kullanıcı başarıyla oluşturuldu.";
} else {
    echo "Hata: " . $stmtInsert->error;
}

$stmtInsert->close();
$conn->close();
?>
