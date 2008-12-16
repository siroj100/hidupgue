$(document).ready(function() {
  $('#formLogin').submit(function() {
    $.post('../user/login', $(this).find('input').serialize(), function(data)
    {
      if (data['result'] == 'ok') {
        window.location.href = '../view/frontend';
      }
    }, 'json');
    return false;
  });
}); 
