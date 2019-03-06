<?php
require('model/Connect.php');
require('model/Users.php');
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