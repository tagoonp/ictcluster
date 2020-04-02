<?php include "config.inc.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ICT Cluster</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/all.css">

    <link rel="stylesheet" href="./assets/custom/css/style.css">
    <link rel="stylesheet" href="./assets/custom/css/map.css">
  </head>
  <body>
    <div class="headerbar d-none d-sm-block">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-7 pt-0">
            <nav class="navbar navbar-expand-lg navbar-light pl-0" style="margin-top: -10px; z-index: 99999 !important;">
              <a class="navbar-brand pt-0" href="#">
                <img src="media/dmis-logo.png" height="40" alt="">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-top: -5px;">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="index">หน้าแรก <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      เกี่ยวกับโครงการ
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">ข้อมูลโครงการ</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">ผู้พัฒนา</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">คู่มือการใช้งาน</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">ติดต่อเรา</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
          <div class="col-12 col-sm-5 text-right" style="padding-top: 4px;">
            <button type="button" name="button" class="btn btn-danger btn-sm" onclick="window.location='register'">สมัครใช้งานระบบ</button>
          </div>
        </div>
      </div>
    </div>


  </body>

  <div style="margin-top: 60px;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="text-center">ลงทะเบียนเข้าใช้งาน</h1>
          <h5 class="text-center text-muted">ระบบสารสนเทศเพื่อการจัดการภัยพิบัติเชิงบูรณาการ</h5>
          <h5 class="text-center text-muted">Disaster Management Information System : DMIS</h5>
        </div>
        <div class="col-12 col-sm-4 offset-sm-4">
          <div class="row mt-3">
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control" name="" value="" placeholder="E-mail address ...">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control" name="" value="" placeholder="รหัสผ่านสำหรับเข้าใช้งานระบบ ...">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group text-center">
                <button type="button" name="button" class="btn btn-primary btn-block">ล๊อคอิน</button>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group text-center">
                <button type="button" name="button" class="btn btn-block" onclick="window.location='register'">- สมัครใช้งานระบบ -</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="./node_modules/jquery/dist/jquery.min.js" ></script>
  <script type="text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="./node_modules/popper.js/dist/umd/popper.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      // setTimeout(function(){
      //   initMap()
      // }, 2000)
    })
  </script>
</html>
