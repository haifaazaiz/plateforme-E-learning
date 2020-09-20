<?php
session_start();
setcookie('email','',time()-3600);
setcookie('password','',time()-3600);
if (isset($_SESSION['id'] ))
	
{
	session_destroy();
	header("Location:index.html");
}
?>