<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi Perkemahan - Admin CampSite</title>
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
            background-color: var(--admin-primary);
            border-color: var(--admin-primary);
        }

        .btn-primary:hover {
            background-color: var(--admin-dark);
            border-color: var(--admin-dark);
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .img-thumbnail-preview {
            max-width: 200px;
            height: auto;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
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
                <a class="nav-link" href="<?= base_url("admin/dashboard") ?>">
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
            <h2><i class="bi bi-pencil-square me-2"></i> Edit Lokasi Perkemahan</h2>
            <p class="lead mb-0">Perbarui detail lokasi perkemahan.</p>
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
                Form Edit Lokasi Perkemahan
            </div>
            <div class="card-body">
                <form action="<?= base_url(
                    "admin/edit-campsite/" . $campsite["id"]
                ) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lokasi Perkemahan</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old(
                            "name",
                            $campsite["name"]
                        ) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?= old(
                            "location",
                            $campsite["location"]
                        ) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_per_night" class="form-label">Harga per Malam (Rp)</label>
                        <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="<?= old(
                            "price_per_night",
                            $campsite["price_per_night"]
                        ) ?>" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Kapasitas (jumlah orang)</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" value="<?= old(
                            "capacity",
                            $campsite["capacity"]
                        ) ?>" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="5"><?= old(
                            "description",
                            $campsite["description"]
                        ) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="facilities" class="form-label">Fasilitas (pisahkan dengan koma)</label>
                        <input type="text" class="form-control" id="facilities" name="facilities" value="<?= old(
                            "facilities",
                            $campsite["facilities"]
                        ) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Lokasi Perkemahan</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        <?php if (!empty($campsite["image"])): ?>
                            <p class="form-text text-muted mt-2">Gambar saat ini:</p>
                            <img src="<?= base_url(
                                "uploads/campsites/" . $campsite["image"]
                            ) ?>" alt="Gambar Lokasi Perkemahan" class="img-thumbnail-preview">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
                    <a href="<?= base_url(
                        "admin/campsites"
                    ) ?>" class="btn btn-secondary mt-3 ms-2">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to the current page link in sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar .nav-link');

            navLinks.forEach(link => {
                // Ensure the base URL is considered for comparison
                const linkHref = new URL(link.href).pathname;
                if (currentPath.startsWith(linkHref) && linkHref !== '/') { // Match /admin/campsites to active for all sub-pages too
                    link.classList.add('active');
                } else if (currentPath === '/' && linkHref === '/') { // Handle root path if needed, though for admin it's /admin/dashboard
                     link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
