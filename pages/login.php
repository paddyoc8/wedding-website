<?php
session_start();

// If the correct password is already in the session, redirect to the home page
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: home.php');
    exit;
}

// Define the common password
$correct_password = "password123"; // Replace with your password

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if ($password === $correct_password) {
        // Store authentication status in session
        $_SESSION['authenticated'] = true;
        header('Location: home.php'); // Redirect to the home page or any desired page
        exit;
    } else {
        $error = "Incorrect password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../components/header.html'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Password</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/layout.css"> <!-- Layout-related styles -->
    <link rel="stylesheet" href="../assets/css/typography.css"> <!-- Typography-related styles -->
</head>
<body>
    <h1>Enter Password</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Submit</button>
    </form>
</body>
<?php include '../components/footer.html'; ?>
</html>
