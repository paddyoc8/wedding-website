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
    if (!isset($_GET['guest_ids']) || empty($_GET['guest_ids'])) {
        echo "<h1>Error: No guests selected.</h1>";
        echo "<a href='search_guest.php'>Back to Search</a>";
        exit;
    }

    // Fetch selected guest details
    $guestIds = $_GET['guest_ids']; // Assume safe since we checked its existence
    $placeholders = implode(',', array_fill(0, count($guestIds), '?'));
    $stmt = $conn->prepare("SELECT id, forename, surname FROM rsvps WHERE id IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($guestIds)), ...$guestIds);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<h1>Error: No matching guests found.</h1>";
        echo "<a href='search_guest.php'>Back to Search</a>";
        $conn->close();
        exit;
    }

    $guests = $result->fetch_all(MYSQLI_ASSOC);
    ?>

    <h1>RSVP for Your Family</h1>
    <form action="submit_rsvp.php" method="POST">
        <table id="rsvpTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Attending</th>
                    <th>Menu Selection</th>
                    <th>Dietary Requirements</th>
                    <th>Actions</th>
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
                        <td><button type="button" class="removeRow">-</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit">Submit RSVPs</button>
    </form>

    <?php $conn->close(); ?>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
</body>
</html>
