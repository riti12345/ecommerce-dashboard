 <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Clients</span>
    <div class="mdl-layout-spacer">
      <!-- <a href="addClient" class="mdl-button mdl-js-button  mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style=" margin-left:15px;    padding: 0px 12px;">Add Client </a> -->
    </div>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="searchClient">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="searchClient" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="searchClient"></label>
      </div>
    </div>   
  </div>
</header>
<main class="dispatch mdl-layout__content mdl-color--grey-100" ng-controller="clientCtrl">
    <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
    <div class="page-content">
      <div class="mdl-grid client">
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone ">  
            <div class="header_icon pull-right" id="view_item_list">
              <span class="list_view mdl-button mdl-js-button mdl-button--icon" value="list_view">
                <i class="material-icons" id="goff">view_list</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="goff" >List View</div>
              </span>
              <span  class="grid_view mdl-button mdl-js-button mdl-button--icon  hidden " value="grid_view">
                <i class="material-icons " id="gon">grid_on</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="gon" >Grid View</div>
              </span>
              <span  class="print_view mdl-button mdl-js-button mdl-button--icon  hidden " value="print">
                <i class="material-icons " id="print">print</i>
                <div class="mdl-tooltip mdl-tooltip--left" for="print" >Print</div>
              </span>
            </div>
          </div>

          <!-- grid view -->
          <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet mdl-cell--6-col-phone regclientcards clientCardEmpty animate slideInUp" ng-repeat="client in manageClients.data">
            <div class="client-card-event mdl-card mdl-shadow--2dp">
              <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
                <h4 class="clientName">{{client.name}}</h4>
              </div>
              <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
                <i class="icon material-icons">person</i>
                <p class="clientPOC">{{client.poc_name}}</p>
              </div>
              <div class="hidden "><p></p></div> <!-- company name-->
              <div class="hidden"><p></p></div>   <!-- brand name-->
              <div class="mdl-card__title mdl-card--expand" style="padding: 0px 7px 0px 7px;">
                <i class="icon material-icons">phone</i>
                <p class="clientPhone">{{client.poc_phone}}</p>
              </div>
                
              <div class="mdl-card__actions mdl-card--border" >
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="clientInfo" target="_blank">
                  <i class="icon material-icons">info_outline</i> 
                  <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                </a>

                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" style="float:right;" href="#" target="_blank">
                  <i class="material-icons">view_list</i>
                  <div class="mdl-tooltip mdl-tooltip--left" for="" >Rate List </div>
                </a>
              </div>
              <div style="position: absolute;right: 16px;top :18px;cursor: pointer;" >
                <span>
                  <i class="material-icons" id="" style="font-size: 17px;">visibility</i>
                  <div class="mdl-tooltip mdl-tooltip--left" for="">Active </div>
                </span>
              </div>
            </div>
          </div>

          <!-- List view -->
          <div class="mdl-cell mdl-cell--12-col hidden animate fadeIn">
            <table class="client_list_table mdl-data-table mdl-js-data-table mdl-shadow--4dp  clientTableEmpty">
                <thead>
                  <tr>
                    <th></th>
                    <th>Client Name</th>
                    <th>Company Name</th>
                    <th>POC Name</th>
                    <th>City</th>
                    <th>Contact No</th>
                  </tr>
                </thead>
                <tbody class ="clientTbody">
                  <tr class="clientTrowEmpty hidden">
                  <td>
                      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="clientInfo"
                      style="    height: 30px;">
                        <i class="icon material-icons" style=" font-size: 18px;">info_outline</i> 
                          <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                      </a>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
            </table>
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
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more">
    Show More
  </button>

</main>

<script type="text/javascript" src="<?php echo base_url().'assets/js/clientManagement.js';?>"></script>

    