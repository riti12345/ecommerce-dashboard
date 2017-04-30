<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Assets</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid assets">
    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="mdl-breadcrum">
        <div class="breadcrumb"><a href="dashboard" class="is_selected">Home</a><a href="os_assets" class="is_selected">Assets</a><a href="#" >Add Assets</a></div>
      </div> 
    </div>
  </div>
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__employeeInfo">
         <!--  <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button> -->
          <form action="#" id="assetsForm">
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " style="min-width: 20px;right:10%;float:right;position:fixed">Save</button>
            
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon_1"><i class="material-icons" id="employeeIcon">devices</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="employeeIcon">Assets Tag Name</div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input required="" class="mdl-textfield__input" type="text"  id="assets_name" placeholder="" tabindex="1">
                    <label class="mdl-textfield__label" for="assets_name">Assets Tag Name</label>
                  </div>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details info-category">
                  <div class="demo-avatar-dropdown">
                    <div id="category">
                      <span class="info_icon_1"><i class="material-icons" id="categoryIcon">format_list_numbered</i></span>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="categoryIcon">Category</div>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                        <input required="" class="mdl-textfield__input" type="text"  id="category_name" placeholder="" tabindex="2" autocomplete="off">
                        <label class="mdl-textfield__label" for="category_name">Category</label>
                      </div>
                    </div>
                    <div class="mdl-menu mdl-menu--bottom mdl-js-menu mdl-js-ripple-effect cat_div" for="category" style="width:350px;">
                      <!-- <a class="mdl-menu__item"><li value="Electronics" data-id="1" >Electronics<i class="material-icons edit_category_btn hidden ">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Furnitures" data-id="2">Furnitures <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Appliances" data-id="3">Appliances <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Crates" data-id="4">Crates <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Intangible Assets" data-id="5">Intangible Assets <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Stationary" data-id="6">Stationary <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Others" data-id="7">Others <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>-->
                      <a class="mdl-menu__item add_category"><li value="Add Category">Add Category<i class="material-icons add_category_btn">add</i></li></a> 
                    </div>
                  </div> 
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details info-sub_category">
                  <div class="demo-avatar-dropdown">
                    <div id="subcategory">
                      <span class="info_icon_1"><i class="material-icons" id="categoryIcon">format_list_numbered</i></span>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="categoryIcon">Sub Category</div>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                        <input required="" disabled="" class="mdl-textfield__input" type="text"  id="subcategory_name" placeholder="" tabindex="3" autocomplete="off">
                        <label class="mdl-textfield__label" for="subcategory_name">Sub Category</label>
                      </div>
                    </div>
                    <div class="mdl-menu mdl-menu--bottom mdl-js-menu mdl-js-ripple-effect sub_cat_div" for="subcategory" style="width:350px;">
