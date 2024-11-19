<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $sql = "UPDATE user SET reset_token='$token', token_expiry='$expiry' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
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

                $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;
                $mail->isHTML(true);
                $mail->Subject = 'Permintaan Reset Password';

                $mail->Body    = "
<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2); /* Drop shadow */
            padding: 20px;
        }
        .email-header {
            background-color: #2863a7;
            padding: 25px;
            text-align: center;
            color: #ffffff;
            font-size: 20px;
            border-radius: 5px;
        }
        .email-content {
            text-align: left;
            font-size: 16px;
            line-height: 1.6;
        }
        .email-footer {
            font-size: 12px;
            color: #888888;
            padding-top: 20px;
            text-align: center;
            border-top: 2px solid #cccccc; /* Garis tipis */
            margin-top: 20px;
        }
        .button {
            background-color: #2863a7;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            display: inline-block;
            margin-top: 20px;
            
        }
        .button:hover {
            background-color: #357ae8;
        }

        
    </style>
</head>
<body>
    <div class='email-container'>
        <div class='email-header'>
            Permintaan Reset Password
        </div>
        <div class='email-content'>
            <p>Halo,</p>
            <p>Kami menerima permintaan untuk mereset password Anda. Silakan klik tombol di bawah ini untuk mereset password Anda:</p>
            <p style='text-align:center;'>
                <a href='$resetLink' class='button text-white'>Reset Password</a>
            </p>
            <p>Jika Anda tidak meminta reset password ini, abaikan email ini.</p>
            <p>Terima kasih,<br>Tmint.co</p>
        </div>
        <div class='email-footer'>
            <p>Ini adalah pesan otomatis, mohon jangan membalas email ini.</p>
        </div>
    </div>
</body>
</html>
";

                $mail->send();
                $conn->close();
                header('Location: index.php'); 
                exit();
            } catch (Exception $e) {
                $conn->close();
                header('Location: index.php'); 
                exit();
            }
        } else {
            $conn->close();
            header('Location: index.php'); 
            exit();
        }
    } else {
        $conn->close();
        header('Location: index.php');
        exit();
    }
}
