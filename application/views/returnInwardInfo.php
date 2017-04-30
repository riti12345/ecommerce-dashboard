  <?php
    $order_id = $this->input->get('Oid');
    $return_inward = get_all_return_inward($order_id);
    
    //echo print_array($return_inward);die;
     // echo print_array(get_team_by_id(6));
     // die;

  ?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
<div class="mdl-layout__header-row">
  <span class="mdl-layout-title">RETURN INWARD INFO</span>
  <div class="mdl-layout-spacer"></div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="return_inward_info_search">
      <i class="material-icons">search</i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="search" id="return_inward_info_search" autofocus autocomplete="off" placeholder="Search..">
      <label class="mdl-textfield__label" for="return_inward_info_search"></label>
    </div>
  </div>
</div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
    
    <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;" data-upgraded=",MaterialButton">
      <i class="material-icons">arrow_back</i>
    </button>
    <div class="mdl-card-event_info_procure mdl-shadow--2dp">
      <table class="mdl-data-table mdl-js-data-table">
        <thead>
          <tr>
            <th>Sr. No.</th>
            <th class="mdl-data-table__cell--non-numeric" id="sortItems">ITEM</th>
            <th>RETURN QUANTITY</th>
            <th>UOM</th>
            <th>INWARD</th>
          </tr>
        </thead>
        <tbody class="return_inward_info_body">
          <form action="#">
            <?php
            foreach ($return_inward['data'] as $i => $value) :
                $originalDate = $return_inward['delivery_date'];
                $newDate = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($originalDate));
                echo "<tr class='return_inward_info_row'>
                        <td class='count'></td>
                        <td>".$return_inward['data'][$i]['item_name']."</td>
                        <td>".$return_inward['data'][$i]['back_qty']."</td>
                        <td>".$this->config->item($value['uom'],'uom')."</td>
                        <td style='white-space: nowrap;'>
                       <a href='returnInwardCrate?iid=".$return_inward['data'][$i]['item_id']."&date=".$return_inward['delivery_date']."&cid=".$return_inward['client_id']."&oid=".$order_id."&cname=".$return_inward['client_name']."' class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored inward_disabled'><i class='material-icons'>archive</i></a>
                       <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored Close_inward inward_disable' proc_items_id=".$return_inward['data'][$i]['item_id']."><i class='material-icons'>cancel</i></a>
                      </td>
                     </tr>";
              endforeach;
            ?>
          </form>
        </tbody>
         <tfoot> 
           
          </tfoot>
      </table>
    </div>
  </div>
</div>
</main>
        
      <script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
      