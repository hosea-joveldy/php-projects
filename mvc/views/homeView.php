

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mvc</title>
</head>
<body>
    <?php
    foreach($data as $isi) {
        echo "<h3>{$isi['id_bahan']}.{$isi['nama_bahan']}</h3>";
    }
    ?>
</body>
</html>