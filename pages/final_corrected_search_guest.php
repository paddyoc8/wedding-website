
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Guest</title>
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/search_guest_style.css">
    <script>
        function toggleDrawer() {
            const drawer = document.querySelector('.drawer');
            drawer.classList.toggle('open');
        }
    </script>
</head>
<body>
    <!-- Header -->
    <?php include '../components/Updated_header.html'; ?>

    <div class="page-content">
        <div class="search-bar">
            <h2>Search for a Guest</h2>
            <form method="GET" action="final_corrected_search_guest.php">
                <input type="text" name="guest_name" placeholder="Enter guest's name" required>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="results-list">
            <h2>Search Results</h2>
            <?php
            if (isset($_GET['guest_name']) && !empty($_GET['guest_name'])) {
                $guest_name = htmlspecialchars($_GET['guest_name']);
                $conn = new mysqli('localhost', 'root', '', 'wedding-db');
            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                // Query to search guests by forename or surname
                $stmt = $conn->prepare("SELECT id, forename, surname FROM rsvps WHERE forename LIKE CONCAT('%', ?, '%') OR surname LIKE CONCAT('%', ?, '%')");
                $stmt->bind_param("ss", $guest_name, $guest_name);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if ($result->num_rows > 0) {
                    echo "<div class='results-list'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='result-item'>
                            <p>Guest Name: " . htmlspecialchars($row['forename'] . " " . $row['surname']) . "</p>
                            <form action='select_guest.php' method='GET'>
                                <input type='hidden' name='guest_id' value='" . $row['id'] . "'>
                                <button type='submit'>Select</button>
                            </form>
                        </div>
                        ";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No results found for '{$guest_name}'.</p>";
                }
                $stmt->close();
                $conn->close();
            } else {
                echo "<p>Please enter a guest name to search.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
