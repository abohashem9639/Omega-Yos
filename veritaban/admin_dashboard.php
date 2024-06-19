<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMEGA YÖS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/kitaplar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.html">OMEGA YÖS</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="../index.html">الصفحة الرئيسية</a>
                            <a class="nav-link active" href="kitaplar.php">الكتب</a>
                            <a class="nav-link" href="#">أسئلة الدورات</a>
                            <a class="nav-link" href="#">الإمتحانات التجريبية</a>
                            <a class="nav-link" href="../Bolumler/bolumler.html">معلومات حول الأفرع</a>
                            <a class="nav-link" href="#">المفاضلات</a>
                            <a class="nav-link" href="#">الجامعات الخاصة</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container mt-4">
            <h2>Yeni Kitap Yükle</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="bookCompany" class="form-label">Kitap Şirketi</label>
                    <input type="text" class="form-control" id="bookCompany" name="bookCompany" required>
                </div>
                <div class="mb-3">
                    <label for="bookTitle" class="form-label">Kitap Başlığı</label>
                    <input type="text" class="form-control" id="bookTitle" name="bookTitle" required>
                </div>
                <div class="mb-3">
                    <label for="bookCover" class="form-label">Kitap Kapağı</label>
                    <input type="file" class="form-control" id="bookCover" name="bookCover" required>
                </div>
                <div class="mb-3">
                    <label for="bookFile" class="form-label">Kitap Dosyası</label>
                    <input type="file" class="form-control" id="bookFile" name="bookFile" required>
                </div>
                <button type="submit" class="btn btn-primary">Yükle</button>
            </form>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
