<?php


////////XML funcs

function replnl($str)
{
	return preg_replace("/(\r\n)+|(\n|\r)+/", "", $str);
}

function pagnf()
{
	mess('Page Not Found!');
}

//Get last day of specific month
function getEndMonthDay($month,$year)
{
	if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 9 || $month == 11)
		return 31;
	else if ($month == 4 || $month == 6 || $month == 8 || $month == 10 || $month == 12)
		return 30;
	else if ($month == 2)
		if ($year % 4 == 0)
			return 29;
		else
			return 30;
}

function browser(&$ver)
{
$useragent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
} elseif (preg_match( '|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Firefox';
} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Safari';
} else {
        // browser not recognized!
    $browser_version = 0;
    $browser= 'Other';
}
	$ver = $browser_version;
	return $browser;
}

function getMonthName($month)
{
	if ($month == 1)
		return "January";
	if ($month == 2)
		return "February";
	if ($month == 3)
		return "March";
	if ($month == 4)
		return "April";
	if ($month == 5)
		return "May";
	if ($month == 6)
		return "June";
	if ($month == 7)
		return "July";
	if ($month == 8)
		return "August";
	if ($month == 9)
		return "September";
	if ($month == 10)
		return "October";
	if ($month == 11)
		return "November";
	if ($month == 12)
		return "December";

}



function rand_color() {
 $red = dechex(rand(0,255));
 $green = dechex(rand(0,255));
 $blue = dechex(rand(0,255));
 return strtoupper($red.$green.$blue);
}



function copyFile($url,$dirname){ 
    @$file = fopen ($url, "rb"); 
    if (!$file) { 
        echo"<font color=red>Failed to copy $url!</font><br>"; 
        return false; 
    }else { 
        $filename = basename($url); 
        $fc = fopen($dirname."$filename", "wb"); 
        while (!feof ($file)) { 
           $line = @fread ($file, 1028); 
           fwrite($fc,$line); 
        } 
        fclose($fc);  
        return true; 
    } 
}
					
function resize_image($image,$nimage,$dim) {
	$ext = substr($image,strlen($image)-3,strlen($image));
	//echo $image;
	$e = explode("tinymce/jscripts/tiny_mce/plugins/imagemanager/files/",$image);
	if ($e[0] == $image) {
		copyFile($image,"tinymce/jscripts/tiny_mce/plugins/imagemanager/files/".$_SESSION["usrid"]."/");
	}
	//$image = strtolower($image);
	$sTempFileName = "tinymce/jscripts/tiny_mce/plugins/imagemanager/files/".$_SESSION["usrid"]."/".basename($image); // temporary file at server side
	$oTempFile = fopen($sTempFileName, "r");
	$sBinaryPhoto = fread($oTempFile, @fileSize($sTempFileName));
	// Try to read image
	$nOldErrorReporting = error_reporting(E_ALL & ~(E_WARNING)); // ingore warnings
	
	if (strtolower($ext) == "jpg")
	$oSourceImage = @imagecreatefromstring($sBinaryPhoto); // try to create image
	else if (strtolower($ext) == "gif")
	$oSourceImage = @imagecreatefromgif($sTempFileName); // try to create image
	else if (strtolower($ext) == "png")
	$oSourceImage = @imagecreatefrompng($sTempFileName); // try to create image

	error_reporting($nOldErrorReporting);
	
	if (!$oSourceImage) // error, image is not a valid image
	{ 
		echo "<span style='font-size:10px; color:red'>Sorry...It was not  possible to read image $oSourceImage.Choose another photo in JPG,PNG or GIF format.</span>";
		return NULL;
	}	
	
	$nWidth = imagesx($oSourceImage); // get original source image width
	$nHeight = imagesy($oSourceImage); // and height
	

	$trans = imagecolortransparent($oSourceImage); 
	if($trans >= 0) { 
	
	$rgb = @imagecolorsforindex($oSourceImage, $trans); 
	
	$oldimg = $oSourceImage; 
	$oSourceImage = imagecreatetruecolor($dim,$dim); 
	$color = imagecolorallocate($oSourceImage,255, 255, 255); 
	imagefilledrectangle($oSourceImage,0,0,$dim,$dim,$color); 
	imagecopymerge ($oSourceImage,$oldimg,$dim-$nWidth,$dim-$nHeight,0,0,$nWidth,$nHeight,100); 
	
	} 

	// create small thumbnail
	
	$xscale=$nWidth/$dim;
	$yscale=$nHeight/$dim;
	
	// Recalculate new size with default ratio
	if ($nWidth < $dim && $nHeight < $dim)
	{
			$nDestinationWidth = $nWidth;
			$nDestinationHeight = $nHeight;	
	}
	else
	{
		if ($yscale>$xscale){
			$nDestinationWidth = round($nWidth * (1/$yscale));
			$nDestinationHeight = round($nHeight * (1/$yscale));
		}
		else {
			$nDestinationWidth = round($nWidth * (1/$xscale));
			$nDestinationHeight = round($nHeight * (1/$xscale));
		}
	}							
	
	$oDestinationImage = imagecreatetruecolor($dim, $dim);
		$color = imagecolorallocate($oDestinationImage,255, 255, 255); 
	imagefilledrectangle($oDestinationImage,0,0,$dim,$dim,$color); 
	imagecopyresampled(
		$oDestinationImage, $oSourceImage,
		($dim/2) - ($nDestinationWidth/2), ($dim/2) - ($nDestinationHeight/2), 0, 0,
		$nDestinationWidth, $nDestinationHeight,
		$nWidth, $nHeight); // resize the image

	ob_start(); // Start capturing stdout.
	if (strtolower($ext) == "jpg")
		imageJPEG($oDestinationImage,$nimage,90); // As though output to browser.
	else if (strtolower($ext) == "gif")
		imageGIF($oDestinationImage,$nimage,90); // As though output to browser.
	else if (strtolower($ext) == "png")
		imagePNG($oDestinationImage,$nimage,9); // As though output to browser.
	$sBinaryThumbnail = ob_get_contents(); // the raw jpeg image data.
	ob_end_clean(); // Dump the stdout so it does not screw other output.
	return true;	
}


