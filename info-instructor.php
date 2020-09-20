
<!DOCTYPE html>
<html>
<head>
	<title>info-instructor</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-Compatible" content="ie=edge">
	
	<link rel="shortcut icon" href="img/logo.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="css/animate.css-main/source/animate.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/style-info-instructor.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
</head>
<body>
	<?php
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
			if (isset($_SESSION['id'])){
				$req=$db->prepare("SELECT * FROM members WHERE id=?");
				$req->execute(array($_SESSION['id']));
				$user=$req->fetch();
			}
			?>
    <!-- Navigation -->
    <!--Navigation Sticky-->
	<div id="navigation-sticky">
    <nav class="navbar bg-light navbar-light navbar-expand-lg sticky-top">
        <div class="container">
            <a href="index1.php" class="navbar-brand">
				<img src="img/logo.png" class="w-75 h-25" alt="logo" title="logo">
            </a>
            <button class="navbar-toggler" type="button" id="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mr-auto">
					<li class="nav-item"><a href="index1.php" class="nav-link">HOME</a></li>
                    <li class="nav-item"><a href="allcourses1.php" class="nav-link">All Courses</a></li>
                    <li class="nav-item"><a href="services1.php" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="contact1.php" class="nav-link">Contact</a></li>
					<li class="nav-item"><a href="formateur.php" class="nav-link active">Instructor</a></li>
					<?php if($_SESSION['accessRights']==2) { ?>
					<li class="nav-item"><a href="administration/admin.php" class="nav-link">Administration</a></li>
					<?php } ?>
				</ul>
				<span class="nav-item dropdown">

					<a class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target" href="">
                        <?php if (!empty($_SESSION['profile_photo'])) { ?>
						<img src="img/members/<?php echo $_SESSION['profile_photo'];?>" width="50px">
						<?php } else {?>
						<img src="img/account1.jpg">
						<?php }?>
						<?php echo $_SESSION['username']; ?>
						<span class="caret"></span>
       				</a>

					<div class="dropdown-menu" aria-labelledby="dropdown_target" >
					    <a class="dropdown-item" href="myprofile.php">My profile</a>
						<div class="dropdown-divider"></div>

						<a class="dropdown-item" href="myaccount.php">Edit my profile</a>
						<div class="dropdown-divider"></div>

						<?php if ($user['accessRights']!=0) { ?>
						<a class="dropdown-item" href="formateur1.php">Upload your own course</a>
                        <div class="dropdown-divider"></div>
						<?php } ?>

						<a class="dropdown-item" href="settings.php">Settings</a>
						<div class="dropdown-divider"></div>

						<a class="dropdown-item" href="logout.php">Log out</a>
					</div>
       			</span>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

<div class="container border border-secondary" id="info">

	<h2> General Information </h2>
	<form action="info-instructor.php" method="post" enctype="multipart/form-data">
		 <label>Put your E-mail please :</label>
		 <input id="mail" type="email" name="mail" required>
		 <br>
		 <hr>
		 <br>
		 <label>Is it  your first time that you did your own course online ?</label>
		 <br>
		 <input type="radio" id="radio" value="yes" name="yesorno" required>yes
		 <input type="radio" id="radio" value="no" name="yesorno"required>no
          <br>
          <hr>
          <br>
		 <label for ="experience">Professionnal Experience</label><br>
		 
		   <input type="radio" name="experience" id="exp" value="0"required>without Experience<br>
		   <input type="radio" name="experience" id="exp" value="2"required>2 years of experience<br>
		   <input type="radio" name="experience"  id="exp" value="+"required>plus<br><br>
		   <hr>
		   <br>
		<table >
		<tr> 
            <td valign="top"><label >You should write a short motivation letter : </label> </td>
			<td><textarea rows=15 cols=50 name="lettre_de_motivation" required></textarea></td>
		</tr>
        </table>
		 <br>
		 <hr>
		 <br>
		<label for="cv"> Put your CV : </label> 
        <input type="file" name="cv" required>
        <br><br><hr><br>
		<label for="video">Put your video :  </label>
		 <input type="file" name="video" required> 
		 <?php

