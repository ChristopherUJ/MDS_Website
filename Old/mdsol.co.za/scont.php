<div id="tabs">
<?php

$to = "business@mdsol.co.za";
$subject = "mdsol.co.za - Query";


  $tx .= "New MDSOL Query:<br><br>";
  $tx .= "Name: ".$_POST["naam"]."<br>";
  $tx .= "Email: ".$_POST["email"]."<br>";
  $tx .= "Query:<br> ".$_POST["vraag"]."<br>";
  
  $ts .= "<b>Name:</b> ".$_POST["naam"]."\n";
  $ts .= "<b>Email:</b> ".$_POST["email"]."\n";
  $ts .= "<b>Query:</b>\n ".$_POST["vraag"]."\n";  
  
  
 autoEmail($tx, $to,$subject);
?>

<h2 style="font-size:18px; color:#003366; font-family:'Trebuchet MS';">Query Sent :</h2>
<p>&nbsp;</p>
<b>One of our consultants will get back to you shortly.</b><br />
<br />

<table style="background-repeat:repeat-x;" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><h2 style="font-size:18px; color:#003366; font-family:'Trebuchet MS';">Your query was as follows : </h2><p>&nbsp;</p>
      <p><?php echo nl2br($ts); ?></p>
      <p align="center">&nbsp;</p></td>
  </tr>
</table>
</div>
