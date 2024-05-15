<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$message = htmlspecialchars($_POST['message']);

if (!empty($email) && !empty($message)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = '999ftn@gmail.com';
            $mail->Password = 'diej dkqy uedk shiv'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('999ftn@gmail.com');

            //Content
            $mail->isHTML(false);
            $mail->Subject = "Van: $name <$email>";
            $mail->Body    = "Naam: $name\nEmail: $email\nTelefoon: $phone\nBericht:\n$message\n\nMet vriendelijke groet,\n$name";

            // Send the email
            $mail->send();
            echo "Uw bericht is verzonden";
        } catch (Exception $e) {
            echo "Sorry, het verzenden van uw bericht is mislukt! Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Voer een geldig e-mailadres in!";
    }
} else {
    echo "E-mail- en berichtvelden zijn verplicht!";
}
?>
