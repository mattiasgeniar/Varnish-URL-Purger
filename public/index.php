<?php
	require_once('functions.php');
?>
<html>
<head>
<title>Varnish URL purger</title>
</head>

<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	Your (entire) URL to purge: <input type="text" value="" name="txtURL" /><br />
	<input type="submit" name="cmdSubmit" value="Purge URL" />
</form>

<?php
	if (isset($_POST['cmdSubmit'])) {
		// Get the input string, don't sanitize?
		$txtUrl = $_POST['txtURL'];

		// Ok, purge it
		varnishPurge($txtUrl);
	}
?>

</body>
</html>
