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

  window.listContactDetails_reload = function(contactId) {
    $.getJSON('../contact/details/'+contactId, function(data) {
      var contactEmailMap = new Object();
      var html = '';
      if (data.length > 0) {
        $.each(data, function(key, entry) {
          $('#contactDetails').html('');
          $('#contactDetailsTemplate').clone().appendTo('#contactDetails');
          $('#contactName').attr('value',entry['name']);

          html += '<span>'+entry['name']+'</span>';
          html += '<ul>E-Mail&nbsp;';
          html += '<a href="#" id="contactEmailAdd_'+contactId+'" class="contactEmailAdd">add e-mail</a>';
          var index = 0;
          $.each(entry['email'], function(key_email, entry_email) {
            if (entry_email['email_address'] != null) {
              $('#contactEmail').clone().attr('id','contactEmail'+index).appendTo('#contactEmail_holder');
              $('#contactEmail'+index).append('br');
              $('#contactEmail'+index).attr('value',entry_email['email_address']); 
              index += 1;
              contactEmailMap[entry_email['id']] = entry_email['email_address'];

              html += '<li>';
              html += entry_email['email_address']+'&nbsp;';
              html += '<a href="#" id="contactEmailEdit_'+contactId+'_'+entry_email['id']+'" class="contactEmailEdit">edit</a>';
              html += '</li>';
            } else {
              html += '<li>No E-Mail</li>';
            }
          });
          html += '</ul>';
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
      }
      //$('#contactDetails').html(html);

      /*$('.contactEmailAdd').click(function() {
        $('#formNewContactEmail :reset').click();
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

      $('.contactPhoneAdd').click(function() {
        $('#formNewContactPhone :reset').click();
        $('#formNewContactPhone').attr('action','../contact/create_phone');
        var contactId = $(this).attr('id').substring(16);
        $('#newContactPhone_contactId').attr('value', contactId);
        if (window.boxyPhone == null) {
          window.boxyPhone = new Boxy($('#newContactPhone'), {modal: true});
        } else {
          window.boxyPhone.show();
        }
      });*/

      /*$('#contactDetails').css('display','block');
      $('#contactDetails').toggle('blind', { 
        direction: 'vertical' 
      }, 300);*/

    });
  }

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
      //$('#contactDetails').css('display','none');
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
