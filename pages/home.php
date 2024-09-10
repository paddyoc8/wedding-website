<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Wedding</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- Hero Header Section -->
    <header id="hero">
        <div class="overlay">
            <h1>Emma and Patrick</h1>
            <p>Join us on August 1st, 2025</p>
        </div>
    </header>

    <!-- Welcome Section -->
    <section id="welcome">
        <h1>Welcome to Our Wedding!</h1>
        <p>We are so excited to share our special day with you.</p>
    </section>

    <!-- Countdown Timer Section -->
    <section id="countdown">
        <h2>Countdown to Our Big Day</h2>
        <div id="timer">
            <!-- <div><span id="days"></span> days</div>
            <div><span id="hours"></span> hours</div>
            <div><span id="minutes"></span> minutes</div>
            <div><span id="seconds"></span> seconds</div> -->
            <div id="timer"></div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>

    <script src="../functions/countdown.js"></script>

</body>
</html>
