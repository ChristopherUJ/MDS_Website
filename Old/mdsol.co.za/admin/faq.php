<?

if (isset($_GET["id"]))
{
	if (isset($_GET["edt"]))
	{
		mess("FAQ Entry Successfully Updated!");
	}
	else
	{
		mess("FAQ Entry Added!");
	}
	echo "<p>&nbsp;</p>";
}
global $g_db;
if (isset($_GET["del"]))
{
			if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = delete_query("tblfaq","faqID = ".$_GET["del"]);
				mess("FAQ Entry Deleted!");
	echo "<p>&nbsp;</p>";
			}
}
?><table width="70%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td><h2>FAQ Administration:</h2>
      <p>&nbsp;</p><table style="font-size:11px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblfaq"), array("faqQuestion","faqID"), "1 = 1 order by faqDate");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No FAQ's available");
				else{
				$i = 1; ?>
              <tr valign="middle">
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;"><strong>Toolbar</strong></td>
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;" width="76%"><strong>Frequently Asked Questions </strong></td>
              </tr>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
		   ?>
              <tr valign="middle" style="background-color: 
		  <?php 
		  
		  ?>;">
                <td width="24%"  style=" border-bottom:1px dashed #CCCCCC;" valign="middle"><table width="180" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td width="117"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="33%" align="center" style=" vertical-align:middle;"><a title="Edit"  href="index.php?con=faqart&id=<?php echo $row["faqID"]; ?>"><img src="images/edit.gif" style="border:none; margin-top:4px;" align="absbottom"  width="22" height="20" /></a></td>
                            <td width="33%" align="center" style=" vertical-align:middle;"><a title="remove" href="Remove" onclick="if (confirm('Are you sure you want to delete the Question?')) { window.location ='index.php?con=faq&del=<?php echo $row["faqID"]; ?>'; } return false;"><img src="images/remove.gif" style="border:none; margin-top:4px;" align="absbottom" width="15" height="16" /></a></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"><?php echo $row["faqQuestion"]; ?> </td>
              </tr>
              <?php
		  		} }
		   } ?>
            </table>
	  <br />
      <input name="add" type="button" id="add" value="Add new" onclick="window.location = 'index.php?con=faqart'" /></td>
  </tr>
</table>
