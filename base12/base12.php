<?php

namespace Base12;

class Character
{
    public $name = "";
    public $health = 100;
    public $def = 1;

    public function attack(int $oppositeHealth, float $oppositeDef)
    {
        return $oppositeHealth -= (rand(5, 15) / $oppositeDef);
    }

    public function heal()
    {
        $this->health += rand(2, 8);
    }

    public function defense()
    {
        $this->def += (rand(1, 2) / 10);
    }
}

$mc = new Character();
$mc->name   = "mc";
$mc->health = isset($_GET["mc_health"]) ? (float)$_GET["mc_health"] : 100;
$mc->def    = isset($_GET["mc_def"])    ? (float)$_GET["mc_def"]    : 1;

$enemy = new Character();
$enemy->name   = "enemy";
$enemy->health = isset($_GET["enemy_health"]) ? (float)$_GET["enemy_health"] : 100;
$enemy->def    = isset($_GET["enemy_def"])    ? (float)$_GET["enemy_def"]    : 1;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["atk"])) {
    $enemy->health = $mc->attack($enemy->health, $enemy->def);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["heal"])) {
    $mc->heal();
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["defense"])) {
    $mc->defense();
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["rst"])) {
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>battle</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="flex justify-center gap-10">
        <div name="mc" class="rounded-md flex flex-col">
            <h1>mc</h1>
            <p><?= $mc->health ?></p>
            <p><?= $mc->def ?></p>

            <form method="GET">
                <input type="hidden" name="mc_health" value="<?= $mc->health ?>">
                <input type="hidden" name="mc_def" value="<?= $mc->def ?>">
                <input type="hidden" name="enemy_health" value="<?= $enemy->health ?>">
                <input type="hidden" name="enemy_def" value="<?= $enemy->def ?>">
                <input type="submit" name="atk" value="atk">
            </form>

            <form method="GET">
                <input type="hidden" name="mc_health" value="<?= $mc->health ?>">
                <input type="hidden" name="mc_def" value="<?= $mc->def ?>">
                <input type="hidden" name="enemy_health" value="<?= $enemy->health ?>">
                <input type="hidden" name="enemy_def" value="<?= $enemy->def ?>">
                <input type="submit" name="heal" value="heal">
            </form>

            <form method="GET">
                <input type="hidden" name="mc_health" value="<?= $mc->health ?>">
                <input type="hidden" name="mc_def" value="<?= $mc->def ?>">
                <input type="hidden" name="enemy_health" value="<?= $enemy->health ?>">
                <input type="hidden" name="enemy_def" value="<?= $enemy->def ?>">
                <input type="submit" name="defense" value="def">
            </form>
        </div>

        <div name="enemy" class="rounded-md flex flex-col">
            <h1>enemy</h1>
            <p><?= $enemy->health ?></p>
            <p><?= $enemy->def ?></p>
        </div>

        <div>
            <form method="GET">
                <input type="submit" name="rst" value="rst">
            </form>
        </div>
    </div>
</body>
</html>