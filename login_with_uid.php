
<?php 
session_start();
 
if(isset($_POST['uid'])){
$uid = $_POST['uid'];

$_SESSION['uid'] = $uid;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with UID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                  <h3 class="mb-5">Sign in Please !!</h3>
                  <form method="POST" action="check_uid.php"> 
                    <label class="form-label mb-4">Enter UID NUMBER</label> 
                    <div data-mdb-input-init class="form-outline input-group">
                      <input type="text" id="uid1" class="form-control form-control-lg" value="DSOYSWIMM-" autofocus disabled/>  
                      <input type="text" id="uid2" class="form-control form-control-lg" onblur="uidMix()" maxlength="6" required/>  
                      <input type="hidden" id="uid" name="uid" class="form-control form-control-lg" />  
                    </div>
                    <div class="form-label mt-5">                
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit" name="submit" onclick="uidMix()">Login</button> 
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>   
    <script>
        function uidMix(){
            var string1 = document.getElementById("uid1").value;
            var string2 = document.getElementById("uid2").value;
            var string3 = string1 + string2;
            document.getElementById("uid").value = string3;
        }
    </script>
    <script type="text/javascript">  
        $('#phone').keypress(function(e) {  
            var arr = [];  
            var kk = e.which;  
            for (i = 48; i < 58; i++)  
                arr.push(i);  
            if (!(arr.indexOf(kk) >= 0))  
                e.preventDefault();  
        });  
    </script> 

</body>
</html>
