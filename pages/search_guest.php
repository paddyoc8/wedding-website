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
    <title>Search Guest</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet -->
</head>
<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- Main Content -->
    <main>
        <div class="container card">
            <h1 class="section-title">Search for a Guest</h1>
            <form action="select_guest.php" method="GET" class="form">
                <div class="form-group">
                    <label for="forename" class="form-label">Forename:</label>
                    <input type="text" id="forename" name="forename" class="form-input" placeholder="Enter forename" required>
                </div>

                <div class="form-group">
                    <label for="surname" class="form-label">Surname:</label>
                    <input type="text" id="surname" name="surname" class="form-input" placeholder="Enter surname" required>
                </div>

                <button type="submit" class="button">Search</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
</body>
</html>
