<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/logincheck/check.php");
require("../../backend/services/db/db.php");

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["userid"]) && isset($_GET["reservationid"])){
    $userId = $_GET["userid"];
    $reservationId = $_GET["reservationid"];
    
    $stmt1 = $pdo->prepare("DELETE FROM joinuser WHERE reservationId = ?");
    $stmt1->execute([$reservationId]);

        $stmt2 = $pdo->prepare("DELETE FROM reservation WHERE reservationId = ?");
    $stmt2->execute([$reservationId]);
}

header("Location: reservations.php");
?>