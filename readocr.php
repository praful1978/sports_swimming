<?php
// API key for OCR.space
$apiKey = 'K88547176988957';

// URL to OCR.space API
$url = 'https://api.ocr.space/parse/image';

// Path to your image file
$imagePath = 'aadhar.pdf';

// Initialize CURL session
$curl = curl_init();

// Set CURL options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Create an array with the image data
$imageFile = curl_file_create($imagePath);

// Set POST data (API key and image file)
$postData = array(
    'apikey' => $apiKey,
    'language' => 'eng', // Change this to the language code of your image content
    'file' => $imageFile,
    'detectOrientation' => 'true', // Detect orientation of the text
    'isOverlayRequired' => 'false', // No overlay required on the output image
    'scale' => 'true' // Scale the image for better OCR results
);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

// Execute CURL request
$response = curl_exec($curl);

// Check for CURL errors
if(curl_errno($curl)) {
    echo 'CURL Error: ' . curl_error($curl);
    exit;
}

// Close CURL session
curl_close($curl);

// Decode JSON response
$result = json_decode($response, true);

// Check if OCR processing was successful
if ($result['OCRExitCode'] === 1) {
    // Extract date of birth from the OCR output
    $dob = extractDOB($result['ParsedResults'][0]['ParsedText']);
    
    if ($dob !== null) {
        echo "Date of Birth: $dob";
    } else {
        echo "Date of Birth not found.";
    }
} else {
    // Output error message
    echo "OCR Error: " . $result['ErrorMessage'];
}

// Function to extract date of birth from text (sample implementation)
function extractDOB($text) {
    // Implement your logic to extract date of birth here
    // Example: using regular expression
    $matches = [];
    if (preg_match('/(?:DOB|Date of Birth):\s*(\d{1,2}\/\d{1,2}\/\d{4})/i', $text, $matches)) {
        return $matches[1]; // Return the matched date
    }
    return null; // Return null if date of birth not found
}
?>