function button($text, $link,$align){
?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style3 {font-weight: bold}
-->
</style>

<div align="<? echo $align; ?>">
<table style="margin:0px;" align="<? echo $align; ?>"><tr><td>
<span class="clear" style="margin-bottom: 26px;">
<a class="button" href="<? echo $link; ?>" onmouseout="this.blur(); return false;" onclick="this.blur();"><span><? echo $text; ?></span></a></span>
</td></tr></table></div>
<?
}

function dispPost()
{
	foreach($_POST as $key => $v)
	echo $key.": ".$v."<br>";
}

function dispGet()
{
	foreach($_GET as $key => $v)
	echo $key.": ".$v."<br>";
}

function retStrGet()
{
	$i = 0;
	foreach($_GET as $key => $v) {
		if ($i != 0)
			$str .= "&";
		else
			$i = 1;
			
		$str .=  $key."=".$v;
	}
	return $str;
}

function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}

function autoEmail($mess, $eemail,$sub = "Mytrade - Notification")
{
	$Name = "Marine Data"; //senders name
$email = "no-reply@marinedata.co.za"; //senders e-mail adress
$recipient = $eemail; //recipient
$mail_body = br2nl($mess); //mail body
$subject = $sub; //subject
$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields

ini_set('sendmail_from', 'dev@devonne.co.za'); //Suggested by "Some Guy"

mail($recipient, $subject, $mail_body, $header); //mail command :)
}



if(!function_exists('get_headers'))
{
    function get_headers($url,$format=0)
    {
        $url=parse_url($url);
        $end = "\r\n\r\n";
        $fp = fsockopen($url['host'], (empty($url['port'])?80:$url['port']), $errno, $errstr, 30);
        if ($fp)
        {
            $out  = "GET / HTTP/1.1\r\n";
            $out .= "Host: ".$url['host']."\r\n";
            $out .= "Connection: Close\r\n\r\n";
            $var  = '';
            fwrite($fp, $out);
            while (!feof($fp))
            {
                $var.=fgets($fp, 1280);
                if(strpos($var,$end))
                    break;
            }
            fclose($fp);

            $var=preg_replace("/\r\n\r\n.*\$/",'',$var);
            $var=explode("\r\n",$var);
            if($format)
            {
                foreach($var as $i)
                {
                    if(preg_match('/^([a-zA-Z -]+): +(.*)$/',$i,$parts))
                        $v[$parts[1]]=$parts[2];
                }
                return $v;
            }
            else
                return $var;
        }
    }
}


function file_exists_2($filePath)
{
	$AgetHeaders = @get_headers($filePath);
	if (preg_match("|200|", $AgetHeaders[0])) {
		return true;	
		} 
	else {
		return false;
	} 
}



