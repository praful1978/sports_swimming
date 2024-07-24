<?php
session_start();
ob_start(); // Start output buffering

include 'connection.php';

$errorMessage = ""; // Initialize error message

if (isset($_POST["submit"])) {
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO responses (uid, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("sssss", $uid, $name, $email, $subject, $message);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        // Registration successful
        header("Location: index.php");
        exit(); // Ensure script stops after redirection
    } else {
        if ($stmt->errno == 1062) { // MySQL error code for duplicate entry
            $errorMessage = "Error: Duplicate entry. This UID number is already registered.";
        } else {
            $errorMessage = "Error updating record: " . $stmt->error;
        }
    }

    // Close the statement
    $stmt->close();
} else {
    $errorMessage = "No form data submitted.";
}

// Close the connection
$conn->close();
ob_end_flush(); // Flush output buffer and send output

if ($errorMessage) {
    echo "<script type='text/javascript'>alert('$errorMessage');</script>";
}
?>
