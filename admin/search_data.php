<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Member Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #343a40;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .form-outline {
            margin-bottom: 15px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-download {
            background-color: #007bff;
            color: white;
        }
        .btn-download:hover {
            background-color: #0056b3;
            color: white;
        }
        .hidden-input {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Testing Purpose</h2>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="h3 mb-0">Admin Panel - Show Members Data in Table</h1>
        </div>
        <div class="card-body">
            <form method="post" action="search_uid.php" class="mb-4"> 
                <div class="form-row">
                    <div class="col-md-4">
                        <input type="text" id="uid1" class="form-control" value="DSOYSWIMM-" disabled/>  
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="uid2" class="form-control" onblur="uidMix()" maxlength="6" required/>  
                    </div>
                    <input type="hidden" id="uid" name="uid" class="form-control"/>  
                    <div class="col-md-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </form>

            <!-- SEARCH FORM -->
            <form method="post" action="search_date.php" class="mb-4"> 
                <div class="form-row">
                    <div class="col-md-8">
                        <label for="search_date">Search by Date:</label>
                        <input type="date" id="search_date" name="search_date" class="form-control" onblur="enrol_date()">
                    </div>
                    <input type="hidden" id="newdate" name="newdate" class="hidden-input">
                    <div class="col-md-4 mt-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">Submit</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Signup Date</th>
                        <th>Fitness Form</th>
                        <th>Aadhar</th>
          
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any rows stored in the session
                    if (isset($_SESSION['result']) && count($_SESSION['result']) > 0) {
                        // Output data of each row
                        foreach ($_SESSION['result'] as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['uid']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['enrol_date']) . "</td>";
                            echo "<td><form method='post' action='search_uid.php'><input type='hidden' name='uid' value='" . htmlspecialchars($row['uid']) . "'><button type='submit' name='download' class='btn btn-download btn-sm'><i class='fas fa-download'></i> Download</button></form></td>";
                            echo "<td><form method='post' action='download.php'><input type='hidden' name='uid' value='" . htmlspecialchars($row['uid']) . "'><button type='submit' name='download_adhar' class='btn btn-download btn-sm'><i class='fas fa-download'></i> Download</button></form></td>";
                            
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function enrol_date() {
    // Get the input date value
    var today = document.getElementById("search_date").value;

    // Create a new Date object from the input value
    var dateObject = new Date(today);

    // Extract the day, month, and year
    var dd = String(dateObject.getDate()).padStart(2, '0');
    var mm = String(dateObject.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = dateObject.getFullYear();

    // Format the new date as "dd/mm/yyyy"
    var formattedDate = dd + '/' + mm + '/' + yyyy;

    // Display the new date
    document.getElementById("newdate").value = formattedDate;
}

function uidMix(){
    var string1 = document.getElementById("uid1").value;
    var string2 = document.getElementById("uid2").value;
    var string3 = string1 + string2;
    document.getElementById("uid").value = string3;
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
