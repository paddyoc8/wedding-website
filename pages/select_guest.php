<!DOCTYPE html>
<html lang="en">
<?php include '../components/header.html'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Guest</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/typography.css">
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

<h1>Select Guest</h1>
<form action="rsvp.php" method="GET">
    <p>Matching names for "<?php echo htmlspecialchars("$forename $surname"); ?>":</p>
    <ul>
        <?php foreach ($guests as $guest): ?>
            <li>
                <input type="checkbox" name="guest_ids[]" value="<?php echo $guest['id']; ?>">
                <?php echo htmlspecialchars($guest['forename'] . ' ' . $guest['surname']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if (!empty($suggestedGuests)): ?>
        <h2>Suggested Linked Guests:</h2>
        <ul>
            <?php foreach ($suggestedGuests as $suggested): ?>
                <li>
                    <input type="checkbox" name="guest_ids[]" value="<?php echo $suggested['id']; ?>">
                    <?php echo htmlspecialchars($suggested['forename'] . ' ' . $suggested['surname']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <button type="submit">Next</button>
</form>
<?php
$stmt->close();
$conn->close();
?>
</body>
<?php include '../components/footer.html'; ?>
</html>
