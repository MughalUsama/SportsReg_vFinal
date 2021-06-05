<?php
$resetcode = mt_rand(100000,999999);
$to_email = "bsef17m035@pucit.edu.pk";
$subject = "Reset SportsReg password";
$body = "Your code to reset email is $resetcode";
$headers = "From: SportsReg";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
?>