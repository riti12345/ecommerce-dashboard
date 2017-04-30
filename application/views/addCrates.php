<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Crate</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__crateInfo">
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>

          <form action="#" id="crateForm">
         
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="min-width: 20px;right:2%;float:right;">Save</button>

          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="cradeIcon">filter_1</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="cradeIcon">Crate Code</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input required=""  class="mdl-textfield__input" type="text" id="crate_code" tabindex="1">
                  <label class="mdl-textfield__label" for="crate_code">Crade Code</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="cratetypeIcon">format_list_numbered</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="cratetypeIcon" >Crate Type</div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                  <select required="" id="crate_type" class="mdl-selectfield__select input">
                    <option selected="selected"></option>
                    <option value="1">Inward</option>
                    <option value="2">Dispatch</option>
                  </select>
                  <label class="mdl-selectfield__label" for="crate_type">Crate Type</label>
                </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            </div>
            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            </div>

          </div>

          </form>
        
        </div>
      </div>
    </div>
  </div>
</main>   

<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>    
    