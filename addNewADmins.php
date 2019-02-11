<?php

require('app/model.php');
$model = new Model();
$model->newConnect();
if (empty($_POST['name']) || empty($_POST['password'])) {
	header("Location:addAdmin.php");
	exit;
}

$var = array("name"=>$_POST['name'],
                "password"=>$_POST['password'],

);
$model->addNewAdmin($var);
header("Location:controlPanel.php");