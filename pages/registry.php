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
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet with variables -->
    <link rel="stylesheet" href="../assets/css/layout.css"> <!-- Layout-related styles -->
    <link rel="stylesheet" href="../assets/css/typography.css"> <!-- Typography-related styles -->
</head>
<body>
    <!-- Header -->>
    <?php include  '../components/header.html'; ?>

    <!-- Schedule Section -->
    <section id="registry">
        <h1>Registry</h1>
        <p>Under construction</p>
    </section>

    <!-- Footer -->>
    <?php include  '../components/footer.html'; ?>
</body>
</html>
