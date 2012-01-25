Varnish URL Purger
------------------

A sample set of PHP code to purge a Varnish URL from cache. Needs some cleaning up and finetuning. But it will show you the basics.

Securing this script
--------------------

It pains me to say this: the script was not written with security in mind, just as a proof-of-concept. Make sure this script is never accessible from the public. Use .htaccess lines in Apache to limit access the certain IP addresses or use htpasswd to password protect this script.

VCL requirements
----------------

Your varnish VCL files will need a minimum of

1. a vcl_hit() check for: req.request == "PURGE"
2. a purge() command to actually purge the URL
3. an ACL to only allow purging from certain IPs, including this host

For concrete examples, check the ACL, vcl_miss() and vcl_hit() parts at the following VCL file: [Varnish 3.0 Configuration Examples](https://github.com/mattiasgeniar/varnish-3.0-configuration-templates)
