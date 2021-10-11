<? 

class ediz
{
  static public function Cell($Sender, $LoopBlock, $Data, $n)
    {
      if ( $Sender->FindID==$Data["ediz_id"] )  $LoopBlock->SetValue("SELECT_TR",'select_tr');
      else  $LoopBlock->SetValue("SELECT_TR",'');		
	
      $LoopBlock->SetValue("ediz_id",$Data["ediz_id"] );
      $LoopBlock->SetValue("ediz_name",$Data["ediz_name"] );
      $LoopBlock->SetValue("ediz_names",$Data["ediz_names"] );
      $LoopBlock->Show();  
	}

  static public function Action()
   {
      if  ( !InMode("menu_ediz") ) 
          {
            header('Location:?Action=LockMode');   
       	    return ;		
      	} 

      $FindSnu=val_get("FindSnu");
      unset($_GET["FindSnu"]);   

      $FindSnu=0;
      if ( isset($_SESSION["OTDEL_FindIDAfterSave"]) ) 
         {
      	   $FindSnu=$_SESSION["OTDEL_FindIDAfterSave"];
      	   unset($_SESSION["OTDEL_FindIDAfterSave"]);
         }

      $UCHID=APPLICATION::GetIDUch();

	  $ListNews=new TDBGridClass(30,'ediz','Cell','In34dV3343334op');
      $ListNews->SqlCount="select count(*) as count from ediz where uch_id=$UCHID";										 
      $ListNews->Sql="select * from ediz where uch_id=$UCHID order by ediz_name";
      $ListNews->TextNotData="<tr><td colspan='3'>Данных нет</td></tr>";                   
      $ListNews->Navi_Label='NAVI'; 
      $ListNews->Navi_Block='<div class="navigation">%NAVI%</div>';   // данной навигации по страницам
      $ListNews->FindKeyField="ediz_id";             // ключеваое поле по которому осущевствлает¤ поиск
      $ListNews->FindID=$FindSnu;   

      $tpl = APP::Template('shb/ediz.php');
      $tpl->SetValueParent('TITLE',"Единицы измерения");
      $tpl->SetValue('CELLANAL',$ListNews);
      $tpl->ShowPrev();     
      $tpl->SetValueParent('INFO',"Кол-во записей: ".$ListNews->Count);
      $tpl->Show();    
	   
   }
}


