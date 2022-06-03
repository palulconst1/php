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

            $secret = '6Ld8wAweAAAAACu_UpgGXGQU13R5ctGw9sc9R6gU';
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
                $mail->Username = 'paulconst7000@gmail.com';
                $mail->Password = 'test';
                $mail->SMTPSecure = "tls";
                //Enable implicit TLS encryption
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('paulconst7000@gmail.com');
                $mail->addAddress($sender);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Contact sport';
                $mail->Body = $mail_content .' Thank you for reaching out to us! <b> We will contact you soon. </b>';
                $mail->AltBody = 'We will contact you soon.';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            header('Location: /games');
            exit;
            }
        }


        $router->renderView('/contact', [
        ]);
    }
}
