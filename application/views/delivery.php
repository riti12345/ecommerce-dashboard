<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
<div class="mdl-layout__header-row">
  <span class="mdl-layout-title">Delivery</span>
  <div class="mdl-layout-spacer"></div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="searchDelivery">
      <i class="material-icons">search</i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="search" id="searchDelivery" autofocus autocomplete="off" placeholder="Search..">
      <label class="mdl-textfield__label" for="searchDelivery"></label>
    </div>
  </div>
  
</div>
<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
  <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Upcoming</a>
  <a href="#scroll-tab-2" class="mdl-layout__tab">Today</a>
  <a href="#scroll-tab-3" class="mdl-layout__tab">History</a>
</div>

</header>
<main class="dispatch mdl-layout__content mdl-color--grey-100">

<!--UPCOMING TAB-->
<section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
  <div class="page-content">
    <div class="mdl-grid delUpcomming">
      <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet  mdl-cell--6-col-phone demoCardDelivery hidden">
        <div class="demo-card-event mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-card--expand"><h4>Order ID: </h4></div>
          <div class="mdl-card__title mdl-card--expand"><p></p></div>
          <div class="mdl-card__title mdl-card--expand"><p></p></div>
          <div class="mdl-card__supporting-text"><p></p></div>
          <div class="mdl-card__supporting-text"><p></p></div>
          <div class="mdl-card__actions mdl-card--border">
          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label mdl-js-ripple-effect" style="padding:0 0 18px 0">
           <select select="selected" class="mdl-selectfield__select select2" style="width:100%;background:transparent url(assets/images/br_down.png)no-repeat right;"></select>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--TODAY TAB-->
<section class="mdl-layout__tab-panel" id="scroll-tab-2">
  <div class="page-content">
    <div class="mdl-grid delToday">
    </div>
  </div>
</section>

<!--HISTORY TAB-->
<section class="mdl-layout__tab-panel" id="scroll-tab-3">
  <div class="page-content">
    <div class="mdl-grid delHistory">
    </div>
  </div>
</section>
</main>
<script type="text/javascript" src="<?php echo base_url().'assets/js/delivery.js';?>"></script>