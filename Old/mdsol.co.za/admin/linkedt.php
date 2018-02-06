<?
	global $g_db;
	if (isset($_POST["cg"]))
	{
		//dispPost();
		$err = false;
		if ($_POST["linkTitle"] == "" || $_POST["linkUrl"] == "")
			$err = true;
		
		if ($err != true)
		{
			$vals = array();
			$vals[] = "'".$_POST["linkTitle"]."'";
			$vals[] = "'".$_POST["linkUrl"]."'";
			if (!$g_db)
				db_connect();
			if (!$g_db)
				$_SESSION["mess"] .= "<h3>Could not connect!</h3>";
			else {
				if (!isset($_POST["edt"])) {
					$res3 = insert_query("tbllinks",array("linkTitle","linkUrl"),$vals);
				}
				else
				$res3 = update_query("tbllinks",array("linkTitle","linkUrl"),$vals,"linkID = ".$_POST["edt"]);
				if ($res3 == false)
				{
					echo "<h3>System Error. Please try again or come back later. </h3>";
				}
				else {
					if (isset($_POST["edt"]))
						$theid = $_POST["edt"];
					else {
						$theid = mysql_insert_id();
					}
				?>
					<script>window.location = "index.php?con=links&id=<? echo $theid; ?><? if (isset($_POST["edt"])) echo "&edt=1"; ?>";</script>
				<?
				}
			}
		}
		else
		{
			mess("<h5 style='color:#FF0000'>There were some errors. Please revise!</h5>");
		}
	}
	
	if (isset($_GET["id"]))
	{
			$gedit = false;
			if (!$g_db)
				db_connect();
			if (!$g_db)
				mess("<h3>Could not connect!</h3>");
			else {
				$res3 = select_query(array("tbllinks"),array("*"),"linkID = ".$_GET["id"]);
				if ($res3 == false)
				{
					echo "<h3>System Error. Please try again or come back later. </h3>";
				}
				else if ($res3 == -1)
				{
					mess("Link Entry Not Found");
				}
				else {
					$row = mysql_fetch_assoc($res3);
					$gedit = true;
				}
			}
	}

?><style type="text/css">
<!--
.rednes {font-size:10px;
color:#FF0000;
}
-->
</style>

<h1 style="font-size:16px; margin-bottom:15px;"><? if ($gedit) echo "Editing Link"; else { ?>
  Add Link
  <? } ?>
  :</h1>

<form action="index.php?con=linkedt" method="post" name="groupsubmitform" id="groupsubmitform" onsubmit="">
  <? if ($gedit) { ?>
  <input type="hidden" name="edt" value="<? echo $_GET["id"]; ?>" />
  <?  } ?>
  <input type="hidden" name="cg" value="1"/>
  <table width="55%" border="0" align="center" cellpadding="5" style="padding:10px; width:75%;" cellspacing="0">
    <tr>
      <td style="padding-top:10px;"><strong><u>All Fields are Required</u> </strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" width="40%" valign="top"><strong>Link Title:</strong></td>
      <td  style="padding-top:10px;"><input name="linkTitle" type="text" size="60" maxlength="70"  value="<? if (isset($_POST["linkTitle"])) echo  $_POST["linkTitle"]; else if ($gedit) echo $row["linkTitle"];?>" />
        (max 60 characters)
        <? if (isset($_POST["linkTitle"]) && $_POST["linkTitle"] == "" ) { ?>
        <br />
          <span class="rednes">This Field is required!</span>
        <? } ?></td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" valign="top"><strong>Link Url</strong></td>
      <td  style="padding-top:10px;"><input name="linkUrl" type="text" size="60" maxlength="70"  value="<? if (isset($_POST["linkUrl"])) echo  $_POST["linkUrl"]; else if ($gedit) echo $row["linkUrl"]; else echo "http://";?>" />
(max 300 characters)
  <? if (isset($_POST["linkUrl"]) && $_POST["linkUrl"] == "" ) { ?>
  <br />
  <span class="rednes">This Field is required!</span>
  <? } ?></td>
    </tr>
    <tr>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><input type="submit" name="Submit" value="<? if (isset($_GET["id"])) echo "Update"; else { ?>Save<? }?> Link" /></td>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><br />
          <br />
          <br />
          <br />      </td>
    </tr>
  </table>
</form>
