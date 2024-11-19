<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

$email = "aldilaangelina@gmail.com";
$nama = "Dila";
$catatan = "Akun Anda kini telah aktif, dan Anda dapat masuk ke akun Anda menggunakan alamat email yang terdaftar.";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'aldilaangelina@gmail.com';
    $mail->Password   = 'lungskrcclcsweue';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('your_email@example.com', 'Your Website');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Pendaftaran Akun Berhasil';

    $mail->Body    = "
<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style type='text/css'>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #2863a7;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            border-radius: 5px;
        }
        .email-content {
            padding: 20px;
            background-color: #ffffff; /* Warna latar belakang konten */
        }
        .email-content p {
            margin: 0 0 20px;
            line-height: 1.5;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
            padding: 10px;
            border-top: 1px solid #eeeeee;
            background-color: #ffffff;
        }
       .button {
        background-color: #2863a7; /* Warna latar belakang tombol */
        color: white; /* Warna teks tombol */
        padding: 10px 20px; /* Padding di dalam tombol */
        text-decoration: none; /* Menghapus garis bawah pada teks */
        border-radius: 5px; /* Membuat sudut tombol melengkung */
        font-size: 14px; /* Ukuran font tombol */
        display: inline-block; /* Membuat tombol menjadi inline-block */
        margin-top: 20px; /* Jarak atas tombol */
        }

        .button:hover {
        background-color: #3e5c81; /* Warna latar belakang tombol saat hover */
        }

    </style>
</head>
<body>
    <div class='email-container'>
        <div class='email-header'>
            <h1>Pendaftaran Akun Berhasil</h1>
        </div>
        <div class='email-content'>
            <p>Kepada Yth, Aldila,</p>
            <p>
                Kami dengan senang hati menginformasikan bahwa pendaftaran akun Anda di Kelas Kreasi telah berhasil. Berikut rincian yang kami terima:
            </p>
            <ul>
                <li>Email: [[ALAMAT_EMAIL]]</li>
                <li>Nama: [[NAMA_PENGGUNA]]</li>
                <li>Catatan: [[CATATAN_PENGGUNA]]</li>
            </ul>
            <p>
                Untuk mengakses akun Anda, silakan klik tautan di bawah ini:
            </p>
            <p style='text-align:center;'>
                <a href='[[URL_LOGIN]]' class='button'>Masuk ke Akun Anda</a>
            </p>
            <p>
                Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi tim dukungan kami.
            </p>
            <p><strong>Catatan:</strong> Akun Anda kini telah aktif, dan Anda dapat masuk ke akun Anda menggunakan alamat email yang terdaftar</p>
        </div>
        <div class='email-footer'>
            <p>Terima kasih telah bergabung dengan Kelas Kreasi.</p>
            <p>Salam Hormat,</p>
            <p>Tim Kelas Kreasi </p>
            <p>Ini adalah pesan otomatis, mohon jangan membalas email ini.</p>
        </div>
    </div>
</body>
</html>
";

    $mail->Body = str_replace('[[NAMA_PENGGUNA]]', $nama, $mail->Body);
    $mail->Body = str_replace('[[NAMA_WEBSITE]]', 'Kelas Kreasi', $mail->Body);
    $mail->Body = str_replace('[[ALAMAT_EMAIL]]', $email, $mail->Body);
    $mail->Body = str_replace('[[URL_LOGIN]]', 'http://yourdomain.com/login', $mail->Body);
    $mail->Body = str_replace('[[CATATAN_PENGGUNA]]', $catatan, $mail->Body);

    $mail->send();
    echo "Pendaftaran akun berhasil dan email konfirmasi telah dikirim.";
} catch (Exception $e) {
    echo "Pesan tidak dapat dikirim. Kesalahan Mailer: {$mail->ErrorInfo}";
}
