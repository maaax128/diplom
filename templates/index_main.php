<section class="cd-faq">
    <ul class="cd-faq-categories">
<!--        formAuthorization.php-->
        <form action="controller/usersController.php" method="get" enctype="multipart/form-data">
            <input type="text" name="action" value="formAuthorization" hidden>
            <input class="submit" type="submit" name="checkIn" value="Авторизация">
        </form>

        <form action="controller/frontController.php" method="get" enctype="multipart/form-data">
            <input type="text" name="action" value="questionUser" hidden>
            <input class="submit" type="submit" name="questoinUser" value="Задать вопрос">
        </form>
    </ul>

<div class="cd-faq-items">
	<ul class="cd-faq-group">
        <?php
            include 'index_content.php';
        ?>
	</ul>
</div>
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
