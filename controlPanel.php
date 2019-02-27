<?php
//session_start();

include('app/model.php');

$model = new Model();
$model->newConnect();
$categoryes = $model->getCategoryes();
$resultAdmins = $model->getAdmins();

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