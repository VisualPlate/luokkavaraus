<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/admincheck/check.php");
require("../../backend/services/db/db.php");

$rm = $_SERVER['REQUEST_METHOD'];
$errors = "";
if ($rm === "POST") {
    $userType = $_POST["type"] ?? null;
    $email = $_POST["email"] ?? null;
    $phoneNum = $_POST["puh"] ?? null;
    $passRaw = $_POST["pass"] ?? null;

    if ($email && $phoneNum && $passRaw) {
        // Use the global PDO instance
        global $pdo;

        try {
            // Check if account already exists (by email OR phone number)
            $checkStmt = $pdo->prepare("SELECT userId FROM users WHERE email = ? OR phoneNum = ?");
            $checkStmt->execute([$email, $phoneNum]);
            $existingUser = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                // Account already exists
                $_SESSION["createdAcc"] = false;
                $errors = "Tili on jo olemassa samalla sähköpostilla tai puhelinnumerolla";
            } else {
                // Create new account
                $passHash = password_hash($passRaw, PASSWORD_BCRYPT);

                $stmt = $pdo->prepare("
                    INSERT INTO users (email, phoneNum, passHash, usertype)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([$email, $phoneNum, $passHash, $userType]);

                $_SESSION["createdAcc"] = true;
            }
        } catch (PDOException $e) {
            $_SESSION["createdAcc"] = false;
            $errors = "Tietokantavirhe: " . $e->getMessage();
        }
    } else {
        $_SESSION["createdAcc"] = false;
        $errors = "Syötekentässä on virheellisiä tietoja";
    }
}

//checks if accounte already created
if (isset($_SESSION["createdAcc"]) && $_SESSION["createdAcc"] === true) {
    unset($_SESSION["createdAcc"]);
    header("location: adminusers.php");
}          

require_once("../includes/htmlHead/htmlHeadPages.php");
?>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Luo Tili</title>
</head>
<body>
    <?php
    require_once("../includes/navbar/navbarUserPages.php");
    ?>


    <div class="a-center">
        <div class="max-600 grid-rows-1 grid-cent container scroll">
            <form method="post">
                <div class="grid-rows-2 mrg-10">
                    <img src="../assets/icons/user-placeholder.svg" style="height:96px">
                    <h1>Luo Tili</h1>
                </div>
                <div class="col">
                    <div class="grid-rows-2 mrg-10">
                        <label for="type">Tyyppi</label>
                        <select name="type" id="type">
                            <option value="student">Oppilas</option>
                            <option value="teacher">Opettaja</option>
                            <option value="admin">Admin</option>
                            <option value="removed">Poistettu</option>
                        </select>
                    </div>
                    <div class="grid-rows-2 mrg-10">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="grid-rows-2 mrg-10">
                        <label for="puh">Puh</label>
                        <input type="puh" name="puh" id="puh" required>
                    </div>
                    <div class="grid-rows-2 mrg-10">
                        <label for="pass">Salasana</label>
                        <input type="password" name="pass" id="pass" required>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="grid-rows-2 mrg-10">
                    <a href="adminusers.php" class="btn-back">Takaisin</a>
                    <button type="submit" class="btn-main">Luo Tili</button>
                </div>
                <?php if (isset($_SESSION["createdAcc"]) && $_SESSION["createdAcc"] === false):?>
                    <h3>Virhe luonnissa: <?=$errors?></h3>
                <?php 
                unset($_SESSION["createdAcc"]);
                endif ?>
            </form>
        </div>
    </div>
</body>
</html>