if((current_user == null) || (current_role == null)){
  window.localStorage.removeItem(conf.prefix + 'uid')
  window.localStorage.removeItem(conf.prefix + 'role')
  window.location = conf.root_dir
}

var authen = {
  logout(){
    window.localStorage.removeItem(conf.prefix + 'uid')
    window.localStorage.removeItem(conf.prefix + 'role')
    window.location = conf.root_dir
  },
  current_user(hl){
    var param = { uid: current_user , role: current_role }
    var ajax = $.post(conf.api + 'authen?stage=user&protocol=0', param, function(){}, 'json')
                .always(function(snap){
                  if(snap.response_status == 'Success'){
                    $('.current_user_fullname').html(snap.fname + ' ' + snap.lname)
                  }else{
                    alert('Session denine')
                    authen.logout()
                  }
                })
    core.is_hideload(hl, arguments.callee.name)
  },
  get_log(hl, logtype){
    if(logtype == 'change_own_password'){
      var param = { uid: current_user, log: logtype}
      var ajax = $.post(conf.api + 'authen?stage=get_log&protocol=0', param, function(){}, 'json')
                  .always(function(snap){
                    console.log(snap);
                  })
    }
  }
}


$(function(){
  $('.changepasswordForm').submit(function(){
    $check = 0
    $('.form-control').removeClass('is-invalid')
    if($('#txtPassword1').val() == ''){ $check++; $('#txtPassword1').addClass('is-invalid'); }
    if($('#txtPassword2').val() == ''){ $check++; $('#txtPassword2').addClass('is-invalid'); }
    if($('#txtPassword1').val() != $('#txtPassword2').val()){ $check++; $('#txtPassword2').addClass('is-invalid'); }
    if($check != 0){ return ;}
    preload.show()
    var param = { uid: current_user, password: $('#txtPassword1').val() }
    var ajax = $.post(conf.api + 'authen?stage=updatepassword&protocol=self', param, function(){}, 'json')
                .always(function(snap){
                  if((snap!='') && (snap.response_status == 'Success')){
                    $('#modalChangepassword').modal('hide')
                    $('#txtPassword1').val('')
                    $('#txtPassword2').val('')
                    alert('ปรับปรุงรหัสผ่านสำเร็จ')
                    preload.hide()
                  }else{
                    preload.hide()
                    alert('ไม่สามารถเปลี่ยนรหัสผ่านได้')
                  }
                })
  })
})
