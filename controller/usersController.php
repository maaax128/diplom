<?php

require('../model/Connect.php');
require('../model/Users.php');
$model = new Users();
$model->newConnect();

if(isset($_POST['action']) && $_POST['action'] == 'actionAuthorization') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            header("Location:../../index.php");
            exit;
        } else {
            $arr = [
                "login" => $_POST['login'],
                "password" => $_POST['password']
            ];
            //если не найден админ с таким логином и паролем
            if ($model->autorization($arr) == "no_admin") {
                include "../templates/head.php";
                echo "Нет пользователя с такими параметрами<br>";
                echo "<a href='../index.php'>На главную </a>";
            }
        }
}
if (isset($_GET['action'])) {
    switch ($_GET['action']) {

        case 'changePassword':
            changePassword();
            break;

        case 'addAdmin':
            addAdmin();
            break;

        case 'deleteAdmin':
            deleteAdmin();
            break;

        case 'formAuthorization':
            formAuthorization();
            break;
    }
}

function changePassword() {
        $model = new Users();
        $model->newConnect();
        $id = (int)$_GET['id'];
        $title = "Смена пароля";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/changePassword.php";
}

function addAdmin() {
        $model = new Users();
        $model->newConnect();
        $title = "Регистрация нового администратора";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/addAdmin.php";
}

function deleteAdmin() {
        $model = new Users();
        $model->newConnect();
        $title = "Регистрация нового администратора";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/addAdmin.php";
}

function formAuthorization() {
        $model = new Users();
        $model->newConnect();
        $title = "Форма авторизации";
        //подключаем хедер
        include "../templates/head.php";
        // подключаем шаблон
        include "../templates/users/formAuthorization.php";
}

// подключение футера
include "../templates/foot.php";