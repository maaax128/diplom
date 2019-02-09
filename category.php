<?php
if (empty($_POST)) {
	//header("Location:addAdmin.php");
	die();
}
    require('app/model.php');
    $model = new Model();
    $model->newConnect();

    switch ($_POST['method']) {
        case 'addCategory':
            $model->addCategory($_POST['categoryName']);
            header("Location:controlPanel.php");
            break;

        case 'deleteCategory':
            $model->deleteCategory($_POST['categoryId']);
            header("Location:controlPanel.php");
            break;
    }

