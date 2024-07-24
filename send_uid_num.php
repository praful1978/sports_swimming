<?php

$userid = 'prafulla';  // SMS Gateway Center userid
$password = 'Prafulla@1978';   // SMS Gateway Center password
$mobile =  $mobile_number; // recipient's mobile number
$message = 'Hello ' . $fullname .' , This is a message regarding your Swimming Registration. Your UID number is:' . $uid .' . From: District Sports Office, Yavatmal';    // Replace with your message content
$senderid = 'DSOYTL';  // sender ID
$dltTemplateId = '1107172103085086164'; // Optional: replace with DLT template ID if needed

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
            echo 'SMS sent successfully. Transaction ID: ' . $decoded_response['transactionId'];
            header("Location: verify_otp.php" );
        } else {
            echo 'Error: ' . $decoded_response['reason'];
        }
    }
}
curl_close($curl);
 


?>