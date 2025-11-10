<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/admincheck/check.php");
require("../../backend/services/db/db.php");
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
        <div class="max-600 grid-rows-1 grid-cent container">
            <div class="grid-rows-1 mrg-10">
                <h1>Käyttäjät</h1>
            </div>
            <div class="col scroll" id="list">
                <div class="row space-between">
                    <p>user1</p>
                    <div class="row container-secondary space-between w-50">
                        <a href="#">Tiedot</a>
                        <a href="#">Muokkaa</a>
                        <a href="#">Poista</a>
                    </div>
                </div>
                <div class="mrg-5"></div>
            </div>
            <script>
                const apiUrl = "../../backend/api/admin/api.php";
                //not ready
                async function fetchContent() {
                    const res = fetch(apiUrl) {
                        .
                    }   
                }

                const list = document.getElementById("list");
            </script>
            <div class="mrg-5"></div>
            <div class="divider"></div>
            <div class="grid-rows-2 mrg-10">
                <div>
                </div>
                <a href="admincreateacc.php" class="btn-main">Luo Uusi</a>
            </div>
        </div>
    </div>
</body>
</html>