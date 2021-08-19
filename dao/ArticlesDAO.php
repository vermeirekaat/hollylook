<?php 

require_once (__DIR__ . '/DAO.php'); 

class ArticlesDAO extends DAO {
    // inner join gebruiken om de tags eraan te koppelen
    public function selectArticles() {
        $sql = "SELECT * FROM `articles` INNER JOIN `tags` ON `articles`.`tag_id` = `tags`.`id`";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function selectFilteredArticles($tag_id) {
        $sql = "SELECT * FROM `articles` INNER JOIN `tags` ON `articles`.`tag_id` = `tags`.`id` WHERE `tag_id` = :tag_id"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':tag_id', $tag_id); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function selectArticlesLimit($tag_id) {
        $sql = "SELECT * FROM `articles` WHERE `tag_id` = :tag_id LIMIT 6"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':tag_id', $tag_id);  
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // info van tags ophalen bij het artikel 
    public function selectArticleById($article_id) {
        $sql = "SELECT * FROM `articles` INNER JOIN `tags` ON `articles`.`tag_id` = `tags`.`id` WHERE `articles`.`id` = :articleId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':articleId', $article_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function insertArticle($data) {
        $errors = $this->validate($data); 
        if(empty($errors)) {
            $sql = "INSERT INTO `articles` (`username`, `title`, `tag_id`, `introduction`, `stepone`, `steptwo`, `stepthree`) VALUES(:username, :title, :tag_id, :introduction, :stepone, :steptwo, :stepthree)"; 
            $stmt = $this->pdo->prepare($sql); 
            $stmt->bindValue(':username', $data['username']); 
            $stmt->bindValue(':tag_id', $data['tag_id']);
            $stmt->bindValue(':title', $data['title']); 
            $stmt->bindValue('introduction', $data['introduction']);
            $stmt->bindValue(':stepone', $data['stepone']); 
            $stmt->bindValue(':steptwo', $data['steptwo']); 
            $stmt->bindValue(':stepthree', $data['stepthree']);
            if($stmt->execute()) {
                return $this->selectArticleById($this->pdo->lastInsertId()); 
            }
        }
        return false; 
    }

    public function validate($data) {
        $errors = []; 
        if (empty($data['username'])) {
            $errors['username'] = "Please fill in a username"; 
        }
        if (empty($data['title'])) {
            $errors['title'] = "Please fill in a title"; 
        }
        if (empty($data['introduction'])) {
            $errors['introduction'] = "Please fill in introduction";
        }
        if (empty($data['stepone'])) {
            $errors['stepone'] = "Please fill in step one"; 
        }
        if(empty($data['steptwo'])) {
            $errors['steptwo'] = "Please fill in step two"; 
        }
        if(empty($data['stepthree'])) {
            $errors['stepthree'] = "Please fill in step three";
        }
    }

}
