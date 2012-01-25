<?php
	require_once('functions.php');
?>
<html>
<head>
<title>Varnish URL purger</title>

<link rel="stylesheet" href="css/screen.css" type="text/css" />

</head>

<body>
<!-- get jquery loaded -->
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>

<script language="javascript">
<!--
$(document).ready(function()
{
    $(".defaultText").focus(function(srcc)
    {
        if ($(this).val() == $(this)[0].title)
        {
            $(this).removeClass("defaultTextActive");
            $(this).val("");
        }
    });
    
    $(".defaultText").blur(function()
    {
        if ($(this).val() == "")
        {
            $(this).addClass("defaultTextActive");
            $(this).val($(this)[0].title);
        }
    });
    
    $(".defaultText").blur();        
});
//-->
</script>

<h1>A Varnish URL purger</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<p>
		The form below only asks for 1 thing: your entire URL you want to purge. 
		That is the exact URL you would copy from your browser's URI bar at the 
		top. The full URL should look like <i>http://mydomain.be/some/page.html</i>.
	</p>

	<h1>Enter the URL</h1>
	Your (entire) URL to purge: <input type="text" value="<?php isset($_POST['txtURL']) ? $_POST['txtURL'] : '' ?>" name="txtURL" class="defaultText" title="http://yourhost/some-url.html" /> 
	<input type="submit" name="cmdSubmit" value="Purge URL" class="submitButton" />
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
