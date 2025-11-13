<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/admincheck/check.php");
require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");

if(isset($_GET["id"])){

    if(!isset($_GET["save"])){
    
        $stmt = $pdo->prepare("SELECT userId, email, phoneNum, usertype FROM users WHERE userId = ?");
        $stmt->execute([$_GET["id"]]);
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }else{

        $stmt = $pdo->prepare("UPDATE users SET email =?, phoneNum=?, usertype=? WHERE userId = ?");
        
        $stmt->execute([$_GET["email"], $_GET["phone"], $_GET["type"], $_GET["id"]]);
        
        header("Location: adminusers.php");
        exit;
    }
}
require_once("../includes/navbar/navbarUserPages.php");

?>
<link rel="stylesheet" href="../assets/css/admin.css">
    <title>Muokkaa käyttäjää</title>
</head>
<body>


    <div class="a-center">
        <div class="max-600 grid-rows-1 grid-cent container">
            <div class="grid-rows-1 mrg-10">
                <h1>Muokkaa käyttäjää</h1>
            </div>
            <form action="">

                <div class="col" id="userdata">
                    
                <label for="email">Sähköposti: </label>
                <input type="email" name="email" id="email" value="<?= $result["email"] ?>">

                <label for="phone">Puhelinnumero: </label>
                <input type="text" name="phone" id="phone" value="<?= $result["phoneNum"] ?>">
                

                
                <label for="type">Tyyppi: </label>
                <select name="type" id="type">
                    <option value="student" <?php if($result["usertype"]=="student")echo 'selected="true"'; ?> >Opiskelija</option>
                    <option value="teacher" <?php if($result["usertype"]=="teacher")echo 'selected="true"'; ?> >Opettaja</option>
                    <option value="admin"   <?php if($result["usertype"]=="admin")echo 'selected="true"'; ?> >Admin</option>
                </select>
                
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                <input type="hidden" name="save" value="true">

                </div>
                
                <div class="mrg-5"></div>
                <div class="divider"></div>
                <div class="grid-rows-2 mrg-10">
                    
                    <a href="adminusers.php" class="btn-main">Kumoa</a>
                    
                    <button class="btn-main">Tallenna</button>
                </div>
                </form>
        </div>
    </div>
</body>
</html>