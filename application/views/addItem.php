<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Item</span>
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

          <form action="#" id="itemForm">
         
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="min-width: 20px;right:2%;float:right;">Save</button>

          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="itemIcon">filter_1</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemIcon">Item Name</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input required=""  class="mdl-textfield__input" type="text" id="item_name" tabindex="1">
                  <label class="mdl-textfield__label" for="item_name">Item&rsquo;s Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet   mdl-cell--12-col-phone ">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="itemAltIcon">filter_2</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemAltIcon">Alternate Item Name</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="item_alternate_name" tabindex="2">
                  <label class="mdl-textfield__label" for="item_alternate_name">Alternate Item&rsquo;s Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="categoryIcon">format_list_numbered</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="categoryIcon" >Category</div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                  <select required="" id="item_category" class="mdl-selectfield__select input" tabindex="5">
                    <option selected="selected"></option>
                    <option value="1">Vegetables</option>
                    <option value="2">English Vegetables</option>
                    <option value="3">Fruits</option>
                  </select>
                  <label class="mdl-selectfield__label" for="item_category">Category</label>
                </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="subcategoryIcon">format_list_bulleted</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="subcategoryIcon" >Sub-Category</div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                  <select required="" id="item_sub_category" class="mdl-selectfield__select input " tabindex="6">
                    <option selected="selected"></option>
                    <option value="1">Domestic</option>
                    <option value="2">Leafy</option>
                    <option value="3">OTP</option>
                    <option value="4">Herbs</option>
                    <option value="5">Lettuces</option>
                    <option value="6">Sprouts</option>
                    <option value="7">Greens</option>
                    <option value="8">Continental</option>
                    <option value="9">Chinese &amp; Thai </option>
                    <option value="10">Mint</option>
                    <option value="11">Microgreens</option>
                    <option value="12">Cheery Tomatoes</option>
                    <option value="13">Regular</option>  
                    <option value="14">Local</option>  
                    <option value="15">Imported</option>  
                  </select>
                  <label class="mdl-selectfield__label" for="item_sub_category">Sub-Category</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="shelfLifeIcon">hourglass_empty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="shelfLifeIcon" >Shelf-Life</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input required="" class="mdl-textfield__input" type="number" id="item_shelf_life" tabindex="7" min="0" max="30">
                  <label class="mdl-textfield__label" for="item_shelf_life">Shelf-Life</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="unitIcon">fitness_center</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="unitIcon" >Measurement of Unit</div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                  <select required="" id="item_uom" class="mdl-selectfield__select input" tabindex="8">
                    <option selected="selected"></option>
                    <option value="1">kgs</option>
                    <option value="2">bdl</option>
                    <option value="3">pkt</option>
                    <option value="4">dzn</option>
                    <option value="5">pcs</option>
                    <option value="6">box</option>
                  </select>
                  <label class="mdl-selectfield__label" for="item_uom">Unit Of Measurement</label>
                </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details" id="sku_append">
                <span class="info_icon_1"><i class="material-icons" id="skuIcon">tune</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="skuIcon" >SKU</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:20%;">
                  <input required class="mdl-textfield__input sku_value" type="number" id="item_sku" value="1"tabindex="9">
                  <a type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button-sku">
                    <i class="material-icons">remove_circle</i>
                  </a>
                  <label class="mdl-textfield__label" for="item_sku">SKU</label>
                </div>
                  
              </div>
              <a type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button-sku" id="add_sku">
                  <i class="material-icons">add_circle</i>
              </a>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="itemMasterIcon">local_activity</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemMasterIcon">Master Item</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input input_search" type="text" id="item_master" tabindex="8">
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

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="itemBrandIcon">local_offer</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="itemBrandIcon">Brand Name</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="item_brand_name" tabindex="9">
                  <label class="mdl-textfield__label" for="item_brand_name">Brand Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="descIcon">description</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="descIcon" >Description</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="item_description" tabindex="10">
                  <label class="mdl-textfield__label" for="item_description">Description</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
            <div class="info_details">
              <span class="info_icon_2"><i class="material-icons" id="itemImgIcon">photo</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="itemImgIcon" >Add Item Image</div>
              </span>
              <input type="file" name="item_image" id="item_img" class="" style="display:none" tabindex="11">
                <label for="item_img" id="Imagelabel" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-file--custom" style="width:57%">
                  <i class="material-icons">photo_camera</i>&emsp;Image
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="Imagelabel">Choose Image</div>
                </label> 
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