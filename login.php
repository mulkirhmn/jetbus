<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JetBus</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="assets/img/icon.png" type="image/x-icon">


    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('assets/img/login.jpeg') no-repeat center center/cover;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        .login-container {
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .login-logo img {
            width: 120px;
            height: auto;
        }

        .form-label {
            color: #fff;
            font-weight: 600;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            border: 1px solid #fff;
        }

        .form-control::placeholder {
            color: #f0f0f0;
        }

        .form-control:focus {
            border-color: #ff7b00;
            box-shadow: 0 0 5px rgba(255, 123, 0, 0.5);
            background-color: rgba(255, 255, 255, 0.5);
            color: #000;
        }

        .btn-primary {
            background-color: #ff7b00;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e56d00;
        }

        .link-secondary {
            color: rgb(255, 0, 0);
        }

        .link-secondary:hover {
            text-decoration: underline;
            color: #f0f0f0;
        }

        p.text-center a {
            color: #fff;
            font-weight: bold;
        }

        p.text-center a:hover {
            text-decoration: underline;
            color: #f0f0f0;
        }

        .input-group-text {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .input-group-text i {
            color: #fff;
        }

        p.text-center a {
            color: #fff !important;
            /* Tambahkan !important untuk mengatasi konflik */
            font-weight: bold;
        }

        p.text-center a:hover {
            text-decoration: underline;
            color: #f0f0f0 !important;
        }

        a.link-secondary {
            color: #fff !important;
            /* Pastikan putih */
        }

        a.link-secondary:hover {
            text-decoration: underline;
            color: #f0f0f0 !important;
            /* Warna putih saat hover */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-logo">
            <img src="assets/img/logo.png" alt="JetBus Logo">
        </div>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php
                switch ($_GET['error']) {
                    case 'invalid_credentials':
                        echo "Email/No HP atau password salah!";
                        break;
                    case 'query_error':
                        echo "Terjadi kesalahan saat proses query.";
                        break;
                    case 'missing_fields':
                        echo "Email dan password harus diisi.";
                        break;
                    default:
                        echo "Terjadi kesalahan, coba lagi.";
                }
                ?>
            </div>
        <?php endif; ?>

        <form action="process_login.php" method="POST">
            <div class="mb-3">
                <label for="emailOrPhone" class="form-label">Email / No. Telepon</label>
                <input type="text" class="form-control" id="emailOrPhone" name="email" placeholder="Masukkan email atau no. telepon" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    <span class="input-group-text" id="togglePassword">
                        <i class="bi bi-eye-slash" id="passwordIcon"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="lupa_password.php" class="link-secondary">Lupa Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
        </form>

        <p class="text-center mt-3">Belum punya akun? <a href="register.php" class="link-secondary">Daftar</a></p>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const passwordIcon = document.querySelector('#passwordIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'password') {
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        });
    </script>
</body>

</html>