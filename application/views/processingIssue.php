<?php 
  $raw = get_all_raw();
  $issue_empty="";
  $count_issue=0;
  $issue ="";
  // echo print_array($raw);die;
  //echo print_array(get_item_by_id(30));die;
  $decode_category=['','Vegetables','English Vegetables','Fruits'];
  $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

  foreach($raw as $key) :
    // if(isset($key['quantity'])){ $hidden = 'hidden'; $shown = '';}else{ $hidden = ''; $shown = 'hidden';}
    $issue .="<tr class='raw-info-row'>
            <td item-id='".$key['item_id']."'>".get_item_by_id($key['item_id'])['item_name']." <span class='hidden'>".$decode_category[$key['category']]."</span> <span class='hidden'>".$decode_subcategory[$key['subcategory']]."</span></td>
            <td>".$this->config->item(get_item_by_id($key['item_id'])['uom'],'uom')."</td>
            <td>".$key['total_qty']."</td>
            <td>
              <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored raw_info' data-items=".$key['proc_items_id']."><i class='material-icons'>expand_more</i></a>
            </td>
          </tr>";
          $count_issue++;
    foreach ($key['data'] as $key1):
      $assignee_name = '';$assignee_id='';
      $ip = $key1['added_on']; 
      $iparr = preg_split ("/[\s,]+/", $ip);
      $added_on = $iparr[0];
      $added_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($added_on)); 
      //print "$iparr[0] <br />";
      $issue .="<tr class='raw-info-row raw_info_tr hidden' data-items=".$key['proc_items_id'].">
              <td>Crate No: ".$key1['crate_no']."</td>
              <td>Quantity: ".$key1['quantity']."</td>
              <td>
                <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
                  <select class='mdl-selectfield__select'>";
                  foreach (get_item_by_id($key['item_id'])['sku'] as $key2 => $value2) {
                    $issue .='<option value='.$key2.'>'.$value2.'</option>';
                  }
                  $issue .="</select>
                  <label class='mdl-selectfield__label' for='item_category'>Sku</label>
                </div>
              </td>
              <td>
                <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
                  <select data-items='".$key['proc_items_id']."' item-id='".$key['item_id']."' data-qty='".$key1['quantity']."' crate-id='".$key1['crate_id']."' raw-id='".$key1['raw_id']."' processing_id='".$key['processing_id']."' class='mdl-selectfield__select assignee_append'>
                   <option value='".$assignee_id."' select='selected'>".$assignee_name."</option>
                  </select>
                  <label class='mdl-selectfield__label' for=''>Assignee</label>
                </div>
              </td>
            </tr>
            <tr class='raw-info-row raw_info_tr hidden'>
              <td style='border-bottom: 2px dotted rgba(0, 0, 0, .12);'>Date: " .$added_date."</td>
              <td style='border-bottom: 2px dotted rgba(0, 0, 0, .12);'>Shelf Life: " .$key['shelf_life']." days</td>
              <td style='border-bottom: 2px dotted rgba(0, 0, 0, .12);'>Comment: ".$key1['comment']."</td>
              <td></td>
            </tr>";
    endforeach;
  endforeach; 
?>
  <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Processing Issue</span>
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
                if($count_issue == 0){
                  $length =0;
                  echo"<div class='mdl-card-status mdl-shadow--2dp'>
                          <p><i class='material-icons status_icon'>error</i><p>
                        <p><h3>Nothing !</h3></p>
                      </div>";
                }else{
                  $length=1;
                }
              echo"<button class='mdl-button mdl-js-button mdl-button--icon btn_icon_shadow' onclick='window.history.back()'' style='min-width: 20px;' 
              data-upgraded=',MaterialButton' ".$thead[$length].">
                  <i class='material-icons'>arrow_back</i>
              </button>
              <table class='mdl-data-table processIssueTable mdl-js-data-table mdl-shadow--2dp'".$thead[$length].">
                  <thead>
                    <tr>
                      <th>Item <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                      <th>UOM</th>
                      <th>Total Quantity</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>";
                  echo $issue;
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
   