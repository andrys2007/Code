<?  session_start();

include_once("inc.php");

$ClassName="main";
$ActionIndex="Action";
   
switch($Action)
{
	case 'Mat_Sch': // +++
	     $Shablon="#shb/shab_listinfo.php";
         $ClassName="mat_sch";
         $ActionIndex="Action";
	     break;	
}

include $ClassName.".php";
APPLICATION::Index($ClassName,$ActionIndex,$Shablon);
