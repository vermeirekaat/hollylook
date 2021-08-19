<?php 

require_once (__DIR__ . '/DAO.php'); 

class ImagesDAO extends DAO {
    // op de home staan de drie recentste foto's
    public function selectRecentImagesByThree() {
        $sql = "SELECT * FROM `images` ORDER BY `id` DESC LIMIT 3";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectImagesWithLimit() {
        $sql = "SELECT * FROM `images` LIMIT 9"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectImages() {
        $sql = "SELECT * FROM `images`"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // gallery toont de meest recente foto's 
    public function selectRecentImages() {
        $sql = "SELECT * FROM `images` ORDER BY `id` DESC LIMIT 9"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function selectPopularImages() {
        $sql = "SELECT `images` .*, COUNT(`ratings`.`image_id`) as `popular` FROM `ratings` INNER JOIN `images` ON `ratings`.`image_id` = `images`.`id` GROUP BY `ratings`.`image_id` ORDER BY COUNT(`ratings`.`image_id`) DESC LIMIT 9"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute();
        return $stmt->fetchALl(PDO::FETCH_ASSOC); 
    }

    // detailpagina wordt ingevuld met de gegevens van een bepaalde afbeelding
    public function selectImageById($id) {
        $sql = "SELECT * FROM `images`WHERE `id` = :id"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':id', $id); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // tag ophalen van een afbeelding 
    public function selectTagById($image_id) {
        $sql = "SELECT * FROM `images` INNER JOIN `tags` ON `images`.`tag_id` = `tags`.`id` WHERE `images`.`id` = :imageId";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':imageId', $image_id); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectImagesByTag($tag_id) {
        $sql = "SELECT `path` FROM `images` INNER JOIN `articles` ON `images`.`tag_id` = `articles`.`tag_id` WHERE `images`.`tag_id` = :tagId LIMIT 3"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':tagId', $tag_id); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function selectImageByAverage() {
        $sql = "SELECT `images` .*, ROUND(AVG(`rating`)) as `average` FROM `ratings`INNER JOIN `images` ON `ratings`.`image_id` = `images`.`id` GROUP BY `ratings`.`image_id`";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function uploadImage($data) {
        $errors = $this->validate($data); 
        if (empty($errors)) {
            $sql = "INSERT INTO `images` (`path`, `username`, `tag_id`, `movie`, `year`, `character`, `description`) VALUES (:path, :username, :tag_id, :movie, :year, :character, :description)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':path', $data['path']);
            $stmt->bindValue(':username', $data['username']);
            $stmt->bindValue(':movie', $data['movie']);
            $stmt->bindValue(':year', $data['year']);
            $stmt->bindValue(':character', $data['character']);
            $stmt->bindValue(':description', $data['description']);
            $stmt->bindValue('tag_id', $data['tag_id']);
            if ($stmt->execute()) {
                return $this->selectImageById($this->pdo->lastInsertId());
            }
        }
        return false;   
    }

    public function validate($data)
    {
        $errors = [];
        if(empty($data['path'])) {
            $errors['image'] = "Plase select a file";
        }
        if (empty($data['username'])) {
            $errors['username'] = "Please fill in username";
        }
        if (empty($data['movie'])) {
            $errors['movie'] = "Please fill in movie";
        }
        if (!is_numeric($data['year'])) {
            $errors['year'] = "Please fill in year";
        }
        if (empty($data['character'])) {
            $errors['character'] = "Please fill in character";
        }
        if (empty($data['description'])) {
            $errors['description'] = "Please fill in description";
        }
        if (empty($data['path'])) {
            $errors['path'] = "Please fill in path";
        }
        return $errors;
    }
}
