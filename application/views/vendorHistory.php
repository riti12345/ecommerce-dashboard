<?php
  $vendor_id = $this->input->get('id');
  if(isset($vendor_id)) {
    $vendor = get_all_vendors_history($vendor_id);
    // echo print_array($vendor);die;
    $history = json_decode($vendor,true);
    // echo print_array($history);die;

  }
?>
<script type="text/javascript">var current_id = <?= $vendor_id ;?></script>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Vendor's History</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="search-vendor-history">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="search-vendor-history" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="search-vendor-history"></label>
      </div>
    </div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--6-col-phone ">  
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--6-col-phone ">  
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--6-col-phone ">  
      <div class="header_icon pull-right" id="view_item_list">
        <span class="list_view1 mdl-button mdl-js-button mdl-button--icon" value="list_view">
          <i class="material-icons" id="goff">view_list</i>
          <div class="mdl-tooltip mdl-tooltip--left" for="goff" >List View</div>
        </span>
        <span  class="grid_view1 mdl-button mdl-js-button mdl-button--icon  hidden " value="grid_view">
          <i class="material-icons " id="gon">grid_on</i>
          <div class="mdl-tooltip mdl-tooltip--left" for="gon" >Grid View</div>
        </span>
      </div>
    </div>
    
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone ">
    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
      <i class="material-icons">arrow_back</i>
    </button>
      <div class=" mdl-grid vendorHistory noPadAll">
      <div class="mdl-cell mdl-cell--12-col hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--4dp vendorTableEmpty1 animate fadeIn">
            <thead>
              <tr>
                <th class="hidden"></th>
                <th>Procure Date</th>
                <th>Total Price</th>
                <th>Total Quantity</th>
                
              </tr>
            </thead>
            <tbody class ="vendorTbody1">
              <tr class="vendorTrowEmpty1 hidden">
                <td>
                  <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="#" style="height: 30px;">
                    <i class="icon material-icons" style=" font-size: 18px;">info_outline</i> 
                      <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                  </a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet  mdl-cell--12-col-phone demoCardEmpty1 hidden">
          <div class="demo-card-event mdl-card mdl-shadow--2dp vendor_hist_card">
            <div class="mdl-card__title mdl-card--expand" >
              <h4 class="vend_hist_date"></h4>
            </div><!--Procure Date-->
            <div class="mdl-card__title mdl-card--expand" style="margin-left: 8px;">
              <i class="material-icons vend_hist_icon">&#8377;</i>
              <p style="padding: 2px 12px 0px;"></p>
            </div><!--Total Price.-->
            <div class="mdl-card__title mdl-card--expand" style="margin-left: 8px;">
              <i class="material-icons vend_hist_icon">shopping_basket</i>
              <p style="padding: 2px 12px 0px;"></p>
            </div><!--Total Quantity-->
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="it1" href="#">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="it1" >Info </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  
  </div>
</main>
<script type="text/javascript" src="<?php echo base_url().'assets/js/vendor.js';?>"></script>
<script type="text/javascript">var allVendorsHistory = <?= get_all_vendors_history($vendor_id) ;?> </script>
  