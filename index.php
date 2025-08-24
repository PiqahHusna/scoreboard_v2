<?php
// Mulakan output buffering & session
ob_start();
session_start();
include __DIR__ . "/db.php"; // Sambung ke database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Gunakan relative path atau check path yang betul -->
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/participant.css">
    <title>Scoreboard System</title>
</head>

<body>
    <!-- Include sidebar di dalam body -->
   
    
    <!-- Main content wrapper - PENTING untuk CSS sidebar berfungsi -->
    <main class="main-content">
        <div class="container">
            <?php
            // =========================
            // Routing  NAVIGATE PAGE 
            // =========================
            $page = $_GET['page'] ?? 'dashboard';

            switch ($page) {
                case 'dashboard':
                    include __DIR__ . '/app/views/partials/dashboard.php';
                    break;

                // =========================
                // SCORE MODULE
                // =========================
                case 'score':
                    include __DIR__ . '/app/views/scores/index.php';
                    break;
                case 'score_add':
                    include __DIR__ . '/app/views/scores/add.php';
                    break;
                case 'score_edit':
                    include __DIR__ . '/app/views/scores/edit.php';
                    break;
                case 'score_delete':
                    include __DIR__ . '/app/views/scores/delete.php';
                    break;
                case 'score_list':
                    include __DIR__ . '/app/views/scores/list.php';
                    break;

                // =========================
                // GAME MODULE
                // =========================
                case 'game':
                    require_once __DIR__ . '/app/controllers/GameController.php';
                    $gameController = new \App\Controllers\GameController($conn);

                    $action = $_GET['action'] ?? 'index';
            
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $postAction = $_POST['action'] ?? $action;
                        switch ($postAction) {
                            case 'create':
                                $gameController->create();
                                break;
                            case 'edit':
                                $gameController->edit();
                                break;
                            case 'delete':
                                $gameController->delete();
                                break;
                        }
                        return;
                    }

                    switch ($action) {
                        case 'index':
                        case 'list':
                            $gameController->index();
                            break;
                        case 'add':
                            $gameController->addForm();
                            break;
                        case 'edit':
                            $gameController->edit();
                            break;
                        case 'delete':
                            $gameController->delete();
                            break;
                        default:
                            $gameController->index();
                            break;
                    }
                    break;

                // =========================
                // ASSIGNMENT MODULE
                // =========================
                case 'assignment':
                    $subpage = $_GET['action'] ?? 'index';
                    require __DIR__ . '/app/controllers/AssignmentController.php';
                    $controller = new \App\Controllers\AssignmentController();

                    switch ($subpage) {
                        case 'add':
                            $controller->add();
                            break;
                        case 'edit':
                            if (isset($_GET['id']))
                                $controller->edit(intval($_GET['id']));
                            break;
                        case 'delete':
                            if (isset($_GET['id']))
                                $controller->delete(intval($_GET['id']));
                            break;
                        case 'index':
                        default:
                            $controller->index();
                            break;
                    }
                    break;

                // =========================
                // PARTICIPANT MODULE
                // =========================
                case 'participant':
                    require_once __DIR__ . '/app/models/Participant.php';
                    require_once __DIR__ . '/app/controllers/ParticipantController.php';

                    $controller = new \App\Controllers\ParticipantController();
                    $controller->handleRequest($_SERVER, $_GET, $_POST);
                    break;

                // =========================
                // USER MODULE
                // =========================
                case 'user':
                    include __DIR__ . '/app/views/users/index.php';
                    break;
                case 'user_add':
                    include __DIR__ . '/app/views/users/add.php';
                    break;
                case 'user_edit':
                    include __DIR__ . '/app/views/users/edit.php';
                    break;
                case 'user_delete':
                    include __DIR__ . '/app/views/users/delete.php';
                    break;
                case 'user_list':
                    include __DIR__ . '/app/views/users/list.php';
                    break;

                default:
                    echo "<h2>404 - Page Not Found</h2>";
                    break;
            }
            ?>
        </div>
    </main>

   