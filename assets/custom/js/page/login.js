$('.loginForm').submit(function(){
  $check = 0
  $('.form-control').removeClass('is-invalid')
  if($('#txtEmail').val() == ''){ $check++; $('#txtEmail').addClass('is-invalid'); }
  if($('#txtPassword').val() == ''){ $check++; $('#txtPassword').addClass('is-invalid'); }
  if($check != 0){ return ;}
  var param = { email: $('#txtEmail').val(), password: $('#txtPassword').val() }
  var ajax = $.post(conf.api + 'authen?stage=login&protocol=email', param, function(){}, 'json')
              .always(function(snap){
                if((snap!='') && (snap.response_status == 'Success')){
                  window.localStorage.setItem(conf.prefix + 'uid', snap.response_uid)
                  window.localStorage.setItem(conf.prefix + 'role', snap.response_role)
                  window.location = './' + snap.response_role + '/'
                }else{
                  alert('Can not login')
                }
              })
})
