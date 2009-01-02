<div id="newContact">
<form id="formNewContact">

<label>Nama</label>
<input type="input" id="newContact_name" name="name" class="formInput newContact_"/>

<input type="submit" value="Buat"/><input type="reset" style="display: none"/> 
</form>
</div>

<div id="listContact" >
<div>
<span style="background: #f00; color: #fff;">Loading...</span>
</div>
</div>

<div class="hiddenForms">

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

