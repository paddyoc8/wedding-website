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
    <title>RSVP</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet with variables -->
    <link rel="stylesheet" href="../assets/css/layout.css"> <!-- Layout-related styles -->
    <link rel="stylesheet" href="../assets/css/typography.css"> <!-- Typography-related styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="../functions/addRows.js" defer></script> <!-- Script for table row addition -->
</head>

<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <?php
    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'wedding-db');
    if ($conn->connect_error) {
        die("<h1>Database connection failed: " . $conn->connect_error . "</h1>");
    }

    // Check if guest_ids are provided
    $guestIdsString = $_GET['guest_ids'] ?? ''; // Get the guest_ids string
    $guestIds = array_filter(explode(',', $guestIdsString)); // Convert the string to an array and filter empty values

    if (empty($guestIds)) {
        echo "<h1>Error: No guests selected.</h1>";
        echo "<a href='search_guest.php'>Back to Search</a>";
        exit;
    }

    // Fetch selected guest details and check RSVP status
    $placeholders = implode(',', array_fill(0, count($guestIds), '?')); // Create placeholders for SQL IN clause
    $stmt = $conn->prepare("SELECT id, forename, surname, is_completed FROM rsvps WHERE id IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($guestIds)), ...$guestIds); // Bind guest IDs dynamically
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<h1>Error: No matching guests found.</h1>";
        echo "<a href='search_guest.php'>Back to Search</a>";
        $conn->close();
        exit;
    }

    $guests = $result->fetch_all(MYSQLI_ASSOC);

    // Check if any guests have already submitted their RSVP
    $alreadySubmitted = array_filter($guests, function ($guest) {
        return $guest['is_completed'] == 1;
    });

    if (!empty($alreadySubmitted) && !isset($_GET['confirm_resubmit'])) {
        echo "<h1>Some guests have already submitted their RSVP:</h1>";
        echo "<ul>";
        foreach ($alreadySubmitted as $guest) {
            echo "<li>" . htmlspecialchars($guest['forename'] . ' ' . $guest['surname']) . "</li>";
        }
        echo "</ul>";
        echo "<p>Do you want to resubmit the RSVP for these guests?</p>";
        echo "<a href='rsvp.php?guest_ids=" . htmlspecialchars($guestIdsString) . "&confirm_resubmit=yes' class='button'>Yes</a> ";
        echo "<a href='search_guest.php' class='button'>No</a>";
        $conn->close();
        exit;
    }
    ?>

    <div class="card">
        <h1>RSVP for You and Your Selected Guests</h1>
        <form action="submit_rsvp.php" method="POST">
            <table id="rsvpTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Attending</th>
                        <th>Menu Selection</th>
                        <th>Dietary Requirements</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guests as $guest): ?>
                        <tr>
                            <td>
                                <input type="hidden" name="guest_ids[]" value="<?php echo $guest['id']; ?>">
                                <?php echo htmlspecialchars($guest['forename'] . ' ' . $guest['surname']); ?>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="button">Submit RSVPs</button>
        </form>
    </div>


    <?php $conn->close(); ?>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
</body>
</html>
