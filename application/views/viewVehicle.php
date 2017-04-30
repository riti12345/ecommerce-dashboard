<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Vehicles</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="vehicle_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="vehicle_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="vehicle_info_search"></label>
      </div>
    </div> 
  </div>
</header>

<main class="dispatch mdl-layout__content mdl-color--grey-100">
  <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
    <div class="page-content">
      <div class="mdl-grid vehicle">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone regteamcards demoCardEmpty hidden">
          <div class="vehicle-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand" style="padding: 2px 7px 0px 7px;"><h4 class="owner_name"></h4>
            </div>
            <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
              <i class="icon material-icons">local_offer</i>
              <p class="vehicle_model"></p>
            </div>
            <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
              <i class="icon material-icons">whatshot</i>
              <p class="vehicle_model"></p>
            </div>
            <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
              <i class="icon material-icons">phone</i>
              <p class="contact_no"></p>
            </div>
              
            <div class="mdl-card__actions mdl-card--border" >
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="infoTool" href="" target="_blank">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="infoTool" >Info </div>
              </a>

              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="track_history" href="trackVehicleHistory" target="_blank" style="float:right;">
                <i class="material-icons">history</i>
                <div class="mdl-tooltip mdl-tooltip--right" for="track_history" >Track</div>
              </a>

              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="track" href="trackVehicle" target="_blank" style="float:right;">
                <i class="material-icons">local_shipping</i>
                <div class="mdl-tooltip mdl-tooltip--right" for="track" >Track</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Dynamic search div -->
    <div class="dynamic_search hidden">
      <h3><span class="heading">SEARCH RESULTS </span><span><a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="dynamic_div_close"><i class="material-icons">clear</i></a><span></h3>

      <div class="mdl-grid searchResult">
    
      </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more">
      Show More
    </button>
</main>

<script src="<?php echo base_url().'assets/js/vehicle.js';?>"></script>
<script>
var allVehicles = <?php echo get_all_transport(); ?>
</script>