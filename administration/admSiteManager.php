<?

function get_group ($grp_id,$grp_field) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$GetServerQuery="SELECT * FROM group_table where table_id=$grp_id";
$GetServerResult=mysql_query($GetServerQuery);
mysql_close();
$grp_name=mysql_result($GetServerResult,0,$grp_field);
//echo $grp_name;
return $grp_name;
}

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");

if ( $_GET['del'] ) {

$query="DELETE FROM url_table where table_id=".$_GET['del'];
$result=mysql_query($query);
header("location: admSiteManager.php");


}

if ( $_POST['url_name'] ) {
$query="SELECT url_name from url_table where url_name='".$_POST['url_name']."' and group_id=".$_POST['group_id'];
//echo $query;
$result=mysql_query($query);
$num=mysql_numrows($result);
if ( $num < 1 ) {
$query="INSERT INTO url_table (url_name, url_uri, group_id, category_id) VALUES ('".$_POST['url_name']."','".$_POST['url_uri']."','".$_POST['group_id']."','".$_POST['category_id']."')";
$result=mysql_query($query);
//echo $query;

//echo $result;

//header("location: admGroupManager.php");

//echo $_POST['add'];

//exit;
}

}




?>

<html><head><title></title>
<style>
a:hover {
        color:red;
		        }
				a:visited {color:gray}
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


$query="SELECT * FROM url_table order by group_id";
//echo $query;
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();
$i=0;
echo "<font face=verdana size=2 color=gray><b>Manage Links</b></font><table border=1 cellpadding=0 cellspacing=0 bordercolor=silver><tr><td><table border=0 cellpadding=3 cellspacing=2 width=400>";
while ($i < $num) {

$group_id=mysql_result($result,$i,"group_id");
$url_name=mysql_result($result,$i,"url_name");
$url_uri=mysql_result($result,$i,"url_uri");
$table_id=mysql_result($result,$i,"table_id");
$category_id=mysql_result($result,$i,"category_id");


mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");

$query="SELECT * FROM group_table where table_id=".$group_id;
//echo $query;
$resulta=mysql_query($query);
//$num=mysql_numrows($result);
mysql_close();
//$i=0;
//while ($i < $num) {
$group_name=mysql_result($resulta,$i,"group_name");
//echo $group_name."Test";
//$i++;
//}

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");

$query="SELECT * FROM category_table where table_id=".$category_id;
$resulta=mysql_query($query);
//$num=mysql_numrows($result);
$numa=mysql_numrows($resulta);
mysql_close();
$category_name="Unknown";
if ( $numa > 0 ) {
$category_name=mysql_result($resulta,0,"category_name");
}


echo "<tr><td bgcolor=silver><font face=verdana size=1><a target=_black href='$url_uri'>$url_name</a></td><td bgcolor=silver><font face=verdana size=1>$category_name</td><td bgcolor=silver><font face=verdana size=1>".get_group($group_id,"group_name")."</td><td width=10 bgcolor=silver><font face=verdana size=1>[<a href=admSiteManager.php?del=$table_id>DEL</a>]</td></tr>";

$i++;

}
?>
<tr><form method=post action=admSiteManager.php>
<td>
<font face=verdana size=1>
Link Name:<br><input class=inputv type='text' name='url_name' value=''><br>
Link Url:<br><input class=inputv type='text' name='url_uri' value=''><br>
Group:<br>
<select name=group_id  class=inputv>
<?

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$queryz="SELECT * from group_table";
$rz=mysql_query($queryz);
$newz=mysql_numrows($rz);
//echo "Count=$newz";
$z=0;
while ($z < $newz) {
$group_name=mysql_result($rz,$z,"group_name");
$table_id=mysql_result($rz,$z,"table_id");
echo "<option value=$table_id>$group_name</option>";
$z++;
}
?>
</select><br>
Category:<br>
<select name=category_id class=inputv>
<?

//mysql_connect("localhost","root","testme");
//@mysql_select_db("emc_v2") or die( "Unable to select database");
$queryz="SELECT * from category_table";
$rz=mysql_query($queryz);
$newz=mysql_numrows($rz);
//echo "Count=$newz";
$z=0;
while ($z < $newz) {
$category_name=mysql_result($rz,$z,"category_name");
$table_id=mysql_result($rz,$z,"table_id");
echo "<option value=$table_id>$category_name</option>";
$z++;
}
?>
</select>
<br>
<input type=submit value='Create'></td></form></tr></table></td></tr></table>


</body></html>

