<?php 

require_once (__DIR__ . '/DAO.php'); 

class TagsDAO extends DAO {
    public function selectTags() {
        $sql = "SELECT * FROM `tags`"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

}