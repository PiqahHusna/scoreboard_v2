<?php
namespace App\Models;

use mysqli;
use Exception;

class Assignment {
    private mysqli $conn;

    public function __construct() {
        require __DIR__ . '/../../db.php';
        $this->conn = $conn;

        if (!$this->conn) {
            throw new Exception("Database connection failed.");
        }
    }

    // =====================
    // FUNGSI ASLI
    // =====================

    // Get all participants
    public function getAllParticipants(): array {
        $result = $this->conn->query("SELECT * FROM participants ORDER BY name");
        $participants = [];
        while ($row = $result->fetch_assoc()) {
            $participants[] = $row;
        }
        return $participants;
    }

    // Get all games
    public function getAllGames(): array {
        $result = $this->conn->query("SELECT * FROM games ORDER BY name");
        $games = [];
        while ($row = $result->fetch_assoc()) {
            $games[] = $row;
        }
        return $games;
    }

    // Add single assignment
    public function addAssignment(int $participantId, int $gameId): bool {
        $stmt = $this->conn->prepare("INSERT INTO assignments (participant_id, game_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $participantId, $gameId);
        return $stmt->execute();
    }

    // Get all assignments with participant and game names
    public function getAllAssignments(): array {
        $sql = "SELECT a.id, p.name AS participantName, g.name AS gameName
                FROM assignments a
                JOIN participants p ON a.participant_id = p.id
                JOIN games g ON a.game_id = g.id
                ORDER BY a.id DESC";
        $result = $this->conn->query($sql);
        $assignments = [];
        while ($row = $result->fetch_assoc()) {
            $assignments[] = $row;
        }
        return $assignments;
    }

    // Get assignment by ID
    public function getAssignmentById(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM assignments WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    // Update single assignment
    public function updateAssignment(int $id, int $participantId, int $gameId): bool {
        $stmt = $this->conn->prepare("UPDATE assignments SET participant_id=?, game_id=? WHERE id=?");
        $stmt->bind_param("iii", $participantId, $gameId, $id);
        return $stmt->execute();
    }

    // Delete assignment
    public function deleteAssignment(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM assignments WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // =====================
    // FUNGSI TAMBAHAN MULTI-GAME
    // =====================

    // Tambah multiple assignment sekaligus
    public function addAssignments(int $participantId, array $gameIds): bool {
        $stmt = $this->conn->prepare("INSERT INTO assignments (participant_id, game_id) VALUES (?, ?)");
        foreach ($gameIds as $gameId) {
            $stmt->bind_param("ii", $participantId, $gameId);
            if (!$stmt->execute()) return false;
        }
        return true;
    }

    // Update assignment multi-game: hapus semua lama untuk participant, tambah baru
    public function updateAssignments(int $participantId, array $gameIds): bool {
        // Hapus semua assignment lama untuk participant
        $stmt = $this->conn->prepare("DELETE FROM assignments WHERE participant_id=?");
        $stmt->bind_param("i", $participantId);
        $stmt->execute();

        // Tambah assignment baru
        return $this->addAssignments($participantId, $gameIds);
    }

    // Dapatkan semua game ID untuk participant tertentu
    public function getGamesByAssignment(int $participantId): array {
        $stmt = $this->conn->prepare("SELECT game_id FROM assignments WHERE participant_id=?");
        $stmt->bind_param("i", $participantId);
        $stmt->execute();
        $result = $stmt->get_result();
        $games = [];
        while($row = $result->fetch_assoc()) {
            $games[] = $row['game_id'];
        }
        return $games;
    }

    // Dapatkan available games berdasarkan participant join date
    public function getAvailableGamesForParticipant(int $participantId): array {
        $joinDate = $this->getParticipantJoinDate($participantId);
        $stmt = $this->conn->prepare("SELECT * FROM games WHERE event_date >= ?");
        $stmt->bind_param("s", $joinDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $games = [];
        while($row = $result->fetch_assoc()) {
            $games[] = $row;
        }
        return $games;
    }

    // Dapatkan join date participant
    public function getParticipantJoinDate(int $participantId): string {
        $stmt = $this->conn->prepare("SELECT join_date FROM participants WHERE id=?");
        $stmt->bind_param("i", $participantId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['join_date'] ?? date('Y-m-d');
    }
}
