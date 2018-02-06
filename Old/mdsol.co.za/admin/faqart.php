<?
	global $g_db;
	if (isset($_POST["cg"]))
	{
		//dispPost();
		$err = false;
		if ($_POST["faqQuestion"] == "" || $_POST["faqAnswer"] == "")
			$err = true;
		
		if ($err != true)
		{
			$vals = array();
			$vals[] = "'".mysql_escape_string($_POST["faqQuestion"])."'";
			$vals[] = "'".mysql_escape_string(nl2br($_POST["faqAnswer"]))."'";
			if (!$g_db)
				db_connect();
			if (!$g_db)
				$_SESSION["mess"] .= "<h3>Could not connect!</h3>";
			else {
				if (!isset($_POST["edt"])) {
					$res3 = insert_query("tblfaq",array("faqQuestion","faqAnswer"),$vals);
				}
				else
				$res3 = update_query("tblfaq",array("faqQuestion","faqAnswer"),$vals,"faqID = ".$_POST["edt"]);
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
					<script>window.location = "index.php?con=faq&id=<? echo $theid; ?><? if (isset($_POST["edt"])) echo "&edt=1"; ?>";</script>
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
				$res3 = select_query(array("tblfaq"),array("*"),"faqID = ".$_GET["id"]);
				if ($res3 == false)
				{
					echo "<h3>System Error. Please try again or come back later. </h3>";
				}
				else if ($res3 == -1)
				{
					mess("FAQ Entry Not Found");
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

<h1 style="font-size:16px; margin-bottom:15px;"><? if ($gedit) echo "Editing Question"; else { ?>
  Add Question
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
<form action="index.php?con=faqart" method="post" name="groupsubmitform" id="groupsubmitform" onsubmit="">
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
      <td  style="padding-top:10px;" width="40%" valign="top"><strong>Question :</strong></td>
      <td  style="padding-top:10px;"><input name="faqQuestion" type="text" size="60" maxlength="70"  value="<? if (isset($_POST["faqQuestion"])) echo  $_POST["faqQuestion"]; else if ($gedit) echo $row["faqQuestion"];?>" />
        (max 70 characters)
        <? if (isset($_POST["faqQuestion"]) && $_POST["faqQuestion"] == "" ) { ?>
        <br />
          <span class="rednes">This Field is required!</span>
        <? } ?></td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" valign="top"><strong>Answer :</strong></td>
      <td  style="padding-top:10px;"><? if (isset($_POST["faqAnswer"]) && $_POST["faqAnswer"] == "" ) { ?>
          <span class="rednes">This Field is required!</span>
          <p></p>
        <? }?>
          <textarea name="faqAnswer" style="font-size:11px"   id="faqAnswer" wrap="soft" cols="70" rows="8" onkeyup=" checkChars(1000,'faqAnswer','charleft');" onblur="checkChars(1000,'faqAnswer','charleft');" onkeydown="checkChars(1000,'faqAnswer','charleft');"><? if (isset($_POST["faqAnswer"])) echo  $_POST["faqAnswer"]; else if ($gedit) echo $row["faqAnswer"];?></textarea>
          <div id="charleft"><b><? if (isset($row["faqAnswer"])) echo (1000-strlen($row["faqAnswer"])); else { ?>1000<? } ?></b> Characters <? if (isset($row["faqAnswer"])) echo "Left"; ?></div></td>
    </tr>
    <tr>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><input type="submit" name="Submit" value="<? if (isset($_GET["id"])) echo "Update"; else { ?>Save<? }?> Question" /></td>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><br />
          <br />
          <br />
          <br />      </td>
    </tr>
  </table>
</form>
