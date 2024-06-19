<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.html");
    exit;
}

include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookCompany = $_POST['bookCompany'];
    $bookTitle = $_POST['bookTitle'];

    $targetDir = "/uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $bookCover = $targetDir . basename($_FILES["bookCover"]["name"]);
    $bookFile = $targetDir . basename($_FILES["bookFile"]["name"]);

    // Hata kontrolü
    echo "Book Cover Temp Name: " . $_FILES["bookCover"]["tmp_name"] . "<br>";
    echo "Book File Temp Name: " . $_FILES["bookFile"]["tmp_name"] . "<br>";
    echo "Book Cover: " . $bookCover . "<br>";
    echo "Book File: " . $bookFile . "<br>";

    $uploadSuccess = true;

    if (move_uploaded_file($_FILES["bookCover"]["tmp_name"], $bookCover)) {
        echo "Book Cover uploaded successfully.<br>";
    } else {
        echo "Failed to upload book cover.<br>";
        echo "Error: " . $_FILES["bookCover"]["error"] . "<br>";
        $uploadSuccess = false;
    }

    if (move_uploaded_file($_FILES["bookFile"]["tmp_name"], $bookFile)) {
        echo "Book File uploaded successfully.<br>";
    } else {
        echo "Failed to upload book file.<br>";
        echo "Error: " . $_FILES["bookFile"]["error"] . "<br>";
        echo "Possible error reasons: <br>";
        if ($_FILES["bookFile"]["error"] == UPLOAD_ERR_INI_SIZE) {
            echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.<br>";
        }
        if ($_FILES["bookFile"]["error"] == UPLOAD_ERR_FORM_SIZE) {
            echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.<br>";
        }
        if ($_FILES["bookFile"]["error"] == UPLOAD_ERR_PARTIAL) {
            echo "The uploaded file was only partially uploaded.<br>";
        }
        if ($_FILES["bookFile"]["error"] == UPLOAD_ERR_NO_FILE) {
            echo "No file was uploaded.<br>";
        }
        if ($_FILES["bookFile"]["error"] == UPLOAD_ERR_NO_TMP_DIR) {
            echo "Missing a temporary folder.<br>";
        }
        if ($_FILES["bookFile"]["error"] == UPLOAD_ERR_CANT_WRITE) {
            echo "Failed to write file to disk.<br>";
        }
        if ($_FILES["bookFile"]["error"] == UPLOAD_ERR_EXTENSION) {
            echo "File upload stopped by extension.<br>";
        }
        $uploadSuccess = false;
    }

    if ($uploadSuccess) {
        $sql = "INSERT INTO books (company, title, cover, file) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $bookCompany, $bookTitle, $bookCover, $bookFile);

            if ($stmt->execute()) {
                echo "Kitap başarıyla yüklendi.";
            } else {
                echo "Veritabanı hatası: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Veritabanı hatası: " . $conn->error;
        }
    } else {
        echo "Dosya yüklemede hata oluştu.";
    }
}
$conn->close();
?>
