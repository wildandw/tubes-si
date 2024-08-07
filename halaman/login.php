<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <img src="../img/logo.png" alt="Logo" class="logo">
            <form action="../veriflogin.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username"required oninvalid="this.setCustomValidity('Mohon Masukkan Username Anda.')" oninput="this.setCustomValidity('')" name="username" placeholder="Masukkan Username" required>

                <label for="password">Kata Sandi</label>
                <input type="password" id="password" required oninvalid="this.setCustomValidity('Mohon Masukkan Password Anda.')" oninput="this.setCustomValidity('')" name="password"  placeholder="Masukkan Kata Sandi" required>

                <button type="submit">MASUK</button>
            </form>
        </div>
    </div>
</body>
</html>
