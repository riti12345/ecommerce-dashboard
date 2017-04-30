<?php 
    $proc_id = $this->input->get('procure_id');
 ?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Return to Vendor Info</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100 get_procure_id" data-id="<?= $proc_id ?>">
  <div class="page-content">
     <div class="mdl-grid rtvInfoTab">
      <!-- Demo Card For Clone -->
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardrtvInfo hidden">
        <div class="procure-cardInfo-event mdl-card mdl-shadow--2dp procure-mdl-card ">
          <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
          <div class="mdl-card__title mdl-card--expand"><h4></h4></div>
          <div class="mdl-card__actions mdl-card--border">
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon pull-left" href="#">
              <i class="icon material-icons">info_outline</i> 
              <div class="mdl-tooltip mdl-tooltip--right">Info </div>
            </a>
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon pull-right print_rtv" href="#">
              <i class="icon material-icons">print</i> 
              <div class="mdl-tooltip mdl-tooltip--right">Print</div>
            </a>
          </div>
        </div>
        </div>
      <!-- Demo Card For Clone -->
      </div>
    </div>
  </main>

<script src="<?php echo base_url().'assets/js/procurement.js';?>"></script>
