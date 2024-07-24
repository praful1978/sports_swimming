<?php
session_start();
$uid=$_SESSION['uid']; //get uid from login_With_uid.php
 
if(isset($_POST['submit'])){
    $first= $_POST['first'];
    $second= $_POST['second'];
    $third= $_POST['third'];
    $fourth= $_POST['fourth'];
    $userOTP = $first . $second . $third . $fourth;

 // Include to get the OTP values from verify_top page.

include 'connection.php'; // Include database connection file.

// Prepare SQL query to select OTP based on UID
// // Prepare and bind the SQL query with a placeholder for the UID
$sql = "SELECT * FROM otp_verification WHERE uid = ?";
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
       $otp = $row["otp"];
       echo $otp;
       // Verify OTP
       if ($otp == $userOTP) {
        // OTP is verified

        echo '<script>alert("OTP is verified");';
        echo 'window.location.href = "upload_documents.php";</script>';
        // Delete OTP from database (for security)
        $delete_query = "DELETE FROM otp_verification WHERE uid = '$uid'";
        mysqli_query($conn, $delete_query);
        exit; // Ensure no further code execution after redirection
    } else {
        // OTP verification failed
        echo '<script>alert("OTP is not verified, Please Enter Correct OTP");';
            echo 'window.location.href = "verify_otp.php";</script>';
            exit; // Ensure no further code execution after redirection
    }
    }
} 

// Close statement
$stmt->close();
}
?>
