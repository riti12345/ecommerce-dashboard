<?php
  $vendor_id  = $this->input->get('id');
  if(isset($vendor_id)) {
    $vendor = get_all_vendors($vendor_id);
    // echo print_array($vendor);die;
    $disp_vendor = json_decode($vendor,true);
    // echo print_array($disp_vendor[0]);die;
    // if(isset($disp_vendor[0]['speciality'])){
    //   $decode_speciality = json_decode($disp_vendor[0]['speciality'],true);
      // if(isset($decode_speciality['item_id']) && !empty($decode_speciality['item_id'])){
      //   $speciality = get_item_by_id($decode_speciality['item_id'])['item_name'];
      //   $spec_type = 0;
      // }
      // if(isset($decode_speciality['category'])){
      //   $speciality = $this->config->item($decode_speciality['category'],'category');
      //   $spec_type = 1;
      // }
      // if(isset($decode_speciality['sub_category']) && !empty($decode_speciality['sub_category'])){
      //   $speciality = $this->config->item($decode_speciality['sub_category'],'sub_category');
      //   $spec_type = 2;
      // }
    // }
// echo print_array($speciality);die;
      $perm_array = [0,2,3];
      $permissions = get_session_data()['user']['permissions'];
  }
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">

    <span class="mdl-layout-title"><?= $disp_vendor[0]['name']; ?>'s Details</span>
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
          <div style="float:right; width: 120px;position: absolute;right: 22px;top: 44px;">
            
            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored " id="v_edit" style="float:right;">
              <div class="mdl-tooltip mdl-tooltip--top" for="v_edit" >Edit</div>
              <i class="material-icons">mode_edit</i>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden" id="v_cancel" data-id="<?= $disp_vendor[0]['id']; ?>" style="margin-left:1%">
              <div class="mdl-tooltip mdl-tooltip--top" for="v_cancel" >Cancel</div>
              <i class="material-icons">clear</i>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden" id="v_save" data-id="<?= $disp_vendor[0]['id']; ?>" style="margin-left:1%">
              <div class="mdl-tooltip mdl-tooltip--top" for="v_save" >Save</div>
              <i class="material-icons">save</i>
            </button>
          </div>
          <?php endif ?>

          <form action="#" id="v_form">
          <span class="act_inact">
           <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" id="statusIcon" for="v_status" style="float:right">
            <input type="checkbox" id="v_status" value="yes" data-disabled="disabled" class="mdl-switch__input tog_disable" <?php if ($disp_vendor[0]['status']==1) echo "checked"; else echo ""; ?>>
            <span class="mdl-switch__label"></span>
           </label>
           <div class="mdl-tooltip mdl-tooltip--top" for="statusIcon"><?php if ($disp_vendor[0]['status']==1) echo "Status : Active"; else echo "Status : In-Active"; ?></div>
          </span>
          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="clientIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="clientIcon">Vendor Name</div>
                <h4 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['name'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_name" value="<?= $disp_vendor[0]['name'] ;?>">
                  <label class="mdl-textfield__label" for="v_name">Vendor&rsquo;s Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="contactIcon">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="contactIcon" >Contact No.</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['phone'] ;?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_phone" pattern="[0-9]{10,10}?" value="<?= $disp_vendor[0]['phone'] ;?>">
                  <label class="mdl-textfield__label" for="v_phone">Contact No.</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone showme hidden">
              <div class="info_details" style="padding: 45px 0px 0px 0px;">
                <span class="" style="margin: 0px 40px 0px 0px;">
                  <i class="material-icons" id="specSelectIcon">whatshot</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="specSelectIcon" >Speciality </div>
                </span>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="vendor_spec_item">
                  <input type="radio" id="vendor_spec_item" name="speciality" class="mdl-radio__button" <?php if(isset($disp_vendor[0]['speciality']['item_id']) && !empty($disp_vendor[0]['speciality']['item_id'])){echo "checked";} ?>>
                  <span class="mdl-radio__label">Item</span>
                </label>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="vendor_spec_category">
                  <input type="radio" id="vendor_spec_category" name="speciality" class="mdl-radio__button" <?php if(isset($disp_vendor[0]['speciality']['category']) && !empty($disp_vendor[0]['speciality']['category'])){echo "checked";} ?>>
                  <span class="mdl-radio__label">Category</span>
                </label>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="vendor_spec_sub_cat">
                  <input type="radio" id="vendor_spec_sub_cat" name="speciality" class="mdl-radio__button" <?php if(isset($disp_vendor[0]['speciality']['sub_category']) && !empty($disp_vendor[0]['speciality']['sub_category'])){echo "checked";} ?>>
                  <span class="mdl-radio__label">Sub-Category</span>
                </label>
              </div>
            </div>
            <!--Speciality as Item-->
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone item_show <?php if(isset($disp_vendor[0]['speciality']['item_id']) && empty($disp_vendor[0]['speciality']['item_id'])){echo "hidden";} ?>">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="brandIcon">loyalty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="brandIcon" >Speciality </div>
                </span>
                <h2 class="mdl-card__subInfo hideme">
                  <?php if(isset($disp_vendor[0]['speciality']['item_id']) && !empty($disp_vendor[0]['speciality']['item_id'])){ echo $disp_vendor[0]['speciality']['item_name'];} ;?>
                </h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input input_search" type="text" id="v_spec_item" value="
                  <?php if(isset($disp_vendor[0]['speciality']['item_id']) && !empty($disp_vendor[0]['speciality']['item_id'])){ echo $disp_vendor[0]['speciality']['item_name'];}else{echo "";} ;?>" item-id="<?= $disp_vendor[0]['speciality']['item_id'];?>">
                  <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                    <span class="mdl-chip__text"></span>
                    <button type="button" class="mdl-chip__action">
                    <i class="material-icons">cancel</i></button>
                  </span>
                  <label class="mdl-textfield__label" for="v_spec_item">Speciality</label>
                  <div class="suggestionClient hidden">
                     <ul class="suggestionListClient "></ul>
                  </div>
                </div>
              </div>
            </div>
            <!--Speciality as Category-->
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone category_show <?php if(isset($disp_vendor[0]['speciality']['category']) && empty($disp_vendor[0]['speciality']['category'])){echo "hidden";} ?>">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="cIcon">loyalty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="cIcon" >Category </div>
                </span>
                <h2 class="mdl-card__subInfo hideme">
                  <?php if(isset($disp_vendor[0]['speciality']['category']) && !empty($disp_vendor[0]['speciality']['category'])){ echo $this->config->item($disp_vendor[0]['speciality']['category'],'category'); }?>
                </h2>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                  <select id="v_spec_cat" class="mdl-selectfield__select input">
                    <option selected="selected" disabled value="<?php if(isset($disp_vendor[0]['speciality']['category']) && !empty($disp_vendor[0]['speciality']['category'])){ echo $disp_vendor[0]['speciality']['category'];} ?>">
                      <?php if(isset($disp_vendor[0]['speciality']['category']) && !empty($disp_vendor[0]['speciality']['category'])){ echo $this->config->item($disp_vendor[0]['speciality']['category'],'category'); }?>
                    </option>
                    <option value="1">Vegetables</option>
                    <option value="2">English Vegetables</option>
                    <option value="3">Fruits</option>
                  </select>
                  <label class="mdl-selectfield__label" for="v_spec_cat">Speciality as Category</label>
                </div>
              </div>
            </div>
            <!--Speciality as Sub-Category-->
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone sub_cat_show <?php if(isset($disp_vendor[0]['speciality']['sub_category']) && empty($disp_vendor[0]['speciality']['sub_category'])){echo "hidden";} ?>">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="sIcon">loyalty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="sIcon" >Sub-Category </div>
                </span>
                <h2 class="mdl-card__subInfo hideme">
                  <?php if(isset($disp_vendor[0]['speciality']['sub_category']) && !empty($disp_vendor[0]['speciality']['sub_category'])){ echo $this->config->item($disp_vendor[0]['speciality']['sub_category'],'sub_category');} ?>
                </h2>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                  <select id="v_spec_sub_cat" class="mdl-selectfield__select input ">
                    <option selected="selected" value="<?php if(isset($disp_vendor[0]['speciality']['sub_category']) && !empty($disp_vendor[0]['speciality']['sub_category'])){ echo $disp_vendor[0]['speciality']['sub_category']; }?>">
                      <?php if(isset($disp_vendor[0]['speciality']['sub_category']) && !empty($disp_vendor[0]['speciality']['sub_category'])){ echo $this->config->item($disp_vendor[0]['speciality']['sub_category'],'sub_category'); }?>
                    </option>
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
                  <label class="mdl-selectfield__label" for="v_spec_sub_cat">Sub-Category</label>
                </div>
              </div>
            </div>            

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="companyIcon">account_balance</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="companyIcon" >Company Name</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['company_name'] ;?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_cmp_name" value="<?= $disp_vendor[0]['company_name'] ;?>">
                  <label class="mdl-textfield__label" for="v_cmp_name">Company Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="creditIcon">access_time</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="creditIcon" >Credit Period</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['credit_cycle'] ;?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="number" id="v_credit_cycle" value="<?= $disp_vendor[0]['credit_cycle'] ;?>">
                  <label class="mdl-textfield__label" for="v_credit_cycle">Credit Period</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="creditLiIcon">timelapse</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="creditLiIcon" >Credit Limit</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['credit_limit'] ;?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_credit_limit" pattern="-?[0-9]*(\.[0-9]+)?" value="<?= $disp_vendor[0]['credit_limit'] ;?>">
                  <label class="mdl-textfield__label" for="v_credit_limit">Credit Limit</label>
                  <span class="mdl-textfield__error">Input is not a number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon">
                  <i class="material-icons" id="locationIcon">location_on</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="locationIcon" >Address</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['address'] ;?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_address" value="<?= $disp_vendor[0]['address'] ;?>">
                  <label class="mdl-textfield__label" for="v_address">Address</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon">
                  <i class="material-icons" id="paymentIcon">payment</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="paymentIcon" >Payment Method </div>
                </span>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect " for="v_cash">
                  <input type="checkbox" value="yes" disabled id="v_cash" class="mdl-checkbox__input tog_disable" 
                  <?php if (in_array(0, $disp_vendor[0]['mop'])) echo "checked"; else echo ""; ?> >
                  <span class="mdl-checkbox__label">Cash</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="v_cheque">
                  <input type="checkbox" value="yes" disabled id="v_cheque" class="mdl-checkbox__input tog_disable" 
                  <?php if (in_array(1, $disp_vendor[0]['mop'])) echo "checked"; else echo ""; ?>>
                  <span class="mdl-checkbox__label">Cheque</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="v_rtgs">
                  <input type="checkbox" value="yes" disabled id="v_rtgs" class="mdl-checkbox__input tog_disable" 
                  <?php if (in_array(2, $disp_vendor[0]['mop'])) echo "checked"; else echo ""; ?>>
                  <span class="mdl-checkbox__label">RTGS</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="v_neft">
                  <input type="checkbox" value="yes" disabled id="v_neft" class="mdl-checkbox__input tog_disable" 
                  <?php if (in_array(3, $disp_vendor[0]['mop'])) echo "checked"; else echo ""; ?>>
                  <span class="mdl-checkbox__label">NEFT</span>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="acc_no">filter_9_plus</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="acc_no">Account No.</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['account_no']; ?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_account_no" pattern="[0-9]{9,18}?" value="<?= $disp_vendor[0]['account_no'] ;?>">
                  <label class="mdl-textfield__label" for="v_account_no">Account No.</label>
                  <span class="mdl-textfield__error">Invalid account number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="ifsc">priority_high</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="ifsc">IFSC Code</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['ifsc']; ?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_ifsc" value="<?= $disp_vendor[0]['ifsc'] ;?>">
                  <label class="mdl-textfield__label" for="v_ifsc">IFSC Code</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="chequeNameIcon">chrome_reader_mode</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="chequeNameIcon">Cheque Name</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['cheque_name']; ?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_cheque_name" value="<?= $disp_vendor[0]['cheque_name'] ;?>">
                  <label class="mdl-textfield__label" for="v_cheque_name">Cheque Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="cityIcon">local_offer</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="cityIcon">City</div>
                </span>
                <h2 class="mdl-card__subInfo" data-id="1" id="v_city"><?php if($disp_vendor[0]['city_id']==1)echo "Mumbai";?></h2>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="stateIcon">place</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="stateIcon">State</div>
                </span>
                <h2 class="mdl-card__subInfo" data-id="0" id="v_state"><?php if($disp_vendor[0]['state']==0)echo "Maharashtra";?></h2>
              </div>
            </div>
            
             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="pincodeIcon">pin_drop</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pincodeIcon">Pincode</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['pincode']; ?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_pincode" pattern="[0-9]{6,6}?" value="<?= $disp_vendor[0]['pincode'] ;?>">
                  <label class="mdl-textfield__label" for="v_pincode">Pincode</label>
                  <span class="mdl-textfield__error">Invalid pincode!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="emailIcon">email</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emailIcon">Email</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"><?= $disp_vendor[0]['email']; ?></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="v_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?= $disp_vendor[0]['email'] ;?>">
                  <label class="mdl-textfield__label" for="v_email">Email</label>
                  <span class="mdl-textfield__error">Invalid Email!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="altVendor">people</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="altVendor">Alternate Vendor</div>
                </span>
                <?php 
                if(isset($disp_vendor[0]['alt_vendors'])){
                foreach($disp_vendor[0]['alt_vendors'] as $key => $value ):
                if(!empty($disp_vendor[0]['alt_vendors'][$key])){
                    echo "<h2 class='mdl-card__subInfo hideme'>".$disp_vendor[0]['alt_vendors'][$key]."</h2>&emsp;
                          <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden'>
                            <input class='mdl-textfield__input v_alt_vendor' type='text' id='alt_Vname' value=".$disp_vendor[0]['alt_vendors'][$key].">
                            <label class='mdl-textfield__label' for='alt_Vname'>Alernate Vendor Name</label>
                          </div>";
                }else{
                    echo "<h2 class='mdl-card__subInfo hideme'>No Alernate Name</h2>";
                 }

                 endforeach;
                }
                 echo"<a id='addinput' class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-button--colored showme hidden'><i class='material-icons'>add_circle</i></a> <div class='mdl-tooltip mdl-tooltip--bottom' for='addinput'>Add Alternate Vendor</div><span class='appendme'></span>";
                 ?>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="pan_crd">photo</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pan_crd">Pan Card</div>
                </span>
                <img src="<?= $disp_vendor[0]['file'][0]['doc_url'];?>" class="clientDoc" border="0" alt="" style="width:80%">
              </div>
              <input type="file" id="v_pancard" class="showme hidden" style="float:right" />
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="licence_crd">photo</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="licence_crd">Licence</div>
                </span>
                <img src="<?= $disp_vendor[0]['file'][1]['doc_url'];?>" class="clientDoc" border="0" alt="" style="width:80%">
              </div>
              <input type="file" id="v_licence" class="showme hidden" style="float:right" />
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="aadhaar_crd">photo</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="aadhaar_crd">Aadhaar</div>
                </span>
                <img src="<?= $disp_vendor[0]['file'][2]['doc_url'];?>" class="clientDoc img-responsive" border="0" alt="" style="width:80%">
              </div>
              <input type="file" id="v_aadhaar" class="showme hidden" style="float:right" />
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="other_crd">photo</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="other_crd">Other Card</div>
                </span>
                <img src="<?= $disp_vendor[0]['file'][3]['doc_url'];?>" class="clientDoc img-responsive" border="0" alt="" style="width:80%">
              </div>
              <input type="file" id="v_other" class="showme hidden" style="float:right" />
            </div>

          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript" src="<?php echo base_url().'assets/js/vendor.js';?>"></script>
