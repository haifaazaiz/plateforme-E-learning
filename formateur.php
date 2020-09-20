<!DOCTYPE html>
<html>
<head>
	<title>E-learning</title>

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
	<link rel="stylesheet" href="css/styleinstructor.css">
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


	      

	
<div class="instructor" align="center" >
<h1>Became An Instructor </h1>
<h4>If you want to become a sucessful instructor then you should learn how to do this things</h4>
</div>

<div class=" border  " id="bloc1">
	<h3>Learn Video Content Creation </h3>
	<div class ="row">
		
 <div class="col-6">
  
  <img class="video" src="img/video2.png">
 	
 </div>
 <div class="col-6">
 	<br><p>As you begin your course creation process, in addition to choosing your course topic and creating your course outline, it's important to start planning your course video production.</p>
 	
 </div>
	</div>
</div>

<div class="  border  " id="bloc2">
	<h3> Build Your Audience </h3>
	<div class="row">
		 <div class="col-6">
 	<p>You will have access to millions of students who are eager to learn from you. In order to get a head start and stand out from the competition, it's important to drive some of your own success, as well. Don't worry, you don't have to think about marketing just yet, but once you’re close to publishing your course, you'll have lots of resources to look at to help you build an audience. </p>
 	
 </div>
 <div class="col-6">
  
  <img  class="audience" src="img/audience.png">
 	
 </div>
 </div>
	
</div>

<div class=" border  " id="bloc3">
	<h3> Create an Engaging Course  </h3>
	<div class="row">
 <div class="col-6">
  
  <img class="video" src="img/eng_course.png">
 	
 </div>
 <div class="col-6">
 	<p> It's important to make sure you're engaging your students with a well-structured, practical, and rewarding course experience. The most successful instructors spend time planning their course before diving into filming to ensure their course will help students achieve clear goals. </p>
 	
 </div>
	
</div>
</div>

<button class="button" align="center"><a href="info-instructor.php">Became an Instructor </a></button>
<!-- Start Footer -->
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