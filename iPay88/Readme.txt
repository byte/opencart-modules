Descriptions:
============
This is a iPay88 plugin for OPENCART version 1.4.x

More info at : http://blog.ipay88.com



Release date:
=============
03-05-2010


Changelog
==========
Support OpenCart 1.4.7


Installation:
=============

1. copy the folder "admin" and "catalog" to your shopping cart folder.

2. log in to your admin backend

3. go to "Extensions" --> Payment --> iPay88 Payment Gateway --> Install 

4. Click "Edit" and you will see the following fields ;

Merchant ID/Code:  <-- key in your merchant code here

Merchant Key:   <-- key in your merchant key here

Order Status:   <-- select your status for successful status

Geo Zone:       <-- regional / zone setting

Status:         <-- set to "Enable"  

Sort Order:     <-- sort order of this gateway , 0,1,2,3,4 or ...

5. Save

6. Done.
 

Developer notes for Request & Response URLs:
============================================

Request URL  : yourdomain
Response URL : yourdomain/index.php?route=payment/ipay88/callback

example:

your domain is www.abc.com , your urls are:

Request URL  : http://www.abc.com
Response URL : http://www.abc.com/index.php?route=payment/ipay88/callback