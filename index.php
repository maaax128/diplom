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



?>



<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>Вопрос-ответ</title>
</head>
<body>
<header>
	<h1>Вопрос-ответ</h1>
</header>
<section class="cd-faq">
<ul class="cd-faq-categories">
	<form action="formAuthorization.html" method="post" enctype="multipart/form-data">
		<input class="submit" type="submit" name="checkIn" value="Авторизация">
	</form>
	<form action="questoinUser.php" method="post" enctype="multipart/form-data">
		<input class="submit" type="submit" name="questoinUser" value="Задать вопрос">
	</form>
<?php 
/*foreach ($results as $result => $value) {
	$group = $value['category'];
	?> 	
		<li><a href=#"<?php $group?>"><?php echo "$group"; ?></a></li>	
	<?php
}*/

?> 
</ul><!-- cd-faq-categories -->
<div class="cd-faq-items">
	<ul class="cd-faq-group">
		<?php
		foreach ($categoryes as $result => $value) {
			$group = $value['category'];
			?>
			<li class="cd-faq-title"><?php echo "<h2>$group</h2>"; ?></li><?php
			foreach ($questions as $resultQuest => $valueQuest) {

				if ($valueQuest['id_category'] === $value['id'] && $valueQuest['answered'] == 1 && $valueQuest['status'] == 1 ) {
					$problem = $valueQuest['question'];
					?>
					<a class="cd-faq-trigger" href="#0"><?php echo "$problem</br>";?></a>
				<?php					
				}
				foreach ($resultAnswers as $resultAnswer => $valueAnswer) {
					?>					
					<?php
					if ($valueAnswer['id_category'] === $value['id'] && $valueAnswer['id_questions'] === $valueQuest['id'])  {
						?><div class="cd-faq-content"><?php
						$reply = $valueAnswer['answer'];
						echo "<p>$reply</p>";
						?></div><?php
					}
					
				} 
			}
		}
?>
	
	</ul>
</div>	
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>