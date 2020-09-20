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
      <a href="index1.php"> Home </a> ><a href="services1.php">Services</a> > Lifetime Access</p>
      <div class="row">
         
        
         <div class="col-md-3"></div>
         
<div class="col-md-9">
         <h3>Lifetime Access</h3>
         <br>
         <p>One of the best things about SAS is that you can login to your account from virtually anywhere,
 whenever you want, and access your courses easily! We strongly believe that students will benefit from the 
 limitless educational possibilities this feature presents.

Once you enroll in a course, you'll have access for life, provided that your account is in good standing and
 SAS continues to have a license to that course.

You have the freedom to learn at your own pace.
 SAS is your academy - learn what you want, when you want.</p>

<h5>Lifetime Access: Commonly Asked Questions</h5>

<p>Below are answers to questions we often receive regarding lifetime access.</p>

<h5>
Will I continue to have access to the course even after I complete it?</h5>

<p>Yes. You will continue to have access to the course after you complete it, provided that your account’s 
in good standing, and SAS continues to have a license to the course. So, if you wish to review specific 
content in the course after you finish it, or take it all over again, you can.</p>


<h5>What happens if the instructor removes the course from SAS?</h5>

<p>We host more than 150,000 courses on our online learning website. We do 
 own the copyright to the content of the courses not the instructors.So, 
  on rare occasions, SAS may have to remove a course from the platform for policy or legal reasons. 
  If this does happen to a course you're
    enrolled in, please contact us and we'll be ready to help.</p>

<b>Please note:</b><p> Occasionally instructors may decide to unpublish their course and close it 
  to additional enrollments. For example, an instructor might unpublish an older course until they’ve
   had a chance to update the course content. In situations where an instructor unpublishes their course, 
   however, the course content remains on the platform and is still accessible to students who are
    enrolled in the course.</p>

<h5>Can my courses ever be removed from SAS?</h5>

<p>On rare occasions, SAS may be required to remove a course from the platform due to policy or legal
   reasons. If this does happen to a course you're enrolled in, please contact us and we'll be ready to help</p>

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