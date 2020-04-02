$('.registerForm').submit(function(){
  $check = 0
  $('.form-control').removeClass('is-invalid')
  if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid'); }
  if($('#txtLname').val() == ''){ $check++; $('#txtLname').addClass('is-invalid'); }
  if($('#txtPhone').val() == ''){ $check++; $('#txtPhone').addClass('is-invalid'); }
  if($('#txtEmail').val() == ''){ $check++; $('#txtEmail').addClass('is-invalid'); }
  if($('#txtPassword1').val() == ''){ $check++; $('#txtPassword1').addClass('is-invalid'); }
  if($('#txtPassword2').val() == ''){ $check++; $('#txtPassword2').addClass('is-invalid'); }
  if($('#txtPassword1').val() != $('#txtPassword2').val()){ $check++; $('#txtPassword2').addClass('is-invalid'); }
  if($check != 0){ return ;}
  var param = { fname: $('#txtFname').val() , lname: $('#txtLname').val(), phone: $('#txtPhone').val(), email: $('#txtEmail').val(), password: $('#txtPassword1').val() }
  var ajax = $.post(conf.api + 'authen?stage=register&protocol=email', param, function(){}, 'json')
              .always(function(snap){
                if(snap!=''){
                  if(snap.response_status == 'Success'){
                    window.localStorage.setItem(conf.prefix + 'uid', snap.response_uid)
                    window.localStorage.setItem(conf.prefix + 'role', snap.response_role)
                    window.location = './' + snap.response_role + '/'
                  }else if(snap.response_status == 'Duplicate username'){
                    alert('Duplicate username')
                  }else{
                    alert('Can not create account')
                  }
                }else{
                  alert('Can not create account')
                }
              })
})
