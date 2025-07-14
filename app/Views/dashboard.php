<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CampSite</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons CDN (tetap digunakan untuk ikon) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Konfigurasi Kustom Tailwind (Opsional, untuk warna tema) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-primary': '#2E7D32', // green-800
                        'brand-secondary': '#4CAF50', // green-500
                        'brand-dark': '#1B5E20', // green-900
                        'brand-light': '#F1F8E9', // green-50
                        'brand-accent': '#FF9800', // orange-500
                    }
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'], // Font lebih modern
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Mengaplikasikan font Inter ke body */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">

    <!-- Header / Navbar -->
    <nav class="bg-brand-dark shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <!-- Logo -->
                <a class="flex items-center text-2xl font-bold text-white" href="<?= base_url(
                    "dashboard"
                ) ?>">
                    <i class="bi bi-tree-fill mr-2 text-brand-secondary"></i>
                    <span>CampSite</span>
                </a>

                <!-- Menu Utama (Desktop) -->
                <div class="hidden md:flex items-center space-x-2">
                    <a class="flex items-center text-green-100 hover:text-white hover:bg-white/10 px-3 py-2 rounded-md transition-colors duration-300" href="<?= base_url(
                        "dashboard"
                    ) ?>">
                        <i class="bi bi-speedometer2 mr-2"></i> Dashboard
                    </a>
                    <a class="flex items-center text-green-100 hover:text-white hover:bg-white/10 px-3 py-2 rounded-md transition-colors duration-300" href="<?= base_url(
                        "campsites"
                    ) ?>">
                        <i class="bi bi-geo-alt mr-2"></i> Lokasi
                    </a>
                    <a class="flex items-center text-green-100 hover:text-white hover:bg-white/10 px-3 py-2 rounded-md transition-colors duration-300" href="<?= base_url(
                        "my-bookings"
                    ) ?>">
                        <i class="bi bi-calendar-check mr-2"></i> Pemesanan
                    </a>
                </div>

                <!-- User Info & Logout (Desktop) -->
                <div class="hidden md:flex items-center space-x-4">
                    <div class="flex items-center text-white">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-brand-secondary text-white font-bold text-lg mr-3">
                             <?= strtoupper(substr($username, 0, 1)) ?>
                        </div>
                        <span class="font-medium"><?= esc($username) ?></span>
                    </div>
                    <a class="bg-transparent border border-white/50 text-white/80 hover:bg-white hover:text-brand-dark px-4 py-2 rounded-lg text-sm font-semibold flex items-center transition-all duration-300" href="<?= base_url(
                        "logout"
                    ) ?>">
                        <i class="bi bi-box-arrow-right mr-2"></i> Logout
                    </a>
                </div>

                <!-- Tombol Hamburger (Mobile) -->
                <div class="md:hidden">
                    <button id="menu-btn" class="text-white focus:outline-none">
                        <i class="bi bi-list text-3xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobile-menu" class="hidden md:hidden px-4 pt-2 pb-4 space-y-2 bg-brand-dark">
             <a class="block flex items-center text-green-100 hover:text-white hover:bg-white/10 px-3 py-2 rounded-md transition-colors duration-300" href="<?= base_url(
                 "dashboard"
             ) ?>">
                <i class="bi bi-speedometer2 mr-2"></i> Dashboard
            </a>
            <a class="block flex items-center text-green-100 hover:text-white hover:bg-white/10 px-3 py-2 rounded-md transition-colors duration-300" href="<?= base_url(
                "campsites"
            ) ?>">
                <i class="bi bi-geo-alt mr-2"></i> Lokasi Perkemahan
            </a>
            <a class="block flex items-center text-green-100 hover:text-white hover:bg-white/10 px-3 py-2 rounded-md transition-colors duration-300" href="<?= base_url(
                "my-bookings"
            ) ?>">
                <i class="bi bi-calendar-check mr-2"></i> Pemesanan Saya
            </a>
            <div class="border-t border-white/20 pt-4 mt-4 space-y-3">
                 <div class="flex items-center text-white">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-brand-secondary text-white font-bold text-lg mr-3">
                         <?= strtoupper(substr($username, 0, 1)) ?>
                    </div>
                    <span class="font-medium"><?= esc($username) ?></span>
                </div>
                <a class="w-full text-center bg-brand-secondary/80 text-white hover:bg-brand-secondary px-4 py-2 rounded-lg font-semibold flex items-center justify-center transition-all duration-300" href="<?= base_url(
                    "logout"
                ) ?>">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container mx-auto p-4 md:p-8">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-br from-brand-primary to-brand-secondary text-white p-8 rounded-2xl shadow-lg mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2 flex items-center">
                <i class="bi bi-emoji-sunglasses mr-3"></i>
                Selamat datang, <?= esc($username) ?>!
            </h1>
            <p class="text-green-100 max-w-2xl">Jelajahi dan pesan lokasi perkemahan terbaik untuk petualangan Anda berikutnya dengan mudah.</p>
        </div>

        <!-- Kartu Aksi Cepat -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1: Jelajahi Lokasi -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 p-6 flex flex-col">
                <div class="flex items-center justify-center w-16 h-16 bg-brand-light text-brand-primary rounded-full mb-5">
                    <i class="bi bi-compass-fill text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Lokasi Perkemahan</h3>
                <p class="text-slate-600 mb-5 flex-grow">Jelajahi berbagai lokasi perkemahan indah yang tersedia untuk petualangan Anda.</p>
                <a href="<?= base_url(
                    "campsites"
                ) ?>" class="mt-auto inline-flex items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white bg-brand-primary hover:bg-brand-dark transition-colors">
                    <i class="bi bi-search mr-2"></i> Jelajahi Lokasi
                </a>
            </div>

            <!-- Card 2: Pemesanan Saya -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 p-6 flex flex-col">
                <div class="flex items-center justify-center w-16 h-16 bg-blue-50 text-blue-600 rounded-full mb-5">
                    <i class="bi bi-list-check text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Pemesanan Saya</h3>
                <p class="text-slate-600 mb-5 flex-grow">Lihat dan kelola semua pemesanan lokasi perkemahan yang telah Anda buat.</p>
                <a href="<?= base_url(
                    "my-bookings"
                ) ?>" class="mt-auto inline-flex items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="bi bi-eye mr-2"></i> Lihat Pemesanan
                </a>
            </div>

            <!-- Card 3: Petualangan Baru -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 p-6 flex flex-col">
                <div class="flex items-center justify-center w-16 h-16 bg-orange-50 text-brand-accent rounded-full mb-5">
                    <i class="bi bi-journal-plus text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Petualangan Baru</h3>
                <p class="text-slate-600 mb-5 flex-grow">Temukan destinasi berkemah baru dan mulai petualangan Anda selanjutnya.</p>
                <a href="<?= base_url(
                    "campsites"
                ) ?>" class="mt-auto inline-flex items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white bg-brand-accent hover:bg-orange-600 transition-colors">
                    <i class="bi bi-plus-circle mr-2"></i> Buat Pemesanan Baru
                </a>
            </div>
        </div>

        <!-- Petunjuk Penggunaan -->
        <div class="mt-12 bg-white rounded-2xl shadow-md p-6 md:p-8">
            <h3 class="flex items-center text-xl font-bold text-slate-800 mb-6">
                <i class="bi bi-info-circle-fill mr-3 text-slate-500"></i>
                Cara Memesan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                <!-- Step 1 -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-brand-light text-brand-dark font-bold text-xl">1</div>
                    <div>
                        <h4 class="font-semibold text-slate-700">Jelajahi Lokasi</h4>
                        <p class="text-sm text-slate-500 mt-1">Lihat daftar lokasi perkemahan yang tersedia.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="flex items-start space-x-4">
                     <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-brand-light text-brand-dark font-bold text-xl">2</div>
                    <div>
                        <h4 class="font-semibold text-slate-700">Pilih Tanggal</h4>
                        <p class="text-sm text-slate-500 mt-1">Pilih tanggal check-in dan check-out.</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="flex items-start space-x-4">
                     <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-brand-light text-brand-dark font-bold text-xl">3</div>
                    <div>
                        <h4 class="font-semibold text-slate-700">Konfirmasi & Bayar</h4>
                        <p class="text-sm text-slate-500 mt-1">Selesaikan pemesanan dan bersiaplah berkemah!</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript untuk menu mobile -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Menambahkan kelas 'active' pada link navbar (jika diperlukan)
        // Logika ini disederhanakan, Anda bisa menyesuaikan dengan router framework Anda
        document.addEventListener('DOMContentLoaded', function() {
            const currentLocation = window.location.href;
            const navLinks = document.querySelectorAll('nav a');

            navLinks.forEach(link => {
                if (link.href === currentLocation) {
                    link.classList.add('bg-white/10'); // Kelas 'active' untuk Tailwind
                    link.classList.add('text-white');
                }
            });
        });
    </script>
</body>
</html>
