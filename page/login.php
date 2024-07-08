<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/login.css">
</head>
<body>
    <div class="background-container">
        <div class="container">
            <h2>Ruang Dapur</h2>
            <form action="login_process.php" method="POST">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" required>
                </div>
                <input type="submit" value="Login">
                <a href="#" class="forgot-password">Forgot Password?</a>
            </form>
        </div>
    </div>
</body>
</html>
