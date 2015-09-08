<?php
echo $_GET['add'];

function get_customer($cust_id) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$query="select * from customer_table where table_id=$cust_id";
$result=mysql_query($query);
$cust_name=mysql_result($result,$i,"customer_name");
return $cust_name;
}


mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");

if ( $_GET['del'] ) {

$query="select * from server_mapping where group_id=".$_GET['del'];
$result=mysql_query($query);
$num=mysql_numrows($result);
if ( $num == 0 ) {
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");


$query="DELETE FROM group_table where table_id=".$_GET['del'];
$result=mysql_query($query);
header("location: admHeadingManager.php");

} else {
echo "<font color=red face=verdana>You must remove all server mappings first.</font> <br><Br>";
}

}

if ( $_GET['change'] == 1 ) {

$query="INSERT INTO server_mapping (group_id, server_id) VALUES ('".$_GET['group_id']."','".$_GET['server_id']."')";
//SELECT * FROM group_table where table_id=".$_GET['del'];
$result=mysql_query($query);
//header("location: admHeadingManager.php");
//exit;

}

if ( $_GET['change'] == 2 ) {

$query="DELETE FROM server_mapping where server_id=".$_GET['server_id']." and group_id=".$_GET['group_id'];
echo $query;
$result=mysql_query($query);
//header("location: admHeadingManager.php");


}



