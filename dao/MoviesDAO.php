<?php

require_once (__DIR__ . '/DAO.php');

class MoviesDAO extends DAO {

    public function selectAllMovies() {
        $sql = "SELECT * FROM `movies` ORDER BY `year` ASC";
        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function selectMovieById($id) {
        $sql = "SELECT * FROM `movies` WHERE `id` = :id"; 
        $stmt = $this->pdo->prepare($sql); 
        $stmt->bindValue(':id', $id); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}
