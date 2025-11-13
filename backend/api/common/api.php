<?php
// Palautetaan JSON-muotoista dataa
require("../../services/sessions/start.php");
header("Content-Type: application/json");
require_once __DIR__ . '/../../services/db/db.php';


$rm = $_SERVER['REQUEST_METHOD'];

switch ($rm) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['classId']) && isset($data['reservationUseDate']) && isset($data['duration'])) {
            createReservation($data);
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Puuttuvia tietoja"]);
        }
        break;

    case 'GET':
        if (isset($_GET['user']) && is_numeric($_GET['user'])) {
            getUser(intval($_GET['user']));
        } elseif (isset($_GET['userData']) && is_numeric($_GET['userData'])) {
            getUserData(intval($_GET['userData']));
        } elseif (isset($_GET['class']) && is_numeric($_GET['class'])) {
            getClass(intval($_GET['class']));
        }  else {
            http_response_code(400);
            echo json_encode(["message" => "Virheellinen pyyntö"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Metodia ei tueta"]);
        break;
}

function getUser($user) {
    global $pdo;

    if ($user === 0) {
        $stmt = $pdo->prepare("SELECT userId, usertype FROM users");
        $stmt->execute();
    } else {
        $stmt = $pdo->prepare("SELECT userId, usertype FROM users WHERE userId = ?");
        $stmt->execute([$user]);
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "EMPTY"]);
    }
}

function getUserData($userData) {
    global $pdo;

    if ($userData === 0) {
        $stmt = $pdo->prepare("
            SELECT 
                u.userId,
                r.reservationId,
                r.reservationDate,
                r.reservationUseDate,
                r.duration,
                c.classId,
                c.classCode,
                c.floor
            FROM reservation r
            JOIN class c ON r.classId = c.classId
            JOIN joinuser ju ON ju.reservationId = r.reservationId
            JOIN users u ON u.userId = ju.userId
        ");
        $stmt->execute();
    } else {
        $stmt = $pdo->prepare("
            SELECT 
                u.userId,
                r.reservationId,
                r.reservationDate,
                r.reservationUseDate,
                r.duration,
                c.classId,
                c.classCode,
                c.floor
            FROM reservation r
            JOIN class c ON r.classId = c.classId
            JOIN joinuser ju ON ju.reservationId = r.reservationId
            JOIN users u ON u.userId = ju.userId
            WHERE u.userId = ?
        ");
        $stmt->execute([$userData]);
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "EMPTY"]);
    }
}

function getClass($class) {
    global $pdo;

    if ($class === 0) {
        $stmt = $pdo->prepare("SELECT * FROM class");
        $stmt->execute();
    } else {
        $stmt = $pdo->prepare("SELECT * FROM class WHERE classId=?");
        $stmt->execute([$class]);
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "EMPTY"]);
    }
}

function createReservation($data) {
    global $pdo;

    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(["success" => false, "message" => "Ei kirjautunut"]);
        return;
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            INSERT INTO reservation (classId, reservationDate, reservationUseDate, duration)
            VALUES (?, NOW(), ?, ?)
        ");
        $stmt->execute([$data['classId'], $data['reservationUseDate'], $data['duration']]);
        $reservationId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO joinuser (reservationId, userId)
            VALUES (?, ?)
        ");
        $stmt->execute([$reservationId, $_SESSION['user_id']]);

        $pdo->commit();

        echo json_encode(["success" => true, "reservationId" => $reservationId]);
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
?>