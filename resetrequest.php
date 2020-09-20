

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset-request-submit'])) 
{

//create a token 
	$selector= bin2hex(random_bytes(8));
	$token= random_bytes(32);

	$url="http://localhost/projet/createnewpassword.php?selector=".$selector ."&validator=".bin2hex($token);


	$expires = date("U")+1800;



    session_start();
    $host="localhost";
    $user="root";
    $password="";
    $db="my_database";
    try{
        // connexion à la base de données my_database
        $db = new PDO('mysql:host=localhost;dbname=my_database;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e){
        // En cas d'erreur, on affiche un message et on quitte la page
        die('Erreur : '.$e->getMessage());
    }



    $userEmail=$_POST["email"];
    // we should be sure that this user have one token  
    $requete= $db-> prepare('DELETE FROM pwdReset WHERE pwdResetEmail=:pwdResetEmail');
    $requete->execute(array('pwdResetEmail'=>$userEmail));

    // insert into the table pwdReset the new variables 
    $hashedToken= password_hash($token, PASSWORD_DEFAULT);
    $requete=$db->prepare('INSERT INTO pwdReset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires)VALUES(:pwdResetEmail,:pwdResetSelector,:pwdResetToken,:pwdResetExpires)');
    $requete->execute(array('pwdResetEmail' => $userEmail,'pwdResetSelector' => $selector,'pwdResetToken' => $hashedToken,'pwdResetExpires' => $expires));
     //End insert

   $to=$_POST['email'];
    //sending E-mail 

  
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2 ;                     
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'fouleni fouleni';                     // SMTP username
    $mail->Password   = 'aloulouamoula';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                     

    //Recipients
    $mail->setFrom('fouleni.rhayem1996@gmail.com', 'Mailer');
    $mail->addAddress($to);     // Add a recipient
                   // Name is optional
   
    

   $body='<p>we recived a password reset request the link to reset your password is below .if you did not make this request,you can ignore this email.. Here is your password reset link :<br> <a href="' .$url. '">' .$url. '</a>  </p>';
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reset your password';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

   // $to= $userEmail ;
   // $subject='Reset your password';
   // $message='<p>we recived a password reset request the link to reset your password is below .if you did not make this request,you can ignore this email.. Here is your password reset link :<br> <a href="' .$url. '">' .$url. '</a>  </p>';
   // $headers="From:e-learning@gmail.com \r\n";
   // $headers .="content-type: text/html \r\n";
    //mail($to, $subject, $message,$headers);
   // header("Location:reset-password.php?reset=success");



	
}
else{
	header("Location:index.html");
}


?>