if (isset($_POST['submit'] ) && isset($_POST['mail'] ) && isset($_POST['yesorno'] ) 
    && isset($_POST['experience'] )&&isset($_POST['lettre_de_motivation'] )){ 
    
        $reponse=$db->query('SELECT * FROM instructor');
        $test=0;
        while(($entree=$reponse->fetch())&&($test==0)){
            if ($entree['instructorMail']==$_POST['mail']) {
                $test=1;
            }
        }
        if ($test==1) {
            echo "<script> alert('your already sent us your request to be an instructor ..')</script> ";
        }
        if ($user['email'] != $_POST['mail']) {
            echo "<script> alert('Check your mail please !')</script>";
        }
        if (isset($_FILES['cv'])){
		    $taillemax = 17179869184; //2 Go
		    $extensionsValides = array('pdf','docx');
		    if($_FILES['cv']['size'] <= $taillemax){
                $extensionsUpload = strtolower(substr(strrchr($_FILES['cv']['name'],'.'),1));//prendre juste l'exxtension
                if(in_array($extensionsUpload,$extensionsValides)){
                    $chemin="instructor/cv/".$_SESSION['id'].".".$extensionsUpload;
                    $result=move_uploaded_file($_FILES['cv']['tmp_name'],$chemin);
                    if($result){
                        if(isset($_FILES['video'])){
                            $taillemax1 = 111669149696; //13 Go
                            $extensionsValides1 = array('mp4','mkv','mvi');
                            if($_FILES['video']['size'] <= $taillemax1){
                                $extensionsUpload1 = strtolower(substr(strrchr($_FILES['video']['name'],'.'),1));//prendre juste l'exxtension
                                if(in_array($extensionsUpload1,$extensionsValides1)){
                                    $chemin1="instructor/video/".$_SESSION['id'].".".$extensionsUpload1;
                                    $result1=move_uploaded_file($_FILES['video']['tmp_name'],$chemin1);
                                    if($result1){
                                        $requete=$db->prepare('INSERT INTO instructor (instructorMail,QyesornoInstructor,QexperienceInstructor,Motivationletter,instructorCv,instructorVideo) VALUES (:mail,:yesorno,:experience,:lettre_de_motivation,:cv,:video)');
                                        $requete->execute(array('mail'=>$_POST['mail'],'yesorno'=>$_POST['yesorno'],'experience'=>$_POST['experience'],'lettre_de_motivation'=>$_POST['lettre_de_motivation'],'cv'=>$_SESSION['id'].".".$extensionsUpload,'video'=>$_SESSION['id'].".".$extensionsUpload1));
                                        echo " <script> alert('Your request has been successfully sent!')</script>";
                                    }
                                    else{
                                        echo"<script>alert('Error during the importation of your Video file !')</script>";
                                    }
                                }
                                else{
                                    echo"<script>alert('Make sure that the extension of your file is mp4 or mkv or mvi !')</script>";
                                }
                            }
                            else{
                                echo"<script>alert('Your video must not exceed the size of 13Go !')</script>";
                            }
                        }
                    }
                    else{
                        echo"<script>alert('Error during the importation of your CV file !')</script>";
                    }
                }
                else{
                    echo"<script>alert('Make sure that the extension of your cv is pdf or docx !')</script>";
                }
		    }
		    else{
			    echo"<script>alert('Your cv must not exceed the size of 2Go !')</script>";
		    }
	    }
	}
    else{
	    echo " <script> alert('Please  fill in all fields ')</script>";
    }
?>

<br><br> <hr>
<table align="center">
       <tr>  <td><input type="reset" id="submit" name="reset" value="cancel"></td>
         
          	
		<td> <input type="submit"  id="submit" name="submit" value="Send" ></td>
		</tr>
		 </table>         	
	</form>

	


</div>
<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-4 offset-1 col-sm-2">
					<h5>Links</h5>
					<ul class="list-unstyled">
						<li><a href="index1.php">Home</a></li>
						<li><a href="allcourses1.php">AllCourses</a></li>
						<li><a href="services1.php">Services</a></li>
						<li><a href="contact1.php">Contact</a></li>
						<li><a href="formateur.php">Instructor</a></li>
					</ul>
				</div>
				<div class="col-7 col-sm-5 text-center">
					<h5>Our Adress</h5>
					<adress>
						National School of Computer Sciences (ENSI), <br>
						University of la Manouba-Tunisia-Tunis.<br>
					</adress>
					<h5>Contact Us</h5>
					<i class="fa fa-phone fa-lg"></i>:95 139 891<br>
					<i class="fa fa-fax fa-lg"></i>:71 600 444<br>
				</div>
				<div class="col-12 col-sm-4 aligh-self-center">
					<h5>Connect with us on social media</h5>
					<div>
						<i class="fa fa-envelope fa-lg"></i>:
						<a href="mailto:haifa.azaiz@ensi-uma.tn">haifa.azaiz@ensi-uma.tn</a><br>
						<i class="fa fa-envelope fa-lg"></i>:
						<a href="mailto:nessine.satouri@ensi-uma.tn">nessine.satouri@ensi-uma.tn</a><br>
						<i class="fa fa-envelope fa-lg"></i>:
						<a href="mailto:meriem.said@ensi-uma.tn">meriem.said@ensi-uma.tn</a><br>
						<center>
						<a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/haifa.azaiz.9480" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
						<a class="btn btn-social-icon btn-linkedin" href="www.linkedin.com/in/azaiz-haifa-76680219a" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a>
						<a class="btn btn-social-icon btn-instagram" href="https://www.instagram.com/hai1_23/?hl=fr" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
						</center>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->

	<!-- Script Source Files -->
	<script src="js/script.js"></script>
	<!-- jQuery -->
	<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Popper JS -->
	<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
	<!-- End Script Source Files -->

</body>
</html>