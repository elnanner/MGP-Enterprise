<?php
error_reporting (E_ALL ^ E_DEPRECATED);
$link= mysql_connect('mysql.hostinger.com.ar', 'u963478753_rodri', 'grassano1992'); //server, user, pass
if (!$link) {
	exit ();
}
else {
	mysql_select_db('u963478753_ing2',$link);
}
?>