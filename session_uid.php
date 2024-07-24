<?php
session_start();
 
if(isset($_POST['uid'])){
$uid = $_POST['uid'];

$_SESSION['uid'] = $uid;

}
 