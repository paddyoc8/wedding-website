<!DOCTYPE html>
<html lang="en">
<?php include '../components/header.html'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Guest</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/typography.css">
</head>
<body>
    <h1>Search for a Guest</h1>
    <form action="select_guest.php" method="GET">
        <label for="forename">Forename:</label>
        <input type="text" id="forename" name="forename" placeholder="Enter forename" required>

        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" placeholder="Enter surname" required>

        <button type="submit">Search</button>
    </form>
</body>
<?php include '../components/footer.html'; ?>
</html>
