$('.loginForm').submit(function(){
  $check = 0
  $('.form-control').removeClass('is-invalid')
  if($('#txtEmail').val() == ''){ $check++; $('#txtEmail').addClass('is-invalid'); }
  if($('#txtPassword').val() == ''){ $check++; $('#txtPassword').addClass('is-invalid'); }
  if($check != 0){ return ;}
  var param = { email: $('#txtEmail').val(), password: $('#txtPassword').val() }
  var ajax = $.post(conf.api + 'authen?stage=login&protocol=email', param, function(){}, 'json')
              .always(function(snap){
                console.log(snap);
                if((snap!='')&&(snap.length > 0)){
                  snap.forEach(i=>{
                    if(i.response_status == 'Duplicate username'){
                      alert('Duplicate username')
                      console.log(i);
                    }else if(i.response_status == 'Success'){
                      window.localStorage.setItem(conf.prefix + 'uid', i.response_uid)
                      window.localStorage.setItem(conf.prefix + 'role', i.response_role)
                      window.location = './' + i.response_role + '/'
                    }else{
                      alert('Can not create account')
                      console.log(i);
                    }
                  })
                }else{
                  alert('Can not create account')
                }
              })
})
