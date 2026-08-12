<?php
    include("../../process.php");
    $pdo = conn();

    $id = $_GET["id"];
    $user = getUser($pdo, $id);
    $roles = ["normal", "admin"];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["_method"] ?? "") === "PUT") {
        editUser(
            $pdo,
            $id,
            $_POST["name"],
            $_POST["username"],
            $_POST["email"],
            $_POST["pass"],
            $_POST["role"]
        );
        ?>
        <script>window.location.href = "../index.php";</script>
        <?php
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resepku — Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#0d0b0a] text-neutral-100 min-h-screen antialiased">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Left: Form panel -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-10 relative order-2 lg:order-1">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(201,161,90,0.07),transparent_45%)]"></div>

            <div class="w-full max-w-sm relative">

                <div class="lg:hidden mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#c9a15a]"></span>
                    <span class="text-xs font-medium uppercase tracking-[0.25em] text-neutral-400">Resepku</span>
                </div>

                <div class="mb-8">
                    <span class="text-xs font-medium uppercase tracking-[0.2em] text-[#c9a15a]">Admin</span>
                    <h1 class="font-display text-3xl font-semibold text-white mt-2">Edit User</h1>
                    <p class="text-neutral-500 text-sm mt-2">Update this diner's details and seating privileges.</p>
                </div>

                <form method="POST" class="space-y-4">
                    <input type="hidden" name="_method" value="PUT"/>

                    <div>
                        <label for="name" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?= htmlspecialchars($user["name"]) ?>"
                            required
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                        >
                    </div>

                    <div>
                        <label for="username" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="<?= htmlspecialchars($user["username"]) ?>"
                            required
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($user["email"]) ?>"
                            required
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                        >
                    </div>

                    <div>
                        <label for="role" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Role</label>
                        <select
                            id="role"
                            name="role"
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                        >
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role ?>" <?= $user["role"] === $role ? "selected" : "" ?>>
                                    <?= ucfirst($role) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="pass" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Password</label>
                        <input
                            type="password"
                            id="pass"
                            name="pass"
                            placeholder="Leave blank to keep current"
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full mt-2 bg-gradient-to-r from-[#7a1f22] to-[#5c1618] hover:from-[#8c2427] hover:to-[#6b1a1c] text-white text-sm font-medium py-3 rounded-lg transition-all shadow-lg shadow-[#5c1618]/30 focus:outline-none focus:ring-2 focus:ring-[#c9a15a] focus:ring-offset-2 focus:ring-offset-[#0d0b0a]"
                    >
                        Save Changes
                    </button>
                </form>

                <p class="text-center text-xs text-neutral-500 mt-6">
                    <a href="../index.php" class="text-[#c9a15a] hover:text-[#dab879] font-medium transition-colors">← Back to user list</a>
                </p>
            </div>
        </div>

        <!-- Right: Image panel -->
        <div class="relative hidden lg:block lg:w-1/2 xl:w-3/5 overflow-hidden order-1 lg:order-2">
            <img
                src="../../assets/table.jpg"
                alt="A fancy round table set with chairs"
                class="absolute inset-0 w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0b0a] via-[#0d0b0a]/20 to-[#3b0f10]/40"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-transparent to-[#0d0b0a]/90"></div>

            <div class="relative z-10 h-full flex flex-col justify-between p-12">
                <div class="flex items-center justify-end gap-2">
                    <span class="text-xs font-medium uppercase tracking-[0.25em] text-neutral-200">Resepku</span>
                    <span class="w-2 h-2 rounded-full bg-[#c9a15a]"></span>
                </div>

                <div class="max-w-md ml-auto text-right">
                    <h2 class="font-display text-4xl xl:text-5xl font-semibold text-white leading-tight">
                        Keep the seating<br> chart in order.
                    </h2>
                    <p class="mt-4 text-neutral-300 text-sm leading-relaxed">
                        A quick update, and this guest's place at the table
                        is set just right.
                    </p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>