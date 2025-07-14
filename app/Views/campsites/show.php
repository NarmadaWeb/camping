<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($campsite["name"]) ?> - Detail Lokasi - SedauCamp</title>
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
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4 md:p-8">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-6 text-sm">
            <ol class="flex items-center space-x-2 text-slate-500">
                <li><a href="<?= base_url(
                    "dashboard"
                ) ?>" class="hover:text-brand-green">Dashboard</a></li>
                <li><i class="bi bi-chevron-right text-xs"></i></li>
                <li><a href="<?= base_url(
                    "campsites"
                ) ?>" class="hover:text-brand-green">Lokasi Perkemahan</a></li>
                <li><i class="bi bi-chevron-right text-xs"></i></li>
                <li class="font-semibold text-slate-700 truncate"><?= esc(
                    $campsite["name"]
                ) ?></li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-4 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12">
                <!-- Kolom Kiri: Info & Gambar -->
                <div class="lg:col-span-3">
                    <img src="<?= $campsite["image"]
                        ? base_url("uploads/campsites/" . $campsite["image"])
                        : "https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=1920&q=80" ?>" alt="<?= esc(
    $campsite["name"]
) ?>" class="w-full h-96 object-cover rounded-2xl shadow-lg mb-8">

                    <h1 class="text-4xl font-extrabold text-slate-800 mb-2"><?= esc(
                        $campsite["name"]
                    ) ?></h1>
                    <p class="text-slate-500 text-lg mb-6 flex items-center"><i class="bi bi-geo-alt-fill mr-2 text-brand-green"></i><?= esc(
                        $campsite["location"]
                    ) ?></p>

                    <div class="prose max-w-none text-slate-600">
                        <h3 class="text-2xl font-bold text-slate-800 border-b pb-2 mb-4">Tentang Lokasi Ini</h3>
                        <p><?= nl2br(esc($campsite["description"])) ?></p>

                        <h3 class="text-2xl font-bold text-slate-800 border-b pb-2 mb-4 mt-10">Fasilitas yang Tersedia</h3>
                        <?php $facilitiesList = $campsite["facilities"]
                            ? explode(",", $campsite["facilities"])
                            : []; ?>
                        <?php if (empty($facilitiesList)): ?>
                            <p>Tidak ada fasilitas yang tercantum.</p>
                        <?php else: ?>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 not-prose list-none p-0">
                                <?php foreach ($facilitiesList as $facility): ?>
                                    <li class="flex items-center"><i class="bi bi-check-circle-fill text-brand-green mr-3"></i><span><?= trim(
                                        esc($facility)
                                    ) ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <a href="<?= base_url(
                        "campsites"
                    ) ?>" class="inline-flex items-center mt-12 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-5 rounded-lg transition-colors">
                        <i class="bi bi-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                </div>

                <!-- Kolom Kanan: Form Pemesanan (Sticky) -->
                <div class="lg:col-span-2">
                    <div class="sticky top-28">
                        <div class="border border-slate-200 rounded-2xl p-6 shadow-lg bg-white">
                            <h3 class="text-2xl font-bold text-slate-800 mb-5">Pesan Tempat Anda</h3>

                            <!-- Flash Messages -->
                            <?php if (session()->getFlashdata("error")): ?>
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-4" role="alert"><p><?= session()->getFlashdata(
                                    "error"
                                ) ?></p></div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata("success")): ?>
                                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4" role="alert"><p><?= session()->getFlashdata(
                                    "success"
                                ) ?></p></div>
                            <?php endif; ?>
                            <?php if (isset($validation)): ?>
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-4" role="alert"><?= $validation->listErrors() ?></div>
                            <?php endif; ?>

                            <form action="<?= base_url(
                                "bookings/store"
                            ) ?>" method="post" class="space-y-4">
                                <input type="hidden" name="campsite_id" value="<?= esc(
                                    $campsite["id"]
                                ) ?>">
                                <input type="hidden" id="price_per_night_val" name="price_per_night" value="<?= esc(
                                    $campsite["price_per_night"]
                                ) ?>">

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="check_in_date" class="block text-sm font-medium text-slate-700">Check-in</label>
                                        <input type="date" id="check_in_date" name="check_in_date" required min="<?= date(
                                            "Y-m-d"
                                        ) ?>" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-brand-green focus:ring-brand-green">
                                    </div>
                                    <div>
                                        <label for="check_out_date" class="block text-sm font-medium text-slate-700">Check-out</label>
                                        <input type="date" id="check_out_date" name="check_out_date" required min="<?= date(
                                            "Y-m-d",
                                            strtotime("+1 day")
                                        ) ?>" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-brand-green focus:ring-brand-green">
                                    </div>
                                </div>
                                <div>
                                    <label for="number_of_guests" class="block text-sm font-medium text-slate-700">Jumlah Tamu</label>
                                    <input type="number" id="number_of_guests" name="number_of_guests" required min="1" max="<?= esc(
                                        $campsite["capacity"]
                                    ) ?>" value="1" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-brand-green focus:ring-brand-green">
                                    <p class="mt-1 text-xs text-slate-500">Kapasitas maksimal: <?= esc(
                                        $campsite["capacity"]
                                    ) ?> orang</p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 space-y-2 mt-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-600">Rp<?= number_format(
                                            $campsite["price_per_night"],
                                            0,
                                            ",",
                                            "."
                                        ) ?> x <span id="nightCount">1</span> malam</span>
                                        <span class="text-slate-800" id="subTotalPrice">Rp0</span>
                                    </div>
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-slate-800">Total</span>
                                        <span class="text-brand-green" id="totalPrice">Rp0</span>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-brand-green hover:bg-brand-green-dark text-white font-bold py-3 px-4 rounded-lg text-lg transition-colors duration-300">
                                    <i class="bi bi-check-circle-fill mr-2"></i>Pesan Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkInDateEl = document.getElementById('check_in_date');
            const checkOutDateEl = document.getElementById('check_out_date');
            const nightCountEl = document.getElementById('nightCount');
            const subTotalPriceEl = document.getElementById('subTotalPrice');
            const totalPriceEl = document.getElementById('totalPrice');
            const pricePerNight = parseFloat(document.getElementById('price_per_night_val').value);

            const formatCurrency = (amount) => 'Rp' + new Intl.NumberFormat('id-ID').format(amount);

            function calculatePrice() {
                if (!checkInDateEl.value || !checkOutDateEl.value) return;

                const startDate = new Date(checkInDateEl.value);
                const endDate = new Date(checkOutDateEl.value);

                if (endDate <= startDate) {
                    nightCountEl.textContent = '0';
                    subTotalPriceEl.textContent = formatCurrency(0);
                    totalPriceEl.textContent = formatCurrency(0);
                    return;
                }

                const diffTime = endDate - startDate;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                const total = diffDays * pricePerNight;

                nightCountEl.textContent = diffDays;
                subTotalPriceEl.textContent = formatCurrency(total);
                totalPriceEl.textContent = formatCurrency(total);
            }

            checkInDateEl.addEventListener('change', function() {
                const startDate = new Date(this.value);
                const currentEndDate = new Date(checkOutDateEl.value);

                // Set min date for check-out
                startDate.setDate(startDate.getDate() + 1);
                checkOutDateEl.min = startDate.toISOString().split('T')[0];

                // Auto-update check-out if it's no longer valid
                if (currentEndDate <= new Date(this.value)) {
                    checkOutDateEl.value = checkOutDateEl.min;
                }
                calculatePrice();
            });

            checkOutDateEl.addEventListener('change', calculatePrice);

            // Set initial dates and calculate price
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            checkInDateEl.value = today.toISOString().split('T')[0];
            checkOutDateEl.value = tomorrow.toISOString().split('T')[0];
            checkOutDateEl.min = tomorrow.toISOString().split('T')[0]; // Set initial min
            calculatePrice();
        });
    </script>
</body>
</html>
