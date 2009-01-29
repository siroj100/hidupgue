<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Welcome</title>
<script src="../javascripts/jquery.js" type="text/javascript"></script>
<script src="../javascripts/jquery.ui.all.js" type="text/javascript"></script>
<script src="../javascripts/jquery.boxy.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../stylesheets/yui-reset.css"> 
<link rel="stylesheet" type="text/css" href="../stylesheets/yui-fonts.css"> 
<link rel="stylesheet" type="text/css" href="../stylesheets/yuigrids.css"> 
<link rel="stylesheet" type="text/css" href="../stylesheets/yui-base.css"> 
<link rel="stylesheet" href="../stylesheets/hidupgue.css" type="text/css" />
<link rel="stylesheet" href="../stylesheets/boxy.css" type="text/css" />
</head>
<body>

<h3>Welcome, <?php echo $_SESSION['username']; ?>!, you are using: <?php echo $user_agent; ?></h3>

<?php echo $contact; ?>

<p><br />Page rendered in {elapsed_time} seconds</p>
<ul>
  <li>test0</li>
  <li>test1</li>
  <li>test2</li>
  <li>test3</li>
  <li>test4</li>
</ul>

</body>
</html>
