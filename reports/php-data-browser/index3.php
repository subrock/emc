<?php
	
	require_once('functions.php');

	$recperpage = 5;  // Customize this var.

	$dbname = 'your-db-name';
	$dbhost = 'localhost';
	$dbuser = 'your-db-user';
	$dbpwd = 'your-db-password';

        $dbname = 'emc_v2';
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpwd = 'testme';

	
	ConnectDB($dbhost, $dbuser, $dbpwd, $dbname);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A Simple PHP / MySQL Data Browser</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>PHP Tutorial : A Simple MySQL Data Browser</h1>
<h2>Part 3</h2>
<p><a href="http://www.thewebmasterscafe.net/web-development/basic-php-data-browser-pt3.html"><em>You can read this PHP tutorial here.</em></a></p>
<table width="400" cellspacing="0" cellpadding="3" border="0">
<?php
	
	// SET THE NUMBER OF PAGES AVAILABLE
	$nbpages = ceil(GetNbRec() / $recperpage);

	// READ PARAMETER VALUES PASSED THROUGH 'GET'
	GetFromGet();
	
	// BUILDING COLUMN HEADERS AND SORTERS
	BuildColumnHeaders();
	
	// SET THE FIRST AND LAST RECORD TO BE DISPLAYED
	$firstrec = ($params['pageno'] * $recperpage) - $recperpage;
	
	// Build the data browser
	BuildDataBrowser($firstrec, $recperpage);
?>
<tr id="navigator">
	<td colspan="2"><?php BuildNavigator(); ?></td>
</tr>
</table>
</body>
</html>
