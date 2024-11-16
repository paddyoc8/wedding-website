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
    <title>Welcome to Our Wedding</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet -->
</head>
<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- Main Content -->
    <main>
        <div class="container card">
            <!-- Welcome Section -->
            <section id="welcome">
                <h1 class="section-title">Welcome to Our Wedding!</h1>
                <p class="section-description">We are so excited to share our special day with you.</p>
            </section>

            <!-- Countdown Timer Section -->
            <section id="countdown" class="card">
                <h2 class="section-title">Countdown to Our Big Day</h2>
                <div id="timer-container">
                    <div id="timer">
                        <!-- Timer content dynamically updated by JavaScript -->
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>

    <!-- Scripts -->
    <script src="../functions/countdown.js"></script>
</body>
</html>
