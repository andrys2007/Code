<?

class mat_sch
{
  // выводит блоки обозначенные в шаблоне как #loop CELLANAL 	
  static public function Cell($Sender, $LoopBlock, $Data, $n)
    {
      if ( $Sender->FindID==$Data["sch_id"] )  $LoopBlock->SetValue("SELECT_TR",'select_tr');
      else  $LoopBlock->SetValue("SELECT_TR",'');		
	
      $LoopBlock->SetValue("sch_id",$Data["sch_id"]);
      $LoopBlock->SetValue("sch_name",$Data["sch_name"] );
      $LoopBlock->SetValue("sch_nom",number_format($Data["sch_nom"], 2, '.', '' ) );
      $LoopBlock->Show();  
	}	
	
  static public function Action()
   {
      $FindSnu=APP::val_get("FindSnu");
      unset($_GET["FindSnu"]);   

      $FindSnu=0;
      if ( isset($_SESSION["OTDEL_FindIDAfterSave"]) ) 
         {
	       $FindSnu=$_SESSION["OTDEL_FindIDAfterSave"];
           unset($_SESSION["OTDEL_FindIDAfterSave"]);
         }

      $UCHID=APPLICATION::GetIDUch();

      // делает списки по запросу SQL , работет быстро
      $ListNews=new TDBGridClass(30,'mat_sch','Cell','In34dV3343334op');
      $ListNews->SqlCount="select count(*) as count from sch where uch_id=$UCHID";										 
      $ListNews->Sql="select * from sch where uch_id=$UCHID order by sch_nom";
      $ListNews->TextNotData="<tr><td colspan='3'>Данных нет</td></tr>"; 
      $ListNews->Navi_Label='NAVI'; 
      $ListNews->Navi_Block='<div class="navigation">%NAVI%</div>';   
      $ListNews->FindKeyField="ediz_id";            
      $ListNews->FindID=$FindSnu;   

     
      $tpl = APP::Template('shb/mat_sch.php');    // Открываем шаблон
      $tpl->SetValueParent('TITLE',"Счета учета");
      $tpl->SetValue('CELLANAL',$ListNews);
      $tpl->ShowPrev();     
      $tpl->SetValueParent('INFO',"Кол-во записей: ".$ListNews->Count);
      $tpl->Show();    
   }
}
	
