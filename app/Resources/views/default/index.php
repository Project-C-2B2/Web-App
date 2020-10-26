<?php
{include 'index.html.twig';}
    if(isset($_POST['sendmail'])) {
        require_once '/vendor/autoload.php';
        require_once 'login.php';


        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername(EMAIL)
            ->setPassword(PASS);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($_POST['subject']))
            ->setFrom([EMAIL => 'Cimeets'])
            ->setTo([$_POST['email']])
            ->setBody($_POST['message']);

        // Send the message
        if($mailer->send($message)){
            echo "Mail send";
        }
        else{
            echo "Failed to send";
        }
    }
        ?>
