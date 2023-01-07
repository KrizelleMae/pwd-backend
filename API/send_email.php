<?php
    use PHPMailer\PHPMailer\PHPMailer;

    function sendmail($to, $body, $subject){
        $name = "PWD Job Hunting - DSWD";  // Name
        $from = "pwdjobszc@gmail.com";  // Email
        $password = "bokgzznwmgrkdetd";  // Password

        // Ignore from here
        require_once "../../PHPMailer/PHPMailer.php";
        require_once "../../PHPMailer/SMTP.php";
        require_once "../../PHPMailer/Exception.php";
        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        //$mail->SMTPDebug = 3;  //Keep It commented this is used for debugging                          
        $mail->Host = "smtp.gmail.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        
        if ($mail->send()) {
            $data = ['status' => 1, 'message' => "Email Sent."];
        } else {
            $data = ['status' => 0, 'message' => "Email not sent."];
        }
    }      

?>