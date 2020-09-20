<!DOCTYPE html>
<html>
<head>
	<title>New Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-Compatible" content="ie=edge">
	
	<link rel="shortcut icon" href="img/mylogo.ico">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="css/animate.css-main/source/animate.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/stylepasswordreset.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
</head>
<body>


	<div class="wrapper-main">
	<section class="section-default">
		<?php 
              $selector= $_GET["selector"];
              $validator=$_GET["validator"];

              if(empty($selector)|| empty($validator))
              {

              	echo "could not validate your request !";

              }
             else
              {
              	if ((ctype_xdigit($selector) !== false )&& (ctype_xdigit($validator) !== false) ) {
           ?>
               <div class="border border-secondary" id="section">
                 <form  action="resetpassword1.php" method="post">
                 	<input type="hidden" name="selector" value="<?php echo $selector?>">
                 	<input type="hidden" name="validator" value="<?php echo $validator?>">
                 	<input type="password" id="pwd" name="pwd" placeholder="Enter your new password">
                 	<input type="password"id="pwd-repeat" name="pwd-repeat" placeholder="repeat your new password">
                 	<button type="submit" id = "submit" name="reset-password-submit" >Reset password</button>
                </div>


                 	
                 </form>
           <?php
              	}
             }


		 ?>
		
	</form>	
	</section>
	
</div>
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