<?php if ($section === 'new') { ?>
$(function() {
  $('#formNewActivity').submit(function() {
  //$('#newActivity_submit').click(function() {
    $('#listActivity div').html('<span style="background: #f00; color: #fff;">Loading...</span>');
    //$.post('../activity/create', $(this).find('input').serialize(), function(data)
    $.post('../activity/create', $('.newActivity_').serialize(), function(data)
    {
      if ($('#listActivity').length > 0) {
        $.listActivity_reload();
      }
    }, 'json');
    return false;
  });
});
<?php } else if ($section === 'list') { ?>
$(function() {
  var listActivity_reload = function() {
  $.getJSON('../activity/list_data', function(data) {
    var html = '<table>\n<tr><th>Name</th><th>Description</th><th>Tanggal</th></tr>\n';
    if (data.length > 0) {
      $.each(data, function(key, entry) {
        html += '<tr>';
        html += '<td>'+entry['name']+'</td>';
        html += '<td>'+entry['description']+'</td>';
        if (entry['start_executed_date']) {
          html += '<td>'+entry['start_executed_date']+'</td>';
        } else {
          html += '<td>&nbsp;</td>';
        }
        html += '</tr>\n';
      });
    }
    html += '</table>\n';
    $('#listActivity div').html(html);
  });
  };
  listActivity_reload();
  if ($('#formNewActivity').length > 0) {
    $.listActivity_reload = function() {
      listActivity_reload();
    }
  }
});
<?php } ?>
