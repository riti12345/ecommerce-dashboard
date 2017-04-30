<?php 
     $saleable = get_all_salable();
     $sal = "";
     $sal_count = "";
     $decode_category=['','Vegetables','English Vegetables','Fruits'];
     $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

      foreach($saleable as $key) :
        // if(isset($key['quantity'])){ $hidden = 'hidden'; $shown = '';}else{ $hidden = ''; $shown = 'hidden';}
        $sal .="<tr class='salable-info-row'>
                <td item-id='".$key['item_id']."'>".get_item_by_id($key['item_id'])['item_name']." <span class='hidden'>".$decode_category[$key['category']]."</span> <span class='hidden'>".$decode_subcategory[$key['subcategory']]."</span></td>
                <td>".$this->config->item(get_item_by_id($key['item_id'])['uom'],'uom')."</td>
                <td>".$key['total_qty']."</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                 <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored saleable_info' item-id=".$key['item_id']."><i class='material-icons'>expand_more</i></a>
                </td>
              </tr>";
              $sal_count++;
        foreach ($key['data'] as $key1):
        $sal .="<tr class='salable-info-row crate_info hidden' item-id=".$key['item_id']." >
                <td item-id='".$key1['item_id']."'>".get_item_by_id($key1['item_id'])['item_name']." <span class='hidden'>".$decode_category[$key1['category']]."</span> <span class='hidden'>".$decode_subcategory[$key1['subcategory']]."</span></td>
                <td>".$this->config->item(get_item_by_id($key1['item_id'])['uom'],'uom')."</td>
                <td>SKU: ".array_values(get_item_by_id($key1['item_id'])['sku'])[0]."</td>
                <td>Crate: ".$key1['crate_no']."</td>
                <td>Units: ".$key1['quantity']."</td>
                <td hidden>
                  <div class='mdl-textfield_raw mdl-js-textfield'>
                    <input class='mdl-textfield__input' type='number' id='' 
                      placeholder='Enter Quantity' value='".$key1['quantity']."' />
                  </div>
                </td>     
                <td>Min-Units: ".$key1['min_quantity']."</td>
                <td hidden>
                  <div class='mdl-textfield_raw mdl-js-textfield'>
                    <input class='mdl-textfield__input' type='text' id='' 
                      placeholder='Enter Comment' value='".$key1['min_quantity']."' />
                  </div>
                </td> 
                <td>
                  <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_edit'><i class='material-icons'>edit</i></a>
                  <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_update' crate-id='".$key1['crate_id']."' proc-items-id='".$key1['proc_items_id']."' item-id='".$key1['item_id']."' sal-id='".$key1['id']."' process-id='".$key1['processing_id']."'><i class='material-icons save_btn'>check_circle</i></a>  
                  <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a>  
                </td>
              </tr>";
      endforeach;  
      endforeach;
  // echo print_array($saleable);
  // die;
?>
  <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Saleable Info</span>
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
        <label class="mdl-button mdl-js-button mdl-button--icon" for="salable_info_search">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
          <input class="mdl-textfield__input" type="search" id="salable_info_search" autofocus autocomplete="off" placeholder="Search..">
          <label class="mdl-textfield__label" for="salable_info_search"></label>
        </div>
      </div>
    </div>
    
  </header>
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">
              <?php
              $thead = ["hidden",""];
                if($sal_count == 0){
                  $length =0;
                  echo"<div class='mdl-card-status mdl-shadow--2dp'>
                          <p><i class='material-icons status_icon'>error</i><p>
                        <p><h3>Nothing !</h3></p>
                      </div>";
                }else{
                  $length=1;
                }
              echo"<div class='mar_top_sm' ".$thead[$length].">
              <table class='mdl-data-table  mdl-js-data-table tableSaleable mdl-shadow--2dp'>
                  <thead>
                    <tr>
                      <th>Item <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                      <th>UOM</th>
                      <!-- <th>SKU</th> -->
                      <!-- <th>Crate</th> -->
                      <!-- <th>Quantity</th> -->
                      <th>Total-Quantity</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody class='sal_tBody'>
                   <tr class='sal_tRow hidden'>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='hidden'>
                      <div class='mdl-textfield textfield_saleable mdl-js-textfield '>
                        <input class='mdl-textfield__input validate_number pull_center' type='number' id='rate1' 
                          placeholder='Enter Quantity' value=''/>
                        
                      </div>
                    </td>
                    <td></td>
                    <td class='hidden'>
                      <div class='mdl-textfield textfield_saleable mdl-js-textfield '>
                        <input class='mdl-textfield__input validate_number pull_center' type='number' id='rate2' 
                          placeholder='Enter Quantity' value='' />
                        
                      </div>
                    </td>
                    <td>
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_edit'><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_update'><i class='material-icons save_btn'>check_circle</i></a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a>  
                    </td>
                   </tr>";
                  echo $sal;
                      
                    ?>  
                  </tbody>
              </table>
            </div>
            </div>
          </div>
      </div>
  </main>
<!--   <div class="fixed-action-btn">
    <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="sal_add_item" href="#">
      <i class="material-icons">add</i>
      <div class="mdl-tooltip mdl-tooltip--top" for="sal_add_item" >add new item</div>
    </a>
  </div> -->

  <script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
  <script>
     var allCrates = <?php echo get_all_crates()?>;
    </script> 