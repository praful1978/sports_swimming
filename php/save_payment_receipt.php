<?php
// Starting the session
session_start();

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $swimmingtime = $_POST['batch_time'];
    $swimmingfee = $_POST['batch_fee'];
    $uid_number = $_POST['uid_number'];

    // Include database connection script
    include 'connection.php'; // Update this path as per your actual file structure

    // SQL query to update the record
    $sql = "UPDATE `final_payment` SET `swimming_time` = ?, `swimming_fee` = ? WHERE `uid` = ?";

    // Initialize the prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters to the placeholders
        $stmt->bind_param('ssi', $swimmingtime, $swimmingfee, $uid_number);

        // Execute the statement
        if ($stmt->execute()) {
        echo "<script>window.location = '/congrats_batch_add.php';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the connection
    $conn->close();
}
?>
   <script>
             document.getElementById("button").onclick = function() {
            window.print();
        }
    </script>
