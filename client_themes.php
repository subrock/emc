<? 

if ( $setting_themes_display == 1 and $setting_themes_enabled == 1 ) {

if ( is_dir("themes/")) { ?>
<form method="get" action="index.php" name=form_themeslist>
<select name=themes OnChange ="document.form_themeslist.submit()">
<option style = "color: red"><? echo $_GET['themes']; ?></option><option>No Theme</option>
<?
if ($handle = opendir('themes/')) {
    while (false !== ($file = readdir($handle))) {
	  if ( ! stristr($file, ".")) {
  	        echo "<option>$file</option>";
	  }
    }

    closedir($handle);
}
?></select>
<? } } ?> 

