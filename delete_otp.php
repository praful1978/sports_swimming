<?php
include 'session_uid.php';
// Include database connection
include 'connection.php';

// Define variables to store user input and error messages
$uid = $otp = $userOTP = $error = "";
 
// Process form submission
 
    // Sanitize and validate user input

    //  $userOTP = mysqli_real_escape_string($conn, $_POST['user_otp']);

    // Delete old OTP for the user, if any
    $delete_query = "DELETE FROM otp_verification WHERE uid = '$uid'";
    mysqli_query($conn, $delete_query);
