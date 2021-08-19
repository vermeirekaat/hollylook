<?php 

require_once (__DIR__ . '/DAO.php'); 

class CommentsDAO extends DAO {
    // detail, comments ophalen o.b.v. de image_id 
    public function selectCommentsByImageId($imageId) {
        $sql = "SELECT * FROM `comments` WHERE `image_id` = :image_id ORDER BY `id` ASC"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue('image_id', $imageId); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    // SELECT * FROM `comments` INNER JOIN `users` ON `comments`.`user_id` = `users`.`id`

    private function selectById($id) {
        $sql = "SELECT * FROM `comments` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':id', $id); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // comments toevoegen via formulier
    public function insertComment($data) {
        $errors = $this->validate($data); 
        if (empty($errors)) {
            $sql = "INSERT INTO `comments`(`image_id`, `comment`) VALUES (:image_id, :comment)"; 
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':image_id', $data['image_id']); 
            $stmt->bindValue(':comment', $data['comment']); 
            if ($stmt->execute()) {
                return $this->selectById($this->pdo->lastInsertId());
            }
        }
        return false;
    }

    public function validate($data) {
        $errors = [];
        if (!isset($data['image_id'])) {
            $errors['image_id'] = 'Please fill in image_id';
        }
        if (empty($data['comment'])) {
            $errors['comment'] = 'Please fill in comment';
        }
        return $errors;
    }

}
