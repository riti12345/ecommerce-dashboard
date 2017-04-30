<?php
  $bills = get_all_vendor_bills();
  //echo print_array($bills);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Vendor Bills</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable list_search">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="vendor_bill_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="vendor_bill_search" autofocus placeholder="Search.." autocomplete='off'>
        <label class="mdl-textfield__label" for="vendor_bill_search"></label>
      </div>
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable card_search hidden">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="bill_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="bill_search" autofocus placeholder="Search.." autocomplete='off'>
        <label class="mdl-textfield__label" for="bill_search"></label>
      </div>
    </div>
  </div>
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
      <a href="#scroll-tab-1" class="mdl-layout__tab mdl-layout__tab_3 vendor_bills_tab is-active">Summary</a>
      <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab_3 vendor_bills_tab_1 tab_switch">Today</a>
      <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab_3 vendor_bills_tab_2 tab_switch">History</a>
    </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
 <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
<section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
  <div class="page-content">
     <div class="mdl-grid jit">
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
          <div class="card-details mdl-shadow--2dp">
            <table class="mdl-data-table_jit_head mdl-js-data-table vendorBillTable">
              <tbody>
                <tr class="bill_add_row">
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="bill_no" placeholder="" >
                      <label class="mdl-textfield__label" for="bill_no">Bill Number</label>
                    </div>   
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="number" id="bill_amt" placeholder="" >
                      <label class="mdl-textfield__label" for="bill_amt">Bill Amount</label>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input input_search" type="text" id="vendor_id" autocomplete="off" placeholder="">

                      <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                        <span class="mdl-chip__text"></span>
                        <button type="button" class="mdl-chip__action">
                        <i class="material-icons">cancel</i></button>
                      </span>
                      <label class="mdl-textfield__label" for="vendor_id">Vendor</label>
                      <div class="suggestionClient hidden">
                         <ul class="suggestionListClient"></ul>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input validate_date" type="text" id="datepicker" placeholder=""/>

                      <input class="mdl-textfield__input validate_date hidden" type="text" id="to" placeholder="" />
                      <label class="mdl-textfield__label mdl-textfield__label" for="sample3">Bill Date</label>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="comment" placeholder="" >
                      <label class="mdl-textfield__label" for="comment">Comments</label>
                    </div>
                  </td>
                  <td>
                   <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
                     <select id='bill_status' class='mdl-selectfield__select input'>
                        <option value='0' selected='selected'>Un-Paid</option>
                        <option value='1' >Paid</option>
                     </select>
                     <label class='mdl-selectfield__label' for='bill_status'>Bill Status</label>
                   </div>                    
                  </td>
                  <td>
                    <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="add_bill" >
                      <i class="material-icons">done</i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="mdl-card-event_add_jit addJitScreen mdl-card mdl-shadow--2dp">
            <table class="mdl-data-table table_jit mdl-js-data-table vendorBillTableInfo">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th class="pull_center">Bill Number</th>
                  <th class="pull_center">Bill Amount</th>
                  <th>Vendor</th>
                  <th>Bill Date</th>
                  <th>Comments</th>
                  <th>Bill Status</th>
                  <th>Actions</th>
                  <th class='hidden'></th>
                </tr>
              </thead>
              <tbody class="bill_tbody tBodySearch">
              <?php
                foreach ($bills as $key => $value):
                echo "<tr class='bill_row' onmouseover='mOver(this)' onmouseout='mOut(this)'>
                  <td class='count bill_td'>
                   <div class='vendor_bill_log mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'>
                    <i class='material-icons' style='color:#fff'>add</i>
                    </div>
                  </td>
                  <td >
                    <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input mdl-textfield__input_border pull_center' value=".$value['bill_no']." type='text' id='' readonly>
                    </div>
                  </td>
                  <td >
                    <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input mdl-textfield__input_border pull_center' value=".$value['bill_amt']." type='text' id='' readonly>
                    </div>
                  </td>
                  <td>
                    <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input mdl-textfield__input_border' value=".$value['vendor_name']." vendor-id=".$value['vendor_id']." type='text' id='vendor_auto' readonly>
                      <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                        <span class='mdl-chip__text'></span>
                        <button type='button' class='mdl-chip__action'>
                        <i class='material-icons'>cancel</i></button>
                      </span>
                      <div></div>
                      <div class='suggestionClient hidden'>
                         <ul class='suggestionListClient'></ul>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input mdl-textfield__input_border' value=".$value['bill_date']." type='text' id='datepicker".$value['id']."' readonly>
                    </div>
                  </td>
                  <td>
                    <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input mdl-textfield__input_border' value=".escapeshellarg($value['comment'])." type='text' id='' readonly>
                    </div>
                  </td>
                  <td>
                   <div style='width:100%;' class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
                     <select style='color:inherit' disabled id='' class='mdl-selectfield__select input'>
                        <option disabled value='".$value['bill_status']."' selected='selected'>".$this->config->item($value['bill_status'],'bill_status')."</option>
                        <option value='0'>Un-Paid</option>
                        <option value='1'>Paid</option>
                     </select>
                     <label class='mdl-selectfield__label' for=''></label>
                   </div>                    
                  </td>
                  <td> 
                    <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_edit 'data-id=".$value['id']."><i class='material-icons'>edit</i></a>
                    <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_update' data-id=".$value['id']." ><i class='material-icons save_btn'>check_circle</i></a>  
                    <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a>  
                  </td>
                  <td class='hidden'>
                    <span>".$value['bill_no']."</span>
                    <span>".$value['vendor_name']."</span>
                    <span>".$value['bill_date']."</span>
                    <span>".$this->config->item($value['bill_status'],'bill_status')."</span>
                  </td>
                </tr>";
                endforeach;
                ?>
              </tbody>  
            </table>
          </div>
        </div>
      </div>
  </div>
