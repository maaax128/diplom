<?php
if (empty($_POST)) {
	die();
}
    require('../model/Connect.php');
    require('../model/Questions.php');
    require('../model/Users.php');
    require('../model/Answers.php');

    $model = new questions();
    $model->newConnect();

    $users = new users();
    $users->newConnect();

    $answers = new answers();
    $answers->newConnect();

    switch ($_POST['method']) {
        case 'deleteAdmin':
            deleteAdmin();
            break;

        case 'addNewADmins':
            addNewADmins();
            break;

        case 'changePassword':
            changePassword();
            break;

        case 'addCategory':
            addCategory();
            break;

        case 'deleteCategory':
            deleteCategory();
            break;

        case 'deleteQuestion':
            deleteQuestion();
            break;

        case 'hideQuestion':
            hideQuestion();
            break;

        case 'editQuestion':
            editQuestion();
            break;

        case 'addAnswer':
            addAnswer();
            break;
    }

function deleteAdmin () {
    $users = new users();
    $users->newConnect();
    $users->DeleteAdmins($_POST['adminId']);
    header("Location:../controlPanel.php");
}

function addNewADmins() {
    $users = new users();
    $users->newConnect();
    $var = array("name"=>$_POST['name'],
        "password"=>$_POST['password'],

    );
    $users->addNewAdmin($var);
    header("Location:../controlPanel.php");

}

function changePassword() {
    $users = new users();
    $users->newConnect();
    $users->changePassword($_POST);
    header("Location:../controlPanel.php");
}

function addCategory() {
    $model = new questions();
    $model->newConnect();
    $model->addCategory($_POST['categoryName']);
    header("Location:../controlPanel.php");
}

function deleteCategory() {
    $model = new questions();
    $model->newConnect();
    $model->deleteCategory($_POST['categoryId']);
    header("Location:../controlPanel.php");
}

function deleteQuestion() {
    $model = new questions();
    $model->newConnect();
    $model->deleteQuestion($_POST['questionId']);
    header("Location:../controlPanel.php");

}

function hideQuestion() {
    $model = new questions();
    $model->newConnect();
    $model->hideQuestion($_POST['questionId'], $_POST['status']);
    header("Location:../controlPanel.php");
}

function editQuestion() {
    $model = new questions();
    $model->newConnect();
    $model->editQuestion($_POST);
    header("Location:../controlPanel.php");
}

function addAnswer() {
    $answers = new answers();
    $answers->newConnect();
    $answers->addAnswer($_POST);
    header("Location:../controlPanel.php");
}