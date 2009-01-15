<html>
<head>
<title>Welcome</title>

<style type="text/css">
body {
 /*background-color: #fff;
 margin: 40px;*/
 font-family: Lucida Grande, Verdana, Sans-serif;
 /*font-size: 14px;
 color: #4F5155;*/
}
</style>
<script src="../javascripts/jquery.js" type="text/javascript"></script>
<script src="../js/user" type="text/javascript"></script>
<link rel="stylesheet" href="../stylesheets/hidupgue.css" type="text/css" />
</head>
<body>
<?php echo date('r'); ?>
<form id="formCreateUser">
  <label>User Name</label> : <input type"text" name="username" length="50"/><br/>
  <label>Password</label> : <input type="password" name="password" length="50"/><br/>
  <input type="submit" value="Buat"/>
  <input type="reset" style="display: none"/>
</form>

</body>
</html>
