<?php
session_start();
include 'connection.php';


 if (isset($_POST["submit"])) {
    // Store form data in session variables
    $_SESSION['uid'] = $_POST['uid'];
    $_SESSION['first_name'] = $_POST['firstname'];
    $_SESSION['last_name'] = $_POST['lastname'];
    $_SESSION['batchtime'] = $_POST['batchtime'];
    $_SESSION['batchfee'] = $_POST['batchfee'];
    $_SESSION['transactionid'] = $_POST['transactionid'];

    // Assign session variables to local variables
    $uid = $_POST['uid'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $batchtime = $_POST['batchtime'];
    $batchfee = $_POST['batchfee'];
    $paymentid = $_POST['transactionid'];


    // Sanitize input variables
    $uid = $conn->real_escape_string($uid);
    $first_name = $conn->real_escape_string($first_name);
    $last_name = $conn->real_escape_string($last_name);
    $batchtime = $conn->real_escape_string($batchtime);
    $batchfee = $conn->real_escape_string($batchfee);
    $paymentid = $conn->real_escape_string($paymentid);

    // Prepare SQL query
    $sql = "INSERT INTO final_payment (uid, first_name, last_name, batch_time, batch_fee, payement_id) 
            VALUES ('$uid', '$first_name', '$last_name', '$batchtime', '$batchfee', '$paymentid')";

    // Execute SQL query and check for errors
    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        header('Location: card.php');
      
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the database connection
    $conn->close();
}
?>
