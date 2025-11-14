<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/admincheck/check.php");
require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");
?>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Admin Hallinta</title>
</head>
<body>
    <?php
    require_once("../includes/navbar/navbarUserPages.php");
    ?>
    <div class="a-center">
        <div class="max-600 grid-rows-1 grid-cent container">
            <div class="grid-rows-1 mrg-10">
                <h1>Admin Hallinta</h1>
            </div>
            <div class="col scroll" id="list">
                <div class="row container-secondary space-between w-100">
                    <a href="adminusers.php">Käyttäjät</a>
                    <a href="admincheckreservations.php">Käyttäjien Varaukset</a>
                </div>
                <div class="row container-secondary space-between w-100">
                    <a href="admincreateacc.php">Luo Uusi Käyttäjä</a>
                </div>
            </div>
            
            <div class="mrg-5"></div>
            <div class="divider"></div>
            <div class="grid-rows-2 mrg-10"><div>
                
            </div>
            </div>
                <a href="searchPage.php" class="btn-main">Takaisin</a>
        </div>
    </div>
</body>
</html>