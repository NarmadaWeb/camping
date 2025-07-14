<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran - SedauCamp</title>
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
                    "my-bookings"
                ) ?>" class="hover:text-brand-green">Pemesanan Saya</a></li>
                <li><i class="bi bi-chevron-right text-xs"></i></li>
                <li class="font-semibold text-slate-700">Detail Pembayaran</li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-brand-green to-brand-green-light text-white p-6 md:p-8">
                <h1 class="text-3xl font-bold flex items-center"><i class="bi bi-receipt-cutoff mr-3"></i>Detail Pembayaran</h1>
                <p class="text-green-100 mt-1">Pemesanan #<?= esc(
                    $booking["id"]
                ) ?> untuk <?= esc($campsite["name"]) ?></p>
            </div>

            <div class="p-6 md:p-8">
                <?php
                $status = strtolower($payment["payment_status"]);
                $statusInfo = [
                    "pending" => [
                        "icon" => "bi-hourglass-split",
                        "color" => "amber",
                        "text" => "PEMBAYARAN SEDANG DIPROSES",
                        "message" =>
                            "Pembayaran Anda sedang dalam proses verifikasi. Mohon tunggu konfirmasi dari tim kami.",
                    ],
                    "completed" => [
                        "icon" => "bi-check-circle-fill",
                        "color" => "green",
                        "text" => "PEMBAYARAN BERHASIL",
                        "message" =>
                            "Pembayaran Anda telah kami terima dan pesanan Anda telah dikonfirmasi.",
                    ],
                    "failed" => [
                        "icon" => "bi-x-circle-fill",
                        "color" => "red",
                        "text" => "PEMBAYARAN GAGAL",
                        "message" =>
                            "Terjadi masalah dengan pembayaran Anda. Silakan hubungi dukungan pelanggan.",
                    ],
                    "refunded" => [
                        "icon" => "bi-arrow-counterclockwise",
                        "color" => "slate",
                        "text" => "DANA DIKEMBALIKAN",
                        "message" =>
                            "Dana untuk pembayaran ini telah dikembalikan.",
                    ],
                ];
                $info = $statusInfo[$status] ?? [
                    "icon" => "bi-question-circle",
                    "color" => "gray",
                    "text" => "TIDAK DIKETAHUI",
                    "message" => "Status pembayaran tidak diketahui.",
                ];
                ?>
                <div class="bg-<?= $info[
                    "color"
                ] ?>-100 border-l-4 border-<?= $info[
    "color"
] ?>-500 text-<?= $info["color"] ?>-700 p-4 rounded-md mb-8" role="alert">
                    <div class="flex"><div class="py-1"><i class="bi <?= $info[
                        "icon"
                    ] ?> text-xl mr-3"></i></div><div><p class="font-bold"><?= $info[
     "text"
 ] ?></p><p class="text-sm"><?= $info["message"] ?></p></div></div>
                </div>

                <!-- === BAGIAN BARU YANG DITAMBAHKAN === -->
                <div class="bg-slate-50 rounded-lg p-5 mb-8 border border-slate-200">
                    <h2 class="text-lg font-bold text-slate-800 border-b pb-2 mb-4">Ringkasan Pemesanan</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                        <div class="flex"><i class="bi bi-geo-alt-fill w-5 text-brand-green mr-2"></i><div><span class="text-slate-500">Lokasi:</span><br><strong class="text-slate-700"><?= esc(
                            $campsite["name"]
                        ) ?></strong></div></div>
                        <div class="flex"><i class="bi bi-clock-history w-5 text-brand-green mr-2"></i><div><span class="text-slate-500">Status Pesanan:</span><br><strong class="text-slate-700"><?= strtoupper(
                            esc($booking["status"])
                        ) ?></strong></div></div>
                        <div class="flex"><i class="bi bi-calendar-range-fill w-5 text-brand-green mr-2"></i><div><span class="text-slate-500">Durasi:</span><br><strong class="text-slate-700"><?= ceil(
                            (strtotime($booking["check_out_date"]) -
                                strtotime($booking["check_in_date"])) /
                                (60 * 60 * 24)
                        ) ?> malam</strong></div></div>
                        <div class="flex"><i class="bi bi-cash-coin w-5 text-brand-green mr-2"></i><div><span class="text-slate-500">Total Tagihan:</span><br><strong class="text-slate-700">Rp<?= number_format(
                            $booking["total_price"],
                            0,
                            ",",
                            "."
                        ) ?></strong></div></div>
                    </div>
                </div>
                <!-- === AKHIR BAGIAN BARU === -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Kolom Kiri: Detail Pembayaran -->
                    <div class="space-y-4 text-sm">
                        <h2 class="text-lg font-bold text-slate-800 border-b pb-2 mb-2">Rincian Transaksi Pembayaran</h2>
                        <div class="flex justify-between"><span class="text-slate-500">ID Pembayaran:</span><span class="font-semibold text-slate-700">#<?= $payment[
                            "id"
                        ] ?></span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Jumlah Dibayar:</span><span class="font-semibold text-slate-700">Rp<?= number_format(
                            $payment["amount"],
                            0,
                            ",",
                            "."
                        ) ?></span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Metode:</span><span class="font-semibold text-slate-700"><?= $payment[
                            "payment_method"
                        ] == "bank_transfer"
                            ? "Transfer Bank"
                            : "E-Wallet" ?></span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Tgl. Pengajuan:</span><span class="font-semibold text-slate-700"><?= date(
                            "d M Y, H:i",
                            strtotime($payment["created_at"])
                        ) ?></span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Tgl. Konfirmasi:</span><span class="font-semibold text-slate-700"><?= $payment[
                            "payment_date"
                        ]
                            ? date(
                                "d M Y, H:i",
                                strtotime($payment["payment_date"])
                            )
                            : "-" ?></span></div>
                    </div>
                    <!-- Kolom Kanan: Bukti Pembayaran -->
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 border-b pb-2 mb-4">Bukti Pembayaran</h2>
                        <a href="<?= base_url(
                            "uploads/payments/" . $payment["proof_of_payment"]
                        ) ?>" target="_blank">
                             <img src="<?= base_url(
                                 "uploads/payments/" .
                                     $payment["proof_of_payment"]
                             ) ?>" class="w-full rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer" alt="Bukti Pembayaran">
                        </a>
                    </div>
                </div>

                 <div class="mt-10 text-center">
                    <a href="<?= base_url(
                        "my-bookings"
                    ) ?>" class="inline-flex items-center bg-brand-green hover:bg-brand-green-dark text-white font-semibold py-2.5 px-6 rounded-lg transition-colors">
                        <i class="bi bi-arrow-left mr-2"></i>Kembali ke Pemesanan Saya
                    </a>
                 </div>
            </div>
        </div>
    </main>

</body>
</html>
