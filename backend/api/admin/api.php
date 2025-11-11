<?php            
    //This api file is specifically made for admins and other superusers. 
    //This api should not be in hands with regular users

    require("../../backend/services/sessions/start.php");
    require("../../backend/services/admincheck/check.php");

    //header to return as json type
    header("Content-Type: application/json");
    require_once __DIR__ . '../../../services/db/db.php';



    $rm = $_SERVER['REQUEST_METHOD'];

    switch ($rm) {
        case 'GET':
            //Get method. Possible get[s] listed below
            //user = all user data
            if (isset($_GET['user']) && is_numeric($_GET['user'])) {
                getUser(intval($_GET['user']));
            }
            break;
    }

    function getUser($user) {
        global $pdo;
        switch ($user) {
            case '0':
                //#TOSQLCOMMAND
                $stmt = $pdo->prepare("SELECT userId, email, phoneNum, usertype FROM users");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($data) {
                    echo json_encode($data);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "EMPTY"]);
                }
            default:
                //#TOSQLCOMMAND
                $stmt = $pdo->prepare("SELECT userId, email, phoneNum, usertype FROM users WHERE userId = ?");
                $stmt->execute([$user]);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($data) {
                    echo json_encode($data);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "EMPTY"]);
                }
                break;
            }
    }
?>