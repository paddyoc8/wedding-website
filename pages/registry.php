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
    <title>Registry</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet -->
</head>
<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- Main Content -->
    <main>
        <div class="container card">
            <h1 class="section-title">Gift Registry</h1>
            <p class="section-description">
                Thank you for celebrating with us! Our gift registry is currently under construction, but we’ll have it ready soon.
            </p>
            <p class="section-description">
                Check back later for details, or feel free to contact us directly for any questions.
            </p>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
</body>
</html>
