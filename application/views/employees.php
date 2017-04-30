<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Employees</span>
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
</header>

<main class="mdl-layout__content mdl-color--grey-100">
    <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
    <div class="page-content">
      <div id="hr-cards" class="mdl-grid grid_hr">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone employeeCardEmpty hidden">
          <div class="hr-card-event mdl-card mdl-shadow--2dp hr-mdl-card">
           
            <div class="mdl-card__title mdl-card--expand" style="padding:4px 8px">
              <h4 style="padding: 0px 8px 0px 5px"> </h4></div>
              <div class="hr">
              <div class="hr_details"> 
                <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;"><i class="icon material-icons">phone</i><p></p></div>
                <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;"><i class="icon material-icons">account_box</i><p></p></div>
                <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;"><i class="icon material-icons">email</i><p></p></div>
             </div> 
              <div class="img_hr"> 
                <img class="img-resp" src="client_files/default.png">  
              </div>
             
             </div>
             
             <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" target="_blank" id="infotool">
                <i class="icon material-icons ">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="infotool">Info </div>
              </a>
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="info_tool2" style="float:right;">
                  <div  style ="margin-top: 12px;" class="material-icons mdl-badge mdl-badge--overlap" id="info_tool2"><i class="material-icons">history</i></div>
                  <div class="mdl-tooltip mdl-tooltip--left" for="info_tool2" >Pending Request</div>
              </a>
              <a href="#" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="ratelistTool0" style="float:right;">
                  <i class="material-icons">assessment</i>
                  <div class="mdl-tooltip mdl-tooltip--left" for="ratelistTool0" >Attendance</div>
                </a>
            </div>
          </div>        
        </div>
      </div>
    </div>
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
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more print_hide">
    Show More
  </button>
</main>  

<script type="text/javascript" src="<?php echo base_url().'assets/js/hr.js';?>"></script>
          