function listImage($lid)
{
 global $g_db;

	if (!$g_db)
		db_connect();
	if (!$g_db)
		echo "<h3>Could not connect! </h3>";
	else {
			$res = select_query(array("tbllisting"),array("listImage"),"listID = ". $lid);
		if ($res == false)
		{
			echo "<h3>System Error. Please try again or come back later. </h3>";
			return 0;
		}
		else if ($res == -1)
		{
			return "No such record!";
		}	
		else {
			$row = mysql_fetch_assoc($res);
			if ($row["listImage"] != NULL && $row["listImage"] != "") $fe = true;
			$img = "<img src=\"";
			if ($fe) $img .=  $row["listImage"]; else $img .= "images/noimage.jpg"; $img .="\"";
			if ($fe) $img .= " height='80'";
			$img .= "border='1'/>";
			
			return $img;
		}
	}
}

//create small image from id
function listImageSmall($lid)
{
 global $g_db;

	if (!$g_db)
		db_connect();
	if (!$g_db)
		echo "<h3>Could not connect! </h3>";
	else {
			$res = select_query(array("tbllisting"),array("listImage","listTitle"),"listID = ". $lid);
		if ($res == false)
		{
			echo "<h3>System Error. Please try again or come back later. </h3>";
			return 0;
		}
		else if ($res == -1)
		{
			return "No such record!";
		}	
		else {
			$row = mysql_fetch_assoc($res);
			//$fe = file_exists_2($row["listImage"]);
			$fe = true;
			$g = "&nm=". makeurlf($row["listTitle"]);
			$img = "<a href='index.php?con=viewlist&id=".$lid.$g."'  style='border:none;' ><img  alt='' src=\"";
			if ($fe) $img .=  $row["listImage"]."\"  "; else $img .= "images/noimage.gif\" "; $img .=" ";
			if (!$fe) $img .= "title='No Image Available'";
			else $img .= "title='".$row["listTitle"]."' ";
			$img .= "border='0'/></a>";
			
			return $img;
		}
	}
}


function getAvatar($uid,$float = NULL)
{
global $site;
global $g_db;

	if (!$g_db)
		db_connect();
	if (!$g_db)
		echo "<h3>Could not connect! </h3>";
	else {
			$res = select_query(array("tbluser"), array("avatar"), "usrID = ".$uid);
		if ($res == false)
		{
			echo "<h3>System Error. Please try again or come back later. </h3>";
		}
		else if ($res == -1)
		{
			"Does Not Exist";
		}
		else {
			if ($float != NULL)
			{
				if ($float == 1)
				$f = " style='float:left;' ";
				else if ($float == 2)
				$f = " style='float:right;' ";
			}
			$row = mysql_fetch_assoc($res);
			if ($row["avatar"] != NULL) {?><img id="avtr" <? echo $f; ?> src="<? echo $row["avatar"]; ?>" /><? }
			else
			{
				if ($row["avatar"] == NULL) { echo "<img $f src='images/prof"; if (usergender($uid) == 0) echo "wo"; echo "man.jpg' />"; }
			}
		}
	}
}


function makeurlf($string)
{
	$s = str_replace("&","",$string);
	$s = str_replace("?","",$s);
	$s = str_replace(" ","_",$s);
	$s = str_replace("*","",$s);
	$s = str_replace(",","",$s);
	$s = str_replace("-","",$s);
	$s = str_replace("'","",$s);
	$s = str_replace('"',"",$s);
	return $s;
}


//returns true/false
function setOurCookie()
{
	setcookie("qwas", $_SESSION["usrid"], time()+3600);

}


function get_random_num()
{
  return (mt_rand() * mt_rand(1, 5));
}

function check_table_colval($table, $colname, $num)
{
  $result = select_query(array($table), array($colname), $colname." = ".$num);
  if ($result == false || $result == -1)
    return false;
  else
    return true;
}

function gen_password()
{
  $newpassword = "";
  while(strlen($newpassword) < 6)
  {
    $elem = mt_rand(48, 122);
    if (((48 <= $elem) && ($elem <= 57)) || ((97 <= $elem) && ($elem <= 122)))
      $newpassword .= chr($elem);
  }
  return $newpassword;
}

function mess2($message)
{
   echo	"<div align='center' style='border:double 3px #00CC00;'><br>".$message."<br><br></div><br>";
}

function mess($message)
{ if ($message != "") {?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:4px double #006699">
  <tr>
    <td align="center" valign="middle" style="padding:15px;">
<?
   echo	$message; ?>
  </td>
  </tr>
</table> 
<? }
}

function dummyErrorHandler ($errno, $errstr, $errfile, $errline) 
{ 
} 

