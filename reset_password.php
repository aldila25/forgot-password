<?php
// Koneksi ke database
include 'db_connect.php'; // Pastikan file ini ada dan benar

// Ambil token dari URL
$token = $_GET['token'];

// Verifikasi token di database
$sql = "SELECT email FROM password_resets WHERE token = '$token'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Token valid, tampilkan form reset password
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reset Password</title>
    </head>
    <body>
        <h2>Reset Your Password</h2>
        <form action="reset_password_process.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required />
            <button type="submit">Reset Password</button>
        </form>
    </body>
    </html>
    <?php
} else {
    echo 'Invalid or expired token.';
}

$conn->close();
?>
