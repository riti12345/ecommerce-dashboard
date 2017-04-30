<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Processing</span>
    <div class="mdl-layout-spacer">
      <!-- <a href="addVendor" class="mdl-button mdl-js-button  mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style=" margin-left:15px;    padding: 0px 12px;">Add Vendor</a> -->
    </div>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="processing_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="processing_search" autocomplete="off" autofocus="" placeholder="Search..">
        <label class="mdl-textfield__label" for="processing_search"></label>
      </div>
    </div>
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab is-active tab_1">Processing</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab tab_2">Processed</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab tab_3">History</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
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
    </div>
  </div>

  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
     <div class="mdl-grid processingTab" id="processingSteps">
      <div class="mdl-cell mdl-cell--12-col hidden animate fadeIn ">
        <!-- Proceesing Demo Card Empty -->
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardProcessing hidden">  
         <div class="mdl-card-process mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-card--expand"><h4 class="itemName">item_name</h4></div>
          <div class="mdl-card__title mdl-card--expand"><p class="assigned">assignee_id</p></div>
          <div class="mdl-card__title mdl-card--expand"><p class="crateNo">crate_no</p></div>
          <div class="mdl-card__title mdl-card--expand"><p class="qty">quantity</p></div>
          <div class="mdl-card__actions mdl-card--border">
           <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="">
            <i class="icon material-icons">play_circle_outline</i>
           </a>
           <div class="mdl-tooltip mdl-tooltip--right" for="" >Start Process </div>
          </div>
         </div> 
        </div>
        <!-- Proceesing Demo Card Empty -->
        <table class=" mdl-data-table mdl-js-data-table mdl-shadow--4dp  processingTableEmpty">
          <thead>
            <tr>
              <th></th>
              <th>Item Name</th>
              <th>Assignee</th>
              <th>Quantity</th>
              <th>Crate No.</th>
            </tr>
          </thead>
          <tbody class ="processingTbody">
            <tr class="processingTrowEmpty hidden">
              <td>
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" target="_blank">
                  <i class="icon material-icons">play_circle_outline</i>
                </a>
                <div class="mdl-tooltip mdl-tooltip--right" for="" >Start Process </div>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- No Data messages -->
        <div class="mdl-card-status mdl-shadow--2dp info no_process hidden"><p><i class="material-icons status_icon">error</i></p><p><h3>  Nothing to process. <br> <br> Take Rest for a while.</h3></p></div>
      <!-- No Data messages --> 
     </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_processing hidden">
      Show More
    </button>
  </section>

  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
     <div class="mdl-grid processedTab" id="processingInfo">
      <div class="mdl-cell mdl-cell--12-col hidden animate fadeIn ">
        <table class=" mdl-data-table mdl-js-data-table mdl-shadow--4dp  processingTableEmpty">
          <thead>
            <tr>
              <th></th>
              <th>Item Name</th>
              <th>Assignee</th>
              <th>Quantity</th>
              <th>Crate No.</th>
            </tr>
          </thead>
          <tbody class ="processedTbody">
          </tbody>
        </table>
      </div>
      <!-- No Data messages -->
        <div class="mdl-card-status mdl-shadow--2dp history process_comp hidden"><p><i class="material-icons status_icon">error</i></p><p><h3> Processing Completed ! </h3></p></div>
      <!-- No Data messages --> 
     </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_processed hidden">
      Show More
    </button>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div class="page-content">
     <div class="mdl-grid historyTab" id="processingInfo">
      <div class="mdl-cell mdl-cell--12-col hidden animate fadeIn ">
        <table class=" mdl-data-table mdl-js-data-table mdl-shadow--4dp  processingTableEmpty">
          <thead>
            <tr>
              <th></th>
              <th>Item Name</th>
              <th>Assignee</th>
              <th>Quantity</th>
              <th>Crate No.</th>
            </tr>
          </thead>
          <tbody class ="historyTbody">
          </tbody>
        </table>
      </div>
      <!-- No Data messages -->
       <div class="mdl-card-status mdl-shadow--2dp history no_process_hist hidden"><p><i class="material-icons status_icon">error</i></p><p><h3> Processing History Null! </h3></p></div> 
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
<script>
  var allProcessInfo = <?php echo get_all_process() ?> ;
</script>