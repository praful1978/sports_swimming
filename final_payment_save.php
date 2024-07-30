<?php
 if (isset($_POST["submit"])) {
    // Store form data in session variables
    $_SESSION['uid'] = $_POST['uid'];
    $_SESSION['first_name'] = $_POST['firstname'];
    $_SESSION['last_name'] = $_POST['lastname'];
    $_SESSION['batchtime'] = $_POST['batchtime'];
    $_SESSION['batchfee'] = $_POST['batchfee'];
    $_SESSION['transactionid'] = $_POST['transactionid'];
 
 }
 
 include('connection.php');
 $uid = $_POST['uid'];
$sql = "SELECT * FROM signup WHERE uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $uid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $uid = $row['uid'];
    $permanent_address = $row["permanent_address"];

} else {
    echo "0 results";
}
    // Assign session variables to local variables
    $uid = $_POST['uid'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $batchtime = $_POST['batchtime'];
    $batchfee = $_POST['batchfee'];
    $paymentid = $_POST['transactionid'];
    $permanent_address =$_SESSION['permanent_address'];
    // Prepare SQL query
    $sql = "INSERT INTO final_payment (uid, first_name, last_name, batch_time, batch_fee, payement_id,permanent_address) 
            VALUES ('$uid', '$first_name', '$last_name', '$batchtime', '$batchfee', '$paymentid','$permanent_address')";

    // Execute SQL query and check for errors
    if ($conn->query($sql) === TRUE) {

        header('Location: card.php');
      
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the database connection
    $conn->close();
// }
?>
