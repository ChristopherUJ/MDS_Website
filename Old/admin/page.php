<? if (isset($_GET["id"]))
{
	if (isset($_GET["edt"]))
	{
		mess("Page Successfully Updated!");
	}
	echo "<p>&nbsp;</p>";
}

?><h2>Page Administration:</h2>
<p>&nbsp;</p>
<table style="font-size:11px;" width="100%" border="0" cellpadding="5">
  <tr valign="middle">
    <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;"><strong>Toolbar</strong></td>
    <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;" width="76%"><strong>Page</strong></td>
  </tr>
  <tr valign="middle" style="background-color: 
		  ;">
    <td width="24%"  style=" border-bottom:1px dashed #CCCCCC; vertical-align:middle;"><table width="180" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td width="117"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image" type="image" onclick="window.location ='index.php?con=pageedt&id=1';" src="images/edit.gif" title="Edit" width="22" height="20" /></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
    <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%">Home Page </td>
  </tr>
  <tr valign="middle" style="background-color: 
		  ;">
    <td width="24%"  style=" border-bottom:1px dashed #CCCCCC; vertical-align:middle;"><table width="180" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td width="117"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image2" type="image" onclick="window.location ='index.php?con=pageedt&id=2';" src="images/edit.gif" title="Edit" width="22" height="20" /></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
    <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%">About Page  </td>
  </tr>
  <tr valign="middle" style="background-color: 
		  ;">
    <td  style=" border-bottom:1px dashed #CCCCCC; vertical-align:middle;"><table width="180" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td width="117"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image22" type="image" onclick="window.location ='index.php?con=pageedt&id=3';" src="images/edit.gif" title="Edit" width="22" height="20" /></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
    <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;">Solution Page </td>
  </tr>
</table>
<br />
