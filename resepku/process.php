<?php
    function conn() {
        $env = parse_ini_file(__DIR__ . '../.env');

        try {
            $dsn = "pgsql:host={$env["DB_HOST"]};port={$env["DB_PORT"]};dbname={$env["DB_DATABASE"]}";
            $pdo = new PDO($dsn, $env["DB_USERNAME"], $env["DB_PASSWORD"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("connection failed: " . $e->getMessage());
        }

        return $pdo;
    }   

    function register($name, $username, $email, $pass, $pdo) {

        if(!$name || !$username || !$email || !$pass) {
            ?>
            <script>alert("Please fill in all required fields.");</script>
            <?php
        } else {    
            try {
                $stmt = $pdo->prepare(
                    "INSERT INTO users (name, username, email, pass) VALUES (?, ?, ?, ?)"
                );

                $stmt->execute([$name, $username, $email, password_hash($pass, PASSWORD_DEFAULT)]);

                ?>
                <script>
                    alert("register succeed")
                    window.location.href = "login.php"
                </script>
                <?php
                exit();
            } catch (PDOException $e) {
                $errorMessage = json_encode("Register failed: " . $e->getMessage());
                echo "<script>alert({$errorMessage});</script>";
            }
        }
    }

    function login($username, $pass, $pdo) {
        if(!$username || !$pass) {
            ?>
            <script>alert("Please fill in all required fields.");</script>
            <?php
        } else {
            try {
                $stmt = $pdo->prepare(
                    "SELECT * FROM users WHERE username = :username LIMIT 1"
                );

                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch();

                if ($user && password_verify($pass, $user["pass"])) {
                    session_start();
                    $_SESSION["id"] = $user["id"];
                    if($user["role"] === "admin") {
                        echo '<script>alert("Login successful!"); window.location.href = "admin/index.php";</script>';
                        exit();
                    }
                    echo '<script>alert("Login successful!"); window.location.href = "user/index.php";</script>';
                    exit();
                } else {
                    echo '<script>alert("Invalid username or password.");</script>';
                }
            } catch (PDOException $e) {
                ?>
                <script>alert("login failed")</script>
                <?php
            }
        }
    }

    function getName($pdo) {
        $id = $_SESSION["id"] ?? null;
        if (!$id) return 'User';

        $stmt = $pdo->prepare("SELECT name FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();

        return $user["name"] ?? 'User';
    }

    function adminCheck($pdo) {
        $conn = conn();

        $id = $_SESSION["id"];
        $stmt = $pdo->prepare(
            "SELECT role FROM users WHERE id = :id"
        );  

        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        $role = $user["role"];

        if($role !== "admin") {
        header("Location: ../user/index.php");
        exit();
        }
    }

    function getIngredients($pdo, $category) {
        try {
            $stmt = $pdo->prepare("SELECT id_bahan, nama_bahan FROM bahan WHERE kategori = :category");
            $stmt->execute(['category' => $category]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    function getAllUsers($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    function getUser($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(["id" => $id]);
        return $stmt->fetch();
    }

    function editUser($pdo, $id, $name, $username, $email, $pass, $role) {
        if (!empty($pass)) {
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "UPDATE users
                SET name = :name, username = :username, email = :email, pass = :pass, role = :role
                WHERE id = :id"
            );

            return $stmt->execute([
                "name" => $name,
                "username" => $username,
                "email" => $email,
                "pass" => $hashedPass,
                "role" => $role,
                "id" => $id,
            ]);
        }

        $stmt = $pdo->prepare(
            "UPDATE users
            SET name = :name, username = :username, email = :email, role = :role
            WHERE id = :id"
        );

        return $stmt->execute([
            "name" => $name,
            "username" => $username,
            "email" => $email,
            "role" => $role,
            "id" => $id,
        ]);
    }

    function deleteUser($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(["id" => $id]);
    }
?>