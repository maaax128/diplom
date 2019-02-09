<?php
session_start();

if (empty($_POST['login']) || empty($_POST['password'])) {

	header("Location:formAuthorization.html");
	exit;
} else {
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['password'] = $_POST['password'];
	header("Location:authorization.php");
}
	
?>