<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Vehicle</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="team_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="vehicle_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="vehicle_info_search"></label>
      </div>
    </div> 
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__clientInfo">
          
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>
          <form action="#" id="vehicleForm">
           <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " style="min-width: 20px;right:5%;float:right;position:fixed">Save</button>
          
          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="vehicle_noIcon">format_list_numbered</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_noIcon">Registration No.</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="reg_no" tabindex="1">
                  <label class="mdl-textfield__label" for="reg_no">Registration No.</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="vehicle_ownerIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_ownerIcon">Owner Name</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="owner_name" tabindex="2">
                  <label class="mdl-textfield__label" for="owner_name">Owner Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="vehicle_licenseIcon">person_pin</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_licenseIcon">Licence No.</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="licence_no" tabindex="3">
                  <label class="mdl-textfield__label" for="licence_no">Licence No.</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="vehicle_contactIcon">phone</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_contactIcon">Contact No.</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="number"  id="contact" tabindex="4">
                  <label class="mdl-textfield__label" for="contact">Contact No.</label>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="vehicle_brandIcon">local_offer</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_brandIcon">Vehicle Brand</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="vehicle_brand" tabindex="5">
                  <label class="mdl-textfield__label" for="vehicle_brand">Vehicle Brand</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="vehicle_modelIcon">whatshot</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_modelIcon">Vehicle Model</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="vehicle_model" tabindex="6">
                  <label class="mdl-textfield__label" for="vehicle_model">Vehicle Model</label>
                </div>
              </div>
            </div>

          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="<?php echo base_url().'assets/js/vehicle.js';?>"></script>
