<?php

namespace App\Controllers;

use App\Models\Game;
require_once __DIR__ . '/../models/game.php';

class GameController
{
    private Game $gameModel;

    public function __construct($conn)
    {
        $this->gameModel = new Game($conn);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ✅ List semua game
    public function index(): void
    {
        $games = $this->gameModel->getAllGames();
        $this->loadView('games/index', ['games' => $games]);
    }

    // ✅ Tambah game baru
    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectToIndex(); // terus keluar (exit)
        }

        $name = trim($_POST['name'] ?? '');

        $validation = $this->validateGameName($name);
        if (!$validation['valid']) {
            $_SESSION['error'] = $validation['message'];
            $this->redirectToIndex();
        }

        if ($this->gameModel->gameExists($name)) {
            $_SESSION['error'] = "Game name already exists.";
            $this->redirectToIndex();
        }

        if ($this->gameModel->createGame($name)) {
            $_SESSION['success'] = "Game added successfully!";
        } else {
            $_SESSION['error'] = "Error creating game.";
        }

        $this->redirectToIndex();
    }

    // ✅ Edit game
    public function edit($id = null): void
    {
        // Handle POST submit dari form edit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEditPost();
        }

        $id = (int)($id ?? ($_GET['id'] ?? 0));
        $game = $this->gameModel->getGameById($id);

        if (!$game) {
            $_SESSION['error'] = "Game not found.";
            $this->redirectToIndex();
        }

        $this->loadView('games/edit', ['game' => $game]);
    }

    // ✅ Delete game
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleDeletePost();
        }

        $id = (int)($_GET['id'] ?? 0);
        $game = $this->gameModel->getGameById($id);

        if (!$game) {
            $_SESSION['error'] = "Game not found.";
            $this->redirectToIndex();
        }

        $this->loadView('games/delete', ['game' => $game]);
    }

    // ✅ Handle update (edit)
    private function handleEditPost(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        $validation = $this->validateGameName($name);
        if (!$validation['valid']) {
            $_SESSION['error'] = $validation['message'];
            $this->redirectToIndex();
        }

        if ($this->gameModel->gameExistsExcept($name, $id)) {
            $_SESSION['error'] = "Another game with that name already exists.";
            $this->redirectToIndex();
        }

        if ($this->gameModel->updateGame($id, $name)) {
            $_SESSION['success'] = "Game updated successfully!";
        } else {
            $_SESSION['error'] = "Error updating game.";
        }

        $this->redirectToIndex();
    }

    // ✅ Handle delete
    private function handleDeletePost(): void
    {
        $id = (int)($_POST['id'] ?? 0);

        if ($this->gameModel->deleteGame($id)) {
            $_SESSION['success'] = "Game deleted successfully!";
        } else {
            $_SESSION['error'] = "Error deleting game.";
        }

        $this->redirectToIndex();
    }

    // ✅ Validasi nama game
    private function validateGameName(string $name): array
    {
        if (strlen($name) < 2) {
            return ['valid' => false, 'message' => 'Game name must be at least 2 characters.'];
        }
        return ['valid' => true, 'message' => ''];
    }

    // ✅ Load view
    private function loadView(string $view, array $data = []): void
    {
        extract($data);
        include __DIR__ . "/../views/{$view}.php";
        exit; // 🔑 penting: elak view berganda
    }

    // ✅ Redirect ke index game
    private function redirectToIndex(): void
    {
        header("Location: /scoreboard_system/index.php?page=game");
        exit;
    }

    // ✅ Form untuk tambah game
    public function addForm(): void
    {
        $this->loadView('games/add');
    }
}
