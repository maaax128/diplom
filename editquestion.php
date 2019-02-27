<?php
require('app/connect.php');
require('app/questions.php');

$model = new questions();
$model->newConnect();

if(isset($_GET['type'] ) && $_GET['type'] == 'notanswered'){
    $question = $model->getOneQuestion((int)$_GET['id']);
} else {
    $question = $model->getQuestionById((int)$_GET['id']);
}

$categoryes = $model->getCategoryes();

//        echo '<pre>';
//        var_dump($question);
//        echo '</pre>';

$title= "Редактирование вопроса";
include "templates/head.php";

?>
<section class="cd-faq">
    <?php
        include "templates/edit_question_form.php";
    ?>
</section>

<?php
include "templates/foot.php";
?>