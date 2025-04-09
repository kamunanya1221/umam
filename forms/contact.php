<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika menggunakan Composer
// require 'PHPMailer/src/PHPMailer.php'; // Jika manual
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gunakan SMTP Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Ganti dengan email Gmail kamu
        $mail->Password = 'your-app-password'; // Gunakan "App Password" Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Setel email
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('your-email@gmail.com'); // Ganti dengan email tujuan
        $mail->Subject = $_POST['subject'];
        $mail->Body = "Nama: " . $_POST['name'] . "\nEmail: " . $_POST['email'] . "\n\nPesan:\n" . $_POST['message'];

        $mail->send();
        echo "Pesan berhasil dikirim!";
    } catch (Exception $e) {
        echo "Gagal mengirim pesan. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Metode request tidak valid!";
}
?>
