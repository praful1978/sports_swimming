
<?php
ob_start(); // Start output buffering

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
        exit(); // Make sure to exit after redirection
    } else {
        echo "No records found.";
    }

    // Close the prepared statement
    $stmt->close();


// Close the database connection
$conn->close();
    // Flush output buffer
    ob_end_flush();
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
<input type="text" id="uid" name="uid" value='<?php echo $_SESSION['uid']; ?>'  >
   <input type="text" id="first_name" name="firstname" value='<?php echo $_SESSION['first_name']; ?>' />
   <input type="text" id="last_name" name="lastname" value='<?php echo $_SESSION['last_name']; ?>' />

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
