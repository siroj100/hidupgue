<fieldset>
<legend>Contact</legend>
<div id="searchContact">
<form id="formSearchContact">
<input type="button" id="button_newContact" value="+"/>
<input type="input" id="searchContact_value" name="value" class="formInput searchContact_"/>
<input type="submit" value="Cari"/><input type="reset" style="display: none"/> 
</form>
</div>

<div id="listContact" style="float: left;">
<div>
<span style="background: #f00; color: #fff;">Loading...</span>
</div>
</div>

<div id="contactDetails" style="float: left; display: none;">
</div>
</fieldset>

<div class="hiddenForms">

<div id="newContact">
<form id="formNewContact">

<table>
<tr>
<td align="right"><label>Nama</label></td>
<td align="left"><input type="input" id="newContact_name" name="name" class="formInput newContact_" size="40"/></td>
</tr>
<tr>
<td align="right"><label>Phone Number</label></td>
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

<input type="submit" value="Buat"/><input type="reset" style="display: none"/>
</form>
</div>
</div>

<script src="../js/contact" type="text/javascript"></script>

