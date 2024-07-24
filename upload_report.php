<?php
session_start();
include("connection.php");

function uploadFile($fileInputName, $targetDir, $documentType) {
    $targetFile = $targetDir . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is a actual PDF
    if($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            // File path to store in the database
            $filePath = $targetFile;

            // Check connection
            if (mysqli_errno($GLOBALS['conn']) == 1062) {
                echo "Error updating record: " . mysqli_error($GLOBALS['conn']);
                return;
            }

            $uid = $_SESSION['uid'];
            $sql = "INSERT INTO upload_report (uid,report) VALUES ('$uid', '$filePath')";

            if ($GLOBALS['conn']->query($sql) === TRUE) {
                echo "The file ". htmlspecialchars(basename($_FILES[$fileInputName]["name"])). " has been uploaded.";
            } else {
                echo "Error updating record: " . mysqli_error($GLOBALS['conn']);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


if (isset($_FILES['report'])) {
    uploadFile('report', "upload_report/", 'report');
}

$conn->close();
?>
