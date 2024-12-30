const API_URL = "https://script.google.com/macros/s/AKfycbwM7bpWh32Z9zGOYB7t5R4kX_jCjE8MAFRhP3w_ZemGzNZcOaC2lB9CAuUWjwXca-1vHA/exec";

function fetchRSVPs() {
    fetch(`${API_URL}`)
        .then(response => response.json())
        .then(data => {
            console.log("RSVPs:", data);
            // Render RSVP data in a table or UI
        })
        .catch(error => console.error("Error fetching RSVPs:", error));
}

function submitRSVP(formData) {
    fetch(`${API_URL}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.text())
        .then(data => console.log("RSVP submitted:", data))
        .catch(error => console.error("Error submitting RSVP:", error));
}
