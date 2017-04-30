<?php
  $team_id = get_session_data()['user']['id'];
  // if(isset($_GET["tid"])){ $team_id = $_GET["tid"];}
  // get_items_for_procure();
  // echo print_array($team_id);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Procurement</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="add_procure_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="add_procure_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="add_procure_search"></label>
      </div>
    </div>
    
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab mdl-layout__tab_3  is-active">Procure</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab_3 tab_1 tab_switch">Upcoming</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab_3 tab_2 tab_switch">History</a>
    <a href="#scroll-tab-4" class="mdl-layout__tab mdl-layout__tab_4 tab_3 tab_switch">RTV</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">

    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone">
       <div class="mdl-breadcrum">
        <div class="breadcrumb flat">
         <a href="#" class="active">Select Market</a>
         <a href="#">Add Items</a>
         <a href="#">Procure</a>
         <a href="#">Confirm Procure</a>
        </div>
       </div> 
      </div>
      <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone">
        <a style="right:5%;position:absolute;" href="procurement_template/download" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                Download template
        </a>
      </div>
    </div>

      <div class="mdl-grid ">
        <div class="mdl-cell mdl-cell--12-col-desktop  mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
             <!-- select market screen -->
            <div class="mdl-card-event_add_order mdl-shadow--2dp marketScreen">
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet  mdl-cell--5-col-phone mdl-typography--text-center"> 
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input input_search addMarket" type="text" id="searchProcureMarkets" autocomplete ="off" placeholder="" tabindex="1">
                        <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                          <span class="mdl-chip__text"></span>
                          <button type="button" class="mdl-chip__action">
                          <i class="material-icons">cancel</i></button>
                        </span>
                      <label class="mdl-textfield__label mdl-textfield__label"  for="searchProcureMarkets">Select Market</label>
                      <div class="suggestionClient hidden" >
                         <ul class="suggestionListClient"></ul>
                      </div>
                    </div>
                    <br>
                    <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label proc_select" style="color:#fff" >
                     <select id="proc_Slot" class="mdl-selectfield__select " tabindex="2">
                       <option value="0" >00 hrs - 03 hrs</option>
                       <option value="1" >03 hrs - 06 hrs</option>
                       <option value="2" >06 hrs - 09 hrs</option>
                       <option value="3" >09 hrs - 12 hrs</option>
                       <option value="4" >12 hrs - 15 hrs</option>
                       <option value="5" >15 hrs - 18 hrs</option>
                       <option value="6" >18 hrs - 21 hrs</option>
                       <option value="7" >21 hrs - 24 hrs</option>
                     </select>
                     <label class="mdl-selectfield__label" for="proc_Slot" style="font-size:14px;">Procurment Slot</label>
                    </div>
                    <br>  
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input validate_date" type="text" id="datepicker" placeholder="" / tabindex="3">
                      <input class="mdl-textfield__input validate_date hidden" type="text" id="to" placeholder="" />
                      <label class="mdl-textfield__label mdl-textfield__label" for="datepicker">Procurement date</label>
                    </div>
                    <input type='number' id='team_id' disabled value='<?php echo $team_id; ?>' data-id='<?= $team_id; ?>' hidden>
                    <br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input validate_date" type="number" id="start_balance" placeholder="" / tabindex="4">
                      <label class="mdl-textfield__label mdl-textfield__label" for="start_balance">Start Balance</label>
                    </div>
                </div>
                <div class="mdl-cell  mdl-cell--3-col-desktop mdl-cell--3-col-tablet  mdl-cell--3-col-phone mdl-typography--text-center">
                    <button  style="margin-right:83%;"type="button" id="add_market" class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored add_market"><i class="material-icons">add</i><span class="mdl-tooltip" for="add_market">Add Market</span></button>
                </div>
                <div class="mdl-cell  mdl-cell--4-col-desktop mdl-cell--4-col-tablet  mdl-cell--4-col-phone mdl-typography--text-center">
                  <div class="manualProcure">
                    <button class="mdl-button mdl_button_manual mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent proc_next" style="margin-top: 0px;" tabindex="4">NEXT</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- manual procure screen Add  -->
              <div class="card-details selectItemScreen mdl-shadow--2dp hidden">
                <table class="mdl-data-table_procure_head mdl-js-data-table">
                  <a class="mdl-button mdl-js-button mdl-button--icon btn-back-manual btn_icon_shadow" style=" min-width: 20px;" tabindex="5">
                    <i class="material-icons">arrow_back</i>
                  </a>
                  <tbody>
                    <tr class="proc_add_row">
                      <td style="width:1%;"></td>
                      <td style="width:10%;">
                        <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label">
                          <input class="mdl-textfield__input input_search" type="text" id="selectProcItem" placeholder="" autocomplete="off" tabindex="6">
                            <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                              <span class="mdl-chip__text"></span>
                              <button type="button" class="mdl-chip__action">
                              <i class="material-icons">cancel</i></button>
                            </span>
                          <label class="mdl-textfield__label" for="selectProcItem">Select Items</label>
                          <div class="suggestionClient hidden">
                             <ul class="suggestionListClient "></ul>
                          </div>
                        </div>   
                      </td>
                      <td style="width:10%;">
                        <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                            <input class="mdl-textfield__input input_search" type="text" id="searchVendors" placeholder="" autocomplete="off" tabindex="7">
                            <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                              <span class="mdl-chip__text"></span>
                              <button type="button" class="mdl-chip__action">
                              <i class="material-icons">cancel</i></button>
                            </span>
                            <label for="sample1" class="mdl-textfield__label" for="searchVendors">Select Vendor</label>
                            <div class="suggestionClient hidden">
                             <ul class="suggestionListClient "></ul>
                          </div>
                        </div>
                      </td>
                      <td style="width:10%;">
                        <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label">
                          <input class="mdl-textfield__input validate_number" type="number" id="p_quantity" placeholder="" tabindex="8">
                          <label class="mdl-textfield__label" for="p_quantity">Units</label>
                        </div>
                      </td>
                      <td style="width:10%;">
                          <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input validate_number" type="number" id="p_target_price" placeholder="" tabindex="9">
                            <label class="mdl-textfield__label" for="p_target_price">Target Price</label>
                          </div>
                      </td>
                      <td style="width:10%;">
                        <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="appendItems" tabindex="10">
                          <i class="material-icons">done</i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="fixed-action-btn">
                  <input type="file" id="procure_list" style="display:none">
                  <label for="procure_list" id="procurelistlabel" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
                    <i class="material-icons">attach_file</i>
                    <div class="mdl-tooltip mdl-tooltip--top" for="procurelistlabel" >Choose File</div>
                  </label>
                  <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-id="" id="procure_listUpload" href="#">
                    <i class="material-icons">file_upload</i>
                    <div class="mdl-tooltip mdl-tooltip--top" for="procure_listUpload" >Upload</div>
                  </a>
                </div>
              </div>

              <div class="mdl-card-event_add_procure mdl-card addProcureScreen mdl-shadow--2dp hidden">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp mdl-data-table_procure_head">
                  <thead>
                    <tr>
                      <th>
                          <div class="squaredOne" id="check_vendor">
                            <input type="checkbox" value="None" id="check_all" class="check_me" name="check">
                            <label for="check_all"></label>
                          </div>
                          <div class="mdl-tooltip mdl-tooltip--top" for="check_vendor">Select All</div>
                        </th>
                      <th>Sr. No.</th>
                      <th>Items</th>
                      <th>
                        <span class="vendor_hide">Vendors</span>
                        <span class="vendor_span hidden"><div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield getmdl-select vendor_search" style="padding:0">
                            <input class="mdl-textfield__input input_search check_vendor_search" type="text" id="searchVendors" placeholder="Search Vendor" autocomplete="off" tabindex="7">
                            <span style="margin:0" class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                              <span class="mdl-chip__text"></span>
                              <button type="button" class="mdl-chip__action">
                              <i class="material-icons">cancel</i></button>
                            </span>
                            <label for="sample1" class="mdl-textfield__label" for="searchVendors"></label>
                            <div class="suggestionClient hidden">
                             <ul class="suggestionListClient "></ul>
                          </div>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored procure_update approve_vendor" id="app_v">
                           <i class="material-icons">done</i>
                        </button>
                        <div class="mdl-tooltip mdl-tooltip--top" for="app_v">Approve this vendor <br> for selected rows</div>

                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored procure_delete disapprove_vendor" id="dispp_v">
                           <i class="material-icons">cancel</i>
                        </button>
                        <div class="mdl-tooltip mdl-tooltip--top" for="dispp_v">Remove this vendor <br> from selected rows</div>
                        </span>
                      </th>
                      <th>Units</th>
                      <th>Target Price<a></th>
                      <th>Action 
                        <button style="float:right;" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored procure_delete bulk_procure_delete">
                          <i class="material-icons">delete</i>
                        </button>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="tbody">
                    <tr class="procure-item hidden">
                      <td>
                          <div class="squaredOne">
                            <input type="checkbox" value="None" id="squaredOne" class="check_me" name="check">
                            <label for="squaredOne"></label>
                          </div>
                      </td>
                      <td class="count"></td>
                      <td>
                        <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label">
                          <input class="mdl-textfield__input input_search mdl-textfield__input_border" type="text" id="" readonly>
                           <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                            <span class="mdl-chip__text"></span>
                            <button type="button" class="mdl-chip__action">
                            <i class="material-icons">cancel</i></button>
                          </span>
                          <label></label>
                          <div class="suggestionClient hidden">
                             <ul class="suggestionListClient"></ul>
                          </div> 
                        </div>
                      </td>
                      <td>
                        <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label">
                          <input class="mdl-textfield__input input_search mdl-textfield__input_border edit_unit sr_vendors" type="text" id="" readonly>
                          <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                            <span class="mdl-chip__text"></span>
                            <button type="button" class="mdl-chip__action">
                            <i class="material-icons">cancel</i></button>
                          </span>
                          <label></label>
                          <div class="suggestionClient hidden">
                             <ul class="suggestionListClient"></ul>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label">
                          <input class="mdl-textfield__input mdl-textfield__input_border edit_unit" type="text" id="" readonly >
                        </div>
                      </td>
                      <td>
                        <div class="mdl-textfield mdl-textfield_procure_info mdl-js-textfield mdl-textfield--floating-label">
                          <input class="mdl-textfield__input mdl-textfield__input_border edit_unit" type="text" id="" readonly >
                        </div>
                      </td>
                      <td> 
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored add-procure-row-edit procure_edit" tabindex="11">
                          <i class="material-icons">create</i>
                        </button>
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored add-procure-row-remove procure_delete" tabindex="11">
                          <i class="material-icons">delete</i>
                        </button>
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored add-procure-row-done procure_udpate hidden" tabindex="11">
                          <i class="material-icons">done</i>
                        </button>
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored add-procure-row-cancel procure_delete hidden" tabindex="11">
                          <i class="material-icons">cancel</i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="mdl-grid">
                  <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent createManualProcure" tabindex="12">Procure</button>
                  </div>
                </div>
              </div>

            <!-- Confirm Procure Screen-->
            <div class="createProcureScreen hidden card-details mdl-shadow--2dp">
              <table class="mdl-data-table mdl-js-data-table mdl-data-table_order">
                <a class="mdl-button mdl-js-button mdl-button--icon btn-back-confirm" style=" min-width: 20px;">
                  <i class="material-icons">arrow_back</i>
                </a>
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th class="mdl-data-table__cell--non-numeric" id="sortItems">Items</th>
                    <th>Vendors</th>
                    <th>Units</th>
                    <th>Target Price<a></th>
                  </tr>
                </thead>
                <tbody class="pre_procure_body">
                  <tr class="pre_procure hidden">
                    <td class="count"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
                <tfoot> 
                  <tr class="procure_total" role="row"> 
                    <td rowspan="1" colspan="1"></td>
                    <td rowspan="1" colspan="3">Total</td>
                    <td rowspan="1" colspan="1"></td>
                  </tr> 
                </tfoot>
              </table>
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent confirmManualProcure">Confirm Procure</button>
                  <button style="margin-left:2%;"class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn-back-confirm">Cancel</button>
                </div>
              </div>
            </div>  

          </div>
        </div>

    </div>
  </section>

  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
      <div class="mdl-grid procUpcommingTab">
       

        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_proc hidden">
          <p><i class="material-icons status_icon">error</i></p>
          <p><h3>  Nothing to procure. <br> <br> Take Rest for a while.</h3></p>
          </div>
        <!-- No Data messages --> 
      </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_upcomming hidden">
      Show More
    </button>
  </section>

  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
    <div class="page-content">
        <div class="mdl-grid procHistoryTab">
         
        <!-- No Data messages -->
         <div class="mdl-card-status mdl-shadow--2dp no_proc_hist hidden">
         <p><i class="material-icons status_icon">error</i></p>
         <p><h3> Procurement History Null! </h3></p>
         </div>
        <!-- No Data messages --> 
        </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_hist hidden">
      Show More
    </button>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-4">
    <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
    <div class="page-content">
      <div class="mdl-grid rtvTab">
      </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_hist hidden">
      Show More
    </button>
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
      <div class="mdl-grid searchResult"></div>
    </div>
