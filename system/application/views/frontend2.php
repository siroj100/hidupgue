<html>
<head>
<title>Welcome</title>
<script src="../javascripts/jquery.js" type="text/javascript"></script>
<script src="../javascripts/jquery.ui.all.js" type="text/javascript"></script>
<script src="../javascripts/jquery.boxy.js" type="text/javascript"></script>
<link rel="stylesheet" href="../stylesheets/hidupgue.css" type="text/css" />
<link rel="stylesheet" href="../stylesheets/boxy.css" type="text/css" />
</head>
<body>

<h3>Welcome, <?php echo $_SESSION['username']; ?>!, you are using: <?php echo $user_agent; ?></h3>

<?php echo $contact; ?>

<p><br />Page rendered in {elapsed_time} seconds</p>

</body>
</html>
