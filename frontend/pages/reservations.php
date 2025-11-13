<?php
//this file is meant to dump all currently logged in data from reservations, so the user can see them
?>
<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/logincheck/check.php");
require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");
?>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Varaukset</title>
</head>
<body>
    <?php
    require_once("../includes/navbar/navbarUserPages.php");
    ?>
    <div class="a-center">
        <div class="max-600 grid-rows-1 grid-cent container">
            <div class="grid-rows-1 mrg-10">
                <h1>Varaukset</h1>
            </div>
            <div class="col scroll" id="list">
                
            </div>
            <script>

                const apiUrl = "../../backend/api/common/api.php?userData=<?=$_SESSION["user_id"]?>";
                
                
                fetchContent();

                async function fetchContent() { 
                    fetch(apiUrl)
                        .then((response) => response.text())
                        .then((text) => searchFromApi(text))
                        .catch(error => console.error('Error:', error));
                }

                function searchFromApi(text) {
                    const row = JSON.parse(text);

                    for (let ri = 0; ri < row.length; ri++) {
                        outputArray = [
                            row[ri].userId,
                            row[ri].reservationId,
                            row[ri].reservationDate,
                            row[ri].reservationUseDate,
                            row[ri].duration,
                            row[ri].classId,
                            row[ri].classCode,
                            row[ri].floor
                        ]

                        const internalOutputDiv = document.createElement("div")

                        const outputDiv = document.getElementById("list");

                        const html = `
                        <div>
                            <div class="row container-secondary space-between w-100">
                                <p>Käyttäjä ID:</p>
                                <p>${outputArray[0]}</p>
                            </div>
                            <div class="row container-secondary space-between w-100">
                                <p>Varaus ID:</p>
                                <p>${outputArray[1]}</p>
                            </div>
                            <div class="row container-secondary space-between w-100">
                                <p>Varaus päivä:</p>
                                <p>${outputArray[2]}</p>
                            </div>
                            <div class="row container-secondary space-between w-100">
                                <p>Varauksen toteutus:</p>
                                <p>${outputArray[3]}</p>
                            </div>
                            <div class="row container-secondary space-between w-100">
                                <p>Kesto:</p>
                                <p>${outputArray[4]}</p>
                            </div>
                            <div class="row container-secondary space-between w-100">
                                <p>Luokan ID:</p>
                                <p>${outputArray[5]}</p>
                            </div>
                            <div class="row container-secondary space-between w-100">
                                <p>Luokan koodi:</p>
                                <p>${outputArray[6]}</p>
                            </div>
                            <div class="row container-secondary space-between w-100">
                                <p>Kerros:</p>
                                <p>${outputArray[7]}</p>
                            </div>
                        </div>
                        </div>
                        <div class="mrg-5"></div>
                        `;
                        internalOutputDiv.innerHTML = html;
                        outputDiv.appendChild(internalOutputDiv);
                    }
                }
            </script>
            <div class="mrg-5"></div>
            </div>
        </div>
    </div>
</body>
</html>