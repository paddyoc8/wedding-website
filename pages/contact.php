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
    <title>Contact Us</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet -->
</head>
<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- Main Content -->
    <main>
        <div class="container card">
            <h1 class="section-title">Contact Us</h1>
            <p class="section-description">
                If you have any questions or need more information, please feel free to contact us.
            </p>
            <p class="section-description">
                <strong>Email:</strong> <a href="mailto:wedding@youremail.com">wedding@youremail.com</a>
            </p>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
</body>
</html>
