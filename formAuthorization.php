<?php
$title= "Форма авторизации";

include "templates/head.php";
?>
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