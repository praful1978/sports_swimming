<?php
// signup.php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile_number = $_POST['mobile_number'];
    $relative = $_POST['relative'];
    $parents_num = $_POST['parents_num'];
    $email_address = $_POST['email_address'];
    $birth = $_POST['birth'];
    $dob_mysql_format = date('Y-m-d', strtotime(str_replace('/', '-', $birth))); // Convert to yyyy-mm-dd
    $dob_reverse_format = date('d/m/Y', strtotime($dob_mysql_format)); // Reverse the date format back to dd/mm/yyyy
    $permenent_address = $_POST['permenent_address'];
    $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    if (isset($_POST['age'])) {
        $age = $_POST['age'];
 
        
    } else {
        echo "Error: Age not provided";
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO signup (first_name, last_name, mobile_number, user_relative, parents_mobile_number, email_address,birth,age,permenent_address, user_password)
            VALUES ('$first_name', '$last_name', '$mobile_number', '$relative', '$parents_num', '$email_address', '$dob_reverse_format', '$age' , '$permenent_address', '$user_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        // Redirect to login page or home page
        header("Location: uid.php");
    }  
}
?>
