<?php
session_start();

// If the user is not authenticated, redirect to the password page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Schedule</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet -->
</head>
<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- Main Content -->
    <main>
        <div class="container card">
            <h1 class="section-title">Wedding Schedule</h1>
            <div class="simple-timeline">
                <!-- Timeline Item 1 -->
                <div class="timeline-item">
                    <span class="timeline-time">12:30</span>
                    <div class="timeline-content">
                        <h3>Arrival</h3>
                        <p>The bar will open from 12:30 for guests to arrive.</p>
                    </div>
                </div>
                <!-- Timeline Item 2 -->
                <div class="timeline-item">
                    <span class="timeline-time">13:30</span>
                    <div class="timeline-content">
                        <h3>Ceremony</h3>
                        <p>The wedding ceremony begins at 1:30 PM sharp.</p>
                    </div>
                </div>
                <!-- Timeline Item 3 -->
                <div class="timeline-item">
                    <span class="timeline-time">15:00</span>
                    <div class="timeline-content">
                        <h3>Reception</h3>
                        <p>Enjoy a delightful reception with drinks and hors d'oeuvres.</p>
                    </div>
                </div>
                <!-- Timeline Item 4 -->
                <div class="timeline-item">
                    <span class="timeline-time">18:00</span>
                    <div class="timeline-content">
                        <h3>Dinner</h3>
                        <p>The dinner will be served in the main hall.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
</body>
</html>
