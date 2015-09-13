<?
if ( ! $_GET['themes'] ) {
	$setting_themes_name="Default";
	setcookie('theme_name', $setting_themes_name, time() + (86400 * 30), "/"); // 86400 = 1 day
} else {
	$setting_themes_name=$_GET['themes'];
	setcookie('theme_name', $setting_themes_name, time() + (86400 * 30), "/"); // 86400 = 1 day
}
?>

