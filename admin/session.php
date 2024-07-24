<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Example</title>
</head>
<body>
    <form method="post" action="">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Submit</button>
    </form>

    <?php
    // Step 2: Start the session and handle form submission
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
        // Sanitize the input to avoid XSS attacks
        $name = htmlspecialchars($_POST['name']);
        // Store the name in the session
        $_SESSION['name'] = $name;
    }

    // Step 3: Display the name if it is set in the session
    if (isset($_SESSION['name'])) {
        echo "<p>Hello, " . $_SESSION['name'] . "!</p>";
    }
    ?>
</body>
</html>
