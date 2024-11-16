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
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet with variables -->
    <link rel="stylesheet" href="../assets/css/layout.css"> <!-- Layout-related styles -->
    <link rel="stylesheet" href="../assets/css/typography.css"> <!-- Typography-related styles -->
    <link rel="stylesheet" href="../assets/css/swiper.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body>
  <!-- Header -->  
  <?php include '../components/header.html'; ?>

    <!-- Timeline structure -->
    <div class="container">
        <h1 class="title">Responsive Slider Timeline</h1>
        <div class="timeline">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="swiper-slide" style="background-image: url('../assets/images/header.jpg')" data-year="Us">
                <div class="swiper-slide-content">
                  <span class="timeline-year">2011</span>
                  <h4 class="timeline-title">Our nice super title</h4>
                  <p class="timeline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                </div>
              </div>
              
              <div class="swiper-slide" style="background-image: url('../assets/images/maynard.jpg')" data-year="12:30">
                <div class="swiper-slide-content">
                  <span class="timeline-year">12:30</span>
                  <h4 class="timeline-title">Arrival</h4>
                  <p class="timeline-text">The bar will open from 12:30 for guests to arrive.</p>
                </div>
              </div>

            </div>
            <!-- Add Swiper navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
      

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>

</body>

<script>
    var swiper = new Swiper('.swiper-container', {
      direction: 'vertical', // Vertical scrolling
      slidesPerView: 1,
      spaceBetween: 0, // No space between slides
      effect: 'fade', // Enable fade effect
      fadeEffect: {
          crossFade: true, // Smooth fade between slides
      },
      pagination: {
          el: '.swiper-pagination',
          clickable: true,
      },
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      loop: true, // Optional: Enable continuous loop
      keyboard: {
          enabled: true, // Allow keyboard navigation
          onlyInViewport: true,
      },
  });



  </script>
  
</html>
