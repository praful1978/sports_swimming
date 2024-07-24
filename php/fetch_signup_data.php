<?php


if (isset($_POST['submit'])) {
    if (isset($_SESSION['UID'])) {
        $uid = $_SESSION['UID'];

        include '../php/connection.php'; // Include database connection

        // Check if the connection was successful
        if (mysqli_errno($conn) == 1062) { // MySQL error code for duplicate entry
            echo "Error: Duplicate entry. This email or mobile number is already registered.";
             
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
 

        // Prepare and bind the SQL statement with a parameterized query
        $sql = "SELECT * FROM signup WHERE uid = ?";
        $stmt = $conn->prepare($sql);
  
        echo $uid;
        if ($stmt) {
            $stmt->bind_param("s", $uid);

            // Execute the query
            $stmt->execute();

            // Get the result set
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch associative array and set session variables
                $row = $result->fetch_assoc();

                // Debug: Print the row to see available keys
                echo '<pre>';
                print_r($row);
                echo '</pre>';
                $_SESSION['uid'] = $row["uid"] ?? null;
                $_SESSION['first_name'] = $row["first_name"] ?? null;
                $_SESSION['last_name'] = $row["last_name"] ?? null;
                $_SESSION['permenent_address'] = $row["permenent_address"] ?? null;
                $_SESSION['mobile_number'] = $row["mobile_number"] ?? null;
                $_SESSION['user_relative'] = $row["user_relative"] ?? null;
                $_SESSION['parents_mobile_number'] = $row["parents_mobile_number"] ?? null;
                $_SESSION['email_address'] = $row["email_address"] ?? null;
                $_SESSION['birth'] = $row["birth"] ?? null;
                $_SESSION['age'] = $row["age"] ?? null;
                $_SESSION['enrol_date'] = $row["enrol_date"] ?? null;
                $_SESSION['expiry_date'] = $row["expiry_date"] ?? null;
       

            } else {
                echo "0 results";
            }

            // Close the prepared statement and connection
            $stmt->close();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        $conn->close();
    } else {
        echo "Session variable 'UID' not set.";
    }

}
?>
