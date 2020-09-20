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
    <link rel="stylesheet" href="css/styletableformateur1.css">
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
            $test=true;
            if(isset($_POST['submit'])&&(!empty($_POST['name']))&&(!empty($_POST['field']))
            &&(!empty($_POST['introduction']))&&(isset($_FILES['video']))&&(isset($_FILES['pdf']))&&
            ($_POST['field']!="Select your field")&&(isset($_POST['exam']))&&(!empty($_POST['description']))){
                $req3=$db->prepare("SELECT * FROM instructorCourse WHERE instructorId=?");
                $req3->execute(array($_SESSION['id']));
                while($courseName=$req3->fetch()){
                    if($courseName['courseName']==$_POST['name']){
                        $test=false;
                    }
                }
                //upload pdf
                $taillemax = 17179869184; //2 Go
                $extensionsValides = array('pdf','docx');
                if($_FILES['pdf']['size'] <= $taillemax){
                    $extensionsUpload = strtolower(substr(strrchr($_FILES['pdf']['name'],'.'),1));//prendre juste l'exxtension
                    if(in_array($extensionsUpload,$extensionsValides)){
                        $chemin="instructor/courses/pdf/".$_SESSION['id'].$_POST['name'].".".$extensionsUpload;
                        $result=move_uploaded_file($_FILES['pdf']['tmp_name'],$chemin);
                    }
                    else{
                        echo"<script>alert('Make sure that the extension of your file is pdf or docx !')</script>";
                    }
                }
                else{
                    echo"<script>alert('Your PDF must not exceed the size of 2Go !')</script>";
                }
                //upload video
                $taillemax1 = 111669149696; //13 Go
                $extensionsValides1 = array('mp4','mkv','mvi');
                if($_FILES['video']['size'] <= $taillemax1){
                    $extensionsUpload1 = strtolower(substr(strrchr($_FILES['video']['name'],'.'),1));//prendre juste l'exxtension
                    if(in_array($extensionsUpload1,$extensionsValides1)){
                        $chemin1="instructor/courses/video/".$_SESSION['id'].$_POST['name'].".".$extensionsUpload1;
                        $result1=move_uploaded_file($_FILES['video']['tmp_name'],$chemin1);
                    }
                    else{
                        echo"<script>alert('Make sure that the extension of your video is mp4 or mkv or mvi !')</script>";
                    }
                }
                else{
                    echo"<script>alert('Your video must not exceed the size of 13Go !')</script>";
                }
                if($result && $result1 && ($test==true)){
                    $req1=$db->prepare("INSERT INTO instructorCourse(instructorId,courseName,courseField,description,Introduction,video,pdf,exam) VALUES(:instructorId, :courseName, :courseField, :description, :Introduction, :video, :pdf, :exam)");
                    $req1->execute(array(
                        'instructorId'=>$_SESSION['id'],
                        'courseName'=>$_POST['name'],
                        'courseField'=>$_POST['field'],
                        'description'=>$_POST['description'],
                        'Introduction'=>$_POST['introduction'],
                        'video'=>$_SESSION['id'].$_POST['name'].".".$extensionsUpload1,
                        'pdf'=>$_SESSION['id'].$_POST['name'].".".$extensionsUpload,
                        'exam'=>$_POST['exam'],
                    ));
                    echo " <script> alert('Your request has been successfully sent!')</script>";
                }
                else{
                    if ($test==false){
                        echo"<script>alert('The name of the course already exists in your list!')</script>";
                    }
                    else echo"<script>alert('Error during the importation of your video or pdf file !')</script>";
                }
             }
            else{
                echo " <script> alert('Please  fill in all the required fields ! ')</script>";
            }
        }
        //course instructor informations
        $instructorCourses=$db->prepare("SELECT * FROM instructorCourse WHERE instructorId=?");
        $instructorCourses->execute(array($_SESSION['id']));
    ?>
    <!-- Navigation -->
    <nav class="navbar bg-light navbar-light navbar-expand-lg sticky-top">
        <div class="container">
            <a href="index.1.php" class="navbar-brand">
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
    <div class="jumbotron">
        <div class="container">
        <CENTER>
            <h3 style="color:rgb(77, 3, 70);">Welcome to the instructor space dear</h3>
            <h1 style="color:rgb(77, 3, 70);"><?php echo $_SESSION['username'];?></h1>
        </CENTER>
        </div>
    </div>
    <div class="container border border-secondary" style="padding-top:2rem;padding-bottom:3rem;">
		<h3 style="color:rgb(77, 3, 70);">Upload your course</h3>
        <hr>
		<form method="POST" action="formateur1.php" enctype="multipart/form-data">
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="name">Course Name<span style="color:red">*</span></label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="name" id="name"  class="form-control" placeholder="Enter the name of your course" required/>
				</div>
			</div>
            <div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="field">Field<span style="color:red">*</span></label>
				</div>
				<div class="col-md-auto">
					<select name="field" id="field" class="form-control" required>
						<option>Select your field</option>
						<option>Computer Science</option>
						<option>Business</option>
						<option>Art Humanity</option>
						<option>Health</option>
					</select>
				</div>
            </div>
            <div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="description">Description<span style="color:red">*</span></label>
				</div>
				<div class="col-md-auto">
					<input type="textarea" name="description" id="description"  class="form-control" placeholder="Enter the name of your course" required/>
				</div>
			</div>
            <hr>
			<div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="introduction">Introduction<span style="color:red">*</span></label>
				</div>
				<div class="col-md-auto">
					<input type="textarea" name="introduction" id="introduction" class="form-control" placeholder="Type your introduction for the course here" required/>
				</div>
			</div>
            <br>
            <div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="video">Video<span style="color:red">*</span></label>
				</div>
				<div class="col-md-auto">
					<input type="file" name="video" id="video" class="form-control" required/>
				</div>
			</div>
            <br>
            <div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="pdf">PDF<span style="color:red">*</span></label>
				</div>
				<div class="col-md-auto">
					<input type="file" name="pdf" id="pdf" class="form-control" required/>
				</div>
			</div>
            <br>
            <div class="form-group row text-center">
				<div class="col col-lg-2">
					<label for="exam">Quiz<span style="color:red">*</span></label>
				</div>
				<div class="col-md-auto">
					<input type="text" name="exam" id="exam" class="form-control" required/>
				</div>
			</div>
            <br>
            <div class="row">
				<div class="col col-lg-2"></div>
				<div class=" col-md-auto">
					<input type="submit" name="submit" id="submit" style="width: 445px; height: 40px;" value="Send you course details to the administration">
				</div>
			</div>
		</form>
    </div>
    <br>
    <div class="container border border-secondary" style="padding-top:2rem;padding-bottom:3rem;">
        <h3 style="color:rgb(77, 3, 70);"><u>The list of your courses :</u></h3>
        <br>
        <table>
            <tr>
                <th width="30%">
                    <center>Field</center>
                </th>
                <th width="30%">
                    <center>Course Name</center>
                </th>
                <th width="40%">
                    <center>Application status</center>
                </th>
            </tr>
            <?php while($course=$instructorCourses->fetch()){ ?>
                <tr>
                    <td><?php echo $course['courseField'];?></td>
                    <td><?php echo $course['courseName'];?></td>
                    <td>
                        <?php if($course['accept']==0) 
                            echo '<p style="color:blue;">Still in the review process...</p>';
                            elseif($course['accept']==1) 
                            echo '<p style="color:red;">Course rejected</p>';
                            elseif($course['accept']==2) 
                            echo '<p style="color:green;">Congrats! your course has been uploaded in our site</p>';
                        ?>
                    </td>
                </tr>
            <?php } ?> 
        </table>
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