<?php
session_start();

// Check if uid is set and not empty
if (isset($_POST['uid']) && !empty($_POST['uid'])) {
    $uid = $_POST['uid']; // get uid from login_With_uid.php
echo $uid;
    include 'connection.php';

    // Prepare and bind the SQL statement with a parameterized query
    $sql = "SELECT * FROM signup WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $uid);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Check if there is a row with matching uid
        if ($result->num_rows > 0) {
            // Fetch associative array and set session variables
            $row = $result->fetch_assoc();
            
            // Set session variable
            $_SESSION['uid'] = $row["uid"];

            // Optionally, you can set other session variables if needed
            // $_SESSION['username'] = $row["username"];
            // $_SESSION['email'] = $row["email"];
               header('Location: sendotp.php') ;

         } else {
            echo '<script type="text/javascript">'; 
            echo 'alert("Your Enter Wrong UID. Please Enter Correct UID");'; 
            echo 'window.location.href = "login_with_uid.php"';
            echo '</script>';

            // // You can handle what happens if no user is found, such as showing an error message or redirecting back to the login page
            // echo "<script>if(confirm('Your Enter Wrong UID. Please Enter Correct UID'){window.location.href='login_with_uid.php'};</script>";   
        }
    } else {
        echo "Error in preparing SQL statement.";
        // Handle the case where prepare() fails
    }
} else {
    echo "No username input found or UID is empty. No post sent...";
    // Handle the case where $_POST['uid'] is not set or empty
}
?>
