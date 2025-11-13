<?php
require("../../backend/services/sessions/start.php");

require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");

//Päivien mukaan
$varaukset_per_paiva = [];


?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luokkavarauskalenteri</title>
   <link rel="stylesheet" href="reservate.css">
   
</head>
<body>
    <?php
    require_once("../includes/navbar/navbar.php")
    ?>
    <div class="container">
        <header>
            <h1>🏫 Luokkavarauskalenteri</h1>
        </header>

        <div class="calendar-header">
            <div class="month-year">Marraskuu 2025</div>
        </div>

        <div class="calendar-grid">
            <div class="weekdays">
                <div class="weekday">Ma</div>
                <div class="weekday">Ti</div>
                <div class="weekday">Ke</div>
                <div class="weekday">To</div>
                <div class="weekday">Pe</div>
                <div class="weekday">La</div>
                <div class="weekday">Su</div>
            </div>

            <div class="days">
                <?php
                // Backend
                
              
            
                // edellisen kuukauden päivät
                $edellinen_kk_paivat = [27, 28, 29, 30, 31]; 
                foreach ($edellinen_kk_paivat as $paiva) {
                    echo '<div class="day other-month">';
                    echo '    <div class="date-number">' . $paiva . '</div>';
                    echo '</div>';
                }

                // päivät (1-30)
                for ($paiva = 1; $paiva <= 30; $paiva++) {
                    $on_tanaan = ($paiva == 13) ? 'today' : '';
                    
                    echo '<div class="day ' . $on_tanaan . '" onclick="openPopup(' . $paiva . ')">';
                    echo '    <div class="date-number">' . $paiva . '</div>';
                    
                    if (isset($varaukset_per_paiva[$paiva])) {
                        $vapaa = $varaukset_per_paiva[$paiva]['vapaa'];
                        $varattu = $varaukset_per_paiva[$paiva]['varattu'];
                        
                        echo '    <div class="booking-indicator">';
                        for ($i = 0; $i < $vapaa; $i++) {
                            echo '<span class="booking-dot available"></span>';
                        }
                        for ($i = 0; $i < $varattu; $i++) {
                            echo '<span class="booking-dot booked"></span>';
                        }
                        echo '    </div>';
                        echo '    <div class="booking-count">' . ($vapaa + $varattu) . ' varausta</div>';
                    }
                    
                    echo '</div>';
                }

                // Lisätään seuraavan kuukauden päivät täyttämään viimeinen viikko
                for ($paiva = 1; $paiva <= 7; $paiva++) {
                    echo '<div class="day other-month">';
                    echo '    <div class="date-number">' . $paiva . '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="legend">
            <div class="legend-item">
                <div class="legend-color available"></div>
                <span>Vapaa varaus</span>
            </div>
            <div class="legend-item">
                <div class="legend-color booked"></div>
                <span>Varattu</span>
            </div>
        </div>
    </div>

    <!-- Popup-paneeli -->
    <div id="popupOverlay" class="popup-overlay" onclick="closePopup(event)">
        <div class="popup-panel" onclick="event.stopPropagation()">
            <div class="popup-header">
                <h2 id="popupTitle">Varaukset - </h2>
                <button class="close-btn" onclick="closePopup()">&times;</button>
            </div>
            <div class="popup-content" id="popupContent">
                <!-- Varaukset ladataan tähän dynaamisesti -->
            </div>
        </div>
    </div>

    <script>
        function openPopup(paiva) {
            const overlay = document.getElementById('popupOverlay');
            const title = document.getElementById('popupTitle');
            const content = document.getElementById('popupContent');
            
            // Aseta otsikko
            title.textContent = `Varaukset - ${paiva}.11.2025`;
            
            // TODO: Hae varaukset backendista AJAX:lla
            // Tässä esimerkki staattisella datalla
            
            
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup(event) {
            if (event && event.target !== document.getElementById('popupOverlay')) {
                return;
            }
            
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Sulje popup ESC-näppäimellä
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePopup();
            }
        });
    </script>
</body>
</html>