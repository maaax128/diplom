<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->

	<title>Авторизация</title>
</head>
<body>
	<header>
		
	</header>
	<div class="cd-faq-items">
		<form action="actionAuthorization.php" method="post" enctype="multipart/form-data">
			<h2>Авторизация</h2>
			<p><input class="input" type="text" name="login" placeholder="login"></p>
			<p><input class="input" type="password" name="password" placeholder="password"></p>
			<input class="submit" type="submit" name="authorization" value="Авторизация">
		</form>
	</div>
</body>
</html>