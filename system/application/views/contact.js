$(function() {
  $('#formNewContact').submit(function() {
    $('#listContact div').html('<span style="background: #f00; color: #fff;">Loading...</span>');
    $.post('../contact/create', $('.newContact_').serialize(), function(data){
      $('#formNewContact :reset').click();
      listContact_reload();
    }, 'json');
    return false;
  });

  $('#formNewContactPhone').submit(function() {
    var actionTarget = $(this).attr('action');
    $.post(actionTarget, $('.newContactPhone_').serialize(), function(data){
      var contactId = $('#newContactPhone_contactId').attr('value');
      listContactPhone_reload(contactId);
      window.boxyPhone.hide();
      $('#formNewContactPhone :reset').click();
    }, 'json');
    return false;
  });

  $('#formNewContactEmail').submit(function() {
    var actionTarget = $(this).attr('action');
    $.post(actionTarget, $('.newContactEmail_').serialize(), function(data){
      var contactId = $('#newContactEmail_contactId').attr('value');
      listContactEmail_reload(contactId);
      window.boxyEmail.hide();
      $('#formNewContactEmail :reset').click();
    }, 'json');
    return false;
  });

  window.listContactPhone_reload = function(contactId) {
    var elemId = '#contact_'+contactId+'_phone_details';
    var html = '<table>';
    var contactPhoneMap = new Object();
    html += '<tr><th>Phone</th>';
    html += '<td colspan="2"><a href="#" id="contactPhoneAdd_'+contactId+'" class="contactPhoneAdd">add phone</a></td></tr>';
    $.getJSONsync('../contact/list_phone_details/'+contactId, function(data) {
      if (data.length > 0) {
        $.each(data, function(key, entry) {
          html += '<tr><td>&nbsp;</td>';
          html += '<td>'+entry['phone_number']+'</td>';
          html += '<td align="right"><a href="#" id="contactPhoneEdit_'+contactId+'_'+entry['id']+'" class="contactPhoneEdit">edit</a></td></tr>';
          contactPhoneMap[entry['id']] = entry['phone_number'];
        });
      }
    });
    html += '</table>';
    $(elemId).html(html);

    $('.contactPhoneAdd').click(function() {
      $('#formNewContactPhone').attr('action','../contact/create_phone');
      var contactId = $(this).attr('id').substring(16);
      $('#newContactPhone_contactId').attr('value', contactId);
      if (window.boxyPhone == null) {
        window.boxyPhone = new Boxy($('#newContactPhone'), {modal: true});
      } else {
        window.boxyPhone.show();
      }
    });

    $('.contactPhoneEdit').click(function() {
      $('#formNewContactPhone').attr('action','../contact/edit_phone');
      var ids = $(this).attr('id').split('_');
      var contactId = ids[1];
      var contactPhoneId = ids[2];
      $('#newContactPhone_id').attr('value',contactPhoneId);
      $('#newContactPhone_contactId').attr('value', contactId);
      $('#newContactPhone_phoneNumber').attr('value', contactPhoneMap[contactPhoneId]);
      if (window.boxyPhone == null) {
        window.boxyPhone = new Boxy($('#newContactPhone'), {modal: true});
      } else {
        window.boxyPhone.show();
      }
    });
  };

  window.listContactEmail_reload = function(contactId) {
    var elemId = '#contact_'+contactId+'_email_details';
    var html = '<table>';
    var contactEmailMap = new Object();
    html += '<tr><th>E-Mail</th>';
    html += '<td colspan="2"><a href="#" id="contactEmailAdd_'+contactId+'" class="contactEmailAdd">add e-mail</a></td></tr>';
    $.getJSONsync('../contact/list_email_details/'+contactId, function(data) {
      if (data.length > 0) {
        $.each(data, function(key, entry) {
          html += '<tr><td>&nbsp;</td>';
          html += '<td>'+entry['email_address']+'</td>';
          html += '<td align="right"><a href="#" id="contactEmailEdit_'+contactId+'_'+entry['id']+'" class="contactEmailEdit">edit</a></td></tr>';
          contactEmailMap[entry['id']] = entry['email_address'];
        });
      }
    });
    html += '</table>';
    $(elemId).html(html);

    $('.contactEmailAdd').click(function() {
      $('#formNewContactEmail').attr('action','../contact/create_email');
      var contactId = $(this).attr('id').substring(16);
      $('#newContactEmail_contactId').attr('value', contactId);
      if (window.boxyEmail == null) {
        window.boxyEmail = new Boxy($('#newContactEmail'), {title: "New Email", modal: true});
      } else {
        window.boxyEmail.show();
      }
    });

    $('.contactEmailEdit').click(function() {
      $('#formNewContactEmail').attr('action','../contact/edit_email');
      var ids = $(this).attr('id').split('_');
      var contactId = ids[1];
      var contactEmailId = ids[2];
      $('#newContactEmail_id').attr('value',contactEmailId);
      $('#newContactEmail_contactId').attr('value', contactId);
      $('#newContactEmail_emailAddress').attr('value', contactEmailMap[contactEmailId]);
      if (window.boxyEmail == null) {
        window.boxyEmail = new Boxy($('#newContactEmail'), {title: "New Email", modal: true});
      } else {
        window.boxyEmail.show();
      }
    });
  };

  window.listContact_reload = function() {
    $.getJSON('../contact/list_data', function(data) {
      var html = '<ul id="listContactName">\n';
      if (data.length > 0) {
        $.each(data, function(key, entry) {
          html += '<li>';
          html += entry['name']+'&nbsp;&nbsp;';
          html += '<a href="#" id="contactName_'+entry['id']+'" class="contactDetails">show detail</a>';
          html += '<div id="contact_'+entry['id']+'_phone_details"></div>';
          html += '<div id="contact_'+entry['id']+'_email_details"></div>';
          html += '</li>\n';
        });
      }
      html += '</ul>\n';
      $('#listContact div').html(html);
      $('a.contactDetails').click(function() {
        var contactId = $(this).attr('id').substring(12);

        listContactPhone_reload(contactId);
        listContactEmail_reload(contactId);

        return false;
      });
    });
  };
  listContact_reload();
});
