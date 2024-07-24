<?php
session_start();
$first_name=$_POST['first_name']; //get uid from login_With_uid.php

include'connection.php';
        // Prepare and bind the SQL statement with a parameterized query
        $sql = "SELECT * FROM signup WHERE uid = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $uid);

            // Execute the query
            $stmt->execute();

            // Get the result set
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch associative array and set session variables
                $row = $result->fetch_assoc();

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
                $mobile_number= $_SESSION['mobile_number'] ;
            }
               
        }
 