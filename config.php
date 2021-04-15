<?php
$DBSERVER = "db1.freehost.com.ua";
$DBUSER = "bsoft_bwsoftroot";
$DBPASS = "root71727";
$DB = "bsoft_bwsoft";
$link = mysql_connect($DBSERVER, $DBUSER, $DBPASS) or die("РќРµ РјРѕРіСѓ РїРѕРґРєР»СЋС‡РёС‚СЊСЃСЏ" );
mysql_select_db($DB, $link) or die ('РќРµ РјРѕРіСѓ РІС‹Р±СЂР°С‚СЊ Р‘Р”');
mysql_set_charset("utf8", $link);
