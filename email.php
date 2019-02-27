<?php
include_once("validate.php");

$valid   = validate($_GET);
$success = $valid['success'];

if ($success) {
    
    $sub     = trim($_GET['email_subject']);
    $name    = trim($_GET['email_name']);
    $company = trim($_GET['email_company']);
    $phone   = trim($_GET['email_phone']);
    $email   = trim($_GET['email_email']);
    $date    = trim($_GET['email_date']);

    $text  = $name    . "\r\n";
    $text .= $company . "\r\n";
    $text .= $phone   . "\r\n";
    $text .= $email   . "\r\n";
    $text .= "Desired contact date: " . $date    . "\r\n";

    $subject    = htmlentities($sub);
    $email_text = htmlentities($text);

    $to = 'Louis@iWoodCode.com';

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Louis@iwoodcode.com' . "\r\n";
    $headers .= 'Reply-To: Louis@iwoodcode.com' . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $email_text, $headers)) {
        
        $msg = "Your email has been sent and I will contact you shortly. Thank you!";
        
    } else {
        
        $success = false;
        $msg = "There was a problem sending your email but my contact information is at the bottom ";
        $msg .= "of the page. I look forward to hearing from you!";
    }
    
} else {
    
    $msg = $valid['message'];
    
}

$return = array("success"=>$success, "message"=>$msg);

echo json_encode($return);
