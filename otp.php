<?php
session_start();
ob_start(); // Start output buffering
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
 
    include('connection.php');

   
        // Fetch mobile number from the database based on the UID
        $query = "SELECT mobile_number FROM signup WHERE uid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the mobile number
            $row = $result->fetch_assoc();
            $mobile_number = $row['mobile_number'];

            // URL encode the variables to ensure they are safe for use in a URL
            $uid = urlencode($uid);

 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://unify.smsgateway.center/SMSApi/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('userid=prafulla&password=xxxxx&sendMethod=quick&mobile=7057445099&msg=HELLO&senderid=DSOYTL&msgType=text&dltEntityId=&dltTemplateId=1107172087511555478&duplicatecheck=true&output=json'),
  CURLOPT_HTTPHEADER => array(
    'Cookie: SERVERID=webC2'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
        }
    }
?>