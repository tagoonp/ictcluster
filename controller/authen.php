<?php
include "../config.inc.php";
$return = array();
if(!isset($_GET['stage'])){
  $return['response_status'] = 'Denine with no stage';
  echo json_encode($return);
  mysqli_close($conn); die();
}

if(!isset($_GET['protocol'])){
  $return['response_status'] = 'Denine with no protocol';
  echo json_encode($return);
  mysqli_close($conn); die();
}

$stage = mysqli_real_escape_string($conn, $_GET['stage']);
$protocol = mysqli_real_escape_string($conn, $_GET['protocol']);

if($stage == 'updatepassword'){
  if(
    (!isset($_POST['uid'])) ||
    (!isset($_POST['password']))
  ){
    $return['response_status'] = 'Denine with un-completely parameters';
    echo json_encode($return);
    mysqli_close($conn); die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));

  if($protocol == 'self'){
    $strSQL = "UPDATE ci2x_account SET password = '$password' WHERE UID = '$uid'";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      $strSQL = "INSERT INTO ci2x_activity_log (log_datetime, log_ip, log_activity, log_uid) VALUES ('$sysdatetime', '$ip', 'Change own password', '$uid')";
                mysqli_query($conn, $strSQL);
      $return['response_status'] = 'Success';
    }else{
      $return['response_status'] = 'Fail';
    }
  }else if($protocol == 'other'){

    if(!isset($_POST['user_uid'])){
      $return['response_status'] = 'Denine with un-completely parameters';
      echo json_encode($return);
      mysqli_close($conn); die();
    }

    $user_uid = mysqli_real_escape_string($conn, $_POST['user_uid']);

    $strSQL = "UPDATE ci2x_account SET password = '$password' WHERE UID = '$user_uid'";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      $strSQL = "INSERT INTO ci2x_activity_log (log_datetime, log_ip, log_activity, log_uid) VALUES ('$sysdatetime', '$ip', 'Change other user (UID : $user_uid) password', '$uid')";
                mysqli_query($conn, $strSQL);
      $return['response_status'] = 'Success';
    }else{
      $return['response_status'] = 'Fail';
    }
  }else{
    $return['response_status'] = 'Fail';
  }
  echo json_encode($return);
  mysqli_close($conn); die();
}

if($stage == 'user'){
  if(
    (!isset($_POST['uid'])) ||
    (!isset($_POST['role']))
  ){
    $return['response_status'] = 'Denine with un-completely parameters';
    echo json_encode($return);
    mysqli_close($conn); die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);

  $strSQL = "SELECT * FROM ci2x_account a INNER JOIN ci2x_userinfo b ON a.UID = b.info_uid
             LEFT JOIN ci2x_profile c ON a.UID = c.profile_uid
             WHERE
             a.UID = '$uid'
             AND b.info_uid = '$uid'
             AND a.role = '$role'
             AND a.delete_status = 'N'
             AND a.active_status = 'Y'
             AND b.info_use_status = 'Y'
             AND (c.profile_use = 'Y' OR c.profile_use IS NULL)
             LIMIT 1";
  $result = mysqli_query($conn, $strSQL);
  if(($result) && (mysqli_num_rows($result) > 0)){
    $data = mysqli_fetch_assoc($result);
    $return['response_status'] = 'Success';
    $return['fname'] = $data['info_fname'];
    $return['lname'] = $data['info_lname'];
    $return['gender'] = $data['info_gender'];
    $return['address'] = $data['info_address'];
    $return['phone'] = $data['info_phone'];
    $return['role'] = $data['role'];
    $return['profile_img'] = $data['profile_fileurl'];
    $return['PID'] = $data['info_pid'];
  }else{
    $return['response_status'] = 'No data found';
  }

  echo json_encode($return);
  mysqli_close($conn); die();
} // End user

if($stage == 'register'){
  if($protocol == 'email'){
    if(
      (!isset($_POST['fname'])) ||
      (!isset($_POST['lname'])) ||
      (!isset($_POST['phone'])) ||
      (!isset($_POST['email'])) ||
      (!isset($_POST['password']))
    ){
      $return['response_status'] = 'Denine with un-completely parameters';
      echo json_encode($return);
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
      $return['response_status'] = 'Duplicate username';
      echo json_encode($return);
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

        $strSQL = "INSERT INTO ci2x_activity_log (log_datetime, log_ip, log_activity, log_uid) VALUES ('$sysdatetime', '$ip', 'Register', '$uid')";
                  mysqli_query($conn, $strSQL);

        $return['response_status'] = 'Success';
        $return['response_uid'] = $uid;
        $return['response_role'] = 'common';
      }else{
        $strSQL = "DELETE FROM ci2x_account WHERE UID = '$uid'";
                   mysqli_query($conn, $strSQL);
        $return['response_status'] = 'Can not create account (ax0002)';
      }
    }else{
      $return['response_status'] = 'Can not create account (ax0001)';
    }
    echo json_encode($return);
    mysqli_close($conn); die();
  } // End register with email

} // End register

if($stage == 'get_log'){
  if(
    (!isset($_POST['uid'])) ||
    (!isset($_POST['log']))
  ){
    $return['response_status'] = 'Denine with un-completely parameters';
    mysqli_close($conn); die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $log = mysqli_real_escape_string($conn, $_POST['log']);

  if($log == 'change_own_password'){
    $strSQL = "SELECT * FROM ci2x_activity_log WHERE log_uid = '$uid' AND log_activity = 'Change own password'";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      while($row = mysqli_fetch_array($query)){
        $b = array();
        foreach ($row as $key => $value) {
          if(!is_int($key)){
            $b[$key] = $value;
          }
        }
        $return[] = $b;
      }
    }
  }

  echo json_encode($return);
  mysqli_close($conn); die();
}

if($stage == 'login'){

  if($protocol == 'email'){
    if(
      (!isset($_POST['email'])) ||
      (!isset($_POST['password']))
    ){
      $return['response_status'] = 'Denine with un-completely parameters';
      mysqli_close($conn); die();
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));

    $strSQL = "SELECT * FROM ci2x_account WHERE username = '$email' AND password = '$password' AND delete_status = 'N' AND active_status = 'Y' AND register_protocal = 'email' LIMIT 1";
    $result = mysqli_query($conn, $strSQL);
    if(($result) && (mysqli_num_rows($result) > 0)){
      $data = mysqli_fetch_assoc($result);

      $uid = $data['UID'];

      $strSQL = "INSERT INTO ci2x_activity_log (log_datetime, log_ip, log_activity, log_uid) VALUES ('$sysdatetime', '$ip', 'Log in', '$uid')";
                mysqli_query($conn, $strSQL);

      $return['response_status'] = 'Success';
      $return['response_uid'] = $data['UID'];
      $return['response_role'] = $data['role'];
    }else{
      $return['response_status'] = 'No data found';
      mysqli_close($conn); die();
    }

    echo json_encode($return);
    mysqli_close($conn); die();
  } // End register with email

} // End login


?>
