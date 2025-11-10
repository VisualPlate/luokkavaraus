<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/admincheck/check.php");

require_once("../includes/htmlHead/htmlHeadPages.php");
require("../../backend/services/db/db.php");
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
            </form>
        </div>
    </div>
</body>
</html>
<?php
$rm = $_SERVER['REQUEST_METHOD'];
if ($rm === "POST") {
    $userType = $_POST["type"] ?? null;
    $email = $_POST["email"] ?? null;
    $phoneNum = $_POST["puh"] ?? null;
    $pass = password_hash($_POST["pass"] ?? null, PASSWORD_BCRYPT);

    if ($email !== null && $phoneNum !== null && $pass !== null) {
        //#TOSQLCOMMAND
        $stmt = $pdo->prepare("INSERT INTO users ( email, phoneNum, passHash, usertype) VALUES (?,?,?,?)");
        $stmt->execute([$email, $phoneNum, $pass, $userType]);
        $_SESSION["createdAcc"] = true;
    }
}
?>