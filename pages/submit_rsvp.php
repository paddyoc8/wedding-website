<?php
session_start();

// If the user is not authenticated, redirect to the password page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all expected form fields are set
    $guestIds = $_POST['guest_ids'] ?? [];
    $attendances = $_POST['attending'] ?? [];
    $menus = $_POST['menu'] ?? [];
    $dietaries = $_POST['dietary'] ?? [];

    // Check if any required field is missing
    if (empty($guestIds) || empty($attendances) || empty($menus)) {
        echo "Error: Missing required fields.";
        exit;
    }

    $conn = new mysqli('localhost', 'root', '', 'wedding-db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($guestIds as $index => $guestId) {
        $attending = $attendances[$index] ?? null;
        $menu = $menus[$index] ?? null;
        $dietary = $dietaries[$index] ?? '';

        // Skip if any field is missing for a guest
        if (!$attending || !$menu) {
            continue;
        }

        // Update RSVP details
        $stmt = $conn->prepare("UPDATE rsvps SET attending = ?, menu = ?, dietary = ?, is_completed = TRUE WHERE id = ?");
        $stmt->bind_param("sssi", $attending, $menu, $dietary, $guestId);

        if (!$stmt->execute()) {
            echo "Error: Could not update RSVP for guest ID $guestId - " . $stmt->error;
        }
    }

    // Redirect back to the rsvp.php page with a success message
    header("Location: rsvp.php?rsvp_submitted=true");
    exit;
}
?>
