<?php
include "process.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = conn();

    $kategoris = ["buah", "sayur", "bumbu"];

    $stmt = $pdo->prepare("INSERT INTO bahan (nama_bahan, kategori) VALUES (:nama, :kategori)");

    foreach($kategoris as $kategori) {
        $handle = fopen("data/{$kategori}.md", "r");

        while (($line = fgets($handle)) !== false) {
            $nama = trim($line);

            if ($nama === '') {
                continue;
            }

            $stmt->execute([
                'nama' => $nama,
                'kategori' => $kategori,
            ]);
        }
        
        fclose($handle);
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data from MD</title>
</head>
<body>
    <form action="" method="POST">
        <input type="submit" value="Insert">
    </form>
</body>
</html>