<?php
require_once("../includes/htmlHead/htmlHeadPages.php");
?>

    <link rel="stylesheet" href="../assets/css/searchPage.css">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("../includes/navbar/navbarUserPages.php");
    ?>
    <div class="mrg-15 main-content">
        <h1>Luokat</h1>

        <div class="row">

            <div class="filters-container mrg-15">
                <h2 class="center">Suodattimet</h2>

                <button class="search-btn">Hae</button>
            </div>

            <div class="mrg-15 result-container grid-rows-3">
                
                <div class="result">
                    <div class="col">
                        <img src="../assets/icons/info-green.svg" alt="" class="result-btn">
                        <img src="../assets/icons/burger-menu-green.svg" alt="" class="result-btn">
                    </div>

                    <h3 class="result-header">Luokka</h3>
                    <p class="result-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos ipsum nam totam cumque minima atque soluta molestias accusamus saepe iste!</p>
                </div>

            </div>
        </div>
    </div>
</body>
</html>