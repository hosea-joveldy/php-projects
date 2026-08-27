<?php

class HomeModel
{
    public function connect () 
    {
        $env = parse_ini_file(__DIR__ . '/../../.env');

        try {
            $dsn = "pgsql:host={$env["DB_HOST"]};port={$env["DB_PORT"]};dbname={$env["DB_DATABASE"]}";
            $pdo = new PDO($dsn, $env["DB_USERNAME"], $env["DB_PASSWORD"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("connection failed: " . $e->getMessage());
        }

        return $pdo;
    }

    public function getData (): array
    {
        $pdo = $this->connect();
        $stmt = $pdo->query("SELECT * FROM bahan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
