<?php
include("connection.php");
// Get POST data
$payment_id = $_POST['payment_id'];
$amount = $_POST['amount'];

// Insert payment details into database
$sql = "INSERT INTO payments (payment_id, amount, status) VALUES ('$payment_id', '$amount', 'Completed')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Payment details saved successfully");';
    echo 'window.location.href = "register_uid_number.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
