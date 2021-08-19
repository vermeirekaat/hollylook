<?php 

require_once (__DIR__ . '/DAO.php'); 


class RatingsDAO extends DAO {

    public function selectById($id) {
        $sql = "SELECT * FROM `ratings` WHERE `id` = :id"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':id', $id); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function insertRating($data) {
        $errors = $this->validate($data);
        if (empty($errors)) {
            $sql = "INSERT INTO `ratings` (`image_id`, `rating`) VALUES (:image_id, :rating)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':image_id', $data['image_id']);
            $stmt->bindValue(':rating', $data['rating']);
            if ($stmt->execute()) {
                return $this->selectById($this->pdo->lastInsertId());
            }
        }
        return false;
    }

    public function selectAverageRatingByImageId($image_id) {
        $sql = "SELECT ROUND(AVG(`rating`)) AS `average` FROM `ratings` WHERE `image_id` = :image_id"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':image_id', $image_id); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function validate($data)
    {
        $errors = [];
        if (empty($data['image_id'])) {
            $errors['image_id'] = "Please fill in image_id";
        }
        if (empty($data['rating'])) {
            $errors['rating'] = "Please submit a rating";
        }
        return $errors;
    }

}