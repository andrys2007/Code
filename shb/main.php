<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>

<title>Автоматизированная система по учету детей</title>
<meta name="Description" content=""/>
<meta name="Keywords" content="Тараз,новости" />
<meta name="robots" content="all"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="../sack.js"></script>
<script src="../jquery.min.js"></script>
<script src="../jquery.maskedinput.min.js"></script>
<script src="../mak_win.js"></script>
<script src="../jslib.js"></script>
<script src="../calend_func.js"></script>
<script src="../func.js"></script>



<script src="../mat.js"></script> 
<script src="../org.js"></script> 


<script>

  $(document).ready(function() 
   {			
   
      USER.Ready();
   
      OnKeyEvent("main_id_find",13,function() { GObject("IDHREFBRN_FIND").click(); } )
	  
	  /******************     Обработка хешстроки     ******************/
	  if ( document.location.hash.length>0 )
	     {
			 var s=document.location.hash.substring(1);
             var sd=s.split('=');
			 var y=parseInt(sd[1],10);
			 if ( sd[0]=='ScrollPos' )
			    {
				  if ( GObject("id_flex") ) GObject("id_flex").scrollTop=y;
				}
			 else
			    if ( sd[0]=='FindID' && GObject("id_flex") ) /******************     Обработка хешстроки  при поиске позиции про скроинге    ******************/
				   {
		             var tr,id,i,pos;	 
		             var FoundID=y; //146
                     for(i=0;i<document.getElementById('body').getElementsByTagName('tr').length;i++)
                      {
                        tr=document.getElementById('body').getElementsByTagName('tr')[i];
                        id=Val(tr.dataset.id);
                        if ( id==FoundID )  // Если нашли ID то определить позицию попадает ли в экран или нет
			               {
            				 h=$("#id_flex").height();    // Берем половинку высоты
            				 scrollTop=GObject("id_flex").scrollTop;
            				 h2=h/2;
            				 if ( tr.offsetTop<scrollTop || tr.offsetTop>(scrollTop+h) )
					            {
						          new_scrollTop=tr.offsetTop-h2;
						          GObject("id_flex").scrollTop=new_scrollTop;
					            }
				           }
                      }
				   }
			     
			 document.location.hash="";
		 }

	  if (document.getElementById("efwe242342"))  document.getElementById("efwe242342").style.width=widthScroll()+"px";
		 
   });
   
  $(window).resize(function() {
      if (document.getElementById("efwe242342"))  document.getElementById("efwe242342").style.width=widthScroll()+"px";
    }).resize();
   


$(function(){
	$('body').append('<iframe id="cookiesHackFrame" name="cookiesHackFrame" src="http://example.com/blank.html" style="display:none;"></iframe>');
	$('body').append('<form id="cookiesHackForm" action="http://example.com/" method="post" target="cookiesHackFrame" >');
	$('#cookiesHackForm').submit();
});

</script>

<link rel="stylesheet" type="text/css" href="../main.css" />
<link rel="stylesheet" type="text/css" href="../mak_win.css" />
<link rel="stylesheet" type="text/css" href="../calendar.css" />

<link rel="SHORTCUT ICON" href="et.png" >

</head>

<body id="body">
<input type="hidden" id="SID_SESSION" value="%SID_SESSION%">


%SHABLON%

</body>
</html>

