$(document).ready(function(){
  $('#btnLogin').click(function(){
    
    window.location.href='Login.php';
  });

  $('#btnRegistro').click(function(){
    window.location.href='Registro.php';
  });
  
});
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  } 