<?php
	
	$params = array();
	$recperpage = 5;  // Customize this var.

	$dbname = 'your-db-name';
	$dbhost = 'localhost';
	$dbuser = 'your-db-user';
	$dbpwd = 'your-db-password';
	
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

#navigator td {
	text-align: center;
	border-top: 1px solid #333333;
}

-->
</style>
</head>
<body>
<h1>PHP Tutorial : A Simple MySQL Data Browser</h1>
<h2>Part 2</h2>
<p><a href="http://www.thewebmasterscafe.net/web-development/basic-php-data-browser-pt2.html"><em>You can read this PHP tutorial here.</em></a></p>
<table width="400" cellspacing="0" cellpadding="3" border="0">
<tr>
	<th>Artist</th>
    <th>Genre</th>
</tr>
<?php
	
	// FIND OUT THE NUMBER OF RECORDS IN OUR DATABASE
	$sql = "SELECT count(artist_name) as nbrec FROM artist;";
	$result = mysql_query($sql);

	// SET THE NUMBER OF PAGES AVAILABLE
	$nbpages = ceil(mysql_result($result, 0, 'nbrec') / $recperpage);
	GetFromGet();
	
	// SET THE FIRST AND LAST RECORD TO BE DISPLAYED
	$firstrec = ($params['pageno'] * $recperpage) - $recperpage;
	
	$sql = "SELECT artist.artist_name, genre.genre_desc " .
			"FROM artist INNER JOIN genre ON artist.genre_id = genre.genre_id " .
			"ORDER BY artist.artist_name " .
			"LIMIT $firstrec, $recperpage;";
	$result = mysql_query($sql);
	
	$html = '';
	$rowclass = "row";
	
	while($row = mysql_fetch_array($result))
	{
		$html .= "<tr class=\"$rowclass\">";
		$html .= '<td valign="top">' . $row['artist_name'] . "</td>\n";	
		$html .= '<td valign="top">' . $row['genre_desc'] . "</td>\n";
		$html .= "</tr>";
		
		if($rowclass == "row")
			$rowclass = "altrow";
		else
			$rowclass = "row";
	}
	
	echo $html;
?>
<tr id="navigator">
	<td colspan="2"><?php BuildNavigator(); ?></td>
</tr>
</table>
</body>
</html>
<?php

function GetFromGet()
{
	global $params, $nbpages;
	
	$params['pageno'] = $_GET['pageno'];

	if($params['pageno'] < 1 || $params['pageno'] > $nbpages)
		$params['pageno'] = 1;
}

function BuildNavigator()
{
	global $params, $nbpages;
	
	$navigator = '';
	
	for($i=1;$i<=$nbpages;$i++)
	{
		if($i != $params['pageno'])
			$navigator .= '<a href="index2.php?pageno=' . $i . '">' . $i . '</a>';
		else
			$navigator .= "<strong>$i</strong>";

		if($i < $nbpages)
			$navigator .= " | ";
	}

	echo $navigator;
}

?>