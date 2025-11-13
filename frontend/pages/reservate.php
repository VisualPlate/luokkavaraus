<?php
require("../../backend/services/sessions/start.php");

require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");
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
                
              
            
                // Lisätään edellisen kuukauden päivät
                $edellinen_kk_paivat = [27, 28, 29, 30, 31]; // Lokakuu
                foreach ($edellinen_kk_paivat as $paiva) {
                    echo '<div class="day other-month">';
                    echo '    <div class="date-number">' . $paiva . '</div>';
                    echo '</div>';
                }

                // Marraskuun päivät (1-30)
                for ($paiva = 1; $paiva <= 30; $paiva++) {
                    $on_tanaan = ($paiva == 12) ? 'today' : '';
                    
                    echo '<div class="day ' . $on_tanaan . '">';
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
</body>
</html>