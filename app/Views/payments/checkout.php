<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - SedauCamp</title>
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
                <li class="font-semibold text-slate-700">Pembayaran</li>
            </ol>
        </nav>

        <?php if (session()->getFlashdata("error")): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6" role="alert"><p><?= session()->getFlashdata(
                "error"
            ) ?></p></div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-br from-brand-green to-brand-green-light text-white p-6 md:p-8">
                <h1 class="text-3xl font-bold flex items-center"><i class="bi bi-credit-card-fill mr-3"></i>Selesaikan Pembayaran Anda</h1>
                <p class="text-green-100 mt-1">Satu langkah lagi untuk mengamankan petualangan Anda!</p>
            </div>

            <form action="<?= base_url(
                "payments/store"
            ) ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="booking_id" value="<?= esc(
                    $booking["id"]
                ) ?>">
                <input type="hidden" name="amount" value="<?= esc(
                    $booking["total_price"]
                ) ?>">

                <div class="grid grid-cols-1 lg:grid-cols-5">
                    <!-- Kolom Kiri: Metode Pembayaran -->
                    <div class="lg:col-span-3 p-6 md:p-8 border-b lg:border-b-0 lg:border-r border-slate-200">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">1. Pilih Metode Pembayaran</h2>
                        <div class="space-y-4">
                            <!-- Metode Pembayaran (JS akan menangani logika) -->
                            <!-- Opsi Bank Transfer -->
                            <div class="payment-method-option border-2 border-brand-green bg-brand-green-pale rounded-lg p-4 transition-all">
                                <label for="bank_transfer" class="flex items-start cursor-pointer">
                                    <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="mt-1 h-4 w-4 text-brand-green focus:ring-brand-green" checked>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center">
                                            <i class="bi bi-bank2 text-2xl text-brand-green mr-3"></i>
                                            <span class="font-bold text-slate-800">Transfer Bank</span>
                                        </div>
                                        <div class="payment-method-content mt-4 space-y-3 text-sm text-slate-600">
                                            <p>Silakan transfer ke rekening <strong>Bank BCA: 1234567890</strong> a.n. PT SedauCamp Indonesia.</p>
                                            <div>
                                                <label for="proof_of_payment_bank" class="font-medium text-slate-700">Unggah Bukti Transfer</label>
                                                <input type="file" id="proof_of_payment_bank" name="proof_of_payment" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-green-pale file:text-brand-green-dark hover:file:bg-brand-green/20 mt-1" required>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Opsi E-Wallet -->
                             <div class="payment-method-option border-2 border-slate-200 rounded-lg p-4 transition-all">
                                <label for="e_wallet" class="flex items-start cursor-pointer">
                                    <input type="radio" id="e_wallet" name="payment_method" value="e_wallet" class="mt-1 h-4 w-4 text-brand-green focus:ring-brand-green">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center">
                                            <i class="bi bi-wallet2 text-2xl text-brand-green mr-3"></i>
                                            <span class="font-bold text-slate-800">E-Wallet (OVO / GoPay / DANA)</span>
                                        </div>
                                        <div class="payment-method-content hidden mt-4 space-y-3 text-sm text-slate-600">
                                            <p>Silakan kirim pembayaran ke nomor <strong>0812-3456-7890</strong>.</p>
                                            <div>
                                                <label for="proof_of_payment_ewallet" class="font-medium text-slate-700">Unggah Bukti Pembayaran</label>
                                                <input type="file" id="proof_of_payment_ewallet" name="proof_of_payment_ewallet" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-green-pale file:text-brand-green-dark hover:file:bg-brand-green/20 mt-1">
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Ringkasan -->
                    <div class="lg:col-span-2 p-6 md:p-8 bg-slate-50">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">2. Ringkasan Pesanan</h2>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start"><i class="bi bi-geo-alt-fill w-5 text-brand-green mr-2"></i><div><strong>Lokasi:</strong><br><?= esc(
                                $booking["campsite_name"] ?? "N/A"
                            ) ?></div></div>
                            <div class="flex items-center"><i class="bi bi-calendar-event w-5 text-brand-green mr-2"></i><div><strong>Check-in:</strong> <?= date(
                                "d M Y",
                                strtotime($booking["check_in_date"])
                            ) ?></div></div>
                            <div class="flex items-center"><i class="bi bi-calendar-x w-5 text-brand-green mr-2"></i><div><strong>Check-out:</strong> <?= date(
                                "d M Y",
                                strtotime($booking["check_out_date"])
                            ) ?></div></div>
                            <div class="flex items-center"><i class="bi bi-moon-stars-fill w-5 text-brand-green mr-2"></i><div><strong>Durasi:</strong> <?= ceil(
                                (strtotime($booking["check_out_date"]) -
                                    strtotime($booking["check_in_date"])) /
                                    (60 * 60 * 24)
                            ) ?> malam</div></div>
                            <div class="flex items-center"><i class="bi bi-tag-fill w-5 text-brand-green mr-2"></i><div><strong>ID Pesanan:</strong> #<?= esc(
                                $booking["id"]
                            ) ?></div></div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-200">
                             <!-- PASTIKAN $booking['total_price'] ADA NILAINYA DARI CONTROLLER -->
                            <div class="flex justify-between text-slate-600"><span>Subtotal</span><span>Rp<?= number_format(
                                $booking["total_price"] ?? 0,
                                0,
                                ",",
                                "."
                            ) ?></span></div>
                            <div class="flex justify-between text-slate-600 mt-1"><span>Biaya Layanan</span><span>Rp0</span></div>
                            <div class="flex justify-between font-bold text-xl text-brand-green-dark mt-4"><span>Total Pembayaran</span><span class="text-brand-accent-dark">Rp<?= number_format(
                                $booking["total_price"] ?? 0,
                                0,
                                ",",
                                "."
                            ) ?></span></div>
                        </div>

                        <div class="mt-8">
                             <button type="submit" class="w-full bg-brand-green hover:bg-brand-green-dark text-white font-bold py-3 px-4 rounded-lg text-lg transition-colors duration-300">
                                <i class="bi bi-check-circle-fill mr-2"></i>Konfirmasi Pembayaran
                            </button>
                             <a href="<?= base_url(
                                 "my-bookings"
                             ) ?>" class="w-full block text-center mt-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // JavaScript yang sama dari sebelumnya, sudah benar.
        document.addEventListener('DOMContentLoaded', function () {
            const paymentOptions = document.querySelectorAll('input[name="payment_method"]');

            paymentOptions.forEach(option => {
                option.addEventListener('change', function() {
                    document.querySelectorAll('.payment-method-option').forEach(el => {
                        el.classList.remove('border-brand-green', 'bg-brand-green-pale');
                        el.classList.add('border-slate-200');
                        el.querySelector('.payment-method-content').classList.add('hidden');
                        const fileInput = el.querySelector('input[type="file"]');
                        if (fileInput) fileInput.required = false;
                    });

                    const parent = this.closest('.payment-method-option');
                    parent.classList.add('border-brand-green', 'bg-brand-green-pale');
                    parent.classList.remove('border-slate-200');
                    parent.querySelector('.payment-method-content').classList.remove('hidden');
                    const fileInput = parent.querySelector('input[type="file"]');
                    if (fileInput) fileInput.required = true;
                });
            });
        });
    </script>
</body>
</html>
