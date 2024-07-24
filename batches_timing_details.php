<?php 
session_start();
 
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

}

$batchA = "Morning 6.00 to 6.45 AM";
$batchB = "Morning 7.00 to 7.45 AM";
$batchC = "Morning 8.00 to 8.45 AM"; // Corrected from PM to AM
$batchD = "Evening 5.00 to 5.45 PM";
$batchE = "Evening 6.00 to 6.45 PM";
$batchF = "Evening 7.00 to 7.45 PM";

include 'connection.php'; // Include database connection

// Prepare the SQL statement
$sql = "SELECT batch_time, COUNT(*) as count FROM final_payment GROUP BY batch_time";
$result = $conn->query($sql);

// Initialize counts for each batch
$batch_counts = [
    $batchA => 0,
    $batchB => 0,
    $batchC => 0,
    $batchD => 0,
    $batchE => 0,
    $batchF => 0,
];

// Fetch the counts from the database
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $batch_counts[$row['batch_time']] = $row['count'];
    }
}

// Assign counts to variables for use in HTML
$countA = $batch_counts[$batchA];
$countB = $batch_counts[$batchB];
$countC = $batch_counts[$batchC];
$countD = $batch_counts[$batchD];
$countE = $batch_counts[$batchE];
$countF = $batch_counts[$batchF];

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swimming Batches</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<h2 class="text-center mb-4 mt-4">Swimming Batches</h2>
<div class="text-center">
 <h3><span class="badge badge-primary mt-2 p-2 "> <?php echo $uid; ?></span></h3> 
</div>

    <div class="container" style="width:500px;margin-top:5%;">
        <h1 style="color:green"><h5 class="card-title">Morning Batch</h5></h1>
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form method="POST" action="select_batches_age.php">
                        <input type="hidden" name="batch" value="Morning 6.00 to 6.45 AM">
                        <button type="submit" class="btn btn-primary">
                            <strong>Morning 6.00 to 6.45 AM</strong>
                        </button>
                        <a href="#" class="btn btn-info" style="margin:10px;font-size:30px;">
                            <span id="batch_a">80</span>
                        </a>
                    </form>
                </li>
            </ul>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form method="POST" action="select_batches_age.php">
                        <input type="hidden" name="batch" value="Morning 7.00 to 7.45 AM">
                        <button type="submit" class="btn btn-primary">
                            <strong>Morning 7.00 to 7.45 AM</strong>
                        </button>
                        <a href="#" class="btn btn-info" style="margin:10px;font-size:30px;">
                            <span id="batch_b">80</span>
                        </a>
                    </form>
                </li>
            </ul>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form method="POST" action="select_batches_age.php">
                        <input type="hidden" name="batch" value="Morning 8.00 to 8.45 AM">
                        <button type="submit" class="btn btn-primary">
                            <strong>Morning 8.00 to 8.45 AM</strong>
                        </button>
                        <a href="#" class="btn btn-info" style="margin:10px;font-size:30px;">
                            <span id="batch_c">80</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="container" style="width:500px;">
        <h1 style="color:green"><h5 class="card-title">Evening Batch</h5></h1>
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form method="POST" action="select_batches_age.php">
                        <input type="hidden" name="batch" value="Evening 5.00 to 5.45 PM">
                        <button type="submit" class="btn btn-primary">
                            <strong>Evening 5.00 to 5.45 PM</strong>
                        </button>
                        <a href="#" class="btn btn-info" style="margin:10px;font-size:30px;">
                            <span id="batch_d">80</span>
                        </a>
                    </form>
                </li>
            </ul>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form method="POST" action="select_batches_age.php">
                        <input type="hidden" name="batch" value="Evening 6.00 to 6.45 PM">
                        <button type="submit" class="btn btn-primary">
                            <strong>Evening 6.00 to 6.45 PM</strong>
                        </button>
                        <a href="#" class="btn btn-info" style="margin:10px;font-size:30px;">
                            <span id="batch_e">80</span>
                        </a>
                    </form>
                </li>
            </ul>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form method="POST" action="select_batches_age.php">
                        <input type="hidden" name="batch" value="Evening 7.00 to 7.45 PM">
                        <button type="submit" class="btn btn-primary">
                            <strong>Evening 7.00 to 7.45 PM</strong>
                        </button>
                        <a href="#" class="btn btn-info" style="margin:10px;font-size:30px;">
                            <span id="batch_f">80</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <script>
 document.addEventListener("DOMContentLoaded", function() {
    var countA = <?php echo $countA; ?>;
    var countB = <?php echo $countB; ?>;
    var countC = <?php echo $countC; ?>;
    var countD = <?php echo $countD; ?>;
    var countE = <?php echo $countE; ?>;
    var countF = <?php echo $countF; ?>;

    document.getElementById("batch_a").textContent = 80 - countA;
    document.getElementById("batch_b").textContent = 80 - countB;
    document.getElementById("batch_c").textContent = 80 - countC;
    document.getElementById("batch_d").textContent = 80 - countD;
    document.getElementById("batch_e").textContent = 80 - countE;
    document.getElementById("batch_f").textContent = 80 - countF;
});
</script>
</body>
</html>
