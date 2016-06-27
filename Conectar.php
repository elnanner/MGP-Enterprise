<?php
$link = mysql_connect ("localhost", "root", "");
if (!$link) {
	exit ();
}
else {
	mysql_select_db("couchinn",$link);
}
?>