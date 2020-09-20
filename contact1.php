<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-Compatible" content="ie=edge">
	<title>E-learning</title>
	<link rel="shortcut icon" href="img/logo.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="css/animate.css-main/source/animate.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/style.css">
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
			if((!empty($_POST['first_name']))&&(!empty($_POST['last_name']))&&(!empty($_POST['email']))&&(!empty($_POST['message']))){
				$sql="INSERT INTO messages(first_name,last_name,email,message) VALUES(:first_name, :last_name, :email, :message)";
				$req=$db->prepare($sql);
				$req->execute(array(
					'first_name'=>$_POST['first_name'],
					'last_name'=>$_POST['last_name'],
					'email'=>$_POST['email'],
					'message'=>$_POST['message']
				));
				$msg="Your message has been successfully sent.";
			}
		?>
    <!-- Navigation -->
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
                    <li class="nav-item"><a href="contact1.php" class="nav-link active">Contact</a></li>
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
        </div>
    </nav>
	<!-- End Navigation -->

		<div class="jumbotron">
			<div class="container">
				<center>
					<h2>We want to hear from you</h2>
					<h5>Please fill out our form, and we'll get in touch shortly.</h5>
				</center>
				<ol class="col-12 breadcrumb">
					<li class="breadcrumb-item"><a href="./index.html">Home</a></li>
					<li class="breadcrumb-item active">Contact Us</li>
				</ol>
			</div>
		</div>

	<div class="container">
		<div class="row">
			<div class="col-6">
				<img src="img/letter.jpg" class="w-75 h-200" alt="">
			</div>
			<div class="col-6">
				<form method="POST" action="contact1.php" name="formulaire" onsubmit="javascript: return validation();">
						<?php if (isset($msg)) {echo('<span style="color:green;">'.$msg.'</span>');}?>
						<input type="text" name ="first_name" id ="first_name"required  oninvalid="this.setCustomValidity('Please enter your first name')" placeHolder="&nbsp;&nbsp;&nbsp;First Name"><br>
						<input type="text" name ="last_name" id ="last_name" required  oninvalid="this.setCustomValidity('Please enter your last name')" placeHolder="&nbsp;&nbsp;&nbsp;Last Name"><br>
						<input type="text" name ="email" id ="email" required  oninvalid="this.setCustomValidity('Please enter your email')" placeHolder="&nbsp;&nbsp;&nbsp;What's your email?"><br>
						<input type="textarea" name ="message" id="message" required  oninvalid="this.setCustomValidity('Please enter your message')" placeholder="&nbsp;&nbsp;&nbsp;Your feedback,Your questions..">
						<input type="submit" name="submit" id="submit" value="Send Message"><br>
				</form>
			</div>
		</div>
		<div class="row row-content">
			<div class="col-6">
				<div class="card">
					<h4 class="card-header text-black">Other ways to connect</h4>
					<div class="card-body">
						<i class="fa fa-phone fa-lg"></i>:95 139 891<br>
						<i class="fa fa-fax fa-lg"></i>:71 600 444<br>
						<i class="fa fa-envelope fa-lg"></i>:
						<a href="mailto:haifa.azaiz@ensi-uma.tn">haifa.azaiz@ensi-uma.tn</a><br><br>
						<center>
							<a role="button" class="btn btn-primary" href="tel:+986456846"><i class="fa fa-phone"></i>Call</a>
							<a role="button" class="btn btn-info"><i class="fa fa-skype"></i>Skype</a>
							<a role="button" class="btn btn-success" href="mailto:haifa.azaiz@ensi-uma.tn"><i class="fa fa-envelope-o"></i>Email</a>
						</center>
					</div>
				</div>
			</div>
			<div class="col-6  location">
				<div class="card">
					<h4 class="card-header text-black">Location Information</h4>
					<div class="card-body">
						<center>
							National School of Computer Sciences (ENSI), <br>
							University of la Manouba-Tunisia-Tunis.<br>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
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