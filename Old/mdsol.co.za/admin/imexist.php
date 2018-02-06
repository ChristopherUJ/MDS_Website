<?
	require_once "com/globals.php";
	require_once "com/dbcon.php";
	require_once "com/db_funcs.php";
 	global $g_db;

	if (!$g_db)
		db_connect();
	if (!$g_db)
		echo "<h3>Could not connect! </h3>";
if (isset($_GET["im"]))
{
	if (1==1)
	{
		$ext = strtolower(substr($_GET["im"],strlen($_GET["im"])-3,strlen($_GET["im"])));
		if ($ext != "jpg" && $ext != "png" && $ext != "gif")
		{
?>
<input type="hidden" name="itexist" id="itexist" value="0" />
<?
		}
		else
		{
?>
<input type="hidden" name="itexist" id="itexist" value="<? echo $_GET["im"]; ?>" />
<?
		}
	}
	else
	{
?>
<input type="hidden" name="itexist" id="itexist" value="0" />
<?
	}
}
 ?>