document.addEventListener('DOMContentLoaded', function () {
    // Store forename options by surname
    const forenamesBySurname = JSON.parse(document.getElementById('forenamesBySurnameData').textContent);

    const surnameDropdown = document.getElementById('surname');
    const forenameDropdown = document.getElementById('forename');

    // Initialize Select2 on both dropdowns
    $(surnameDropdown).select2({
        placeholder: "Search and Select Surname",
        allowClear: true
    });

    $(forenameDropdown).select2({
        placeholder: "Search and Select Forename",
        allowClear: true
    });

    // Listen for changes on the surname dropdown
    surnameDropdown.addEventListener('change', function () {
        const selectedSurname = surnameDropdown.value;

        // Clear existing forename options
        forenameDropdown.innerHTML = '<option value="">-- Select Forename --</option>';

        if (selectedSurname && forenamesBySurname[selectedSurname]) {
            // Populate forename dropdown with matching options
            forenamesBySurname[selectedSurname].forEach(forenameObj => {
                const option = document.createElement('option');
                option.value = forenameObj.id; // Use RSVP ID as the value
                option.textContent = forenameObj.forename;
                forenameDropdown.appendChild(option);
            });
            forenameDropdown.disabled = false;
        } else {
            // Disable forename dropdown if no surname selected
            forenameDropdown.disabled = true;
        }

        // Reinitialize Select2 for updated forename options
        $(forenameDropdown).select2({
            placeholder: "Search and Select Forename",
            allowClear: true
        });
    });
});