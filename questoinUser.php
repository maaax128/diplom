<?php
//require('connect.php');
//require('selectCategory.php');
require('app/model.php');
$model = new Model();
$model->newConnect();
$categoryes = $model->getCategoryes();

?>



<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Задать вопрос</title>
</head>
<body>
<form action="addQuestionUser.php" method="post" enctype="multipart/form-data">
<fieldset>


 <legend>Контактная информация</legend>
 <input type="text" name="name" placeholder="Введите имя" required>
 <input type="text" name="email" placeholder="Введите ваш e-mail" required>
 <select size="1" name="selected">
 <option disabled>Выберите категорию</option>
 <?php 
 foreach ($categoryes as $result => $value) {
$group = $value['category'];
?> 		
<option><?php echo "$group"; ?></option>		
<?php
}

 ?>

 </select>
 <p><input size="65" type="text" name="userQuest" placeholder="Задайте вопрос" required></p>
 <input type="submit" name="" value="Отправить">

</fieldset>
</form>


</body>
</html>