<?php if ($section === 'new') { ?>
$(function() {
  $('#formNewNote').submit(function() {
  //$('#submit').click(function() {
    $('#listNote div').html('<span style="background: #f00; color: #fff;">Loading...</span>');
    $.post('../note/create', $('.newNote_').serialize(), function(data)
    {
      if ($('#listNote').length > 0) {
        $.listNote_reload();
      }
    }, 'json');
    return false;
  });
});
<?php } else if ($section === 'list') { ?>
$(function() {
  var listNote_reload = function() {
  $.getJSON('../note/list_data', function(data) {
    var html = '<table>\n<tr><th>Title</th></tr>\n';
    if (data.length > 0) {
      $.each(data, function(key, entry) {
        html += '<tr>';
        html += '<td>'+entry['title']+'</td>';
        html += '</tr>\n';
      });
    }
    html += '</table>\n';
    $('#listNote div').html(html);
  });
  };
  listNote_reload();
  /*if ($('#formNewActivity').length > 0) {
    $.listActivity_reload = function() {
      listActivity_reload();
    }
  }*/
});
<?php } ?>
