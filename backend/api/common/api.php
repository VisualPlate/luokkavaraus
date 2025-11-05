<?php
    //header to return as json type
    header("Content-Type: application/json");
    require_once __DIR__ . '../../../services/db/db.php';

    $rm = $_SERVER['REQUEST_METHOD'];

    switch ($rm) {
        case 'POST':
            # code...
            break;
        
        case 'GET':
            //Get method. Possible get[s] listed below. (0 for all users data, [id] for specific users data)
            //user = user data. Only "common" info in this api
            //userData = user related data, such as their reservation
            if (isset($_GET['user']) && is_numeric($_GET['user'])) {
                getUser(intval($_GET['user']));
            }
            else if (isset($_GET['userData']) && is_numeric($_GET['userData'])) {
                getUserData(intval($_GET['userData']));
            }
            break;
    }

    function getUser($user) {
        global $pdo;
        switch ($user) {
            case '0':
                //#TOSQLCOMMAND
                $stmt = $pdo->prepare("SELECT userId, usertype FROM users");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($data) {
                    echo json_encode($data);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "EMPTY"]);
                }
                break;
            default:
                //#TOSQLCOMMAND
                $stmt = $pdo->prepare("SELECT userId, usertype FROM users WHERE userId = ?");
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
    function getUserData($userData) {
        global $pdo;
        switch ($userData) {
            case '0':
                //#TOSQLCOMMAND
                $stmt = $pdo->prepare("SELECT 
                            u.userId,
                            r.reservationId,
                            r.reservationDate,
                            r.reservationUseDate,
                            r.duration,
                            c.classId,
                            c.classCode,
                            c.floor
                        FROM reservation r
                        JOIN class c 
                            ON r.classId = c.classId
                        JOIN joinuser ju 
                            ON ju.reservationId = r.reservationId
                        JOIN users u 
                            ON u.userId = ju.userId;"
                        );
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($data) {
                    echo json_encode($data);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "EMPTY"]);
                }
                break;
            
            default:
                //#TOSQLCOMMAND
                $stmt = $pdo->prepare("SELECT 
                                        u.userId,
                                        r.reservationId,
                                        r.reservationDate,
                                        r.reservationUseDate,
                                        r.duration,
                                        c.classId,
                                        c.classCode,
                                        c.floor
                                    FROM reservation r
                                    JOIN class c 
                                        ON r.classId = c.classId
                                    JOIN joinuser ju 
                                        ON ju.reservationId = r.reservationId
                                    JOIN users u 
                                        ON u.userId = ju.userId
                                    WHERE u.userId = ?;"
                                    );
                $stmt->execute([$userData]);
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