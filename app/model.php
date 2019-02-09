<?php 
class Di
{
    static $di = null;

    public static function get()
    {
        if (! self::$di) {
            self::$di = new Di();
        }

        $db = self::$di->config();
        
        try {
            $dbconnect = new PDO($db['driver'].":host=" . $db['host'] . ";dbname=" . $db['dbname'],$db['user'], $db['pass']);

        } catch (PDOException $e) {
            die('Database error: '.$e->getMessage().'<br/>');
        }

        return $dbconnect;
    }
    public function config()
    {
        $settings = require 'settings.php';
		$db = $settings['db'];
        return $db;
    }
    public function db()
    {
        $db = $this->config();
        try {
            $db = new PDO($db['driver'].":host=" . $db['host'] . ";dbname=" . $db['dbname'],$db['user'], $db['pass']);

        } catch (PDOException $e) {
            die('Database error: '.$e->getMessage().'<br/>');
        }
        return $db;
    }
}

class Model
{
	static $connect = null;

	public function newConnect(){
		self::$connect = Di::get();
	}

    public function getCategoryes() {
		$sth = self::$connect->prepare('SELECT * FROM category');
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
    }

    public function getQuestions() {
    	$sth = self::$connect->prepare('SELECT * FROM questions');
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
    }

    public function getQuestionById($id) {
	    $sql = 'SELECT *, a.id AS answer_id, q.id AS question_id
                FROM questions q
                  RIGHT JOIN category c ON c.id = q.id_category
                  RIGHT JOIN answer a ON a.id_questions = q.id
                WHERE q.id= :id LIMIT 1';

        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetch(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getQuestionsByCategory($category) {

        $sql ="SELECT * FROM questions 
                WHERE id_category= :id_category ";

        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id_category', $category, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function getAnswers() {
    	$sth = self::$connect->prepare('SELECT * FROM answer');
    	$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
    }
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

    public function deleteQuestion($id) {
        $sql = "DELETE FROM questions WHERE id= :id; ";
        $sth = self::$connect->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }

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

    public function editQuestion($arr) {
//        echo '<pre>';
//        echo var_dump($arr);
//        echo '</pre>';

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