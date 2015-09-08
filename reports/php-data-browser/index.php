<?php
	
	$dbname = 'emc_v2';
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpwd = 'testme';
	
	if(mysql_connect($dbhost, $dbuser, $dbpwd))
		mysql_select_db($dbname);
	else
		die("Could not connect to database $dbname");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A Simple PHP / MySQL Data Browser</title>
<style type="text/css">
<!--
body, td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

th {
	text-align: left;
	background-color: #000000;
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}

tr.row td {
	background-color: #FFFFFF;
}

tr.altrow td {
	background-color: #CCCCCC;
}

h1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	margin-bottom: 0px;
}

h2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	margin-top: 0px;
}
-->
</style>
</head>
<body>
<h1>PHP Tutorial : A Simple MySQL Data Browser</h1>
<h2>Part 1</h2>
<table width="400" cellspacing="0" cellpadding="3" border="0">
<tr>
	<th>Artist</th>
    <th>Genre</th>
</tr>
<?php
	
	$sql = "SELECT artist.artist_name, genre.genre_desc " .
			"FROM artist INNER JOIN genre ON artist.genre_id = genre.genre_id " .
			"ORDER BY artist.artist_name;";

$sql="SELECT server_table.server_name from server_table";
	$result = mysql_query($sql);

	$html = '';
	$rowclass = "row";
	
	while($row = mysql_fetch_array($result))
	{
		$html .= "<tr class=\"$rowclass\">";
		$html .= '<td valign="top">' . $row['server_name'] . "</td>\n";	
		$html .= '<td valign="top">' . $row['genre_desc'] . "</td>\n";
		$html .= "</tr>";
		
		if($rowclass == "row")
			$rowclass = "altrow";
		else
			$rowclass = "row";
	}
	
	echo $html;
?>
</table>
</body>
</html>
