<?php
 
if(isset($_POST['submit'])){
$first= $_POST['first'];
$second= $_POST['second'];
$third= $_POST['third'];
$fourth= $_POST['fourth'];
$userOTP = $first . $second . $third . $fourth;
}else{
echo "session not set";
}