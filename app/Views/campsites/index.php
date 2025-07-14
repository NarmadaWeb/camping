<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi Perkemahan - SedauCamp</title>
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

    <!-- Navbar -->
    <nav class="bg-brand-green-dark shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <a class="flex items-center text-2xl font-bold text-white" href="<?= base_url(
                    "dashboard"
                ) ?>">
                    <i class="bi bi-tree-fill mr-2 text-brand-green-light"></i><span>SedauCamp</span>
                </a>
                <div class="hidden md:flex items-center space-x-2">
                    <a class="flex items-center text-green-100 hover:text-white px-3 py-2 rounded-md transition-colors" href="<?= base_url(
                        "dashboard"
                    ) ?>"><i class="bi bi-speedometer2 mr-2"></i>Dashboard</a>
                    <a class="flex items-center text-white bg-white/10 font-semibold px-3 py-2 rounded-md transition-colors" href="<?= base_url(
                        "campsites"
                    ) ?>"><i class="bi bi-geo-alt mr-2"></i>Lokasi</a>
                    <a class="flex items-center text-green-100 hover:text-white hover:bg-white/10 px-3 py-2 rounded-md transition-colors" href="<?= base_url(
                        "my-bookings"
                    ) ?>"><i class="bi bi-calendar-check mr-2"></i>Pemesanan</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <div class="flex items-center text-white">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-brand-green-light text-white font-bold text-lg mr-3"><?= strtoupper(
                            substr(session()->get("username"), 0, 1)
                        ) ?></div>
                        <span class="font-medium"><?= esc(
                            session()->get("username")
                        ) ?></span>
                    </div>
                    <a class="bg-transparent border border-white/50 text-white/80 hover:bg-white hover:text-brand-green-dark px-4 py-2 rounded-lg text-sm font-semibold flex items-center transition-all" href="<?= base_url(
                        "logout"
                    ) ?>"><i class="bi bi-box-arrow-right mr-2"></i>Logout</a>
                </div>
                 <!-- Mobile menu button, etc. can be added here if needed -->
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4 md:p-8">
        <!-- Page Header -->
        <div class="bg-gradient-to-br from-brand-green to-brand-green-light text-white p-8 rounded-2xl shadow-lg mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-4xl font-bold flex items-center"><i class="bi bi-map-fill mr-3"></i>Lokasi Perkemahan</h1>
                    <p class="text-green-100 mt-2">Temukan dan jelajahi tempat terbaik untuk petualangan Anda berikutnya.</p>
                </div>
                <div class="bg-white/20 text-white font-semibold py-2 px-4 rounded-lg mt-4 md:mt-0">
                    <?= count($campsites) ?> Lokasi Tersedia
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                <div class="md:col-span-8">
                    <label for="search-input" class="block text-sm font-medium text-slate-700 mb-1"><i class="bi bi-search mr-1"></i>Cari Lokasi</label>
                    <input type="text" id="search-input" class="w-full rounded-lg border-slate-300 focus:border-brand-green focus:ring-brand-green" placeholder="Ketik nama atau lokasi perkemahan...">
                </div>
                <div class="md:col-span-4">
                    <label for="sort-select" class="block text-sm font-medium text-slate-700 mb-1"><i class="bi bi-sort-down mr-1"></i>Urutkan</label>
                    <select id="sort-select" class="w-full rounded-lg border-slate-300 focus:border-brand-green focus:ring-brand-green">
                        <option value="name">Nama (A-Z)</option>
                        <option value="price-low">Harga: Terendah</option>
                        <option value="price-high">Harga: Tertinggi</option>
                        <option value="capacity">Kapasitas: Terbanyak</option>
                    </select>
                </div>
            </div>
        </div>

        <?php if (empty($campsites)): ?>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 rounded-lg text-center" role="alert">
                <i class="bi bi-info-circle-fill text-4xl mb-4"></i>
                <h4 class="font-bold text-xl">Belum Ada Lokasi</h4>
                <p>Saat ini belum ada lokasi perkemahan yang tersedia. Silakan cek kembali nanti.</p>
            </div>
        <?php else: ?>
            <div id="campsites-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($campsites as $campsite): ?>
                    <div class="campsite-item bg-white rounded-2xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 flex flex-col">
                        <div class="relative">
                            <img src="<?= $campsite["image"]
                                ? base_url(
                                    "uploads/campsites/" . $campsite["image"]
                                )
                                : "https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80" ?>" alt="<?= esc(
    $campsite["name"]
) ?>" class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4 bg-brand-accent text-white text-sm font-bold py-1.5 px-4 rounded-full shadow-md">
                                Rp<?= number_format(
                                    $campsite["price_per_night"],
                                    0,
                                    ",",
                                    "."
                                ) ?>/malam
                            </div>
                        </div>
                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-xl font-bold text-slate-800 mb-1 truncate" title="<?= esc(
                                $campsite["name"]
                            ) ?>"><?= esc($campsite["name"]) ?></h3>
                            <p class="text-slate-500 text-sm mb-4 flex items-center">
                                <i class="bi bi-geo-alt-fill mr-1.5"></i> <span class="location-text"><?= esc(
                                    $campsite["location"]
                                ) ?></span>
                            </p>
                            <p class="text-slate-600 text-sm mb-5 flex-grow description-text">
                                <?= esc(
                                    mb_strimwidth(
                                        $campsite["description"],
                                        0,
                                        120,
                                        "..."
                                    )
                                ) ?>
                            </p>
                            <div class="text-sm text-slate-500 border-t border-slate-200 pt-4 mt-auto space-y-2">
                                <div class="flex justify-between items-center capacity-feature">
                                    <span><i class="bi bi-people-fill mr-2 text-brand-green"></i>Kapasitas</span>
                                    <span class="font-semibold text-slate-700"><?= esc(
                                        $campsite["capacity"]
                                    ) ?> Orang</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span><i class="bi bi-list-stars mr-2 text-brand-green"></i>Fasilitas Utama</span>
                                    <span class="font-semibold text-slate-700"><?= esc(
                                        explode(",", $campsite["facilities"])[0]
                                    ) ?></span>
                                </div>
                            </div>
                            <div class="mt-5">
                                <a href="<?= base_url(
                                    "campsites/view/" . $campsite["id"]
                                ) ?>" class="w-full text-center block bg-brand-green-light hover:bg-brand-green-dark text-white font-semibold py-2.5 px-5 rounded-lg transition-colors duration-300">
                                    Lihat Detail & Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sort-select');
            const searchInput = document.getElementById('search-input');
            const campsitesContainer = document.getElementById('campsites-container');

            if (sortSelect && searchInput && campsitesContainer) {
                const campsiteCards = Array.from(campsitesContainer.querySelectorAll('.campsite-item'));

                const performActions = () => {
                    // 1. Filter
                    const searchTerm = searchInput.value.toLowerCase();
                    campsiteCards.forEach(card => {
                        const title = card.querySelector('h3').innerText.toLowerCase();
                        const location = card.querySelector('.location-text').innerText.toLowerCase();
                        const description = card.querySelector('.description-text').innerText.toLowerCase();
                        if (title.includes(searchTerm) || location.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // 2. Sort
                    let visibleCards = campsiteCards.filter(card => card.style.display !== 'none');
                    const sortBy = sortSelect.value;
                    visibleCards.sort((a, b) => {
                        if (sortBy === 'name') {
                            return a.querySelector('h3').innerText.localeCompare(b.querySelector('h3').innerText);
                        } else if (sortBy === 'price-low' || sortBy === 'price-high') {
                            const priceA = parseInt(a.querySelector('.bg-brand-accent').innerText.replace(/\D/g, ''));
                            const priceB = parseInt(b.querySelector('.bg-brand-accent').innerText.replace(/\D/g, ''));
                            return sortBy === 'price-low' ? priceA - priceB : priceB - priceA;
                        } else if (sortBy === 'capacity') {
                            const capacityA = parseInt(a.querySelector('.capacity-feature span:last-child').innerText);
                            const capacityB = parseInt(b.querySelector('.capacity-feature span:last-child').innerText);
                            return capacityB - capacityA;
                        }
                        return 0;
                    });

                    visibleCards.forEach(card => campsitesContainer.appendChild(card));
                };

                sortSelect.addEventListener('change', performActions);
                searchInput.addEventListener('input', performActions);
            }
        });
    </script>
</body>
</html>
