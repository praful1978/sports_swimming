<?php
session_start();
 
$uid =$_SESSION['uid'];
 
 
include("connection.php");
// // Prepare and bind the SQL query with a placeholder for the UID
$sql = "SELECT * FROM signup WHERE uid = ?";
$stmt = $conn->prepare($sql);
 
// Bind parameters
$stmt->bind_param("s", $uid); // Assuming $uid is a string, use "i" for integers

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
 
        $first_name =$row['first_name'];
        $last_name =$row['last_name'];
        $permanent_address =$row['permanent_address'];
        $mobile_number =$row['mobile_number'];
        $age = $row['age'];
        $enrol_date = $row['enrol_date'];
        $expiry_date = $row['expiry_date'];
            
        // You can output other columns as needed
    }
} else {
    echo "0 results";
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .mt25 {
            margin-top:5%;
        }

        .well {
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            padding: 15px;
            border-radius: 4px;
        }

    </style>
 

</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div id="logo">
        <h1>जिल्हा क्रीडा संकुल यवतमाळ </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a> -->
      </div>
      <nav id="navbar" class="navbar">
        <ul>
           <li><a href="logout.php" class="nav-link scrollto active btn-primary">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>

  </header><!-- End Header -->
<?php include 'php/fetch_signup_data.php'; ?>
    <div class="container mt25">
    <div class="row justify-content-center">
        <div class="col-lg-6 ">
            <div class="invoice-details">
                <div class="well">
                    <ul class="list-unstyled mb0">
                        <li>
                            <!-- <div class="invoice-logo">
                                <img width="100" src="<?php echo "../" . $_SESSION['photo']; ?>" alt="Invoice logo">
                            </div> -->
                        </li>
                        <ul class="list-unstyled text-right">
                            <li>District Sports Office, Yavatmal</li>
                            <li>Neharu Stadium</li>
                            <li>Godhani Road Yavatmal</li>
                            <li>contact number: 9637553436</li>
                        </ul>
                        <li><strong>UID Number</strong><br><?php echo $_SESSION['uid']; ?></li>
                        <li><strong>Status:</strong> <span class="label label-danger">PAID</span></li>
                    </ul>

                    <div class="invoice-to mt25">
                        <ul class="list-unstyled">
                            <li>Invoiced To</strong><br><strong><?php echo $first_name; ?> <?php echo $last_name; ?></strong></li>
                            <li>Permanent Address:<strong><br><?php echo $permanent_address; ?></strong></li>
                            <li>Registration Mobile Number:<strong><br><?php echo $mobile_number; ?></strong></li>
                        </ul>
                    </div>
                    <div class="invoice-items mt25">
                        <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="per70 text-center">Description</th>
                                        <th class="per25 text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Registration Fee For Form</td>
                                        <td class="text-center">Rs. 100/-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-footer mt25">
         
        <label>Generated on <strong><?php echo htmlspecialchars($enrol_date); ?></strong> Your Subscription expires on = <strong><?php echo htmlspecialchars($expiry_date); ?></strong></label>
 
                    
                        <a class="btn btn-primary" id="print" onclick="print()"> Print</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
         function Print() {
 
                window.print();
   
            }
        </script>

    </div>
</body>
</html>
