<?php
//session_start();
require('app/connect.php');
include('app/questions.php');
include('app/users.php');

$model = new questions();
$model->newConnect();
$categoryes = $model->getCategoryes();


$users = new users();
$users->newConnect();
$resultAdmins = $users->getAdmins();

$title = "Панель администратора";
include "templates/head.php"
?>

<section class="cd-faq">
    <div class="cd-faq-items">
        <?php
            include "templates/users_table.php";
        ?>
    </div>
    <div class="cd-faq-items" style="margin-top: 30px;">
        <?php
            include "templates/themes_table.php";
        ?>
    </div>
</section>

<section class="cd-faq">
    <?php
        include "templates/answers_table.php";
    ?>
</section>


<?php
include "templates/foot.php";
?>