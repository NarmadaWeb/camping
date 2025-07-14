<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi Perkemahan - Admin CampSite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #0d47a1; /* admin-dark */
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .logo {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar .logo a {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-left: 4px solid #ff9800; /* admin-accent */
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 18px;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
        }
        .header {
            background: linear-gradient(135deg, #1976D2, #2196F3); /* admin-primary, admin-secondary */
            color: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 15px 20px;
            font-weight: 600;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .btn-primary {
            background-color: #1976D2;
            border-color: #1976D2;
        }
        .btn-primary:hover {
            background-color: #1565C0;
            border-color: #1565C0;
        }
        .form-label {
            font-weight: 500;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo">
                <a href="<?= base_url("admin/dashboard") ?>">
                    <i class="bi bi-tree"></i> CampSite
                </a>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(
                        "admin/dashboard"
                    ) ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url(
                        "admin/campsites"
                    ) ?>">
                        <i class="bi bi-geo-alt"></i> Lokasi Perkemahan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url(
                        "admin/add-campsite"
                    ) ?>">
                        <i class="bi bi-plus-circle"></i> Tambah Lokasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(
                        "admin/bookings"
                    ) ?>">
                        <i class="bi bi-calendar-check"></i> Pemesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(
                        "admin/payments"
                    ) ?>">
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
            <div class="header">
                <h2><i class="bi bi-plus-circle me-2"></i> Tambah Lokasi Perkemahan</h2>
                <p class="lead mb-0">Tambahkan lokasi perkemahan baru ke sistem.</p>
            </div>

            <?php if (session()->getFlashdata("success")): ?>
                <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata(
                    "success"
                ) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata("error")): ?>
                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata(
                    "error"
                ) ?></div>
            <?php endif; ?>
            <?php if (isset($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    Form Tambah Lokasi Perkemahan
                </div>
                <div class="card-body">
                    <form action="<?= base_url(
                        "admin/add-campsite"
                    ) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lokasi Perkemahan</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old(
                                "name"
                            ) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?= old(
                                "location"
                            ) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="price_per_night" class="form-label">Harga per Malam (Rp)</label>
                            <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="<?= old(
                                "price_per_night"
                            ) ?>" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Kapasitas (jumlah orang)</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="<?= old(
                                "capacity"
                            ) ?>" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="5"><?= old(
                                "description"
                            ) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="facilities" class="form-label">Fasilitas (pisahkan dengan koma)</label>
                            <input type="text" class="form-control" id="facilities" name="facilities" value="<?= old(
                                "facilities"
                            ) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Lokasi Perkemahan</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-plus-circle me-2"></i> Tambah Lokasi</button>
                        <a href="<?= base_url(
                            "admin/campsites"
                        ) ?>" class="btn btn-secondary mt-3 ms-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
