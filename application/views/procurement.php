<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Procurement</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="procure_manager_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="procure_manager_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="procure_manager_search"></label>
      </div>
    </div>
    
  </div>
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab mdl-layout__tab_3  is-active">Procurement Manager</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab_3 tab_1 tab_switch">Procurement Lists</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab_3 tab_switch">RTV</a>
    <a style="right:5%;position:absolute;" href="<?=base_url();?>api/pt" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Download template</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
      <div class="mdl-grid procure">
        
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardProcure hidden">
          <div class="procure-card-event mdl-card mdl-shadow--2dp procure-mdl-card ">
            <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
            <div class="mdl-card__title mdl-card--expand"><p></p></div>
            <div class="mdl-card__supporting-text"><p><span></span></p></div>
             <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="#" target="_blank">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
              </a>
               <!-- <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" style="float:right;" href="#" target="_blank">
                <i class="material-icons">view_list</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="" >Rate List </div>
              </a> -->
            </div>
          </div>
        </div>

      </div>
    </div>  
  </section>

  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
      <div id="team_id" data-id="" class="mdl-grid procUpcommingTab">
      </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_upcomming hidden">
      Show More
    </button>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div class="page-content">
      <div id="team_id" data-id="" class="mdl-grid rtvTab">
      </div>
    </div>
  </section>
</main>

<!-- Demo Card For Clone -->

 <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardProchist hidden">
  <div class="procure-cardInfo-event mdl-card mdl-shadow--2dp procure-mdl-card ">
    <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
    <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
    <div class="mdl-card__actions mdl-card--border">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon pull-left" href="#">
        <i class="icon material-icons">info_outline</i> 
        <div class="mdl-tooltip mdl-tooltip--right">Info </div>
      </a>
    </div>
  </div>
 </div>
<!-- Demo Card For Clone -->
<script src="<?php echo base_url().'assets/js/procurement.js';?>"></script>
 <script type="text/javascript">
   var allMarkets = <?php echo get_all_markets(); ?>;
   var estdQty = <?php echo get_total_item_qty_from_orders(); ?>;
 </script>