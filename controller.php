<?php
if (empty($_POST)) {
	//header("Location:addAdmin.php");
	die();
}
    require('app/model.php');
    $model = new Model();
    $model->newConnect();

    switch ($_POST['method']) {
        case 'deleteAdmin':
            $model->DeleteAdmins($_POST['adminId']);
            header("Location:controlPanel.php");
            break;

        case 'changePassword':
            $model->changePassword($_POST);
           header("Location:controlPanel.php");
            break;

        case 'addCategory':
            $model->addCategory($_POST['categoryName']);
            header("Location:controlPanel.php");
            break;

        case 'deleteCategory':
            $model->deleteCategory($_POST['categoryId']);
            header("Location:controlPanel.php");
            break;

        case 'deleteQuestion':
            $model->deleteQuestion($_POST['questionId']);
            header("Location:controlPanel.php");
            break;

        case 'hideQuestion':
            $model->hideQuestion($_POST['questionId'], $_POST['status']);
            header("Location:controlPanel.php");
            break;

        case 'editQuestion':
            $model->editQuestion($_POST);
            header("Location:controlPanel.php");
            break;

        case 'addAnswer':
            $model->addAnswer($_POST);
            header("Location:controlPanel.php");
            break;
    }
