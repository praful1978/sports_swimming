<?php
session_start();
include("connection.php");
echo $conn;
// Set the uid in session if download button is clicked
if (isset($_POST['download'])) {
    $_SESSION['uid'] = $_POST['uid'];
    // Redirect to the fitness_form_table.php or handle the action accordingly
    header("Location: fitness_form_table.php");
    exit();
}

// Prepare SQL query with placeholder for optional uid filter
$sqluid = "SELECT * FROM signup";
if (isset($_POST['uid']) && !empty($_POST['uid'])) {
    $uid = $_POST['uid'];
    $sqluid .= " WHERE uid = ?";
}

$stmt = $conn->prepare($sqluid);

if (isset($uid)) {
    // Bind the uid parameter
    $stmt->bind_param("s", $uid);
}

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Store the result in the session to pass it to search_data.php
$_SESSION['result'] = [];
while ($row = $result->fetch_assoc()) {
    $_SESSION['result'][] = $row;
}

// Close statement
$stmt->close();

// Redirect to search_data.php after executing the query
header("Location: search_data.php");
exit();
?>
