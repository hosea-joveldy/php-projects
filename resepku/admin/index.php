<?php
    include "../process.php";

    $pdo = conn();
    session_start();


    if (!isset($_SESSION["id"])) {
        header("Location: ../login.php");
        exit();
    } 

    if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "delete_user") {
        deleteUser($pdo, $_POST["id"]);
        header("Location: index.php");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"&& isset($_POST["logout"])) {
        session_destroy();
        header("Location: ../login.php");
        exit();
    }

    adminCheck($pdo);

    $name = getName($pdo);

    $users = getAllUsers($pdo);
    $sayurList = getIngredients($pdo, 'sayur');
    $buahList = getIngredients($pdo, 'buah');
    $bumbuList = getIngredients($pdo, 'bumbu');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resepku — Admin Dashboard</title>
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
            <span class="text-xs font-medium uppercase tracking-[0.25em] text-neutral-300">Resepku Admin</span>
        </div>
        <form method="POST">
            <button
                type="submit"
                name="logout"
                class="text-xs font-medium text-neutral-400 hover:text-[#c9a15a] border border-neutral-800 hover:border-[#c9a15a]/50 rounded-lg px-4 py-2 transition-colors"
            >
                Log out
            </button>
        </form>
    </nav>

    <div class="relative h-[28vh] min-h-[200px] overflow-hidden">
        <img src="../assets/desserts.jpg" alt="Banner image" class="absolute inset-0 w-full h-full object-cover scale-110 blur-[2px]">
        <div class="absolute inset-0 bg-[#0d0b0a]/60"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0d0b0a] via-[#0d0b0a]/30 to-[#3b0f10]/30"></div>

        <div class="relative z-10 h-full flex flex-col items-start justify-end p-6 sm:p-10 max-w-7xl mx-auto">
            <span class="text-xs font-medium uppercase tracking-[0.2em] text-[#c9a15a] mb-1">Admin Panel</span>
            <h1 class="font-display text-3xl sm:text-4xl font-semibold text-white leading-tight">
                Hello, <?= htmlspecialchars($name ?? 'Admin') ?>
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 sm:px-10 py-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-[#161311] border border-neutral-800 rounded-xl p-6 shadow-xl">
            <h2 class="font-display text-2xl font-semibold text-white mb-6">Create a recipe</h2>

            <form action="../process.php" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="create_recipe">

                <div>
                    <label for="name" class="block text-xs font-medium text-neutral-400 mb-1">Recipe Name</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-2.5 rounded-lg bg-[#0d0b0a] border border-neutral-800 text-sm text-neutral-100 focus:border-[#c9a15a] focus:outline-none">
                </div>

                <div>
                    <label for="author" class="block text-xs font-medium text-neutral-400 mb-1">Author</label>
                    <input type="text" id="author" name="author" required class="w-full px-4 py-2.5 rounded-lg bg-[#0d0b0a] border border-neutral-800 text-sm text-neutral-100 focus:border-[#c9a15a] focus:outline-none">
                </div>

                <div>
                    <label for="step" class="block text-xs font-medium text-neutral-400 mb-1">Recipe Steps</label>
                    <textarea id="step" name="step" rows="3" required class="w-full px-4 py-2.5 rounded-lg bg-[#0d0b0a] border border-neutral-800 text-sm text-neutral-100 focus:border-[#c9a15a] focus:outline-none"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label for="sayur" class="block text-xs font-medium text-neutral-400 mb-1">Sayur</label>
                        <select id="sayur" name="sayur" class="w-full px-3 py-2.5 rounded-lg bg-[#0d0b0a] border border-neutral-800 text-sm text-neutral-100 focus:border-[#c9a15a] focus:outline-none">
                            <option value="">-- Select --</option>
                            <?php foreach ($sayurList as $item): ?>
                                <option value="<?= $item['id_bahan'] ?>"><?= htmlspecialchars($item['nama_bahan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="buah" class="block text-xs font-medium text-neutral-400 mb-1">Buah</label>
                        <select id="buah" name="buah" class="w-full px-3 py-2.5 rounded-lg bg-[#0d0b0a] border border-neutral-800 text-sm text-neutral-100 focus:border-[#c9a15a] focus:outline-none">
                            <option value="">-- Select --</option>
                            <?php foreach ($buahList as $item): ?>
                                <option value="<?= $item['id_bahan'] ?>"><?= htmlspecialchars($item['nama_bahan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="bumbu" class="block text-xs font-medium text-neutral-400 mb-1">Bumbu</label>
                        <select id="bumbu" name="bumbu" class="w-full px-3 py-2.5 rounded-lg bg-[#0d0b0a] border border-neutral-800 text-sm text-neutral-100 focus:border-[#c9a15a] focus:outline-none">
                            <option value="">-- Select --</option>
                            <?php foreach ($bumbuList as $item): ?>
                                <option value="<?= $item['id_bahan'] ?>"><?= htmlspecialchars($item['nama_bahan']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full mt-4 bg-gradient-to-r from-[#7a1f22] to-[#5c1618] hover:from-[#8c2427] hover:to-[#6b1a1c] text-white text-sm font-medium py-2.5 rounded-lg transition-all shadow-md">
                    Save Recipe
                </button>
            </form>
        </div>

        <div class="bg-[#161311] border border-neutral-800 rounded-xl p-6 shadow-xl">
            <h2 class="font-display text-2xl font-semibold text-white mb-6">User Management</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-neutral-300">
                    <thead class="text-xs uppercase bg-[#0d0b0a] text-neutral-400 border-b border-neutral-800">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800">
                        <?php foreach ($users as $user): ?>
                            <tr class="hover:bg-neutral-900/50">
                                <td class="px-4 py-3 font-medium text-white"><?= htmlspecialchars($user['name']) ?></td>
                                <td class="px-4 py-3 font-medium text-white"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 text-xs rounded border <?= $user['role'] === 'admin' ? 'border-[#c9a15a] text-[#c9a15a]' : 'border-neutral-700 text-neutral-400' ?>">
                                        <?= htmlspecialchars($user['role'] ?? 'user') ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="user/edit.php?id=<?= $user['id'] ?>" class="text-xs text-[#c9a15a] hover:underline">Edit</a>
                                    <form method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                        <input type="hidden" name="action" value="delete_user">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <button type="submit" class="text-xs text-red-400 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>