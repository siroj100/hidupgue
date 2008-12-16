$(document).ready(function() {
  alert('test');
  $('#formLogin').submit(function() {
    /*$.post('user/login', $(this).find('input').serialize(), function(data)
    {
      alert(data+","+data['result']);
    }, 'json');*/
    return false;
  });
}); 

