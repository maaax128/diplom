<?php
require('app/connect.php');
require('app/users.php');
$users = new users();
$users->newConnect();
if (empty($_POST['name']) || empty($_POST['password'])) {
	header("Location:addAdmin.php");
	exit;
}

$var = array("name"=>$_POST['name'],
                "password"=>$_POST['password'],

);
$users->addNewAdmin($var);
header("Location:controlPanel.php");