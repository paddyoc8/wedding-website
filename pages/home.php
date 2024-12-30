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
    <title>Emma & Patrick</title>
    <link rel="stylesheet" href="../assets/css/core.css">
    <script>
        function toggleDrawer() {
            const drawer = document.querySelector('.drawer');
            drawer.classList.toggle('open');
        }
    </script>
</head>
<body>
    <!-- Header -->
    <?php include '../components/updated_header.html'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Emma & Patrick</h1>
            <p>August 1st, 2025 · The Maynard, Grindleford</p>
            <a href="select_guest.php" class="rsvp-button">RSVP</a>
        </div>
    </section>
</body>
</html>
