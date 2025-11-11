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
     <div class="grid-rows-auto-2 grid-cent max-1200">
        <div class="img-container">
    <img src="../assets/images/loginimg.png" alt="">
        </div>
        <div class="kontti">
    <div class="login-container">
        
        <h1 class = "text-primary">Kirjaudu sisään:</h1>
 
        <form action="">
            <label for="Käyttäjätunnus">Käyttäjätunnus:</label> <br>
        <input type="text" id="username">  <br>
        <label for="Salasana:">Salasana:</label> <br>  
        <input type="password" id="password"> <br>
        <input type="submit" value="kirjaudu" class="submit">
     
        </form>
        
      <a href="frontend/index.php" class="home-icon"><img src="../assets/icons/house-green.svg" alt="etusivulle"></a>
      <a href="admincreateacc.php" class="create-account">Luo tili</a>
    
                <form method="post">
                    <label for="login">Sähköposti tai puhelinnumero:</label> <br>
                    <input type="text" name="login">  <br>
                    <label for="pass">Salasana:</label> <br>  
                    <input type="password" name="pass"> <br>
                    <input type="submit" value="kirjaudu" class="submit">
                </form>
            
                <a href="../" class="home-icon"><img src="../assets/icons/house-green.svg" alt="etusivulle"></a>
            </div>
        </div>
    </div>
        </div>
</div>
</body>
</html>