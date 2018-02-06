<?
	global $g_db;
	if (isset($_POST["cg"]))
	{
		//dispPost();
		$err = false;
		if ($_POST["newsTitle"] == "" || $_POST["newsDesc"] == "")
			$err = true;
		
		if ($err != true)
		{
			$vals = array();
			$vals[] = "'".$_POST["newsTitle"]."'";
			$vals[] = "'".$_POST["newsDesc"]."'";
			if (!$g_db)
				db_connect();
			if (!$g_db)
				$_SESSION["mess"] .= "<h3>Could not connect!</h3>";
			else {
				if (!isset($_POST["edt"])) {
					$res3 = insert_query("tblnews",array("newsTitle","newsDesc"),$vals);
				}
				else
				$res3 = update_query("tblnews",array("newsTitle","newsDesc"),$vals,"newsID = ".$_POST["edt"]);
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
					<script>window.location = "index.php?con=news&id=<? echo $theid; ?><? if (isset($_POST["edt"])) echo "&edt=1"; ?>";</script>
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
				$res3 = select_query(array("tblnews"),array("*"),"newsID = ".$_GET["id"]);
				if ($res3 == false)
				{
					echo "<h3>System Error. Please try again or come back later. </h3>";
				}
				else if ($res3 == -1)
				{
					mess("News Entry Not Found");
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

<h1 style="font-size:16px; margin-bottom:15px;"><? if ($gedit) echo "Editing News"; else { ?>
  Add News
  <? } ?>
  :</h1>
<script>

function setSelRange(inputEl, selStart, selEnd) {
	if (inputEl.setSelectionRange) {
		inputEl.focus();   
		inputEl.setSelectionRange(selStart, selEnd);  
	} 
	else if (inputEl.createTextRange) {
		var range = inputEl.createTextRange();
		range.collapse(true);
		range.moveEnd('character', selEnd);
		range.moveStart('character', selStart);
		range.select();  
	} 
}

function caret(node) {
	//node.focus(); 
	/* without node.focus() IE will returns -1 when focus is not on node */
	if(node.selectionStart) return node.selectionStart;
	else if(!document.selection) return 0;
	var c		= "\001";
	var sel	= document.selection.createRange();
	var dul	= sel.duplicate();
	var len	= 0;
	dul.moveToElementText(node);
	sel.text	= c;
	len		= (dul.text.indexOf(c));
	sel.moveStart('character',-1);
	sel.text	= "";
	return len;
}

function checkChars(initval, area, label)
{
	var obj = document.getElementById(area);
	
	if (obj.length > initval) {
		var curpos = caret(obj);
		obj.value = obj.value.substring(0, initval);
		if (curpos != -1)
			setSelRange(obj, curpos, curpos);
	}
	else
	{
		div = document.getElementById(label);
		var dif = initval - obj.value.length;
		div.innerHTML = "<b>" + dif + "</b> Characters Left";
	}
}
   
		
</script>
<form action="index.php?con=newsart" method="post" name="groupsubmitform" id="groupsubmitform" onsubmit="">
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
      <td  style="padding-top:10px;" width="40%" valign="top"><strong>News Title:</strong></td>
      <td  style="padding-top:10px;"><input name="newsTitle" type="text" size="60" maxlength="70"  value="<? if (isset($_POST["newsTitle"])) echo  $_POST["newsTitle"]; else if ($gedit) echo $row["newsTitle"];?>" />
        (max 70 characters)
        <? if (isset($_POST["newsTitle"]) && $_POST["newsTitle"] == "" ) { ?>
        <br />
          <span class="rednes">This Field is required!</span>
        <? } ?></td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" valign="top"><strong>News Description:</strong></td>
      <td  style="padding-top:10px;"><? if (isset($_POST["newsDesc"]) && $_POST["newsDesc"] == "" ) { ?>
          <span class="rednes">This Field is required!</span>
          <p></p>
        <? }?>
          <textarea name="newsDesc" style="font-size:11px"   id="newsDesc" wrap="soft" cols="70" rows="8" onkeyup=" checkChars(1000,'newsDesc','charleft');" onblur="checkChars(1000,'newsDesc','charleft');" onkeydown="checkChars(1000,'newsDesc','charleft');"><? if (isset($_POST["newsDesc"])) echo  $_POST["newsDesc"]; else if ($gedit) echo $row["newsDesc"];?></textarea>
          <div id="charleft"><b><? if (isset($row["newsDesc"])) echo (1000-strlen($row["newsDesc"])); else { ?>1000<? } ?></b> Characters <? if (isset($row["newsDesc"])) echo "Left"; ?></div></td>
    </tr>
    <tr>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><input type="submit" name="Submit" value="<? if (isset($_GET["id"])) echo "Update"; else { ?>Save<? }?> News" /></td>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><br />
          <br />
          <br />
          <br />      </td>
    </tr>
  </table>
</form>
