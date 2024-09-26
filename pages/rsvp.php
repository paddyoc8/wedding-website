<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSVP</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet with variables -->
    <link rel="stylesheet" href="../assets/css/layout.css"> <!-- Layout-related styles -->
    <link rel="stylesheet" href="../assets/css/typography.css"> <!-- Typography-related styles -->
</head>
<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- RSVP Form -->
    <div class="container">
        <h1>RSVP</h1>
        <form id="rsvpForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <button type="submit">Submit RSVP</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
    <script src="/assets/js/formHandler.js"></script>
</body>
</html>
