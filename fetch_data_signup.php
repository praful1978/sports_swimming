
<?php
session_start();


// Retrieve session variables
$uid = $_SESSION['uid'];
// Now perform the select query
    $sql = "SELECT * FROM signup WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];


        // Redirect to card.php
        header('Location: final_save.php');

    } else {
        echo "No records found.";
    }

    // Close the prepared statement
    $stmt->close();


// Close the database connection
$conn->close();

?>