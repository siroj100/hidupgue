<div id="newActivity">
<form id="formNewActivityMain">

<label>Jenis Aktivitas</label>
<select id="newActivity_type" name="activityType" class="formInput newActivity_"></select>
</form>
<div>
</div>
<script type="text/javascript">
$(function() {
  $.getJSON('../activity/list_activity_type', function(data) {
    var html = '<option></option>\n';
    if (data.length > 0) {
      $.each(data, function(key, entry) {
        html += '<option value="'+entry['enum_value']+'">'+entry['enum_value_desc']+'</option>\n';
      });
    }
    $('#newActivity_type').append(html);
  });
});
</script>
<script src="../js/activity/new" type="text/javascript"></script>
</div>
