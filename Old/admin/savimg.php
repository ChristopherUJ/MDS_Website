<? 
	require_once "com/session.php";
	require_once "com/globals.php";
	require_once "com/dbcon.php";
	require_once "com/db_funcs.php";
 	global $g_db;

	if (!$g_db)
		db_connect();
	if (!$g_db)
		echo "<h3>Could not connect! </h3>";

if (isset($_GET["img"]) && isset($_GET["id"]))
{
		$x = rand(5000,10000);
		$ext = substr($_GET["img"],strlen($_GET["img"])-3,strlen($_GET["img"]));
		$zz = resize_image($_GET["img"],"../images/staff/".$x."_".$_GET["id"].$ext,90);
}
?>
<img src="<? if($zz == NULL) echo "images/noimage.gif"; else echo "../images/staff/".$x."_".$_GET["id"].".".$ext; ?>"><? db_disconnect(); ?>