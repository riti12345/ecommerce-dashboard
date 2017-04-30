<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Vendors</span>
    <div class="mdl-layout-spacer">
      <!-- <a href="addVendor" class="mdl-button mdl-js-button  mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style=" margin-left:15px;    padding: 0px 12px;">Add Vendor</a> -->
    </div>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="searchVendor">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="searchVendor" autocomplete="off" autofocus="" placeholder="Search..">
        <label class="mdl-textfield__label" for="searchVendor"></label>
      </div>
    </div>
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Registered </a>
    <a href="#scroll-tab-2" class="mdl-layout__tab ">On-Spot</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100" ng-controller="vendorCtrl">
<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
      <div class="mdl-grid vendor">
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--1-col-phone  noMarTop noMarBottom"> 
          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
            <select required="" id="search_vendor_category" class="mdl-selectfield__select" >
                <option selected="selected" value="0">All</option>
                <option value="1">Vegetables</option>
                <option value="2">English Vegetables</option>
                <option value="3">Fruits</option>
            </select>
            <label class="mdl-selectfield__label" for="vendor_category">Speciality: Category</label>
          </div>  
        </div>
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone  noMarTop noMarBottom">  
          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select required="" id="search_vendor_sub_category" class="mdl-selectfield__select">
                <option selected="selected" value="0">All</option>
                    <option value="1">Domestic</option>
                    <option value="2">Leafy</option>
                    <option value="3">OTP</option>
                    <option value="4">Herbs</option>
                    <option value="5">Lettuces</option>
                    <option value="6">Sprouts</option>
                    <option value="7">Greens</option>
                    <option value="8">Continental</option>
                    <option value="9">Chinese &amp; Thai </option>
                    <option value="10">Mint</option>
                    <option value="11">Microgreens</option>
                    <option value="12">Cheery Tomatoes</option>
                    <option value="13">Regular</option>  
                    <option value="14">Local</option>  
                    <option value="15">Imported</option>   
              </select>
              <label class="mdl-selectfield__label" for="vendor_sub_category">Speciality: Sub-Category</label>
          </div>
        </div> 
          <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--6-col-phone ">  
            <div class="header_icon pull-right" id="view_item_list">
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

          <!-- grid view -->
          <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--6-col-phone regvencards demoCardEmpty animate fadeInUp" ng-repeat="vendor in manageVendors.data.vendors">
            <div class="demo-card-event mdl-card mdl-shadow--2dp" style="height: 105px; min-height: 160px;">
              <div class="mdl-card__title mdl-card--expand" style="  padding: 4px 8px; ">
                <h4 class="vendorName" style="padding: 0px 8px 0px 5px;">{{vendor.name}}</h4></div><!--Vendor Name-->
              <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px; ">
                <i class="icon material-icons vendorIcon">phone</i>
                <p class="vendorPhone">{{vendor.phone}}</p>
              </div><!--Vendor Phone No.-->
              <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px 9px 7px;">
                <i class="icon material-icons vendorIcon">whatshot</i>
                <p class="vendorItemName">{{vendor.speciality.item_name}}</p><!--Speciality-->
              </div>
              <div class="mdl-card__actions mdl-card--border" style=" height: 57px;padding:5px 6px;">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="#" target="_blank">
                  <i class="icon material-icons ">info_outline</i> 
                  <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                </a>
                 <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="vendorHistory" style="float:right;" target="_blank">
                  <i class="material-icons">history</i>
                  <div class="mdl-tooltip mdl-tooltip--left" for="" >History</div>
                </a>
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" style="float:right;" href="#" target="_blank">
                  <i class="material-icons">view_list</i>
                  <div class="mdl-tooltip mdl-tooltip--left" for="" >Rate List </div>
                </a>
              </div>
              <div style="position: absolute;right: 16px;top :7px;cursor: pointer;" >
                <span>
                  <i class="material-icons" id="" style="font-size: 17px;">visibility</i>
                  <div class="mdl-tooltip mdl-tooltip--left" for="">Active </div>
                </span>
              </div>
            </div>
          </div>

          <!--list view -->
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone  hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table  mdl-shadow--4dp vendorTableEmpty animate fadeIn">
            <thead>
              <tr>
                <th></th>
                <th>Vendor Name</th>
                <th>Company Name</th>
                <th>Speciality</th>
                <th>City</th>
                <th>Phone No.</th>
              </tr>
            </thead>
            <tbody class ="vendorTbody">
              <tr class="vendorTrowEmpty hidden">
                <td>
                  <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="#" style="height: 30px;">
                    <i class="icon material-icons" style=" font-size: 18px;">info_outline</i> 
                      <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                  </a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
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
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more">
      Show More
    </button>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
      <div class="mdl-grid onspotVendor">
          <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">  
            <div class="header_icon pull-right" id="view_item_list">
              <span class="list_view2 mdl-button mdl-js-button mdl-button--icon" value="list_view">
                <i class="material-icons" id="goff">view_list</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="goff" >List View</div>
              </span>
              <span  class="grid_view2 mdl-button mdl-js-button mdl-button--icon  hidden " value="grid_view">
                <i class="material-icons " id="gon">grid_on</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="gon" >Grid View</div>
              </span>
            </div>
          </div>

        <div class="mdl-cell mdl-cell--12-col hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table  mdl-shadow--4dp vendorTableEmpty2 animate fadeIn">
            <thead>
              <tr>
                <th class=""></th>
                <th>Vendor Name</th>
                <th>ID</th>
                <th>Phone No.</th>
                <th>Address</th>
              </tr>
            </thead>
            <tbody class ="vendorTbody2">
              <tr class="vendorTrowEmpty2 hidden">
                <td>
                  <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="#" style="height: 30px;">
                    <i class="icon material-icons" style=" font-size: 18px;">info_outline</i> 
                      <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                  </a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone demoCardEmptyOnspot hidden">
          <div class="demo-card-event mdl-card mdl-shadow--2dp"  style="height: 105px; min-height: 160px;">
            <div class="mdl-card__title mdl-card--expand" style=" padding: 4px 8px;"><h4 class="vendorName"></h4></div>
            <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px;"><p class="vendorPhone"></p></div>
             <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px;">
              <p class="vendorItemName"></p>
             </div>
             <div class="mdl-card__actions mdl-card--border" style=" height: 55px;">
                <a href="#" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="info_tool2" style="float:right;">
                <i class="material-icons">history</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="info_tool2" >History</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </section>
</main>

<script type="text/javascript" src="<?php echo base_url().'assets/js/vendor.js';?>"></script>
<script type="text/javascript">var allOnspotVendors = <?php echo get_all_onspotVendors(); ?></script>
  
