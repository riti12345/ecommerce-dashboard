<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Line Managers</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="line_manager_search_view">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="line_manager_search_view" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="line_manager_search_view"></label>
      </div>
    </div>
    
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="page-content">
    <div class="mdl-grid line_manager">
      <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone  line_manager_card  hidden">
        <div class="line_manager-card-event mdl-card mdl-shadow--2dp ">
          <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="infoCard" href="#" target="_blank">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
              </a>
            </div>
        </div>
      </div>
    </div>
  </div>  
</main>
<script src="<?php echo base_url().'assets/js/line_manager.js';?>"></script>
