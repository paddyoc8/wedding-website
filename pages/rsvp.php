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
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Main stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="../functions/addRows.js" defer></script> <!-- Script for table row addition -->
</head>

<body>
    <!-- Header -->
    <?php include '../components/header.html'; ?>

    <!-- Main Content -->
    <main>
        <div class="container card">
            <?php
            // Establish database connection
            $conn = new mysqli('localhost', 'root', '', 'wedding-db');
            if ($conn->connect_error) {
                die("<h1>Database connection failed: " . $conn->connect_error . "</h1>");
            }

            // Check if the RSVP submission was successful
            if (isset($_GET['rsvp_submitted']) && $_GET['rsvp_submitted'] === 'true') {
                echo "<h1 class='section-title'>Thank You for Your RSVP!</h1>";
                echo "<div class='confirmation-message'>";
                echo "<p class='section-description'>We have successfully received your RSVP. We're excited to celebrate with you on our big day!</p>";
                echo "<p class='section-description'>If you need to make any changes, feel free to resubmit your RSVP.</p>";
                echo "<a href='home.php' class='button'>Back to Home</a>";
                echo "</div>";
                $conn->close();
                exit;
            }

            // Check if guest_ids are provided
            $guestIdsString = $_GET['guest_ids'] ?? '';
            $guestIds = array_filter(explode(',', $guestIdsString));

            if (empty($guestIds)) {
                echo "<h1 class='section-title'>Error: No guests selected.</h1>";
                echo "<a href='search_guest.php' class='button'>Back to search</a>";
                exit;
            }

            // Fetch selected guest details and check RSVP status
            $placeholders = implode(',', array_fill(0, count($guestIds), '?'));
            $stmt = $conn->prepare("SELECT id, forename, surname, is_completed FROM rsvps WHERE id IN ($placeholders)");
            $stmt->bind_param(str_repeat('i', count($guestIds)), ...$guestIds);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                echo "<h1 class='section-title'>Error: No matching guests found.</h1>";
                echo "<a href='search_guest.php' class='button'>Back to search</a>";
                $conn->close();
                exit;
            }

            $guests = $result->fetch_all(MYSQLI_ASSOC);

            // Check if any guests have already submitted their RSVP
            $alreadySubmitted = array_filter($guests, function ($guest) {
                return $guest['is_completed'] == 1;
            });

            if (!empty($alreadySubmitted) && !isset($_GET['confirm_resubmit'])) {
                echo "<h1 class='section-title'>RSVP Already Submitted</h1>";
                echo "<div class='card'>";
                echo "<p class='section-description'>Some guests have already submitted their RSVP:</p>";
                echo "<ul class='completed-rsvp-list'>";
                foreach ($alreadySubmitted as $guest) {
                    echo "<li>" . htmlspecialchars($guest['forename'] . ' ' . $guest['surname']) . "</li>";
                }
                echo "</ul>";
                echo "<p class='section-description'>Do you want to resubmit the RSVP for these guests?</p>";
                echo "<a href='rsvp.php?guest_ids=" . htmlspecialchars($guestIdsString) . "&confirm_resubmit=yes' class='button'>Yes</a> ";
                echo "<a href='search_guest.php' class='button'>No</a>";
                echo "</div>";
                $conn->close();
                exit;
            }
            ?>

            <h1 class="section-title">RSVP for you and your selected guests</h1>
            <form action="submit_rsvp.php" method="POST" class="form">
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
                                    <select name="attending[]" class="form-input" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="menu[]" class="form-input" required>
                                        <option value="Meat">Meat</option>
                                        <option value="Vegetarian">Vegetarian</option>
                                    </select>
                                </td>
                                <td><input type="text" name="dietary[]" class="form-input" placeholder="E.g., Nut allergy"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="button">Submit RSVPs</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.html'; ?>
</body>
</html>