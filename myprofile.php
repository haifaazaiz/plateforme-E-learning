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
            //user informations
            $req=$db->prepare("SELECT * FROM members WHERE id=?");
            $req->execute(array($_SESSION['id']));
            $user=$req->fetch();
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
                    <li class="nav-item"><a href="contact1.php" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="formateur.php" class="nav-link">Instructor</a></li>
                    <?php if($_SESSION['accessRights']==2) { ?>
					<li class="nav-item"><a href="administration/admin.php" class="nav-link">Administration</a></li>
					<?php } ?>
                </ul>
                <!--<span class="navbar-text">
                    <a class="btn" role="button">
						<i class="fa fa-user-circle fa-2x"></i>
					</a>
				</span> -->
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

    <!-- myprofile body -->
    
        <div class="jumbotron">
            <div class="container">
                <?php if (!empty($_SESSION['profile_photo'])) { ?>
                <img src="img/members/<?php echo $_SESSION['profile_photo'];?>" width="150px" style="margin-top:-40px;" class="rounded-circle">
                <?php } else {?>
                    <img src="img/profile.jpg" alt="your image" width="150px" style="margin-top:-40px;" class="rounded-circle">
                <?php }?>
                <label><h1><?php echo $_SESSION['username'];?></h1></label>
                <!--<button class="btn btn-primary pull-right">Edit my profile</button>-->
            </div>
        </div>
        <div class="container" style="background-color: rgb(247, 249, 250);border-radius:1.5rem;margin-bottom:30px;">
            <?php if (!empty($_SESSION['linkedin'])) { ?>
            <label><h6>My social media accounts:&nbsp;&nbsp;&nbsp;</h6></label>
            <a class="btn btn-social-icon btn-linkedin" href="<?php echo $_SESSION['linkedin'];?>" target="_blank">
                <i class="fa fa-linkedin fa-lg"></i>
            </a>
            <?php } ?>
            <?php if (!empty($_SESSION['instagram'])) { ?>
                <a class="btn btn-social-icon btn-instagram" href="<?php echo $_SESSION['instagram'];?>" target="_blank">
                    <i class="fa fa-instagram fa-lg"></i>
                </a>
            <?php } ?>
            <?php if (!empty($_SESSION['facebook'])) { ?>
                <a class="btn btn-social-icon btn-facebook" href="<?php echo $_SESSION['facebook'];?>" target="_blank">
                    <i class="fa fa-facebook fa-lg"></i>
                </a>
            <?php } ?>
            <?php if (!empty($_SESSION['twitter'])) { ?>
                <a class="btn btn-social-icon btn-twitter" href="<?php echo $_SESSION['twitter'];?>" target="_blank">
                    <i class="fa fa-twitter fa-lg"></i>
                </a>
            <?php } ?>
            <?php if (!empty($_SESSION['github'])) { ?>
                <a class="btn btn-social-icon btn-github" href="<?php echo $_SESSION['github'];?>" target="_blank">
                    <i class="fa fa-github fa-lg"></i>
                </a>
            <?php } ?>
        </div>
        <div class="container" style="background-color: rgb(247, 249, 250);border-radius:1.5rem;margin-bottom:30px;">
        <div class="row">
                <div class="col">
            <center><h4><u>About me</u></h4></center>
            </div></div>
            <div class="row">
                <div class="col offset-1">
                    <?php if (!empty($_SESSION['birthday'])) { ?>
                    <label><h6>Birthday:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['birthday'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['gender'])) { ?>
                    <label><h6>Gender:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['gender'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['phone_number'])) { ?>
                    <label><h6>Phone Number:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['phone_number'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['location'])) { ?>
                    <label><h6>Location:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['location'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['about_me'])) { ?>
                    <label><h6>About:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['about_me'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['skills'])) { ?>
                    <label><h6>Skills:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['skills'];?>
                    <?php } ?><br>
                </div>
                <div class="col">
                    <?php if ((!empty($_SESSION['student'])) && ($_SESSION['student']=="yes") ){ ?>
                    <label><h6>I'm currently a student</h6></label>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['degree'])) { ?>
                    <label><h6>Highest degree:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['degree'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['university'])) { ?>
                    <label><h6>University:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['university'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['field'])) { ?>
                    <label><h6>Field:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['field'];?>
                    <?php } ?><br>
                    <?php if ((!empty($_SESSION['employment_status']))&&($_SESSION['employment_status']!="Select your current status")) { ?>
                    <label><h6>Employment status:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['employment_status'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['industry'])) { ?>
                    <label><h6>Industry:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['industry'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['employer'])) { ?>
                    <label><h6>Employer:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['employer'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['occupation'])) { ?>
                    <label><h6>Occupation:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['occupation'];?>
                    <?php } ?><br>
                    <?php if (!empty($_SESSION['experience_level'])) { ?>
                    <label><h6>Experience level:&nbsp;&nbsp;</h6></label>
                    <?php echo $_SESSION['experience_level'];?>
                    <?php } ?><br>
                </div>
            </div>
        </div>
        <div class="container" style="background-color: rgb(247, 249, 250);border-radius:1.5rem;margin-bottom:30px;">
            <center><h4><u>Courses i'm currently enrolled in </u></h4></center>
            <div class="row justify-content-center" >
            <?php 
                $mycourses=$user['mycourses'];
                if($mycourses!=""){
                    $tabcourses=preg_split('[//]',$mycourses);
                    foreach ($tabcourses as $idcourse){
                        if($idcourse!=""){
                        $req1=$db->prepare("select * from courses where id=?");
                        $req1->execute(array($idcourse));
                        $courses=$req1->fetch();?>
                        <div class="col-md-3">
                            <div class="card shadow" style="width: 12rem;height: 23rem;">
                                <img class="card-img-top" src="<?=$courses['image']?>" alt="HTML">
                                <div class="card-body text-center">
                                    <h5 class="card-title" style="text-transform : uppercase;"><?=$courses['name']?></h5>
                                    <p class="card-text"><?=$courses['image_text']?></p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="<?="allcourses/".$courses['name'].".php"?>" class="btn btn-primary">RESUME</a> 
                                </div>
                            </div>
                        </div>
               <?php }} } ?>
            </div>
        </div>
        <div class="container" style="background-color: rgb(247, 249, 250);border-radius:1.5rem;">
                       
                <center>
                    <i class="fa fa-graduation-cap fa-2x"></i>
                    <h4><u>Achievements</u></h4>
                </center>

        </div>
    
    <!-- end myprofile body -->

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