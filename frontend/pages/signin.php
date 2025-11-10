<?php
require("../../backend/services/sessions/start.php");

if (isset($_SESSION["logged_in"])) {
    header("location: searchpage.php");
    exit;
}
require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");
?>
<head>
    <title>Kirjaudu sisään</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <?php
    $rm = $_SERVER["REQUEST_METHOD"];
    if ($rm === "POST") {
        $emailOrPhone = $_POST["login"] ?? null; // user can use email or phone
        $password = $_POST["pass"] ?? null;

        if ($emailOrPhone && $password) {
            // Prepare SQL to check either email or phone
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR phoneNum = ?");
            $stmt->execute([$emailOrPhone, $emailOrPhone]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["passHash"])) {
                // Password is correct — start session
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["usertype"] = $user["usertype"];

                header("Location: searchpage.php");
                exit;
            }
        }
    }
    ?>
     <div class="grid-rows-auto-2 grid-cent max-1200">
        <div class="img-container">
            <img src="../assets/images/loginimg.png" alt="">
        </div>
        <div class="kontti">
            <div class="login-container">
        
                <h1 class = "text-primary">Kirjaudu sisään:</h1>
    
                <form method="post">
                    <label for="login">Sähköposti tai puhelinnumero:</label> <br>
                    <input type="text" name="login">  <br>
                    <label for="pass:">Salasana:</label> <br>  
                    <input type="password" name="pass"> <br>
                    <input type="submit" value="kirjaudu" class="submit">
                </form>
            
                <a href="../" class="home-icon"><img src="../assets/icons/house-green.svg" alt="etusivulle"></a>
            </div>
        </div>
    </div>
</body>
</html>