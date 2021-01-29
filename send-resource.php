<?php 
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';

$mail->Username='ezsystem.developer@gmail.com';
$mail->Password='Ezsystem1!';

    $message1="";
    $error="";
    include_once 'dbconnect.php';

    if (isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = 0;

        $query = "SELECT * FROM resource  where id = '$id'";
        $result = mysqli_query($conn,$query) or die('SQL error retrieve resource ');
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

     if(isset($_POST['hantar']))
      { 
        $nfc = addslashes($_POST['nfc']);
        $organizer = $_SESSION['username'];

        $query1 = "SELECT * FROM participant  where id = '$nfc' && organizer = '$organizer'";
        $result1 = mysqli_query($conn,$query1) or die('SQL error check participant ');
        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

        $email = $row1['email']; 
        $siapa = $row1['name'];
        $resource = $row['file'];

            if($row1){
                // Recipient               
                $mail->addAddress($email);
                 
                // Sender 
                $mail->setFrom('ezsystem.developer@gmail.com','EZSYSTEM');
                $mail->addReplyTo('noreply@ezsystem.com');
                $mail->isHTML(true);
                // Email subject 
                $mail->Subject='Your requested resources from EZSYSTEM';
                 
                // Attachment file 
                $mail->addAttachment('resources/'. $resource .'');
                 
                // Email body content 
                $mail->Body='
                    <h3>Hi '.$siapa.'! Here we deliver to you :)</h3> 
                    <p>This email is sent from EZSYSTEM with attachment of file '. $resource .' </p> 
                ';
                   
                 
                // Preparing attachment 
                if($mail->send()){
                    $message1 = "Your resource is on its way! Thank you $email";
                }
            }
                else
                    $error="Your NFC tag was not registered for this event";

        }         
?>