<!--Demo Tbody For Bills-->
<table hidden="">
<th></th><th></th><th></th><th></th><th></th>
<tbody class='tBodySearch' hidden="">
  <tr class="bill-item hidden" onmouseover='mOver(this)' onmouseout='mOut(this)'>
    <td class="count">
      <div class='vendor_bill_log mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'>
        <i class='material-icons' style='color:#fff'>add</i>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border pull_center" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border pull_center" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div style='width:75%' class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
        <select disabled style='color:inherit' id='' class='mdl-selectfield__select input'>
          <option value='' disabled></option>
          <option value='0'>Un-Paid</option>
          <option value='1'>Paid</option>
        </select>
        <label class='mdl-selectfield__label' for=''></label>
      </div>                    
    </td>    
    <td> 
      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_edit '><i class='material-icons'>edit</i></a>
      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_update'><i class='material-icons save_btn'>check_circle</i></a>  
      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a>  
    </td>
  </tr>
  </tbody>
  </table>
<!--End Demo Tbody for Bills-->

<!--Demo Tbody For Item-Bills-->
<table hidden="">
<th></th><th>Item</th><th>Rate</th><th>Quantity</th><th>APMC Tax</th><th>Levi Tax</th><th>Actions</th>
<tbody class='' hidden="">
  <tr class="bill_item hidden ">
    <td></td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td>
      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
      </div>
    </td>
    <td> 
<!--       <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_edit '><i class='material-icons'>edit</i></a>
      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored bill_update'><i class='material-icons save_btn'>check_circle</i></a> -->  
      <a class='rate_cancel mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored' id="bill_delete"><i class='material-icons cancel_btn'>delete</i></a>  
    </td>
  </tr>
  </tbody>
  </table>
  
<!--End Demo Tbody for Item-Bills-->
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more print_hide">
    Show More
  </button>
 </section>
 <section class="mdl-layout__tab-panel" id="scroll-tab-2">
  <div class="page-content">
    <div class="mdl-grid bills_today">
      <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_bills_today hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> No Vendor Bills Found for Today !</h3></p>
          </div>
        <!-- No Data messages -->
    </div>
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_bills_today print_hide hidden">
        Show More
      </button>
  </div>
 </section>
 <section class="mdl-layout__tab-panel" id="scroll-tab-3">
   <div class="page-content">
    <div class="mdl-grid bills_history">
    <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_bills_history hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> No Vendor Bills Found!</h3></p>
          </div>
        <!-- No Data messages -->
    </div>

      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_bills_history print_hide hidden">
         Show More
      </button>
  </div>
 </section>
 <!-- Dynamic search div -->
   <div class="dynamic_search hidden">
     <div class="mdl-grid">
       <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone">
         <h4>SEARCH RESULTS</h4>
       </div>
       <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone">
         <h4>
            <button class="mdl-button mdl-js-button mdl-button--icon" id="dynamic_div_close"><i class="material-icons">clear</i></button>
          </h4>
        </div>
      </div>
      <div class="mdl-grid searchResultCards"></div>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--1-col-phone">
        <div class="mdl-card-event_add_jit addJitScreen mdl-card mdl-shadow--2dp search_table">
          <table class="mdl-data-table table_jit mdl-js-data-table vendorBillTableInfo">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th class="pull_center">Bill Number</th>
                <th class="pull_center">Bill Amount</th>
                <th>Vendor</th>
                <th>Bill Date</th>
                <th>Comments</th>
                <th>Bill Status</th>
                <th>Actions</th>
                <th class='hidden'></th>
              </tr>
            </thead>
            <tbody class="searchResultTable">
            </tbody>
          </table>
        </div>
      </div>
    </div> 
