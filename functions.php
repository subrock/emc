<?

function islive($addr) {
//Test the server connection
$link = $addr;
echo $link;
$s_link = str_replace("::", ":", $link);
list($addr,$port)= explode (':',"$s_link");
if (empty($port)){
    $port = 80;
	}
	
$churl = @fsockopen(server($addr), $port, $errno, $errstr, 1);
if (!$churl){
	if ( "$errstr" == "Connection refused" ) {
		return "<font color=red><b><blink>Offline</blink></b></a></font>";
	} else {
		return "<font color=orange><b><blink>Offline</blink></b></a></font>";						  
	}
}
else {
	return "<font color=green><b>Online</b></font>";
}
}


function tblive($addr) {
//Test the server connection
$link = $addr;
//echo $link;
$s_link = str_replace("::", ":", $link);
list($addr,$port)= explode (':',"$s_link");
if (empty($port)){
    $port = 80;
        }

$churl = @fsockopen(server($addr), $port, $errno, $errstr, 1);
if (!$churl){
        if ( "$errstr" == "Connection refused" ) {
                return "<td  onmouseout='popUp(event,'t1')' onmouseover=popUp(event,'t1') onclick='return false' bordercolor=silver bgcolor=red>&nbsp;&nbsp;</td>";
        } else {
                return "<td bordercolor=silver bgcolor=orange>&nbsp;&nbsp;</td>";
        }
}
else {
        return "<td bordercolor=silver bgcolor=green>&nbsp;&nbsp;</td>";
}
}



function server($addr){
	if(strstr($addr,"/")){$addr = substr($addr, 0, strpos($addr, "/"));}
	return $addr;
}
																													 
function piclive($addr) {
//Test the server connection
$link = $addr;
$s_link = str_replace("::", ":", $link);
list($addr,$port)= explode (':',"$s_link");
if (empty($port)){
    $port = 80;
        }

include('themes/'.$_COOKIE['theme_name'].'.inc');
$churl = @fsockopen(server($addr), $port, $errno, $errstr, 1);
if (!$churl){
        if ( "$errstr" == "Connection refused" ) {
                return "src=$a2pic";
        } else {
                return "src=$a3pic";
        }
}
else {
        return "src=$a1pic";
}
}




function get_server ($srv_id,$srv_field) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$GetServerQuery="SELECT * FROM server_table where table_id=".$srv_id." order by server_name";
$GetServerResult=mysql_query($GetServerQuery);
mysql_close();
$srv_name=mysql_result($GetServerResult,0,$srv_field);
return $srv_name;
}

function get_group ($grp_id,$grp_field) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$GetServerQuery="SELECT * FROM group_table where table_id=$grp_id";
$GetServerResult=mysql_query($GetServerQuery);
mysql_close();
$grp_name=mysql_result($GetServerResult,0,$grp_field);
return $grp_name;
}


function pasteServerNames ($group_id) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$GetServerQuery="SELECT * FROM server_mapping where group_id=$group_id";
$GetServerResult=mysql_query($GetServerQuery);
$num=mysql_numrows($GetServerResult);
echo "<textarea cols=45 rows=2 readonly noscrollbar name=servers style='border: 1px;'>";
$i=0;
while ($i < $num) {
$server_id=mysql_result($GetServerResult,$i,"server_id");

echo  get_server ($server_id,"server_host");
$i++;
}
echo "</textarea>";
return;
}


function get_type ($typ_id,$typ_field) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$GetTypeQuery="SELECT * FROM type_table where table_id=".$typ_id." order by type_port DESC";
$GetTypeResult=mysql_query($GetTypeQuery);
mysql_close();
$typ_name=mysql_result($GetTypeResult,0,$typ_field);
return $typ_name;
}


function get_category ($category_id) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$GetTypeQuery="SELECT * FROM category_table where table_id=$category_id";
$GetTypeResult=mysql_query($GetTypeQuery);
mysql_close();
$typ_name=mysql_result($GetTypeResult,0,"category_name");
return $typ_name;
}



function pasteEnvStatus ($group_id) {

echo "<table border=1 cellpadding=2 cellspacing=2 bordercolor=white bgclor=#EFF1C9><tr>";
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$query="SELECT * FROM server_mapping where group_id=".$group_id." order by server_id";
$result=mysql_query($query);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {

$server_id=mysql_result($result,$i,"server_id");

$server_name = get_server($server_id,"server_name");
$server_host = get_server($server_id,"server_host");
$ip = gethostbyname($server_host);
echo "<td width=350 bordercolor=silver><font size=2>$server_host ($ip)</td><td bordercolor=white><font size=1>";
global $srv_cnt;
$srv_cnt++;

// Start Here - Connect to database
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$queryt="SELECT * FROM type_mapping where server_id=$server_id order by type_id ASC";
$resultt=mysql_query($queryt);
$numt=mysql_numrows($resultt);
$t=0;
while ($t < $numt) {
$type_id=mysql_result($resultt,$t,"type_id");
echo $type;
// Get port information
$type_port = get_type($type_id,"type_port");
$type_name = get_type($type_id,"type_name");
$port_res = piclive($server_host.":".$type_port);

if ( "$type_port" == "443" ) {
echo "<a HREF=javascript:void(0) onclick=window.open('simple_view.php?host=$server_host&port=$type_port','welcome','resizable=yes,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes')><img width=15 height=15 $port_res border=0 title='$server_host:$type_port' /></a>";
}
if ( "$type_port" == "22" ) {
echo "<a HREF=javascript:void(0) onclick=window.open('goto.php?host=$server_host','welcome','resizable=yes,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes')><img width=15 height=15 $port_res border=0 title='$server_host:$type_port' /></a>";
} else {
echo "<img width=15 height=15 $port_res border=0 title=$server_host:$type_port>";
}
if ( $t < $numt-1  ) {
  echo "";
 }

$t++;

}


//echo "<br><br>";
echo "</td></tr>";
$i++;
}
echo "</table>";


}








function pasteIs16config ($group_id) {

echo "<table border=0 cellpadding=0 cellspacing=0><tr><Td>";

echo "<font size=1>No data available.";

echo "</td></tr></table>";

}








//ql_close();
?>

