<?php
    header("Content-Type: application/json");
    require_once __DIR__ . '../../services/db/db.php';

    $rm = $_SERVER['REQUEST_METHOD'];

    switch ($rm) {
        case 'POST':
            # code...
            break;
        
        case 'GET':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                getUserRelatedData(intval($_GET['id']));
            }
            else if (isset($_GET['user']) && is_numeric($_GET['user'])) {
                getUserData(intval($_GET['user']));
            }
            break;
    }

    function getUserRelatedData($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT userId, email, phoneNum, usertype FROM users WHERE userId = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "ei löytynyt ID:llä $id"]);
        }
    }

    function getUserData($user) {
        //THIS FEATURE ISNT DONE: IT WONT WORK
        global $pdo;
        $stmt = $pdo->prepare("SELECT userId, email, phoneNum, usertype FROM users WHERE userId = ?");
        $stmt->execute([$user]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "ei löytynyt käyttäjä ID:llä $user"]);
        }
    }
?>