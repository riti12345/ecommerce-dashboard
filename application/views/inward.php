<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Inward</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="view_inward_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="view_inward_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="view_inward_search"></label>
      </div>
    </div>
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab inward_tab_1 is-active inward">Inward</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab inward_tab_2 history">History</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
      <div id="inward-cards" class="mdl-grid client">
        <div class="inventory-card-template hide mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone">
          <div class="inventory-card-event mdl-card mdl-shadow--2dp inward-mdl-card">
            <div class="mdl-card__title mdl-card--expand" style="  padding: 0px 20px; ">
              <h4>ID : </h4></div>
            <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 20px; "><p></p></div>
            <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 20px;color: rgb(79, 79, 79); "><p>Total Items  : </p></div>
            <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 20px;color: rgb(79, 79, 79);"><p>Left Items  : </p></div>
             <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" target="_blank">
                <i class="icon material-icons ">info_outline</i> 
              </a>
                <div class="mdl-tooltip mdl-tooltip--right">Info </div>
              
            </div>
            <div style="position: absolute;right: 16px;top :7px;cursor: pointer;" >
                <span>
                  <p class="material-icons" id="" style="font-size: 17px;"></p>
                </span>
              </div>
          </div>
        </div>
        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_inwards hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> Nothing to Inward ! <br> <br> Take Rest for a while.</h3></p>
          </div>
        <!-- No Data messages -->
      </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more hidden">
      Show More
    </button>
  </section> 
  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
     <div class="mdl-grid" id="history-cards">
      <div class="mdl-cell mdl-cell--12-col hidden animate fadeIn ">
        
      </div>
        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_inwards_hist hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> Nothing History Found!</h3></p>
          </div>
        <!-- No Data messages -->

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
<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
