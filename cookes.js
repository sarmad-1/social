function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = 'expires='+d.toUTCString();
  document.cookie = cname + '=' + cvalue + ';' + expires ;
   document.cookie = "time=" + d ;
}

function getCookie(cname) {
  let name = cname + '=';
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return '';
}

function checkCookie() {
  let user = getCookie("<?php echo $id_user ; ?>");
  if (user != '') {
    alert('Welcome again ( ' + user +' ) your last login was in:');
  } else {
      user= "<?php echo $user_data['first_name']." ". $user_data['last_name'] ; ?>"
    if (user != '' && user != null) {
      setCookie("<?php echo $id_user ; ?>", user, 7);
    }
  }
}    
checkCookie();