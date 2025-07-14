<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SedauCamp</title>
    <!-- Tailwind CSS & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        'brand-green': { DEFAULT: '#2E7D32', 'light': '#4CAF50', 'dark': '#1B5E20', 'pale': '#F1F8E9' },
                        'brand-accent': { DEFAULT: '#FFB300', 'dark': '#FF8F00' }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
    </style>
</head>
<body class="bg-slate-100">

    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <!-- Kolom Kiri: Form Login -->
            <div class="flex flex-col justify-center p-8 md:p-14">
                <a href="<?= base_url() ?>" class="flex items-center text-3xl font-bold text-brand-green-dark mb-5">
                    <i class="bi bi-tree-fill mr-2 text-brand-green"></i>
                    <span>SedauCamp</span>
                </a>
                <span class="mb-3 text-4xl font-bold text-slate-800">Selamat Datang Kembali</span>
                <span class="font-light text-slate-500 mb-8">
                    Silakan masuk untuk melanjutkan petualangan Anda.
                </span>

                <!-- Flash Messages -->
                <?php if (session()->getFlashdata("success")): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4" role="alert"><p><?= session()->getFlashdata(
                        "success"
                    ) ?></p></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata("error")): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-4" role="alert"><p><?= session()->getFlashdata(
                        "error"
                    ) ?></p></div>
                <?php endif; ?>
                <?php if (isset($validation)): ?>
                    <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4 text-sm" role="alert"><?= $validation->listErrors() ?></div>
                <?php endif; ?>

                <form action="<?= base_url("login/auth") ?>" method="post">
                    <div class="py-4">
                        <label for="username" class="mb-2 text-md font-medium text-slate-700">Username</label>
                        <input type="text" id="username" name="username" value="<?= old(
                            "username"
                        ) ?>" class="w-full p-3 border border-slate-300 rounded-lg placeholder:font-light focus:outline-none focus:ring-2 focus:ring-brand-green" placeholder="Masukkan username Anda" required>
                    </div>
                    <div class="py-4">
                        <label for="password" class="mb-2 text-md font-medium text-slate-700">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full p-3 border border-slate-300 rounded-lg placeholder:font-light focus:outline-none focus:ring-2 focus:ring-brand-green" placeholder="Masukkan password Anda" required>
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-500 hover:text-brand-green">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-brand-green text-white p-3 rounded-lg mb-6 hover:bg-brand-green-dark transition-colors font-bold text-lg">
                        <i class="bi bi-box-arrow-in-right mr-2"></i>Login
                    </button>
                </form>

                <div class="text-center text-slate-500">
                    Belum punya akun?
                    <a href="<?= base_url(
                        "register"
                    ) ?>" class="font-bold text-brand-green hover:underline">Daftar di sini</a>
                </div>
                <a href="<?= base_url() ?>" class="text-sm text-slate-400 hover:text-brand-green text-center mt-6 block"><i class="bi bi-arrow-left mr-1"></i> Kembali ke Beranda</a>
            </div>

            <!-- Kolom Kanan: Gambar -->
            <div class="relative hidden md:block">
                <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=800&q=80" alt="Camping image" class="w-[450px] h-full hidden rounded-r-2xl md:block object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-r-2xl"></div>
                <div class="absolute bottom-10 left-10 text-white">
                    <p class="text-4xl font-extrabold">Petualangan Menanti.</p>
                    <p class="mt-2">Temukan tempat terbaik, ciptakan kenangan.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    </script>
</body>
</html>
