<!DOCTYPE html>
<html>
<head>
    <title> SERVICES</title>
    <link rel="shortcut icon" href="img/logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="css/animate.css-main/source/animate.css">
    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="css/stylequest.css">
    <!--------BootstrapCDN------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <!---ICONS -->
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!------>
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
    <div class="background"> 
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
                    <li class="nav-item"><a href="services1.php" class="nav-link active">Services</a></li>
                    <li class="nav-item"><a href="contact1.php" class="nav-link">Contact</a></li>
					<li class="nav-item"><a href="formateur.php" class="nav-link">Instructor</a></li>
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
    </nav>
            </div>
    <!-- End Navigation -->
    <section id="lifetimeaccess">
  <div class="container">
    <p class="access ml-auto"> 
      <a href="index1.php"> Home </a> ><a href="services1.php">Services</a> >How Does SAS work?
    </p>
    <div class="row">  
      <div class="col-md-3"></div>
      <div class="col-md-9">
        <h3>How Does SAS work?</h3>
        <br>
          <p>
            SAS's mission is to improve lives through learning. Our global marketplace features an extensive, multi-language library, which includes thousands of courses taught by expert instructors. 
            You can take courses across a wide range of categories, some of which include: business & entrepreneurship, programming, academics, the arts, health & fitness, music and much more! 
          Below are answers to some of the frequently asked questions we receive about how SAS works.</p>
        <h5>What do SAS courses include?</h5>

        <p>Each "SAS" course is created, owned and managed by the instructor(s) and also the admin(s). The foundation of each course are its lectures, which can include videos, 
        slides, and text. In addition, instructors can add resources and various types of practice activities, 
        as a way to enhance the learning experience of students. 

        Additional information on "SAS"’s platforms and features can be reviewed here. 

        For tips on how to find courses you may be interested in taking, please don't hesitate to send us a message.</p>

        <h5>How do I take a "SAS" course?</h5>

        <p>"SAS" courses are entirely on-demand. You can begin the course whenever you like, and there are no deadlines to complete it.

        "SAS" courses can be accessed from several different devices and platforms, including a desktop or laptop. 

        After you enroll in a course, you can access it by clicking on the course link and you will get it immediatly.
        After add the course to your courses, you can also begin it by logging in and navigating to my Courses in your
        My profile page.</p> 

        <h5>Do I have to start my course at a certain time? And how long do I have to complete it?</h5>

        <p>As noted above, there are no deadlines to begin or complete the course.
        Even after you complete the course you will continue to have access to it, provided that your account’s
        in good standing, and SAS continues to have a license to the course.
        To learn more about our Lifetime Access policy, please find it in Services page.</p>

        <h5>Is SAS an accredited institution? Do I receive anything after I complete a course?</h5>

        <p>While SAS is not an accredited institution, we offer skills-based courses taught by experts in their field,
        and we are thinking of making a certificate of completion for each course to document your accomplishment. </p>
      </div>
    </div>
  </div>
</section>
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