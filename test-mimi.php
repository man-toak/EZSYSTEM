<?php

$to = "aimanroselee1998@gmail.com";
//$to="mufirdaus1006@gmail.com";
$subject = "TESTING HAHAHAHA OKAY HAHAHA";
//$body = "Dear ".$row["staffposition"]." ".$row["staffname"];
$message="The temperature of your premise has risen. This is a warning! Please take precaution!\n\n\n";
$body = "Dear Aiman";
//$txt2="Please kindly take this noted and please dont reply to this email!";
$headers='From: ezsystem.developer@gmail.com' . "\r\n";
//'Reply-To: smartmonitoring.uitm@gmail.com' . "\r\n" .
//'X-Mailer: PHP/' . phpversion();
//$sender = 'syamimi@gmail.com';

//echo ($WAGLOBAL_Email_Server);
//$headers = 'From:' . $sender;
//$headers = "From: sender's email";
if(mail($to,$subject,$message,$body,$headers)){
    echo '<script language="javascript">';
    echo 'alert("EMAIL SENT SUCCESSFULLY")';
    echo '</script>';

    }
    else
    {
    echo '<script language="javascript">';
    echo 'alert("EMAIL SENT FAILED")';
    echo '</script>';}
    echo "<html>";
    echo "<body>";
    echo "</body>";
    echo "</html>";

?>