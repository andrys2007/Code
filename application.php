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
     $tpl->start_html("SCREEN_PROG"); 	
	 $Class::$ActionIndex();
     $tpl->end_html(); 	     
	 $tpl->SetValue("MAIN_GLOBAL_DATE",APP::strDateShowMY($_SESSION["MAIN_GLOBAL_DATE"]) );
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
  
  
  static public function DostupModeMat($Mode)
   {
	 $user_id=$_SESSION["USER"]["user_id"];
	 $prava_id=APP::val($_SESSION["USER"]["user_dostup"]);		
	 $mol_id=APP::val($_SESSION["USER"]["mol_id"]);		

     $ErrorText="Данный режим доступен только для администратора ...";
     if ( $prava_id!=6) return false;  // Если доступ к материалам закрыт то выходим

  	 $Rez=false;
	 switch($Mode)
	  {
		 case 'prih':
		 case 'rash':
		 case 'perem':
		 
		      return true;
		 case 'mol':
		 case 'vp':
		 case 'sch':
		 case 'setting':
		 case 'set_dostup':
		 
		      if ( $mol_id>0 ) return false;
			  else return true;
		      break;
	  }
     if ( !$Rez ) 
 	    {
           echo $ErrorText;
	    }
	return $Rez; 
  }
  
  static public function GetParamFromURL()
   {
     $Inputs="";
      while( $element = each($_GET) )
	      $Inputs.=' <input name="'.$element["key"].'" value="'.$element["value"].'" type="hidden">';
      return 	$Inputs;
   }
  
  
  static public function SaveLogs($LogsOper,$SysNom,$logs_rem,$logs_base,$GetUch=0)
   {
     $date=APP::fGetDateMySql();
 	 $time=APP::fGetTime();  	
	 $UCHID=APPLICATION::GetIDUch();
	 if (isset($_SESSION["USER"]))    $UserID=APP::val($_SESSION["USER"]["user_id"]);	
	 else  $UserID=0;
	 $logs_rem=addslashes($logs_rem);
	 $logs_base=$logs_base;
	 $logs_ip=APP::GetIP();
	
     APP::AppendSQL("insert into logs (logs_date,logs_time,user_id,logs_snom,logs_oper,logs_rem,logs_base,logs_ip,uch_id) 
	                   values ('$date','$time',$UserID,$SysNom,$LogsOper,'$logs_rem','$logs_base','$logs_ip',$UCHID) ");
  }


  static public function TestDeleteMol($MolID)
   {
     $UCHID=APPLICATION::GetIDUch();	
     $d=APP::ExecuteSQL("select * from kar where uch_id=$UCHID and mol_id=$MolID");
     if ( $d->Count>0 ) return false;
     else return true;	
  }

  static public function TestDeleteSch($Sch)
   {
      $UCHID=APPLICATION::GetIDUch();	
      $d=APP::ExecuteSQL("select * from kar where uch_id=$UCHID and sch_nom=$Sch");
      if ( $d->Count>0 ) return false;
      else return true;	
   }

  static public function TestDeleteVp($VpID)
   {

	$rez=rest_api::RestCurl(rest_api::GetRestLink()."crm.productsection.list",array("filter"=>array("SECTION_ID"=>$VpID),"select1"=>array("ID","NAME")));	
	if  ( $rez["total"]>0 ) return false;
	else return true;
															 
  /*     $UCHID=APPLICATION::GetIDUch();	
     $d=APP::ExecuteSQL("select * from kar where uch_id=$UCHID and vp_id=$VpID");
     if ( $d->Count>0 ) return false;
     else return true;	*/
   }
  
  static public function GetVPVetka($Tip,$LevelCash)
   {
	 $Cash=APP::LoadCash("CATALOG");

     $DATA=array();
     $Count=0;
	 while( $Tip>0 )
	 {
        $DATA[$Count]=$Cash["KEY".$Tip];
		$Tip=APP::val($DATA[$Count]["SECTION_ID"]);
        $Count++;
	 }
	   
     $s='<a href="?Action=Mat_Vp" class="href_a">В начало списка</a>';
     for($i=$Count-1;$i>=0;$i--)
      {
     	if ( $i==0 )   
             if (strlen($s)>0) $s=$s.' / '.'<b class="Blue">'.$DATA[$i]["NAME"].'</b>';
             else $s='<b class="Blue">'.$DATA[$i]["NAME"].'</b>';
     	else
             if (strlen($s)>0) $s=$s.' / '.'<a href="?Action=Mat_Vp&Tip='.$DATA[$i]["ID"].'" class="href_a">'.$DATA[$i]["NAME"].'</a>';
             else $s='<a href="?Action=Mat_Vp&Tip='.$DATA[$i]["ID"].'" class="href_a">'.$DATA[$i]["NAME"].'</a>';
      }
     return $s;  
   }

  static public function SaveParam($NameValue,$Value,$UserID=0)
   {
     if ( $UserID==0 ) $UserID=$_SESSION["USER"]["user_id"];
     $UCHID=APPLICATION::GetIDUch();
   
     $d=APP::DBC();
     $d->ExecuteSQL("select * from par where uch_id=$UCHID and user_id=$UserID and par_name='$NameValue'");
     if ( $d->Count<1 ) $d->AppendSQL("insert into par (uch_id,user_id,par_name)  values ($UCHID,$UserID,'$NameValue')");
   
     $Type='';
     if ( is_numeric($Value) ) 
	      $d->UpdateSQL("update par set par_value_int=$Value,par_type='N' where uch_id=$UCHID and user_id=$UserID  and par_name='$NameValue'");
     else  if ( is_string($Value) ) 
             $d->UpdateSQL("update par set par_value_string='$Value',par_type='C' where uch_id=$UCHID and  user_id=$UserID  and par_name='$NameValue'");
     else return ;
   }


  static public function LoadParam($NameValue,$DefVal,$UserID=0)
   {
     if ( $UserID==0 ) $UserID=$_SESSION["USER"]["user_id"];
     $UCHID=APPLICATION::GetIDUch();
   
     $d=APP::DBC();
     $d->ExecuteSQL("select * from par where uch_id=$UCHID and user_id=$UserID and par_name='$NameValue'");
     if ( $d->Count<1 )  
        {
		  APPLICATION::SaveParam($NameValue,$DefVal);
		  return $DefVal;
	    }
     $DATA=$d->GetRow();
     if ( $DATA["par_type"]=='C' )
          return $DATA["par_value_string"];
     else
          if ( $DATA["par_type"]=='N' ) return $DATA["par_value_int"];
          else	 return $DefVal;
  }
  
}


