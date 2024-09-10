async function fetchEventData() {
    try {
      const response = await fetch('/content/data/events.json');
      const data = await response.json();
      console.log(data);
    } catch (error) {
      console.error('Error fetching event data:', error);
    }
  }
  fetchEventData();
  