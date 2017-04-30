<?php
  $vendor_id = $this->input->get('id');
  $proc_date = $this->input->get('proc_date');
  $new_history;
  if(isset($vendor_id)) {
    $vendor = get_all_OnspotVendors_history($vendor_id);
    // echo print_array($vendor);die;
    $history = json_decode($vendor,true);
    foreach ($history as $key => $value) {
      if($proc_date !== $key){
        unset($history[$key]);
      }else{
        $new_history = $value['details'];
      }
    }

    // echo print_array($new_history); die;

  }
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Onspot Vendor's History</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="search"></label>
      </div>
    </div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="">
        <div class="">
          <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>
          
          <table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th class="mdl-data-table__cell--non-numeric" id="sortItems">Item</th>
                <th>Slot</th>
                <th>Market</th>
                <th>Team</th>
                <th>Final Quantity</th>
                <th>Final Price</th>
                <th>Extra Charges</th>
                <th>Labor Charges</th>
                <th>Reasons</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sr_counter=0;
                $keys = array_keys($history);
                // echo print_array($keys);
                // for ($i = 0; $i < count($history); $i++) :
                  // echo print_array($keys[$i]);
              foreach($new_history as $key => $value) :
                    // echo print_array();
                echo "<tr>
                        <td>".++$sr_counter."</td>
                        <td class='mdl-data-table__cell--non-numeric'>".$value['item_name']."</td>
                        <td>".$this->config->item($value['proc_slot'],'delivery_slot')."</td>
                        <td>".$value['market_name']."</td>
                        <td>".$value['team_name']."</td>
                        <td>".$value['final_quantity']."</td>
                        <td>".$value['final_price']."</td>
                        <td>".$value['other_charges']['extra_charges']."</td>
                        <td>".$value['other_charges']['labor_charges']."</td>
                        <td>
              <button class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon' id='reason".$sr_counter."'>
                <i class='material-icons'>help</i>
               </button>
               <div class='mdl-tooltip mdl-tooltip--top' for='reason".$sr_counter."' >Reasons</div>
                <ul class='mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right' for='reason".$sr_counter."'>
                 <li class='mdl-menu__item'>Extra Charge Reason: <b>";
                  if(isset($value['reason']['ambiguity_reasons'])){ echo $value['reason']['extra_charges_reason'];
                  }else{echo "None";}
                 echo"</b></li>
                 <li class='mdl-menu__item'>Ambiguity Charge Reason: <b>";
                  if(isset($value['reason']['ambiguity_reasons'])){ echo $value['reason']['ambiguity_reasons'];
                 }else{echo "None";}
                 echo"</b></li>
                 <li class='mdl-menu__item'>Labor Charge Reason: <b>";
                  if(isset($value['reason']['labor_charges'])){ echo $value['reason']['labor_charges'];
                 }else{echo "None";}
                 echo"</b></li>";
               if(isset($value['reason']['reason_for_leaving_item'])){  
                 echo "<li class='mdl-menu__item'>Reason For Leaving Item: <b>".$value['reason']['reason_for_leaving_item'];
                 }
                 echo"</b></li>
              </ul> 
                        </td>
                      </tr>";
                  endforeach;       
                // endfor;
              ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script type="text/javascript" src="<?php echo base_url().'assets/js/vendor.js';?>"></script>