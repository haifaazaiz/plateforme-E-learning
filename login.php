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
 
 <h2>Login Account </h2>

 <br>
 <input type="text" class="error" value ="<?php
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
    if((!empty($_POST['email']))&&(!empty($_POST['password']))){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql="select * from members where email='".$email."'AND password='".$password."' limit 1";
        $result=$db->query($sql);
        $userexist=$result->rowCount();
        if ($userexist==1){
            $userinfo=$result->fetch();
            //about
            $_SESSION['id']=$userinfo['id'];
            $_SESSION['username']=$userinfo['username'];
            $_SESSION['email']=$userinfo['email'];
            $_SESSION['password']=$userinfo['password'];
            $_SESSION['accessRights']=$userinfo['accessRights'];
            //remember me
            if(isset($_POST['remembere'])){
                setcookie('email',$email,time()+365*24*3600,null,null,false,true);
                setcookie('password',$password,time()+365*24*3600,null,null,false,true);
            }
            //mycourses
            $_SESSION['mycourses']=$userinfo['mycourses'];
            //profile photo
            $_SESSION['profile_photo']=$userinfo['profile_photo'];
            //student
            $_SESSION['student']=$userinfo['student'];
            $_SESSION['degree']=$userinfo['degree'];
            $_SESSION['university']=$userinfo['university'];
            $_SESSION['field']=$userinfo['field'];
            //employer
            $_SESSION['employment_status']=$userinfo['employment_status'];
            $_SESSION['industry']=$userinfo['industry'];
            $_SESSION['occupation']=$userinfo['occupation'];
            $_SESSION['employer']=$userinfo['employer'];
            $_SESSION['experience_level']=$userinfo['experience_level'];
            //about
            $_SESSION['birthday']=$userinfo['birthday'];
            $_SESSION['gender']=$userinfo['gender'];
            $_SESSION['phone_number']=$userinfo['phone_number'];
            $_SESSION['about_me']=$userinfo['about_me'];
            $_SESSION['location']=$userinfo['location'];
            $_SESSION['skills']=$userinfo['skills'];
            //social_media
            $_SESSION['linkedin']=$userinfo['linkedin'];
            $_SESSION['facebook']=$userinfo['facebook'];
            $_SESSION['instagram']=$userinfo['instagram'];
            $_SESSION['github']=$userinfo['github'];
            $_SESSION['twitter']=$userinfo['twitter'];
            
            header("Location:index1.php");
            exit();
        }
        else{echo"failed login ,Please Retry !";}
    }

    ?>">
<br>
 <a href="index.html"><button id="home" > <b>Return to HOME</b>  </button></a>

</div>

</body>
</html>