</main>
<dialog id="add_market_dialog" class="mdl-dialog print_width" style="width:50%;height:300px;-webkit-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 299px 3333px rgba(0,0,0,0.75);">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
      </div>
      <div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet  mdl-cell--9-col-phone">
        <div class="edit_view hidden" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="edit_market" placeholder="">
            <label class="mdl-textfield__label" for="edit_market">Market</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="edit_market_address" placeholder="">
            <label class="mdl-textfield__label" for="edit_market_address">Address</label>
          </div>
        </div>
        <div class="add_view" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text"  id="market_name">
            <label class="mdl-textfield__label" for="market_name">Market</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text"  id="market_address">
            <label class="mdl-textfield__label" for="market_address">Address</label>
          </div>
        </div>
      </div>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone addMarket_dialog_action_btn mdl-dialog__actions">
        <button id="edit_btn" class="edit_view hidden mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        EDIT MARKET
        </button>
        <button id="add_btn" class="add_view mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        ADD MARKET
        </button>
        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="market-dialog-close" style="background-color: #ea4335;color: #ffffff; float:right;">
        CANCEL
        </button>
      </div>
    </div>
</dialog>
<!-- Demo Card For Clone -->

 <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardProchist hidden">
  <div class="procure-cardInfo-event mdl-card mdl-shadow--2dp procure-mdl-card ">
    <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
    <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
    <div class="mdl-card__actions mdl-card--border">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon pull-left" href="#" target="_blank">
        <i class="icon material-icons">info_outline</i> 
        <div class="mdl-tooltip mdl-tooltip--right">Info </div>
      </a>
    </div>
  </div>
 </div>

<!-- Demo Card For Clone -->
       

<script src="<?php echo base_url().'assets/js/procurement.js';?>"></script>
 <script type="text/javascript">
  var estdQty = <?php echo get_items_for_procure(); ?>;
  var allMarkets = <?php echo get_all_markets(); ?>;
</script>