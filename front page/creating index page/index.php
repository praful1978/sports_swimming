<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/couresol.css">

 <!-- for center the form -->

</head>
<body>
<!-- Navigation bar -->
   <div class="topnav" id="myTopnav">
    <label class="active" style="color:white;font-weight:bold;font-size:16px;text-align:center">District Sports Office, Yavatmal</label>
            <a href="logout.php">logout</a>
            <a href="login_with_uid.php">Login</a>
            <a href="table.php">Signup</a>
            <a class="active" href="#">Home</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<!-- slider  -->
 <!-- Slideshow container -->
<div class="slideshow-container">
<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>

<!-- Full-width images with number and caption text -->
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="https://www.w3schools.com/howto/img_nature_wide.jpg" style="width:100%">

</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="https://www.w3schools.com/howto/img_snow_wide.jpg" style="width:100%">

</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="https://www.w3schools.com/howto/img_mountains_wide.jpg" style="width:100%">
  <!-- <div class="text">Caption Three</div> -->
</div>

<!-- Next and previous buttons -->

<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>


<div style="text-align:center" id="pagination">
      <!-- Link to your external JavaScript file -->
      <script src="js/index.js" defer></script>
</div>

<!-- card in bootstrap -->
<div class="card-container">
    <div class="card">
        <img class="card-img-top" src="dso.png" alt="Card image cap"  width="300" height="300">
        <div class="card-body">
            <p class="card-text">Ghanshyam R. Rathod</p>
            <p class="card-text">District Sports Officer, Yavatmal</p>
        </div>
    </div>

    <div class="card">
        <img class="card-img-top" src="collector.png" alt="Card image cap" width="300" height="300">
        <div class="card-body">
            <p class="card-text">District Collector</p>
            <p class="card-text">Dr. Pankaj Aashiya (IAS)</p>
        </div>
    </div>
</div>


<div class="container" style="margin-left:80%;">
    <div class="row justify-content-end">
        <div class="col-lg-6 order-lg-2">
            <div class="form">
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group col-lg-3 input-group">
                            <input type="text" id="uid1" class="form-control col-lg-2" value="DSOYSWIMM" disabled />
                            <input type="text" id="uid2" class="form-control col-lg-2" onblur="uidMix()" maxlength="6" required />
                            <input type="hidden" id="uid" name="uid" class="form-control form-control-lg" />
                        </div>
                    </div>

                    <div class="form-group col-lg-6 mt-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" minlength="4" required>
                    </div>
                    <div class="form-group col-lg-6 mt-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                    </div>

                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" minlength="8" required>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" title="Send Message">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




 

 

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 text-lg-start text-center">
          <div class="copyright">
            &copy; Copyright <strong>ShreeTech software development</strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Avilon
          -->
            Designed by <a href="">Prafulla D. Kinkar -7057445099</a>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
            <a href="#intro" class="scrollto">Home</a>
            <a href="#about" class="scrollto">About</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
          </nav>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->
  <script>
    function uidMix(){
        var string1 = document.getElementById("uid1").value;
        var string2 = document.getElementById("uid2").value;
        var string3 = string1 + string2;
        document.getElementById("uid").value = string3;
    }
</script>
<script src="js/index.js" type="text/javascript"></script>
<script src="js/couresol.js" type="text/javascript"></script>
</div>

</body>
</html>