<?php
namespace App\Controllers;

use App\Models\Participant;

class ParticipantController
{
    private $participantModel;

    public function __construct()
    {
        $this->participantModel = new Participant();
    }

    public function handleRequest($server, $get, $post)
    {
        $action = $get['action'] ?? 'list';
        $id     = $get['id'] ?? null;

        switch ($action) {
            case 'add':
                if ($server['REQUEST_METHOD'] === 'POST') {
                    $this->create($post);
                } else {
                    $this->showAddForm();
                }
                break;

            case 'edit':
                if (!$id) {
                    echo "<p>ID participant tidak sah.</p>";
                    return;
                }

                if ($server['REQUEST_METHOD'] === 'POST') {
                    $this->update($id, $post);
                } else {
                    $this->showEditForm($id);
                }
                break;

            case 'delete':
                if (!$id) {
                    echo "<p>ID participant tidak sah.</p>";
                    return;
                }

                if ($server['REQUEST_METHOD'] === 'POST') {
                    $this->delete($id);
                } else {
                    $this->showDeleteConfirmation($id);
                }
                break;

            case 'list':
            default:
                $this->index();
                break;
        }
    }

    // ==================================================
    // CRUD
    // ==================================================
    private function index()
    {
        $participants = $this->participantModel->read();
        include __DIR__ . '/../views/participants/list.php';
    }

    private function create($data)
    {
        $this->participantModel->create($data);
        header("Location: ?page=participant&action=list");
        exit;
    }

    private function update($id, $data)
    {
        $this->participantModel->update($id, $data);
        header("Location: ?page=participant&action=list");
        exit;
    }

    private function delete($id)
    {
        $this->participantModel->delete($id);
        header("Location: ?page=participant&action=list");
        exit;
    }

    // ==================================================
    // Views
    // ==================================================
    private function showAddForm()
    {
        $dates    = $this->participantModel->getEventDates();
        $packages = $this->participantModel->getPackages();
        $sessions = $this->participantModel->getSessions();

        include __DIR__ . '/../views/participants/add.php';
    }

    private function showEditForm($id)
    {
        $participant = $this->participantModel->readOne($id);
        $dates    = $this->participantModel->getEventDates();
        $packages = $this->participantModel->getPackages();
        $sessions = $this->participantModel->getSessions();

        include __DIR__ . '/../views/participants/edit.php';
    }

    private function showDeleteConfirmation($id)
    {
        $participant = $this->participantModel->readOne($id);
        include __DIR__ . '/../views/participants/delete.php';
    }
}
