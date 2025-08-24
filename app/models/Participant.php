<?php
namespace App\Models;

use mysqli;

class Participant
{
    private $conn;

    public function __construct()
    {
        include __DIR__ . '/../../db.php';
        $this->conn = $conn;
    }

    // =======================
    // CRUD Participants
    // =======================
    public function create($data)
    {
        $sessions = isset($data['additional_sessions']) ? implode(',', $data['additional_sessions']) : '';

        $sql = "INSERT INTO participants 
            (event_date, package, additional_sessions, package_picture, name, email, ic_number, phone_number, address, company, position, gun_license, shooting_experience) 
            VALUES (
                '{$data['event_date']}',
                '{$data['package']}',
                '{$sessions}',
                '{$data['package_picture']}',
                '{$data['name']}',
                '{$data['email']}',
                '{$data['ic_number']}',
                '{$data['phone_number']}',
                '{$data['address']}',
                '{$data['company']}',
                '{$data['position']}',
                '{$data['gun_license']}',
                '{$data['shooting_experience']}'
            )";
        return mysqli_query($this->conn, $sql);
    }

    public function read()
    {
        $sql = "SELECT * FROM participants ORDER BY id DESC";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function readOne($id)
    {
        $sql = "SELECT * FROM participants WHERE id=".(int)$id;
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function update($id, $data)
    {
        $sessions = isset($data['additional_sessions']) ? implode(',', $data['additional_sessions']) : '';

        $sql = "UPDATE participants SET
            event_date='{$data['event_date']}',
            package='{$data['package']}',
            additional_sessions='{$sessions}',
            package_picture='{$data['package_picture']}',
            name='{$data['name']}',
            email='{$data['email']}',
            ic_number='{$data['ic_number']}',
            phone_number='{$data['phone_number']}',
            address='{$data['address']}',
            company='{$data['company']}',
            position='{$data['position']}',
            gun_license='{$data['gun_license']}',
            shooting_experience='{$data['shooting_experience']}'
            WHERE id=".(int)$id;
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM participants WHERE id=".(int)$id;
        return mysqli_query($this->conn, $sql);
    }

    // =======================
    // Dropdown Data
    // =======================
    public function getEventDates()
    {
        $sql = "SELECT id, date FROM event_dates ORDER BY date ASC";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getPackages()
    {
        $sql = "SELECT id, name FROM packages ORDER BY name ASC";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getSessions()
    {
        $sql = "SELECT id, name FROM sessions ORDER BY name ASC";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
