<?php
    
    // $servername = "localhost:3306";
    // $username = "sh6ete423chsoft";
    // $password = "Er&-giv_+fcf" ;
    // $dbname = "sh6ete423chsoft_admin";
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "swimming_sports";
    // creating a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$conn)
    {
        die("Connection failed!" . mysqli_connect_error());
    }else{
        echo "<h1 style='color:white;display:none;'> connection succesfull </h1>";
        
    }
// // Prepare and bind the SQL query with a placeholder for the UID
$sql = "SELECT * FROM signup WHERE uid = ?";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("s", $uid); // Assuming $uid is a string, use "i" for integers

// Set the value of $uid
$uid = $_POST['uid']; // Assuming you're getting the UID from a form submission

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "uid: " . $row["uid"]. " - mobile_number: " . $row["mobile_number"]. "<br>";
        // You can output other columns as needed
    }
} else {
    echo "0 results";
}

// Close statement
$stmt->close();

// // Close connection
// $conn->close();

?>