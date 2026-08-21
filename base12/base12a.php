<?php

namespace Base12;

class Bmi
{
    public $weight;
    public $height;

    public function cal($weightUnit, $heightUnit)
    {
        $weight = $this->weight;
        $height = $this->height;

        if ($weight <= 0 || $height <= 0) {
            return "weight or height cant be zero";
        }

        switch ($weightUnit) {
            case "kg":
                break;
            case "hg":
                $weight = $weight / 10;
                break;
            case "dag":
                $weight = $weight / 100;
                break;
            case "g":
                $weight = $weight / 1000;
                break;
            case "dg":
                $weight = $weight / 10000;
                break;  
            case "cg":
                $weight = $weight / 100000;
                break;
            case "mg":
                $weight = $weight / 1000000;
                break;
        }

        switch ($heightUnit) {
            case "km":
                $height = $height * 1000;
                break;
            case "hm":
                $height = $height * 100;
                break;
            case "dam":
                $height = $height * 10;
                break;
            case "m":
                break;
            case "dm":
                $height = $height / 10;
                break;  
            case "cm":
                $height = $height / 100;
                break;
            case "mm":
                $height = $height / 1000;
                break;
        }

        return $weight / pow($height, 2);
    }
}

$rest = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["weight"], $_GET["height"], $_GET["weightUnit"], $_GET["heightUnit"])) {
    $bmi = new Bmi();
    $bmi->weight = (float) $_GET["weight"];
    $bmi->height = (float) $_GET["height"];
    $weightUnit = (string) $_GET["weightUnit"];
    $heightUnit = (string) $_GET["heightUnit"];

    $rest = $bmi->cal($weightUnit, $heightUnit);
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
        <input type="number" step="any" name="weight">

        <label for="weightUnit">weight unit: </label>
        <select name="weightUnit">
            <option value="kg" selected>kg</option>
            <option value="hg">hg</option>
            <option value="dag">dag</option>
            <option value="g">g</option>
            <option value="dg">dg</option>
            <option value="cg">cg</option>
            <option value="mg">mg</option>
        </select>


        <label for="height">height: </label>
        <input type="number" step="any" name="height">

        <label for="heightUnit">height unit: </label>
        <select name="heightUnit">
            <option value="km">km</option>
            <option value="hm">hm</option>
            <option value="dam">dam</option>
            <option value="m" selected>m</option>
            <option value="dm">dm</option>
            <option value="cm">cm</option>
            <option value="mm">mm</option>
        </select>

        <input type="submit">
    </form>

    <br>

    <p>bmi = </p>
    <?= is_numeric($rest) ? number_format($rest, 2) : ($rest ?? 0) ?>
</body>
</html>