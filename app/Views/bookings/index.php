<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Saya - SedauCamp</title>
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
                    ) ?>">
                        <i class="bi bi-speedometer2 mr-2"></i>Dashboard
                    </a>
                    <a class="flex items-center text-green-100 hover:text-white px-3 py-2 rounded-md transition-colors" href="<?= base_url(
                        "campsites"
                    ) ?>">
                        <i class="bi bi-geo-alt mr-2"></i>Lokasi
                    </a>
                    <a class="flex items-center text-white bg-white/10 font-semibold px-3 py-2 rounded-md transition-colors" href="<?= base_url(
                        "my-bookings"
                    ) ?>">
                        <i class="bi bi-calendar-check mr-2"></i>Pemesanan
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <div class="flex items-center text-white">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-brand-green-light text-white font-bold text-lg mr-3">
                            <?= strtoupper(
                                substr(session()->get("username"), 0, 1)
                            ) ?>
                        </div>
                        <span class="font-medium"><?= esc(
                            session()->get("username")
                        ) ?></span>
                    </div>
                    <a class="bg-transparent border border-white/50 text-white/80 hover:bg-white hover:text-brand-green-dark px-4 py-2 rounded-lg text-sm font-semibold flex items-center transition-all" href="<?= base_url(
                        "logout"
                    ) ?>">
                        <i class="bi bi-box-arrow-right mr-2"></i>Logout
                    </a>
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
                <li class="font-semibold text-slate-700">Pemesanan Saya</li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800">Pemesanan Saya</h1>
            <a href="<?= base_url(
                "campsites"
            ) ?>" class="bg-brand-green hover:bg-brand-green-dark text-white font-semibold py-2 px-4 rounded-lg flex items-center transition-colors">
                <i class="bi bi-plus-circle mr-2"></i>Pesan Baru
            </a>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata("error")): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert">
                <p><?= session()->getFlashdata("error") ?></p>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata("success")): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
                <p><?= session()->getFlashdata("success") ?></p>
            </div>
        <?php endif; ?>

        <!-- Bookings List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <?php if (empty($bookings)): ?>
                <div class="p-8 text-center">
                    <div class="flex justify-center mb-4">
                        <i class="bi bi-calendar-x text-5xl text-slate-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-700 mb-2">Belum Ada Pemesanan</h3>
                    <p class="text-slate-500 mb-6">Anda belum memiliki pemesanan apa pun. Mulailah dengan menjelajahi lokasi perkemahan.</p>
                    <a href="<?= base_url(
                        "campsites"
                    ) ?>" class="inline-flex items-center bg-brand-green hover:bg-brand-green-dark text-white font-medium py-2 px-5 rounded-lg transition-colors">
                        <i class="bi bi-search mr-2"></i>Jelajahi Lokasi
                    </a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Lokasi Perkemahan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Total Harga</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Pembayaran</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">
                                                <?php if ($booking["image"]): ?>
                                                    <img class="h-12 w-12 rounded-md object-cover" src="<?= base_url(
                                                        "uploads/campsites/" .
                                                            $booking["image"]
                                                    ) ?>" alt="<?= esc(
    $booking["campsite_name"]
) ?>">
                                                <?php else: ?>
                                                    <div class="h-12 w-12 rounded-md bg-brand-green-pale flex items-center justify-center">
                                                        <i class="bi bi-tree text-brand-green text-xl"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-slate-900"><?= esc(
                                                    $booking["campsite_name"]
                                                ) ?></div>
                                                <div class="text-sm text-slate-500"><?= esc(
                                                    $booking["location"]
                                                ) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-slate-900">
                                            <?= date(
                                                "d M Y",
                                                strtotime(
                                                    $booking["check_in_date"]
                                                )
                                            ) ?> -
                                            <?= date(
                                                "d M Y",
                                                strtotime(
                                                    $booking["check_out_date"]
                                                )
                                            ) ?>
                                        </div>
                                        <div class="text-sm text-slate-500">
                                            <?php
                                            $checkIn = new DateTime(
                                                $booking["check_in_date"]
                                            );
                                            $checkOut = new DateTime(
                                                $booking["check_out_date"]
                                            );
                                            $nights = $checkOut->diff($checkIn)
                                                ->days;
                                            echo $nights . " malam";
                                            ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-900">
                                            Rp<?= number_format(
                                                $booking["total_price"],
                                                0,
                                                ",",
                                                "."
                                            ) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $statusClasses = [
                                            "pending" =>
                                                "bg-yellow-100 text-yellow-800",
                                            "confirmed" =>
                                                "bg-blue-100 text-blue-800",
                                            "completed" =>
                                                "bg-green-100 text-green-800",
                                            "cancelled" =>
                                                "bg-red-100 text-red-800",
                                        ];
                                        $statusLabels = [
                                            "pending" => "Menunggu",
                                            "confirmed" => "Dikonfirmasi",
                                            "completed" => "Selesai",
                                            "cancelled" => "Dibatalkan",
                                        ];
                                        $statusClass = isset(
                                            $statusClasses[$booking["status"]]
                                        )
                                            ? $statusClasses[$booking["status"]]
                                            : "bg-slate-100 text-slate-800";
                                        $statusLabel = isset(
                                            $statusLabels[$booking["status"]]
                                        )
                                            ? $statusLabels[$booking["status"]]
                                            : ucfirst($booking["status"]);
                                        ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                            <?= $statusLabel ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $paymentStatusClasses = [
                                            "pending" =>
                                                "bg-yellow-100 text-yellow-800",
                                            "paid" =>
                                                "bg-green-100 text-green-800",
                                            "failed" =>
                                                "bg-red-100 text-red-800",
                                            "expired" =>
                                                "bg-slate-100 text-slate-800",
                                            "refunded" =>
                                                "bg-purple-100 text-purple-800",
                                        ];
                                        $paymentStatusLabels = [
                                            "pending" => "Menunggu Pembayaran",
                                            "paid" => "Sudah Dibayar",
                                            "failed" => "Gagal",
                                            "expired" => "Kedaluwarsa",
                                            "refunded" => "Dikembalikan",
                                        ];

                                        if ($booking["payment_status"]) {
                                            $paymentStatusClass = isset(
                                                $paymentStatusClasses[
                                                    $booking["payment_status"]
                                                ]
                                            )
                                                ? $paymentStatusClasses[
                                                    $booking["payment_status"]
                                                ]
                                                : "bg-slate-100 text-slate-800";
                                            $paymentStatusLabel = isset(
                                                $paymentStatusLabels[
                                                    $booking["payment_status"]
                                                ]
                                            )
                                                ? $paymentStatusLabels[
                                                    $booking["payment_status"]
                                                ]
                                                : ucfirst(
                                                    $booking["payment_status"]
                                                );
                                            echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' .
                                                $paymentStatusClass .
                                                '">' .
                                                $paymentStatusLabel .
                                                "</span>";
                                        } else {
                                            echo '<a href="' .
                                                base_url(
                                                    "payments/checkout/" .
                                                        $booking["id"]
                                                ) .
                                                '" class="text-sm text-brand-green hover:text-brand-green-dark">Bayar Sekarang</a>';
                                        }
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <?php if (
                                                $booking["payment_status"]
                                            ): ?>
                                                <a href="<?= base_url(
                                                    "bookings/payment/" .
                                                        $booking["id"]
                                                ) ?>" class="text-indigo-600 hover:text-indigo-900" title="Lihat Pembayaran">
                                                    <i class="bi bi-credit-card"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (
                                                $booking["status"] !=
                                                    "cancelled" &&
                                                $booking["status"] !=
                                                    "completed"
                                            ): ?>
                                                <a href="<?= base_url(
                                                    "bookings/cancel/" .
                                                        $booking["id"]
                                                ) ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?');" title="Batalkan Pemesanan">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-slate-800 text-white py-12 mt-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center text-2xl font-bold mb-4">
                        <i class="bi bi-tree-fill mr-2 text-brand-green-light"></i>
                        <span>SedauCamp</span>
                    </div>
                    <p class="text-slate-300 mb-4">Temukan pengalaman berkemah terbaik di Kepulauan Natuna dengan SedauCamp.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    <div class="space-y-3 text-slate-300">
                        <p class="flex items-center"><i class="bi bi-geo-alt-fill mr-2 text-brand-green-light"></i> Jl. Sedau, Kec. Natuna, Kepulauan Natuna</p>
                        <p class="flex items-center"><i class="bi bi-envelope-fill mr-2 text-brand-green-light"></i> info@sedaucamp.com</p>
                        <p class="flex items-center"><i class="bi bi-telephone-fill mr-2 text-brand-green-light"></i> +62 812 3456 7890</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center hover:bg-brand-green transition-colors">
                            <i class="bi bi-facebook text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center hover:bg-brand-green transition-colors">
                            <i class="bi bi-instagram text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center hover:bg-brand-green transition-colors">
                            <i class="bi bi-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-700 mt-8 pt-8 text-center text-slate-400">
                <p>&copy; <?= date("Y") ?> SedauCamp. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
