<?php
    
    // $servername = "localhost:3306";
    // $username = "sh6ete423chsoft";
    // $password = "Er&-giv_+fcf" ;
    // $dbname = "sh6ete423chsoft_admin";
    
    $servername = "localhost";
    $username = "dsoyavatmal";
    $password = "0{T14;!UMc.#";
    $dbname = "dsoyavatmal_swimming_sports";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// // // Prepare and bind the SQL query with a placeholder for the UID
// $sql = "SELECT * FROM signup WHERE uid = ?";
// $stmt = $conn->prepare($sql);
// echo $sql;

// // Bind parameters
// $stmt->bind_param("s", $uid); // Assuming $uid is a string, use "i" for integers

// // Set the value of $uid
// $uid = $_POST['uid']; // Assuming you're getting the UID from a form submission
// echo $uid;
// // Execute the query
// $stmt->execute();

// // Get the result
// $result = $stmt->get_result();

// // Check if there are any rows returned
// if ($result->num_rows > 0) {
//     // Output data of each row
//     while($row = $result->fetch_assoc()) {
//         // echo "uid: " . $row["uid"]. " - mobile_number: " . $row["mobile_number"]. "<br>";
//         // You can output other columns as needed
//     }
// } else {
//     echo "0 results";
// }

// // Close statement
// $stmt->close();

// // Close connection
// $conn->close();

?>