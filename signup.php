<?php

// Start the session and output buffering
session_start();
ob_start(); // Start output buffering
    // Import PHPMailer classes into the global namespace for email sms sending
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
//end of sms sending email

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Generate unique ID
    $uid_number = random_int(100000, 999999); 
    $uid = "DSOYSWIMM-" . $uid_number;
    $_SESSION['uid'] =$uid;
    // Assign POST values to variables
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['blood_group'];
    $mobile_number = $_POST['mobile_number'];
    $relative = $_POST['relative'];
    $parents_num = $_POST['parents_num'];
    $email_address = $_POST['email_address'];
    $birth = $_POST['birth'];
    $age = $_POST['age'];
    $permanent_address = $_POST['permenent_address'];
    $amount = $_POST['amount'];
    $transaction_id = $_POST['transaction_id'];
    $payment_date = $_POST['payment_date'];

    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['mobile_number'] = $mobile_number;   
    $_SESSION['permenent_address'] = $permenent_address;

    $fullname =$first_name . " " . $last_name;
   


    $userid = 'prafulla';  // SMS Gateway Center userid
    $password = 'Prafulla@1978';   // SMS Gateway Center password
    $mobile =  $mobile_number; // recipient's mobile number
    $message = 'Hello ' . $fullname .' , This is a message regarding your Swimming Registration. Your UID number is:' . $uid .'  From: District Sports Office, Yavatmal';    // Replace with your message content
    $senderid = 'DSOYTL';  // sender ID
    $dltTemplateId = '1107172103085086164'; // Optional: replace with DLT template ID if needed
    
    $data = array(
        'userid' => $userid,
        'password' => $password,
        'sendMethod' => 'quick',
        'mobile' => $mobile,
        'msg' => $message,
        'senderid' => $senderid,
        'msgType' => 'text',
        'dltEntityId' => '',      // Optional: replace with DLT entity ID if needed
        'dltTemplateId' => $dltTemplateId,
        'duplicatecheck' => 'true',
        'output' => 'json'
    );
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://unify.smsgateway.center/SMSApi/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => http_build_query($data),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded',
      ),
    ));
    
    $response = curl_exec($curl);
    
    if ($response === false) {
        echo 'Curl error: ' . curl_error($curl);
    } else {
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_code !== 200) {
            echo 'HTTP error: ' . $http_code;
        } else {
            $decoded_response = json_decode($response, true);
            if (isset($decoded_response['status']) && $decoded_response['status'] === 'success') {
                echo 'SMS sent successfully. Transaction ID: ' . $decoded_response['transactionId'];
                header("Location: success_reg.php" );
            } else {
                echo 'Error: ' . $decoded_response['reason'];
            }
        }
    }
    curl_close($curl);
     //end of sms code

// sending email code

    
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2; // Enable verbose debug output (set to 0 in production)
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main SMTP server
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'shreetech15@gmail.com'; // SMTP username
        $mail->Password = 'ketqjugoexoflnwa'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption
        $mail->Port = 465; // TCP port to connect to
    
        //Recipients
        $mail->setFrom('shreetech15@gmail.com', 'District Sports Office,Yavatml'); // Sender's email address and name
        $mail->addAddress('nileshambade00@gmail.com', 'Prafulla kinkar'); // Recipient's email address and name
    
        // Set the Reply-To address to a "no-reply" email address
        $mail->addReplyTo('no-reply@yourdomain.com', 'No Reply'); // "No Reply" email address
    
        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'simple mail';
        $mail->Body    = 'Hello ' . $fullname .' , This is a message regarding your Swimming Registration. Your UID number is:' . $uid .'  From: District Sports Office, Yavatmal';
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
  //end of email sms code


    // Calculate the expiry date
    $currentDate = date("d/m/Y");
    $orderdate = explode('/', $currentDate);
    $day = $orderdate[0] + 1;
    $month = $orderdate[1] + 1;
    $year = $orderdate[2];
    $expirydate = $day . "/" . $month . "/" . $year;
    

    // Include the database connection
    include 'connection.php';
    
    // Check database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare SQL statements
    $stmt1 = $conn->prepare("INSERT INTO registration (uid, first_name, last_name, mobile_number, payment, payment_date, transaction_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt2 = $conn->prepare("INSERT INTO signup (uid, first_name, last_name, gender, blood_group, mobile_number, user_relative, parents_mobile_number, email_address, birth, age, permanent_address, enrol_date, expiry) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Check if statements are prepared successfully
    if (!$stmt1 || !$stmt2) {
        die("Error preparing statements: " . $conn->error);
    }
    
    // Bind parameters
    $stmt1->bind_param("sssssss", $uid, $first_name, $last_name, $mobile_number, $amount, $payment_date, $transaction_id);
    $stmt2->bind_param("ssssssssssssss", $uid, $first_name, $last_name, $gender, $bloodgroup, $mobile_number, $relative, $parents_num, $email_address, $birth, $age, $permanent_address, $currentDate, $expirydate);
    
    // Print input values for debugging

    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Execute first prepared statement
        $success1 = $stmt1->execute();
        if (!$success1) {
            throw new Exception("Error executing first query: " . $stmt1->error);
        }
    
        // Execute second prepared statement
        $success2 = $stmt2->execute();
        if (!$success2) {
            throw new Exception("Error executing second query: " . $stmt2->error);
        }
    
        // Commit transaction
        $conn->commit();
        
        // Redirect to success page
        header("Location: success_reg.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        
        // Determine the type of error
        if ($stmt2->errno == 1062) { // MySQL error code for duplicate entry
            $errorMessage = "Error: Duplicate entry. This email or mobile number is already registered.";
        } else {
            $errorMessage = $e->getMessage();
        }
        
        // Output error message and redirect
        echo "<script type='text/javascript'>alert('$errorMessage');</script>";
        header("Location: success_reg.php");
        exit();
    }
    
    // Close prepared statements
    if ($stmt1) {
        $stmt1->close();
    }
    if ($stmt2) {
        $stmt2->close();
    }
    
    // Close database connection
    $conn->close();
    
    // Flush output buffer
    ob_end_flush();

    
}
?>