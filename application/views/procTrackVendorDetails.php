<?php
  $current_date = date("Y-m-d");
  $tid = $this->input->get('tid');
  $uid = $this->input->get('uid');
  $vid = $this->input->get('vid');
  $tab_stat = $this->input->get('tab_stat');
  $history;
  if(isset($tid) && isset($uid)) {
    $history = get_all_proc_details($tid,$uid,$vid);
  }
   $hide_array = ["","hidden"];$disabled_array = ["","","disabled style='color:#B2DFDB'","disabled style='color:#B2DFDB'","disabled style='color:#B2DFDB'"];
   $field_status_color = ['','','style="color:#B2DFDB"','',''];
   $hider_edit = 0;  $shower_onspot = 1;
   if($tab_stat == 'history_tab'){ $hider_edit = 1; $shower_onspot = 0; }

   function getOnspot($id = NULL){
        $os_vendors = get_all_onspot_vendors($id);
        $onspot_v = json_decode($os_vendors,true);
     if(isset($onspot_v[0]['name'])){
        return $onspot_v[0]['name'];
     }else{
        return "None";   
     }

   }
    // echo print_array($history);die;

   // echo print_array(get_market_by_id(1));
   // die;

?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
   <span class="mdl-layout-title">Procurement History Info
   <?php echo($history['data'][0]['vendor_name'])?'for <b>'.$history['data'][0]['vendor_name'].'</b>':'';?>
   </span>
   <span class="mdl-layout-title">&emsp;<?php echo date('jS M Y');?></span>
   <div class="mdl-layout-spacer"></div>
   <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="procure_history_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="procure_history_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="procure_history_info_search"></label>
      </div>
    </div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
       <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
          <i class="material-icons">arrow_back</i>
       </button>
       <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp noMarBottom" >
         <thead>
           <tr>
             <th style="text-align: left;font-size:1.3em;" >
              <?php 
                if(isset($history['procure_date'])){
                   $my_date = $history['procure_date'];
                   echo "Date : ".date('j',strtotime($my_date))." <sup>".date('S',strtotime($my_date))."</sup> ".date('M, Y',strtotime($my_date));
                }
              ?>
             </th>
             <th></th>
             <th></th>
           </tr>
         </thead>
       </table>
        <table class="mdl-data-table table_procureInfo mdl-js-data-table  mdl-shadow--2dp">
          <thead>
            <tr>
              <th>Sr.No.</th>
              <th>Item <span class="sort_out"> <i class="material-icons sort_icon">sort_by_alpha</i>  </span></th>
              <th class='show_procure_class'>Status</th>                                               
              <th>Vendor <span class="sort_out"> <i class="material-icons sort_icon">sort_by_alpha</i>  </span></th>    
              <th <?= $hide_array[$shower_onspot];?>>OnSpot Vendor</th>                                            
              <th class='show_procure_class'>Market</th>
              <th>Quantity</th>
              <th <?= $hide_array[$hider_edit];?>>Target Price</th>  
              <th >Final Price</th> 
              <th class='show_procure_class'>Other Charges</th>
              <th <?= $hide_array[$hider_edit];?>>Actions</th>   
              <th <?= $hide_array[$shower_onspot];?>>Reason</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $sr_counter=0;$target_total=0;$final_total=0;
                $decode_category=['','Vegetables','English Vegetables','Fruits'];
                $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

                foreach($history['data'] as $key => $value) :
                  ++$sr_counter;
                  echo "<tr class='procure-history-info-row'".$field_status_color[$history['status']].">
                          <td class='count'></td>
                          <td class='mdl-data-table__cell--non-numeric show_procure_class".$value['item_id']."'>".get_item_by_id($value['item_id'])['item_name']." <span class='hidden'>".$decode_category[$value['category']]."</span> <span class='hidden'>".$decode_subcategory[$value['subcategory']]."</span></td>
                          <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_procure_class".$value['item_id']."'>
                            <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                              <input name='item_id' class='mdl-textfield__input input_search select_Item' type='text' autocomplete='off' id='selectProcItem' data-id='".$value['item_id']."' value='".get_item_by_id($value['item_id'])['item_name']."'>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label' for='selectProcItem' placeholder='' required!></label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient'></ul>
                              </div>
                            </div>
                          </td>
                          <td class='show_procure_class'>".$this->config->item($history['status'],'proc_log_status')."</td>
                          <td class='show_procure_class".$value['item_id']."'>".get_vendor_by_id($value['vendor_id'])['name']."</td>
                          <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_procure_class".$value['item_id']."'>
                            <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                              <input name='vendor_id' class='mdl-textfield__input input_search' type='text' autocomplete='off' id='searchVendors' data-id='".$value['vendor_id']."' value='".get_vendor_by_id($value['vendor_id'])['name']."'>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label' for='searchVendors' placeholder='' required!></label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient'></ul>
                              </div>
                            </div>
                          </td>
                          <td ".$hide_array[$shower_onspot].">".getOnspot($value['onspot_vendor_id'])."</td>
                          <td class='show_procure_class'>".get_market_by_id($history['market_id'])['name']."</td>
                          <!--<td class='mdl-data-table__cell--non-numeric edit-item hidden hide_procure_class".$value['item_id']."'>
                            <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                              <input name='market_id' class='mdl-textfield__input input_search' type='text' autocomplete='off' id='searchProcureMarkets' data-id='".$history['market_id']."' value='".get_market_by_id($history['market_id'])['name']."'>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label' for='searchProcureMarkets' placeholder='' required!></label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient'></ul>
                              </div>
                            </div>
                          </td>-->
                          <td class='show_procure_class".$value['item_id']."'>".$value['quantity']."</td>
                          <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_procure_class".$value['item_id']."'>
                            <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                              <input name='quantity' class='mdl-textfield__input' type='number' id='proc_quantity' value='".$value['quantity']."' data-id='".$value['quantity']."'>
                              <label class='mdl-textfield__label' for='proc_quantity' placeholder='' required!></label>
                            </div>
                          </td>
                          <td ".$hide_array[$hider_edit]." class='show_procure_class".$value['item_id']."'>".$value['target_price']."</td>
                          <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_procure_class".$value['item_id']."'>
                            <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                              <input name='target_price' class='mdl-textfield__input' type='number' id='target_price' value='".$value['target_price']."' data-id='".$value['target_price']."'>
                              <label class='mdl-textfield__label' for='target_price' placeholder=".' '." required!></label>
                            </div>
                          </td>
                          <td>".$value['final_price']."</td>";
                          $other_charges=0;
                          if(isset($value['other_charges']['extra_charges']) || isset($value['other_charges']['labor_charges'])){
                             $other_charges = $value['other_charges']['extra_charges'] + $value['other_charges']['labor_charges'];
                          }else{$other_charges = "None";}
                    echo "<td class='show_procure_class'>".$other_charges."</td>
                          <td ".$hide_array[$hider_edit]." style='white-space: nowrap;' data-item-id='".$value['item_id']."'>
                            <a ".$disabled_array[$history['status']]." class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_edit  procure-info-row-edit show_procure_class".$value['item_id']."'><i class='material-icons'>create</i></a>
                            <a ".$disabled_array[$history['status']]." data-proc=".$value['procure_id']." class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_delete  procure-info-row-delete show_procure_class".$value['item_id']."'><i class='material-icons'>delete</i></a>
                            <a ".$disabled_array[$history['status']]." class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_udpate  procure-info-row-done hidden hide_procure_class".$value['item_id']."' data-proc=".$value['procure_id']." data-items=".$value['proc_items_id']."><i class='material-icons'>done</i></a>
                            <a ".$disabled_array[$history['status']]." class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_delete  procure-info-row-cancel hidden hide_procure_class".$value['item_id']."'><i class='material-icons'>cancel</i></a>
                            <a ".$disabled_array[$history['status']]." class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored procure-info-row-undo hidden'><i class='material-icons'>undo</i></a>
                          </td>
                          <td class='show_procure_class'>
                          <button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon' id='reason".$sr_counter."'>
                            <i class='material-icons'>feedback</i>
                           </button>
                           <div class='mdl-tooltip mdl-tooltip--top' for='reason".$sr_counter."' >Reasons</div>
                            <ul class='mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right' for='reason".$sr_counter."'>
                             <li class='mdl-menu__item'>Extra Charge Reason: <b>";
                              // $keys = array_keys($value['reason']);echo print_array($keys);die;
                              if(isset($value['reason']['ambiguity_reasons'])){ echo $value['reason']['extra_charges_reason'];
                              }else{echo "None";}
                             echo"</b></li>
                             <li class='mdl-menu__item'>Ambiguity Charge Reason: <b>";
                             if(isset($value['reason']['ambiguity_reasons'])){ echo $value['reason']['ambiguity_reasons'];
                             }else{echo "None";}
                             echo"</b></li>
                             <li class='mdl-menu__item'>Labor Charge Reason: <b>";
                             if(isset($value['reason']['labor_charges'])){ echo $value['reason']['labor_charges'];
                             }else{echo "None";}
                             echo"</b></li>";
                             if(isset($value['reason']['reason_for_leaving_item'])){  
                             echo "<li class='mdl-menu__item'>Reason For Leaving Item: <b>".$value['reason']['reason_for_leaving_item'];
                             }
                             echo"</b></li>
                            </ul>
                          </td>";
                          // if($history['status']==1){
                                $target_total +=  ($value['target_price'] * $value['quantity']);
                                $final_total +=  $value['final_price'];
                          // }
                endforeach;       
                ?>              
          </tbody>
          <tfoot> 
          <tr role="row"> 
            <td rowspan="1" colspan="5"></td>
            <td rowspan="1" colspan="1"  class='show_procure_class'>Total Price</td>
            <td rowspan="1" colspan="1" class='hide_procure_class hidden'>Total Price</td> 
            <td <?= $hide_array[$shower_onspot]; ?> rowspan="1" colspan="1"></td>
            <td  <?= $hide_array[$hider_edit];?> class="total_price" rowspan="1" colspan="1" style="text-align:left;" value="<?= $target_total; ?>"> ₹  <?= $target_total; ?></td>
            <td style="text-align:left;"> ₹ <?= $final_total; ?></td>
          </tr> 
          </tfoot>
        </table>
      </div>
    </div>
</main>      
 <script type="text/javascript">
  var estdQty = <?php echo get_total_item_qty_from_orders(); ?>;
  var allMarkets = <?php echo get_all_markets(); ?>;
</script>
<script src="<?php echo base_url().'assets/js/procurement.js';?>"></script>
