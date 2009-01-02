$(function() {
  var formNewActivitySubmit = function() {
    $('#listActivity div').html('<span style="background: #f00; color: #fff;">Loading...</span>');
    $.post('../activity/create', $('.newActivity_').serialize(), function(data)
    {
      $('#formNewActivity :reset').click();
      listActivity_reload();
    }, 'json');
    return false;
  };

  $('#newActivity_type').change(function() {
    var activityType = $(this).attr('selectedIndex'); 
    if (activityType > 0) {
      $('#newActivity div').show();
      $('#newActivity div').load('../view/activity/new/'+activityType, function() {
        $('#formNewActivity').submit(formNewActivitySubmit);
      });
    } else {
      $('#newActivity div').hide();
    }
  });

  window.listActivity_reload = function() {
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
  
});
