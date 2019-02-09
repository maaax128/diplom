<?php
if (empty($_POST['name']) || empty($_POST['password'])) {
	header("Location:addAdmin.php");
	exit;
} 
	require('connect.php');
	$login = $_POST['name'];
    $password = $_POST['password'];
	$sth = $pdo->prepare("SELECT id from admins WHERE login='$login'");
    $sth->execute();
    $sth = $sth->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($sth);
 
    if (!empty($sth)) {
    	echo "Такой логин уже существует";
    	require("addAdmin.php");
    	exit;
    }
	$sth = $pdo->prepare("INSERT INTO admins (login, password) VALUES ('$login', '$password')");
    $sth->execute();

	header("Location:controlPanel.php");
?>