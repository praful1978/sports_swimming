 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
    .form-group{
        padding: 10px;
    }
 </style>
       
    <title>District Sports Office, Yavatmal - Swimming</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



</head>
<body  onload="calllocal()">
   <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <form name="signupform" action="signup.php" method="POST" enctype="multipart/form-data">
                            <input type="text" id="amount" name="amount" hidden >
                            <input type="text" id="transaction_id" name="transaction_id" hidden>
                            <input type="text" id="payment_date" name="payment_date" hidden>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Mobile Number</label>
                                <input type="tel" class="form-control" id="mobile_number" name="mobile_number"
                                    placeholder="Mobile Number" required>
                            </div>
                            <div class="form-group">
                                <label for="relative">Parents</label>
                                <select class="form-control" id="relative_select" name="relative"
                                    onchange="toggleOtherRelative(this)">
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="parents_num">Emergency / Parents Contact Number</label>
                                <input type="tel" class="form-control" id="parents_num" name="parents_num"
                                    placeholder="Parents Mobile Number">
                            </div>
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input type="email" class="form-control" id="email_address" name="email_address"
                                    placeholder="Email Address">

                            </div>
                            <div class="form-group">
                                <label>Enter your Date of Birth</label><br>
                                <input id="inputDob" type="date" name="birth" placeholder="DD/MM/YYYY"
                                    onblur="calculateAge(); " />
                                <label id="dob" name="dob"></label> <input id="result" name="age" readonly hidden/>
                            </div>
                            <div class="form-group row">
                     
                                <div class="col-sm-3">
                                <div class="form-group">
    <select class="form-control" id="genderSelect" onchange="updateGender()">
        <option selected disabled>Select gender</option>
        <option value="1">Male</option>
        <option value="2">Female</option>
    </select>
    <input type="text" id="gender" name="gender" hidden>
</div>
                            <div class="form-group">
                                <label for="permenent_address">Blood Group</label>
                                <input type="text" class="form-control" id="blood_group" name="blood_group"
                                    placeholder="Enter Blood Group">
                            </div>
                            <div class="form-group">
                                <label for="permenent_address">Permanent Address</label>
                                <input type="text" class="form-control" id="permenent_address" name="permenent_address"
                                    placeholder="Permanent Address">
                            </div>
                              <input type="submit" name="submit" class="btn btn-primary" style="margin-top:20px;" data-toggle="modal" href="#ignismyModal"></input> 
                           </form>
                           
                           
                             <!-- <div class="form-group">
                                <label><strong>Upload Photo</strong></label>
                                <div class="d-flex align-items-center">

                                    <input type="file" name="image" id="photo" class="form-control-file"
                                    accept="image/*" title="Upload jpeg">
                                </div>
                            </div> -->
<!--                             
                   
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" class="form-control" id="user_password" name="user_password"
                                    placeholder="Password" required>
                            </div> -->

 
<script>
        function calculateAge() {
            var dob = document.getElementById('inputDob').value;
            var dobDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - dobDate.getFullYear();
            var monthDiff = today.getMonth() - dobDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }
            document.getElementById('result').value = age;
        }
    </script>
 <script>
  function calllocal(){
    
var tfee =localStorage.getItem("Registration Fee");
var tid =localStorage.getItem("Transaction ID");
var dtd =localStorage.getItem("Registration Date");

document.getElementById("amount").value =tfee ;
document.getElementById("transaction_id").value =tid ;
document.getElementById("payment_date").value= dtd;

}
</script>
<script>
function updateGender() {
    var selectBox = document.getElementById('genderSelect');
    var selectedValue = selectBox.options[selectBox.selectedIndex].text;
    document.getElementById('gender').value = selectedValue;
}
</script>
</body>

</html>