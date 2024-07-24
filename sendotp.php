<?php
include "session_uid.php"; //get uid number from login_with_uid.php

include "fetch_otp_data.php"; //fetch data from signup to get uid number
 
   // Generate new OTP
 $userotp = mt_rand(1000, 9999);

 include_once'insert_otp.php'; // insert otp into otp_verification table

$userid = 'prafulla';  // SMS Gateway Center userid
$password = 'Prafulla@1978';   // SMS Gateway Center password
$mobile =  $mobile_number; // recipient's mobile number
$message = 'OTP for Login on Swimming website is ' . $userotp .' and valid up to 2 minutes. Do not share this OTP to anyone for security reasons. From District Sports Office, Yavatmal';    // Replace with your message content
$senderid = 'DSOYTL';  // sender ID
$dltTemplateId = '1107172087511555478'; // Optional: replace with DLT template ID if needed

$data = array(
    'userid' => $userid,
    'password' => $password,
    'sendMethod' => 'quick',
    'mobile' => $mobile,
    'msg' => $message,
    'senderid' => $senderid,
    'msgType' => 'text',
    'dltEntityId' => '',      // Optional: replace with DLT entity ID if needed
    'dltTemplateId' => $dltTemplateId,
    'duplicatecheck' => 'true',
    'output' => 'json'
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://unify.smsgateway.center/SMSApi/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => http_build_query($data),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded',
  ),
));

$response = curl_exec($curl);

if ($response === false) {
    echo 'Curl error: ' . curl_error($curl);
} else {
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_code !== 200) {
        echo 'HTTP error: ' . $http_code;
    } else {
        $decoded_response = json_decode($response, true);
        if (isset($decoded_response['status']) && $decoded_response['status'] === 'success') {
            // echo 'SMS sent successfully. Transaction ID: ' . $decoded_response['transactionId'];
            header("Location: verify_otp.php" );
        } else {
            echo 'Error: ' . $decoded_response['reason'];
        }
    }
}
curl_close($curl);
 


?>
