<?php
$id=$this->input->get('id');
$data = get_wastage_items($id);
// echo print_array($data);die;
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Wastage Info</span>
    <div class="mdl-layout-spacer"></div>
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
                <thead><th>Sr No.</th><th>Date</th><th>Item Name</th><th>UOM</th><th>Quantity</th><th>Crate No</th><th>Actions</th></thead>
                <tbody class="wastage_info_Tbody">
                <?php
                foreach ($data[0]['data'] as $key => $value):
                echo "<tr class='wastage_info_details_row'>
                    <td class='count update_td'></td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border input_search' value='". date("d-m-Y",strtotime($value['added_on']))."' type='text' id='' readonly>
                      </div>
                    </td>
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
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['quantity']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border crate_id' value='".$value['crate_code']."' type='text' data-id='".$value['crate_id']."' id='crateNo' readonly>
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
                    <td> 
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored edit_wastage '><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored update_wastage' data-id='".$value['id']."'><i class='material-icons save_btn'>check_circle</i></a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored cancel_wastage'><i class='material-icons cancel_btn'>cancel</i></a>  
                    </td>
                </tr>";
                 endforeach;
                ?>  
                </tbody>
            </table>
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
