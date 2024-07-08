<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/daftar.css">
</head>
<body>
    <div class="background-container">
        <div class="container">
            <h2>Daftar Akun</h2>
            <form action="daftar_process.php" method="POST">
                <div class="input-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" value="" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" required>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Konfirmasi Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" value="" required>
                </div>
                <input type="submit" value="Daftar">
            </form>
        </div>
    </div>
</body>
</html>
