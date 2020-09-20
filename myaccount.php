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
	$sql="select * from members where id= :id";
	$req=$db->prepare($sql);
	$req->execute(array( 'id' => $_SESSION['id']));
	$user_info=$req->fetch();
	//Update username
	if (isset($_POST['name'])){
		$updateprofil=$db->prepare("UPDATE members SET username= :username WHERE id= :id");
		$updateprofil->execute(array(
			'username'=>$_POST['name'],
			'id'=>$_SESSION['id']
		));
		$updatecomment=$db->prepare("UPDATE comments SET user_name= :user_name WHERE user_id= :id");
		$updatecomment->execute(array(
			'user_name'=>$_POST['name'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['username']=$user_info['username'];
	}
	//Update about
	if (isset($_POST['birthday'])){
		$updateprofil=$db->prepare("UPDATE members SET birthday= :birthday WHERE id= :id");
		$updateprofil->execute(array(
			'birthday'=>$_POST['birthday'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['birthday']=$user_info['birthday'];
	}
	if (isset($_POST['gender'])){
		$updateprofil=$db->prepare("UPDATE members SET gender= :gender WHERE id= :id");
		$updateprofil->execute(array(
			'gender'=>$_POST['gender'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['gender']=$user_info['gender'];
	}
	if (isset($_POST['phone'])){
		$updateprofil=$db->prepare("UPDATE members SET phone_number= :phone_number WHERE id= :id");
		$updateprofil->execute(array(
			'phone_number'=>$_POST['phone'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['phone_number']=$user_info['phone_number'];
	}
	if (isset($_POST['about'])){
		$updateprofil=$db->prepare("UPDATE members SET about_me= :about_me WHERE id= :id");
		$updateprofil->execute(array(
			'about_me'=>$_POST['about'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['about_me']=$user_info['about_me'];
	}
	if (isset($_POST['location'])){
		$updateprofil=$db->prepare("UPDATE members SET location= :location WHERE id= :id");
		$updateprofil->execute(array(
			'location'=>$_POST['location'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['location']=$user_info['location'];
	}
	if (isset($_POST['skills'])){
		$updateprofil=$db->prepare("UPDATE members SET skills= :skills WHERE id= :id");
		$updateprofil->execute(array(
			'skills'=>$_POST['skills'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['skills']=$user_info['skills'];
	}
	//Update student Section
	if (isset($_POST['student'])){
		$updateprofil=$db->prepare("UPDATE members SET student= :student WHERE id= :id");
		$updateprofil->execute(array(
			'student'=>$_POST['student'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['student']=$user_info['student'];
	}
	if (isset($_POST['degree'])){
		$updateprofil=$db->prepare("UPDATE members SET degree= :degree WHERE id= :id");
		$updateprofil->execute(array(
			'degree'=>$_POST['degree'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['degree']=$user_info['degree'];
	}
	if (isset($_POST['university'])){
		$updateprofil=$db->prepare("UPDATE members SET university= :university WHERE id= :id");
		$updateprofil->execute(array(
			'university'=>$_POST['university'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['university']=$user_info['university'];
	}
	if (isset($_POST['field'])){
		$updateprofil=$db->prepare("UPDATE members SET field= :field WHERE id= :id");
		$updateprofil->execute(array(
			'field'=>$_POST['field'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['field']=$user_info['field'];
	}
	//Update employer Section
	if (isset($_POST['employer'])){
		$updateprofil=$db->prepare("UPDATE members SET employer= :employer WHERE id= :id");
		$updateprofil->execute(array(
			'employer'=>$_POST['employer'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['employer']=$user_info['employer'];
	}
	if (isset($_POST['employment_status'])){
		$updateprofil=$db->prepare("UPDATE members SET employment_status= :employment_status WHERE id= :id");
		$updateprofil->execute(array(
			'employment_status'=>$_POST['employment_status'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['employment_status']=$user_info['employment_status'];
	}
	if (isset($_POST['industry'])){
		$updateprofil=$db->prepare("UPDATE members SET industry= :industry WHERE id= :id");
		$updateprofil->execute(array(
			'industry'=>$_POST['industry'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['industry']=$user_info['industry'];
	}
	if (isset($_POST['experience_level'])){
		$updateprofil=$db->prepare("UPDATE members SET experience_level= :experience_level WHERE id= :id");
		$updateprofil->execute(array(
			'experience_level'=>$_POST['experience_level'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['experience_level']=$user_info['experience_level'];
	}
	if (isset($_POST['occupation'])){
		$updateprofil=$db->prepare("UPDATE members SET occupation= :occupation WHERE id= :id");
		$updateprofil->execute(array(
			'occupation'=>$_POST['occupation'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['occupation']=$user_info['occupation'];
	}
	//Update Social media Urls
	if (isset($_POST['linkedin'])){
		$updateprofil=$db->prepare("UPDATE members SET linkedin= :linkedin WHERE id= :id");
		$updateprofil->execute(array(
			'linkedin'=>$_POST['linkedin'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['linkedin']=$user_info['linkedin'];
	}
	if (isset($_POST['facebook'])){
		$updateprofil=$db->prepare("UPDATE members SET facebook= :facebook WHERE id= :id");
		$updateprofil->execute(array(
			'facebook'=>$_POST['facebook'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['facebook']=$user_info['facebook'];
	}
	if (isset($_POST['github'])){
		$updateprofil=$db->prepare("UPDATE members SET github= :github WHERE id= :id");
		$updateprofil->execute(array(
			'github'=>$_POST['github'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['github']=$user_info['github'];
	}
	if (isset($_POST['twitter'])){
		$updateprofil=$db->prepare("UPDATE members SET twitter= :twitter WHERE id= :id");
		$updateprofil->execute(array(
			'twitter'=>$_POST['twitter'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['twitter']=$user_info['twitter'];
	}
	if (isset($_POST['instagram'])){
		$updateprofil=$db->prepare("UPDATE members SET instagram= :instagram WHERE id= :id");
		$updateprofil->execute(array(
			'instagram'=>$_POST['instagram'],
			'id'=>$_SESSION['id']
		));
		$_SESSION['instagram']=$user_info['instagram'];
	}
	//Update profile photo 
	if(isset($_FILES['photo'])&& !empty($_FILES['photo']['name'])){
		$taillemax = 2097152; //2 Mo
		$extensionsValides = array('jpg','jpeg','png','gif');
		if($_FILES["photo"]['size']<=$taillemax){
			$extensionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));//prendre juste l'exxtension
			if(in_array($extensionsUpload,$extensionsValides)){
				$chemin="img/members/".$_SESSION['id'].".".$extensionsUpload;
				$result=move_uploaded_file($_FILES['photo']['tmp_name'],$chemin);
				if($result){
					$updateprofil=$db->prepare('UPDATE members SET profile_photo= :profile WHERE id= :id');
					$updateprofil->execute(array(
						'profile'=>$_SESSION['id'].".".$extensionsUpload,
						'id'=>$_SESSION['id']));
					$updatecomment=$db->prepare('UPDATE comment SET user_photo= :profile WHERE user_id= :id');
					$updateprofil->execute(array(
						'profile'=>$_SESSION['id'].".".$extensionsUpload,
						'id'=>$_SESSION['id']));
					$_SESSION['profile_photo']=$user_info['profile_photo'];
				}
				else{
					$msg="Error during the importation of your file !";
				}
			}
			else{
				$msg="Make sure that the extension of your photo is jpg or jpeg or png or gif !";
			}
		}
		else{
			$msg="Your photo must not exceed the size of 2Mo !";
		}
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

						<?php if ($user_info['accessRights']!=0) { ?>
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

	<!--My account body-->
	
    <div class="container border border-secondary my-account">
		<h2 >Edit my profile</h2>
		<a href="myprofile.php"><button class="btn btn-primary pull-right">View Profile</button></a>
		<br><hr><br>
        <h4>Introduction</h4>
		<h6>Let the "SAS" community of other learners and instructors recognize you.</h6><br>
		<form method="POST" action="myaccount.php" enctype="multipart/form-data">
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="name">Full Name </label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="name" id="name"  class="form-control" placeholder="Full Name" value="<?php echo $_SESSION['username']; ?>"/>
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="name">Email Address</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="email" id="email"  class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>"/>
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="photo">Profile Photo</label>
				</div>
				<div class="col-md-auto">
					<img id="myImg" src="img/profile.jpg" alt="your image" width="150px">
					<input type="file" name="photo">
				</div>
				<br>
			</div>
			<center><?php if(isset($msg)) echo '<span style="color:red;">'.$msg.'</span>'?></center>
			<hr><br>
			<h4>Work Experience and Education</h4>
			<h6>Tell us about your experience and education to get a personalized learning experience with SAS recommendations.</h6>
			<br>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="student">Are you currently student?</label>
				</div>
				<div class="col-md-auto text-center">
					<input type="radio" name="student"  id="student" value="yes"  <?php if((isset($_POST["student"]))&&($_POST["student"]=="yes")) {echo "checked=\"checked\"";} if($_SESSION["student"]=="yes") {echo "checked=\"checked\"";}?>>YES
					<input type="radio" name="student"  id="student" value="no"  <?php if((isset($_POST["student"]))&&($_POST["student"]=="no")) {echo "checked=\"checked\"";} if($_SESSION["student"]=="no") {echo "checked=\"checked\"";}?>>NO
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="degree">Highest Degree</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="degree" class="form-control" id="degree" value="<?php echo $_SESSION['degree']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="university">University</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="university" class="form-control" id="university" value="<?php echo $_SESSION['university']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="field">Field or Major</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="field" class="form-control" id="field" value="<?php echo $_SESSION['field']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="employment_status">Employment Status </label>
				</div>
				<div class="col-md-auto">
					<select name="employment_status" id="employment_status" class="form-control">
						<option>Select your current status</option>
						<option <?php if((isset($_POST["employment_status"]))&&($_POST["employment_status"]=="Employed full time")) {echo "selected=\"selected\"";} if($_SESSION["employment_status"]=="Employed full time") {echo "selected=\"selected\"";}?>>Employed full time</option>
						<option <?php if((isset($_POST["employment_status"]))&&($_POST["employment_status"]=="Employed part time")) {echo "selected=\"selected\"";} if($_SESSION["employment_status"]=="Employed part time") {echo "selected=\"selected\"";}?>>Employed part time</option>
						<option <?php if((isset($_POST["employment_status"]))&&($_POST["employment_status"]=="Self-employed full time")) {echo "selected=\"selected\"";} if($_SESSION["employment_status"]=="Self-employed full time") {echo "selected=\"selected\"";}?>>Self-employed full time</option>
						<option <?php if((isset($_POST["employment_status"]))&&($_POST["employment_status"]=="Self-employed part time")) {echo "selected=\"selected\"";} if($_SESSION["employment_status"]=="Self-employed part time") {echo "selected=\"selected\"";}?>>Self-employed part time</option>
						<option <?php if((isset($_POST["employment_status"]))&&($_POST["employment_status"]=="Homemaker")) {echo "selected=\"selected\"";} if($_SESSION["employment_status"]=="Homemaker") {echo "selected=\"selected\"";}?>>Homemaker</option>
						<option <?php if((isset($_POST["employment_status"]))&&($_POST["employment_status"]=="Unemployed and looking for work")) {echo "selected=\"selected\"";} if($_SESSION["employment_status"]=="Unemployed and looking for work") {echo "selected=\"selected\"";}?>>Unemployed and looking for work</option>
						<option <?php if((isset($_POST["employment_status"]))&&($_POST["employment_status"]=="Unemployed and not looking for work")) {echo "selected=\"selected\"";} if($_SESSION["employment_status"]=="Unemployed and not looking for work") {echo "selected=\"selected\"";}?>>Unemployed and not looking for work</option>
					</select>
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="industry">Industry</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="industry" class="form-control" id="industry" placeholder="If employed,tell us what industry you work in" value="<?php echo $_SESSION['industry']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="employer">Employer</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="employer" id="employer" class="form-control" placeholder="If employed,tell us where you work" value="<?php echo $_SESSION['employer']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="occupation">Occupation</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="occupation" id="occupation" class="form-control" placeholder="If employed,tell us what your occupation is" value="<?php echo $_SESSION['occupation']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="experience_level">Experience Level</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="experience_level" id="experience_level" class="form-control" value="<?php echo $_SESSION['experience_level']; ?>">
				</div>
			</div>	
			<hr>
			<h4>Details About You</h4>
			<h6>Introduce yourself to the Coursera community. Connect with learners like you to grow your network.</h6>
			<br>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="birthday">Birthday</label>
				</div>
				<div class="col-md-auto">
					<input type="date" name="birthday" id="birthday" class="form-control"  min="1900-01-01" max="2007-12-31"  value="<?php echo $_SESSION['birthday']; ?>">
				</div>
			</div>	
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="gender">Gender</label>
				</div>
				<div class="col-md-auto">
					<input type="radio" name="gender" id="gender" value="female" <?php if((isset($_POST["gender"]))&&($_POST["gender"]=="female")) {echo "checked=\"checked\"";} if($_SESSION["gender"]=="female") {echo "checked=\"checked\"";}?>>Female
					<input type="radio" name="gender" id="gender" value="male" <?php if((isset($_POST["gender"]))&& ($_POST["gender"]=="male")) echo "checked=\"checked\""; if($_SESSION["gender"]=="male"){echo "checked=\"checked\"";}?>>Male
				</div>
			</div>	
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="phone">Phone Number</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="phone" id="phone" class="form-control"  value="<?php echo $_SESSION['phone_number']; ?>">
				</div>
			</div>	
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="about-me">About Me</label>
				</div>
				<div class="col-md-auto">
					<input type="textarea" name="about" id="about" class="form-control" placeholder="Tell us about yourself"  value="<?php echo $_SESSION['about_me']; ?>">
				</div>
			</div>	
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="location">Location</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="location" id="location" class="form-control" placeholder="Tell us the city or country you currently live in"  value="<?php echo $_SESSION['location']; ?>">
				</div>
			</div>	
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="skils">Top Skills</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="skills" id="skills" class="form-control" placeholder="Tell us about your top skills"  value="<?php echo $_SESSION['skills']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="linkedin">Linkedin Url</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="linkedin" id="linkdin" class="form-control" value="<?php echo $_SESSION['linkedin']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="facebook">Facebook Url</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo $_SESSION['facebook']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="github">Github Url</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="github" id="github" class="form-control" value="<?php echo $_SESSION['github']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="twitter">Twitter Url</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo $_SESSION['twitter']; ?>">
				</div>
			</div>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="Instagram">Instagram Url</label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo $_SESSION['instagram']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col col-lg-2"></div>
				<div class=" col-md-auto">
					<input type="submit"  style="width: 445px; height: 40px;" value="Save Changes">
				</div>
			</div>
		</form><br>
	</div>
    <!--End my account body-->
    
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
<script src="js/script1.js"></script>
<!-- jQuery -->
<script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
<!-- Bootstrap JS -->
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Popper JS -->
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<!-- End Script Source Files -->
</body>
</html>