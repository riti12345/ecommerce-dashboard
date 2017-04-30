  <?php
  $current_date = date("Y-m-d");
  $tid = $this->input->get('tid');
  $uid = $this->input->get('uid');
  $tab_stat = $this->input->get('tab_stat');
  $history;
  //echo print_array($tid);die;
  if(isset($tid) && isset($uid)) {
    $history = get_all_proc_details($tid,$uid,NULL);
  }
  
   // $hide_array = ["hidden","","hidden","hidden","","hidden"];
  $disabled_array = ["disabled='disabled'","","","","","disabled='disabled' style='color:#B2DFDB'"];
  $status_arr = ["","hidden","hidden"];
  $anti_status_arr = ["hidden","",""];
  $hide_array = ['','','','','',''];
?>
  <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Inward Info</span>
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
        <label class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" for="inward_info_search">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
          <input class="mdl-textfield__input" type="search" id="inward_info_search" autofocus autocomplete="off" placeholder="Search..">
          <label class="mdl-textfield__label" for="inward_info_search"></label>
        </div>
      </div>
    </div>
    
  </header>
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
      <div class="mdl-grid ">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow " onclick="window.history.back()" style=" min-width: 20px;" 
            data-upgraded=",MaterialButton">
                <i class="material-icons">arrow_back</i>
          </button>

          <table class="mdl-data-table inward_table mdl-js-data-table mdl-shadow--2dp">
            <thead>
              <tr>
                <th>Item <span class="sort_out"> <i class="material-icons sort_icon">sort_by_alpha</i>  </span></th>
                <th>Vendor <span class="sort_out"> <i class="material-icons sort_icon">sort_by_alpha</i>  </span></th>
                <th>UOM</th>
                <th>Inward</th>
              </tr>
            </thead>
            <tbody>
             <?php
              $sr_counter=0;$temp=0;
              $decode_category=['','Vegetables','English Vegetables','Fruits'];
              $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

              foreach($history['data'] as $key => $value) :
                echo"<tr ".$disabled_array[$value['proc_item_status']]." class='inward-info-row'> 
                      <td item-id='".$value['item_id']."' class='mdl-data-table__cell--non-numeric'>".$value['item_name']." <span class='hidden'>".$decode_category[$value['category']]."</span> <span class='hidden'>".$decode_subcategory[$value['subcategory']]."</span></td>
                      <td>";
                       if(isset($value['vendor_id'])){
                         echo get_vendor_by_id($value['vendor_id'])['name'];
                       }else{echo "JIT";}
                      echo"</td>
                      <td>".$this->config->item($value['uom'],'uom')."</td>
                      <td style='white-space: nowrap;'>
                       <a ".$disabled_array[$value['proc_item_status']]." href='inwardCrates?id=".$value['proc_items_id']."&iid=".$value['item_id']."&vid=".$value['vendor_id']."' class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored inward_disabled'><i class='material-icons'>archive</i></a>
                       <a ".$disabled_array[$value['proc_item_status']]." class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored Close_inward inward_disable' proc_items_id=".$value['proc_items_id']."><i class='material-icons'>cancel</i></a>
                      </td>
                    </tr>";
              endforeach;    
             ?>       
            </tbody>
          </table>
            <a hidden class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent inward_submit'>Submit All</a>
          <!-- <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent Close_inward">Close Inward</button>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </main>    
  <script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
  <script>
    var allCrates = <?php echo get_all_crates()?>;
  </script>