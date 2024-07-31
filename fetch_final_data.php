
<?php
session_start();
ob_start(); // Start output buffering
// Check if session variables are set
if (!isset($_SESSION['uid'], $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['batchtime'], $_SESSION['batchfee'], $_SESSION['transactionid'])) {
    die("Required session variables are not set.");
}

// Retrieve session variables
$uid = $_SESSION['uid'];
// Now perform the select query
    $sql = "SELECT * FROM final_payment WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['batch_time'] = $row['batch_time'];
        $_SESSION['batch_fee'] = $row['batch_fee'];
        $_SESSION['transactionid'] = $row['payement_id'];

        // Redirect to card.php
        header('Location: card.php');
        exit(); // Make sure to exit after redirection
    } else {
        echo "No records found.";
    }

    // Close the prepared statement
    $stmt->close();


// Close the database connection
$conn->close();
    // Flush output buffer
    ob_end_flush();
?>