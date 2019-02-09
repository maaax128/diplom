<?php
session_start();
require('connect.php');
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	$sth = $pdo->prepare("SELECT * from admins WHERE login='$login' AND password='$password'");
	$sth->execute();
	$sth = $sth->fetchAll(PDO::FETCH_ASSOC);
	if (!empty($sth)) {
		foreach ($sth as $value) {
			$_SESSION['user_id']=$value['id'];
			$_SESSION['login']=$value['login'];
			$_SESSION['password']=$value['password'];
		
		}
		header("Location:controlPanel.php");
		//echo "Вы авторизованы";
		// exit();
	} else {
		echo "Нет пользователя с такими параметрами";		
	}

?>