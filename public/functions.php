<?php

/**
 * varnishPurge
 *
 * @param mixed $txtUrl
 * @access public
 * @return void
 */
function varnishPurge ($txtUrl) 
{
    // Step one: prepare the string, strip the http:// prefix
	$txtUrl = str_replace("http://", "", $txtUrl);
	
	// Get the hostname/fqdn and the URL
	$hostname = substr($txtUrl, 0, strpos($txtUrl, '/'));
	$url = substr($txtUrl, strpos($txtUrl, '/'), strlen($txtUrl));

	// Open connection to Varnish and send the Purge request
	$errno = (integer) "";
	$errstr = (string) "";
	$varnish_sock = fsockopen("127.0.0.1", "80", $errno, $errstr, 10);
	if (!$varnish_sock) {
        	error_log("Varnish connect error: ". $errstr ."(". $errno .")");
	} else {
		// Build the request
       	$cmd = "PURGE ". $url ." HTTP/1.0\r\n";
		$cmd .= "Host: ". $hostname ."\r\n";
		$cmd .= "Connection: Close\r\n";
		// Finish the request
		$cmd .= "\r\n";

		// Send the request
		echo "Sending request: <blockquote>". nl2br($cmd) ."</blockquote>";
		fwrite($varnish_sock, $cmd);

		// Get the reply
		echo "Received answer: <blockquote>";
		$response = "";
		while (!feof($varnish_sock)) {
			$response .= fgets($varnish_sock, 128);
		}
		echo nl2br($response);
		echo "</blockquote>";
	}

	// Close the socket
	fclose($varnish_sock);
}

/**
 * varnishPurgedSimplifiedExample
 *
 * @access public
 * @return void
 */
function varnishPurgedSimplifiedExample ( ) 
{
    // Open the socket
    $errno = ( integer) "";
    $errstr = ( string) "";
    $varnish_sock = fsockopen( "127.0.0.1", "80", $errno, $errstr, 10);

    // Prepare the command to send
    $cmd = "PURGE /some/webpage/of/me.html HTTP/1.0\r\n";
    $cmd .= "Host: www.mydomain.be\r\n";
    $cmd .= "Connection: Close\r\n";
    $cmd .= "\r\n";

    // Send the request
    fwrite( $varnish_sock, $cmd);

    // Close the socket
    fclose( $varnish_sock);
}

?>