function forceFlush() 
{    
	ob_start(); 
	ob_end_clean(); 
	flush(); 
	set_error_handler("dummyErrorHandler"); 
	ob_end_flush(); 
	restore_error_handler(); 
}

function spamcheck($spammed_field) {
  $spammed_field=strtolower($spammed_field);
  if((eregi("cc: ",$spammed_field))||(eregi("subject: ",$spammed_field))) {
   $spamhost=$_SERVER['REMOTE_HOST'];
   $spamrefr=$_SERVER['HTTP_REFERER'];
   $spamaddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
   if(strlen($spamaddr)<7) { $spamaddr=$_SERVER['HTTP_CLIENT_IP']; }
   if(strlen($spamaddr)<7) { $spamaddr=$_SERVER['REMOTE_ADDR']; }
   $thisfile=$_SERVER['SCRIPT_NAME'];
   $spamtext="FILE: $thisfile \nFROM: $spamrefr \nADDR: $spamaddr \nHOST: $spamhost \nINFO:\n$spammed_field\n";
   mail("devonne@interactivevision.co.za","ALERT: $spamaddr",$spamtext,"From: SpamCheck <spamcheck@domain.tld>\r\n");
   die();
  }
 }


function update_query($table, $A, $V , $condition)
{
	$qstr = "UPDATE ".$table. " SET ";
	reset($A);
	reset($V);
	
	$putcomma = false;
	for($i = 0; $i < count($A); $i++)
	{
	    if ($putcomma)
			$qstr .= ",";
		else
			$putcomma = true;	
		$qstr .= $A[$i] . " = " . $V[$i] ." ";
	} 
	
	if (condition != "")
		$qstr .= " WHERE " . $condition;
	//echo "<script>alert('".$qstr."');<//script>";
	//echo $qstr."<br>";
	$result = mysql_query($qstr);
	if(!$result){
		$err =  mysql_error();
		echo $err;
		$err = strtolower($err);
		if (count(explode("too many",$err)) > 1)
			reb();
		return false;
	}
	return true;
}


//returns result/false for error or -1 for no rows
function select_query($tableA, $columnA , $condition = "")
{
	$qstr = "SELECT ";
	reset($tableA);
	reset($columnA);
	
	$putcomma = false;
	foreach($columnA as $column)
	{
	    if ($putcomma)
			$qstr .= ",";
		else
			$putcomma = true;
			
		$qstr .= $column." ";
	} 
	
	$qstr .= " FROM ";
	
	$putcomma = false;
	foreach($tableA as $value)
	{
		if ($putcomma)
				$qstr .= ",";
			else
				$putcomma = true;
		$qstr .= $value . " ";
	}
	
	if ($condition != "")
		$qstr .= " WHERE " . $condition;
	//echo "<script>alert('$qstr');<//script>";
	//echo $qstr."<br>";
	$result = mysql_query($qstr);
	if($result == false){
		$err =  mysql_error();
		echo $err;
		$err = strtolower($err);
		if (count(explode("too many",$err)) > 1)
			reb();
		return false;
	}
	if (@mysql_num_rows($result) == 0)
	{
		return -1;
	}
	
	return $result;
}



//returns true/false
function insert_query($tblname, $col = 0, $values)
  {
    $str = "INSERT INTO ".$tblname." ";
    if ($col != 0)
    {
      $str .= "(";
      $comma = false;
      foreach ($col as $v)
      {
        if ($comma)
          $str .= ",";
        else
          $comma = true;
        $str .= $v;
      }
      $str .= ") ";
    }
    $str .= "values (";
    $comma = false;
    foreach ($values as $v)
    {
      if ($comma)
        $str .= ",";
      else
          $comma = true;
      $str .= $v;
    }
    $str .= ")";
	//echo "<script>alert('$str');<//script>";
	//echo $str."<br>";
	$result = mysql_query($str);
	if($result == false){
		$err =  mysql_error();
		echo $err;
		$err = strtolower($err);
		if (count(explode("too many",$err)) > 1)
			reb();
		return false;
	}	
	return true;
  }
  
 function reb()
 {
	exec("/bin/preb",$output,$retval);
 } 
 
  //returns true/false
function delete_query($table, $condition)
  {
  	$qstr = "DELETE ".$table. " FROM " .$table ;
	
	if (condition != "")
		$qstr .= " WHERE " . $condition;
	//echo $qstr."<br>";		
	$result = mysql_query($qstr);
	
	if(!$result){
		return false;
	}
		
	return true;
  }
  
?>
