<?php
session_start();
// Assign session variables to local variables
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$batchtime = $_SESSION['batchtime'];
$batchfee = $_SESSION['batchfee'];
$paymentid = $_SESSION['transactionid'];
ob_start(); // Start output buffering
// Check if the form was submitted
if (isset($_POST["submit"])) {
    // Store form data in session variables
    $_SESSION['uid'] = $_POST['uid'];
    $_SESSION['first_name'] = $_POST['firstname'];
    $_SESSION['last_name'] = $_POST['lastname'];
    $_SESSION['batchtime'] = $_POST['batchtime'];
    $_SESSION['batchfee'] = $_POST['batchfee'];
    $_SESSION['transactionid'] = $_POST['transactionid'];
    echo $_SESSION['uid'];
}

include('connection.php');

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query to fetch user data
$uid = $_POST['uid'];
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
    $permanent_address = $row["permanent_address"];
} else {
    die("No records found for UID: $uid");
}



// Prepare SQL query for insertion
$sql = "INSERT INTO final_payment (uid, first_name, last_name, batch_time, batch_fee, payement_id, permanent_address) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssss", $uid, $first_name, $last_name, $batchtime, $batchfee, $paymentid, $permanent_address);

// Execute the query and check for errors
if ($stmt->execute()) {
    header('Location: card.php');
    exit(); // Make sure to exit after redirection
} else {
    die("Error inserting record: " . $stmt->error);
}

// Close the prepared statement
if ($stmt) {
    $stmt->close();
}

// Close the database connection if it's a valid mysqli object
if ($conn instanceof mysqli) {
    $conn->close();
}
    // Flush output buffer
    ob_end_flush();
?>
