<?php
session_start();
include("connection.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

function uploadFile($fileInputName, $targetDir, $documentType) {
    if (!isset($_FILES[$fileInputName])) {
        echo "No file was uploaded.";
        return;
    }

    $targetFile = $targetDir . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is a PDF
    if ($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check for file upload errors
    if ($_FILES[$fileInputName]['error'] != UPLOAD_ERR_OK) {
        echo "Sorry, there was an error uploading your file. Error code: " . $_FILES[$fileInputName]['error'];
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            // File path to store in the database
            $filePath = $targetFile;

            // Use prepared statements to prevent SQL injection
            $uid = $_SESSION['uid'];
            $stmt = $GLOBALS['conn']->prepare("INSERT INTO upload_adhar (uid, aadhar) VALUES (?, ?)");
            $stmt->bind_param("ss", $uid, $filePath);

            if ($stmt->execute()) {
                echo "The file ". htmlspecialchars(basename($_FILES[$fileInputName]["name"])). " has been uploaded.";
            } else {
                echo "Error updating record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if (isset($_FILES['aadhar'])) {
    uploadFile('aadhar', "upload_adhar/", 'aadhar');
}

$conn->close();
?>
