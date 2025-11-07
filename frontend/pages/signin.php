<?php
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
        <input type="text" id="password"> <br>
        <input type="submit" value="kirjaudu" class="submit">
     
        </form>
        
      <a href="" class="home-icon"><img src="../assets/icons/house-green.svg" alt="etusivulle"></a>
      <a href="" class="create-account">Luo tili</a>
    
    </div>
        </div>
</div>
</body>
</html>