<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-Compatible" content="ie=edge">
	<title>Verification name</title>
	<link rel="shortcut icon" href="img/logo.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="css/animate.css-main/source/animate.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/style-user-verification.css">
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
                    <li class="nav-item"><a href="about1.php" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="" class="nav-link">All Courses</a></li>
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
</div>
    
<div class="jumbotron">
    <ol class="col-12 breadcrumb ">
				<li class="breadcrumb-item"><a href="./index1.php">Home</a></li>
				<li class="breadcrumb-item "><a href="./myaccount.php">My profile</a></li>
				<li class="breadcrumb-item "><a href="./settings.php" >Settings</a></li>
				<li class="breadcrumb-item active">Verification Name</li>

	</ol>
</div>



<!----start verification sectio---->

<div class="container border border-secondary " id="verify_name">
       <h4>verify Your Name</h4><br>

       <p>Enter your real name. This is the name that will appear on your certificates. We may contact you to verify your identity, so please make sure this matches the name on your government-issued ID</p>	

        <form action="user-verification.php" method="post">

        	<table align="center">

                <tr>
                	<th>FIRST NAME</th>
                	<th>MIDDLE NAME</th>
                	<th>LAST NAME</th>

                </tr>
        		<tr>
        			<td><input type="text" id="sname" name="Fname" value="<?php if(!empty($user['firstname'])){echo $user['firstname'];}?>" > </td>
        			<td><input type="text" id="sname" name="Mname" value="<?php if(!empty($user['middlename'])){echo $user['middlename'];}?>" > </td>
        			<td><input type="text" id="sname" name="Lname" value="<?php if(!empty($user['lastname'])){echo $user['lastname'];}?>" > </td>

        		</tr>
           	</table>
            <br><hr><br>
            <input type="submit" name="changename" id="submit" value="submit">

        </form>	


</div>

<?php 

if (isset($_POST['changename'])&& !empty($_POST['Fname'])&& !empty($_POST['Mname'])&& !empty($_POST['Lname'])) {
	$requete= $db->prepare('UPDATE members SET firstname=:firstname ,middlename=:middlename,lastname=:lastname WHERE id=:id AND username=:username');
                     $requete-> execute(array('firstname'=>$_POST['Fname'],'middlename'=>$_POST['Mname'],'lastname'=>$_POST['Lname'],'id'=>$user['id'],'username'=>$user['username']));
                      
}

?>

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