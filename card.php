<?php
session_start();

include('connection.php');
$sql = "SELECT * FROM final_payment WHERE uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $uid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['uid'] = $row['uid'];
    $_SESSION['first_name'] = $row["first_name"];
    $_SESSION['last_name'] = $row["last_name"];
    $_SESSION['batchtime'] = $row["batchtime"];
    $_SESSION['batchfee'] = $row["batchfee"];

} else {
    echo "0 results";
}

//code for fetch all data from database with uid

        // $sql = "SELECT * FROM signup WHERE uid = ?";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param("s", $uid);
        // $stmt->execute();
        // $result = $stmt->get_result();

        // if ($result->num_rows > 0) {
        //     $row = $result->fetch_assoc();
        //     $_SESSION['uid'] = $row['uid'];
        //     $_SESSION['photo'] = "/photo/" . $row["photo_path"];
        // } else {
        //     echo "0 results";
        // }

        // $stmt->close();
        // $conn->close();

// }
$currentDate = new DateTime();
$currentDate->modify('+1 month');
$formattedDate = $currentDate->format('d/m/Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet">
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Payment receipt</title>
 
    <style>

th,td{
border-color: black !important;
border: 2px solid black;
}

</style>
</head>
<body onload="myFunction()">
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
    <div class="container d-flex align-items-center justify-content-center" style="margin-top:10%;" id="makepdf">
        <div class="row invoice row-printable">
            <div class="col-md-12">
                <div class="panel panel-default plain" id="dash_0">
                    <div class="panel-body p30">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="invoice-logo">
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="invoice-from">
                                    <ul class="list-unstyled text-center ">
                                        <li><h4><strong>District Sports Office, Yavatmal</strong></h4></li>
                                        <li></h4><strong>Neharu Stadium, Godhani Road</strong></h4></li>
                                        <li></h4><strong>Contact number: 9637553436</strong></h4></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="invoice-details mt25">
                                    <div class="well">
                                        <ul class="list-unstyled mb0">
                                            <li><strong>UID Number:</strong>   <?php echo $_SESSION['uid']; ?>
                                            </li>
                                            <li><strong>Status:</strong> <span class="label label-danger">PAID</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="invoice-to mt25">
                                    <ul class="list-unstyled">
                                        <li><strong>Invoiced To:</strong> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></li>
                                        <li><strong>Permanent Address:</strong>   
                                        <?php echo $_SESSION['permanent_address']; ?>  
                                     </li>
                                    </ul>
                                </div>
                                <div class="invoice-items">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <td>
                                                  
                                                    <th class="per25 text-center">Total</th>
                                             
                                       
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Batch Booked Fee with time  <?php echo $_SESSION['batchtime']; ?></td>
                                                    <td><?php echo $_SESSION['batchfee']; ?>
                                                    </td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                          

                                    <label for="batch_fee" hidden>Batch Fee:</label>
                                 

                                    <br>
                                    <div class="invoice-footer mt25">
                                        <p class="text-center"><strong>Generated on <label id="datetime"><?php echo date("d/m/Y"); ?> and <span>Your Subscription expire on = '<?php echo $formattedDate; ?>'</span></label></strong>
                                            <br><input type="submit" class="btn btn-primary" id="print" onclick="print()" name="submit" value="Print"><i class="fa fa-print mr5"></i></input></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
         function Print() {
 
                window.print();
   
            }
        </script>
</body>
</html>
