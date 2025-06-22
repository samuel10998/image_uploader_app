<?php
$uploadDir = getenv("UPLOAD_DIR") ?: "/var/www/html/uploads/";

// Uisti sa, že priečinok existuje
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Upload súboru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $targetFile = $uploadDir . '/' . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Súbor bol nahratý.<br><br>";
    } else {
        echo "Chyba pri nahrávaní súboru.<br><br>";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" value="Upload">
</form>

<hr>

<?php
// Zobrazenie obrázkov
if (file_exists($uploadDir)) {
    $files = scandir($uploadDir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
            echo "<div style='margin:10px 0;'>
                    <img src='uploads/$file' width='200'><br>
                    <small>$file</small>
                  </div>";
        }
    }
} else {
    echo "<p style='color:red;'>Zložka na uploady neexistuje.</p>";
}
?>
