<?php
$request_id= $this->input->get('employee_id');
$request = json_decode(get_all_employees($request_id),true)[0];
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title"><?=$request['name'];?>'s Request</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="employees_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="employees_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="employees_search"></label>
      </div>
    </div>
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab  tab_1 is-active">Pending Request</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab tab_2">Completed Request</a>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100 user_profile" data-id="<?= $request_id; ?>">
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
    <div class="page-content">
      <div id="req-cards" class="mdl-grid pending_request">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardRequest hidden">
          <div class="request-cardInfo-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand"><i class="icon material-icons">subject</i><h4></h4></div>
            <div class="mdl-card__title mdl-card--expand"><i class="icon material-icons">date_range</i><h4></h4></div>
            <div class="mdl-card__title mdl-card--expand"><p></p></div>
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon pull-left" href="#" target="_blank">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right">Info </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-2">
      <div class="page-content">
        <div id="req-cards" class="mdl-grid completed_request">
        </div>
      </div>
    </section>
    
</main>  

<script type="text/javascript" src="<?php echo base_url().'assets/js/hr.js';?>"></script>
          