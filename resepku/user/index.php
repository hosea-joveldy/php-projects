<?php
    session_start();
    include "../process.php";

    if (!isset($_SESSION["id"])) {
        header("Location: ../login.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $_SESSION = [];
        session_destroy();
        header("Location: ../login.php");
        exit();
    }

    $pdo = conn();
    $name = getName($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resepku — Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#0d0b0a] text-neutral-100 min-h-screen antialiased">

    <nav class="flex items-center justify-between px-6 sm:px-10 py-5 border-b border-neutral-900">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#c9a15a]"></span>
            <span class="text-xs font-medium uppercase tracking-[0.25em] text-neutral-300">Resepku</span>
        </div>
        <form method="POST">
            <button
                type="submit"
                class="text-xs font-medium text-neutral-400 hover:text-[#c9a15a] border border-neutral-800 hover:border-[#c9a15a]/50 rounded-lg px-4 py-2 transition-colors"
            >
                Log out
            </button>
        </form>
    </nav>

    <div class="relative h-[46vh] min-h-[280px] overflow-hidden">
        <img
            src="../assets/desserts.jpg"
            alt="An assortment of desserts"
            class="absolute inset-0 w-full h-full object-cover scale-110 blur-[2px]"
        >
        <div class="absolute inset-0 bg-[#0d0b0a]/60"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0b0a] via-[#0d0b0a]/30 to-[#3b0f10]/30"></div>

        <div class="relative z-10 h-full flex flex-col items-start justify-end p-6 sm:p-10 max-w-3xl">
            <span class="text-xs font-medium uppercase tracking-[0.2em] text-[#c9a15a] mb-2">Welcome back</span>
            <h1 class="font-display text-4xl sm:text-5xl font-semibold text-white leading-tight">
                Hello, <?= htmlspecialchars($name) ?>
            </h1>
            <p class="mt-3 text-neutral-300 text-sm max-w-md">
                Something sweet is always worth saving room for. Here's what's cooking today.
            </p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-6 sm:px-10 py-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-display text-2xl font-semibold text-white">Your kitchen</h2>
        </div>

        <div class="rounded-xl border border-neutral-800 bg-[#161311] p-8 text-center">
            <p class="text-neutral-500 text-sm">
                No recipes yet — this is where your saved and created recipes will show up.
            </p>
        </div>
    </div>

</body>
</html>