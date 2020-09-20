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
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
	<style>
 .swiper-container {
	width: 30rem;
	height: 30rem;
	margin-right: 10%;
	}
	.swiper-slide {
        text-align: center;
      font-size: 18px;
	  background-position: center;
      background-size: cover;
		/* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
	}

	</style>
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
                    <li class="nav-item"><a href="index1.php" class="nav-link active">HOME</a></li>
                    <li class="nav-item"><a href="allcourses1.php" class="nav-link">All Courses</a></li>
                    <li class="nav-item"><a href="services1.php" class="nav-link">Services</a></li>
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
        </div>
    </nav>
    <!-- End Navigation -->
    <!-- Image Carousel -->
		<div id="carousel" class="carousel slide" data-ride="carousel" data-intervall="2000">

<!-- Carousel Content -->
<div class="carousel-inner">
    <div class="carousel-item active">
        <img src="img/carousel/7.jpg" class="w-100"  alt="first">
        <div class="carousel-caption">
            <div class="container">
                <div class="row">
                    <div class="d-none d-md-block cl-11-md col-lg-9 col-xl-8  bg-dark text-left animated bounceInLeft" style="animation-delay: 0.2s;">
                        <CENTER><h3 class="pb-3">TAKE THE FIRST STEP</h3></CENTER>
                        <CENTER><h1>TO KNOWLEDGE WITH US</h1></CENTER>
                        <div class="border-top border-white mb-3 w-75 ml-auto"></div>
                        <p class="lead">Skill up and have an impact! Your business career starts here.Time to start!</p>
                        <CENTER><a href="allcourses1.php" class="btn btn-light btn-sm btn-md">START NOW </a></CENTER>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-item">
        <img src="img/carousel/2.jpg" class="w-100" alt="second">
        <div class="carousel-caption">
            <div class="container text-left">
                <h1 class="animated slideInDown"  style="animation-delay: 0.5s;">START INVESTING IN YOU</h1></CENTER>
                <h3 class="animated slideInRight lead"  style="animation-delay: 1s;">Start your online course today !</h3></CENTER>
                <a href="allcourses1.php" class="btn btn-light btn-sm btn-md">Choose your course</a>
            </div>
        </div>
    </div>
    <div class="carousel-item">
        <img src="img/carousel/3.jpg" class="w-100" alt="third">
        <div class="carousel-caption">
            <div class="container">
                <div class="row">
                    <div class="d-none d-md-block cl-11-md col-lg-9 col-xl-8 bg-light text-left text-dark">
                        <h1 class="animated slideInRight"  style="animation-delay: 0.5s;">BOOST YOUR CAREER</h1>
                        <h3 class="animated slideInLeft"  style="animation-delay: 0.5s;">REACH NEW HEIGHTS</h3>
                        <p class=" animated slideInRight lead"  style="animation-delay: 1s;">How to make an impact,get recognized and build the career you want!</p>
                        <a href="services1.php" class="btn btn-light btn-sm btn-md">learn more..</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Carousel Content -->

<!-- Carousel Indicators -->
<ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
</ol>
<!-- End Carousel Indicators -->

</div>
<!-- End Image Carousel -->
</div> 
<!-- End Navigation Sticky-->

<div class="col-12 text-center mt-5">
		<h2 class="display-4 pt-4">Join our Community</h2>
		<div class="border-top border-dark w-50 mx-auto my-3">
			<p class="lead">
				This community group is always on, always there, and always helpful.
			</p>
		</div>
	</div>
	<div class="container">
		<div class="row justify-content-center my-5 text-center">
			<div class="col-md-6 col-lg-4 py-3">
				<img src="img/member.png" class="w-50"  alt="member">
				<h4 style="background-color:  #ddf4f8;"> Learners</h4>
				<p class="lead">You start with your passion and knowledge, then choose a topic and plan your lectures with us.</p>
				<a href="allcourses1.php" class="btn btn-outline-info btn-sm btn-md">learn more..</a>
			</div>
			<div class="col-md-6 col-lg-4 py-3">
				<img src="img/formateur.jpg" class="w-50"  alt="instructor">
				<h5 style="background-color:  #ddf4f8;">Instructors</h5>
				<p class="lead">Help people learn new skills, advance their careers, and explore their hobbies by sharing your knowledge.</p>
				<a href="formateur.php" class="btn btn-outline-info btn-sm btn-md">learn more..</a>
			</div>
			<div class="col-md-6 col-lg-4 py-3">
				<img src="img/admin.webp" class="w-50"  alt="admin">
				<h5 style="background-color:  #ddf4f8;">Admins</h5>
				<p class="lead">Take advantage of our active community of admins by using our Services or Contact center to help you through the process.</p>
				<a href="contact1.php" class="btn btn-outline-info btn-sm btn-md">learn more..</a>
			</div>
		</div>
	</div>
	<div style="background-color:  #fcf0f3;">
		<div class="row my-10 text-center">
			<div class="col" style="transform: translateY(+20%);">
				<div class="container">
					<h3 style="color: #16879b;">Time to choose your path</h3><br>
					<p class="lead d-none d-md-block">Every course on SAS is taught by top instructors from world-class universities and 
						companies, so you can learn something new anytime, anywhere.
						All the courses are free and they give you access to on-demand video lectures, documents, 
						and also quizzes.<br>Don't hesitate to choose the field that you are interestes
					in and <br> dig into it .</p><br>
					<h5 style="color: rgb(134, 9, 118);">Do you want to..</h5>
				</div>
			</div>
			<div class="col swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide ">
						<div class="card shadow h-75">
							<div class="card-body text-center">
								<h5 class="card-title" style="color: rgb(102, 56, 97);">Computer Science</h5>
								<img class="card-img-top" src="img/web.jpg" alt="web" style="height: 12rem;">
							</div>
							<a href="allcourses1.php" class="btn btn-link" style="color:inherit;">
								<div class="card-footer">
									Start a new career with web development 
									&nbsp;
									<i class="fa fa-hand-o-right" aria-hidden="true"></i>
								</div>
							</a>
						</div>
					</div>
					<div class="swiper-slide ">
						<div class="card shadow h-75">
							<div class="card-body text-center">
								<h5 class="card-title" style="color: rgb(82, 28, 74);">Business</h5>
								<img class="card-img-top" src="img/business.jpg" alt="business" style="height: 12rem;">
							</div>
							<a href="allcourses1.php" class="btn btn-link" style="color:inherit;">
								<div class="card-footer">
									Advance your business skills 
									<i class="fa fa-hand-o-right" aria-hidden="true"></i>
								</div>
							</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="card shadow h-75">
							<div class="card-body text-center">
								<h5 class="card-title" style="color: rgb(102, 56, 97);">ArtHumanity</h5>
								<img class="card-img-top" src="img/arts.jpg" alt="web" style="height: 12rem;">
							</div>
							<a href="allcourses1.php" class="btn btn-link" style="color:inherit;">
								<div class="card-footer">
									Develop your skills in your art
									&nbsp;
									<i class="fa fa-hand-o-right" aria-hidden="true"></i>
								</div>
							</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="card shadow h-75">
							<div class="card-body text-center">
								<h5 class="card-title" style="color: rgb(82, 28, 74);">Health</h5>
								<img class="card-img-top" src="img/health.jpg" alt="business" style="height: 12rem;">
							</div>
							<a href="allcourses1.php" class="btn btn-link" style="color:inherit;">
								<div class="card-footer">
									Start a new career with health care 
									<i class="fa fa-hand-o-right" aria-hidden="true"></i>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
		<div class="row justify-content-center text-center bg-light shadow" >
			<center><i class="fa fa-list-alt fa-2x" aria-hidden="true" style="color:darksalmon"></i></center>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<center><h5 style="color: #18191a;">Or pick a course from our course library</h5></center>
			<center>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="allcourses1.php" style="color:inherit;">
					<i class="fa fa-arrow-circle-o-right fa-2x" aria-hidden="true" style="color:darksalmon"></i>
				</a>
			</center>
		</div>
	</div>
	
		<div class="col-12 text-center mt-5">
			<h2 class="display-4 pt-4">Expand your reach</h2>
			<div class="border-top border-dark w-50 mx-auto my-3">
				<p class="lead">
					We aim to change lives by connecting instructors with students around the world.
				</p>
			</div>
		</div>
		<div class="container justify-content-center my-5 text-center">
			<div class="row">
				<div class="col-md-6 col-lg-4 py-3">
					<img id="feedback2" src="img/haifa.jpg" class="rounded-circle" alt="h" style="width:8rem;height:8rem;">
					<h4 style="color:#236672;">Azaiz Haifa </h4>
					<p class="lead">
						Launching my first course on SAS allowed me to quit my full-time job and 
						start my own company.
					</p>
				</div>
				<div class="col-md-6 col-lg-4 py-3">
					<img id="feedback1" src="img/meriem.jpg" class="rounded-circle" alt="m" style="width:8rem;height:8rem;">
					<h4 style="color:#236672;" > Said Meriem</h4>
					<p class="lead">
						SAS has given me the opportunity to reach a global
						audience for my classes that wouldn’t have been possible otherwise.
					</p>
				</div>
				<div class="col-md-6 col-lg-4 py-3">
					<img id="feedback3" src="img/nessrine.jpg" class="rounded-circle" alt="n" style="width:8rem;height:8rem;" >
					<h4 style="color:#236672;">Satouri Nessrine </h4>
					<p class="lead">
						Teaching on SAS has brought me new relationships from wonderful and 
						insatiably curious students.
					</p>
				</div>
			</div>
			<br>
			<div class="row justify-content-center">
				<a href="formateur.php" class="btn btn-lg btn-md" style="background-image: url('img/table2.jpg');">
					Become an instructor today
				</a>
			</div>
		</div>
	

<!-- Start Footer -->
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
		  <!-- Swiper JS -->
		  <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
	  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<!-- Initialize Swiper -->
		<script>
			var swiper = new Swiper('.swiper-container', {
				effect: 'flip',
				grabCursor: true,
				pagination: {
					el: '.swiper-pagination',
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				});
		 </script>
	<!-- jQuery -->
	<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Popper JS -->
	<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
	<!-- End Script Source Files -->
</body>
</html>