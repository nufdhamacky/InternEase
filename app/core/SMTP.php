<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'libraries/PHPMailer/src/Exception.php';
require 'libraries/PHPMailer/src/PHPMailer.php';
require 'libraries/PHPMailer/src/SMTP.php';

class Mailer extends Database
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->setup();
    }

    private function setup()
    {
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
        $this->mail->SMTPAuth = true;           // Enable SMTP authentication
        $this->mail->Username = 'intern.easeucsc@gmail.com'; // SMTP username
        $this->mail->Password = 'afjcgcwfdcfuumir'; // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS encouraged
        $this->mail->Port = 465;                 // TCP port to connect to, use 465 for SMTPS

        $this->mail->setFrom('intern.easeucsc@gmail.com', 'InternEase');
    }

    function validateOTP($email, $otp)
    {
        $sql = "SELECT otp, expiry FROM otp_storage WHERE email = '{$email}' AND otp = {$otp}";
        $ValidateOTP = $this->query($sql);
        if (empty($ValidateOTP) || count($ValidateOTP) == 0) {
            return false;
        }
        foreach ($ValidateOTP as $v) {
            if ($v) {
                if ($v['otp'] == $otp && time() < $v['expiry']) {
                    return true;  // OTP is correct and not expired
                }
            }
            return false;  // OTP is incorrect or expired

        }
    }

    public function sendBulkMail($emails, $subject, $body)
    {
        try {
            foreach ($emails as $to) {
                $this->mail->addBCC($to);     // Add a recipient
            }

            $this->mail->isHTML(true);        // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            return 'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function sendOTPEmail($email, $subject)
    {
        $mailer = new Mailer();
        $otp = $mailer->generateOTP();
        $mailer->storeOTP($otp, $email);
        $subject = "InternEase: Your OTP";
        $body = "<p><b>InternEase</b></p><br><p>Your One-Time Password (OTP) for verification is: <strong>$otp</strong></p>
                 <p>This OTP is valid for the next 10 minutes.</p>";
        $email = $mailer->sendMail($email, $subject, $body);
        if($email == 'Message has been sent'){
            return $otp;
        }else{
            return false;
        }
       

    }

    function generateOTP($length = 6)
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    function storeOTP($otp, $email)
    {
        // Assuming PDO is used for database connection
        $expiry = time() + (10 * 60); // 10 minutes from now
        $query = "INSERT INTO otp_storage (otp, expiry, email) VALUES ({$otp}, {$expiry}, '{$email}')
                ON DUPLICATE KEY UPDATE otp = {$otp}, expiry = {$expiry}, email = '{$email}'";
        $storeOTP = $this->query($query);
        if ($storeOTP) {
            return true;
        } else {
            return false;
        }


    }

    public function sendMail($to, $subject, $body)
    {
        try {
            $this->mail->addAddress($to);     // Add a recipient
            $this->mail->isHTML(true);        // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            return 'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}