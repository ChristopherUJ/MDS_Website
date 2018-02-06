window.currenPaggg = "";
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

function ajaxpagela(url, containerid)
{
//alert(url);
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
  page_request.open('GET', url+bustcacheparameter, false)
  page_request.send(null)
}



function doscripts(div)
{
		var x = div.getElementsByTagName("script");    
	   for(var i=0;i<x.length;i++)   
	   {     
		 var a = x[i].text;
		 //alert(a);
		 eval(a);   
	   }
}

function loadpage(page_request, containerid)
{
  try {
  if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
    document.getElementById(containerid).innerHTML=page_request.responseText;
	   var div = document.getElementById(containerid);
		doscripts(div);
	}
	catch(ex)
	{
	alert(ex.message); // never displayed
	}
}

function ajaxpage(url, containerid, hide)
{
	if (window.currenPaggg == "cbasket.php")
		window.currenPaggg = "acc/do/credits.php?jax=1";
	if (window.currenPaggg != url || url.indexOf("_div",0) == -1) {
		document.getElementById(containerid).innerHTML = '<img src="images/ld2.gif" style = "display:inline; margin-right:5px;"></img>Loading ... ';
		ajaxpagel(url, containerid);
		if (hide != null)
		{
			document.getElementById(containerid).style.display = 'none';
		}
			window.currenPaggg = url;
	}
}

function ajaxpagenoload(url, containerid, hide)
{
	ajaxpagel(url, containerid);
	if (hide != null)
	{
		document.getElementById(containerid).style.display = 'none';
	}
}

function dfg()
{
}

function postAJAX(url, query, handler)
{
    var status = false;
    var contentType = "application/x-www-form-urlencoded; charset=UTF-8";

    // Native XMLHttpRequest object
    if (window.XMLHttpRequest) {
        request = new XMLHttpRequest();
        //request.onreadystatechange = handler;
        request.open("post", url, false);
        request.setRequestHeader("Content-Type", contentType);
        request.send(query);
        status = true;

    // ActiveX XMLHttpRequest object
    } else if (window.ActiveXObject) {
        request = new ActiveXObject("Microsoft.XMLHTTP");
        if (request) {
            //request.onreadystatechange = handler;
            request.open("post", url, false);
            request.setRequestHeader("Content-Type", contentType);
            request.send(query);
            status = true;
        }
    }

    return status;
}
