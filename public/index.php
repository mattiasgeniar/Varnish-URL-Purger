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
		// URL encode the entire input string
		$txtUrl = urlencode($_POST['txtURL']);

		// By URL encoding the entire input, it's also translated "http://", let's get that back
		$txtUrl = str_replace("http%3A%2F%2F", "http://", $txtUrl);

		// Ok, purge it
		varnishPurge($txtUrl);
	}
?>

</body>
</html>
