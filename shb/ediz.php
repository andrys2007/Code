
<table cellpadding="0" cellspacing="0" border="0" class="tb_standart_th">
 <tr>
   <th>Название ед.из</th>
   <th width="280">Назв. ед.из (сокращенное)</th>
    <th width="48">#</th>
    <th width="17" style="padding:0px;" id="efwe242342"></th>
 </tr>
</table>



<div class="scroll_table_flex" id="id_flex">
<div class="ftable">
<table cellpadding="0" cellspacing="0" border="0" class="tb_standart" style="background-color:#FFF;" id="ssdsda">
#loop CELLANAL
<tr class="%SELECT_TR%" data-id="%ediz_id%" >
   <td>%ediz_name%</td>
   <td  width="282">%ediz_names%</td>
   <td width="50">
       <a href="" class="edit_href" onclick="KL.AddEdiz(1,%ediz_id%);return false;"></a> 
       <a href="" class="delete_href" onclick="KL.AddEdiz(4,%ediz_id%);return false;"></a>
       <a href="" onclick="LOGS.Show('ediz',%ediz_id%);return false;" class="href_jur"></a>
   </td>
</tr>
#end
</table>
</div>
</div>

%NAVI%




<div class="block_buttons_flex_bottom">  
     <input type="button" value="Добавить ед.измерения" onclick="KL.AddEdiz(2,0);"> 
</div>







