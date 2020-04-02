// var conf = {
//   api: 'http://localhost/ictcluster/controller/',
//   prefix: 'xe2s_',
//   app: 'web'
// }

var conf = {
  api: 'http://simanh.psu.ac.th/ictcluster/controller/',
  prefix: 'xe2s_',
  app: 'web'
}

var current_user = window.localStorage.getItem(conf.prefix + 'uid')
var current_role = window.localStorage.getItem(conf.prefix + 'role')
