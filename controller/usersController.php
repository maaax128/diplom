<?php

switch ($_GET['action']) {
    case 'changePassword':
        $id=(int)$_GET['id'];
        $title= "Смена пароля";
        include "../templates/head.php";
        include "../templates/users/changePassword.php";
        include "../templates/foot.php";
        break;

    case 'addAdmin':
        $title= "Регистрация нового администратора";
        include "../templates/head.php";
        include "../templates/users/addAdmin.php";
        include "../templates/foot.php";
        break;
}