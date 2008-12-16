<div id="newActivity">
<script src="../js/activity/new" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
  var myFormatDate = function(theDate) {
    return d.getFullYear()+'/'+(d.getMonth()+1)+'/'+d.getDate();
  }
  d = new Date();
  var html = '<option value="'+myFormatDate(d)+'">Hari ini ('+myFormatDate(d)+')</option>';
  d.setDate(d.getDate()-1);
  html += '<option value="'+myFormatDate(d)+'">Kemarin ('+myFormatDate(d)+')</option>'; 
  $('#newActivity_startExecutedDate').append(html);
});
</script>
<form id="formNewActivity">

<label>Nama</label>
<input type="input" id="newActivity_name" name="name" class="formInput newActivity_"/>

<label>Deskripsi</label>
<input type="input" id="newActivity_description" name="description" class="formInput newActivity_"/>

<label>Tanggal</label>
<select id="newActivity_startExecutedDate" name="startExecutedDate" class="formInput newActivity_">
</select>

<input id="newActivity_submit" type="submit" value="Buat"/>
</form>
</div>
