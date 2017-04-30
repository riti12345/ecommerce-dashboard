<?php
  // $tid = $this->input->get('tid');
  $jitid = $this->input->get('jitid');
  $tab_stat = $this->input->get('tab_stat');
  $history;
    $history = get_all_jit_details();
    // echo print_array($history);die;
   $hide_array = ["","hidden"];$disabled_array = ["","disabled style='color:#B2DFDB'","","",""];
   $field_status_color = ['','','style="background-color:#E0E0E0"','',''];
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
  // echo print_array(get_team_by_id(6));
  // die;

?>
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">JIT INFO</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="jit_info_search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="search" id="jit_info_search" autofocus autocomplete="off" placeholder="Search..">
              <label class="mdl-textfield__label" for="jit_info_search"></label>
            </div>
          </div>
        </div>
    </header>
      <main class="mdl-layout__content mdl-color--grey-100 get_ids" data-uid="<?=$jitid?>">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            
            <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;" data-upgraded=",MaterialButton">
              <i class="material-icons">arrow_back</i>
            </button>
            <div class="mdl-card-event_info_procure mdl-shadow--2dp">
              <table class="mdl-data-table mdl-js-data-table">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th class="mdl-data-table__cell--non-numeric" id="sortItems">Procured(Items)</th>
                    <th>Assigned To</th>
                    <th>Booked On</th>
                    <th>Quantity</th>
                    <th>target Price</th>
                    <th>Final Price</th>
                    <th>Markets</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="jit_info_body">
                  <form action="#">
                    <?php
                      $sr_counter=0;$temp=0;
                      $decode_category=['','Vegetables','English Vegetables','Fruits'];
                      $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

                      foreach ($history['data'] as $i => $value) :
                        $originalDate = $history['jit_date'];
                        $newDate = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($originalDate));
                        echo "<tr class='jit_info_row'>
                                <td class='count'></td>
                                <td class='show_jit_class".$value['jit_items_id']."'>".get_item_by_id($value['item_id'])['item_name']."<span class='hidden'>".$decode_category[$value['category']]."</span> <span class='hidden'>".$decode_subcategory[$value['subcategory']]."</span></td>
                                <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_jit_class".$value['jit_items_id']."'>
                                  <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                                    <input name='item_id' class='mdl-textfield__input input_search select_Item' type='text' autocomplete='off' id='editJitItem' item-id='".$value['item_id']."' value='".get_item_by_id($value['item_id'])['item_name']."'>
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
                                <td class='show_jit_class".$value['jit_items_id']."' >".get_team_by_id($history['assignee_id'])['username']."</td>
                                <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_jit_class".$value['jit_items_id']."'>
                                  <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label' style='width: 90px;margin-left: 30px;'>
                                    <select required='' id='team' class='mdl-selectfield__select'>
                                      <option value=".$history['assignee_id'].">".get_team_by_id($history['assignee_id'])['username']."</option>
                                    </select>
                                    <label class='mdl-selectfield__label' for='team'>Assign To</label>
                                  </div>
                                </td>
                                <td>".$newDate."</td>
                                <td  class='show_jit_class".$value['jit_items_id']."'>".$value['quantity']."</td>
                                <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_jit_class".$value['jit_items_id']."'>
                                  <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                                    <input name='quantity' class='mdl-textfield__input' type='number' id='proc_quantity' value='".$value['quantity']."' data-id='".$value['quantity']."'>
                                    <label class='mdl-textfield__label' for='proc_quantity' placeholder='' required!></label>
                                  </div>
                                </td>
                                <td class='target_price'>".$value['target_price']."</td>
                                <td class='show_jit_class".$value['jit_items_id']."'>".$value['final_price']."</td>
                                <td class='mdl-data-table__cell--non-numeric edit-item hidden hide_jit_class".$value['jit_items_id']."'>
                                  <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                                    <input name='final_price' class='mdl-textfield__input' type='number' id='final_price' value=".$value['final_price'].">
                                    <label class='mdl-textfield__label' for='final_price' required!></label>
                                  </div>
                                </td>
                                <td  class='".$value['jit_items_id']."'>".get_market_by_id($value['market_id'])['name']."</td>
                                <td class='mdl-data-table__cell--non-numeric edit-item hidden'>
                                  <div class='mdl-textfield--floating-label mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label'>
                                    <input name='market_id' class='mdl-textfield__input input_search' type='text' autocomplete='off' id='editJitMarkets' data-id='".$value['market_id']."' value='".get_market_by_id($value['market_id'])['name']."'>
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
                                </td>
                                <td style='white-space: nowrap;' data-item-id='".$value['jit_items_id']."'>
                                  <a  class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_edit  jit-info-row-edit show_jit_class".$value['jit_items_id']."'><i class='material-icons'>create</i></a>
                                  <a  data-proc=".$value['jit_id']." class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_delete  jit-info-row-delete show_jit_class".$value['jit_items_id']."'><i class='material-icons'>delete</i></a>
                                  <a  class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_udpate  jit-info-row-done hidden hide_jit_class".$value['jit_items_id']."' data-proc=".$value['jit_id']." data-items=".$value['jit_items_id']."><i class='material-icons'>done</i></a>
                                  <a  class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect procure_delete  jit-info-row-cancel hidden hide_jit_class".$value['jit_items_id']."'><i class='material-icons'>cancel</i></a>
                                  <a  class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored jit-info-row-undo hidden'><i class='material-icons'>undo</i></a>
                                </td>
                             </tr>";
                             $temp += $value['quantity']*$value['final_price'];
                      endforeach;
                    ?>
                  </form>
                </tbody>
                 <tfoot> 
                  <tr role="row"> 
                    <td>
                    <td rowspan="1" colspan="4" style="width: 150px;">Total Price</td> 
                    <td rowspan="1" colspan="1" style="text-align:left;">₹<input size="5" disabled class="back_none" value="<?= $temp; ?>" /></td>
                    <td></td>
                  </tr> 
                  </tfoot>
              </table>
            </div>
          </div>
        </div>
      </main>
      
    <script src="<?php echo base_url().'assets/js/jit.js';?>"></script>
    <script type="text/javascript">
     var allMarkets = <?php echo get_all_markets(); ?>;
     var estdQty = <?php echo get_total_item_qty_from_orders(); ?>;
    </script>