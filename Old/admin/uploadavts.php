<link href="i.css" rel="stylesheet" type="text/css">
<script>
function ajaxpagel(url, containerid)
{
  var bustcacheparameter = ""
  var page_request = false
  if (window.XMLHttpRequest) // if Mozilla, Safari etc
    page_request = new XMLHttpRequest()
  else if (window.ActiveXObject)
  { // if IE
    try 
    {
      page_request = new ActiveXObject("Msxml2.XMLHTTP")
    } 
    catch (e)
    {
      try
      {
        page_request = new ActiveXObject("Microsoft.XMLHTTP")
      }
      catch (e){}
    }
  }
  else
    return false
  page_request.onreadystatechange=function()
  {
    loadpage(page_request, containerid)
  }
  if (1) //if bust caching of external page
  bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
  page_request.open('GET', url+bustcacheparameter, true)
  page_request.send(null)
}

function loadpage(page_request, containerid)
{
  try {
  if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
    parent.document.getElementById(containerid).innerHTML=page_request.responseText;
	}
	catch(ex)
	{
	alert(ex.message); // never displayed
	}
	
   var div = parent.document.getElementById(containerid);
   var x = div.getElementsByTagName("script");    
   for(var i=0;i<x.length;i++)   
   {     
     var a = x[i].text;
   	// alert(a);
	 eval(a);   
   }
}

function ajaxpage(url, containerid, hide)
{
	parent.document.getElementById(containerid).innerHTML = '<img src="images/ld2.gif" style = "display:inline; margin-right:5px;"></img>Loading ... ';
	ajaxpagel(url, containerid);
	if (hide != null)
	{
		parent.document.getElementById(containerid).style.display = 'none';
	}
}
</script>
<style type="text/css">
.style2 {color: #000000; font-weight: bold; }
.style16 {font-size: 10px;}
.style17 {font-size: 10px}
</style>
<? if (isset($_POST["submit"])) {
		$path = "";
		$filename = "";
		$ext = "";
		$target_path = "../thumbtmp/";
		$x = rand(5000,10000);
		$ext = substr($_FILES['uploadedfile']['name'], strlen($_FILES['uploadedfile']['name']) - 3, strlen($_FILES['uploadedfile']['name']) );
		$filename = substr($_FILES['uploadedfile']['name'],0,strlen($_FILES['uploadedfile']['name'])-4);
		$n = str_replace(" ","",$filename)."_".$x.".".$ext;
	
		if (strtolower($ext) != "png" && strtolower($ext) != "jpg" && strtolower($ext) != "gif")
		{
			?>
			<script>alert("Only Gif, Jpeg and Png formats are allowed. Please choose an Image!");</script>
			<?
		}  	
		else if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path.$n)) {

?>			<script>
function chlimg() {
	var limg = parent.document.getElementById('limgge'); 
	if (limg != null){
			if (limg.value != "")
				parent.document.getElementById('ntplistImage').value = limg.value;
			else
				parent.document.getElementById('ntplistImage').value = "";
	}
	else
	{
		setTimeout("chlimg()",1000);
	}
}
parent.document.getElementById('ntplistImage').value = "<? echo $target_path.$n; ?>"; ajaxpage('savimgs.php?id=<? echo $_POST["id"]; ?>&img='+'<? echo $target_path.$n; ?>','theim'); setTimeout('chlimg()',1000); </script>
			<?
		} 
		else{
			?>
<?php
			$filearray = $_FILES['uploadedfile'];
			switch ($filearray["error"]) {
				case UPLOAD_ERR_INI_SIZE:
					$err = "The uploaded file exceeded 1mb";
				break;
				case UPLOAD_ERR_FORM_SIZE:
					$err = "The uploaded file exceeded 1mb.";
				break;
				case UPLOAD_ERR_PARTIAL:
					$err = "The uploaded file was only partially uploaded.";
				break;
				case UPLOAD_ERR_NO_FILE:
					$err = "No file was uploaded.";
				break;
				case UPLOAD_ERR_NO_TMP_DIR:
					$err = "Missing a temporary folder.";
				default:
					$err = "An unknown file upload error occured";
			}
			?>
				<script>alert('<? echo $err; ?>'); </script>
			<?
		}

}

?>


<form action="uploadavts.php" method="post" enctype="multipart/form-data" name="upload" target="_self" onSubmit="if (document.getElementById('uploadedfile').value == '') {alert('Please select a file first!'); return false; } else {
document.getElementById('hi').style.display = 'none';document.getElementById('load').style.display = 'block';
 return true; }" >
 <input name="oid" type="hidden" value="<? echo $oid; ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
	<div id="hi"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="left" style=" font-size:10px;">
          <div align="left"><span class="style2">
            <input type="hidden"  name="MAX_FILE_SIZE" value="1048576" />
			<input type="hidden" name="id" value="<? echo $_GET["id"].$_POST["id"]; ?>"/>
          </span><span class="style17">( Note: File size limited to 1mb ) </span></div>
        </div></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="79%" align="center"><table width="360" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td><span class="style2">
                  <input  style="margin:0px;" id="uploadedfile" name="uploadedfile" type="file" />
                  <input name="submit"  type="submit" style="height:21px;margin:0px; margin-top:1px; vertical-align:top;" value="Upload File" />
                </span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <span class="style2">            </span></td>
        </tr>
      </table>
	  
	  </div>
<div id="load" style="display:none;">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><br>
<img src="images/ld.gif" style="float:left"><span class="style16"> Loading... Please be patient.</span></td>
  </tr>
</table>
</div></td>
    </tr>
</table>
</form>
