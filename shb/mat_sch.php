
<table cellpadding="0" cellspacing="0" border="0" class="tb_standart_th">
 <tr>
   <th  width="80">N счета</th>
   <th>Название счета</th>
    <th width="48">#</th>
    <th width="17" style="padding:0px;" id="efwe242342"></th>
 </tr>
</table>



<div class="scroll_table_flex" id="id_flex">
<div class="ftable">
<table cellpadding="0" cellspacing="0" border="0" class="tb_standart" style="background-color:#FFF;" id="ssdsda">
#loop CELLANAL
<tr class="%SELECT_TR%" data-id="%sch_id%" >
   <td width="82" align="right">%sch_nom%</td>
   <td>%sch_name%</td>
   <td width="50">
       <a href="" class="edit_href" onclick="MAT.AddSch(1,%sch_id%);return false;"></a> 
       <a href="" class="delete_href" onclick="MAT.AddSch(4,%sch_id%);return false;"></a>
       <a href="" onclick="MAT.ShowLogs('sch',%sch_id%);return false;" class="href_jur"></a>
   </td>
</tr>
#end
</table>
</div>
</div>

%NAVI%




<div class="block_buttons_flex_bottom">  
     <input type="button" value="Добавить новый счет" onclick="MAT.AddSch(2,0);"> 
</div>







