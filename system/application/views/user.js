$(document).ready(function() {
  $('#formLogin').submit(function() {
    $.post('../user/login', $(this).find('input').serialize(), function(data)
    {
      if (data['result'] == 'ok') {
        window.location.href = '../view/frontend';
      } else {
        alert('Username atau password salah');
        $('#password').attr('value','');
      }
    }, 'json');
    return false;
  });
  $('#formCreateUser').submit(function() {
    $.post('../user/create', $(this).find('input').serialize(), function(data)
    {
      $('#formCreateUser :reset').click();
      alert(data);
    },'html');
    return false;
  });
}); 