//echo $_POST['add'];
if ( $_POST['add'] ) {
$query="SELECT group_name from group_table where group_name='".$_POST['add']."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ( $num < 1 ) {
$query="INSERT INTO group_table (group_name, customer_id) VALUES ('".$_POST['add']."', '".$_POST['customer_id']."')";
$result=mysql_query($query);
//echo $query;
//echo $result;

header("location: admHeadingManager.php");

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
																			  
<SCRIPT LANGUAGE="JavaScript">

<!-- Begin
function move(fbox, tbox) {
var arrFbox = new Array();
var arrTbox = new Array();
var arrLookup = new Array();
var i;
for (i = 0; i < tbox.options.length; i++) {
arrLookup[tbox.options[i].text] = tbox.options[i].value;
arrTbox[i] = tbox.options[i].text;
}
var fLength = 0;
var tLength = arrTbox.length;
for(i = 0; i < fbox.options.length; i++) {
arrLookup[fbox.options[i].text] = fbox.options[i].value;
if (fbox.options[i].selected && fbox.options[i].value != "") {
arrTbox[tLength] = fbox.options[i].text;
tLength++;
}
else {
arrFbox[fLength] = fbox.options[i].text;
fLength++;
   }
      }
	     arrFbox.sort();
		    arrTbox.sort();
			   fbox.length = 0;
			      tbox.length = 0;
				     var c;
					    for(c = 0; c < arrFbox.length; c++) {
						   var no = new Option();
						      no.value = arrLookup[arrFbox[c]];
							     no.text = arrFbox[c];
								    fbox[c] = no;
									   }
									      for(c = 0; c < arrTbox.length; c++) {
										     var no = new Option();
											    no.value = arrLookup[arrTbox[c]];
												   no.text = arrTbox[c];
												      tbox[c] = no;
													        }
															          }
																	            //  End -->
																				</script>

																				</head>





<?
echo "<body>";

if ( $_GET['filt'] ) {
$query="SELECT * FROM group_table where group_name like '%".$_GET['filt']."%' order by group_name"; // where group_name like '%Alltel%'";
} else {
$query="SELECT * FROM group_table order by group_name"; // where group_name like '%Alltel%'";
}
//echo $query;
$result=mysql_query($query);

$num=mysql_numrows($result);

$group_name=mysql_result($result,$i,"group_name");
//$task_start=mysql_result($result,$i,"task_start");
//$task_end=mysql_result($result,$i,"task_end");
mysql_close();
$i=0;
echo "<font face=verdana size=2 color=gray><b>Manage Tab Headings</b></font><table border=1 cellpadding=0 cellspacing=0 bordercolor=#E5E5E5><tr><td><table border=0 cellpadding=3 cellspacing=2 width=600>";
echo "<font face=verdana size=1><form method=post action=admHeadingManager.php>Filter:<br><input class=inputv type='text' name='filt' value='".$_GET['filt']."'> <input type=submit value='Filter'>";

while ($i < $num) {
$group_name=mysql_result($result,$i,"group_name");
$group_id=mysql_result($result,$i,"table_id");
$customer_id=mysql_result($result,$i,"customer_id");

echo "<tr><td bgcolor=#E5E5E5><font face=verdana size=1><a href=admHeadingManager.php?group=$group_name&group_id=$group_id&filt=".$_GET['filt'].">$group_name</a></td>";
echo "<td bgcolor=#E5E5E5><font face=verdana size=1>".get_customer($customer_id)."</td>";
echo "<td width=10 bgcolor=#E5E5E5><font face=verdana size=1>[<a href=admHeadingManager.php?del=$group_id&filt=".$_GET['filt'].">DEL</a>]</td></tr>";
$i++;

}
echo "<tr><form method=get action=admHeadingManager.php><td><font face=verdana size=1><table border=0><tr><td><font size=1>Name:<br><input class=inputv type='text' name='add' value='".$_GET['group']."'></td><Br>";
echo "<td valign=top><font size=1>Customer:<br><select name=customer_id class=inputv>";
//echo "<input type=hidden name=filt value='".$_GET['filt']."'>";

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");


$iv=0;
$query="SELECT * FROM customer_table";
$resultv=mysql_query($query);

$numv=mysql_numrows($resultv);
while ($iv < $numv) {
$customer_id=mysql_result($resultv,$iv,"table_id");
$customer_name=mysql_result($resultv,$iv,"customer_name");
echo "<option value=$customer_id>$customer_name</option>";
$iv++;
}



echo "</select></td></tr><td></td>";

echo "<td align=right><input type=submit value='Create'></td></tr></table></td></form></tr></table></td></tr></table>";

if ( $_GET['group_id'] ) {




// Mapp servers to group.  
?>

<br>

<form method=post action=admHeadingManager.php name=combo_box>
<font face=verdana size=2 color=gray><b>Server Mapping:</b><Br>
<table width=405 border=1 cellpadding=0 cellspacing=0 bordercolor=#E5E5E5>
<tr><td align=left><font face=verdana size=1>

<table width=100% cellpadding=2 cellspacing=3 border=0><th width=50% align=left><font face=verdana size=1>Selected</th><th align=left><font face=verdana size=1>Server List</th>
<tr>
<td bgcolor=#E5E5E5 valign=top><font face=verdana size=1>
<?

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");


$i=0;
$query="SELECT * FROM server_mapping where group_id=".$_GET['group_id'];
$result=mysql_query($query);

$num=mysql_numrows($result);
while ($i < $num) {
$server_id=mysql_result($result,$i,"server_id");


$query="SELECT * FROM server_table where table_id=".$server_id;
$result2=mysql_query($query);
$num2=mysql_numrows($result2);
if ( $num2 > 0 ) {
$server_name=mysql_result($result2,0,"server_name"); 
//$table_id=mysql_result($result,$i,"table_id");
echo "<a href=admHeadingManager.php?server_id=$server_id&group_id=".$_GET['group_id']."&change=2&group=".$_GET['group']."&filt=".$_GET['filt'].">".$server_name."</a><br>";
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
$query="SELECT * FROM server_table"; // where server_name like '%".$_GET['group']."%'";
$result=mysql_query($query);
$num=mysql_numrows($result);
while ($i < $num) {
$server_name=mysql_result($result,$i,"server_name");
$table_id=mysql_result($result,$i,"table_id");

$query="SELECT * FROM server_mapping where server_id=".$table_id." and group_id=".$_GET['group_id'];
//$query="SELECT * FROM server_mapping where server_id=".$table_id." and group_id=".$_GET['group_id'];
$result3=mysql_query($query);
$num3=mysql_numrows($result3);
if ( $num3 < 1 ) {
echo "<a href=admHeadingManager.php?server_id=$table_id&group_id=".$_GET['group_id']."&change=1&group=".$_GET['group'].">".$server_name."</a><br>";
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

</body></html>

