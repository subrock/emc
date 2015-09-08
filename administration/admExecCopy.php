<?php
include '../settings.php';
if ($_POST['newname']) {
echo "copy_db.sh ".$_POST['newname']." ". $setting_content_name;
$output = shell_exec('./copy_db.sh '.$_POST['newname'].' '.$setting_content_name);
echo "<pre>$output</pre>";
echo "<a target=_top href=../../".$_POST['newname'].">View ".$_POST['newname']."</a>";
exit;
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

Copy this console to a new console.  Enter new name below.<br><br>
<form method=post action=admExecCopy.php>
<font face=verdana size=1>New name:<br>
	<input class=inputv type='text' name='newname' value=''><br>
	<input type=submit value='Create'>
</form> 


</body></html>
