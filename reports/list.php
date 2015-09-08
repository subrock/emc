<?php

function get_server ($srv_id,$srv_field) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$GetServerQuery="SELECT * FROM server_table where table_id=".$srv_id." order by server_name";
$GetServerResult=mysql_query($GetServerQuery);
mysql_close();
$srv_name=mysql_result($GetServerResult,0,$srv_field);
return $srv_name;
}












?>
