<?php

namespace Base12;

class Bmi
{
    public $weight;
    public $height;

    public function cal()
    {
        return $this->weight / pow($this->height, 2);
    }
}

$rest = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["weight"], $_GET["height"])) {
    $bmi = new Bmi();
    $bmi->weight = (float) $_GET["weight"];
    $bmi->height = (float) $_GET["height"];

    $rest = $bmi->cal();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bmi cal</title>
</head>
<body>
    <form method="GET">
        <label for="weight">weight: </label>
        <input type="text" name="weight">

        <!-- <label for="weight">weight: </label>
        <input type="text" name="weight"> -->

        <label for="height">height: </label>
        <input type="text" name="height">

        <!-- <label for="weight">weight: </label>
        <input type="text" name="weight"> -->

        <input type="submit">
    </form>

    <br>

    <p>bmi = </p>
    <?= number_format($rest, 2) ?>
</body>
</html>