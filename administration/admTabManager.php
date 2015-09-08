<?

mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");

if ( $_GET['del'] ) {

$query="DELETE FROM customer_table where table_id=".$_GET['del'];
$result=mysql_query($query);
header("location: admTabManager.php");


}




if ( $_POST['add'] ) {
$query="SELECT customer_name from customer_table where customer_name='".$_POST['add']."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ( $num < 1 ) {
$query="INSERT INTO customer_table (customer_name) VALUES ('".$_POST['add']."')";
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

<body>



<?php
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");


$query="SELECT * FROM customer_table";
//echo $query;
$result=mysql_query($query);

$num=mysql_numrows($result);

$group_name=mysql_result($result,$i,"customer_name");
//$task_start=mysql_result($result,$i,"task_start");
//$task_end=mysql_result($result,$i,"task_end");
mysql_close();
$i=0;
echo "<font face=verdana size=2 color=gray><b>Manage Tabs</b></font><table border=1 cellpadding=0 cellspacing=0 bordercolor=silver><tr><td><table border=0 cellpadding=3 cellspacing=2 width=400>";
while ($i < $num) {
$customer_name=mysql_result($result,$i,"customer_name");
$table_id=mysql_result($result,$i,"table_id");

echo "<tr><td bgcolor=silver><font face=verdana size=1><a href=admTabManager.php?group=".urlencode($customer_name)."&group_id=$table_id>$customer_name</a></td><td width=10 bgcolor=silver><font face=verdana size=1>[<a href=admTabManager.php?del=$table_id>DEL</a>]</td></tr>";
$i++;

}
echo "<tr><form method=post action=admTabManager.php><td><font face=verdana size=1>Create New:<br><input class=inputv type='text' name='add' value='".$_GET['group']."'>&nbsp;<input type=submit value='Create'></td></form></tr></table></td></tr></table>";





// Mapp servers to group.  
?>

</td>
</tr>
</table>

</td></tr></table>
</form>

</body></html>

