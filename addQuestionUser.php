<?php

require('app/model.php');

if (!empty($_POST ['selected'])) {
	$model = new Model();
	$model->newConnect();
	$categoryes = $model->getCategoryes();

	$quest = $_POST['userQuest'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$answered = 0;
	foreach ($categoryes as $result => $value) {	
		if ($value['category'] === $_POST ['selected']) {
			$group = $value['id'];	
		}	
	}

	$params = array("question"=>$_POST['userQuest'],
					"group"=>$group, 
					"answered"=>$answered,
					"name"=> $_POST['name'],
					"email"=>$_POST['email'] 
				);

	$model->addUserQuestion($params);

//ob_start();
header("Location:index.php");
//ob_end_flush();
}