<!--                  <a class="mdl-menu__item"><li value="Electronics" data-id="1" >Electronics<i class="material-icons edit_category_btn hidden ">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Furnitures" data-id="2">Furnitures <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Appliances" data-id="3">Appliances <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Crates" data-id="4">Crates <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Intangible Assets" data-id="5">Intangible Assets <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Stationary" data-id="6">Stationary <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a>
                      <a class="mdl-menu__item"><li value="Others" data-id="7">Others <i class="material-icons edit_category_btn hidden">mode_edit</i></li></a> -->
                      <a class="mdl-menu__item add_sub_category"><li value="Add Category">Add subCategory<i class="material-icons add_sub_category_btn">add</i></li></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details info-assets">
                  <span class="info_icon_1"><i class="material-icons" id="businessIcon">business</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="businessIcon" >Company name</div>
                  </span>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                    <input class="mdl-textfield__input" type="text"  id="company_name" placeholder="" tabindex="4">
                    <label class="mdl-textfield__label" for="company_name">Company name</label>
                  </div>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon_1"><i class="material-icons" id="brandIcon">location_city</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="brandIcon" >brand name</div>
                  </span>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                    <input  class="mdl-textfield__input" type="text"  id="brand_name" placeholder="" tabindex="5">
                    <label class="mdl-textfield__label" for="brand_name">brand name</label>
                  </div>
                </div>
              </div>
              
              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon_1"><i class="material-icons" id ="assetsIcon">account_balance</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="assetsIcon" >Price</div>
                  </span>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                    <input required="" class="mdl-textfield__input" type="number"  id="price" placeholder="" tabindex="6">
                    <label class="mdl-textfield__label" for="price">Price</label>
                  </div>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon_1"><i class="material-icons" id="dojIcon">date_range</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="dojIcon"> Date of Purchase</div>
                  </span>
                   <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input validate_date" type="text" id="datepicker1" placeholder="" tabindex="7">                           
                  <label class="mdl-textfield__label mdl-textfield__label" for="datepicker1">Date of purchase</label>
                </div>  
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet mdl-card-properties mdl-cell--12-col-phone">
                <div class="info_details" id="properties_append">
                  <span class="info_icon_1"><i class="material-icons" id="skuIcon">group_work</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="skuIcon" >Properties</div>
                  </span>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input required class="mdl-textfield__input properties_value" type="text" id="properties" placeholder="" tabindex="8">
                    <label class="mdl-textfield__label" for="properties">Properties</label>
                  </div>
                  <a type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button-properties">
                    <i class="material-icons">remove_circle</i>
                  </a> 
                </div>
                <a type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button-sku" id="add_properties">
                  <i class="material-icons">add_circle</i>
                </a>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon_1"><i class="material-icons" id="uniCodeIcon">location_city</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="uniCodeIcon" >Unique Code</div>
                  </span>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                    <input  class="mdl-textfield__input" type="text"  id="unique_code" placeholder="" tabindex="5">
                    <label class="mdl-textfield__label" for="unique_code">Unique Code</label>
                  </div>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon_1"><i class="material-icons" id="commentIcon">location_city</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="commentIcon" >Comment</div>
                  </span>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                    <input  class="mdl-textfield__input" type="text"  id="comment" placeholder="" tabindex="5">
                    <label class="mdl-textfield__label" for="comment">Comment</label>
                  </div>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon_2"><i class="material-icons" id="aadhaar_crd">subtitles</i>
                    <div class="mdl-tooltip mdl-tooltip--bottom" for="aadhaar_crd">Bill</div>
                  </span>
                  <input type="file" name="doc_bill" id="doc_bill" class="" style="display:none" tabindex="10">
                  <label style="width:56%" for="doc_bill" id="bill" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
                    <i class="material-icons">attach_file</i>Bill 
                    <div class="mdl-tooltip mdl-tooltip--top" for="bill">Choose File</div>
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
<dialog id="add_assets_dialog" class="mdl-dialog print_width" style="width:50%;height:250px;-webkit-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 299px 3333px rgba(0,0,0,0.75);">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
      </div>
      <div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet  mdl-cell--9-col-phone">
        <div class="edit_view hidden" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="edit_category" placeholder="">
            <label class="mdl-textfield__label" for="edit_category">Category</label>
          </div>
        </div>
        <div class="add_view hidden" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="add_category">
            <label class="mdl-textfield__label" for="add_category">Category</label>
          </div>
        </div>

        <div class="sub_cat_add_view hidden" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="add_sub_category">
            <label class="mdl-textfield__label" for="add_sub_category">Sub Category</label>
          </div>
        </div>

        <div class="sub_cat_edit_view hidden" style="margin:20px;">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
            <input class="mdl-textfield__input" type="text"  id="edit_sub_category">
            <label class="mdl-textfield__label" for="edit_sub_category">Sub Category</label>
          </div>
        </div>

      </div>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone addAssets_dialog_action_btn mdl-dialog__actions">
        <button id="edit_btn" class="edit_view hidden mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        EDIT CATEGORY
        </button>
        <button id="add_btn" class="add_view hidden mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        ADD CATEGORY
        </button>
        <button id="edit_sub_cat_btn" class="sub_cat_edit_view hidden mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        EDIT SUBCATEGORY
        </button>
        <button id="add_sub_cat_btn" class="sub_cat_add_view hidden mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        ADD SUBCATEGORY
        </button>
        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-dialog__actions" id="asset-dialog-close" style="background-color: #ea4335;color: #ffffff; float:right; height:45px;">
        CANCEL
        </button>
      </div>
    </div>
</dialog>
<script type="text/javascript" src="<?php echo base_url().'assets/js/assets.js';?>"></script>