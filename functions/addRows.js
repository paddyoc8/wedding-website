document.addEventListener('DOMContentLoaded', function () {
    const rsvpTable = document.getElementById('rsvpTable').querySelector('tbody');

    // Add a new row to the table
    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('addRow')) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <select name="name[]" required>
                        <option value="">-- Select Name --</option>
                        ${document.querySelector('select[name="name[]"]').innerHTML}
                    </select>
                </td>
                <td>
                    <select name="attending[]" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </td>
                <td>
                    <select name="menu[]" required>
                        <option value="Meat">Meat</option>
                        <option value="Vegetarian">Vegetarian</option>
                    </select>
                </td>
                <td><input type="text" name="dietary[]" placeholder="E.g., Nut allergy"></td>
                <td><button type="button" class="removeRow">-</button></td>
            `;
            rsvpTable.appendChild(newRow);
        }

        // Remove a row from the table
        if (event.target && event.target.classList.contains('removeRow')) {
            event.target.closest('tr').remove();
        }
    });
});