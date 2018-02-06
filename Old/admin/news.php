<?

if (isset($_GET["id"]))
{
	if (isset($_GET["edt"]))
	{
		mess("News Entry Successfully Updated!");
	}
	else
	{
		mess("News Entry Added!");
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
				$res = delete_query("tblnews","newsID = ".$_GET["del"]);
				mess("News Entry Deleted!");
	echo "<p>&nbsp;</p>";
			}
}
?><table width="70%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td><h2>News Administration:</h2>
      <p>&nbsp;</p><table style="font-size:11px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblnews"), array("newsTitle","newsID"), "1 = 1 order by newsDate");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No News articles available");
				else{
				$i = 1; ?>
              <tr valign="middle">
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;"><strong>Toolbar</strong></td>
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;" width="76%"><strong>News Article </strong></td>
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
                            <td width="33%" align="center" style=" vertical-align:middle;"><a title="Edit"  href="index.php?con=newsart&id=<?php echo $row["newsID"]; ?>"><img src="images/edit.gif" style="border:none; margin-top:4px;" align="absbottom"  width="22" height="20" /></a></td>
                            <td width="33%" align="center" style=" vertical-align:middle;"><a title="remove" href="Remove" onclick="if (confirm('Are you sure you want to delete the news article?')) { window.location ='index.php?con=news&del=<?php echo $row["newsID"]; ?>'; } return false;"><img src="images/remove.gif" style="border:none; margin-top:4px;" align="absbottom" width="15" height="16" /></a></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"><a href="../index.php?con=news&id=<? echo $row["newsID"]; ?>"><?php echo $row["newsTitle"]; ?> </td>
              </tr>
              <?php
		  		} }
		   } ?>
            </table>
	  <br />
      <input name="add" type="button" id="add" value="Add new" onclick="window.location = 'index.php?con=newsart'" /></td>
  </tr>
</table>
