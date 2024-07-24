<?php
session_start();
include("connection.php");

// Set the uid in session if download button is clicked
if (isset($_POST['download'])) {
    $_SESSION['uid'] = $_POST['uid'];
    // Redirect to the fitness_form_table.php or handle the action accordingly
    header("Location: fitness_form_table.php");
    exit();
}

// Prepare SQL query for search by date
$sql = "SELECT * FROM signup";
$params = [];
$types = "";

// Search by enrol_date
if (isset($_POST['newdate']) && !empty($_POST['newdate'])) {
    $enrol_date = $_POST['newdate'];
    $sql .= " WHERE enrol_date = ?";
    $params[] = $enrol_date;
    $types .= "s";
}

// Search by uid
if (isset($_POST['uid']) && !empty($_POST['uid'])) {
    $uid = $_POST['uid'];
    if (strpos($sql, 'WHERE') !== false) {
        $sql .= " AND uid = ?";
    } else {
        $sql .= " WHERE uid = ?";
    }
    $params[] = $uid;
    $types .= "s";
}

$stmt = $conn->prepare($sql);

if ($params) {
    // Bind the parameters
    $stmt->bind_param($types, ...$params);
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
