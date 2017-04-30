<?php 
//update_order_status();
//echo print_array(avg_purchase_per_unit());die;
// $sale = cogs_by_category();die;
?>
<script type="text/javascript" src="<?php echo base_url().'assets/chart/Chart.js';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/customChart.js';?>"></script>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Home</span>
    <div class="mdl-layout-spacer"></div>
  <!--  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="search">
        <label class="mdl-textfield__label" for="search">Enter your query...</label>
      </div>
    </div> -->
    
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card-chart mdl-card  mdl-shadow--2dp" style="padding:0px 20px 20px ; ">
        <canvas id="myChart" width="200" height="150" ></canvas>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card-chart mdl-card mdl-shadow--2dp">
        <canvas id="myChart2" width="200" height="150" ></canvas>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card-chart mdl-card mdl-shadow--2dp">
        
      </div>
    </div>
    <div class="mdl-cell mdl-cell--8-col mdl-cell--12-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card-chart mdl-shadow--2dp">
        
      </div>
    </div>
  </div>
</main>