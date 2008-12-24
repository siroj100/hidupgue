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
<script src="../scripts/jquery.js" type="text/javascript"></script>
</head>
<body>

<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

<?php echo $new_contact; ?>
<?php echo $list_contact; ?>
<?php echo $new_activity; ?>
<?php echo $list_activity; ?>
<?php echo $new_note; ?>
<?php echo $list_note; ?>

<p><br />Page rendered in {elapsed_time} seconds</p>

</body>
</html>
