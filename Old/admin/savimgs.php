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
		$zz = resize_image($_GET["img"],"../images/staff/".$x."_".$_GET["id"].".".$ext,120);
}
?>
<img  style="border:1px solid #999999;" src="<? if($zz == NULL) echo "images/noimage.jpg"; else echo "../images/staff/".$x."_".$_GET["id"].".".$ext; ?>">
<input type="hidden" id="limgge"  name="limgge" value="<? if($zz == NULL) echo "images/noimage.jpg"; else echo "images/staff/".$x."_".$_GET["id"].".".$ext; ?>" /><? db_disconnect(); ?>