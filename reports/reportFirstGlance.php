<? include("functions.php"); ?>
<html>
<head>
<title>Environment Management Console - Reports (First Glance)</title>

<?php
// Query Variables //

$QRY_SHOW_TABS="select * from customer_table order by customer_name";
$QRY_SHOW_HEADINGS_BY_TAB="select * from group_table where customer_id=12 order by group_name";
$QRY_SHOW_SERVERS_BY_HEADING="";

// Php code for report start here. //


//include 'functions.php';
$cid=$_GET['customer_id'];
// Start Here - Connect to database
mysql_connect("localhost","root","testme");
@mysql_select_db("emc_v2") or die( "Unable to select database");
$query="SELECT * FROM customer_table order by customer_name";

echo $query."<br>";
$result=mysql_query($query);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
        $customer_name=mysql_result($result,$i,"customer_name");
        $customer_id=mysql_result($result,$i,"table_id");
        echo "$customer_name<br>";

// start server loop by customer_id
$query="SELECT * FROM server_table order by customer_name";






        $i++;
}




?>
