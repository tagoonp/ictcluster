<?php
include "../config.inc.php";
$return = array();
if(!isset($_GET['stage'])){
  $return[0]['response_status'] = 'Denine with no stage';
  mysqli_close($conn); die();
}

if(!isset($_GET['protocol'])){
  $return[0]['response_status'] = 'Denine with no protocol';
  mysqli_close($conn); die();
}

$stage = mysqli_real_escape_string($conn, $_GET['stage']);
$protocol = mysqli_real_escape_string($conn, $_GET['protocol']);

if($stage == 'register'){

  if($protocol == 'email'){
    if(
      (!isset($_POST['fname'])) ||
      (!isset($_POST['lname'])) ||
      (!isset($_POST['phone'])) ||
      (!isset($_POST['email'])) ||
      (!isset($_POST['password']))
    ){
      $return[0]['response_status'] = 'Denine with un-completely parameters';
      mysqli_close($conn); die();
    }

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));
    $uid = base64_encode($sysdateu.$fname);

    $strSQL = "SELECT * FROM ci2x_account WHERE username = '$email' AND delete_status = 'N' AND active_status = 'Y' AND register_protocal = 'email'";
    $result = mysqli_query($conn, $strSQL);
    if(($result) && (mysqli_num_rows($result) > 0)){
      $return[0]['response_status'] = 'Duplicate username';
      mysqli_close($conn); die();
    }

    $strSQL = "INSERT INTO ci2x_account
               (
                 UID, username, password, register_type, register_protocal, register_datetime
               )
               VALUES
               ('$uid', '$email', '$password', 'Internal account','email', '$sysdatetime')
              ";
    $resultInsert = mysqli_query($conn, $strSQL);
    if($resultInsert){
      $strSQL = "INSERT INTO ci2x_userinfo (info_fname, info_lname, info_email, info_phone, info_udatetime, info_uid)
                 VALUES ('$fname', '$lname', '$email', '$phone', '$sysdatetime', '$uid')
                ";
      $resultInsert2 = mysqli_query($conn, $strSQL);
      if($resultInsert2){
        $return[0]['response_status'] = 'Success';
        $return[0]['response_uid'] = $uid;
        $return[0]['response_role'] = 'common';
      }else{
        $strSQL = "DELETE FROM ci2x_account WHERE UID = '$uid'";
                   mysqli_query($conn, $strSQL);
        $return[0]['response_status'] = 'Can not create account (ax0002)';
      }
    }else{
      $return[0]['response_status'] = 'Can not create account (ax0001)';
    }
    echo json_encode($return);
    mysqli_close($conn); die();
  } // End register with email

} // End register


?>
