<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - JetBus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .register-container {
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        h2,
        .form-label,
        p {
            color: #fff;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            border: 1px solid #fff;
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
            color: #ff7b00;
        }

        .link-secondary:hover {
            text-decoration: underline;
            color: #f0f0f0;
        }

        .error-message {
            font-size: 0.9rem;
            color: #ff3f3f;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <main class="register-container">
        <h2 class="text-center mb-4">Daftar Akun</h2>

        <!-- Feedback Dinamis -->
        <div id="alertMessage" class="alert d-none" role="alert"></div>

        <form id="registerForm" action="process_register.php" method="POST" novalidate>
            <div class="mb-3">
                <label for="full_name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="full_name" name="nama" placeholder="Nama lengkap" required>
                <small class="error-message"></small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email aktif" required>
                <small class="error-message"></small>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telepon</label>
                <input type="tel" class="form-control" id="phone" name="no_hp" placeholder="Nomor telepon" pattern="\d{10,13}" required>
                <small class="error-message"></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi" minlength="8" required>
                <small class="error-message"></small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
        <p class="text-center mt-3">Sudah punya akun? <a href="login.php" class="link-secondary">Masuk</a></p>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("registerForm").addEventListener("submit", function(e) {
            let isValid = true;
            const form = e.target;

            // Reset semua pesan error
            form.querySelectorAll(".error-message").forEach(el => el.innerText = "");

            // Validasi Nama Lengkap
            const namaInput = form.querySelector("#full_name");
            if (namaInput.value.trim() === "") {
                isValid = false;
                namaInput.nextElementSibling.innerText = "Nama lengkap harus diisi.";
            }

            // Validasi Email
            const emailInput = form.querySelector("#email");
            if (!/^\S+@\S+\.\S+$/.test(emailInput.value)) {
                isValid = false;
                emailInput.nextElementSibling.innerText = "Format email tidak valid.";
            }

            // Validasi Nomor Telepon
            const phoneInput = form.querySelector("#phone");
            if (!/^\d{10,13}$/.test(phoneInput.value)) {
                isValid = false;
                phoneInput.nextElementSibling.innerText = "Nomor telepon harus berupa angka 10-13 digit.";
            }

            // Validasi Kata Sandi
            const passwordInput = form.querySelector("#password");
            if (passwordInput.value.length < 8) {
                isValid = false;
                passwordInput.nextElementSibling.innerText = "Kata sandi minimal 8 karakter.";
            }

            // Jika ada input yang tidak valid, cegah submit
            if (!isValid) {
                e.preventDefault();
                const alertMessage = document.getElementById("alertMessage");
                alertMessage.innerText = "Harap periksa kembali input Anda.";
                alertMessage.classList.remove("d-none", "alert-success");
                alertMessage.classList.add("alert-danger");
            }
        });
    </script>
</body>

</html>