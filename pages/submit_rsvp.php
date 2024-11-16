<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $names = $_POST['name'];
    $attendances = $_POST['attending'];
    $menus = $_POST['menu'];
    $dietaries = $_POST['dietary'];

    $conn = new mysqli('localhost', 'root', '', 'wedding-db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($names as $index => $name) {
        $attending = $attendances[$index];
        $menu = $menus[$index];
        $dietary = $dietaries[$index];

        // Check if the name exists on the guest list
        $stmt = $conn->prepare("SELECT id, is_completed FROM rsvps WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

    // Verify guest IDs
    foreach ($_POST['guest_ids'] as $guestId) {
        $stmt = $conn->prepare("SELECT id FROM rsvps WHERE id = ? AND is_completed = FALSE");
        $stmt->bind_param("i", $guestId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "Error: Invalid or already completed RSVP for Guest ID $guestId.";
            continue;
        }
    }

        $guest = $result->fetch_assoc();

        // Check if RSVP is already completed
        if ($guest['is_completed']) {
            echo "Error: RSVP for '$name' has already been submitted.<br>";
            continue; // Skip to the next iteration
        }

        // Update RSVP details and mark as completed
        $updateStmt = $conn->prepare(
            "UPDATE rsvps SET attending = ?, menu = ?, dietary = ?, is_completed = TRUE WHERE id = ?"
        );
        $updateStmt->bind_param("sssi", $attending, $menu, $dietary, $guest['id']);

        if ($updateStmt->execute()) {
            echo "RSVP for '$name' submitted successfully.<br>";
        } else {
            echo "Error: " . $updateStmt->error . "<br>";
        }

        $updateStmt->close();
    }

    $conn->close();
}
?>