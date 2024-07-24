<?php
session_start();
if (!isset($_SESSION['batch'])) {
  // Redirect to the main page if no batch information is found
  // header('Location: congrats_batch_add.php');
  // exit();
}
$selected_batch = $_SESSION['batch'];
 
$uid = $_SESSION['uid'];
 
      include 'connection.php'; // Include database connection

      // Prepare and bind the SQL statement with a parameterized query
      $sql = "SELECT * FROM signup WHERE uid = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $uid);

      // Execute the query
      $stmt->execute();
      
      // Get the result set
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
              // echo "ID: " . $row["uid"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
              // $_SESSION['photo'] = $row["photo_path"]; // Set the session variable for the photo path
              $firstname = $row["first_name"];
              $lastname = $row["last_name"];
              $permanent_address = $row["permanent_address"];
              $_SESSION["uid"] =$row["uid"];
              $_SESSION["first_name"] = $firstname;
              $_SESSION["last_name"] = $lastname; 
              $_SESSION["permanent_address"] = $permanent_address; 
  
          }
      } else {
          echo "0 results";
      }

      // Close the prepared statement and connection
      $stmt->close();
      $conn->close();
  
// Check if batch information is available in the session

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Swimming Player Batches</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .card {
      border: none;
      margin-bottom: 30px;
      
      /* background: url("http://localhost/php/images/bg-swimming.jpg"); */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card-body {
      border-radius: 10px;
      padding: 20px;
      text-align: center;
    }
    .card-title {
      font-size: 24px;
      font-weight: bold;
      color: #007bff; /* Blue */
    }
    .card-text {
      font-size: 25px;
      color: #0f0101; /* Dark gray */
 
    }
    .card-deck{
        padding: 20px;
 
    }
    .size{
 
      font-size: 20px;
      font-weight: bold;
      background-color: brown;
      color: white;
    }
    .fee {
      color: #4322b9fd; /* Green */
      font-size: 25px;
      font-weight: bold;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    .blink_me {
              animation: blinker 1s linear infinite;
              color:black;
    }

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
  </style>
  	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin-Signup</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet">

    <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!------for dropdown ---->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-----for other relative jquery link--->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
 <!-- payment link for razorpay -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body onunload="fetchdata()">
 
  <div class="container" style="margin-top:10%;">
  
    <div class="container" style="margin-top: 5%;">
        <h2 class="text-center">Selected Swimming Batch Time </h2>
        <div class="text-center">
 <h3><span class="badge badge-primary mt-2 p-2 "><?php echo $uid; ?></span></h3> 
</div>
        <div class="alert alert-success text-center">
            <strong><?php echo htmlspecialchars($selected_batch); ?></strong>
        </div>

    </div>
     <!-- <form name="under_18_without_coach" method="post" action=""> -->
    <div class="card-deck">
      <div class="card" style="background-color:cyan;">
        <div class="card-body">
          <h5 class="card-title">Batch A</h5>
          <p class="card-text"><strong>Under 18 without Coaching</strong><br>१८ वर्षा खालील <a style="color:red;">(कोचिंग नाही)</a></p>
          <p class="card-text"  ><strong>Fee:</strong> <span class="fee"><a name="u18" value="1000">रु. १000/-</a></span></p>
          <!-- <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_OH9raCITnKWFKA" async> </script> </form> -->
          <!-- <button type="submit" class="btn btn-primary" name="submit"><a href="payment_gateway.php" class="btn btn-primary">Select Batch</a></button>  -->
          <div class="container mt-5">
        <!-- Payment Button -->
        <button id="payButton_one_thousand" class="btn btn-primary" onclick="deleteItems()" name="payment">Pay Rs. 1000/-</button>
    </div>
    </div>
      </div>
      </div>
            
    <!-- Include Razorpay script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

    
        // Initialize Razorpay
        var options_1000 = {
            "key": "rzp_test_Gv69T1SFBew7Oh", // Add your Razorpay Key ID
            "amount": 100000, // Amount in paise (e.g., 2000 paise = ₹20)
            "currency": "INR", // Currency
            "name": "DISTRICT SPORTS OFFICE, SWIMMING POOL, YAVATMAL",
            "description": "SWIMMING BATCH BOOKING",
            "handler": function (response){
               
              var batch_time ='<?php echo htmlspecialchars($selected_batch); ?>';
     
              localStorage.setItem("Transaction ID", response.razorpay_payment_id);
              localStorage.setItem("rzp_id", response.rzp_device_id);
              localStorage.setItem("Batch Fee", "1000");
              localStorage.setItem("Batch Time", batch_time );
         
 
              var mobile_number = localStorage.getItem("mobile number");
              var first_name = localStorage.getItem("first_name");
              var last_name = localStorage.getItem("last_name");
              // var uid = localStorage.getItem("UID");
 
              var transition_id =   localStorage.getItem("Transaction ID");
           



               // alert('Payment ID: ' + response.razorpay_payment_id);
                window.location.href = "congrats_batch_add.php"; // Change this to your desired URL
            },
            "prefill": {
                "name": "first_name" + "last_name",
                "mobile number": "mobile_number"
            },
            "theme": {
                "color": "#3399cc" // Change according to your theme color
            }
        };

        // Function to trigger payment
        document.getElementById('payButton_one_thousand').onclick = function(){
            var rzp = new Razorpay(options_1000);
            rzp.open();
        }
    </script>

    <!-- </form> -->
    <!-- <form name="under_18_with_coach" method="post" action=""> -->
      <div class="card-deck">
      <div class="card" style="background-color:	#FF69B4;">
        <div class="card-body">
          <h5 class="card-title">Batch B</h5>
          <p class="card-text"><strong>Under 18 <a class="blink_me">with Coaching</a></strong><br>१८ वर्षा खालील <a style="color:red;">(कोचिंग सह )</a></p>
          <p class="card-text"><strong>Coach:</strong> shubham</p>
          <p class="card-text"><strong>Fee:</strong> <span class="fee">रु. १५00/-</span></p>
          <!-- <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_OH9uuJkH6PKNGp" async> </script> </form> -->
          <!-- <button type="submit" class="btn btn-primary" name="submit"><a href="payment_gateway.php" class="btn btn-primary">Select Batch</a></button>  -->
          <div class="container mt-5">
        <!-- Payment Button -->
        <button id="payButton_fifteen_hundrade" class="btn btn-primary" onclick="deleteItems()">Pay Rs. 1500/-</button>
    </div>

    <!-- Include Razorpay script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        // Initialize Razorpay
        var options_1500 = {
            "key": "rzp_test_Gv69T1SFBew7Oh", // Add your Razorpay Key ID
            "amount": 150000, // Amount in paise (e.g., 2000 paise = ₹20)
            "currency": "INR", // Currency
            "name": "DISTRICT SPORTS OFFICE, SWIMMING POOL, YAVATMAL",
            "description": "SWIMMING BATCH BOOKING",
            "handler": function (response){
              var batch_time ='<?php echo htmlspecialchars($selected_batch); ?>';
              localStorage.setItem("Transaction ID", response.razorpay_payment_id);
      
              localStorage.setItem("Batch Fee", "1500");
              localStorage.setItem("Batch Time", batch_time );

              window.location.href = "congrats_batch_add.php"; // Change this to your desired URL
            },
            "prefill": {
                "name": "first_name" + "last_name",
                "mobile number": "mobile_number"
            },
            "theme": {
                "color": "#3399cc" // Change according to your theme color
            }
        };

        // Function to trigger payment
        document.getElementById('payButton_fifteen_hundrade').onclick = function(){
            var rzp = new Razorpay(options_1500);
            rzp.open();
        }
    </script>
        </div>
      </div>
      </div>
    <!-- </form> -->
   
  <!-- </form> -->
  </div>

   
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>


</body>
</html>
