<?php

// Function to generate a numeric UID
function generateNumericUID($length) {
    $digits = '0123456789';
    $uid = '';
    for ($i = 0; $i < $length; $i++) {
        $uid .= $digits[rand(0, 9)];
    }
    return $uid;
}

// Generate a numeric UID with a length of 6 digits
$numericUID = generateNumericUID(6);

// Concatenate a prefix "DSOYSWIMM" with the numeric UID
$UID = "DSOYSWIMM" . $numericUID;

// Display the generated UID
echo "Generated UID: " . $UID;

?>
