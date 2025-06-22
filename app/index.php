<?php
$uploadDir = getenv("UPLOAD_DIR") ?: "/uploads/";
// Kontroluje, či bola požiadavka typu POST a či bol odoslaný súbor s názvom "image".
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Vytvorí cestu k cieľovému súboru kombináciou priečinka $uploadDir a názvu nahraného súboru (pomocou basename pre bezpečnosť, aby sa zabránilo útokom typu directory traversal).
    $targetFile = $uploadDir . basename($_FILES["image"]["name"]);
    // Presunie nahraný súbor z dočasného umiestnenia (tmp_name) do cieľového priečinka ($targetFile).
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    echo "Súbor bol nahratý.";  // Ak je presun úspešný, vypíše správu o úspechu.
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" value="Upload">
</form>
