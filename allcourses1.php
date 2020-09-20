
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
    <link rel="stylesheet" href="css/color/color1.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/color1.css">
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
                            <li class="nav-item"><a href="allcourses1.php" class="nav-link active">All Courses</a></li>
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
            <div class="jumbotron">
                <div class="container">
                    <center>
                        <h2>Education is the most powerful weapon which you can use to change the world.</h2>
                    </center>
                    <ol class="col-12 breadcrumb">
                        <li class="breadcrumb-item"><a href="./index1.php">Home</a></li>
                        <li class="breadcrumb-item active">All Courses</li>
                        <li class="breadcrumb-item"><a href="./newcourses.php">New Courses</a></li>
                    </ol>
                </div>
            </div>
            <!--/ End Breadcrumbs -->
            </br>
            </br>
        
            <!-- Blogs -->
            
            <div class="container">
                <!--row  computer science -->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 class="text-center" >Computer<span>Science</span></h2>
                        </div>
                    </div>
                </div>
                </br></br>
                <div class="row justify-content-center" >
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem; height: 23rem;">
                            <img class="card-img-top" src="img/html.jpg" alt="HTML">
                            <div class="card-body text-center">
                                <h5 class="card-title">HTML</h5>
                                <p class="card-text">Do you realize that the only functionality of a web application that the user directly interacts with is through the web</p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#html">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem; height: 23rem;">
                            <img class="card-img-top" src="img/css.jpg" alt="CSS">
                            <div class="card-body text-center">
                                <h5 class="card-title">CSS</h5>
                                <p class="card-text">The web today is almost unrecognizable from the early days of white pages with </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#css">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/js.webp" alt="JS">
                            <div class="card-body text-center">
                                <h5 class="card-title">JS</h5>
                                <p class="card-text">In this course, we'll look at the JavaScript language, and how it supports the Object-Oriented</p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#js">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/php.jpg" alt="PHP">
                            <div class="card-body text-center">
                                <h5 class="card-title">PHP</h5>
                                <p class="card-text">In this course, you'll explore the basic structure of a web application,, and how a web browser</p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#php">Start Now</a> 
                            </div>
                        </div>
                    </div>
                </div>
                </br></br>
                <!--business field-->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 class="text-center">Busi<span>ness</span></h2>
                        </div>
                    </div>
                </div>
                </br></br>
                <div class="row justify-content-center" >
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem; height: 23rem;">
                            <img class="card-img-top" src="img/management.jpg" alt="management">
                            <div class="card-body text-center">
                                <h5 class="card-title">MANAGEMENT</h5>
                                <p class="card-text">In this specialization, you will learn essential leadership skills, including how</p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#management">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/marketing.jpg" alt="MARKETING">
                            <div class="card-body text-center">
                                <h5 class="card-title">MARKETING</h5>
                                <p class="card-text">This Specialization explores several aspects of the new digital marketing </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#marketing">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/finance.jpg" alt="FINANCE">
                            <div class="card-body text-center">
                                <h5 class="card-title">FINANCE</h5>
                                <p class="card-text">The role of an Analyst is dynamic, complex, and driven by a variety of skills.</p>
                                </br>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#finance">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/entrepreneuriat.jpg" alt="ENTREPRENEURIAT">
                            <div class="card-body text-center">
                                <h5 class="card-title">Entrepreneurship</h5>
                                <p class="card-text">Entrepreneurship courses are suitable for anyone interested in building</p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#entrepreneuriat">Start Now</a> 
                            </div>
                        </div>
                    </div>
                </div>
                </br></br>
                <!--art humanity-->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 class="text-center">Art<span>Humanity</span></h2>
                        </div>
                    </div>
                </div>
                </br></br>
                <div class="row justify-content-center" >
                    <div class="col-md-3">
                        <div class="card" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/history.jpg" alt="HISTORY">
                            <div class="card-body text-center">
                                <h5 class="card-title">HISTORY</h5>
                                <p class="card-text">History courses examine ancient and modern social events and trends.</p></br>  </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#history">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/music.jpg" alt="MUSIC">
                            <div class="card-body text-center">
                                <h5 class="card-title">MUSIC</h5>
                                <p class="card-text">Music courses develop skills in the practice and criticism of visual art, music and </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#music">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/art.jpg" alt="ART">
                            <div class="card-body text-center">
                                <h5 class="card-title">ART</h5>
                                <p class="card-text">Arts courses develop skills in the practice and criticism of visual art, creative writing.</p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#art">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/philosophy.png" alt="PHILOSOPHY">
                            <div class="card-body text-center">
                                <h5 class="card-title">PHILOSOPHY</h5>
                                <p class="card-text">Philosophy courses deal with the major questions that make us human </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#philosophy">Start Now</a> 
                            </div>
                        </div>
                    </div>
                </div>
                </br></br>
                <!--sante-->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 class="text-center">Hea<span>lth</span></h2>
                        </div>
                    </div>
                </div>
                </br></br>
                <div class="row justify-content-center" >
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/psychologie.jpg" alt="psy">
                            <div class="card-body text-center">
                                <h5 class="card-title">PSYCHOLOGIE</h5>
                                <p class="card-text">Psychology courses study the human mind and its influence on our actions.  </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#psychologie">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/fitness.jpg" alt="fitness">
                            <div class="card-body text-center">
                                <h5 class="card-title">FITNESS</h5>
                                <p class="card-text">Regular exercise and physical activity promotes strong muscles and bones. </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#fitness">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/nutrition.jpg" alt="nutrition">
                            <div class="card-body text-center">
                                <h5 class="card-title">NUTRITION</h5>
                                <p class="card-text">Nutrition courses cover concepts at the crossroads of food and health</p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#nutrition">Start Now</a> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow" style="width: 12rem;height: 23rem;">
                            <img class="card-img-top" src="img/saifty.jpeg" alt="PHILOSOPHY">
                            <div class="card-body text-center">
                                <h5 class="card-title">Safety And First Aid</h5>
                                <p class="card-text">First aid helps ensure that the right methods of administering . </p>
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#saifty">Start Now</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </br></br>

        <!--modal html -->
        <div class="modal fade" id="html">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#788aee">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To HTML</h2>
                        <p>Do you realize that the only functionality of a web application that the user directly interacts with is through the web page? Implement it poorly and, to the user, the server-side becomes irrelevant! Today’s user expects a lot out of the web page: it has to load fast, expose the desired service, and be comfortable to view on all devices: from a desktop computers to tablets and mobile phones.
                        In this course, we will learn the basic tools that every web page coder needs to know. We will start from the ground up by learning how to implement modern web pages with HTML</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/html.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal html -->
        <!--modal css -->
        <div class="modal fade" id="css">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To CSS</h2>
                        <p>The web today is almost unrecognizable from the early days of white pages with lists of blue links.  Now, sites are designed with complex layouts, unique fonts, and customized color schemes.   This course will show you the basics of Cascading Style Sheets (CSS3).  The emphasis will be on learning how to write CSS rules, how to test code, and how to establish good programming habits.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/css.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>	
        <!-- end modal css -->
        <!--modal Js -->
        <div class="modal fade" id="js">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To JS</h2>
                        <p>In this course, we'll look at the JavaScript language, and how it supports the Object-Oriented pattern, with a focus on the unique aspect of how JavaScript approaches OO. We'll explore a brief introduction to the jQuery library, which is widely used to do in-browser manipulation of the Document Object Model (DOM) and event handling. You'll also learn more about JavaScript Object Notation (JSON), which is commonly used as a syntax to exchange data between code running on the server (i.e. in PHP) and code running in the browser (JavaScript/jQuery).</p>
                        </br>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/js.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal JS -->
        <!--modal php -->
        <div class="modal fade" id="php">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To PHP</h2>
                        <p>In this course, you'll explore the basic structure of a web application, and how a web browser interacts with a web server. You'll be introduced to the request/response cycle, including GET/POST/Redirect. You'll also gain an introductory understanding of Hypertext Markup Language (HTML), as well as the basic syntax and data structures of the PHP language, variables, logic, iteration, arrays, error handling, and superglobal variables, among other elements. An introduction to Cascading Style Sheets (CSS) will allow you to style markup for webpages. Lastly, you'll gain the skills and knowledge to install and use an integrated PHP/MySQL environment like XAMPP or MAMP.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/php.php"> <input class="btn btn-info"  data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal php -->
        <!--modal finance -->
        <div class="modal fade" id="finance">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To FINANCE</h2>
                        <p>The role of an Analyst is dynamic, complex, and driven by a variety of skills. These skills range from a basic understanding of financial statement data and non-financial metrics that can be linked to financial performance, to a deeper dive into business and financial modeling. Analysts also utilize spreadsheet models, modeling techniques, and common investment analysis application as part of their toolkit to make informed financial decisions and investments.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/finance.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal finance -->
        <!--modal management -->
        <div class="modal fade" id="management">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To MANAGEMENT</h2>
                        <p>In this specialization, you will learn essential leadership skills, including how to inspire and motivate individuals, manage talent, influence without authority, and lead teams. In this specialization, you will not only learn from Michigan faculty. You will also learn directly from exceptional leaders including Jeff Brodsky, Global Head of HR for Morgan Stanley, and John Beilein, Head Coach of the University of Michigan Men’s Basketball Team. We will share with you our research on how to lead people and teams effectively, and work with you to apply these insights to your own teams and leadership.   </p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/management.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal management -->
        <!--modal marketing -->
        <div class="modal fade" id="marketing">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To MARKETING</h2>
                        <p>This Specialization explores several aspects of the new digital marketing environment, including topics such as digital marketing analytics, search engine optimization, social media marketing, and 3D Printing. When you complete the Digital Marketing Specialization you will have a richer understanding of the foundations of the new digital marketing landscape and acquire a new set of stories, concepts, and tools to help you digitally create, distribute, promote and price products and services.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/marketing.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal marketing -->
        <!--modal entrepreneuriat -->
        <div class="modal fade" id="entrepreneuriat">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To ENTREPRENEURIAT</h2>
                        <p>Entrepreneurship courses are suitable for anyone interested in building and growing a successful business. Learn the theory and practice of entrepreneurship, the frameworks of social entrepreneurship, and how to foster a culture of innovation to make it easier for your business to stay ahead.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/entrepreneurship.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal entrepreneuriat -->
        <!--modal psychologie-->
        <div class="modal fade" id="psychologie">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To PSYCHOLOGIE</h2>
                        <p>Psychology courses study the human mind and its influence on our actions. Subthemes include forensic psychology,
                            child psychology, behavioral psychology and research in psychology.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/psychology.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal psychologie -->
        <!--modal fitness-->
        <div class="modal fade" id="fitness">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To FITNESS</h2>
                        <p>Fitness strength training is important for a healthy and pain-free life. ... Strength training helps to develop stronger bones and reduce osteoporosis.  It helps control your weight by burning more calories, and It boosts your stamina so you do not become so fatigued.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/fitness.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal fitness-->
        <!--modal philo -->
        <div class="modal fade" id="saifty">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To Safety And First Aid</h2>
                        <p>Knowledge of first aid promotes the sense of safety and well being amongst people, prompting them to be more alert and safe in the surroundings they dwell in. Awareness and desire to be accident free keeps you more safe and secure, reducing the number of causalities and accidents.</p>
                        </br>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/safety.php"> <input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal philo -->
        <!--modal nutrition-->
        <div class="modal fade" id="nutrition">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To Nutrition</h2>
                        <p>Nutrition courses cover concepts at the crossroads of food and health, including child nutrition, nutrition
                            for health and fitness; and the nature and influence of cultural food traditions.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/nutrition.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal nutrition -->
        <!--modal history -->
        <div class="modal fade" id="history">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To HISTORY</h2>
                        <p>History courses examine ancient and modern social events and trends. Explore themes such as war, imperialism, and globalization, and study the history of specific groups or time periods with lessons in black history, women's history, and more.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/history.php"><input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal history -->
        <!--modal art -->
        <div class="modal fade" id="art">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To ART</h2>
                        <p>Arts courses develop skills in the practice and criticism of visual art, creative writing. Learn to play the guitar, debate the merits of contemporary graphic novels, or explore the history of human creativity.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/art.php"> <input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal art -->
        <!--modal philo -->
        <div class="modal fade" id="philosophy">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To PHILOSOPHY</h2>
                        <p>Philosophy courses deal with the major questions that make us human (morality, ethics, objective and rationality) in their modern and historical context. Explore the Eastern and Western traditions of this field, including specific schools of philosophy such as existentialism and humanism.</p>
                        </br>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/philosophy.php"> <input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal philo -->
        <!--modal music-->
        <div class="modal fade" id="music">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="color:#73aff5">Start Now</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-secondary">Welcome To Music</h2>
                        <p>Music courses develop skills in the practice and criticism of visual art, music and creative writing. Learn to play the guitar, debate the merits of contemporary graphic novels, or explore the history of human creativity.</p>
                    </div>
                    <div class="modal-footer" id="modal_footer">
                        <a href="allcourses/music.php"> <input class="btn btn-info" data-toggle="modal" value="Go"></a>
                        <input class="btn btn-light" value="Close" data-dismiss="modal">
                    </div>
                </div>
            </div>	
        </div>
        <!-- end modal music -->

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