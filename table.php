
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet">

<!-- payment link for razorpay -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- navbar csss -->
 <link rel="stylesheet" href="navbar.css">
</head>
<body>
 <!-- Navigation bar -->
 <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">District Sports Office, Yavatmal</label>
        <ul>
            <li><a class="active" href="#">Home</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </nav>

  <div class="pt-5">
    <table class="table table-bordered table-striped text-center">
        <thead>
          <tr>
            <th scope="col"> Sr.<br>num.  </th>
            <th scope="col"> Batch  </th>
            <th scope="col"> Fee/फी  </th>

          </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"> 1 </th>
                <td> रजिस्ट्रेशन फी  </td>
                <p value="Registraion Fee" name="Rf" hidden></p>
                <td> रु. १00/- </td>
                <p value="100.00" name="fee" hidden></p>
                <!-- <form name="download" action="logout.php" method="POST">
                <td> रजिस्ट्रेशन करून फिटनेस फॉर्म डाऊनलोड करण्यासाठी या बटन क्लीक करा 
                  <button class="btn btn-primary p-4" style="width:100%" onclick = "downloadFile()" ><i class="fa fa-download"></i> रजिस्ट्रेशन फी भरा व फॉर्म डाऊनलोड करा</button> 
                 </td>
              </form> -->
              </tr>
          <tr>
            <th scope="row"> 2 </th>
            <td> Under 18 without Coaching   /  १८ वर्षा खालील (कोचिंग नाही) </td>
            <td> रु. १000/- </td>
           
          </tr>
          <tr>
            <th scope="row"> 3 </th>
            <td> Under 18 with Coaching  /  १८ वर्षा खालील (कोचिंग सह ) </td>
            <td> रु. १५00/- </td>
          </tr>
          <tr>
            <th scope="row"> 4 </th>
            <td> Above 18 without Coaching / १८ वर्षा वरील (कोचिंग नाही) </td>
            <td> रु.१२००/- </td>

          </tr>
          <tr>
            <th scope="row"> 5 </th>
            <td> Above 18 with Coaching / १८ वर्षा वरील  (कोचिंग  सह) </td>
            <td> रु.१७००/- </td>
            
          </tr>
         
       
        </tbody>
       
      </table>

      <div class="container mt-5 text-center">
    <!-- Payment Form -->

    
    <!-- Payment Button -->
    <button id="payButton" class="btn btn-primary">Pay Registraion Fee rs. 100/-</button>\
    <div> <a style=" width: 150px; background-color: #1CA953; text-align: center; font-weight: 800; padding: 11px 0px; color: white; font-size: 12px; 
    display: inline-block; text-decoration: none; border-radius:3.229px; " href='https://test.payumoney.com/url/vIrhZPpESnSB' > Pay Now </a> </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script> 
<script>
      var options_100 = {
    "key": "https://pmny.in/PI9TS9mLlu7m", // Add your Razorpay Key ID
    "amount": 10000, // Amount in paise (e.g., 2000 paise = ₹20)
    "currency": "INR", // Currency
    "name": "DISTRICT SPORTS OFFICE, SWIMMING POOL, YAVATMAL",
    "description": "SWIMMING BATCH BOOKING",
    "handler": function (response){
        // Payment was successful
        localStorage.setItem("Transaction ID", response.razorpay_payment_id);
        localStorage.setItem("Registration Fee", "100");
        const date = new Date();
        localStorage.setItem("Registration Date", date.toString());

        // Send payment details to your server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "save_payment.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("payment_id=" + response.razorpay_payment_id + "&amount=100");

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                window.location.href = "register_uid_number.php";
            } else {
                alert("Failed to save payment details. Please try again.");
            }
        };
    },
    "prefill": {
        "name": "first_name last_name",
        "mobile number": "mobile_number"
    },
    "theme": {
        "color": "#3399cc" // Change according to your theme color
    },
    "modal": {
        "ondismiss": function() {
            alert("Payment was not completed. Please try again.");
        }
    }
};

// Function to trigger payment
document.getElementById('payButton').onclick = function(){
    var rzp = new Razorpay(options_100);
    rzp.open();
}

</script>
 
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<!-- // Include Razorpay SDK in your HTML file -->

<script>


// Create a function to handle payment success
function handlePaymentSuccess(response) {
  localStorage.setItem("Transaction ID", response.razorpay_payment_id);
  localStorage.setItem("Registration Fee", "100");
}
</script>


  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>