</main>  

<!-- Demo Card For Clone -->
<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone demoCardBills  regvencards hidden">
  <div class="demo-card-event mdl-card mdl-shadow--2dp"  style="height: 105px; min-height: 160px;">
    <div class="mdl-card__title mdl-card--expand" style=" padding: 4px 8px;"><h4 class="bill_no"></h4></div>
    <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px;"><p class="bill_date"></p></div>
    <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px;"><p class="bill_vendor"></p></div>
    <div class="mdl-card__actions mdl-card--border" style=" height: 55px;">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon bill_info" id="" href="#" target="_blank">
        <i class="icon material-icons ">info_outline</i> 
        <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
      </a>
    </div>
  </div>
</div>
<!-- Demo Card For Clone -->

<!--Empty Modal for dispatch-Memo-->
<dialog id="dialog" class="mdl-dialog print_width" style="width: 90%;height: auto;top:0;-webkit-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 299px 3333px rgba(0,0,0,0.75);">
<!--     <button type="button" style="margin: 10px 0px 0px 25px;" onclick="window.print()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent print_hide">
    <i class="material-icons">print</i> Print
    </button> -->
  <div class="mdl-dialog__actions" style="float: right;">
    <button type="button" id="dialog-close" style="background-color: #ea4335;color: #ffffff;" class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect print_hide">
    <i class="material-icons">clear</i>
    </button>
  </div>
  <div class="mdl-dialog__content">
  <div class="" style="display: inline-flex;">
    &emsp;<span class="for_bill_no"></span>
    &emsp;<span class="for_bill_tot"></span>
    &emsp;<span class="for_bill_itot"></span>
    &emsp;<span class="for_bill_ftot"></span>
  </div>
    <table class="mdl-data-table_jit_head mdl-js-data-table vendorBillTable">
      <tbody class="bill_log_tbody">
        <tr class="bill_log_row">
          <td>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input input_search" type="text" id="bill_item_id" placeholder="" >
               <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                  <span class="mdl-chip__text"></span>
                  <button type="button" class="mdl-chip__action">
                  <i class="material-icons">cancel</i></button>
                </span>
              <label class="mdl-textfield__label" for="bill_item_id">Item</label>
              <div class="suggestionClient hidden">
                 <ul class="suggestionListClient"></ul>
              </div>
            </div>   
          </td>
          <td>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="number" id="bill_rate" placeholder="" >
              <label class="mdl-textfield__label" for="bill_rate">Rate</label>
            </div>   
          </td>
          <td>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="number" id="bill_qty" placeholder="" >
              <label class="mdl-textfield__label" for="bill_qty">Quantity</label>
            </div>   
          </td>
          <td>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="number" id="bill_apmc_tax" placeholder="" >
              <label class="mdl-textfield__label" for="bill_apmc_tax">APMC Tax</label>
            </div>   
          </td>
          <td>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="number" id="bill_levi_tax" placeholder="" >
              <label class="mdl-textfield__label" for="bill_levi_tax">Levi Tax</label>
            </div>   
          </td>
          <td>
            <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
            <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="add_bill_log" >
              <i class="material-icons" id="billSaveIcon">done</i>
            </button>
            <div class="mdl-tooltip mdl-tooltip--top" for="billSaveIcon" style="background: rgba(0, 0, 0, 0.74902);width: 30px !important">Save</div>
          </td>
        </tr>
      </tbody>
    </table>   
  </div>
  <div>
    <table class="mdl-data-table table_jit mdl-js-data-table">
    <thead><th></th><th>Item</th><th>Rate</th><th>Quantity</th><th>APMC Tax</th><th>Levi Tax</th><th>Actions</th></thead>
      <tbody class="bill_iTbody"></tbody>
      <tfoot class="bill_iTfoot">
        <tr><td colspan="4" style="text-align: left;">Total</td><td class="bill_iTotal">0</td></tr>
      </tfoot>
    </table>
  </div>
</dialog>
<script src="<?php echo base_url().'assets/js/vendor.js';?>"></script>
<script>
  function mOver(obj) {
    $(obj).children().eq(0).removeClass('count');
    $(obj).find('div.vendor_bill_log').stop().animate({left: '20px', opacity: '1'}, "fast");
  }
  function mOut(obj) {
    $(obj).children().eq(0).addClass('count');
    $(obj).find('div.vendor_bill_log').stop().animate({left: '-75px', opacity: '0.4'}, "fast");
  }
</script>