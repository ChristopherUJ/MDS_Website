<script type="text/javascript" src="tinymce/jscripts/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<script src="myscript.js"></script>
<script>
function chkc()
{
	var eeed = document.getElementById('itexist');
	if (eeed == null)
		setTimeout("chkc()",1000);
	else {
		if (eeed.value != 0) {
			document.getElementById('ntplistImage').value = eeed.value;
			document.getElementById('ntplistImage').onchange();
			document.getElementById('imloadself').className = "";
			document.getElementById('imurl').value = "";
			
		}
		else if (eeed.value == 0)
		{
			document.getElementById('imurl').focus();
			document.getElementById('imloadself').className = "";
			alert('The image you specified was invalid. Only jpg, gif and png formats supported');
		}
	}
}

function imexist (img)
{
	ajaxpage('imexist.php?im='+img,'ledit');
}
</script>
<?
	global $g_db;
	if (isset($_POST["cg"]))
	{
		//dispPost();
		$err = false;
		if ($_POST["empName"] == "" || $_POST["empPosition"] == "" || $_POST["empEmail"] == "" || $_POST["ntplistImage"] == "")
			$err = true;
		
		if ($err != true)
		{
			$vals = array();
			$vals[] = "'".$_POST["empName"]."'";
			$vals[] = "'".$_POST["empPosition"]."'";
			$vals[] = "'".$_POST["empEmail"]."'";
			$vals[] = "'".$_POST["empTel"]."'";
			$vals[] = "'".$_POST["ntplistImage"]."'";
			if (!$g_db)
				db_connect();
			if (!$g_db)
				$_SESSION["mess"] .= "<h3>Could not connect!</h3>";
			else {
				if (!isset($_POST["edt"])) {
					$res3 = insert_query("tblemps",array("empName","empPosition","empEmail","empTel","empAvatar"),$vals);
				}
				else
				$res3 = update_query("tblemps",array("empName","empPosition","empEmail","empTel","empAvatar"),$vals,"empID = ".$_POST["edt"]);
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
					<script>window.location = "index.php?con=employees&id=<? echo $theid; ?><? if (isset($_POST["edt"])) echo "&edt=1"; ?>";</script>
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
				$res3 = select_query(array("tblemps"),array("*"),"empID = ".$_GET["id"]);
				if ($res3 == false)
				{
					echo "<h3>System Error. Please try again or come back later. </h3>";
				}
				else if ($res3 == -1)
				{
					mess("Employee Not Found");
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

<h1 style="font-size:16px; margin-bottom:15px;"><? if ($gedit) echo "Updating Employee Details"; else { ?>
  Add Employee
  <? } ?>
  :</h1>

<form action="index.php?con=empedt" method="post" name="groupsubmitform" id="groupsubmitform" onsubmit="">
  <? if ($gedit) { ?>
  <input type="hidden" name="edt" value="<? echo $_GET["id"]; ?>" />
  <?  } ?>
  <input type="hidden" name="cg" value="1"/>
  <table border="0" align="center" cellpadding="5" style="padding:10px; width:100%;" cellspacing="0">
    <tr>
      <td style="padding-top:10px;">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" width="40%" valign="top"><strong>Employee Name &amp; Surname :</strong></td>
      <td  style="padding-top:10px;"><input name="empName" type="text" id="empName"  value="<? if (isset($_POST["empName"])) echo  $_POST["empName"]; else if ($gedit) echo $row["empName"];?>" size="60" maxlength="50" />
        (max 50 characters)
        <? if (isset($_POST["empName"]) && $_POST["empName"] == "" ) { ?>
        <br />
          <span class="rednes">This Field is required!</span>
        <? } ?></td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" valign="top"><strong>Position:</strong></td>
      <td  style="padding-top:10px;"><input name="empPosition" type="text" id="empPosition"  value="<? if (isset($_POST["empPosition"])) echo  $_POST["empPosition"]; else if ($gedit) echo $row["empPosition"];?>" size="60" maxlength="50" />
(max 50 characters)
  <? if (isset($_POST["empPosition"]) && $_POST["empPosition"] == "" ) { ?>
  <br />
  <span class="rednes">This Field is required!</span>
  <? } ?></td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" valign="top"><strong>Tel/Cell Number  :</strong></td>
      <td  style="padding-top:10px;"><input name="empTel" type="text" id="empTel"  value="<? if (isset($_POST["empTel"])) echo  $_POST["empTel"]; else if ($gedit) echo $row["empTel"];?>" size="60" maxlength="50" />
        (max 50 characters)</td>
    </tr>
    <tr>
      <td  style="padding-top:10px;" valign="top"><strong>Email Address:</strong></td>
      <td  style="padding-top:10px;"><input name="empEmail" type="text" id="empEmail"  value="<? if (isset($_POST["empEmail"])) echo  $_POST["empEmail"]; else if ($gedit) echo $row["empEmail"];?>" size="60" maxlength="50" />
        (max 50 characters)
        <? if (isset($_POST["empEmail"]) && $_POST["empEmail"] == "" ) { ?>
      <br />
      <span class="rednes">This Field is required!</span>
      <? } ?></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><div align="left">
                    <b>Image:</b>
                </div></td>
                <td><div align="left">
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td width="25%" align="left" valign="top"><center><b>Current Image</b><br />
<br />
<div id="theim" align="center"><img style="border:1px solid #999999;" src="<? if ($row["empAvatar"] == NULL) echo "../images/noimage.jpg"; else echo "../".$row["empAvatar"]; ?>" /></div></center>
                            <input type="hidden" name="ntplistImage" id="ntplistImage" value="<?php
		if ($row["empAvatar"] != NULL)
			echo $row["empAvatar"];	   	   
	   ?>" onchange="ajaxpage('savimg.php?id=<? echo $row["empID"]; ?>&img='+this.value,'theim');" /></td>
                        <td><p>Add Image from your computer <br />
			                <iframe src="uploadavts.php?id=1" width="360" height="60" scrolling="no" frameborder="no"></iframe>
                        </p>                          </td>
                      </tr>
                    </table>
                </div></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><input type="submit" name="Submit" value="<? if (isset($_GET["id"])) echo "Update"; else { ?>Add<? }?> Employee" /></td>
      <td  style="padding-top:10px; border-top:1px solid #CCCCCC;"><br />
          <br />
          <br />
          <br />      </td>
    </tr>
  </table>
</form>
