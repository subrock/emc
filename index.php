<? include("settings.php"); ?>
<? include("server_header.php"); ?>
<? include("functions.php"); ?>
<html>
<head>
<title>Environment Management Console - <? echo $setting_content_name; ?></title>

<link rel="stylesheet" type="text/css" href="tabs/ajaxtabs.css" />
<script type="text/javascript" src="tabs/ajaxtabs.js"></script>
<script type="text/javascript" src="tabs/tooltip.js"></script>

<? if ( $setting_themes_enabled == 1 ) { ?>
<link rel="stylesheet" href="themes/<? echo $setting_themes_name; ?>" type="text/css" />
<? } ?>
</head>
<body>

<!-- Header -->
<table height=100% width=100% border=0><tr><td valign=top>
	<table width=100% border=0><tr>
	<td valign=top><h3>Environment Management Console - <? echo $setting_content_name; ?></hr></td><td class=stylebox valign=top align=right><? include("client_themes.php"); ?></h3></td>
	</tr>
</table>


<!-- TAB Body Start Here -->
<ul id="countrytabs" class="shadetabs">

<?
//include 'functions.php';
$cid=$_GET['customer_id'];
// Start Here - Connect to database
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$query="SELECT * FROM customer_table order by customer_name";

//echo $query;
$result=mysql_query($query);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
	echo "<li ";
	$customer_name=mysql_result($result,$i,"customer_name");
	$customer_id=mysql_result($result,$i,"table_id");
	if ( $customer_id == $cid ) {
		echo "class=selected";
	}
	echo "><a rel=countrycontainer href=view.php?customer_id=$customer_id>".$customer_name."</a></li>";
	if ( $i == ($_GET['customer_id']-1) ) {
		echo "";
	}
	$i++;
}

?>

</ul>
<div id="countrydivcontainer" style="border:1px solid gray; width:100%; margin-bottom: 1em; padding: 10px; background-color: white">
<p>This is some default tab content, embedded directly inside this space and not via Ajax. It can be shown when no tabs are automatically selected, or associated with a certain tab, in this case, the first tab.</p>
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>
<!-- TAB Body Stop Here -->

</td></tr><tr><td valign=bottom>
<table border=0 cellspacing=0 cellpadding=0 bordercolor=black><tr>
<td><img src=onlin.jpg broder=0>
</td>
<td>Indicates server is on-line and is listening to that port indicating the service is up.
</td>
</tr>
<tr>
<td><img src=offlin.jpg broder=0>
</td>
<td>Indicates server on-line but not listening at that port indicating the service is down.
</td>
</tr>
<tr>
<td><img src=notres.jpg broder=0>
</td>
<td>Indicates server is not responding.  Server is either behind a firewall or off-line.
</td>
</tr>

</table>
<hr><font size=-1>
<? include("server_footer.php"); ?>
</td>
</tr>
</table>
</body></html>




