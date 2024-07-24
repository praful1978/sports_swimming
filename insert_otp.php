<?php
include('connection.php');
// Insert new OTP into the database
    $insert_query = "INSERT INTO otp_verification (uid, otp) VALUES ('$uid', '$userotp')";
    $result = mysqli_query($conn, $insert_query);

    