<?php
$vehicle_id  = $this->input->get('vehicle_id');
  $vehicles = json_decode(get_all_transport($vehicle_id),true)[0];
  // echo print_array($vehicles);die;
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">

    <span class="mdl-layout-title">Vehicle's Details</span>
    <div class="mdl-layout-spacer"></div>
   
    
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100" onload = "myMap()" >
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__clientInfo">
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>

          <div style="float:right; width: 120px;position: absolute;right: 22px;top: 44px;">
            
            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored " id="vehicle_edit" style="float:right;">
              <div class="mdl-tooltip mdl-tooltip--top" for="vehicle_edit" >Edit</div>
              <i class="material-icons">mode_edit</i>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect showme hidden" id="vehicle_cancel" data-id="<?= $vehicles['id']; ?>" style="margin-left:1%">
              <div class="mdl-tooltip mdl-tooltip--top" for="vehicle_cancel" >Cancel</div>
              <i class="material-icons">clear</i>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect showme hidden" id="vehicle_save" data-id="<?= $vehicles['id']; ?>" style="margin-left:1%">
              <div class="mdl-tooltip mdl-tooltip--top" for="vehicle_save" >Save</div>
              <i class="material-icons">save</i>
            </button>
          </div>
          <form action="#" id="vehicle_form">
           
           <span class="act_inact" >
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" id="statusIcon" for="vehicle_status" style="float:right">
              <input type="checkbox" id="vehicle_status" value="yes" data-disabled="disabled" class="mdl-switch__input tog_disable" <?php if ($vehicles['status']==1) echo "checked"; else echo ""; ?>>
              <span class="mdl-switch__label"></span>
            </label>
            <div class="mdl-tooltip mdl-tooltip--top" for="statusIcon"><?php if ($vehicles['status']==1) echo "Status : Active"; else echo "Status : In-Active"; ?></div>
           </span>
           
           <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="vehicle_noIcon">format_list_numbered</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_noIcon">Registration No.</div>
                <h4 class="mdl-card__subInfo hideme"><?= $vehicles ['reg_no'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="reg_no" value="<?= $vehicles['reg_no'] ;?>">
                  <label class="mdl-textfield__label" for="reg_no">Registration No.</label>
                </div>
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="vehicle_ownerIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_ownerIcon">Owner Name</div>
                <h4 class="mdl-card__subInfo hideme"><?= $vehicles ['owner_name'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="owner_name" value="<?= $vehicles['owner_name'] ;?>">
                  <label class="mdl-textfield__label" for="owner_name">Owner Name</label>
                </div>
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="vehicle_licenceIcon">person_pin</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_licenceIcon">Licence No.</div>
                <h4 class="mdl-card__subInfo hideme"><?= $vehicles ['licence_no'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="licence_no" value="<?= $vehicles['licence_no'] ;?>">
                  <label class="mdl-textfield__label" for="licence_no">Licence No.</label>
                </div>
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="vehicle_ownerIcon">phone</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_ownerIcon">Contact No.</div>
                <h4 class="mdl-card__subInfo hideme"><?= $vehicles ['contact'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="contact" value="<?= $vehicles['contact'] ;?>">
                  <label class="mdl-textfield__label" for="contact">Contact No.</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="vehicle_brandIcon">local_offer</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_brandIcon">Vehicle Brand</div>
                <h4 class="mdl-card__subInfo hideme"><?= $vehicles ['vehicle_brand'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="vehicle_brand" value="<?= $vehicles['vehicle_brand'] ;?>">
                  <label class="mdl-textfield__label" for="vehicle_brand">Vehicle Brand</label>
                </div>
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="vehicle_modelIcon">whatshot</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="vehicle_modelIcon">Vehicle Model</div>
                <h4 class="mdl-card__subInfo hideme"><?= $vehicles ['vehicle_model'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="vehicle_model" value="<?= $vehicles['vehicle_model'] ;?>">
                  <label class="mdl-textfield__label" for="vehicle_model">Vehicle Model</label>
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

<script src="<?php echo base_url().'assets/js/vehicle.js';?>"></script>