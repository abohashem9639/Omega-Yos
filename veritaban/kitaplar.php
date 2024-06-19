<?php
include 'db_config.php';
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
        <div class="container">
            <h1 id="kitaplar">Kitaplar</h1>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Kitap ara...">
                <button onclick="searchBook()">Ara</button>
            </div>
        </div>

        <div class="container">
            <?php
            $sql = "SELECT company, title, cover, file FROM books ORDER BY company, title";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $currentCompany = null;
                while ($row = $result->fetch_assoc()) {
                    if ($row['company'] != $currentCompany) {
                        if ($currentCompany !== null) {
                            echo '</div>';
                        }
                        $currentCompany = $row['company'];
                        echo '<h1 id="' . strtolower($currentCompany) . '">' . $currentCompany . '</h1>';
                        echo '<div class="card-container kitaplar" dir="rtl">';
                    }
                    echo '<div class="card">';
                    echo '  <a href="' . $row['file'] . '" target="_blank">';
                    echo '    <img src="' . $row['cover'] . '" alt="' . $row['title'] . ' Kapak">';
                    echo '  </a>';
                    echo '  <div class="card-body">';
                    echo '    <h4>' . $row['title'] . '</h4>';
                    echo '    <a target="_blank" href="' . $row['file'] . '" class="btn btn-primary">İndir</a>';
                    echo '  </div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo "Henüz kitap yok.";
            }
            ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <div>
                <h2><a href="index.html">OMEGA YÖS</a></h2>
                <div>
                    <a class="facebook" target="_blank" href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a class="instagram" target="_blank" href="#"><i class="fa-brands fa-square-instagram"></i></a>
                    <a class="github" target="_blank" href="#"><i class="fa-brands fa-square-github"></i></a>
                </div>
            </div>
            <p>&copy; All rights reserved to OMEGA YÖS</p>
        </div>
    </footer>

    <script>
        function searchBook() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const galataSection = document.getElementById('galata');
            const puzaSection = document.getElementById('puza');

            if (searchInput.includes('galata')) {
                galataSection.scrollIntoView({ behavior: 'smooth' });
            } else if (searchInput.includes('puza')) {
                puzaSection.scrollIntoView({ behavior: 'smooth' });
            } else {
                alert('Kitap bulunamadı');
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
