<!-- pengecekan login -->
<?php
session_start();
if (!isset($_SESSION['id_pengguna']) || $_SESSION['peran'] !== 'pelanggan') {
    header("Location: login.php?pesan=belum_login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Ajax AOS -->
    <link rel="icon" href="../assets/img/icon.png" type="image/x-icon">
    <style>
        .navbar {
            background: rgb(2, 16, 214);
            /* Gradasi biru */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #FD8816;
            /* Warna oranye untuk brand */
            font-size: 1.5rem;
        }

        .navbar-brand:hover {
            color: rgb(247, 123, 0);
        }

        .nav-link {
            color: #FFFFFF;
            /* Warna putih untuk link */
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #FFC107;
            /* Kuning saat hover */
            transform: scale(1.1);
            /* Efek memperbesar */
        }

        .btn-custom {
            background-color: #FD8816;
            /* Tombol oranye */
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background-color: rgba(255, 123, 0, 0.99);
            /* Hover kuning */
            color: #001EBB;
            /* Teks biru */
        }

        .dropdown-menu {
            background-color: #0012ff;
            /* Warna dropdown biru */
        }

        .dropdown-item {
            color: #FFFFFF;
            /* Teks putih di dropdown */
        }

        .dropdown-item:hover {
            background-color: #FF7043;
            /* Warna oranye saat hover */
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/logo.png" alt="JetBus Logo" width="130" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-custom ms-3" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari akun Anda?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="../logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>