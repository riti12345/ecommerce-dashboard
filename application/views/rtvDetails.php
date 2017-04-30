<?php
$procure_id  = $this->input->get('pid');
$assignee_id = $this->input->get('tid');
$vendor_id   = $this->input->get('vid');

$rtv_details = get_rtv_details($procure_id,$assignee_id,$vendor_id);
// echo print_array($rtv_details);die; 
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Return to Vendor Details</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100 " >
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
       <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
          <i class="material-icons">arrow_back</i>
       </button>

       <div class="mdl-card-event_add_rtv addUpdateScreen mdl-card mdl-shadow--2dp">
            <table class="mdl-data-table table_rtv mdl-js-data-table rtvTableInfo">
              <thead>
                <tr>
                  <th>Sr No.</th> 
                  <th>Item Name</th>
                  <th>Crate No.</th>
                  <th>Quantity</th>
                  <th>Actions</th>
                  <th class='hidden'></th>
                </tr>
              </thead>
              <tbody class="rtv_infoTbody">
              <?php
                foreach ($rtv_details[0]['data'] as $key => $value):
                echo "<tr class='rtv_row'>
                    <td class='count update_td'></td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".get_item_by_id($value['item_id'])['item_name']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['code']."' type='text' data-id='".$value['crate_id']."' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['quantity']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored edit_rtv '><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored update_rtv' data-id=".$value['raw_id']."><i class='material-icons save_btn'>check_circle</i></a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored cancel_rtv'><i class='material-icons cancel_btn'>cancel</i></a>  
                    </td>
                </tr>";
                 endforeach;
                ?>              
              </tbody>
            </table>
          </div>
      </div>
    </div>
</main>
<script src="<?php echo base_url().'assets/js/procurement.js';?>"></script>