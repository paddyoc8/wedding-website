<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Schedule</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet with variables -->
    <link rel="stylesheet" href="../assets/css/layout.css"> <!-- Layout-related styles -->
    <link rel="stylesheet" href="../assets/css/typography.css"> <!-- Typography-related styles -->
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body>
  <!-- Header -->  
  <?php include '../components/header.html'; ?>

    <!-- Schedule Section
    <section id="schedule">
        <h1>Wedding Schedule</h1>
        <ul>
            <li><strong>Bar opens:</strong> 12:30 PM.</li>
            <li><strong>Ceremony:</strong> 13:30 PM in the Chatsworth Suite.</li>
            <li><strong>Drinks reception:</strong> 14:00 PM in the garden.</li>
            <li><strong>Wedding breakfast:</strong> 16:00 PM in Chatsworth Suite.</li>
        </ul>
    </section> -->

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
      slidesPerView: 1,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
  
</html>
