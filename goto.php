<?

$server_host=$_GET['host'];
file_put_contents('/tmp/goto.txt', $server_host);
header('Location: http://emc.subrock.org:8080');
?>
