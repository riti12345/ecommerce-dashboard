<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Team</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="team_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="team_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="team_info_search"></label>
      </div>
    </div> 
  </div>
</header>

<main class="dispatch mdl-layout__content mdl-color--grey-100">

    <div class="page-content">
      <div class="mdl-grid team">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet mdl-cell--6-col-phone regteamcards demoCardEmpty hidden">
          <div class="team-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;"><h4 class="team_username"></h4>
            </div>
            <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
              <i class="icon material-icons">account_box</i>
              <p class="team_designation"></p>
            </div>
            <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
              <i class="icon material-icons">phone</i>
              <p class="team_mobile"></p>
            </div>
              
            <div class="mdl-card__actions mdl-card--border" >
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="info_tool" href="teamInfo" target="_blank">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right" for="info_tool" >Info </div>
              </a>
              <a href="#" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon link_team" id="info_tool2" style="float:right;">
                <i class="material-icons">link</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="info_tool2" >Link</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
</main>
<script type="text/javascript" src="<?php echo base_url().'assets/js/team.js';?>"></script>
