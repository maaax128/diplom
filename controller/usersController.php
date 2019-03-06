<?php

switch ($_GET['action']) {
    case 'changePassword':
        $id=(int)$_GET['id'];
        $title= "Смена пароля";
        $template =  "../templates/users/changePassword.php";
        break;

    case 'addAdmin':
        $title= "Регистрация нового администратора";
        $template = "../templates/users/addAdmin.php";
        break;

    case 'deleteAdmin':
        $title= "Регистрация нового администратора";
        $template = "../templates/users/addAdmin.php";
        break;

    case 'formAuthorization':
        $title= "Форма авторизации";
        $template = "../templates/users/formAuthorization.php";
        break;
}

include "../templates/head.php";
include $template;
include "../templates/foot.php";