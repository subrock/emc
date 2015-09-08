<?
if ( $_GET['filt'] ) {
	$filt=$_GET['filt'];
} else {
	$filt="";
}

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");

if ( $_GET['del'] ) {
$query="select * from type_mapping where server_id=".$_GET['del'];
$result=mysql_query($query);
$num=mysql_numrows($result);
if ( $num == 0 ) {

$query="DELETE FROM server_table where table_id=".$_GET['del'];
$result=mysql_query($query);
header("location: admServerManager.php?filt=$filt");
} else {
echo "<font color=red face=verdana>You must remove all service mappings first.</font> <br><Br>";
}


}

if ( $_GET['server_host'] ) {
$query="SELECT server_host from server_table where server_host='".$_GET['server_host']."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ( $num < 1 ) {
$query="INSERT INTO server_table (server_name, server_host) VALUES ('".$_GET['server_host']."','".$_GET['server_host']."')";
$result=mysql_query($query);
//echo $query;

//echo $result;

//header("location: admGroupManager.php");

//echo $_GET['add'];

//exit;
}

}

if ( $_GET['change'] == 1 ) {

$query="INSERT INTO type_mapping (type_id, server_id) VALUES ('".$_GET['type_id']."','".$_GET['server_id']."')";
//SELECT * FROM group_table where table_id=".$_GET['del'];
$result=mysql_query($query);
//header("location: admGroupManager.php");
//exit;

}

if ( $_GET['change'] == 2 ) {

$query="DELETE FROM type_mapping where server_id=".$_GET['server_id']." and type_id=".$_GET['type_id'];
//echo $query;
$result=mysql_query($query);
//header("location: admGroupManager.php");


}


?>


<html><head><title></title>
<style>
a:hover {
        color:red;
		        }
				a:visited {color:blue}
				a:visited:hover {
				        color:red;
						        }
								a {text-decoration: none}
								.inputv {
								       background-color: #EFF1C9;
									          color: #336699;
											         font-family: Arial, Helvetica, sans-serif;
													        font-size: 12px;
															       border: 1px solid #000000;
																          width: 200px;
																		          }
																				  </style>


</head>
<body>



<?php
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");


$query="SELECT * FROM server_table where server_name like '%$filt%' order by server_name";
//echo $query;
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();
$i=0;
echo "<table border=0 cellpadding=0 cellspacing=0 width=600><tr><td><font face=verdana size=2 color=gray><b>Manage Addresses</b></td><td align=right><font face=verdana size=2 color=gray><a href=#bot>Bottom of page</a></font></td></tr></table><table border=1 cellpadding=0 cellspacing=0 bordercolor=#E5E5E5><tr><td><table border=0 cellpadding=3 cellspacing=2 width=600>";
echo "<font face=verdana size=1><form method=get action=admServerManager.php>Filter:<br><input class=inputv type='text' name='filt' value='$filt'> <input type=submit value='Filter'>";

while ($i < $num) {

$server_id=mysql_result($result,$i,"table_id");
$server_name=mysql_result($result,$i,"server_name");
//$server_type_id=mysql_result($result,$i,"server_type_id");
$server_host=mysql_result($result,$i,"server_host");

echo "<tr></form><td bgcolor=#E5E5E5><font face=verdana size=1><a href=admServerManager.php?server_id=$server_id&filt=$filt>$server_name</a></td>";
echo "<td bgcolor=#E5E5E5><font face=verdana size=1>$server_host</td>";
echo "<td width=10 bgcolor=#E5E5E5><font face=verdana size=1>[<a href=admServerManager.php?del=$server_id&filt=$filt>DEL</a>]</td></tr>";
$i++;

}
?>
<tr><form method=get action=admServerManager.php>
<td>
<font face=verdana size=1>
Address:<br><input class=inputv type='text' name='server_host' value=''><br>
<input type=hidden name=filt value='<? echo $filt; ?>'>
<input type=submit value='Create'></td></form></tr></table></td></tr></table>

<!-- Selected Start Here -->
<?

if ( $_GET['server_id'] ) {
?>
<br>

<form method=get action=admServerManager.php name=combo_box>
<font face=verdana size=2 color=gray><b>Service Mapping:</b><Br>
<table width=405 border=1 cellpadding=0 cellspacing=0 bordercolor=#E5E5E5>
<tr><td align=left><font face=verdana size=1>

<table width=100% cellpadding=2 cellspacing=3 border=0><th width=50% align=left><font face=verdana size=1>Selected</th><th align=left><font face=verdana size=1>Service List</th>
<tr>
<td bgcolor=#E5E5E5 valign=top><font face=verdana size=1>
<?

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");


$i=0;
$query="SELECT * FROM type_mapping where server_id=".$_GET['server_id'];
$result=mysql_query($query);

$num=mysql_numrows($result);
while ($i < $num) {
$type_id=mysql_result($result,$i,"type_id");
//echo $server_id;

$query="SELECT * FROM type_table where table_id=".$type_id;
$result2=mysql_query($query);
$num2=mysql_numrows($result2);
if ( $num2 > 0 ) {
$type_name=mysql_result($result2,0,"type_name");
//$table_id=mysql_result($result,$i,"table_id");
echo "<a href=admServerManager.php?type_id=$type_id&server_id=".$_GET['server_id']."&change=2&filt=$filt>".$type_name."</a><br>";
}
$i++;
}

?>

</td>
<td align=left bgcolor=#E5E5E5 valign=top><font face=verdana size=1>
<?

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");


$i=0;
$query="SELECT * FROM type_table";
$result=mysql_query($query);

$num=mysql_numrows($result);
while ($i < $num) {
$type_name=mysql_result($result,$i,"type_name");
$table_id=mysql_result($result,$i,"table_id");

$query="SELECT * FROM type_mapping where type_id=".$table_id." and server_id=".$_GET['server_id'];
$result3=mysql_query($query);
$num3=mysql_numrows($result3);
if ( $num3 < 1 ) {
echo "<a href=admServerManager.php?type_id=$table_id&server_id=".$_GET['server_id']."&change=1&group=".$_GET['group']."&filt=$filt>".$type_name."</a><br>";
}
$i++;
}

} // end if group selected
?>
</td>
</tr>
</table>

</td></tr></table>
</form>

<a name=bot></a>
</body></html>

