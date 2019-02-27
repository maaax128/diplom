<div class="line-hr"></div> <div class="line-hr"></div>

<h2>Список всех вопросов без ответов:</h2>
<br>
<?php
$allQuestions = $model->getNotAnsweredQuestions();
$i=0;
foreach ($allQuestions as $k=>$v) {
    $i++;?>
    <div>
        <?=$i?>) <?=$v['question']?>
        <span style="font-size: 11px; color:lightslategrey;">
                       Дата: <?=$v['create_date'];?>
                </span>
        <div>
            <form id="deleteQuestion" action="controller.php" method="post" style="display: inline-block">
                <input type="text" name="questionId" value="<?=$v['id']?>" hidden>
                <input type="text" name="method" hidden value="deleteQuestion">
                <input type="submit" value="Удалить">
                </span>
            </form>

            <form action="editquestion.php" method="get" style="display: inline-block">
                <input type="text" name="id" value="<?=$v['id']?>" hidden>
                <input type="text" name="type" value="notanswered" hidden>
                <input type="submit" value="Редактировать">
            </form>

        </div>
    </div>
<?php } ?>