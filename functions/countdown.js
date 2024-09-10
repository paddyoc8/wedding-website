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