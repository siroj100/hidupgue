$(function() {
  $('#formNewNote').submit(function() {
    $('#listNote div').html('<span style="background: #f00; color: #fff;">Loading...</span>');
    $.post('../note/create', $('.newNote_').serialize(), function(data)
    {
      $('#formNewNote :reset').click();
      listNote_reload();
    }, 'json');
    return false;
  });

  window.listNote_reload = function() {
    $.getJSON('../note/list_data', function(data) {
      var html = '<table>\n<tr><th>Title</th><th>Teks</th></tr>\n';
      if (data.length > 0) {
        $.each(data, function(key, entry) {
          html += '<tr>';
          html += '<td>'+entry['title']+'</td>';
          html += '<td>'+entry['teks']+'</td>';
          html += '</tr>\n';
        });
      }
      html += '</table>\n';
      $('#listNote div').html(html);
    });
  };

  listNote_reload();
});
