<?php include "../session.inc.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ICT Cluster</title>

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
              <a class="navbar-brand pt-0" href="#">
                <img src="../media/dmis-logo.png" height="40" alt="">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-top: -5px;">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">หน้าแรก <span class="sr-only">(current)</span></a>
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
          <div class="col-12 col-sm-5 text-right text-dark" style="padding-top: 4px;">
            <i class="fas fa-user"></i> สวัสดี, คุณ<a href="../myaccount/" class="current_user_fullname"><i class="fas fa-sync fa-spin"></i></a>
            <button type="button" name="button" class="btn btn-danger btn-sm ml-2" onclick="authen.logout()">ออกจากระบบ</button>
          </div>
        </div>
      </div>
    </div>


  </body>

  <div id="map"></div>



  <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js" ></script>
  <script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../node_modules/preload.js/dist/js/preload.js"></script>

  <script type="text/javascript" src="../assets/custom/js/config.js"></script>
  <script type="text/javascript" src="../assets/custom/js/core.js"></script>
  <script type="text/javascript" src="../assets/custom/js/custom_map.js"></script>
  <script type="text/javascript" src="../assets/custom/js/authentication.js"></script>

  <script type="text/javascript">
    var map;
    $(document).ready(function(){
      authen.current_user('current_user')
    })

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 7.006961, lng: 100.496673},
          zoom: 14,
          styles: mapStyle,
          mapTypeControl: false
        });

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            map.setCenter(pos);
            $('#txtLat1').val(pos.lat)
            $('#txtLng1').val(pos.lng)

            var marker = new google.maps.Marker({
              position: pos
            });
            marker.setMap(map)
          }, function() {
            var marker = new google.maps.Marker({
                position: {lat: 7.006961, lng: 100.496673},
                title:"Epidemiology Unit, Faculty of Medicine, Prince of Songkla Unversity"
            });
            marker.setMap(map)
          });
        }else{
          var marker = new google.maps.Marker({
              position: {lat: 7.006961, lng: 100.496673},
              title:"Epidemiology Unit, Faculty of Medicine, Prince of Songkla Unversity"
          });
          marker.setMap(map)
        }
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0E1KEH3IhhBzgK8P9_GQ_ncY6rwpiXDM&callback=initMap" async defer></script>
</html>
