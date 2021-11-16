<?php

class MailSender
{

    public static function send(string $from, string $to, string $bcc, string $obj, string $subject, string $body): string
    {
        $result = mail($to, $subject, $message);

        if (!$result)
        {
            require_once 'vendor/autoload.php';

            //Parametri connessione server di posta
            $email = 'auto@alfiere.digital';
            $pwd = 'Nonteladico';
            $server = 'ssl0.ovh.net';
            $port = 465;

            $transport = (new Swift_SmtpTransport($server, $port))
                ->setUsername($email)
                ->setPassword($pwd);
            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message($obj))
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body);

            $result = $mailer->send($message);

            return $result;
        }
    }
}


$msg = 'Benvenuto su ' . $view_model->translations->get('nome_sito') . ' ecco le tue credenziali di accesso\nUsername: ' . $numero_stanza . '\nPassword:' . $password_ospite . '\n Goditi il relax!';




