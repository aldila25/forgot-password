<?php
// Koneksi ke database
include 'db_connect.php'; // Pastikan file ini ada dan benar

// Ambil data dari form
$token = $_POST['token'];
$newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password baru

// Verifikasi token di database
$sql = "SELECT email FROM password_resets WHERE token = '$token'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Token valid, perbarui password pengguna
    $email = $result->fetch_assoc()['email'];
    $sql = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
    $conn->query($sql);

    // Hapus token setelah digunakan
    $sql = "DELETE FROM password_resets WHERE token = '$token'";
    $conn->query($sql);

    echo 'Your password has been reset successfully.';
} else {
    echo 'Invalid or expired token.';
}

$conn->close();
