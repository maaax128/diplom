<?php 
class Questions
{
	static $connect = null;

	public function newConnect(){
		self::$connect = connect::get();
	}
    //получение списка категорий
    public function getCategoryes() {
		$sth = self::$connect->prepare('SELECT id, category FROM category');
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
    }
    //получение списка вопросов
    public function getQuestions() {
    	$sth = self::$connect->prepare('SELECT id, question, id_category, answered, userName, email, create_date, status FROM questions');
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
    }
    //получение одного вопроса
    public function getOneQuestion($id) {
        $sth = self::$connect->prepare('SELECT id, question, id_category, answered, userName, email, create_date, status, id as question_id FROM questions WHERE id=:id ');
        $sth->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetch(PDO::FETCH_ASSOC);
        return $results;
    }
    //получения вопросов без ответов
    public function getNotAnsweredQuestions() {
        $sth = self::$connect->prepare('SELECT id, question, id_category, answered, userName, email, create_date, status FROM questions 
                                          WHERE NOT(answered = 1)
                                        ORDER BY create_date');
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //получение вопроса с ответом и категорией по id вопроса
    public function getQuestionById($id) {

	    $sql = 'SELECT q.*,a.id AS answer_id, q.id AS question_id
                FROM questions q
                  RIGHT JOIN category c ON c.id = q.id_category
                  RIGHT JOIN answer a ON a.id_questions = q.id
                WHERE q.id=:id LIMIT 1';

        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetch(PDO::FETCH_ASSOC);

        return $results;
    }

    //получение всех вопросов категории
    public function getQuestionsByCategory($category) {

        $sql ="SELECT id, question, id_category, answered, userName, email, create_date, status FROM questions 
                WHERE id_category= :id_category ";

        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id_category', $category, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //добавление вопроса от пользователя
    public function addUserQuestion($params=[]) {
    	$sth = self::$connect->prepare("INSERT INTO questions (question, id_category, answered, userName, email, create_date, status) 
    		VALUES (:question,:group,:answered,:name,:email, NOW(), 0)");

		$sth->bindValue(':question', $params['question'], PDO::PARAM_STR);
		$sth->bindValue(':group', $params['group'], PDO::PARAM_STR);
		$sth->bindValue(':answered', $params['answered'], PDO::PARAM_STR);
		$sth->bindValue(':name', $params['name'], PDO::PARAM_STR);
		$sth->bindValue(':email', $params['email'], PDO::PARAM_STR);

		$sth->execute();
		
		return null;
    }
//получение количества вопросов
    public function getCountQuestion($category, $answered) {
    	$sql ="SELECT COUNT(*) as count
    			FROM questions 
    			WHERE id_category = :id_category" . ($answered ? " AND answered = 1" :"");

    	$sth = self::$connect->prepare($sql);
    	$sth->bindValue(':id_category', $category, PDO::PARAM_INT);
		$sth->execute();
		$results = (int)$sth->fetch(PDO::FETCH_ASSOC)['count'];

		return $results;
    }
//добавление категории
    public function addCategory($name)
    {
        $duplicate = false;

        $categories = $this->getCategoryes();//self::getCategoryes;
        foreach ($categories as $key=>$val) {
            if (mb_strtolower($val['category'],'UTF-8') == mb_strtolower($name,'UTF-8')) {
                $duplicate = true;
                break;
            }
           // var_dump($duplicate);
        }
        if(!$duplicate) {
            $sql = "INSERT INTO category (category) VALUES (:name)";
            $sth = self::$connect->prepare($sql);
            $sth->bindValue(':name', $name, PDO::PARAM_STR);
            $sth->execute();
        }
    }
//удаление категории
    public function deleteCategory($id) {
        $sql = "DELETE FROM category WHERE id= :id; ";
        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        $sql = "DELETE FROM questions WHERE id_category= :id; ";
        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
//удаление вопроса
    public function deleteQuestion($id) {
        $sql = "DELETE FROM questions WHERE id= :id; ";
        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
//скрытие вопроса
    public function hideQuestion($id,$status) {
	    if ($status == 1) {
	        $status = 2;
        } elseif ($status == 2){
            $status = 1;
        }
        $sql = "UPDATE questions SET status= :status WHERE id=:id";
        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->bindValue(':status', $status, PDO::PARAM_INT);
        $sth->execute();
    }
//редактирование вопроса
    public function editQuestion($arr) {
        $sql = "UPDATE questions 
                  SET question = :question,
                      id_category = :category_id,
                      userName = :username
                WHERE id= :id";

        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':question', trim($arr['question']), PDO::PARAM_STR);
        $sth->bindValue(':category_id', (int)$arr['category_id'], PDO::PARAM_INT);
        $sth->bindValue(':username', $arr['userName'], PDO::PARAM_STR);
        $sth->bindValue(':id', (int)$arr['question_id'], PDO::PARAM_INT);
        $sth->execute();

        $sql = "UPDATE answer 
                  SET answer = :answer,
                      id_category = :category_id
                WHERE id= :id";
        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':answer', trim($arr['answer']), PDO::PARAM_STR);
        $sth->bindValue(':category_id', (int)$arr['category_id'], PDO::PARAM_INT);
        $sth->bindValue(':id', (int)$arr['answer_id'], PDO::PARAM_INT);
        $sth->execute();
    }
}
