// Simple form validation or any interactivity can be added here
document.querySelector('form').addEventListener('submit', function(e) {
    alert('Thank you for your RSVP!');
});

function countdown() {
    const weddingDate = new Date("2025-08-01T13:30:00").getTime();
    
    const now = new Date().getTime();
    const timeDifference = weddingDate - now;

    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    // // Update the timer on the page
    // document.getElementById("days").innerText = days;
    // document.getElementById("hours").innerText = hours;
    // document.getElementById("minutes").innerText = minutes;
    // document.getElementById("seconds").innerText = seconds;
    // Combine all into one string
    const countdownText = `${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds`;

    // Update the timer div with the countdown text
    document.getElementById("timer").innerText = countdownText;

    // If countdown is finished, show a message
    if (timeDifference < 0) {
        document.getElementById("timer").innerHTML = "The big day has arrived!";
    }
}

// Call countdown every second
setInterval(countdown, 1000);

var timelineSwiper = new Swiper ('.timeline .swiper-container', {
    direction: 'vertical',
    loop: false,
    speed: 1600,
    pagination: '.swiper-pagination',
    paginationBulletRender: function (swiper, index, className) {
      var year = document.querySelectorAll('.swiper-slide')[index].getAttribute('data-year');
      return '<span class="' + className + '">' + year + '</span>';
    },
    paginationClickable: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    breakpoints: {
      768: {
        direction: 'horizontal',
      }
    }
  });