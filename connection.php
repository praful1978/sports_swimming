<?php
    
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "swimming_sports";
    
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

?>