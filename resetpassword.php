<!DOCTYPE html>
<html>
<head>
	<title>reset_password</title>
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

<div class="wrapper-main border border-secondary"
 id="section">
	<section class="section">
		<h1>Reset your password</h1>
		<p>An e-mail will be send to you with instructions on how to reset your password .</p>
	<form action="resetrequest.php" method="post">
		<input type="email"  id ="mail"name="email" placeholder="Enter your e-mail adress ...">
		<input type="submit" id="submit" name="reset-request-submit" value="receive new password by e-mail">
		
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