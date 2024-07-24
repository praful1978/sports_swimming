<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>

<div class="topnav" id="myTopnav">
  <a href="#home" class="active">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

 

      <!---- ====couresol section ---->
      <?php include("couresol.php"); ?>
       <!-- ======= Team Section ======= -->
 
<!-- card for photo  -->
<div class="card" style="width: 18rem;">
  <img src="dso.png" class="card-img-top" alt="...">
  <div class="card-body">
    <p class="card-text"><h4>Shri Ghanshyam R. Rathod</h4>
    <span>District Sports Officer, Yavatmal</span></p>
  </div>
</div>


<div class="member">
  <div class="pic"><img src="collector.png" alt="" width="200" height="200"></div>
  <h4>श्री. डॉ. पंकज आशिया</h4>
  <span>(भा.प्र.से)</span>
  <div class="social">
    <a href=""><i class="bi bi-twitter"></i></a>
    <a href=""><i class="bi bi-facebook"></i></a>
    <a href=""><i class="bi bi-instagram"></i></a>
    <a href=""><i class="bi bi-linkedin"></i></a>
  </div>
</div>

 <!-- end card photo -->
      <div class="container" data-aos="fade-up">
        <div class="row">

          <div class="col-lg-4 col-md-4">
            <div class="contact-about">
              <h3> fs</h3>
              <p>Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis eu non diam phasellus. Scelerisque
                felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
              <div class="social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="info">
              <div>
                <i class="bi bi-geo-alt"></i>
                <p>Godhani Road<br>Yavatmal</p>
              </div>

              <div>
                <i class="bi bi-envelope"></i>
                <p>dsoytl244060@gmail.com</p>
              </div>

              <div>
                <i class="bi bi-phone"></i>
                <p>phone number</p>
              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-8">
            <div class="form">
                <form action="index_data.php" method="post" >
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
    </section><!-- End Contact Section -->
<!-- script for card section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
    function uidMix(){
        var string1 = document.getElementById("uid1").value;
        var string2 = document.getElementById("uid2").value;
        var string3 = string1 + string2;
        document.getElementById("uid").value = string3;
    }
</script>
<!-- navbar js code -->
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script src="js/coursol.js"></script>