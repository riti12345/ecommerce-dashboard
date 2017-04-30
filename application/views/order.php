<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600 print_hide">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Order</span>
    <div class="mdl-layout-spacer"></div>
  
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="view_order_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input dynamic_search_input" type="text" id="view_order_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="view_order_search"></label>
      </div>
    </div>
    
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab mdl-layout__tab_2 tab_1 is-active">Today</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab_2 tab_2">History</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab_3 ">Invoice Report</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100 ">
  <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
      <div class="mdl-grid order">
        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone print_hide">
          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label hidden print_view">
            <select class="mdl-selectfield__select export">
              <option selected="selected"></option>
              <option value="print">Print</option>
              <option value="pdf">Export to PDF</option>
              <option value="excel">Export to EXCEL</option>
              <option value="csv">Export to CSV</option>
            </select>
            <label class="mdl-selectfield__label" for="search_client_category">Export Table Data</label>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone print_hide">
          <!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label order_view_icon hidden">
            <input class="mdl-textfield__input date_search_order" type="text" id="datepicker" placeholder="" tabindex="1">
            <label class="mdl-textfield__label mdl-textfield__label_addOrder" for="datepicker">Search By Date</label>
          </div> -->  
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone print_hide">
          <div class="header_icon pull-right order_view_icon" id="view_item_list">
            <span class="list_view mdl-button mdl-js-button mdl-button--icon" value="list_view">
              <i class="material-icons" id="goff">view_list</i>
              <div class="mdl-tooltip mdl-tooltip--left" for="goff" >List View</div>
            </span>
            <span  class="grid_view mdl-button mdl-js-button mdl-button--icon  hidden " value="grid_view">
              <i class="material-icons " id="gon">grid_on</i>
              <div class="mdl-tooltip mdl-tooltip--left" for="gon" >Grid View</div>
            </span>
          </div>
        </div>
        
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet  mdl-cell--4-col-phone orderCardEmpty hidden" id="view_card_search">
          <div class="order-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand name"><h4 class="clientName"></h4></div>
            <div class="mdl-card__title mdl-card--expand orderDate">
              <p class="orderInfoId"></p>
              <span class="hidden"></span>
            </div>
            <div class="mdl-card__title mdl-card--expand orderId ">Order ID : <p class="orderInfoId"></p></div>
            <div class="mdl-card__title mdl-card--expand orderId ">Invoice ID : <p class="orderInfoId"></p></div>
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" 
                href="" target="_blank">
                <i class="icon material-icons info">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
              </a>
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--icon print_dm" id="print" style="float:right;">
                <i class="icon material-icons">print</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="print" >Print Invoice</div>
              </a>
              <button id="info_tool2" class="mdl-button mdl-js-button" disabled  style="float:right;font-size:11px;padding:0 5px;"></button>
            </div>
            <div style="position: absolute;right: 16px;top :18px;cursor: pointer;"class="track" >
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="trackVehicle" target="_blank" style="color: rgb(0, 150, 136);">
                <i class="material-icons">local_shipping</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="" >Track</div>
              </a>
            </div>
          </div>
        </div>

        
        <div class="mdl-cell mdl-cell--12-col hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table mdl-shadow--4dp orderTableEmpty is_list_view  animate fadeIn" id="order_today_table">
              <thead>
                <tr>
                  <th class="print_hide"></th>
                  <th>Order ID</th>
                  <th>Client's Name</th>
                  <th>Poc </th>
                  <th>Poc No.</th>
                  <th>Delivery On</th>
                  <th>Total</th>
                  <th class="hidden"></th>
                </tr>
              </thead>
              <tbody class ="orderTbody" id="view_list_search">
                <tr class="orderTrowEmpty hidden">
                  <td class="print_hide">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="" style="height: 30px;">
                      <i class="icon material-icons" style=" font-size: 18px;">info_outline</i> 
                        <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                    </a>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="hidden"></td>
                </tr>
              </tbody>
          </table>
        </div>
        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_orders hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> No Orders ! <br> <br> Take Rest for a while.</h3></p>
          </div>
        <!-- No Data messages -->
      </div>
    </div>
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_today print_hide hidden">
        Show More
      </button>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
      <div class="mdl-grid history">
          <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone print_hide">
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label hidden print_view">
              <select class="mdl-selectfield__select export">
                <option selected="selected"></option>
                <option value="print">Print</option>
                <option value="pdf">Export to PDF</option>
                <option value="excel">Export to EXCEL</option>
                <option value="csv">Export to CSV</option>
              </select>
              <label class="mdl-selectfield__label" for="search_client_category">Export Table Data</label>
            </div>
          </div>
          <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--4-col-phone print_hide"> 
            <!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label history_view_icon hidden">
              <input class="mdl-textfield__input date_search_order_history" type="text" id="datepicker" placeholder="" tabindex="1">
              <label class="mdl-textfield__label mdl-textfield__label_addOrder" for="datepicker">Search By Date</label>
            </div> --> 
          </div>
          <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone print_hide">  
            <div class="header_icon pull-right history_view_icon" id="view_item_list">
              <span class="list_view mdl-button mdl-js-button mdl-button--icon" value="list_view">
                <i class="material-icons" id="goff">view_list</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="goff" >List View</div>
              </span>
              <span  class="grid_view mdl-button mdl-js-button mdl-button--icon  hidden " value="grid_view">
                <i class="material-icons " id="gon">grid_on</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="gon" >Grid View</div>
              </span>
            </div>
          </div>

          <div class="mdl-cell mdl-cell--12-col hidden">
            <table class="client_list_table mdl-data-table mdl-js-data-table mdl-shadow--4dp orderTableEmpty is_list_view  animate fadeIn table_hist" id="order_hist_table">
                <thead>
                  <tr>
                  <th class="print_hide"></th>
                  <th>Order ID</th>
                  <th>Client's Name</th>
                  <th>Poc </th>
                  <th>Poc No.</th>
                  <th>Delivery On</th>
                  <th>Total</th>
                  <th class="hidden"></th>
                  </tr>
                </thead>
                <tbody class ="orderTbody_history" id="view_list_search">
                </tbody>
            </table>
          </div>
          <!-- No Data messages -->
            <div class="mdl-card-status mdl-shadow--2dp no_history hidden">
              <p><i class="material-icons status_icon">history</i><p>
            <p><h3> No History.<br> <br> Take an order to create some.</h3></p>
            </div>
      <!-- No Data messages -->
    </div>
  </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_hist print_hide">
      Show More
    </button>
  </section>
   <section class="mdl-layout__tab-panel" id="scroll-tab-3">
      <div class="page-content">
        <div class="mdl-grid invoice_report">
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">

          <div class="mdl-grid">
          
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <div class="mdl-card-event mdl-card mdl-shadow--2dp mdl-card-event__InvoiceReport">
              <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                <select required="" id="invoice_type" class="mdl-selectfield__select input">
                  <option selected="selected"></option>
                  <option value="1">Invoice Summary</option>
                  <option value="2">Bulk Invoice</option>
                </select>
                <label class="mdl-selectfield__label" for="invoice_type">Invoice Type</label>
              </div>  
              <div class="mdl-textfield mdl-textfield_addOrder mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input input_search " type="text" id="searchClient" autocomplete="off" placeholder="" tabindex="1">
                <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                  <span class="mdl-chip__text"></span>
                  <button type="button" class="mdl-chip__action"><i class="material-icons">cancel</i></button>
                </span>
                <label class="mdl-textfield__label mdl-textfield__label_addOrder" for="searchClient">Client</label>
                <div class="suggestionClient hidden">
                    <ul class="suggestionListClient" style="width: 98%;"></ul>
                </div>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input validate_date" type="text" id="datepicker1" placeholder="">                           
                <label class="mdl-textfield__label mdl-textfield__label" for="datepicker1">Start Date</label>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input validate_date" type="text" id="datepicker2" placeholder="">                           
                <label class="mdl-textfield__label mdl-textfield__label" for="datepicker2">End Date</label>
              </div>
              <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <button id = "invoice_submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" tabindex="">Submit</button>
              </div>
            </div>
            </div>

          </div>

          </div>
        </div>
      </div>
    </section>
  <!-- Accent-colored raised button with ripple -->
  <!-- Dynamic search div -->
    <div class="dynamic_search hidden">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone">
          <h4>SEARCH RESULTS</h4>
        </div>
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone print_hide">
          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label hidden print_view">
            <select class="mdl-selectfield__select export">
              <option selected="selected"></option>
              <option value="pdf">Export to PDF</option>
              <option value="excel">Export to EXCEL</option>
              <option value="csv">Export to CSV</option>
            </select>
            <label class="mdl-selectfield__label" for="search_client_category">Export Table Data</label>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone">
           <div class="header_icon pull-right order_view_icon" id="view_item_list">
            <span class="list_view mdl-button mdl-js-button mdl-button--icon" value="list_view">
              <i class="material-icons" id="goff">view_list</i>
              <div class="mdl-tooltip mdl-tooltip--left" for="goff" >List View</div>
            </span>
            <span  class="grid_view mdl-button mdl-js-button mdl-button--icon  hidden " value="grid_view">
              <i class="material-icons " id="gon">grid_on</i>
              <div class="mdl-tooltip mdl-tooltip--left" for="gon" >Grid View</div>
            </span>
          </div>
          <h4>
            <button class="mdl-button mdl-js-button mdl-button--icon" id="dynamic_div_close"><i class="material-icons">clear</i></button>
          </h4>
        </div>
      </div>
      <div class="mdl-grid searchResultCard"></div>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone  hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table mdl-shadow--4dp orderTableEmpty is_list_view  animate fadeIn" id="order_search_table">
              <thead>
                <tr>
                  <th class="print_hide"></th>
                  <th>Order ID</th>
                  <th>Client's Name</th>
                  <th>Poc </th>
                  <th>Poc No.</th>
                  <th>Delivery On</th>
                  <th>Total</th>
                  <th class="hidden"></th>
                </tr>
              </thead>
              <tbody class ="searchResultList">
              </tbody>
          </table>
        </div>
    </div>
