<?php
if (empty($_POST)) {
	die();
}
    require('model/Connect.php');
    require('model/Questions.php');
    require('model/Users.php');
    require('model/Answers.php');

    $model = new questions();
    $model->newConnect();

    $users = new users();
    $users->newConnect();

    $answers = new answers();
    $answers->newConnect();

    switch ($_POST['method']) {
        case 'deleteAdmin':
            $users->DeleteAdmins($_POST['adminId']);
            header("Location:controlPanel.php");
            break;

        case 'changePassword':
            $users->changePassword($_POST);
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
            $answers->addAnswer($_POST);
            header("Location:controlPanel.php");
            break;
    }

