<?php include "../session.inc.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ICTCluster Account Management</title>

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../node_modules/preload.js/dist/css/preload.css">

    <link rel="stylesheet" href="../assets/custom/css/style.css">
    <link rel="stylesheet" href="../assets/custom/css/map.css">
  </head>
  <body>
    <div class="headerbar">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-7 pt-0">
            <nav class="navbar navbar-expand-lg navbar-light pl-0" style="margin-top: -10px; z-index: 99999 !important;">
              <a class="navbar-brand pt-0" href="../">
                <img src="../media/dmis-logo.png" height="40" alt="">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </nav>
          </div>
          <div class="col-12 col-sm-5 text-right text-dark" style="padding-top: 4px;">
            <i class="fas fa-user"></i> สวัสดี, คุณ<a href="../myaccount/" class="current_user_fullname"><i class="fas fa-sync fa-spin"></i></a>
            <button type="button" name="button" class="btn btn-danger btn-sm ml-2" onclick="authen.logout()">ออกจากระบบ</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="main-content mt-5">
        <div class="row">
          <div class="col-12 col-sm-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active fx3" href="index">หน้าแรก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="prpfile">ข้อมูลส่วนตัว</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="data">บันทึกและการนำเสนอ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="security">ความปลอดภัย</a>
              </li>
            </ul>
          </div>
          <div class="col-12 col-sm-9">
            <div class="row">
              <div class="col-12 text-center pb-3">
                <img src="../media/user.png" alt="" style="width: 150px;">
              </div>
              <div class="col-12 text-center">
                <div class="" style="font-size: 30px;">
                  สวัสดี, คุณ<span class="current_user_fullname"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>



  <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js" ></script>
  <script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../node_modules/preload.js/dist/js/preload.js"></script>

  <script type="text/javascript" src="../assets/custom/js/config.js"></script>
  <script type="text/javascript" src="../assets/custom/js/core.js"></script>
  <script type="text/javascript" src="../assets/custom/js/authentication.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      authen.current_user('current_user')
    })
  </script>
</html>
