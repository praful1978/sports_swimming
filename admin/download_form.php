<?php
session_start();

if (isset($_SESSION['uid'])) {
  echo $uid =  $_SESSION['uid'];
    echo "<p>Hello, " . htmlspecialchars($_SESSION['uid']) . "!</p>";
} else {
    echo "<p>No UID set in session.</p>";
}

 
include("../php/connection.php");
// // Prepare and bind the SQL query with a placeholder for the UID

// Prepare the SQL query with a placeholder for the UID
$sql = "SELECT * FROM signup WHERE uid = ?";
 
// $sql = "SELECT * FROM signup WHERE uid = ?";
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
        echo "uid: " . $row["uid"]. " - mobile_number: " . $row["mobile_number"]. "<br>";
        $first_name =$row['first_name'];
        $last_name =$row['last_name'];
        $gender =$row['gender'];
        $blood_group =$row['blood_group'];
        $date_of_birth =$row['birth'];
        $mobile_number =$row['mobile_number'];

        $email_address =$row['email_address'];
        $date_of_birth =$row['birth'];
        $permanent_address =$row['permanent_address'];
        $parents_mobile_number =$row['parents_mobile_number'];
     
        $age = $row['age'];
 
        // You can output other columns as needed
    }
} else {
    echo "0 results";
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>