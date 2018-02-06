<!DOCTYPE html>
<html>

<head>
<meta http-equiv="refresh" content="3;url=../index.html"/>

		<style>
			body {
				font-family: arial;
				color:#0073bd;
				text-align: center;
				font-size: 18px;
			}
		</style>
</head>
<body>

<?php
//if "email" variable is filled out, send email
  if (isset($_REQUEST['email']))  {
  
  //Email information
  $admin_email = "business@marinedata.co.za";
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $comment = $_REQUEST['comment'];
  
  //send email
  mail($admin_email, "$name", $comment, "From:" . $email);
  
  //Email response
  echo "Thank you for contacting us!";
  }
  
  //if "email" variable is not filled out, display the form
  else  {
?>

 <form method="post">
  Email: <input name="email" type="text" /><br />
  Subject: <input name="subject" type="text" /><br />
  Message:<br />
  <textarea name="comment" rows="15" cols="40"></textarea><br />
  <input type="submit" value="Submit" />
  </form>
  
<?php
  }
?>
</body>
</html>