<?php
require("../../backend/services/sessions/start.php");
require("../../backend/services/db/db.php");
require_once("../includes/htmlHead/htmlHeadPages.php");

// Tarkista että classId on annettu
if (!isset($_GET['classId']) || !is_numeric($_GET['classId'])) {
    header("Location: searchPage.php");
    exit();
}

$classId = intval($_GET['classId']);

// Hae luokan tiedot
$stmt = $pdo->prepare("SELECT classId, classCode, floor FROM class WHERE classId = ?");
$stmt->execute([$classId]);
$class = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$class) {
    header("Location: searchPage.php");
    exit();
}

// Hae kaikki varaukset tälle luokalle marraskuussa 2025
$stmt = $pdo->prepare("
    SELECT 
        r.reservationId,
        r.reservationUseDate,
        r.duration,
        u.userId
    FROM reservation r
    LEFT JOIN joinuser ju ON r.reservationId = ju.reservationId
    LEFT JOIN users u ON ju.userId = u.userId
    WHERE r.classId = ? 
    AND MONTH(r.reservationUseDate) = 11 
    AND YEAR(r.reservationUseDate) = 2025
    ORDER BY r.reservationUseDate, r.duration
");
$stmt->execute([$classId]);
$varaukset = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Järjestä varaukset päivien mukaan
$varaukset_per_paiva = [];
foreach ($varaukset as $varaus) {
    $paiva = intval(date('d', strtotime($varaus['reservationUseDate'])));
    if (!isset($varaukset_per_paiva[$paiva])) {
        $varaukset_per_paiva[$paiva] = [];
    }
    $varaukset_per_paiva[$paiva][] = $varaus;
}

?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varaa luokka <?php echo htmlspecialchars($class['classCode']); ?></title>
    <link rel="stylesheet" href="reservate.css">
</head>
<body>
    <?php require_once("../includes/navbar/navbar.php"); ?>
    
    <div class="container">
        <header>
            <h1>🏫 Luokka <?php echo htmlspecialchars($class['classCode']); ?> - Varauskalenteri</h1>
            <p><?php echo htmlspecialchars($class['floor']); ?>. kerros</p>
            <a href="searchPage.php" class="back-link">← Takaisin hakuun</a>
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
                // Edellisen kuukauden päivät
                $edellinen_kk_paivat = [27, 28, 29, 30, 31]; 
                foreach ($edellinen_kk_paivat as $paiva) {
                    echo '<div class="day other-month">';
                    echo '    <div class="date-number">' . $paiva . '</div>';
                    echo '</div>';
                }

                // Marraskuun päivät (1-30)
                for ($paiva = 1; $paiva <= 30; $paiva++) {
                    $on_tanaan = ($paiva == 13) ? 'today' : '';
                    $varaus_count = isset($varaukset_per_paiva[$paiva]) ? count($varaukset_per_paiva[$paiva]) : 0;
                    
                    echo '<div class="day ' . $on_tanaan . '" onclick="openPopup(' . $paiva . ')">';
                    echo '    <div class="date-number">' . $paiva . '</div>';
                    
                    if ($varaus_count > 0) {
                        echo '    <div class="booking-indicator">';
                        for ($i = 0; $i < min($varaus_count, 5); $i++) {
                            echo '<span class="booking-dot booked"></span>';
                        }
                        echo '    </div>';
                        echo '    <div class="booking-count">' . $varaus_count . ' varausta</div>';
                    }
                    
                    echo '</div>';
                }

                // Seuraavan kuukauden päivät
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
                <span>Ei varauksia</span>
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
        const classId = <?php echo $classId; ?>;
        const varauksetData = <?php echo json_encode($varaukset_per_paiva); ?>;

        function openPopup(paiva) {
            const overlay = document.getElementById('popupOverlay');
            const title = document.getElementById('popupTitle');
            const content = document.getElementById('popupContent');
            
            title.textContent = `Varaukset - ${paiva}.11.2025`;
            
            // Hae päivän varaukset
            const paivanVaraukset = varauksetData[paiva] || [];
            
            let html = '<div class="reservations-list">';
            
            if (paivanVaraukset.length > 0) {
                html += '<h3>Olemassa olevat varaukset:</h3>';
                paivanVaraukset.forEach(varaus => {
                    const aika = varaus.reservationUseDate.split(' ')[1] || varaus.duration;
                    html += `
                        <div class="reservation-item">
                            <span class="reservation-time">⏰ ${aika} (${varaus.duration})</span>
                            <span class="reservation-user">👤 ${varaus.userId || 'Käyttäjä ' + varaus.userId}</span>
                        </div>
                    `;
                });
            } else {
                html += '<p class="no-reservations">Ei varauksia tälle päivälle</p>';
            }
            
            html += '</div>';
            
            // Varauslomake
            html += `
                <div class="new-reservation-form">
                    <h3>Tee uusi varaus:</h3>
                    <form id="reservationForm" onsubmit="submitReservation(event, ${paiva})">
                        <div class="form-group">
                            <label for="reservationTime">Kellonaika:</label>
                            <input type="time" id="reservationTime" name="time" required>
                        </div>
                        <div class="form-group">
                            <label for="duration">Kesto:</label>
                            <select id="duration" name="duration" required>
                                <option value="1h">1 tunti</option>
                                <option value="2h">2 tuntia</option>
                                <option value="3h">3 tuntia</option>
                                <option value="4h">4 tuntia</option>
                            </select>
                        </div>
                        <button type="submit" class="submit-btn">Varaa</button>
                    </form>
                </div>
            `;
            
            content.innerHTML = html;
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function submitReservation(event, paiva) {
            event.preventDefault();
            
            const form = event.target;
            const time = form.time.value;
            const duration = form.duration.value;
            const date = `2025-11-${paiva.toString().padStart(2, '0')} ${time}:00`;
            
            // Lähetä varaus backendiin
            fetch('http://localhost/luokkavaraus/backend/api/common/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                   credentials: 'include',
                body: JSON.stringify({
                    classId: classId,
                    reservationUseDate: date,
                    duration: duration
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Varaus onnistui!');
                    location.reload();
                } else {
                    alert('Virhe: ' + (data.message || 'Varaus epäonnistui'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Virhe varauksen tekemisessä');
            });
        }

        function closePopup(event) {
            if (event && event.target !== document.getElementById('popupOverlay')) {
                return;
            }
            
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePopup();
            }
        });
    </script>
</body>
</html>