<?php
$id=$this->input->get('id');
$bill_no = $this->input->get('bill_no');
$data = get_vendor_bill_items($id,$bill_no);
$total_price="";
// echo print_array($data);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Vendor Bills Info</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="page-content">
     <div class="mdl-grid jit">
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
          <div class="card-details mdl-shadow--2dp">
            <table class="mdl-data-table table_jit mdl-js-data-table">
                <thead><th>Sr No.</th><th>Item</th><th>Rate</th><th>Quantity</th><th>APMC Tax</th><th>Levi Tax</th><th>Actions</th></thead>
                <tbody class="bill_infoTbody">
                <?php
                foreach ($data as $key => $value):
                $total_price += $value['rate'] * $value['qty']+ $value['apmc_tax']+$value['levi_tax'];
                echo "<tr class='bill_inforow' item-id='".$value['item_id']."'>
                    <td class='count update_td'></td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border input_search' value='".$value['item_name']."' item-id='".$value['item_id']."'type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['rate']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['qty']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['apmc_tax']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border in' value='".$value['levi_tax']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td> 
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored edit_bill_item '><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored update_bill_item' data-id='".$value['id']."' data-bill='".$value['bill_id']."'><i class='material-icons save_btn'>check_circle</i></a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored cancel_bill_item'><i class='material-icons cancel_btn'>cancel</i></a>  
                      <a class='rate_cancel mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored' id='bill_delete' data-id='".$value['bill_id']."' data-bill='".$value['bill_no']."'><i class='material-icons cancel_btn'>delete</i></a>
                    </td>
                </tr>";
                 endforeach;
                ?>  
                </tbody>
                <tfoot class="bill_infotfoot">
                <tr><td colspan="4" style="text-align: left;">Total</td><td class="bill_items_total"><?=$total_price;?></td></tr>
                </tfoot>
            </table>
          </div>
        </div>
     </div>
  </div>
</main>
<script src="<?php echo base_url().'assets/js/vendor.js';?>"></script>
