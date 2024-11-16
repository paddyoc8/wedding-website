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
</head>
<body>
    <!-- Main Content -->
    <main>
        <div class="container card">
            <h1 class="section-title">Enter Password</h1>
            
            <?php if (!empty($error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="" class="form">
                <div class="form-group">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>
                <button type="submit" class="button">Submit</button>
            </form>
        </div>
    </main>

    <?php include '../components/footer.html'; ?>
</body>
</html>
