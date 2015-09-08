<?php

$params = array();
$fields = array('artist_name', 'genre_desc');
$header_titles = array('Artist', 'Genre');

function ConnectDB($dbhost, $dbuser, $dbpwd, $dbname)
{
	if(mysql_connect($dbhost, $dbuser, $dbpwd))
		mysql_select_db($dbname);
	else
		die("Could not connect to database $dbname");
}

function GetFromGet()
{
	global $params, $nbpages, $fields;
	
	$params['pageno'] = $_GET['pageno'];
	$params['sortby'] = $_GET['sortby'];
	$params['order'] = $_GET['order'];

	if($params['pageno'] < 1 || $params['pageno'] > $nbpages)
		$params['pageno'] = 1;
		
	if(!in_array($params['sortby'], $fields) || $params['sortby'] == '')
		$params['sortby'] = $fields[0];
		
	if($params['order'] != 'asc' && $params['order'] != 'desc')
		$params['order'] = 'asc';
}

function BuildNavigator()
{
	global $params, $nbpages;
	
	$navigator = '';
	
	for($i=1;$i<=$nbpages;$i++)
	{
		if($i != $params['pageno'])
			$navigator .= '<a href="index3.php?pageno=' . $i . '&sortby=' . $params['sortby'] . '&order=' . $params['order'] . '">' . $i . '</a>';
		else
			$navigator .= "<strong>$i</strong>";

		if($i < $nbpages)
			$navigator .= " | ";
	}

	echo $navigator;
}

function GetNbRec()
{
	// FIND OUT THE NUMBER OF RECORDS IN OUR DATABASE
	$sql = "SELECT count(artist_name) as nbrec FROM artist;";
	$result = mysql_query($sql);
	
	return(mysql_result($result, 0, 'nbrec'));
}

function BuildDataBrowser($firstrec, $recperpage)
{
	global $params;

	$sql = "SELECT artist.artist_name, genre.genre_desc " .
			"FROM artist INNER JOIN genre ON artist.genre_id = genre.genre_id " .
			"ORDER BY " . $params['sortby'] . " " . $params['order'] . 
			" LIMIT $firstrec, $recperpage;";
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
}

function BuildColumnHeaders()
{
	global $params, $fields, $header_titles;
	
	$headers = "<tr>";

	$i=0;
	
	foreach($fields as $colheader)
	{
		if($params['sortby'] == $colheader)
		{
			if($params['order'] == 'asc')
				$order = 'desc';
			else
				$order = 'asc';
		}
		else
			$order = 'asc';
		
		$headers .= '<th><a href="index3.php?pageno=' . $params['pageno'] . '&sortby=' . $colheader . '&order=' . $order . '">';
		$headers .= $header_titles[$i] . "</a></th>";
		$i++;
	}

	$headers .= "</tr>";
	
	echo $headers;
}

?>