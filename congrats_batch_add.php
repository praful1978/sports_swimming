<?php
session_start();

// Check if session variables are set
if (!isset($_SESSION['uid'], $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['batchtime'], $_SESSION['batchfee'], $_SESSION['transactionid'])) {
    die("Required session variables are not set.");
}

// Retrieve session variables
$uid = $_SESSION['uid'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$batchtime = $_SESSION['batchtime'];
$batchfee = $_SESSION['batchfee'];
$paymentid = $_SESSION['transactionid'];

// Include database connection
include 'connection.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into final_payment table
$sql = "INSERT INTO final_payment (uid, first_name, last_name, batch_time, batch_fee, payement_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssss", $uid, $first_name, $last_name, $batchtime, $batchfee, $paymentid);

// Execute the insert query and check for errors
if ($stmt->execute()) {
    // Close the prepared statement
    $stmt->close();

    // Now perform the select query
    $sql = "SELECT * FROM final_payment WHERE uid = ?";
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
        $_SESSION['batch_time'] = $row['batch_time'];
        $_SESSION['batch_fee'] = $row['batch_fee'];
        $_SESSION['transactionid'] = $row['payement_id'];

        // Redirect to card.php
        header('Location: card.php');
        exit(); // Make sure to exit after redirection
    } else {
        echo "No records found.";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    die("Error inserting record: " . $stmt->error);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congratulations Dialog</title>
    <style>
        /* Basic styles for the dialog */
        #congrats-dialog {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 50px;
            border: 2px solid #4CAF50;
            background-color: gray;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
            border-radius: 10px;
        }
        #congrats-dialog h2 {
            margin-top: 0;
            color: white;
        }
        #congrats-dialog .close-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        #congrats-dialog .close-btn:hover {
            background-color: #45a049;
        }
        #congrats-dialog img {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
            background-color: gray;
        }
        /* Overlay to darken the background */
        #dialog-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        /* Sparkle effect */
        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: radial-gradient(circle, white 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            animation: sparkle 1s infinite;
        }
        @keyframes sparkle {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }
    </style>
</head>
<body onload="showCongratsDialog('You have successfully Registered for Swimming!');"> 


<div id="dialog-overlay"></div>
<div id="congrats-dialog">
<form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<input type="text" id="uid" name="uid" value='<?php echo $_SESSION['uid']; ?>' hidden >
   <input type="text" id="first_name" name="firstname" value='<?php echo $_SESSION['first_name']; ?>' hidden/>
   <input type="text" id="last_name" name="lastname" value='<?php echo $_SESSION['last_name']; ?>' hidden/>

   <input type="text" id="batch_time" name="batchtime">
   <input type="text" id="batch_fee" name="batchfee" >
   <input type="text" id="transactionid" name="transactionid">
    <h2>Congratulations!</h2>
    <img src="buckey.png" alt="Bouquet of Flowers">
    <p id="congrats-message">You have achieved a great milestone.</p>
   <input type="submit" class="close-btn" ></input> 
   </form>
</div>

  
 
<!-- <button onclick="showCongratsDialog('You have successfully Registered for Swimming!')">Show Congratulations</button> -->

<script>
    function showCongratsDialog(message) {
        document.getElementById('congrats-message').innerText = message;
        document.getElementById('dialog-overlay').style.display = 'block';
        document.getElementById('congrats-dialog').style.display = 'block';

        for (let i = 0; i < 20; i++) {
            let sparkle = document.createElement('div');
            sparkle.className = 'sparkle';
            sparkle.style.top = Math.random() * 100 + '%';
            sparkle.style.left = Math.random() * 100 + '%';
            sparkle.style.animationDuration = (Math.random() * 0.5 + 0.5) + 's';
            document.getElementById('congrats-dialog').appendChild(sparkle);
        }
    }

    function closeDialog() {
        document.getElementById('dialog-overlay').style.display = 'none';
        document.getElementById('congrats-dialog').style.display = 'none';
        let sparkles = document.querySelectorAll('.sparkle');
        sparkles.forEach(function(sparkle) {
            sparkle.remove();
        });
    }
</script>
<script>
 var bt =localStorage.getItem("Batch Time");
 var bfee =localStorage.getItem("Batch Fee");
 var tid =localStorage.getItem("Transaction ID");
 
  document.getElementById("batch_time").value =bt;
  document.getElementById("batch_fee").value=bfee;
  document.getElementById("transactionid").value =tid;
 
</script>
</body>
</html>
