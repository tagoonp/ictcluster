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
                  console.log(snap);
                })
    core.is_hideload(hl, arguments.callee.name)

  }
}
