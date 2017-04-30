<?php
  if(isset($_GET["tid"])){ $team_id = $_GET["tid"];}
  // get_items_for_procure();
  // echo print_array($team_id);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Procurement Info</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="add_procure_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="add_procure_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="add_procure_search"></label>
      </div>
    </div>
    
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab_3  is-active tab_1 tab_switch">Upcoming</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab_3 tab_2 tab_switch">History</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100" id="team_id" data-id='<?= $team_id; ?>'>
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-2">
    <div class="page-content">
      <div class="mdl-grid procUpcommingTab">
       

        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_proc hidden">
          <p><i class="material-icons status_icon">error</i></p>
          <p><h3>  Nothing to procure. <br> <br> Take Rest for a while.</h3></p>
          </div>
        <!-- No Data messages --> 
      </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_upcomming hidden">
      Show More
    </button>
  </section>

  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
    <div class="page-content">
        <div class="mdl-grid procHistoryTab">
         
        <!-- No Data messages -->
         <div class="mdl-card-status mdl-shadow--2dp no_proc_hist hidden">
         <p><i class="material-icons status_icon">error</i></p>
         <p><h3> Procurement History Null! </h3></p>
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
<dialog id="add_market_dialog" class="mdl-dialog print_width" style="width:50%;height:300px;-webkit-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 299px 3333px rgba(0,0,0,0.75);">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
      </div>
      <div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet  mdl-cell--9-col-phone">
        <div class="edit_view hidden" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="edit_market" placeholder="">
            <label class="mdl-textfield__label" for="edit_market">Market</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="edit_market_address" placeholder="">
            <label class="mdl-textfield__label" for="edit_market_address">Address</label>
          </div>
        </div>
        <div class="add_view" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text"  id="market_name">
            <label class="mdl-textfield__label" for="market_name">Market</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text"  id="market_address">
            <label class="mdl-textfield__label" for="market_address">Address</label>
          </div>
        </div>
      </div>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone addMarket_dialog_action_btn mdl-dialog__actions">
        <button id="edit_btn" class="edit_view hidden mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        EDIT MARKET
        </button>
        <button id="add_btn" class="add_view mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        ADD MARKET
        </button>
        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="market-dialog-close" style="background-color: #ea4335;color: #ffffff; float:right;">
        CANCEL
        </button>
      </div>
    </div>
</dialog>
<!-- Demo Card For Clone -->

 <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardProchist hidden">
  <div class="procure-cardInfo-event mdl-card mdl-shadow--2dp procure-mdl-card ">
    <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
    <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
    <div class="mdl-card__actions mdl-card--border">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon pull-left" href="#" target="_blank">
        <i class="icon material-icons">info_outline</i> 
        <div class="mdl-tooltip mdl-tooltip--right">Info </div>
      </a>
    </div>
  </div>
 </div>

<!-- Demo Card For Clone -->
       

<script src="<?php echo base_url().'assets/js/procurement.js';?>"></script>
 <script type="text/javascript">
  var estdQty = <?php echo get_items_for_procure(); ?>;
  var allMarkets = <?php echo get_all_markets(); ?>;
</script>