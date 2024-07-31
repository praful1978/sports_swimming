<?php
session_start();
ob_start(); // Start output buffering

if (isset($_POST["submit"])) {
   $uid =  $_SESSION['uid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="css/uid_registration.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#ignismyModal').modal('show');
        });
    </script>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="modal fade" id="ignismyModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="thank-you-pop">
                            <h1>Congratulations, You are registered for Swimming!</h1>
                            <p>Now login and Book Your Batch</p>
                            <h3 class="cupon-pop">Your UID is: <span><strong><?php echo  $_SESSION['uid']; ?></strong></span></h3>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <a href="succesfull_reg_receipt.php" class="btn btn-primary">Go to Receipt</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
