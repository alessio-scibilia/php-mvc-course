<?php

class MailSender
{

    public static function send(string $to, string $subject, string $body)
    {
        //$result = mail($to, $subject, $body);

        //if (!$result) {
            require_once 'vendor/autoload.php';

            //Parametri connessione server di posta
            $email = 'auto@alfiere.digital';
            $pwd = 'Nonteladico';
            $server = 'ssl0.ovh.net';
            $port = 587;

            $transport = (new Swift_SmtpTransport($server, $port))
                ->setUsername($email)
                ->setPassword($pwd);
            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message($subject))
                ->setFrom($email)
                ->setTo($to)
                ->setBody($body);

            $result = $mailer->send($message);

            return $result;
        //}
    }
}






