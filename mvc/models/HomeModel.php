<?php

class HomeModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    private function connect(): PDO 
    {
        $env = parse_ini_file(__DIR__ . '/../../.env');

        try {
            $dsn = "pgsql:host={$env["DB_HOST"]};port={$env["DB_PORT"]};dbname={$env["DB_DATABASE"]}";
            $pdo = new PDO($dsn, $env["DB_USERNAME"], $env["DB_PASSWORD"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("connection failed: " . $e->getMessage());
        }
    }

    public function getData (): array
    {
        $stmt = $this->pdo->query("SELECT * FROM bahan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addData ($nama_bahan, $kategori): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO bahan (nama_bahan, kategori) VALUES (?, ?)");
        $stmt->execute([$nama_bahan, $kategori]);
    }
}
