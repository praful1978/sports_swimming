<?php
// Database connection details

session_start();

// Check if the form is submitted and the 'batch' key exists in the $_POST array
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['batch'])) {
    // Store the batch information in session
    $_SESSION['batch'] = $_POST['batch'];
    
     

    // Assuming you have a way to retrieve user ID or uid from session
    $uid = $_SESSION['uid']; // Adjust this based on your session handling
    include("connection.php");
// // Prepare and bind the SQL query with a placeholder for the UID
$sql = "SELECT * FROM signup WHERE uid = ?";
$stmt = $conn->prepare($sql);
 
// Bind parameters
$stmt->bind_param("s", $uid); // Assuming $uid is a string, use "i" for integers

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
 
        $age =$row['age'];
        
  // Compare the age and redirect accordingly
  if ($age <= 18) {
    header("Location: batches_under_18.php");
    exit;
} else {
    header("Location: batches_above_18.php");
    exit;
}
    }
}
}
// Close statement
$stmt->close();

// Close connection
$conn->close();
?>