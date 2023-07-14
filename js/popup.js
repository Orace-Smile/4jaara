// Declaration des variables
const dialog = document.getElementById("dialog");

const btn_open = document.getElementById("open");

const btn_close = document.getElementById("close");

//ouverture du popup
btn_open.addEventListener('click',function(){dialog.setAttribute('open',true);});
//fermeture du popup
btn_close.addEventListener('click',function(){dialog.removeAttribute('open',true);});