<?php
  $raw = get_all_raw();
  $itemId = $this->input->get('item_id');
  $saleable = get_all_saleable();
  //print_r($saleable);die;
  $hider_edit = 0;  $shower_onspot = 1;
  $hide_array = ["","hidden"];$disabled_array = ["","","disabled style='color:#B2DFDB'","disabled style='color:#B2DFDB'","disabled style='color:#B2DFDB'"];
  $decode_category=['','Vegetables','English Vegetables','Fruits'];
  $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">SaleableInfo</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="saleable_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="saleable_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="saleable_info_search"></label>
      </div>
    </div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">
        <?php
        
       echo" <button class='mdl-button mdl-js-button mdl-button--icon btn_icon_shadow' onclick='window.history.back()' style='min-width: 20px;' 
        data-upgraded=',MaterialButton'>
            <i class='material-icons'>arrow_back</i>
        </button>
        <table class='mdl-data-table raw_table mdl-js-data-table mdl-shadow--2dp'>
            <thead>
              <tr>
                <th>Item <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Crates</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>";

            foreach($saleable as $key) :
              foreach ($key['data']as $value):
                $procid = $value['proc_items_id'];
                $item_id =$value['item_id'];
                if($value['item_id'] == $itemId){
            echo  "<tr class='saleable-info-row' item-id =".$item_id.">
                <td item-id='".$key['item_id']."'>".get_item_by_id($value['item_id'])['item_name']." <span class='hidden'>".$decode_category[$value['category']]."</span> <span class='hidden'>".$decode_subcategory[$value['subcategory']]."</span></td>
                <td>".$decode_category[$key['category']]."</td>
                <td class='show_saleable_class".$value['id']."'>".$value['quantity']."</td>
                <td class='hide_saleable_class".$value['id']." hidden'>
                  <div class='mdl-textfield_raw mdl-js-textfield'>
                    <input class='mdl-textfield__input' type='number' id='saleable_quant' 
                      placeholder='Enter Quantity'/>
                  </div>
                </td>
                <td class='show_saleable_class".$value['id']."'>".$value['crate_no']."</td>
                <td class='hidden hide_saleable_class".$value['id']."'>
                   <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input  input_search' type='text' id='saleable_crate'>
                      <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                        <span class='mdl-chip__text'></span>
                        <button type='button' class='mdl-chip__action'>
                        <i class='material-icons'>cancel</i></button>
                      </span>
                      <label class='mdl-textfield__label mdl-textfield__label_addOrder' for='saleable_crate'></label>
                      <div class='suggestionClient hidden'>
                         <ul class='suggestionListClient' style='width:130%; text-align:left;'></ul>
                      </div>
                    </div>
                </td>
                <td data-item-id='".$value['item_id']."' data-saleable-id='".$value['id']."'>
                  <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_edit  saleable-info-row-edit show_saleable_class".$value['id']."'><i class='material-icons'>create</i></a>
                  <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_delete  saleable-info-row-delete show_saleable_class".$value['id']."'><i class='material-icons'>delete</i></a>
                  <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_udpate  saleable-info-row-done hidden hide_saleable_class".$value['id']."' data-items=".$value['proc_items_id']."><i class='material-icons'>done</i></a>
                  <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect saleable_delete  saleable-info-row-cancel hidden hide_saleable_class".$value['id']."'><i class='material-icons'>cancel</i></a>
                  <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored saleable-info-row-undo show_undo_class".$value['id']." hidden'><i class='material-icons'>undo</i></a>
                </td>
              </tr>";
            }
              endforeach;  
            endforeach;    
          echo"  </tbody>
        </table>";
          ?> 
      </div>
</main>
<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
<script>
 var allCrates = <?php echo get_all_crates()?>;
</script>