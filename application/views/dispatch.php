<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600 print_hide">
<div class="mdl-layout__header-row">
  <span class="mdl-layout-title">Dispatch</span>
  <div class="mdl-layout-spacer"></div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="searchDispatch">
      <i class="material-icons">search</i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="search" id="searchDispatch" autofocus autocomplete="off" placeholder="Search..">
      <label class="mdl-textfield__label" for="searchDispatch"></label>
    </div>
  </div>
  
</div>
<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
  <a href="#scroll-tab-1" class="mdl-layout__tab  tab_1 is-active">Processing</a>
  <a href="#scroll-tab-2" class="mdl-layout__tab tab_2">Dispatched</a>
  <a href="#scroll-tab-3" class="mdl-layout__tab tab_3">History</a>
  <a href="#scroll-tab-4" class="mdl-layout__tab tab_4">Reports</a>
</div>

</header>
<main class="dispatch mdl-layout__content mdl-color--grey-100">
  <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>

<!--Processing TAB-->
<section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
  <div class="page-content">
    <div class="mdl-grid dispUpcomming">
        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone print_hide">
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
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone print_hide">  
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone print_hide">  
          <div class="header_icon pull-right upcomming_view" id="view_item_list">
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
          <table class="client_list_table mdl-data-table mdl-js-data-table  mdl-shadow--4dp dispatchTableEmpty is_list_view  animate fadeIn" id="disp_upcom_table">
            <thead>
              <tr>
                <th class="print_hide"></th>
                <th>Order ID</th>
                <th>Client's Name</th>
                <th>Ordered On </th>
                <th>Track ID </th>
                <th>Assigned to</th>
                <th>Phone</th>
              </tr>
            </thead>
            <tbody class ="dispatch_upTbody" id="view_list_search">
              <tr class="dispatchTrowEmpty hidden">
                <td class="print_hide">
                  <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="" style="height: 30px;" target="_blank">
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
               </tr>
            </tbody>
          </table>
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet  mdl-cell--6-col-phone demoCardUpcomming hidden" id="view_card_search">
          <div class="dispatch-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand" style="padding: 20px 8px 10px;">
              <h4 style="padding: 0px 8px 0px "></h4>
            </div>
            <div class="mdl-card__title mdl-card--expand" >
              <p  class="show_assignee_name" style="padding: 0px 9px 0px;margin:0px;color: rgb(79, 79, 79);"></p>
            </div>
            <div class="mdl-card__title mdl-card--expand">
              <p class="clientAddress" style="margin: 0px 0px 0px 9px;color: rgb(79, 79, 79);" ></p>
            </div> 
            <!--assignee name -->
            <div class="" style="padding : 0px 15px 8px;">
              <p style="padding: 0px 2px 0px;margin: 0px 0px 9px 0px;"><span></span></p>
              <h5 style="padding: 0px 2px 0px;">Order ID: <span></span>&emsp;Track ID: <span></span></h5>
            </div>
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="dispatchInfo" target="_blank">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
              </a>
              <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--icon print_dm" id="" style="float:right;">
                <i class="icon material-icons">print</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="" >Print Delivery Memo</div>
              </button>
              <button class="mdl-button mdl-js-button" disabled id="info_tool2" style="float:right;font-size: 11px;"></button>
            </div>
          </div>
        </div>
              <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp disp_null hidden">
            <p><i class="material-icons status_icon">error</i><p>
            <p><h3> Nothing to Dispatch ! <br> <br> Take Rest for a while.</h3></p>
          </div>
        <!-- No Data messages -->
    </div>
  </div>
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_upcomming print_hide hidden">
    Show More
  </button>
</section>

