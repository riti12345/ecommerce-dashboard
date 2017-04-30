<?php
$data = get_all_raw();
// echo print_array($data);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Wastage</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="wastage_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="wastage_search" autofocus placeholder="Search.." autocomplete='off'>
        <label class="mdl-textfield__label" for="wastage_search"></label>
      </div>
    </div>
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
      <a href="#scroll-tab-1" class="mdl-layout__tab mdl-layout__tab_3  is-active">Summary</a>
      <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab_3 wastage_tab_1 tab_switch">Today</a>
      <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab_3 wastage_tab_2 tab_switch">History</a>
    </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
 <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
 <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
  <div class="page-content">
     <div class="mdl-grid jit">
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
          <div class="card-details mdl-shadow--2dp">
            <table class="mdl-data-table table_jit mdl-js-data-table">
                <thead><th>Sr No.</th><th>Item Name</th><th>UOM</th><th>Quantity</th><th>Crate No</th></thead>
                <tbody class="wastage_info_Tbody">
                <?php
                foreach ($data as $key => $value):
                echo "<tr class='wastage_info_row' proc-id='".$value['proc_items_id']."' item-id='".$value['item_id']."'>
                    <td class='count update_td'></td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border input_search' value='".$value['item_name']."' item-id='".$value['item_id']."'type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$this->config->item($value['uom'],'uom')."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input style='background-color:inherit;border-bottom:1px solid rgb(0, 142, 60)' class='mdl-textfield__input mdl-textfield__input_border' value='' type='text' id='wastage_quant'>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input style='background-color:inherit;border-bottom:1px solid rgb(0, 142, 60)' class='mdl-textfield__input mdl-textfield__input_border' value='' type='text' id='crateNo'>
                        <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                        <span class='mdl-chip__text'></span>
                            <button type='button' class='mdl-chip__action'>
                            <i class='material-icons'>cancel</i></button>
                        </span>
                        <div></div>
                        <div class='suggestionClient hidden'>
                          <ul class='suggestionListClient' style='width:130%;text-align:left;'></ul>
                        </div>
                      </div>
                    </td>
                </tr>";
                 endforeach;
                ?>  
                </tbody>
            </table>
            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <button id = "wastage_submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" tabindex="">Submit</button>
            </div>
          </div>
        </div>
     </div>
  </div>
  </section>
   <section class="mdl-layout__tab-panel" id="scroll-tab-2">
  <div class="page-content">
    <div class="mdl-grid wastage_today">
      <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_wastage_today hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> No Items Found in Wastage!</h3></p>
          </div>
        <!-- No Data messages -->
    </div>
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_wastage print_hide hidden">
        Show More
      </button>
  </div>
 </section>
 <section class="mdl-layout__tab-panel" id="scroll-tab-3">
   <div class="page-content">
    <div class="mdl-grid wastage_history">
    <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_wastage_history hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> No Items Found!</h3></p>
          </div>
        <!-- No Data messages -->
    </div>

      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_wastage_hist print_hide hidden">
         Show More
      </button>
  </div>
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
   <div class="mdl-grid searchResultCards"></div>
 </div> 
</main>
<!-- Demo Card For Clone -->
<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone demoCardwastage  regvencards hidden">
  <div class="demo-card-event mdl-card mdl-shadow--2dp"  style="height: 105px; min-height: 160px;">
    <div class="mdl-card__title mdl-card--expand" style=" padding: 4px 8px;"><h4 class="bill_no"></h4></div>
    <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px;"><p class="bill_date"></p></div>
    <div class="mdl-card__title mdl-card--expand" style=" padding: 0px 7px;"><p class="bill_vendor"></p></div>
    <div class="mdl-card__actions mdl-card--border" style=" height: 55px;">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon bill_info" id="" href="#" target="_blank">
        <i class="icon material-icons ">info_outline</i> 
        <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
      </a>
    </div>
  </div>
</div>
<!-- Demo Card For Clone -->
<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
<script>
 var allCrates = <?php echo get_all_crates()?>;
</script>
