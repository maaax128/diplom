<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">

    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>Добавить нового администратора</title>
</head>
<body>
<header>
    <h2>Регистрация нового администратора</h2>
</header>
<form action="addNewADmins.php" method="post" enctype="multipart/form-data">
<fieldset>


 <legend>Введите данные</legend>
 <input type="text" name="name" placeholder="Введите имя" required>
 <input type="text" name="password" placeholder="Введите пароль" required>
 <input type="submit" name="" value="Отправить">

</fieldset>
</form>
<p><a href="controlPanel.php">Вернуться в панель администратора</a></p>    

</body>
</html>