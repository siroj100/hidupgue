<script type="text/javascript">
$(function() {
  var myFormatDate = function(theDate) {
    return d.getFullYear()+'/'+(d.getMonth()+1)+'/'+d.getDate();
  }
  d = new Date();
  d.setDate(d.getDate()+1);
  var html = '<option value="'+myFormatDate(d)+'">Besok ('+myFormatDate(d)+')</option>';
  d.setDate(d.getDate()-1);
  html += '<option value="'+myFormatDate(d)+'">Hari ini ('+myFormatDate(d)+')</option>'; 
  $('#newActivity_startExecutedDate').append(html);
});
</script>
<form id="formNewActivity">

<label>Nama</label>
<input type="input" id="newActivity_name" name="name" class="formInput newActivity_"/></br>

<label>Deskripsi</label>
<input type="input" id="newActivity_description" name="description" class="formInput newActivity_"/></br> 

<label>Tanggal</label>
<select id="newActivity_startExecutedDate" name="startExecutedDate" class="formInput newActivity_"> 
</select></br> 

<label>Waktu</label>
<select id="newActivity_startExecutedDateHour" name="startExecutedDateHour" class="formInput newActivity_">
<?php
  for ($jam = 0; $jam < 24; $jam++) {
    printf('<option value="%02d">%02d</option>', $jam, $jam);
  }
?>
</select> : 
<select id="newActivity_startExecutedDateMinute" name="startExecutedDateMinute" class="formInput newActivity_">
<?php
  for ($menit = 0; $menit < 60; $menit+=5) {
    printf('<option value="%02d">%02d</option>', $menit, $menit);
  }
?>
</select>
</br>

<input id="newActivity_submit" type="submit" value="Buat"/>
</form>
