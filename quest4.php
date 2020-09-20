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
    <a href="index1.php"> Home </a> ><a href="services1.php">Services</a> > How to Become an Instructor ?
    </p>
   <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <h3>How to Become an Instructor ?</h3>
            <br>
            <p>
            We are happy you are interested in becoming a SAS instructor. At SAS you can teach what you 
            know, or teach what you love, and millions of students are waiting, eager to learn.
            Below are answers to the most frequently asked questions we receive regarding how to
             become an instructor.</p>
            <h5>Can I teach a course on any topic?</h5>
            <p>You are free to choose the topic you wish to teach on SAS. Please refer to our restricted 
                topic list  in the form that give you the oppurtunity to upload your course.</p>
            <h5>Do I have to pay any fees in order to become an instructor?</h5>
            <p>There is no fee to be an instructor on SAS.</p>
            <h5>What is the general structure of a SAS course? What is the primary teaching method?</h5>
            <p>A standard SAS course is video-based. Courses must have at least 30 minutes of video 
                content and at least one introduction and one document or PDF. Additional teaching 
                tools (like assignments, quizzes, and coding exercises, etc) can be added to create 
                a rich learning experience for students.</p>
            <h5>Are there any requirements that my course must meet?</h5>
            <p>You can find most of the requirements while filling in the form of uploading a course but 
                in order to ensure that students have great learning experiences, we also have a Quality 
                Review Process that every course goes through. 
            </p>
            <h5>Can I teach a course in this language?</h5>
            <p>You can teach a course in any language of your choosing but we prefer the English.</p>
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