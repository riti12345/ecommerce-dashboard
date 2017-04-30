<?php
  $allocated_assets = get_all_assets_allocation();
  //echo print_array($allocated_assets);die;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Assets Allocation</span>
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
        <div class="breadcrumb"><a href="dashboard" class="is_selected">Home</a><a href="os_assets" class="is_selected">Assets</a><a href="os_assets" class="">Allocate</a></div>
      </div> 
    </div>
  </div>

  <div class="mdl-grid allocateAssets" sub-id ="">
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--4dp">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Assets's Name</th>
          <th>Assets's Unique Name</th>
          <th>Category</th>
          <th>subCategory</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="allocateAssets_tbody">
      <?php
        foreach($allocated_assets as $key) :
            echo "<tr class='allocateAssets_trow'>
              <td class='count'></td>
              <td>".$key['asset_tag_unique_name']."</td>
              <td>".$key['unicode']."</td>
              <td>".$key['catname']."</td>
              <td>".$key['subname']."</td>
              <td>
                <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label allocation' style='width:50%;''>
                  <select class='mdl-selectfield__select allocate_assets' assets-id=".$key['assetsid'].">
                   <option value='".$key['empid']."' select='selected'>".$key['empname']."</option>
                  </select>
                  <label class='mdl-selectfield__label' for=''>Assignee</label>
                </div>
                
              </td>
            </tr>";
        endforeach;
      ?>
      </tbody>
      <tfoot> 
        <!-- <tr role="row"> 
          <td>
          <td rowspan="1" colspan="4" style="width: 150px;">Total Price</td> 
          <td rowspan="1" colspan="1" style="text-align:left;">₹<input size="5" disabled class="back_none" value="" /></td>
          <td></td>
        </tr> --> 
      </tfoot>
    </table>
  </div>
</main>

<script src="<?php echo base_url().'assets/js/assets.js';?>"></script> 