<?php

class MailSender
{

    public static function send($to, string $subject, string $body)
    {
        //$result = mail($to, $subject, $body);

        //if (!$result) {
            require_once 'vendor/autoload.php';

            //Parametri connessione server di posta
            $username = 'auto@wellcome.host';
            $pwd = 'Nonteladico';
            $server = 'ssl0.ovh.net';
            $port = 587;

            $transport = (new Swift_SmtpTransport($server, $port))
                ->setUsername($username)
                ->setPassword($pwd);
            $mailer = new Swift_Mailer($transport);

            $from = [$username => 'Wellcome service'];
            $message = (new Swift_Message($subject))
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body);

            $result = $mailer->send($message);

            return $result;
        //}
    }
}






