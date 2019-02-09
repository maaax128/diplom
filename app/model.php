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

    public function getAnswers() {
    	$sth = self::$connect->prepare('SELECT * FROM answer');
    	$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
    }
    public function addUserQuestion($params=[]) {
    	$sth = self::$connect->prepare("INSERT INTO questions (question, id_category, answered, userName, email) 
    		VALUES (:question,:group,:answered,:name,:email)");

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
}
//$pdo = new PDO("mysql:host=localhost;charset=UTF8; dbname=diplom", "root","")