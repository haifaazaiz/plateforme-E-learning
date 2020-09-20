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
    <link rel="stylesheet" href="css/stylecourses.css">
    <link rel="stylesheet" href="css/color1.css">
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
				//course information
				$id=$_GET['id_course'];
				$req1=$db->prepare("SELECT * FROM instructorcourse WHERE id=?");
				$req1->execute(array($id));
				$course=$req1->fetch();
				//comments
				$comments=$db->query("SELECT * FROM comments WHERE id_course_instructor=$id");
			}
			if((isset($_POST["submit_comment"]))&&(!empty($_POST["comment"]))){
				$req3=$db->prepare("INSERT INTO comments(user_id,user_name,user_photo,comment,id_course_instructor) VALUES(:user_id, :user_name, :user_photo, :comment, :id_course_instructor)");
				$req3->execute(array(
					'user_id'=>$_SESSION['id'],
					'user_name'=>$_SESSION['username'],
					'user_photo'=>$_SESSION['profile_photo'],
					'comment'=>$_POST['comment'],
					'id_course_instructor'=>$id
				));
			}
		?>
    <!-- Navigation -->
    <nav class="navbar bg-light navbar-light navbar-expand-lg sticky-top">
		<div class="container">
			<a href="index.html" class="navbar-brand">
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
	<!-- Start Breadcrumbs -->
	<div class="container">
		<div class="jumbotron">
            <center>
			 
				
				
				<h2 class="text-info">Welcome</h2>
				<h2><?php echo $user['username']; ?></h2>
            </center>
            <ol class="col-12 breadcrumb">
                <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
				<li class="breadcrumb-item active"><?php echo $course['courseName'] ?></li>
				<li class="breadcrumb-item"><a href="newcourses.php">New Courses</a></li>
            </ol>
		</div>
	</div>
	</br>
	<div class="container m-15 p-4">
		<div class="row">
			<div id="navbar-example3" class="list-groupe col-2 m-12 p-1">
				<a class="list-group-item list-group-item-action active" href="#item-1"><p>1.Introduction</p></a>
				<a class="list-group-item list-group-item-action active"href="#item-2"><p>2.Course Sourse</p></a>
				<a class="list-group-item list-group-item-action active" href="#item-3"><p>3.Lecture Materials</p></a>
				<a class="list-group-item list-group-item-action active" href="#item-4"><p>4.Quiz</p></a>
			</div>
			<div data-spy="scroll" data-target="#navbar-example3" data-offset="0" style="width:500px;height:400px;overflow-y:scroll;" class="scrollspy-exemple col border p-1 m-1 rounded">
				<h4 id="item-1" style="color:#2b6079">Introduction</h4>
				<?= $course['Introduction'] ?>
				</br>
				<h4 id="item-2" style="color:#2b6079">Course Sourse</h4>
				<p> Download your course </p>
				<a  href="instructor/courses/pdf/<?= $course['pdf'] ?>"><button type="button" class="btn btn-danger">PDF</button></a>
				</br></br></br>
				<h4 id="item-3" style="color:#2b6079">Lecture Materials</h4>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" style="width:30rem; height=300rem" src="instructor/courses/video/<?= $course['video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				</br>
				<h4 id="item-4" style="color:#2b6079">Quiz</h4>
				<a href="<?= $course['exam'] ?>" target="_blank"><button type="button" class="btn btn-info">Click here to fill up you Quiz!</button></a>
			</div>
		</div>
		<div class="row" style="margin-top:100px; margin-left:100px;border: 1px solid rgb(206, 204, 206);padding:50px;">
			<legend><h4 style="color:#339db1;"><u>Comments:</u></h4></legend>
			</br>
			<table cellpadding="15" cellspacing="10" width="100%">
				<?php while($comment=$comments->fetch()){?>
					<tr>
						<td width="25%" align="justify" valign="center">
							<img src="img/members/<?= $comment['user_photo']?>" width="50px" class="rounded-circle">
							<strong><?php echo $comment['user_name'];?></strong>
						</td>
						<td width="75%" align="justify" valign="center">
							<?php echo $comment['comment']."</br>";?>
						</td>
					</tr>
				<?php } ?>
			</table>			
			<form method="POST" action="" name="">
				<label for="comment">
					<img src="img/members/<?php echo $_SESSION['profile_photo'];?>" width="50px" class="rounded-circle">
					<?= $_SESSION["username"]?>
				</label>
				<input type="textarea" name="comment" id="comment" placeholder="Type your comment here">
				<i class='fa fa-paper-plane-o fa-1x'></i>
				<input type="submit" name="submit_comment" class="btn btn-info" value="Post your comment">
			</form>
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
	<!-- jQuery -->
	<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Popper JS -->
	<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
	<!-- End Script Source Files -->
</body>
</html>