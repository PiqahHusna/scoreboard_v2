<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Assignment.php';
use App\Models\Assignment;

class AssignmentController {
    private Assignment $assignmentModel;

    public function __construct() {
        $this->assignmentModel = new Assignment();
    }

    // Papar semua assignments
    public function index() {
        $assignments = $this->assignmentModel->getAllAssignments();
        $participants = $this->assignmentModel->getAllParticipants();
        $games = $this->assignmentModel->getAllGames();

        include __DIR__ . '/../views/assignments/index.php';
    }

    // Add assignment
    public function add() {
        $participants = $this->assignmentModel->getAllParticipants();
        $games = $this->assignmentModel->getAllGames();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $participantId = intval($_POST['participantId']);
            $gameIds = $_POST['gameIds'] ?? [];
            $gameIds = array_map('intval', $gameIds);

            if (!empty($gameIds)) {
                $this->assignmentModel->addAssignments($participantId, $gameIds);
            }

            header('Location: index.php?page=assignment&action=index');
            exit;
        }

        include __DIR__ . '/../views/assignments/add.php';
    }

    // Edit assignment
    public function edit(int $id) {
        $assignment = $this->assignmentModel->getAssignmentById($id);
        if (!$assignment) {
            echo "Assignment not found.";
            return;
        }

        $participants = $this->assignmentModel->getAllParticipants();
        $allGames = $this->assignmentModel->getAllGames();

        // Ambil game yang sudah dipilih berdasarkan participant_id
        $participantId = $assignment['participant_id'];
        $assignedGameIds = $this->assignmentModel->getGamesByAssignment($participantId); // array of game IDs

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $participantId = intval($_POST['participantId']);
            $gameIds = $_POST['gameIds'] ?? [];
            $gameIds = array_map('intval', $gameIds);

            $this->assignmentModel->updateAssignments($participantId, $gameIds);

            header('Location: index.php?page=assignment&action=index');
            exit;
        }

        include __DIR__ . '/../views/assignments/edit.php';
    }

    // Delete assignment
    public function delete(int $id) {
        $this->assignmentModel->deleteAssignment($id);
        header('Location: index.php?page=assignment&action=index');
        exit;
    }
}
