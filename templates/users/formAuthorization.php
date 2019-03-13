<div class="cd-faq-items">
<!--    <form action="../../actionAuthorization.php" method="post" enctype="multipart/form-data">-->
    <form action="../../controller/usersController.php" method="get" enctype="multipart/form-data">
        <h2>Авторизация</h2>
        <input name="action" value="actionAuthorization" hidden>
        <p><input class="input" type="text" name="login" placeholder="login"></p>
        <p><input class="input" type="password" name="password" placeholder="password"></p>
        <input class="submit" type="submit" name="authorization" value="Авторизация">
    </form>
</div>
