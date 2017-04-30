<?php
  $vendor_id = $this->input->get('id');
  if(isset($vendor_id)) {
    $vendor = get_all_OnspotVendors_history($vendor_id);
    // echo print_array($vendor);die;
    $history = json_decode($vendor,true);
    // echo print_array($history);die;

  }
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Onspot Vendor's History</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="search"></label>
      </div>
    </div>
    
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
    <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
      </button>
      <div class="mdl-grid onSpotVendorHistory">
        <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet  mdl-cell--12-col-phone demoCardEmptyOS hidden">
          <div class="demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand"><h4></h4></div><!--Procure Date-->
            <div class="mdl-card__title mdl-card--expand"><i class="material-icons">&#8377;</i><p></p></div><!--Total Price.-->
             <div class="mdl-card__title mdl-card--expand"><i class="material-icons">shopping_basket</i><p></p></div><!--Total Quantity-->
             <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="it1" href="#" target="_blank">
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
<script type="text/javascript">var allOnspotVendorsHistory = <?= get_all_OnspotVendors_history($vendor_id) ;?> </script>

