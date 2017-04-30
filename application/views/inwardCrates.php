<?php 
	$proc_items_id = $this->input->get('id');
	$item_id       = $this->input->get('iid');
	$vendor_id     = $this->input->get('vid');
  $InwardItems = get_all_inward_items($proc_items_id);
  //echo print_Array($InwardItems);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
 <div class="mdl-layout__header-row">
  <span class="mdl-layout-title">Inward Crates</span>
  <div class="mdl-layout-spacer"></div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
    <label class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" for="inward_info_search">
      <i class="material-icons">search</i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="search" id="inward_info_search" autofocus autocomplete="off" placeholder="Search..">
      <label class="mdl-textfield__label" for="inward_info_search"></label>
    </div>
  </div>
 </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
      <div class="mdl-grid ">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;" 
            data-upgraded=",MaterialButton">
                <i class="material-icons">arrow_back</i>
          </button>
          <div class="card-details mdl-shadow--2dp">
            <table class="mdl-data-table_jit_head mdl-js-data-table">
              <tbody>
                <tr class="bill_add_row">
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="inward_item" placeholder="" readonly="" <?= "value='".get_item_by_id($item_id)['item_name']."' item-id='".$item_id."'";?>>
                      <label class="mdl-textfield__label" for="inward_item">Item</label>
                    </div>   
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="inward_vendor" placeholder="" readonly="" value="<?php 
                        if(!empty($vendor_id)){
                           echo get_vendor_by_id($vendor_id)['name'];
                        }else{echo "JIT";}
                      ?>">
                      <label class="mdl-textfield__label" for="inward_vendor">Vendor</label>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="inward_uom" autocomplete="off" placeholder="" readonly="" value="<?= $this->config->item(get_item_by_id($item_id)['uom'],'uom');?>">
                      <label class="mdl-textfield__label" for="inward_uom">UOM</label>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input input_search" type="text" id="inward_crate" autocomplete="off" placeholder=""/>
                      <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                        <span class="mdl-chip__text"></span>
                        <button type="button" class="mdl-chip__action">
                        <i class="material-icons">cancel</i></button>
                      </span>
                      <label class="mdl-textfield__label mdl-textfield__label_addOrder" for="inward_crate">Crate No.</label>
                      <div class="suggestionClient hidden">
                         <ul class="suggestionListClient" style="width:130%;text-align:left;"></ul>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input validate_date" type="number" id="inward_qty" placeholder=""/>
                      <label class="mdl-textfield__label mdl-textfield__label" for="inward_qty">Quantity</label>
                    </div>
                  </td>
                  <td>
                    <!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="inward_comment" placeholder="" >
                      <label class="mdl-textfield__label" for="inward_comment">Comments</label>
                    </div> -->
                    <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label' style='width: 90px;margin-left: 30px;'>
                      <select required='' id='inward_comment' class='mdl-selectfield__select'>
                        <option value="GOOD">GOOD</option>
                        <option value="BAD">BAD</option>
                        <option value="OK">OK</option>
                        <option value="RTV">RTV</option>
                      </select>
                      <label class='mdl-selectfield__label' for='inward_comment'>Comments</label>
                    </div>
                  </td>
                  <td>
                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="add_crates" >
                      <i class="material-icons">done</i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="mdl-card-event_add_jit mdl-card mdl-shadow--2dp inward_div">
            <table class="mdl-data-table table_jit mdl-js-data-table">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th class="mdl-data-table__cell--non-numeric">Items</th>
                  <th>UOM</th>
                  <th>Crate No.</th>
                  <th>Quantity</th>
                  <th>Comment</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="inward_tbody">
                <?php
                $uom_array = ["","KGS","BDL","PKT","DZN","PCS"];
                foreach ($InwardItems as $key => $value):
                  foreach ($value['data'] as $key1 => $value1):
                echo "<tr class='inward_crate_row_info'>
                        <td class='count'></td>
                        <td>".$value['item_name']."</td>
                        <td>".$uom_array[$value['uom']]."</td>
                        <td>
                            <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border input_search edit_units' type='text' id='crateNo' value=".$value1['crate_no']." readonly>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient' style='width:130%; text-align:left;'></ul>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border edit_units' type='text' id='' value=".$value1['quantity']." readonly>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border edit_units' type='text' value=".$value1['comment']." readonly>
                            </div>
                          </td>
                        <td>
                        <button disabled class='mdl-button mdl-js-button mdl-button--icon mdl-button--colored inward_edit inward-crate-row-edit inward_done'>
                          <i class='material-icons'>done_all</i>
                        </button>
                      </td>
                </tr>";
                  endforeach;
                endforeach;
                ?>
                <tr class="inward-item hidden">
                  <td class="count"></td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border input_search edit_units" type="text" id="crateNo" readonly>
                      <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                        <span class="mdl-chip__text"></span>
                        <button type="button" class="mdl-chip__action">
                        <i class="material-icons">cancel</i></button>
                      </span>
                      <div class="suggestionClient hidden">
                         <ul class="suggestionListClient" style="width:130%; text-align:left;"></ul>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border edit_units" type="text" id="" readonly>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border edit_units" type="text" id="" readonly>
                    </div>
                  </td>
                  <td>
                    <button class="mdl-button mdl-js-button mdl-button--icon inward_edit inward-crate-row-edit" tabindex="8">
                      <i class="material-icons ">create</i>
                    </button> 
                    <button class="mdl-button mdl-js-button mdl-button--icon inward_delete inward-crate-row-remove" tabindex="9">
                      <i class="material-icons order_delete">delete</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--icon inward_update inward-crate-row-done hidden" tabindex="10">
                      <i class="material-icons ">done</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--icon inward_delete inward-crate-row-cancel hidden" tabindex="11">
                      <i class="material-icons ">cancel</i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent hidden" data-items="<?= $proc_items_id;?>" id="inward_submit" tabindex="12"><i class="material-icons">archive</i> Inward</button>
              </div>
            </div>
          </div>		          
      </div>
    </div>
  </div>
</main>    
<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
<script>
 var allCrates = <?php echo get_all_crates()?>;
</script>