class JMOL
{
	var $NOW_GRUP=array();
	var $PREV_GRUP=array();
	var $NEXT_GRUP=array();
	var $prev;
	var $next;
	function JMOL($MolID)
	 {
		$this->prev=false;
   	    $this->next=false;
		$NameOtdel="";
		$UCHID=APPLICATION::GetIDUch();
        $d=APP::DBC();
        $d->SQL="select * from mol where uch_id=$UCHID order by mol_name";
		$pos=$d->LoadRecord($MolID,"mol_id");
		if ($pos<1) $MolID=$d->Record[0]["mol_id"];
		for($i=0;$i<$d->Count;$i++)
		{
			if ( $d->Record[$i]["mol_id"]==$MolID)  
			   {
				   $this->NOW_GRUP=$d->Record[$i];
				   if ($i>0)
				     {
                       	 $this->prev=true;
						 $this->PREV_GRUP=$d->Record[$i-1];
					 }
				   if ($i+1<$d->Count) 
				     {
                 	      $this->next=true;
						 $this->NEXT_GRUP=$d->Record[$i+1];
					 }
			   }
		}
    }

	 function ShowBlock()
	 {
		if ($this->prev)   $prev='<a href="" onclick="MOL.Select('.$this->PREV_GRUP["mol_id"].');return false;" class="chnage_date_prev"></a>';
		else $prev='';
		if ($this->next)   $next='<a href="" onclick="MOL.Select('.$this->NEXT_GRUP["mol_id"].');return false;" class="chnage_date_next"></a>';
		else $next='';
		return $prev.'&nbsp;<a href=""  onclick="MOL.Show(this,3);return false;" class="change_date">'.$this->NOW_GRUP["mol_name"].'</a>&nbsp;'.$next;
	 }

}
