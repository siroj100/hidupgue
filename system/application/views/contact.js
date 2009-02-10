$(function() {
  $('#button_newContact').click(function() {
    $('#formNewContact :reset').click();
    if (window.boxyContact == null) {
      window.boxyContact = new Boxy($('#newContact'), {title: "New Contact",modal: true});
    } else {
      window.boxyContact.show();
    }
  });

  $('#formSearchContact').submit(function() {
    var searchField = $('#searchContact_field').attr('value');
    var searchValue = $('#searchContact_value').attr('value');
    window.listContact_showLoading();
    if (searchValue.length > 0) {
      if (searchField == 'name') {
        window.listContact_reload('../contact/find_by_name/'+searchValue);
      } else if (searchField == 'email') {
      } else if (searchField == 'phone_number') {
      }
    } else {
      window.listContact_reload();
    }
    return false;
  });

  $('#formNewContact').submit(function() {
    $.post('../contact/create', $('.newContact_').serialize(), function(data){
      $('#formNewContact :reset').click();
      window.listContact_showLoading();
      listContact_reload();
      window.boxyContact.hide();
    }, 'json');
    return false;
  });

  $('#formNewContactPhone').submit(function() {
    var actionTarget = $(this).attr('action');
    $.post(actionTarget, $('.newContactPhone_').serialize(), function(data){
      var contactId = $('#newContactPhone_contactId').attr('value');
      $('#formSearchContact').submit();
      window.listContactDetails_reload(contactId);
      window.boxyPhone.hide();
      $('#formNewContactPhone :reset').click();
    }, 'json');
    return false;
  });

  $('#formNewContactEmail').submit(function() {
    var actionTarget = $(this).attr('action');
    $.post(actionTarget, $('.newContactEmail_').serialize(), function(data){
      var contactId = $('#newContactEmail_contactId').attr('value');
      $('#formSearchContact').submit();
      window.listContactDetails_reload(contactId);
      window.boxyEmail.hide();
      $('#formNewContactEmail :reset').click();
    }, 'json');
    return false;
  });

  window.listContact_showLoading = function() {
    $('#listContact').html('<span style="background: #f00; color: #fff;">Loading...</span>');
  }

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

  $('#contactEmail_cancel').click(function() {
    $('.contactEmailSpan').css('display','block');
    $('.contactEmailEdit').css('display','block');
    window.moveFormElements();
  });

  window.moveFormElements = function() {
    $('#contactId').appendTo('.hiddenForms');
    $('#id').appendTo('.hiddenForms');
    $('#emailAddress').appendTo('.hiddenForms');
    $('#contactEmail_submit').appendTo('.hiddenForms');
    $('#contactEmail_cancel').appendTo('.hiddenForms');
  
  };

  window.listContactDetails_reload = function(contactId) {
    window.moveFormElements();
    $.getJSON('../contact/details/'+contactId, function(data) {
      var contactEmailMap = new Object();
      var html = '';
      if (data.length > 0) {
        $.each(data, function(key, entry) {
          $('#contactDetails').html('');
          $('#contactDetailsTemplate').clone().appendTo('#contactDetails');
          $('#contactId').prependTo('#formContactDetails');
          $('#contactId').attr('value',entry['id']);
          $('#id').prependTo('#formContactDetails');
          $('#contactName').attr('value',entry['name']);
          $('#contactEmail_list').attr('rowspan',entry['email'].length+1);

          html += '<span>'+entry['name']+'</span>';
          html += '<a href="#" id="contactEmailAdd_'+contactId+'" class="contactEmailAdd">add e-mail</a>';
          var index = 0;
          var lastAppendedObj = $('#contactEmail_listStart');
          $.each(entry['email'], function(email_index, entry_email) {
            if (entry_email['email_address'] != null) {
              if (email_index == 0) {
                html = '<td class="contactEmail_td" title="'+entry_email['id']+'">';
                html += '<span class="contactEmailSpan" id="contactEmailSpan_'+entry_email['id']+'">'+entry_email['email_address']+'</span>';
                html += '</td>';
                html += '<td class="contactEmail_td" title="'+entry_email['id']+'">';
                html += '<a href="#" id="contactEmailEdit_'+entry_email['id']+'" class="contactEmailEdit" style="visibility: hidden">edit</a>';
                html += '</td>';
                lastAppendedObj.append(html);
              } else {
                html = '<tr>';
                html += '<td class="contactEmail_td" title="'+entry_email['id']+'">';
                html += '<span class="contactEmailSpan" id="contactEmailSpan_'+entry_email['id']+'">'+entry_email['email_address']+'</span>';
                html += '</td>';
                html += '<td class="contactEmail_td" title="'+entry_email['id']+'">';
                html += '<a href="#" id="contactEmailEdit_'+entry_email['id']+'" class="contactEmailEdit" style="visibility: hidden">edit</a>';
                html += '</td>';
                html += '</tr>';
                lastAppendedObj = lastAppendedObj.after(html);
              }
            } else {
              html += '<li>No E-Mail</li>';
            }
          });

          $('#formContactDetails').submit(function() {
            var actionTarget = $(this).attr('action');
            $.post(actionTarget, $('.contactDetails_').serialize(), function(data){
              var contactId = $('#contactId').attr('value');
              window.listContactDetails_reload(contactId);
            }, 'json');
            return false;
          });

          $('.contactEmail_td').hover(function() {
            var contactEmailId = $(this).attr('title');
            $('#contactEmailEdit_'+contactEmailId).css('visibility','visible');
          }, function() {
            var contactEmailId = $(this).attr('title');
            $('#contactEmailEdit_'+contactEmailId).css('visibility','hidden');
          });

          $('.contactEmailEdit').click(function() {
            $('#formContactDetails').attr('action','../contact/edit_email');
            $('.contactEmailSpan').css('display','block');
            $('.contactEmailEdit').css('display','block');
            var contactEmailId = $(this).attr('id').substring(17);
            $('#id').attr('value',contactEmailId);
            $('#contactEmailSpan_'+contactEmailId).css('display','none');
            $('#emailAddress').attr('value',$('#contactEmailSpan_'+contactEmailId).html()); 
            $('#emailAddress').insertAfter('#contactEmailSpan_'+contactEmailId);
            $('#emailAddress').focus();
            $('#contactEmail_submit').insertAfter('#'+$(this).attr('id'));
            $('#contactEmail_cancel').insertAfter('#contactEmail_submit');
            $(this).css('display','none');
          });

          html += '<ul>Phone&nbsp;';
          html += '<a href="#" id="contactPhoneAdd_'+contactId+'" class="contactPhoneAdd">add phone</a>'; 
          $.each(entry['phone_number'], function(key_phone, entry_phone) {
            if (entry_phone['phone_number'] != null) {
              html += '<li>';
              html += entry_phone['phone_number']+'&nbsp;';
              html += '</li>';
            } else {
              html += '<li>No Phone</li>';
            }
          });
          html += '</ul>';
        });
     };

    });
  };

  window.listContact_reload = function(data_url) {
    if (data_url == null) {
      data_url = '../contact/list_data';
    }
    $.getJSON(data_url, function(data) {
      var html = '<ul id="listContactName">\n';
      if (data.length > 0) {
        $.each(data, function(key, entry) {
          html += '<li class="kontak">';
          html += entry['name']+'&nbsp;&nbsp;';
          html += '<a style="font-size: 11px; color: #777;" href="#" id="contactName_'+entry['id']+'" class="contactDetails">show detail</a>';
          html += '<div style="font-size: 11px; color: #777;">';
          if (entry['phone_number'] != null) {
            html += 'p: '+entry['phone_number']+'<br/>';
          }
          if (entry['email_address'] != null) {
            html += 'e: '+entry['email_address']+'&nbsp;&nbsp;';
          }
          html += '<div id="contact_'+entry['id']+'_phone_details"></div>';
          html += '<div id="contact_'+entry['id']+'_email_details"></div>';
          html += '</div>';
          html += '</li>\n';
        });
      }
      html += '</ul>\n';
      $('#listContact').html(html);
      $('a.contactDetails').click(function() {
        var contactId = $(this).attr('id').substring(12);
        listContactDetails_reload(contactId);
        $('.kontak').removeClass('contactList_active');
        $(this).parent().addClass('contactList_active');
        return false;
      });

      $('.kontak').hover(function() {
        $(this).addClass('contactList_hover');
        $(this).css('cursor','pointer');
      }, function() {
        $(this).removeClass('contactList_hover');
      });
      $('.kontak').click(function() {
        $('.kontak').removeClass('contactList_active');
        $(this).addClass('contactList_active');
        var contactId = $(this).children('a').attr('id').substring(12);
        listContactDetails_reload(contactId);
      });
    });
  };
  listContact_reload();
});
