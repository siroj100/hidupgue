<fieldset style="width: 700px; height: 70%; border: 1px #000 dotted;">
<legend>Contact</legend>
<div id="searchContact">
<form id="formSearchContact">
<input type="button" id="button_newContact" value="+"/>
<input type="input" id="searchContact_value" name="value" class="formInput searchContact_"/>
<select id="searchContact_field" name="field">
  <option value="name">Name</option>
  <option value="email">E-Mail</option>
  <option value="phone_number">Phone</option>
</select>
<input type="submit" value="Cari"/><input type="reset" style="display: none"/> 
</form>
</div>
<br/>

<table width="100%">
<tr>
<td width="50%" valign="top">
<div id="listContact" style="float: left;">
<div>
<span style="background: #f00; color: #fff;">Loading...</span>
</div>
</div>
</td>

<td valign="top">
<div id="contactDetails" style="width: 100%;">
</div>
</td>
</tr>
</table>
</fieldset>

<div class="hiddenForms">

<div id="newContact">
<form id="formNewContact">
<table>
<tr>
<td><label>Nama</label></td>
<td align="left"><input type="input" id="newContact_name" name="name" class="formInput newContact_" size="40"/></td>
</tr>
<tr>
<td><label>Phone Number</label></td>
<td align="left"><input type="input" id="newContact_phoneNumber" name="phoneNumber" class="formInput newContact_"/></td>
</tr>
<tr>
<td align="right"><label>E-mail Address</label></td>
<td align="left"><input type="input" id="newContact_emailAddress" name="emailAddress" class="formInput newContact_"/></td>
</tr>
<tr>
<td align="right">&nbsp;</td>
<td align="left"><input type="submit" value="Buat"/><input type="reset" style="display: none"/></td>
</tr>
</table>
</form>
</div>

<div id="newContactPhone">
<form id="formNewContactPhone">

<label>Phone Number</label>
<input type="hidden" id="newContactPhone_id" name="id" class="formInput newContactPhone_" value="0"/>
<input type="hidden" id="newContactPhone_contactId" name="contactId" class="formInput newContactPhone_" value="0"/>
<input type="input" id="newContactPhone_phoneNumber" name="phoneNumber" class="formInput newContactPhone_"/>

<input type="submit" value="Buat"/><input type="reset" style="display: none"/>
</form>
</div>

<div id="newContactEmail">
<form id="formNewContactEmail">

<label>E-mail Address</label>
<input type="hidden" id="newContactEmail_id" name="id" class="formInput newContactEmail_" value="0"/>
<input type="hidden" id="newContactEmail_contactId" name="contactId" class="formInput newContactEmail_" value="0"/>
<input type="input" id="newContactEmail_emailAddress" name="emailAddress" class="formInput newContactEmail_"/>

<input type="submit" value="Buat"/><input type="reset" style="display: none"/><br/>

<label>Primary</label>
<input type="checkbox" id="newContactEmail_primaryFlag" name="primaryFlag" class="formInput newContactEmail_" checked="checked" value="1"/>

</form>
</div>

<div id="contactDetailsTemplate">
<table width="100%">
<tr>
<td valign="top" align="right" width="30%"><label>Nama</label>&nbsp;</td>
<td><input type="text" id="contactName" class="formDisplay" readonly="readonly"/></td>
</tr>
<td valign="top" align="right"><label>E-mail</label>&nbsp;</td>
<td id="contactEmail_holder"></td>
</table>
</div>
<input type="text" id="contactEmail" class="formDisplay" readonly="readonly"/>

</div>

<script src="../js/contact" type="text/javascript"></script>

