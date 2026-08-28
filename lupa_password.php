<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Juragan99</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .forgot-password-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
        }

        .btn-primary {
            background-color: #dc3545;
            border: none;
        }

        .btn-primary:hover {
            background-color: #c82333;
        }

        .link-secondary {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <main class="forgot-password-container">
        <h2 class="text-center mb-3">Lupa Password</h2>
        <p class="text-center">Masukkan email terdaftar untuk mereset kata sandi Anda.</p>
        <form action="process_forgot_password.php" method="POST" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda" required autocomplete="email">
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
        </form>
        <p class="text-center mt-3">
            <a href="login.php" class="link-secondary">Kembali ke Login</a>
        </p>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
