<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/logincheck/check.php");
require_once("../includes/htmlHead/htmlHeadPages.php");
require_once("../../backend/services/db/db.php");
?>

    <link rel="stylesheet" href="../assets/css/searchPage.css">
    <title>Haku</title>
</head>
<body>
    <?php
        require_once("../includes/navbar/navbarUserPages.php");
    ?>
    <div class="mrg-15 main-content">
        <h1>Luokat</h1>

        <div class="row">

            <!-- <div class="filters-container mrg-15">
                <h2 class="center">Suodattimet</h2>

                <button class="search-btn">Hae</button>
            </div> -->

            <div class='mrg-15 result-container grid-rows-3'>
                <?php
                //get classroom data from database
                $stmt = $pdo->prepare("
                SELECT class.classId, class.classCode, class.floor, reservation.reservationUseDate, reservation.duration 
                FROM class JOIN reservation 
                ON class.classId = reservation.classId");
                $stmt->execute();

                //display a card thingamajig for each classroom
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

                    echo "<div class='result'>
                    
                    <h3 class='result-header'>{$result["classCode"]}</h3>
                    <p class='result-text'>Kerros: {$result["floor"]}</p>
                    <p class='result-text'>Varattu {$result["reservationUseDate"]}, {$result["duration"]} min</p>
                    <div class='col'>
                    <a class='result-btn' href='#'>Varaa</a>
                    </div>
                </div>";
                    
                }
                
                ?>

            </div>
        </div>
    </div>
</body>
</html>