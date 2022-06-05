<?php

namespace app\controllers;
use app\Router;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


class MailController
{

    public static function mail_contact(Router $router)
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $secret = '6LeLnkQgAAAAAE2pqgRHjhdi9hmvZfOa9Exc_d22';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {

            $sender = $_POST['sender_email'];
            $mail_content = $_POST['mail_content'];
            $mail = new PHPMailer(true);
            try {

                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'knowsbally@gmail.com';
                $mail->Password = 'Test1234!';
                $mail->SMTPSecure = "tls";
                //Enable implicit TLS encryption
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('knowsbally@gmail.com', 'Bally');
                $mail->addAddress($sender);
                $mail->addReplyTo("knowsbally@gmail.com");

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Contact Bally';
                $mail->Body = $mail_content .' Thank you for reaching out to us! <b> We will contact you soon. </b>';
                $mail->AltBody = 'We will contact you soon.';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            header('Location: /teams');
            exit;
            }
        }


        $router->renderView('/contact', [
        ]);
    }
}
