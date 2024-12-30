
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
            <form method="GET" action="final_php_with_logic_search_guest.php">
                <input type="text" name="guest_name" placeholder="Enter guest's name" required>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="results-list">
            <h2>Search Results</h2>
            <?php
            if (isset($_GET['guest_name']) && !empty($_GET['guest_name'])) {
                $guest_name = htmlspecialchars($_GET['guest_name']);
                // Example search logic (replace with actual database queries)
                $guests = [
                    ['name' => 'John Doe'],
                    ['name' => 'Jane Smith'],
                    ['name' => 'Alice Johnson']
                ];

                $results = array_filter($guests, function($guest) use ($guest_name) {
                    return stripos($guest['name'], $guest_name) !== false;
                });

                if (!empty($results)) {
                    foreach ($results as $guest) {
                        echo "
                        <div class='result-item'>
                            <p>Guest Name: " . htmlspecialchars($guest['name']) . "</p>
                            <button>Select</button>
                        </div>
                        ";
                    }
                } else {
                    echo "<p>No results found for '{$guest_name}'.</p>";
                }
            } else {
                echo "<p>Please enter a guest name to search.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
