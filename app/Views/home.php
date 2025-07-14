<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SedauCamp - Temukan Petualangan Berkemah Terbaik</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons CDN (untuk ikon) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Konfigurasi Kustom Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'brand-green': {
                            DEFAULT: '#2E7D32',
                            'light': '#4CAF50',
                            'dark': '#1B5E20',
                            'pale': '#F1F8E9',
                        },
                        'brand-accent': {
                            DEFAULT: '#FFB300', // Amber
                            'dark': '#FF8F00',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Mengaplikasikan font Inter dan anti-aliasing untuk teks yang lebih halus */
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /* Efek bayangan halus untuk teks di atas gambar */
        .text-shadow {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <!-- Header / Navbar -->
    <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a class="flex items-center text-2xl font-bold text-white text-shadow" href="<?= base_url() ?>">
                    <i class="bi bi-tree-fill mr-2"></i>
                    <span>SedauCamp</span>
                </a>

                <!-- Navigasi Desktop -->
                <nav class="hidden md:flex items-center space-x-4">
                    <a href="<?= base_url() ?>" class="text-white/80 hover:text-white font-medium transition-colors">Beranda</a>
                    <a href="<?= base_url(
                        "register"
                    ) ?>" class="text-white/80 hover:text-white font-medium transition-colors">Daftar</a>
                    <a href="<?= base_url(
                        "login"
                    ) ?>" class="bg-brand-green hover:bg-brand-green-dark text-white font-semibold py-2 px-5 rounded-full transition-all duration-300 transform hover:scale-105">
                        Masuk
                    </a>
                </nav>

                <!-- Tombol Hamburger Mobile -->
                <button id="menu-btn" class="md:hidden text-white text-3xl z-50">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
         <!-- Menu Mobile -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-0 left-0 w-full h-screen bg-brand-green-dark/95 backdrop-blur-lg flex flex-col items-center justify-center space-y-8 text-2xl">
            <a href="<?= base_url() ?>" class="text-white hover:text-brand-accent transition-colors">Beranda</a>
            <a href="<?= base_url(
                "register"
            ) ?>" class="text-white hover:text-brand-accent transition-colors">Daftar</a>
            <a href="<?= base_url(
                "login"
            ) ?>" class="bg-brand-accent hover:bg-brand-accent-dark text-white font-semibold py-3 px-8 rounded-full transition-all duration-300">
                Masuk
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-white text-center">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-black/60"></div>
        <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80" alt="Kemah di bawah bintang" class="absolute inset-0 w-full h-full object-cover">

        <!-- Konten Hero -->
        <div class="relative z-10 px-4">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-4 text-shadow leading-tight">Temukan Surga Berkemah Anda</h1>
            <p class="max-w-3xl mx-auto text-lg md:text-xl text-white/90 mb-8 text-shadow">
                Jelajahi lokasi-lokasi perkemahan paling memukau di Indonesia. Mulai dari pegunungan yang sejuk hingga pantai yang eksotis, petualangan Anda dimulai di sini.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?= base_url(
                    "register"
                ) ?>" class="w-full sm:w-auto bg-brand-green hover:bg-brand-green-dark text-white font-bold py-3 px-8 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Mulai Petualangan
                </a>
                <a href="<?= base_url(
                    "login"
                ) ?>" class="w-full sm:w-auto bg-white/20 backdrop-blur-sm border border-white/30 hover:bg-white/30 text-white font-semibold py-3 px-8 rounded-full text-lg transition-colors duration-300">
                    Sudah Punya Akun?
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-brand-green-pale py-20 lg:py-28">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-green-dark mb-4">Kenapa Memilih SedauCamp?</h2>
                <p class="text-lg text-slate-600">Kami menyediakan platform yang mudah, aman, dan lengkap untuk semua kebutuhan perkemahan Anda.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="text-center p-6">
                    <div class="flex items-center justify-center mx-auto w-20 h-20 rounded-full bg-brand-green text-white mb-6 shadow-lg">
                        <i class="bi bi-map-fill text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Lokasi Terkurasi</h3>
                    <p class="text-slate-500">Pilihan lokasi perkemahan terbaik yang telah kami verifikasi, dari yang populer hingga permata tersembunyi.</p>
                </div>
                <!-- Feature 2 -->
                <div class="text-center p-6">
                    <div class="flex items-center justify-center mx-auto w-20 h-20 rounded-full bg-brand-green text-white mb-6 shadow-lg">
                        <i class="bi bi-shield-check text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Pemesanan Aman & Mudah</h3>
                    <p class="text-slate-500">Proses booking hanya beberapa klik dengan sistem pembayaran yang aman dan terjamin.</p>
                </div>
                <!-- Feature 3 -->
                <div class="text-center p-6">
                    <div class="flex items-center justify-center mx-auto w-20 h-20 rounded-full bg-brand-green text-white mb-6 shadow-lg">
                        <i class="bi bi-stars text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Pengalaman Terbaik</h3>
                    <p class="text-slate-500">Detail lengkap, ulasan dari komunitas, dan dukungan pelanggan untuk memastikan pengalaman tak terlupakan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Campsites Section -->
    <section class="bg-white py-20 lg:py-28">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Lokasi Perkemahan Populer</h2>
                <p class="text-lg text-slate-600">Jelajahi destinasi favorit para petualang yang siap menyambut Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (empty($featured_campsites)): ?>
                    <div class="col-span-full text-center py-12">
                        <i class="bi bi-emoji-frown text-6xl text-slate-300 mb-4"></i>
                        <p class="text-xl text-slate-500">Maaf, belum ada lokasi perkemahan yang tersedia saat ini.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($featured_campsites as $campsite): ?>
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                            <div class="relative">
                                <img src="<?= $campsite["image"]
                                    ? base_url(
                                        "uploads/campsites/" .
                                            $campsite["image"]
                                    )
                                    : "https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80" ?>"
                                     alt="<?= esc($campsite["name"]) ?>"
                                     class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute top-4 right-4 bg-brand-accent text-white text-sm font-bold py-1.5 px-4 rounded-full shadow-md">
                                    Rp<?= number_format(
                                        $campsite["price_per_night"],
                                        0,
                                        ",",
                                        "."
                                    ) ?>/malam
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-800 mb-1 truncate"><?= esc(
                                    $campsite["name"]
                                ) ?></h3>
                                <p class="text-slate-500 text-sm mb-3 flex items-center">
                                    <i class="bi bi-geo-alt-fill mr-1.5"></i> <?= esc(
                                        $campsite["location"]
                                    ) ?>
                                </p>
                                <p class="text-slate-600 text-sm mb-5 h-20 overflow-hidden">
                                    <?= substr(
                                        esc($campsite["description"]),
                                        0,
                                        120
                                    ) ?>...
                                </p>
                                <a href="<?= base_url(
                                    "login"
                                ) ?>" class="w-full text-center bg-brand-green-light hover:bg-brand-green-dark text-white font-semibold py-2.5 px-5 rounded-lg transition-colors duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($featured_campsites)): ?>
            <div class="text-center mt-16">
                <a href="<?= base_url(
                    "login"
                ) ?>" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                    Lihat Semua Lokasi <i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="relative bg-brand-green-dark py-20 lg:py-28 text-white text-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('https://images.unsplash.com/photo-1517823382935-51bfcb0ec6bc?auto=format&fit=crop&w=1920&q=80')"></div>
        <div class="relative container mx-auto px-4">
            <h2 class="text-3xl md:text-5xl font-extrabold mb-4">Siap untuk Petualangan Berikutnya?</h2>
            <p class="max-w-2xl mx-auto text-lg text-green-100/80 mb-8">
                Jangan tunda lagi impian berkemah Anda. Daftar sekarang, temukan tempat favorit, dan buat kenangan tak terlupakan.
            </p>
            <a href="<?= base_url(
                "register"
            ) ?>" class="bg-brand-accent hover:bg-brand-accent-dark text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                Daftar Sekarang, Gratis!
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300">
        <div class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Tentang SedauCamp -->
                <div class="col-span-1 md:col-span-2 lg:col-span-1">
                    <h4 class="text-lg font-semibold text-white mb-4">Tentang SedauCamp</h4>
                    <p class="text-sm mb-4">Platform terdepan untuk menemukan dan memesan lokasi perkemahan unik di seluruh pelosok Indonesia.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="bi bi-facebook text-xl"></i></a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="bi bi-instagram text-xl"></i></a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="bi bi-twitter text-xl"></i></a>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="bi bi-youtube text-xl"></i></a>
                    </div>
                </div>
                <!-- Link Cepat -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Link Cepat</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="<?= base_url() ?>" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="<?= base_url(
                            "register"
                        ) ?>" class="hover:text-white transition-colors">Daftar</a></li>
                        <li><a href="<?= base_url(
                            "login"
                        ) ?>" class="hover:text-white transition-colors">Masuk</a></li>
                    </ul>
                </div>
                <!-- Hubungi Kami -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start"><i class="bi bi-geo-alt-fill mr-3 mt-1"></i> Jl. Rimba Raya No. 1, Sedau, Indonesia</li>
                        <li class="flex items-center"><i class="bi bi-telephone-fill mr-3"></i> (021) 123-SEDACAMP</li>
                        <li class="flex items-center"><i class="bi bi-envelope-fill mr-3"></i> halo@sedau.camp</li>
                    </ul>
                </div>
                 <!-- Newsletter -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Dapatkan Info Terbaru</h4>
                    <p class="text-sm mb-3">Daftarkan email Anda untuk info lokasi baru dan promo spesial.</p>
                    <form class="flex">
                        <input type="email" placeholder="Email Anda" class="w-full bg-slate-800 text-white rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-green">
                        <button type="submit" class="bg-brand-green hover:bg-brand-green-dark text-white font-bold px-4 rounded-r-md transition-colors"><i class="bi bi-send-fill"></i></button>
                    </form>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-sm text-slate-400">
                <p>© <?= date(
                    "Y"
                ) ?> SedauCamp. Dibuat dengan <i class="bi bi-heart-fill text-red-500"></i> untuk para petualang.</p>
            </div>
        </div>
    </footer>


    <script>
        const navbar = document.getElementById('navbar');
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        // Navbar scroll effect
        window.onscroll = function() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                navbar.classList.add('bg-brand-green-dark/90', 'shadow-lg', 'backdrop-blur-sm');
            } else {
                navbar.classList.remove('bg-brand-green-dark/90', 'shadow-lg', 'backdrop-blur-sm');
            }
        };

        // Mobile menu toggle
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            // Ganti ikon hamburger menjadi X dan sebaliknya
            if (!mobileMenu.classList.contains('hidden')) {
                menuBtn.innerHTML = '<i class="bi bi-x-lg"></i>';
            } else {
                menuBtn.innerHTML = '<i class="bi bi-list"></i>';
            }
        });
    </script>
</body>
</html>
