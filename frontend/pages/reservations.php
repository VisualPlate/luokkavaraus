<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/logincheck/check.php");
require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");
?>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Varatut</title>
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
                
            </div>
            <script>

                const apiUrl = "../../backend/api/common/api.php?user=<?=$_SESSION('user_id')?> ";
                
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
                            
                            row[ri].phoneNum,
                            row[ri].usertype
                        ]
            
                       
                            const internalOutputDiv = document.createElement("div")

                            const outputDiv = document.getElementById("list");
                            for (let i = 0; i < outputArray.length; i++) {           
                                const newParagraph = document.createElement("p")
                                const outputText = outputArray[i]
                                newParagraph.textContent = outputText
                                outputDiv.appendChild(internalOutputDiv)
                                internalOutputDiv.appendChild(newParagraph)
                            }

                            const html = `
                            <div class="row container-secondary space-between w-100">
                                <a href="adminedit.php?id=${outputArray[0]}">Muokkaa</a>
                                <a href="admindelete.php?id=${outputArray[0]}">Poista</a>
                            </div>
                            </div>
                            <div class="mrg-5"></div>
                            `;
                            internalOutputDiv.innerHTML += html;
                        
                        }
                    }
                
            </script>
            <div class="mrg-5"></div>
            <div class="divider"></div>
            <div class="grid-rows-2 mrg-10">
                
            </div>
        </div>
    </div>
</body>
</html>