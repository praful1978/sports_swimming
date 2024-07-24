<?php
session_start();

// Check if uid is set in session
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    // Use the uid for your logic here, e.g., fetch related data from the database
    echo "User ID from session: " . htmlspecialchars($uid);
}
 
include("../php/connection.php");
// Prepare the SQL query with a placeholder for the UID
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
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $blood_group = $row['blood_group'];
        $date_of_birth = $row['birth'];
        $mobile_number = $row['mobile_number'];
        $email_address = $row['email_address'];
        $permanent_address = $row['permanent_address'];
        $parents_mobile_number = $row['parents_mobile_number'];
        $age = $row['age'];
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Form for Players</title>
    <!-- Link to convert HTML page to PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <!-- Bootstrap link for table -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .fw-bold { font-weight: bold; }
        .form-check-label { font-weight: normal; }
        .form-check-inline .form-check-input {
            margin-left: 1rem;
        }
        td, th {
            font-weight: 500;
        }
    </style>
  </head>
  <body>
    <div class="container" id="content">
      <header class="text-center mb-4">
        <h4>Zilla Krida Sankul Samiti, Yavatmal</h4>
        <h3>Application Form For Swimming Pool</h3>
        <h4> UID Number : <span style="margin-left:30px;"><?php echo htmlspecialchars($uid); ?></span> </h4>
      </header>
      <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Full Name</td>
                    <td><?php echo htmlspecialchars($first_name) . " " . htmlspecialchars($last_name); ?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Blood Group</td>
                    <td><?php echo htmlspecialchars($blood_group); ?></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Contact/Mobile Number</td>
                    <td><?php echo htmlspecialchars($mobile_number); ?></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Permanent Address</td>
                    <td><?php echo htmlspecialchars($permanent_address); ?></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Gender</td>
                    <td><?php echo htmlspecialchars($gender); ?></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Date of Birth</td>
                    <td><?php echo htmlspecialchars($date_of_birth); ?></td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($email_address); ?></td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>Emergency Contact Number</td>
                    <td><?php echo htmlspecialchars($parents_mobile_number); ?></td>
                </tr>
            </tbody>
        </table>
   
    <hr />
    <h6>10. Medical Fitness Report</h6>
    <h6>1. Have you ever suffered at any time from the following?</h6>
    <h2 class="my-4">Medical Questions</h2>
    <table class="table table-bordered table-responsive-md">
        <tbody>
            <tr>
                <th class="col-md-6">a. Ear trouble, earache, discharge or deafness?</th>
                <td class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="earTrouble" id="earTroubleYes" value="yes" />
                        <label class="form-check-label" for="earTroubleYes">Yes</label>
                        <input class="form-check-input" type="radio" name="earTrouble" id="earTroubleNo" value="no" />
                        <label class="form-check-label" for="earTroubleNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-6">b. Sinus trouble?</th>
                <td class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sinusTrouble" id="sinusTroubleYes" value="yes" />
                        <label class="form-check-label" for="sinusTroubleYes">Yes</label>
                        <input class="form-check-input" type="radio" name="sinusTrouble" id="sinusTroubleNo" value="no" />
                        <label class="form-check-label" for="sinusTroubleNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-6">c. Chest disease, including asthma, bronchitis, collapsed lung or T.B?</th>
                <td class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="chestDisease" id="chestDiseaseYes" value="yes" />
                        <label class="form-check-label" for="chestDiseaseYes">Yes</label>
                        <input class="form-check-input" type="radio" name="chestDisease" id="chestDiseaseNo" value="no" />
                        <label class="form-check-label" for="chestDiseaseNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-6">d. Attacks of giddiness, blackouts or fainting?</th>
                <td class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="giddiness" id="giddinessYes" value="yes" />
                        <label class="form-check-label" for="giddinessYes">Yes</label>
                        <input class="form-check-input" type="radio" name="giddiness" id="giddinessNo" value="no" />
                        <label class="form-check-label" for="giddinessNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-6">e. Fits of nervous disorders including persistent headaches or concussion?</th>
                <td class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="nervousDisorders" id="nervousDisordersYes" value="yes" />
                        <label class="form-check-label" for="nervousDisordersYes">Yes</label>
                        <input class="form-check-input" type="radio" name="nervousDisorders" id="nervousDisordersNo" value="no" />
                        <label class="form-check-label" for="nervousDisordersNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-6">f. Anxiety, "nerves", nervous breakdown?</th>
                <td class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="anxiety" id="anxietyYes" value="yes" />
                        <label class="form-check-label" for="anxietyYes">Yes</label>
                        <input class="form-check-input" type="radio" name="anxiety" id="anxietyNo" value="no" />
                        <label class="form-check-label" for="anxietyNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-6">g. Diabetes? Specify since when?</th>
                <td class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diabetes" id="diabetesYes" value="yes" />
                        <label class="form-check-label" for="diabetesYes">Yes</label>
                        <input class="form-check-input" type="radio" name="diabetes" id="diabetesNo" value="no" />
                        <label class="form-check-label" for="diabetesNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">2. Do you regularly or frequently take medicine or treatment with or without prescription?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="frequentMedicine" id="frequentMedicineYes" value="yes" />
                        <label class="form-check-label" for="frequentMedicineYes">Yes</label>
                        <input class="form-check-input" type="radio" name="frequentMedicine" id="frequentMedicineNo" value="no" />
                        <label class="form-check-label" for="frequentMedicineNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">3. Are you currently receiving medical care or have you consulted any doctor in the past year?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="medicalCare" id="medicalCareYes" value="yes" />
                        <label class="form-check-label" for="medicalCareYes">Yes</label>
                        <input class="form-check-input" type="radio" name="medicalCare" id="medicalCareNo" value="no" />
                        <label class="form-check-label" for="medicalCareNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">4. Have you ever been refused life insurance or failed a medical examination?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="lifeInsurance" id="lifeInsuranceYes" value="yes" />
                        <label class="form-check-label" for="lifeInsuranceYes">Yes</label>
                        <input class="form-check-input" type="radio" name="lifeInsurance" id="lifeInsuranceNo" value="no" />
                        <label class="form-check-label" for="lifeInsuranceNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">5. Do you smoke?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="smoke" id="smokeYes" value="yes" />
                        <label class="form-check-label" for="smokeYes">Yes</label>
                        <input class="form-check-input" type="radio" name="smoke" id="smokeNo" value="no" />
                        <label class="form-check-label" for="smokeNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">6. Have you ever been attached or admitted to the hospital?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hospitalAdmittance" id="hospitalAdmittanceYes" value="yes" />
                        <label class="form-check-label" for="hospitalAdmittanceYes">Yes</label>
                        <input class="form-check-input" type="radio" name="hospitalAdmittance" id="hospitalAdmittanceNo" value="no" />
                        <label class="form-check-label" for="hospitalAdmittanceNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">7. Have you had surgery?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="surgery" id="surgeryYes" value="yes" />
                        <label class="form-check-label" for="surgeryYes">Yes</label>
                        <input class="form-check-input" type="radio" name="surgery" id="surgeryNo" value="no" />
                        <label class="form-check-label" for="surgeryNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">8. Are you a patient of epilepsy/seizure?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="epilepsy" id="epilepsyYes" value="yes" />
                        <label class="form-check-label" for="epilepsyYes">Yes</label>
                        <input class="form-check-input" type="radio" name="epilepsy" id="epilepsyNo" value="no" />
                        <label class="form-check-label" for="epilepsyNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">9. Do you have allergies to medicines?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="allergies" id="allergiesYes" value="yes" />
                        <label class="form-check-label" for="allergiesYes">Yes</label>
                        <input class="form-check-input" type="radio" name="allergies" id="allergiesNo" value="no" />
                        <label class="form-check-label" for="allergiesNo">No</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="col-md-12">10. Do you have a history of orthopedic problems?</th>
                <td class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="orthopedicProblems" id="orthopedicProblemsYes" value="yes" />
                        <label class="form-check-label" for="orthopedicProblemsYes">Yes</label>
                        <input class="form-check-input" type="radio" name="orthopedicProblems" id="orthopedicProblemsNo" value="no" />
                        <label class="form-check-label" for="orthopedicProblemsNo">No</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="form-group">
        <label class="form-check-label text-justify p-3">
            I hereby declare that I have not omitted any information that may be relevant to my fitness to swim and authorize my doctor to disclose any detail of my past or present medical history if any. I also agree that relevant information about my health may be disclosed to the persons directly concerned with this swim attempt.
        </label>
    </div>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td class="col-md-4">
                    <label for="signature" class="fw-bold">Signature</label>
                </td>
                <td class="col-md-4">
                    <label for="date">Date</label>
                </td>
            </tr>
            <tr>
                <td class="col-md-6">
                    <label for="witnessSignature" class="fw-bold">Witness Signature</label><br />
                    <label>(Examining Doctor)</label>
                </td>
                <td class="col-md-6">
                    <label for="witnessDate">Date</label>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="form-group">
        <label class="fw-bold">Declaration:</label>
        <p>1. I have gone through the rules and regulations for the membership and agree to abide by those rules.</p>
        <p>2. The information given above is correct to the best of my knowledge, and if found wrong at any time, my membership may be cancelled.</p>
        <p>3. I will not claim any compensation for injury during swimming. The swimming pool management will not be responsible for any injury or loss of life.</p>
        <p>4. I will use lifesaving equipment and swimming costume as per the rules and advice of coaches/life guards.</p>
    </div>

    <table class="table table-bordered table-responsive-md">
        <tbody>
            <tr class="mt-5">
                <td class="col-md-6 fw-bold">
                    <label>(Parent/Guardian's Signature)</label>
                </td>
            </tr>
            <tr class="mt-5">
                <td class="col-md-6 fw-bold">
                    <label>(Swimmer's Signature)</label>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="invoice-footer mt-4 text-center">
        <button id="download-pdf" class="btn btn-primary" >Print external page!</button>
    </div>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const element = document.getElementById('content');
    const options = {
        filename: 'fitness_form.pdf',
        margin: 0,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { 
            unit: 'in', 
            format: 'A4', 
            orientation: 'portrait' 
        }
    };
    html2pdf().set(options).from(element).save().then(() => {
        // Optionally, you can redirect or perform other actions after the PDF is downloaded
    
    });
});

</script>
</body>
</html>
