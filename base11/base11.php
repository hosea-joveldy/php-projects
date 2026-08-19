<?php

namespace Base11;

class Calculate
{
    public int $num1;
    public string $opt;
    public int $num2;

    public function cal(): int|string
    {
        switch ($this->opt) {
            case "+":
                return $this->num1 + $this->num2;
                break;
            case "-":
                return $this->num1 - $this->num2;
                break;
            case "x":
                return $this->num1 * $this->num2;
                break;
            case "/":
                if ($this->num2 === 0) {
                    return "cant be divided by 0";
                }
                return $this->num1 / $this->num2;
                break;
            case "%":
                return $this->num1 % $this->num2;
                break;
            default:
                return "somehow an error";
        }
    }
}

$calculate = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["num1"], $_GET["num2"], $_GET["opt"])) {
    $calculate = new Calculate();

    $calculate->num1 = $_GET["num1"];
    $calculate->num2 = $_GET["num2"];
    $calculate->opt = $_GET["opt"];
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>base11</title>
</head>
<body>
    <form method="GET">
        <label for="num1">first num:</label>
        <input type="number" name="num1">

        <label for="opt">operator:</label>
        <select name="opt">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="x">x</option>
        <option value="/">/</option>
        <option value="%">%</option>
        </select>

        <label for="num2">second num:</label>
        <input type="number" name="num2">

        <input type="submit">
    </form>

    <?php
    if ($calculate !== null) {
        echo "first num: ";
        echo "$calculate->num1";

        echo "<br>";

        echo "opt: ";
        echo "$calculate->opt";

        echo "<br>";

        echo "second num: ";
        echo "$calculate->num2";

        echo "<br>";

        echo "rest: ";
        echo $calculate->cal();
    }
    ?>
</body>
</html>
