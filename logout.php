<?php
// session_start();  // Start the session if not already started
// if (isset($_SESSION['uid'])) {
//     $uid = $_SESSION['uid'];
// } else {
//     // Handle the case where $_SESSION['uid'] is not set
//     // You might want to redirect or show an error message
//     exit("Session variable 'uid' is not set.");
// }

// include("connection.php");
 
// $current_date = date('Y-m-d H:i:s');
// $sql = "UPDATE logout SET mobile_number = ?, logout_date_time = ? WHERE uid = ?";
// // Prepare the statement
// $stmt = mysqli_prepare($conn, $sql);
// if ($stmt) {
//     // Bind variables to the prepared statement as parameters
//     mysqli_stmt_bind_param($stmt, "sss", $current_date, $uid);
    
//     // Set the variables
//     $mobile_number = "your_mobile_number";  // Replace with your actual mobile number variable
//     $current_date = date('Y-m-d H:i:s');
//     $uid = $_SESSION['uid'];  // Assuming you retrieved uid from session correctly
    
//     // Execute the statement
//     mysqli_stmt_execute($stmt);
    
//     echo "Record updated successfully";
// } else {
//     echo "Error: " . mysqli_error($conn);
// }
header('location: index.html');
?>
 