<?php
  $sub_id  = $this->input->get('subCategory_id');
  $assets = get_all_assets($sub_id);
  //echo print_array($assets);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Company's Assets</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="asset_subcategory_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="asset_subcategory_info_search" autofocus placeholder="Search.." autocomplete='off'>
        <label class="mdl-textfield__label" for="asset_subcategory_info_search"></label>
      </div>
    </div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid assets">
    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet  mdl-cell--12-col-phone"></div>
    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
      <div class="mdl-breadcrum">
        <div class="breadcrumb"><a href="dashboard" class="is_selected">Home</a><a href="os_assets" class="is_selected">Assets</a><a href='/os/assetsSubCategory?category_id=<?=$assets[0]['cat_id'];?>' class="is_selected"><?=$assets[0]['cat_name'];?></a><a href='/os/assetsSubCategoryInfo?subCategory_id=<?=$assets[0]['sub_cat_id'];?>' class="is_selected"><?=$assets[0]['sub_name'];?></a><a href="#">Dashboard</a></div>
      </div> 
    </div>
  </div>
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="mdl-grid assets_subcategoryInfo" sub-id ="<?=$sub_id;?>">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--4dp">
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th>Assets's Unique Name</th>
              <th>Brand</th>
              <th>Unique Code</th>
              <th>Properties</th>
              <th>Price</th>
              <th>Date Of Purchase</th>
              <th hidden>Doc</th>
              <th >Comments</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="subcategoryInfo_tbody">
          <?php
            foreach($assets as $key) :
            echo "<tr class='allocateAssets_trow'>
              <td class='count'></td>
              <td class='show_class".$key['id']."'>".$key['asset_tag_unique_name']."</td>
              <td class='hidden  hide_class".$key['id']."'>
                <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style='width:60%;''>
                  <input class='mdl-textfield__input' type='text' value=".$key['asset_tag_unique_name']." id='Unique_name'>
                </div>
              </td>
              <td class='show_class".$key['id']."'>".$key['brand_name']."</td>
              <td class='hidden  hide_class".$key['id']."'>
                <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style='width:60%;'>
                  <input class='mdl-textfield__input' type='text' value =".$key['brand_name']." id='brand_name'>
                </div>
              </td>
              <td class='show_class".$key['id']."'>".$key['unique_code']."</td>
              <td class=' hidden  hide_class".$key['id']."'>
                <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style='width:60%;'>
                  <input class='mdl-textfield__input' value =".$key['unique_code']." type='text' id='unique_code'>
                </div>
              </td>
              <td class='show_class".$key['id']."'>".$key['prop_name']."</td>
              <td class=' hidden  hide_class".$key['id']."'>
                <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style='width:60%;'>
                  <input class='mdl-textfield__input' type='text' value=".$key['prop_name']." id='properties'>
                </div>
              </td>
              <td class='show_class".$key['id']."'>".$key['price']."</td>
              <td class=' hidden  hide_class".$key['id']."'>
                <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style='width:60%;'>
                  <input class='mdl-textfield__input' value =".$key['price']." type='text' pattern='-?[0-9]*(\.[0-9]+)?' id='price'>
                  <span class='mdl-textfield__error'>Input is not a number!</span>
                </div>
              </td>
              <td>".$key['date_of_purchase']."</td>
              <td hidden>
                <div class='info_details'>
                  <img src='' class='clientDoc img-responsive' border='0' alt=''>
                </div>
                <input type='file' name='doc_bill' id='doc_bill' class='showme'>
              </td>
              <td class='show_class".$key['id']."'>".$key['Comments']."</td>
              <td class=' hidden hide_class".$key['id']."'>
                <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style='width:60%;'>
                  <input class='mdl-textfield__input' type='text' value=".$key['Comments']." pattern='-?[0-9]*(\.[0-9]+)?' id='comments'>
                </div>
              </td>
              <td>
                <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect assets-info-row-edit show_class".$key['id']."' data-id=".$key['id']." prop-id=".$key['prop_id']." assets-id=".$key['assets_id']." sub-id=".$key['sub_cat_id']."><i class='material-icons'>edit</i></a>
                <a  class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect assets-info-row-done hide_class".$key['id']." hidden' data-id=".$key['id']." prop-id=".$key['prop_id']." assets-id=".$key['assets_id']." sub-id=".$key['sub_cat_id']."><i class='material-icons save_btn'>check_circle</i></a>  
                <a  class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect assets-info-row-cancel hide_class".$key['id']." hidden' data-id=".$key['id']." prop-id=".$key['prop_id']." assets-id=".$key['assets_id']." sub-id=".$key['sub_cat_id']."><i class='material-icons cancel_btn'>cancel</i></a>  
                <a class='mdl-button mdl-js-button mdl-button--icon order_delete assets-info-row-delete show_class".$key['id']."' data-id=".$key['id']." prop-id=".$key['prop_id']." assets-id=".$key['assets_id']." sub-id=".$key['sub_cat_id']."><i class='material-icons'>delete</i></a>
              </td>
            </tr>";
  endforeach; 
?>
          </tbody>
          <tfoot> 
            <!-- <tr role='row'> 
              <td>
              <td rowspan='1' colspan='4' style='width: 150px;'>Total Price</td> 
              <td rowspan='1' colspan='1' style='text-align:left;'>₹<input size='5' disabled class='back_none' value='' /></td>
              <td></td>
            </tr> --> 
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</main>

<script src="<?php echo base_url().'assets/js/assets.js';?>"></script> 