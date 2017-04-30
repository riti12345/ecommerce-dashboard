<?php
  $item_id  = $this->input->get('id');
  if(isset($item_id)) {
    $item = get_all_items($item_id);
    $disp_item = json_decode($item,true);
    // echo print_array($disp_item);die;
    $data=$disp_item['data']['items'][0];
  }
  $perm_array=[0,2,3];
  $permissions = get_session_data()['user']['permissions'];
  // echo print_array($permissions);die;
?>
<script type="text/javascript">
  var item = <?php echo $item; ?>;
</script>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Item's Info</span>
    <div class="mdl-layout-spacer"></div>
    
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__clientInfo">
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>
           
           <?php if(in_array($permissions,$perm_array)):?>
           <div style="float:right; width: 120px;">
            
 
            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect" id="item_edit" style="float:right;">
              <i class="material-icons">mode_edit</i>
              <div class="mdl-tooltip mdl-tooltip--top " for="item_edit">Edit</div>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect  showme hidden" id="item_cancel" data-id="<?= $data['id']; ?>" style="margin-left:1%">
              <i class="material-icons">clear</i>
              <div class="mdl-tooltip mdl-tooltip--top" for="item_cancel" >Cancel</div>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect showme hidden" id="item_update" data-id="<?= $data['id']; ?>" style="margin-left:1%">
              <i class="material-icons">save</i>
              <div class="mdl-tooltip mdl-tooltip--top" for="item_update" >Save</div>
            </button>
          </div> 
          <?php endif ?>


          <form action="#" id="item_form">
          <div class="img_container">
            <img class="img-responsive" src="<?= $data['img_source'];?>" >
            <input type="file" name="item_image" id="item_edit_img" class="showme hidden">
                <label for="item_edit_img" id="Imagelabel" class="mdl-button mdl-js-button  mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-button--icon showme hidden" style="left:40%">
                  <i class="material-icons">photo_camera</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="Imagelabel">Choose Image</div>
                </label>  
          </div>
          
          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--4-col mdl-cell--1-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="itemIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemIcon">Item Name</div>
                <h4 class="mdl-card__subInfo hideme"><?= $data['item_name'];?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input required class="mdl-textfield__input" type="text" id="item_edit_name" value="<?= $data['item_name'];?>">
                  <label class="mdl-textfield__label" for="item_edit_name">Item&rsquo;s Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-cell--2-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="itemAltIcon">filter_2</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemAltIcon">Alternate Item Name</div>
                <h4 class="mdl-card__subInfo hideme"><?= $data['alternate_name'];?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input required class="mdl-textfield__input" type="text" id="item_edit_altname" value="<?= $data['alternate_name'];?>">
                  <label class="mdl-textfield__label" for="item_edit_altname">Alternate Item&rsquo;s Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-cell--1-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="categoryIcon">format_list_numbered</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="categoryIcon" >Category</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $this->config->item($data['category'],'category');?></h2>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                  <select id="item_edit_category" class="mdl-selectfield__select input">
                    <option selected="selected" value="<?= $data['category'];?>"><?= $this->config->item($data['category'],'category');?></option>
                    <option value="1">VEGETABLES</option>
                    <option value="2">ENGLISH VEGETABLES</option>
                    <option value="3">FRUITS</option>
                  </select>
                  <label class="mdl-selectfield__label" for="item_edit_category">Category</label>
                </div>  
              </div>
            </div>

            <div class="mdl-cellmdl-cell--4-col mdl-cell--2-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="subcategoryIcon">format_list_bulleted</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="subcategoryIcon" >Sub-Category</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $this->config->item($data['subcategory'],'sub_category');?></h2>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                  <select id="item_edit_sub_category" class="mdl-selectfield__select input ">
                    <option selected="selected" value="<?= $data['subcategory'];?>" >
                    <?= $this->config->item($data['subcategory'],'sub_category');?> </option>
                    <option value="1">DOMESTIC</option>
                    <option value="2">LEAFY</option>
                    <option value="3">OTP</option>
                    <option value="4">HERBS</option>
                    <option value="5">LETTUCES</option>
                    <option value="6">SPROUTS</option>
                    <option value="7">GREENS</option>
                    <option value="8">CONTINENTAL</option>
                    <option value="9">CHINESE &amp; THAI </option>
                    <option value="10">MINT</option>
                    <option value="11">MICROGREENS</option>
                    <option value="12">CHERRY TOMATOES</option>
                    <option value="13">REGULAR</option>  
                    <option value="14">LOCAL</option>  
                    <option value="15">IMPORTED</option>  
                  </select>
                  <label class="mdl-selectfield__label" for="item_edit_sub_category">Sub-Category</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-cell--1-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="shelfLifeIcon">hourglass_empty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="shelfLifeIcon" >Shelf-Life</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $data['shelf_life'];?> Days</h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="number" id="item_edit_shelf_life" value="<?= $data['shelf_life'];?>">
                  <label class="mdl-textfield__label" for="item_edit_shelf_life">Shelf-Life</label>
                </div>
              </div>
            </div>

             <div class="mdl-cell mdl-cell--4-col mdl-cell--2-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="unitIcon">fitness_center</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="unitIcon" >Measurement of Unit</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $this->config->item($data['uom'],'uom');?></h2>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                  <select id="item_edit_uom" name="" class="mdl-selectfield__select" required>
                    <option value="<?= $data['uom'];?>"><?= $this->config->item($data['uom'],'uom');?></option>
                    <option value="1">kgs</option>
                    <option value="2">bdl</option>
                    <option value="3">pkt</option>
                    <option value="4">dzn</option>
                    <option value="5">pcs</option>
                    <option value="6">box</option>
                  </select>
                  <label  class="mdl-selectfield__label" for="item_edit_uom" >Unit Of Measurement</label>
                  <span class="mdl-selectfield__error">Input is not a empty!</span>
                </div>
               
              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-cell--1-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details" id='edit_sku_append'>
                <span class="info_icon"><i class="material-icons" id="skuIcon">tune</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="skuIcon" >SKU</div>
                </span>
                <?php
                $sku_id;
                foreach($data['sku'] as $key => $value):
                  $sku_id = $key;
                  echo"<h2 class='mdl-card__subInfo hideme'>".$value."</h2>
                    <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden' style='width:40%;'>
                      <input required class='mdl-textfield__input item_edit_sku' type='number' id='edit_sku' value=".$value." sku_id=".$key.">
                        <a type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button-sku remove_sku'>
                          <i class='material-icons'>remove_circle</i>
                        </a> 
                      <label class='mdl-textfield__label' for='edit_sku'></label>
                    </div>&emsp;";
                endforeach;
              echo"</div>
              <a type='button' class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button-sku showme hidden' sku_id='".$sku_id."' id='edit_add_sku'>
                    <i class='material-icons'>add_circle</i>
                  </a>
            </div>";
            ?>

            <div class="mdl-cell mdl-cell--4-col mdl-cell--2-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="itemMasterIcon">local_activity</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemMasterIcon">Master Item</div>
                <h4 class="mdl-card__subInfo hideme"><?= get_item_by_id($data['master_item'])['item_name'];?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input input_search" type="text" id="item_master" value="<?= get_item_by_id($data['master_item'])['item_name'];?>">
                  <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                    <span class="mdl-chip__text"></span>
                    <button type="button" class="mdl-chip__action"><i class="material-icons">cancel</i></button>
                  </span>
                  <label class="mdl-textfield__label" for="item_master">Master Item</label>
                  <div class="suggestionClient hidden">
                    <ul class="suggestionListClient "></ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col mdl-cell--1-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="itemBrandIcon">local_offer</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemBrandIcon">Brand Name</div>
                <h4 class="mdl-card__subInfo hideme"><?= $data['brand_name'];?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="item_edit_brand" value="<?= $data['brand_name'];?>">
                  <label class="mdl-textfield__label" for="item_edit_brand">Brand Name</label>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--4-col mdl-cell--2-offset mdl-cell--6-col-tablet  mdl-cell--12-col-phone hidden">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="descIcon">description</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="descIcon" >Description</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $data['description'];?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="item_edit_description" value="<?= $data['description'];?>">
                  <label class="mdl-textfield__label" for="item_edit_description">Description</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--11-col mdl-cell--1-offset  mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="descIcon">description</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="descIcon" >Description</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $data['description'];?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="item_edit_description" value="<?= $data['description'];?>">
                  <label class="mdl-textfield__label" for="item_edit_description">Description</label>
                </div>
              </div>
            </div>

          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="<?php echo base_url().'assets/js/item.js';?>"></script>
