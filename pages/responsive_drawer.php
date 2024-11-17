
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emma & Patrick</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/updated_responsive_drawer.css">
    <script>
        function toggleDrawer() {
            const drawer = document.querySelector('.drawer');
            drawer.classList.toggle('open');
        }
    </script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="nav-bar">
        <div class="names">Emma & Patrick</div>
        <button class="drawer-toggle" onclick="toggleDrawer()">☰</button>
        <div class="nav-right">
            <ul class="nav-list">
                <li><a href="#wedding">Wedding</a></li>
                <li><a href="#location">Location</a></li>
                <li><a href="#gifts">Gifts</a></li>
            </ul>
            <a href="search_guest.php" class="rsvp-button">RSVP</a>
        </div>
    </nav>

    <!-- Drawer for Small Screens -->
    <div class="drawer">
        <span class="close-btn" onclick="toggleDrawer()">×</span>
        <ul>
            <li><a href="#wedding">Wedding</a></li>
            <li><a href="#location">Location</a></li>
            <li><a href="#gifts">Gifts</a></li>
            <li><a href="search_guest.php" class="rsvp-button">RSVP</a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Emma & Patrick</h1>
            <p>August 1st, 2024 · The Maynard, Grindleford</p>
            <a href="search_guest.php" class="rsvp-button">RSVP</a>
        </div>
    </section>
</body>
</html>
