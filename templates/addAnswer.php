<section class="cd-faq">
    <form action="../controller/innerController.php" method="post">
        <div class="cd-faq-items" style="margin-top: 10px; display: table-row;">

            <input type="text" name="method" value="addAnswer" hidden>
            <input type="text" name="question_id" value="<?=$_GET["questionId"];?>" hidden>
            <input type="text" name="category_id" value="<?=$_GET["category_id"];?>" hidden>

            <div style="display: inline-block; float: left;">
                <textarea name="answer" rows="4" cols="45" placeholder="Введите ответ"></textarea>
            </div>

            <div class="clear" style="margin-top: 5px;">
                <select size="1" name="status">
                    <option disabled >Выберите статус</option>
                    <option value="1">Опубликовать</option>
                    <option value="2">Скрыть</option>
                </select>
            </div>

            <div class="clear" style="margin-top: 5px;">
                <input type="submit" value="Сохранить ответ">
            </div>
        </div>
    </form>
</section>