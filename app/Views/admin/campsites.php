<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lokasi Perkemahan</title>
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
            <li class="nav-link.active {
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

        .table-responsive {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .table thead th {
            background-color: var(--admin-light);
            color: var(--admin-dark);
            font-weight: 600;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table td, .table th {
            padding: 12px;
            vertical-align: middle;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 0.85rem;
            border-radius: 5px;
        }

        .campsite-thumbnail {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .btn-add {
            background-color: var(--admin-primary);
            border-color: var(--admin-primary);
            transition: all 0.3s;
        }
        .btn-add:hover {
            background-color: var(--admin-dark);
            border-color: var(--admin-dark);
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
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2><i class="bi bi-geo-alt-fill me-2"></i> Lokasi Perkemahan</h2>
                    <p class="lead mb-0">Kelola semua lokasi perkemahan yang tersedia di website Anda.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="<?= base_url(
                        "admin/add-campsite"
                    ) ?>" class="btn btn-add btn-lg text-white rounded-pill">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Lokasi Baru
                    </a>
                </div>
            </div>
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

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Harga/Malam</th>
                        <th>Kapasitas</th>
                        <th>Fasilitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($campsites)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">Belum ada lokasi perkemahan yang ditambahkan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($campsites as $campsite): ?>
                            <tr>
                                <td><?= esc($campsite["id"]) ?></td>
                                <td>
                                    <img src="<?= $campsite["image"]
                                        ? base_url(
                                            "uploads/campsites/" .
                                                $campsite["image"]
                                        )
                                        : "https://via.placeholder.com/80x50?text=No+Image" ?>"
                                         alt="<?= esc(
                                             $campsite["name"]
                                         ) ?>" class="campsite-thumbnail">
                                </td>
                                <td><?= esc($campsite["name"]) ?></td>
                                <td><?= esc($campsite["location"]) ?></td>
                                <td>Rp<?= number_format(
                                    esc($campsite["price_per_night"]),
                                    0,
                                    ",",
                                    "."
                                ) ?></td>
                                <td><?= esc($campsite["capacity"]) ?></td>
                                <td><?= esc(
                                    mb_strimwidth(
                                        $campsite["facilities"],
                                        0,
                                        50,
                                        "..."
                                    )
                                ) ?></td>
                                <td class="action-buttons">
                                    <a href="<?= base_url(
                                        "admin/edit-campsite/" . $campsite["id"]
                                    ) ?>" class="btn btn-warning btn-sm me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= base_url(
                                        "admin/delete-campsite/" .
                                            $campsite["id"]
                                    ) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi perkemahan ini? Ini akan menghapus semua data terkait!')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
