<?php
session_start();

// Check if 'uid' is set in the session
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    // echo "UID: " . htmlspecialchars($uid);
} else {
    echo "No UID found in session.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Font Awesome 6 stylesheet -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="css/verify_otp.css" rel="stylesheet">
</head>
<body>

  <div class="container height-100 d-flex justify-content-center align-items-center">
    <div class="container p-5">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5 mt-5">
          <div class="bg-white p-5 rounded-3 shadow-sm border">
          <h3><span class="badge badge-primary mt-2 p-2 "><?php  echo "UID: " . htmlspecialchars($uid); ?></span></h3> 
          <form method="post" action="verify_send_otp.php">
      
              <p class="text-center text-success" style="font-size: 5.5rem;"><i class="fa-solid fa-envelope-circle-check"></i></p>
              <p class="text-center text-center h5">Please check your email</p>
              <p class="text-muted text-center">We've sent a code on your registered mobile number <label id="lastFourDigits"></label></p>
              <div class="row pt-4 pb-2" id="otp">
        
                <div class="col-3 col-sm-3">
                  <input class="otp-letter-input form-control" type="text" id="first" name="first" onkeyup="movetoNext(this, 'second')" maxlength="1">
                </div>
                <div class="col-3  col-sm-3">
                  <input class="otp-letter-input form-control" type="text" id="second" name="second" onkeyup="movetoNext(this, 'third')" maxlength="1">
                </div>
                <div class="col-3  col-sm-3">
                  <input class="otp-letter-input form-control" type="text" id="third" name="third"  onkeyup="movetoNext(this, 'fourth')" maxlength="1">
                </div>
                <div class="col-3 col-sm-3">
                  <input class="otp-letter-input form-control" type="text" id="fourth" name="fourth" onkeyup="movetoNext(this, 'verify-otp')" maxlength="1">
                </div>
              </div>
              <div>Time left = <span id="timer"></span></div>
              <p class="text-muted text-center">Didn't get the code? <a href="sendotp.php" class="text-success">resend OTP</a></p>
              <div class="row pt-5">
                <!-- <div class="col-6">
                  <a href="login_with_uid.php"><button class="btn btn-outline-secondary w-100">Cancel</button></a>
                </div> -->
                <div class="text-center">
                      <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" id="verify-otp" name="submit">Verify OTP</button>
                </div>

                
              </div>      
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal HTML -->
  <div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header">
          <div class="icon-box">
            <i class="material-icons">&#xE876;</i>
          </div>        
          <h4 class="modal-title w-100">Awesome!</h4>  
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-center">Your booking has been confirmed. Check your email for details.</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success btn-block" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js" integrity="sha512-qs0znU+zFoz/MY6Oc0KXH+r5Xw0rF2+t0eWI/WrG+P/q17nOKcnRHGzKsk35j8nP5BQ6u9msCuLAcFz+xBGdpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/verify_otp.js"></script>
              
        <script type="text/javascript">   
          window.onload = function() {
          var mobileNumber = "<?php echo"$mobile_number"?>";  // Replace "xxxxx1234" with the actual mobile number
          var lastFourDigits = mobileNumber.slice(-4);
          document.getElementById("lastFourDigits").innerText = "Last four digits of the mobile number: " + lastFourDigits;
      };
      </script>         
    
<script type="text/javascript">
  function movetoNext(current, nextFieldID) {
  if (current.value.length >= current.maxLength) {
  document.getElementById(nextFieldID).focus();
  }
  }
  </script>

<script>
  let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  alert('Timeout for otp');
}

timer(60);
</script>
</body>
</html>
 



