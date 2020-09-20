<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-Compatible" content="ie=edge">
	<title>Settings</title>
	<link rel="shortcut icon" href="img/logo.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="css/animate.css-main/source/animate.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/stylesettings.css">
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
</div>
    
<div class="jumbotron">
    <ol class="col-12 breadcrumb ">
				<li class="breadcrumb-item"><a href="./index1.php">Home</a></li>
				<li class="breadcrumb-item "><a href="./myaccount.php">My profile</a></li>
				<li class="breadcrumb-item active">Settings</li>
			</ol>
		</div>

  <!--start form --->

    <div class="container border border-secondary account" id="account">
       <h3>Account</h3><br>

    	<form action="settings.php" method="post">

    		<table  align="center" width="90%">

    			<tr>
    			  <th>Full name</th>
    			  <th>Email adress</th>
    		    </tr>
    		    <tr>
    		    	<td><input type="text"  id="full" name="fullname" value="<?php echo $user['username'];?>"></td>
    		    	<td><input type="email" id="full" name="mail" value="<?php echo $user['email'] ?>" required oninvalid="this.setCustomValidity('Please check your personal email')"></td>
    		    </tr>
    		    <tr>
    		    	<td><input type="submit" id="submit" name="save" value="Save"></td>
    		    </tr>
    		    <tr>	
					<div class="notice">
						<?php
						if (isset($_POST['save']) && !empty($_POST['save'])) {
		

						$requete= $db->prepare('UPDATE members SET email=:email WHERE id=:id AND username=:username');
						$requete-> execute(array(
							'email'=>$_POST['mail'],
							'id'=>$user['id'],
							'username'=>$user['username']
						));
							echo "the email update was successful";
						}
						?>
                    </div>
               </tr> 
    		</table>
    		<br>
    		<hr>
    		<br>
    	</form>
    <form action="settings.php" method="post">	
    	<div class="personal_account" >
    		<b>Personal Account</b>
    		<p>Add your personal account here , so you'll still have access to SAS courses after you leave your current company. </p>

    		<b>Add Alternative Email</b><br><br>
    		
    		<input type="email" name="personalemail" id="full1" placeholder="Enter Personal Email" required oninvalid="this.setCustomValidity('Please check your personal email')"><br><br>
    		<input type="submit" id="submit1" name="alternativeEmail" value="Save"><br><br>
           <div class="notice">
            <?php
                 
                 if (isset($_POST['alternativeEmail']) && !empty($_POST['personalemail']))
                  {
                 	 $requete= $db->prepare('UPDATE members SET personalmail=:personalmail WHERE id=:id AND username=:username');
                     $requete-> execute(array('personalmail'=>$_POST['personalemail'],'id'=>$user['id'],'username'=>$user['username']));
                     echo "the addition of your personal email was successful";

                  }
            
            ?>
           </div>
    		<hr>
    		<br>
    	</div>
          </form>
    	<div class="personal_account" >
    		<b>Name Verification </b>
    		<p>Verify your real  name to make sure you're able to receive a certificate when you complete a course or specialization.</p>
    		<a href="user-verification.php"><button id="submit">Verify your name </button></a><br><hr><br>
    		<b>Delete Account </b><br>
    		<p>If you delete your account, your personal information will be wiped from ""'s servers, all of your course activity will be anonymized and any certificates earned will be deleted. This action cannot be undone! Cancel any active subscriptions before you delete your account </p>
    	 


    		<form action="settings.php" method="post">
    		
    		   

               <!-- Button trigger modal -->
<button type="button" id="submit" data-toggle="modal" data-target="#exampleModal">
 Delete 
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Account </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       do you confirm to delete your account ?
      </div>
      <div class="modal-footer">
        <button type="button" id="submit" data-dismiss="modal">Close</button>
        <input type="submit" id="submit" name="deleteaccount" value="Delete">
      </div>
    </div>
  </div>
</div>


    		   <div class="notice">
               <?php 

                if (isset($_POST['deleteaccount'])) 
                {    
                	$requete=$db->prepare('DELETE FROM members WHERE id=:id');
                	$requete->execute(array('id'=>$user['id']));
                	
                	
                }
               ?>

    	   </div>
    	   <hr><br>

            <b>Notice:</b><p>To change email, please adjust the email settings at the top of this page</p>
    		</div>
    	</form>

    </div>


    <!---End form----> 

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