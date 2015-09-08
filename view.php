
<!-- <div id="t1" class="tip">Server is not responding</div> -->
<?
include 'functions.php';
$cid=$_GET['customer_id'];
//global $srv_cnt;
if ( $_GET['customer_id'] ) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$query="SELECT * FROM group_table where customer_id=".$_GET['customer_id']." order by group_name";
$result=mysql_query($query);
$num=mysql_numrows($result);
//mysql_close();
$i=0;
while ($i < $num) {
$group_id=mysql_result($result,$i,"table_id");
$group_name=mysql_result($result,$i,"group_name");
//$group_name = get_server($group_id,"group_name");
//$server_host = get_server($group_id,"server_host");
echo "<a id=bobcontent${i}-title class=handcursor><font size=+1>$group_name</font></a><br>";
echo "<div id=bobcontent${i} class=switchgroup1>";
echo "<table border=0 cellpadding=5 cellspacing=3 width=90%><tr><td valign=top bgcolor=white width=400>";
//pasteServerNames($group_id);
//echo "</td><td>";

pasteEnvStatus($group_id);

echo "</td><td align=left bgcolor=white><font size=-1>";
# important links
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$queryz="SELECT * from url_table where group_id=$group_id";
$rz=mysql_query($queryz);
$newz=mysql_numrows($rz);
//echo "Count=$newz";
$z=0;
while ($z < $newz) {
$url_name=mysql_result($rz,$z,"url_name");
$url_uri=mysql_result($rz,$z,"url_uri");
$table_id=mysql_result($rz,$z,"table_id");
echo "<a target=_blank href=$url_uri>$url_name</a> - $url_uri<br>";
$z++;
}

//pasteIs16config($group_id);
//echo "</td><td align=center bgcolor=silver>";
//echo "test";
echo "</td></tr></table>";
echo "</div>";
$i++;
}
}
echo "$srv_cnt hosts returned."; 
?>

