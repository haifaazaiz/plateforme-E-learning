<?php

if (isset($_POST['reset-password-submit'])) {

	$selector=$_POST['selector'];
	$validator=$_POST['validator'];
	$password=$_POST['pwd'];
	$passwordRepeat=$_POST['pwd-repeat'];

	if(empty($passwordRepeat)|| empty($password)){
		header("Location:createnewpassword.php?newpwd=empty&selector=".$selector."&validator=".$validator);
		exit();

	}elseif ($password!=$passwordRepeat) {
         
		header("Location:createnewpassword.php?newpwd=pwdnotsame&selector=".$selector."&validator=".$validator);
         exit();
		
	}

$currentDate=date("U");
//connexion db
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

$requete=$db->prepare('SELECT * FROM pwdReset WHERE pwdResetSelector=:pwdResetSelector ');
 $requete->execute( array('pwdResetSelector' => $selector ));
 
if (($row=$requete->fetch())==false) {

	echo "you need to re-submit yous reset request ";
	// $reponse=$db->query('SELECT * FROM members');
	// $row=$reponse->fetch() ; 

	exit();

}
else
	{
		$tokenBin=hex2bin($validator);
		$tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

       if ($tokenCheck==false) {
	         echo "you need to re-submit yous reset request ";
             exit();
       	
       }elseif ($tokenCheck==true) {

       	$tokenEmail=$row['pwdResetEmail'];

       	$requete=$db->prepare('SELECT * FROM members WHERE email=:email ');
          $requete->execute( array('email' => $tokenEmail ));

         if (!$row=$requete->fetch())
            {
                   echo "there are an error ";
                   exit();

            }else
            {    
            	$newPwdHash =password_hash($password, PASSWORD_DEFAULT);
            	$requete=$db->prepare('UPDATE members SET password =: password WHERE email=:email');
            	$requete-> execute(array('password'=> $newPwdHash ,'email'=>$tokenEmail));


               //Delete token where pwdresetemail=emailusers
                
            }





	}



	

}
}
else
{
	header("location:index.html");
}	




?>