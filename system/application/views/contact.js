<?php if ($section === 'new') { ?>
$(function() {
  $('#formNewContact').submit(function() {
    $('#listContact div').html('<span style="background: #f00; color: #fff;">Loading...</span>');
    $.post('../contact/create', $('.newContact_').serialize(), function(data)
    {
      if ($('#listContact').length > 0) {
        $.listContact_reload();
      }
    }, 'json');
    return false;
  });
});
<?php } else if ($section === 'list') { ?>
$(function() {
  var listContact_reload = function() {
  $.getJSON('../contact/list_data', function(data) {
    var html = '<ul id="listContactName">\n';
    if (data.length > 0) {
      $.each(data, function(key, entry) {
        html += '<li>';
        html += entry['name']+'&nbsp;&nbsp;';
        html += '<a href="#" id="contactName_'+entry['id']+'" class="contactDetails">show detail</a>';
        html += '<div id="contact_'+entry['id']+'_details"></div>';
        html += '</li>\n';
      });
    }
    html += '</ul>\n';
    $('#listContact div').html(html);
    $('a.contactDetails').click(function() {
      var contactId = $(this).attr('id').substring(12);
      var elemId = '#contact_'+contactId+'_details';
      $.get('../view/contact/details/'+contactId,{}, function(data) {
        $(elemId).html(data);
      },'html');
      return false;
    });
  });
  };
  listContact_reload();
  if ($('#formNewContact').length > 0) {
    $.listContact_reload = function() {
      listContact_reload();
    }
  }
});
<?php } else if ($section === 'details') { ?>
$(function() {
alert('ok choy');
});
<?php } ?>
