<?php
namespace App\Models;
class Game {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getAllGames() {
        $query = "SELECT * FROM games ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $query);
        
        $games = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $games[] = $row;
            }
        }
        
        return $games;
    }
    
    public function getGameById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM games WHERE id = ?";
        
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        return mysqli_fetch_assoc($result);
    }
    
    public function gameExists($name) {
        $query = "SELECT COUNT(*) as count FROM games WHERE LOWER(name) = LOWER(?)";
        
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        return $row['count'] > 0;
    }
    
    public function gameExistsExcept($name, $id) {
        $query = "SELECT COUNT(*) as count FROM games WHERE LOWER(name) = LOWER(?) AND id != ?";
        
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        return $row['count'] > 0;
    }
    
    public function createGame($name) {
        $query = "INSERT INTO games (name, created_at, updated_at) VALUES (?, NOW(), NOW())";
        
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $name);
        
        return mysqli_stmt_execute($stmt);
    }
    
    public function updateGame($id, $name) {
        $query = "UPDATE games SET name = ?, updated_at = NOW() WHERE id = ?";
        
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        
        return mysqli_stmt_execute($stmt);
    }
    
    public function deleteGame($id) {
        $query = "DELETE FROM games WHERE id = ?";
        
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        return mysqli_stmt_execute($stmt);
    }
    
    public function searchGames($searchTerm) {
        $searchTerm = "%$searchTerm%";
        $query = "SELECT * FROM games WHERE name LIKE ? ORDER BY created_at DESC";
        
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $searchTerm);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $games = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $games[] = $row;
        }
        
        return $games;
    }
}
