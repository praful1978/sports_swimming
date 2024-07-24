<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if POST variables are set
    if (isset($_POST["amount"]) && isset($_POST["transaction_id"])) {
        // Retrieve form data
        $amount = $_POST["amount"];
        $transactionid = $_POST["transaction_id"];

        // Store form data in session variables
        $_SESSION['amount'] = $amount;
        $_SESSION['transaction_id'] = $transactionid;

        // Output the received data
        echo "Amount: " . htmlspecialchars($amount) . "<br>";
        echo "Transaction ID: " . htmlspecialchars($transactionid) . "<br>";
    } else {
        echo "Form data is missing.";
    }
} else {
    // If the form was not submitted via POST, show an error
    echo "Form was not submitted correctly.";
}
?>
