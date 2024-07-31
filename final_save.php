<?php
session_start();
include 'connection.php';

// Ensure the database connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from session
$uid = $_SESSION['uid'] ?? null;
if (!$uid) {
    die("No user ID found in session.");
}

// Prepare and execute the SELECT query to retrieve user information
$sql = "SELECT * FROM signup WHERE uid = ?";
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
} else {
    die("No user found with the provided ID.");
}

// Retrieve session variables
$uid = $_SESSION['uid'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$batchtime = $_POST['batchtime'] ?? '';
$batchfee = $_POST['batchfee'] ?? '';
$paymentid = $_POST['transactionid'] ?? '';

// Prepare and execute the INSERT statement
$sql = "INSERT INTO final_payment (uid, first_name, last_name, batch_time, batch_fee, payment_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);


$stmt->bind_param("ssssss", $uid, $first_name, $last_name, $batchtime, $batchfee, $paymentid);

if ($stmt->execute()) {
    // Success message or redirection
    header("Location: card.php");
    exit(); // Ensure no further code is executed
} else {
    die("Error inserting record: " . $stmt->error);
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
