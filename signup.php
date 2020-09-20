
<!DOCTYPE html>
<html>
<head>
    <title>Sign up </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-Compatible" content="ie=edge">
    
    <link rel="shortcut icon" href="img/mylogo.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="css/animate.css-main/source/animate.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/stylesignup.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container border border-secondary " id="signup">
 
 <h2>Sign Up Account </h2>
 <p>
     If your sign up was successful then go back to HOME and  LOGIN with your new account, 
     Else , please check out your ERROR ! you will find it below ,as a message. <br><b>Wish you all the Best !</b>  
 </p>
 <br>
 <input type="text" class="error" value ="<?php
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



    if(isset($_POST['username'])&&(!empty($_POST['email1']))&&isset($_POST['password1'])&&isset($_POST['password2']))
       {
       

          $reponse=$db->query('SELECT * FROM members');
                   $i=0;
                   $test=0;
           while(($entree=$reponse->fetch())&&($test==0) )
                 {
                       if ($entree['email']==$_POST['email1']) 
                         {
                           $test=1;
                           

                          }
                            $i++;
                            
                 }
           if ($test==1) {
               
               echo "your Email exist already ..Please Change It ! ";
           }
           else{

                 if ($_POST['password1']!=$_POST['password2']) 
                 {
                    
                    echo "Please Repeat your password correctly !";
                 }
                else{

                        $username=$_POST['username'];
                        $email1=$_POST['email1'];
                        $password1=$_POST['password1'];
        
                         $sql="INSERT INTO members(username, email, password) VALUES (:username, :email, :password)";      
                         $req=$db->prepare($sql);
                         $req->execute(array( 'username' => $username,'email' => $email1,'password' => $password1));
                           
                          echo " Your sign up was successful !" ;
                    }
                }    
        }
    
?>">
<br>
 <a href="index.html"><button id="home" > <b>Return to HOME</b>  </button></a>

</div>

</body>
</html>