</main> 
  <!-- <button id="button" class="button mdl-button mdl-js-button mdl-button--raised"></button> -->
  <dialog id="dialog" class="mdl-dialog print_width" style="width: 64%;height: auto;-webkit-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 299px 3333px rgba(0,0,0,0.75);">
      <button type="button" style="margin: 10px 0px 0px 25px;" onclick="window.print()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent print_hide">
      <i class="material-icons">print</i> Print
      </button>
    <div class="mdl-dialog__actions" style="float: right;">
      <button type="button" id="dialog-close" style="background-color: #ea4335;color: #ffffff;" class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect print_hide">
      <i class="material-icons">clear</i>
      </button>
    </div>
    <div class="order_discount print_hide">
      <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
        <select id="discount_type" class="mdl-selectfield__select input">
          <option selected="selected"></option>
          <option value="1">Value (Direct Amt.)</option>
          <option value="2">Percentage (%)</option>
        </select>
        <label class="mdl-selectfield__label" for="discount_type">Select Discount Type</label>
      </div>
      
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="discount_value">
        <label class="mdl-textfield__label" for="discount_value">Enter Discount</label>
      </div>

      <button id="add_discount" class="mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--raised mdl-button--accent mdl-button--colored">
      <i class="material-icons">done</i>
      </button>
      <div class="mdl-tooltip mdl-tooltip--right" for="add_discount">Apply Discount</div>

    </div>
    <div class="mdl-dialog__content invoice_content">
      
    </div>
  </dialog>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPBgP9tjXEewjR6QQAXyOgtfY0tmU-Hs4&?callback=myMap"></script>
  <script src="<?php echo base_url().'assets/js/order.js';?>"></script>
 
 