<!--Dispatched TAB-->
<section class="mdl-layout__tab-panel" id="scroll-tab-2">
  <div class="page-content">
    <div class="mdl-grid dispDispatched">
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
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone print_hide">  
          <div class="header_icon pull-right dispDispatched_view" id="view_item_list">
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

      <!-- No Data messages -->
        <div class="mdl-card-status mdl-shadow--2dp disp_disp_none hidden">
        <p><i class="material-icons status_icon_done">done_all</i><p>
        <p><h3> Hurray !!  <br> <br> Dispatch completed !</h3></p>
        </div>
      <!-- No Data messages -->

     <div class="mdl-cell mdl-cell--12-col hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table  mdl-shadow--4dp dispatchTableEmpty is_list_view  animate fadeIn" id="disp_dispatched_table">
              <thead>
                <tr>
                  <th class='print_hide'></th>
                  <th>Order ID</th>
                  <th>Client's Name</th>
                  <th>Ordered On </th>
                  <th>Track ID </th>
                  <th>Assigned to</th>
                  <th>Phone</th>
                </tr>
              </thead>
              <tbody class ="dispatchedTbody" id="view_list_search">
                
              </tbody>
          </table>
        </div>
    </div>
  </div>
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_dispatched print_hide hidden">
    Show More
  </button>
</section>

<!--HISTORY TAB-->
<section class="mdl-layout__tab-panel" id="scroll-tab-3">
  <div class="page-content">
    <div class="mdl-grid dispHistory">
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
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone print_hide">  
          <div class="header_icon pull-right dispHistory_view" id="view_item_list">
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

        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp disp_hist_none hidden">
          <p><i class="material-icons status_icon">history</i><p>
          <p><h3> Dispatch history none !!  <br> <br> Dispatch an order to create some.</h3></p>
          </div>
        <!-- No Data messages -->

      <div class="mdl-cell mdl-cell--12-col hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table  mdl-shadow--4dp dispatchTableEmpty is_list_view  animate fadeIn" id="disp_hist_table">
              <thead>
                <tr>
                  <th class='print_hide'></th>
                  <th>Order ID</th>
                  <th>Client's Name</th>
                  <th>Ordered On </th>
                  <th>Track ID </th>
                  <th>Assigned to</th>
                  <th>Phone</th>
                </tr>
              </thead>
              <tbody class ="dispatch_histTbody" id="view_list_search">
               
              </tbody>
          </table>
        </div>
    
    </div>
  </div>
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_hist print_hide">
    Show More
  </button>
</section>
<section class="mdl-layout__tab-panel" id="scroll-tab-4">
  <div class="page-content">
    <div class="mdl-grid dispatch_report">
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
       <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
          <div class="mdl-card-event mdl-card mdl-shadow--2dp mdl-card-event__DispatchReport">
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select required="" id="dm_type" class="mdl-selectfield__select input">
                <option selected="selected"></option>
                <option value="1">Dispatch Summary</option>
                <option value="2">Bulk DM</option>
              </select>
              <label class="mdl-selectfield__label" for="dm_type">DM Type</label>
            </div>  
            <div class="mdl-textfield mdl-textfield_addOrder mdl-js-textfield mdl-textfield--floating-label client">
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
            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label client_type">
              <select required="" id="client_type" class="mdl-selectfield__select input">
                <option selected="selected"></option>
                <option value="retailer">Retailer</option>
                <option value="others">Others</option>
              </select>
              <label class="mdl-selectfield__label" for="client_type">Client Type</label>
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
              <button id = "dm_submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" tabindex="">Submit</button>
            </div>
          </div>
        </div>
        
      </div>

     </div>
    </div>
  </div>
</section>
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
          <div class="header_icon pull-right dispDispatched_view" id="view_item_list">
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
      <div class="mdl-cell mdl-cell--12-col hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table  mdl-shadow--4dp dispatchTableEmpty is_list_view  animate fadeIn" id="disp_search_table">
            <thead>
              <tr>
                <th class="print_hide"></th>
                <th>Order ID</th>
                <th>Client's Name</th>
                <th>Ordered On </th>
                <th>Track ID </th>
                <th>Assigned to</th>
                <th>Phone</th>
              </tr>
            </thead>
            <tbody class ="searchResultList">
            </tbody>
          </table>
        </div>
    </div>
</main>

<!--Empty Modal for dispatch-Memo-->
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
  <div class="mdl-dialog__content dispatch_content">
   
  </div>
</dialog>

<script type="text/javascript" src="<?php echo base_url().'assets/js/dispatch.js';?>"></script>
