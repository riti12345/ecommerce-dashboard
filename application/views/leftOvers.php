<?php 
     $leftovers = get_all_leftovers();
     $sal = "";
     $sal_count = "";
	  // echo print_array($leftovers);
	  // die;
      $decode_category=['','Vegetables','English Vegetables','Fruits'];
      $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

      foreach($leftovers as $key) :
        // if(isset($key['quantity'])){ $hidden = 'hidden'; $shown = '';}else{ $hidden = ''; $shown = 'hidden';}
        $sal .= "<tr class='salable-info-row'>
                <td item-id='".$key['item_id']."'>".get_item_by_id($key['item_id'])['item_name']." <span class='hidden'>".$decode_category[$key['category']]."</span> <span class='hidden'>".$decode_subcategory[$key['subcategory']]."</span></td>
                <td>".$this->config->item(get_item_by_id($key['item_id'])['uom'],'uom')."</td>
                <td>".$key['total_qty']."</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                 <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored leftovers_info' item-id=".$key['item_id']."><i class='material-icons'>expand_more</i></a>
                </td>
              </tr>";
              $sal_count++;
        foreach ($key['data'] as $key1):
         $sal .="<tr class='salable-info-row crate_info hidden' item-id=".$key['item_id']." >
                <td item-id='".$key1['item_id']."'>".get_item_by_id($key1['item_id'])['item_name']." <span class='hidden'>".$decode_category[$key1['category']]."</span> <span class='hidden'>".$decode_subcategory[$key1['subcategory']]."</span></td>
                <td>".$this->config->item(get_item_by_id($key1['item_id'])['uom'],'uom')."</td>
                <td>SKU: ".array_values(get_item_by_id($key1['item_id'])['sku'])[0]."</td>
                <td>Grade: ".$key1['grade']."</td>
                <td>Crate: ".$key1['crate_no']."</td>
                <td>Units: ".$key1['quantity']."</td>
                <td hidden>
                  <div class='mdl-textfield_raw mdl-js-textfield'>
                    <input class='mdl-textfield__input' type='number' id='' 
                      placeholder='Enter Quantity' value='".$key1['quantity']."' />
                  </div>
                </td>     
                <td>
                  <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect leftovers_edit'><i class='material-icons'>edit</i></a>
                  <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect leftovers_update' crate-id='".$key1['crate_id']."' item-id='".$key1['item_id']."' data-id='".$key1['id']."'><i class='material-icons save_btn'>check_circle</i></a>  
                  <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect leftovers_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a>  
                </td>
              </tr>";
      endforeach;  
      endforeach;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Leftovers Info</span>
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
        <label class="mdl-button mdl-js-button mdl-button--icon" for="leftovers_info_search">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
          <input class="mdl-textfield__input" type="search" id="leftovers_info_search" autofocus autocomplete="off" placeholder="Search..">
          <label class="mdl-textfield__label" for="leftovers_info_search"></label>
        </div>
      </div>
    </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="page-content">
    <div class="mdl-grid ">
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">
		<div class="mar_top_sm">
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
              echo"<table class='mdl-data-table  mdl-js-data-table tableSaleable mdl-shadow--2dp'>
                  <thead ".$thead[$length].">
                    <tr>
                      <th>Item <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                      <th>UOM</th>
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
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect leftovers_edit'><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect leftovers_update'><i class='material-icons save_btn'>check_circle</i></a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect leftovers_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a>  
                    </td>
                   </tr>";
                  
                    echo $sal ;  
                    ?>  
                  </tbody>
              </table>
            
            <?php
             
                ?>
            
            </div>		
      </div>
    </div>
  </div>        
</main>
<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
