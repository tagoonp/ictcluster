var core = {
  is_hideload(hl, fn){
    if(hl == fn){ setTimeout(function(){
      preload.hide()
    }, 1000)}
  },
  snap_exist(snap){
    if((snap != '') && (snap.length > 0)){
      return true;
    }else{
      return false;
    }
  }
}
