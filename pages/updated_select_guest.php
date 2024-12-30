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
<?php include '../components/updated_header.html'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Guest</title>
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/rsvp_style.css">
    <script>
        function toggleDrawer() {
            const drawer = document.querySelector('.drawer');
            drawer.classList.toggle('open');
        }
    </script>
</head>
<body>
<?php
$conn = new mysqli('localhost', 'root', '', 'wedding-db');
if ($conn->connect_error) {
    die("<h1>Database connection failed: " . $conn->connect_error . "</h1>");
}

$forename = $_GET['forename'] ?? '';
$surname = $_GET['surname'] ?? '';
$forename = trim($forename);
$surname = trim($surname);

if (empty($forename) || empty($surname)) {
    echo "<h1>Error: Please enter both forename and surname.</h1>";
    echo "<a href='search_guest.php'>Back to Search</a>";
    exit;
}

$stmt = $conn->prepare("SELECT id, forename, surname, group_id FROM rsvps WHERE forename LIKE CONCAT('%', ?, '%') AND surname LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("ss", $forename, $surname);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h1>No matching guests found for \"$forename $surname\".</h1>";
    echo "<a href='search_guest.php'>Back to Search</a>";
    $stmt->close();
    $conn->close();
    exit;
}

$guests = $result->fetch_all(MYSQLI_ASSOC);

$suggestedGuests = [];
foreach ($guests as $guest) {
    if (!empty($guest['group_id'])) {
        $groupStmt = $conn->prepare("SELECT id, forename, surname FROM rsvps WHERE group_id = ? AND id != ?");
        $groupStmt->bind_param("ii", $guest['group_id'], $guest['id']);
        $groupStmt->execute();
        $groupResult = $groupStmt->get_result();
        $suggestedGuests = array_merge($suggestedGuests, $groupResult->fetch_all(MYSQLI_ASSOC));
        $groupStmt->close();
    }
}
?>

<section>
    <div class="card">
        <h2>Select Guest</h2>
        <p>Matching names for "<strong><?php echo htmlspecialchars("$forename $surname"); ?></strong>":</p>

        <form id="guest-form" action="rsvp.php" method="GET">
            <div id="matching-guests">
                <?php foreach ($guests as $guest): ?>
                    <div class="guest-item" data-id="<?php echo $guest['id']; ?>">
                        <?php echo htmlspecialchars($guest['forename'] . ' ' . $guest['surname']); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($suggestedGuests)): ?>
                <h2>Suggested Linked Guests:</h2>
                <div id="linked-guests">
                    <?php foreach ($suggestedGuests as $suggested): ?>
                        <div class="guest-item" data-id="<?php echo $suggested['id']; ?>">
                            <?php echo htmlspecialchars($suggested['forename'] . ' ' . $suggested['surname']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Hidden input to store selected guest IDs -->
            <input type="hidden" name="guest_ids" id="selected-guests">
            <button type="submit">Next</button>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const guestItems = document.querySelectorAll('.guest-item');
        const selectedGuestsInput = document.getElementById('selected-guests');
        const selectedGuests = new Set();

        // Add click event listener to each guest item
        guestItems.forEach(item => {
            item.addEventListener('click', () => {
                const guestId = item.dataset.id;

                if (selectedGuests.has(guestId)) {
                    // Deselect guest
                    selectedGuests.delete(guestId);
                    item.classList.remove('selected');
                } else {
                    // Select guest
                    selectedGuests.add(guestId);
                    item.classList.add('selected');
                }

                // Update hidden input with selected IDs
                selectedGuestsInput.value = Array.from(selectedGuests).join(',');
            });
        });
    });
</script>

<?php
$stmt->close();
$conn->close();
?>
</body>
<?php include '../components/footer.html'; ?>
</html>



</body>
</html>
