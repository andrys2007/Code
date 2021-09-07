<div class="main_flex">

     <div class="flex1_84">
         
         #{include "shb/menu.php";}

         <div class="head_gray">
              <div class="left_block">
                   <div class="row_bold">
                        %TITLE%
                  </div>
                  <div class="row_small">
                      %INFO% 
                  </div>
             </div>     

             
             #if (DIAG:0)
             <div class="right_block">
                  <a href="" class="btnfind" onclick="FIND.Diag(GObject('main_id_find'),null);return false;" id="IDHREFBRN_FIND"></a> 
                  <input type="text" value="%HeadFindValue%" placeholder="Укажите код диаг. либо название" class="find_input" id="main_id_find"> 
             </div>      
             #endif       

             
         </div>
     
     </div>
      
     <div class="flex100_proc">
     <div class="flex2in_nap" style="padding:20px;">
     
         %SCREEN_PROG%

          
      </div>
      </div>
      
                
      <div class="flex3_50">
           %FOOTER%
      </div>     
      
</div>      

