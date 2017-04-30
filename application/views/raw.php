<?php 
  $raw = get_all_raw();
  $raw_msg = "";
  $raw_count = "";
  //echo print_array($raw);die;
  $decode_category=['','Vegetables','English Vegetables','Fruits'];
  $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

  foreach($raw as $key) :
    // if(isset($key['quantity'])){ $hidden = 'hidden'; $shown = '';}else{ $hidden = ''; $shown = 'hidden';}
    $raw_msg .= "<tr class='raw-info-row'>
                      <td item-id='".$key['item_id']."'>".get_item_by_id($key['item_id'])['item_name']." <span class='hidden'>".$decode_category[$key['category']]."</span> <span class='hidden'>".$decode_subcategory[$key['subcategory']]."</span></td>
                      <td>".$this->config->item(get_item_by_id($key['item_id'])['uom'],'uom')."</td>
                      <td>".$key['total_qty']."</td>
                      <td>
                        <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored raw_info' data-items=".$key['proc_items_id']."><i class='material-icons'>expand_more</i></a>
                      </td>
                    </tr>
                  <div>";
                  $raw_count++;
            foreach ($key['data'] as $key1):
                    $ip = $key1['added_on']; 
                    $iparr = preg_split ("/[\s,]+/", $ip);
                    $added_on = $iparr[0];
                    $added_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($added_on)); 
     $raw_msg .="<tr class='raw-info-row crate_info hidden' data-items=".$key['proc_items_id']." >
              <td>Crate No: ".$key1['crate_no']."</td>
              <td hidden>
                <div class='mdl-textfield_raw mdl-js-textfield'>
                  <input class='mdl-textfield__input' type='text' id='' 
                    placeholder='Enter Crate No.' crate-id='".$key1['crate_id']."' value='".$key1['crate_no']."' />
                </div>
              </td>
              <td>Quantity: ".$key1['quantity']."</td>
              <td hidden>
                <div class='mdl-textfield_raw mdl-js-textfield'>
                  <input class='mdl-textfield__input' type='number' id='' 
                    placeholder='Enter Quantity' value='".$key1['quantity']."' />
                </div>
              </td>     
              <td>Comment: ".$key1['comment']."</td>
              <td hidden>
                <div class='mdl-textfield_raw mdl-js-textfield'>
                  <input class='mdl-textfield__input' type='text' id='' 
                    placeholder='Enter Comment' value='".$key1['comment']."' />
                </div>
              </td>    
              <td>
                <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored raw_edit'><i class='material-icons'>edit</i></a>
                <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored raw_add' crate-id='".$key1['crate_id']."' proc-items-id=".$key['proc_items_id']." item-id='".$key['item_id']."' raw-id='".$key1['raw_id']."'><i class='material-icons save_btn'>check_circle</i></a>  
                <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored raw_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a> 
              </td>
            </tr>
            <tr class='raw-info-row crate_info hidden' data2-items=".$key['proc_items_id'].">
              <td style='border-bottom: 1px dotted rgba(0, 0, 0, .12); margin:10px;'>Shelf Life: ".$key['shelf_life']." Day</td>
              <td style='border-bottom: 1px dotted rgba(0, 0, 0, .12);'>Date: " .$added_date."</td>
              <td style='border-bottom: 1px dotted rgba(0, 0, 0, .12);'>Time: ".$iparr[1]."</td>
              <td></td>
            ";
    endforeach;
  endforeach;
?>
  <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Raw Info</span>
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
        <label class="mdl-button mdl-js-button mdl-button--icon" for="raw_info_search">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
          <input class="mdl-textfield__input" type="search" id="raw_info_search" autofocus autocomplete="off" placeholder="Search..">
          <label class="mdl-textfield__label" for="raw_info_search"></label>
        </div>
      </div>
    </div>
    
  </header>
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">
              <?php
              $thead = ["hidden",""];
                if($raw_count == 0){
                  $length =0;
                  echo"<div class='mdl-card-status mdl-shadow--2dp'>
                          <p><i class='material-icons status_icon'>error</i><p>
                        <p><h3>Nothing !</h3></p>
                      </div>";
                }else{
                  $length=1;
                }
             echo" <button class='mdl-button mdl-js-button mdl-button--icon btn_icon_shadow' onclick='window.history.back()' style='min-width: 20px;' 
              data-upgraded=',MaterialButton' ".$thead[$length].">
                  <i class='material-icons'>arrow_back</i>
              </button>
              <table class='mdl-data-table raw_table mdl-js-data-table mdl-shadow--2dp' ".$thead[$length].">
                  <thead>
                    <tr>
                      <th>Item <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                      <th>UOM</th>
                      <th>Total Quantity</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>";
                  echo $raw_msg;
                      
                    ?>  
                  </tbody>
              </table>
            </div>
          </div>
      </div>
  </main>
<!--   <div class="fixed-action-btn">
    <input type="file" id="v_ratelist" style="display:none">
    <label for="v_ratelist" id="ratelistlabel" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
      <i class="material-icons">attach_file</i>
      <div class="mdl-tooltip mdl-tooltip--top" for="ratelistlabel" >Choose File</div>
    </label>
    <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-id="" id="v_RatelistUpload" href="#">
      <i class="material-icons">file_upload</i>
      <div class="mdl-tooltip mdl-tooltip--top" for="v_RatelistUpload" >Upload</div>
    </a>
  </div> -->
  <script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
   