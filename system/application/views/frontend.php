<html>
<head>
<title>Welcome</title>

<style type="text/css">
body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}
</style>
<script src="../javascripts/jquery.js" type="text/javascript"></script>
<script src="../javascripts/jquery.boxy.js" type="text/javascript"></script>
<link rel="stylesheet" href="../stylesheets/hidupgue.css" type="text/css" />
<link rel="stylesheet" href="../stylesheets/boxy.css" type="text/css" />
</head>
<body>

<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

<?php echo $contact; ?>
<?php echo $activity; ?>
<?php echo $note; ?>

<p><br />Page rendered in {elapsed_time} seconds</p>

</body>
</html>
