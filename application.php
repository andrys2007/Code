<? 

class APPLICATION
{
  static $NAST=NULL;	
  static $UCHID=0;	
  static $CATALOG_ID=15;
  
  static public function Index($Class,$ActionIndex,$Shablon)
  {
     $tpl = APP::Template('shb/main.php');
     $tpl->SetValue("SID_SESSION",APP::$SID);
     $tpl->SetValue("SHABLON",$Shablon);
     $tpl->SetValue("FOOTER","#shb/footer.php");
     $tpl->SetValue("USER_NAME",$_SESION["USER"]["user_name"]);
	 $tpl->SetValue("MAIN_GLOBAL_DATE",APP::strDateShowMY($_SESSION["MAIN_GLOBAL_DATE"]) );
     $tpl->start_html("SCREEN_PROG"); 	
	 $Class::$ActionIndex();
     $tpl->end_html(); 	     
     $tpl->Show();  
  }
  
  static public function GetIDUch()
  {
	return 0;  
  }

  static public function UserDostup()
   {
	 if (  val($_SESSION["USER"]["user_dostup"])==1 ) return false;
	 else return true;
   }
  
}
