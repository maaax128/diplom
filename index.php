<?php
//require('connect.php');
require('app/model.php');

//require('app/model.php');
//require('selectCategory.php');

//use App\Model;

$model = new Model();
$model->newConnect();

$categoryes = $model->getCategoryes();
$questions = $model->getQuestions();
$resultAnswers = $model->getAnswers();

		/*echo '<pre>';
		var_dump($resultAnswers);
		echo '</pre>';*/

//require('selectCategory.php');
//require('selectQuestions.php');
//require('selectAnswers.php');


$title = "Вопрос-ответ";
include "templates/head.php";
?>


<section class="cd-faq">
    <ul class="cd-faq-categories">
        <form action="formAuthorization.php" method="post" enctype="multipart/form-data">
            <input class="submit" type="submit" name="checkIn" value="Авторизация">
        </form>
        <form action="questoinUser.php" method="post" enctype="multipart/form-data">
            <input class="submit" type="submit" name="questoinUser" value="Задать вопрос">
        </form>
    </ul>

<div class="cd-faq-items">
	<ul class="cd-faq-group">
        <?php
            include "templates/index_main.php";
        ?>
	</ul>
</div>	
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<?php
    include "templates/foot.php";
?>