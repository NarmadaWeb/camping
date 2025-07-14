<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CampSite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2E7D32;
            --secondary-color: #558B2F;
            --accent-color: #FF6F00;
            --dark-color: #1B5E20;
            --light-color: #F1F8E9;
            --admin-primary: #1976D2;
            --admin-secondary: #2196F3;
            --admin-accent: #FF9800;
            --admin-dark: #0D47A1;
            --admin-light: #E3F2FD;
            --danger: #f44336;
        }

        body {
            background-color: #f0f4f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            background-color: var(--admin-dark);
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            transition: all 0.3s;
            z-index: 1000;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar .logo {
            text-align: center;
            padding: 10px 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar .logo a {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar .logo i {
            margin-right: 10px;
            font-size: 28px;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-radius: 0;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar .nav-link.active {
            border-left: 4px solid var(--admin-accent);
            font-weight: bold;
        }

        .content {
            margin-left: 250px;
            padding: 20px 30px;
            transition: all 0.3s;
            width: calc(100% - 250px);
        }

        .admin-header {
            background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary));
            color: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card .card-body {
            padding: 25px;
        }

        .stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-card .stat-icon.bg-primary {
            background-color: var(--admin-primary) !important;
        }

        .stat-card .stat-icon.bg-success {
            background-color: var(--secondary-color) !important;
        }

        .stat-card .stat-icon.bg-warning {
            background-color: var(--admin-accent) !important;
        }

        .stat-card .stat-icon.bg-danger {
            background-color: var(--danger) !important;
        }

        .stat-card .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            color: #6c757d;
            font-size: 14px;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #495057;
            padding: 12px 20px;
            font-weight: 500;
            border-radius: 0;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--admin-primary);
            background-color: transparent;
            border-bottom: 3px solid var(--admin-primary);
        }

        .recent-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .recent-card .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 15px 20px;
            font-weight: 600;
        }

        .recent-card .card-body {
            padding: 20px;
        }

        .recent-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .recent-item:last-child {
            border-bottom: none;
        }

        .recent-item .item-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
        }

        .recent-item .item-details {
            flex-grow: 1;
        }

        .recent-item .item-title {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .recent-item .item-info {
            color: #6c757d;
            font-size: 13px;
        }

        .recent-item .item-action {
            margin-left: 10px;
        }

        .user-welcome {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 30px;
            padding: 5px 15px 5px 5px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: var(--admin-light);
            color: var(--admin-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
        }

        .admin-badge {
            display: inline-block;
            background-color: var(--admin-accent);
            color: white;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 30px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <a href="<?= base_url("admin/dashboard") ?>">
                <i class="bi bi-tree"></i> CampSite
            </a>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url(
                    "admin/dashboard"
                ) ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin/campsites") ?>">
                    <i class="bi bi-geo-alt"></i> Lokasi Perkemahan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(
                    "admin/add-campsite"
                ) ?>">
                    <i class="bi bi-plus-circle"></i> Tambah Lokasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin/bookings") ?>">
                    <i class="bi bi-calendar-check"></i> Pemesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin/payments") ?>">
                    <i class="bi bi-credit-card"></i> Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin/users") ?>">
                    <i class="bi bi-people"></i> Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin/reports") ?>">
                    <i class="bi bi-bar-chart"></i> Laporan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin/reports") ?>">
                    <i class="bi bi-gear"></i> Pengaturan
                </a>
            </li>
            <li class="nav-item mt-4">
                <a class="nav-link text-danger" href="<?= base_url(
                    "logout"
                ) ?>">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="d-flex justify-content-end mb-4">
            <div class="user-welcome">
                <div class="user-avatar">
                    <?= strtoupper(substr(session()->get("username"), 0, 1)) ?>
                </div>
                <div>
                    <?= esc(session()->get("username")) ?>
                    <span class="admin-badge">Admin</span>
                </div>
            </div>
        </div>

        <div class="admin-header">
            <h2><i class="bi bi-speedometer2 me-2"></i> Dashboard Admin</h2>
            <p class="lead mb-0">Selamat datang di panel admin CampSite. Kelola website perkemahan dengan mudah di sini.</p>
        </div>

        <?php if (session()->getFlashdata("success")): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?= session()->getFlashdata("success") ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata("error")): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= session()->getFlashdata("error") ?>
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-icon bg-primary text-white">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stat-value"><?= esc($userCount) ?></div>
                        <div class="stat-label">Total Pengguna</div>
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-icon bg-success text-white">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="stat-value"><?= esc($campsiteCount) ?></div>
                        <div class="stat-label">Lokasi Perkemahan</div>
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-icon bg-warning text-white">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <div class="stat-value"><?= esc(
                            $activeBookings
                        ) ?></div>
                        <div class="stat-label">Pemesanan Aktif</div>
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="stat-icon bg-danger text-white">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="stat-value">Rp<?= number_format(
                            $monthlyRevenue,
                            0,
                            ",",
                            "."
                        ) ?></div>
                        <div class="stat-label">Pendapatan Bulan Ini</div>
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities Section -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card recent-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-activity me-2"></i>Aktivitas Terbaru</span>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <?php if (
                            empty($recentBookings) &&
                            empty($recentUsers) &&
                            empty($recentPayments)
                        ): ?>
                            <div class="alert alert-info text-center mb-0">Tidak ada aktivitas terbaru.</div>
                        <?php else: ?>
                            <?php foreach ($recentUsers as $user): ?>
                                <div class="recent-item">
                                    <div class="item-icon bg-primary">
                                        <i class="bi bi-person-plus"></i>
                                    </div>
                                    <div class="item-details">
                                        <div class="item-title">Pengguna Baru</div>
                                        <div class="item-info"><?= esc(
                                            $user["username"]
                                        ) ?> mendaftar</div>
                                    </div>
                                    <div class="item-time text-muted">
                                        <?= \CodeIgniter\I18n\Time::parse(
                                            $user["created_at"]
                                        )->humanize() ?> yang lalu
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <?php foreach ($recentBookings as $booking): ?>
                                <div class="recent-item">
                                    <div class="item-icon bg-success">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <div class="item-details">
                                        <div class="item-title">Pemesanan Baru</div>
                                        <div class="item-info">
                                            <?= esc(
                                                $booking["campsite_name"]
                                            ) ?> oleh <?= esc(
     $booking["username"]
 ) ?>
                                            (<?= date(
                                                "d M",
                                                strtotime(
                                                    $booking["check_in_date"]
                                                )
                                            ) ?> - <?= date(
     "d M",
     strtotime($booking["check_out_date"])
 ) ?>)
                                        </div>
                                    </div>
                                    <div class="item-time text-muted">
                                        <?= \CodeIgniter\I18n\Time::parse(
                                            $booking["created_at"]
                                        )->humanize() ?> yang lalu
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <?php foreach ($recentPayments as $payment): ?>
                                <div class="recent-item">
                                    <div class="item-icon bg-warning">
                                        <i class="bi bi-credit-card"></i>
                                    </div>
                                    <div class="item-details">
                                        <div class="item-title">Pembayaran Baru</div>
                                        <div class="item-info">
                                            Rp<?= number_format(
                                                $payment["amount"],
                                                0,
                                                ",",
                                                "."
                                            ) ?> untuk <?= esc(
     $payment["campsite_name"]
 ) ?> oleh <?= esc($payment["username"]) ?>
                                            (Metode: <?= isset(
                                                $payment["payment_method"]
                                            )
                                                ? str_replace(
                                                    "_",
                                                    " ",
                                                    esc(
                                                        $payment[
                                                            "payment_method"
                                                        ]
                                                    )
                                                )
                                                : "" ?>, Status: <?= esc(
    $payment["payment_status"]
) ?>)
                                        </div>
                                    </div>
                                    <div class="item-time text-muted">
                                        <?= \CodeIgniter\I18n\Time::parse(
                                            $payment["created_at"]
                                        )->humanize() ?> yang lalu
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card recent-card">
                    <div class="card-header">
                        <i class="bi bi-calendar3 me-2"></i>Pemesanan Terbaru
                    </div>
                    <div class="card-body">
                        <?php if (empty($recentBookings)): ?>
                            <div class="alert alert-info text-center mb-0">Tidak ada pemesanan terbaru.</div>
                        <?php else: ?>
                            <?php foreach ($recentBookings as $booking): ?>
                                <div class="recent-item">
                                    <div class="item-icon bg-primary">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="item-details">
                                        <div class="item-title"><?= esc(
                                            $booking["username"]
                                        ) ?></div>
                                        <div class="item-info">
                                            <?= esc(
                                                $booking["campsite_name"]
                                            ) ?> -
                                            <?= ceil(
                                                (strtotime(
                                                    $booking["check_out_date"]
                                                ) -
                                                    strtotime(
                                                        $booking[
                                                            "check_in_date"
                                                        ]
                                                    )) /
                                                    (60 * 60 * 24)
                                            ) ?> hari
                                        </div>
                                    </div>
                                    <div class="item-action">
                                        <a href="<?= base_url(
                                            "admin/bookings"
                                        ) ?>" class="btn btn-sm btn-outline-primary">Lihat</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="text-center mt-3">
                                <a href="<?= base_url(
                                    "admin/bookings"
                                ) ?>" class="btn btn-primary">
                                    Lihat Semua Pemesanan
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card recent-card mt-4">
                    <div class="card-header">
                        <i class="bi bi-info-circle me-2"></i>Informasi Sistem
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Versi PHP:</span>
                            <span class="badge bg-info"><?= phpversion() ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Versi CodeIgniter:</span>
                            <span class="badge bg-info">4.6.1</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Server:</span>
                            <span class="badge bg-info"><?= isset(
                                $_SERVER["SERVER_SOFTWARE"]
                            )
                                ? $_SERVER["SERVER_SOFTWARE"]
                                : "Unknown" ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Versi Database:</span>
                            <span class="badge bg-info">MySQL 8.0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
