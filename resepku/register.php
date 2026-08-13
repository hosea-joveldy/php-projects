<?php
    include "process.php";

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $conn = conn();

        register(
            $_POST["name"],
            $_POST["username"],
            $_POST["email"],
            $_POST["pass"],
            $conn
        );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resepku — Create Account</title>
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

        <!-- Left: Image panel -->
        <div class="relative hidden lg:block lg:w-1/2 xl:w-3/5 overflow-hidden">
            <img
                src="assets/wine.jpg"
                alt="A table set with two glasses of wine"
                class="absolute inset-0 w-full h-full object-cover"
            >
            <!-- warm gradient wash to tie the photo into the palette -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d0b0a] via-[#0d0b0a]/20 to-[#3b0f10]/40"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-[#0d0b0a]/90"></div>

            <div class="relative z-10 h-full flex flex-col justify-between p-12">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#c9a15a]"></span>
                    <span class="text-xs font-medium uppercase tracking-[0.25em] text-neutral-200">Resepku</span>
                </div>

                <div class="max-w-md">
                    <h2 class="font-display text-4xl xl:text-5xl font-semibold text-white leading-tight">
                        Every great meal<br> starts with a good recipe.
                    </h2>
                    <p class="mt-4 text-neutral-300 text-sm leading-relaxed">
                        Join Resepku and start collecting, cooking, and sharing recipes worth
                        setting the table for.
                    </p>
                </div>
            </div>
        </div>

        <!-- Right: Form panel -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-10 relative">
            <!-- subtle texture / vignette -->
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(201,161,90,0.07),transparent_45%)]"></div>

            <div class="w-full max-w-sm relative">

                <!-- mobile-only brand mark -->
                <div class="lg:hidden mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#c9a15a]"></span>
                    <span class="text-xs font-medium uppercase tracking-[0.25em] text-neutral-400">Resepku</span>
                </div>

                <div class="mb-8">
                    <span class="text-xs font-medium uppercase tracking-[0.2em] text-[#c9a15a]">Get started</span>
                    <h1 class="font-display text-3xl font-semibold text-white mt-2">Create your account</h1>
                    <p class="text-neutral-500 text-sm mt-2">Pull up a chair — it only takes a minute.</p>
                </div>

                <form action="" method="POST" class="space-y-4">
                    <div>
                        <label for="name" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Full Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?= htmlspecialchars($name ?? '') ?>"
                            required
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                            placeholder="Jane Doe"
                        >
                    </div>

                    <div>
                        <label for="username" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="<?= htmlspecialchars($username ?? '') ?>"
                            required
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                            placeholder="janedoe"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($email ?? '') ?>"
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                            placeholder="jane@example.com"
                        >
                    </div>

                    <div>
                        <label for="pass" class="block text-xs font-medium text-neutral-400 mb-1.5 tracking-wide">Password</label>
                        <input
                            type="password"
                            id="pass"
                            name="pass"
                            required
                            class="w-full px-4 py-3 rounded-lg bg-[#161311] border border-neutral-800 text-sm text-neutral-100 placeholder-neutral-600 focus:outline-none focus:border-[#c9a15a] focus:ring-1 focus:ring-[#c9a15a] transition"
                            placeholder="••••••••"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full mt-2 bg-gradient-to-r from-[#7a1f22] to-[#5c1618] hover:from-[#8c2427] hover:to-[#6b1a1c] text-white text-sm font-medium py-3 rounded-lg transition-all shadow-lg shadow-[#5c1618]/30 focus:outline-none focus:ring-2 focus:ring-[#c9a15a] focus:ring-offset-2 focus:ring-offset-[#0d0b0a]"
                    >
                        Create Account
                    </button>
                </form>

                <p class="text-center text-xs text-neutral-500 mt-6">
                    Already have an account?
                    <a href="login.php" class="text-[#c9a15a] hover:text-[#dab879] font-medium transition-colors">Sign in</a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>