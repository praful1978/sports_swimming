<?php
// Include the mPDF library
require_once __DIR__ . '/mpdf/autoload.php';

use Mpdf\Mpdf;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uid'])) {
    $uid = htmlspecialchars($_POST['uid']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    // Add more form fields as needed

    // Create the HTML content
    $html = '
    <h1>Fitness Form</h1>
    <p>UID: ' . $uid . '</p>
    <p>First Name: ' . $first_name . '</p>
    <p>Last Name: ' . $last_name . '</p>
    ';

    // Initialize mPDF
    $mpdf = new Mpdf();

    // Write the HTML content to the PDF
    $mpdf->WriteHTML($html);

    // Output the PDF as a download
    $mpdf->Output('fitness_form_' . $uid . '.pdf', 'D');
} else {
    echo "No form data provided.";
}
?>
