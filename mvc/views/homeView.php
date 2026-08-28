
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mvc</title>
</head>
<body>
    <form method="GET">
        <label for="nama_bahan">Tambah bahan</label>
        <input type="text" name="nama_bahan">
        <br>
        <select name="kategori">
            <option value="buah">buah</option>
            <option value="sayur">sayur</option>
            <option value="bumbu">bumbu</option>
        </select>
        <input type="submit" value="Add">
    </form>
    <?php
    foreach($data as $isi) {
        echo "<h3>{$isi['id_bahan']}.{$isi['nama_bahan']}</h3>";
    }
    ?>
</body>
</html>