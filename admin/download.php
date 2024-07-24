<?php
session_start();
include '../php/connection.php';

if (isset($_POST['download_adhar'])) {
    $uid = $_POST['uid'];

    // Fetch the PDF path for the given UID
    $stmt = $conn->prepare("SELECT aadhar FROM upload_adhar WHERE uid = ?");
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $stmt->bind_result($pdf_path);
    $stmt->fetch();
    $stmt->close();

    if ($pdf_path && file_exists($pdf_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename($pdf_path).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pdf_path));
        readfile($pdf_path);
   
         exit;
    } else {
        echo "File not found.";
    }
}

if (isset($_POST['download_all'])) {
    $uid = $_POST['uid'];

    // Fetch all PDF paths for the given UID
    $stmt = $conn->prepare("SELECT aadhar FROM upload_adhar WHERE uid = ?");
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $zip = new ZipArchive();
    $zip_file = tempnam(sys_get_temp_dir(), 'pdfs_') . '.zip';

    if ($zip->open($zip_file, ZipArchive::CREATE) !== TRUE) {
        exit("Cannot open <$zip_file>\n");
    }

    while ($row = $result->fetch_assoc()) {
        $pdf_path = $row['aadhar']; // Adjust column name here
        if (file_exists($pdf_path)) {
            $zip->addFile($pdf_path, basename($pdf_path));
        }
    }

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="user_pdfs_' . $uid . '.zip"');
    header('Content-Length: ' . filesize($zip_file));

    readfile($zip_file);
    unlink($zip_file);
    exit;
}

$conn->close();
?>
