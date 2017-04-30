<?php
  $client_id  = $this->input->get('id');
  if(isset($client_id)) {
    $client = get_all_clients($client_id);
    //echo print_array($client);die;
    $disp_client = json_decode($client,true);
    //echo print_array($disp_client[0]);die;
  }
  $perm_array  = [0,2,3];
  $permissions = get_session_data()['user']['permissions'];
?>
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?= $disp_client[0]['name']; ?>'s Information</span>
          <div class="mdl-layout-spacer"></div>
          
        </div>
      </header>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <div class="wrap mdl_card_2 mdl-shadow--4dp">
              <div class="mdl-card__clientInfo">
                
                <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
                  <i class="material-icons">arrow_back</i>
                </button>
                <?php if(in_array($permissions,$perm_array)):?>
                <div style="float:right; width: 120px;position: absolute;right: 22px;top: 44px;">
                  
                  <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored " id="c_edit" style="float:right;">
                    <i class="material-icons">mode_edit</i>
                    <div class="mdl-tooltip mdl-tooltip--top " for="c_edit" >Edit</div>
                  </button>

                  <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden" id="c_cancel" style="margin-left:1%">
                    <i class="material-icons">clear</i>
                    <div class="mdl-tooltip mdl-tooltip--top" for="c_cancel" >Cancel</div>
                  </button>

                  <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden" id="c_save" data-id="<?= $disp_client[0]['id']; ?>" style="margin-left:1%">
                    <i class="material-icons">save</i>
                    <div class="mdl-tooltip mdl-tooltip--top" for="c_save" >Save</div>
                  </button>
                </div>
                <?php endif ?>
                <form action="#" id="c_form">
                <span class="act_inact">
                 <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" id="statusIcon" for="c_status" style="float:right">
                  <input type="checkbox" id="c_status" value="yes" data-disabled="disabled" class="mdl-switch__input tog_disable" <?php if ($disp_client[0]['status']==1) echo "checked"; else echo ""; ?>>
                  <span class="mdl-switch__label"></span>
                 </label>
                 <div class="mdl-tooltip mdl-tooltip--top" for="statusIcon"><?php if ($disp_client[0]['status']==1) echo "Status : Active"; else echo "Status : In-Active"; ?></div>
                </span>

                <div class="mdl-grid">

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="clientIcon">account_circle</i></span>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="clientIcon">Client Name</div>
                      <h4 class="mdl-card__subInfo hideme"><?= $disp_client[0]['name']; ?></h4>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['name']; ?>" id="c_name">
                        <label class="mdl-textfield__label" for="c_name">Client Name</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="contactIcon">phone</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="contactIcon" >Contact No.</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['phone']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" pattern="[0-9]{10,10}?$" value="<?= $disp_client[0]['phone']; ?>" id="c_phone">
                        <label class="mdl-textfield__label" for="c_phone">Contact No.</label>
                        <span class="mdl-textfield__error">Invalid phone number!</span>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="emailIcon">email</i></span>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="emailIcon">Email</div>
                      <h4 class="mdl-card__subInfo hideme"><?= $disp_client[0]['email']; ?></h4>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['email']; ?>" id="c_email">
                        <label class="mdl-textfield__label" for="c_email">Email</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="brandIcon">star</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="brandIcon" >Brand Name</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['brand_name']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['brand_name']; ?>" id="c_brand_name">
                        <label class="mdl-textfield__label" for="c_brand_name">Brand Name</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="companyIcon">account_balance</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="companyIcon" >Company Name</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['company_name']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['company_name']; ?>" id="c_cmpName">
                        <label class="mdl-textfield__label" for="c_cmpName">Company Name</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="creditIcon">access_time</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="creditIcon" >Credit Period</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['credit_period']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input type="number" class="mdl-textfield__input" type="number" value="<?= $disp_client[0]['credit_period']; ?>" id="c_creditPeriod">
                        <label class="mdl-textfield__label" for="c_creditPeriod">Credit Period</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="creditLiIcon">timelapse</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="creditLiIcon" >Credit Limit</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['credit_limit']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input type="number" class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" value="<?= $disp_client[0]['credit_limit']; ?>" id="c_creditLimit">
                        <label class="mdl-textfield__label" for="c_creditLimit">Credit Limit</label>
                        <span class="mdl-textfield__error">Input is not a number!</span>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="gradeIcon">loyalty</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="gradeIcon"> Grade</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['grade'];?></h2>
                       <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                         <select id="c_grade" class="mdl-selectfield__select">
                           <option select="selected" ><?= $disp_client[0]['grade'];?></option>
                           <option>A</option>
                           <option>B</option>
                           <option>C</option>
                           <option>D</option>
                         </select>
                         <label class="mdl-selectfield__label" for="c_grade">Grade</label>
                       </div>  
                    </div>
                  </div>

                   <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="categoryIcon">format_list_numbered</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="categoryIcon"> Category</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $this->config->item($disp_client[0]['category'],'client_category');?></h2>
                       <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                         <select id="c_category" class="mdl-selectfield__select">
                           <option select="selected" value="<?= $disp_client[0]['category'];?>" ><?php echo ($this->config->item($disp_client[0]['category'],'client_category')); ?></option>
                           <option value="1"> Restaurant Singular</option>
                           <option value="2">Restaurant Chain</option>
                           <option value="3">Hotel 5 star</option>
                           <option value="4">Hotel 3 star</option>
                           <option value="5">Hotel, Other</option>
                           <option value="6">Retailer</option>
                           <option value="7">Vegetable Vendor</option>
                           <option value="8">Others</option>
                           <option value="9">Employee</option>
                         </select>
                         <label class="mdl-selectfield__label" for="c_category">category</label>
                       </div>  
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon">
                        <i class="material-icons" id="locationIcon">location_on</i>
                        <div class="mdl-tooltip mdl-tooltip--bottom" for="locationIcon" >Address</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['address']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['address']; ?>" id="c_address">
                        <label class="mdl-textfield__label" for="c_address">Address</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon">
                        <i class="material-icons" id="paymentIcon">payment</i>
                        <div class="mdl-tooltip mdl-tooltip--bottom" for="paymentIcon" >Payment Method </div>
                      </span>
                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect " for="c_cash">
                        <input type="checkbox" value="yes" id="c_cash" class="mdl-checkbox__input tog_disable" disabled <?php if (in_array(0, $disp_client[0]['mop'])) echo "checked"; else echo ""; ?>>
                        <span class="mdl-checkbox__label">Cash</span>
                      </label>
                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="c_cheque">
                        <input type="checkbox" value="yes" id="c_cheque" class="mdl-checkbox__input tog_disable" disabled <?php if (in_array(1, $disp_client[0]['mop'])) echo "checked"; else echo ""; ?>>
                        <span class="mdl-checkbox__label">Cheque</span>
                      </label>
                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="c_rtgs">
                        <input type="checkbox" value="yes" id="c_rtgs" class="mdl-checkbox__input tog_disable" disabled <?php if (in_array(2, $disp_client[0]['mop'])) echo "checked"; else echo ""; ?>>
                        <span class="mdl-checkbox__label">RTGS</span>
                      </label>
                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="c_neft">
                        <input type="checkbox" value="yes" id="c_neft" class="mdl-checkbox__input tog_disable" disabled <?php if (in_array(3, $disp_client[0]['mop'])) echo "checked"; else echo ""; ?>>
                        <span class="mdl-checkbox__label">NEFT</span>
                      </label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="pocNameIcon">perm_contact_calendar</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="pocNameIcon" >POC Name</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['poc_name']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['poc_name']; ?>" id="c_pocName">
                        <label class="mdl-textfield__label" for="c_pocName">POC Name</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="pocIcon">contact_phone</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="pocIcon" >POC Contact</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['poc_phone']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" pattern="[0-9]{10,10}?$" value="<?= $disp_client[0]['poc_phone']; ?>" id="c_poc_ph">
                        <label class="mdl-textfield__label" for="c_poc_ph">POC Contact</label>
                        <span class="mdl-textfield__error">Invalid phone number!</span>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="DesignationIcon">person_pin</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="DesignationIcon" >POC Designation</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['poc_designation']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['poc_designation']; ?>" id="c_poc_desig">
                        <label class="mdl-textfield__label" for="c_poc_desig">POC Designation</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="slotIcon">av_timer</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="slotIcon"> Delivery Slot</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?php echo ($this->config->item($disp_client[0]['delivery_slot'],'delivery_slot')); ?></h2>
                       <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                         <select id="c_delSlot" class="mdl-selectfield__select">
                           <option value="<?= $disp_client[0]['delivery_slot'];?>" select="selected" ><?php echo ($this->config->item($disp_client[0]['delivery_slot'],'delivery_slot')); ?></option>
                           <option value="0" >00 hrs - 03 hrs</option>
                           <option value="1" >03 hrs - 06 hrs</option>
                           <option value="2" >06 hrs - 09 hrs</option>
                           <option value="3" >09 hrs - 12 hrs</option>
                           <option value="4" >12 hrs - 15 hrs</option>
                           <option value="5" >15 hrs - 18 hrs</option>
                           <option value="6" >19 hrs - 21 hrs</option>
                           <option value="7" >22 hrs - 24 hrs</option>
                         </select>
                         <label class="mdl-selectfield__label" for="c_delSlot">Delivery Slot</label>
                       </div>  
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="delAddrIcon">place</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="delAddrIcon" >Delivery Address</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['delivery_address']; ?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['delivery_address']; ?>" id="c_delAddress">
                        <label class="mdl-textfield__label" for="c_delAddress">Delivery Address</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="cityIcon">local_offer</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="cityIcon">City</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme" id="c_city" data-value="1"><?php echo ($this->config->item($disp_client[0]['city_id'],'city')); ?>
                      </h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $this->config->item($disp_client[0]['city_id'],'city') ; ?>" id="c_city" readonly>
                        <label class="mdl-textfield__label" for="c_city">City</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="pincodeIcon">pin_drop</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="pincodeIcon">Pin Code</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['pincode'];?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input validate_pincode" type="text" pattern="[0-9]{6,6}?$" value="<?= $disp_client[0]['pincode']; ?>" id="c_pincode">
                        <label class="mdl-textfield__label" for="c_pincode">Pincode</label>
                        <span class="mdl-textfield__error">Invalid pincode!</span>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="latIcon">my_location</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="latIcon">Latitude</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['lat'];?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['lat']; ?>" id="c_latitude">
                        <label class="mdl-textfield__label" for="c_latitude">Latitude</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="longIcon">my_location</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="longIcon">Longitude</div>
                      </span>
                      <h2 class="mdl-card__subInfo hideme"><?= $disp_client[0]['long'];?></h2>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                        <input class="mdl-textfield__input" type="text" value="<?= $disp_client[0]['long']; ?>" id="c_longitude">
                        <label class="mdl-textfield__label" for="c_longitude">Longitude</label>
                      </div>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="pan_crd">photo</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="pan_crd">Pan Card</div>
                      </span>
                      <img src="<?= $disp_client[0]['files'][0]['doc_url'];?>" class="clientDoc" border="0" alt="" style="width:80%">
                    </div>
                    <input type="file" name="pan_card" id="c_pan" class="showme hidden" style="float:right">
                  </div>
                  
                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="licence_crd">photo</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="licence_crd">Licence</div>
                      </span>
                      <img src="<?= $disp_client[0]['files'][1]['doc_url'];?>" class="clientDoc" border="0" alt="" style="width:80%">
                    </div>
                    <input type="file" name="licence_card" id="c_licence" class="showme hidden" style="float:right">
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="aadhaar_crd">photo</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="aadhaar_crd">Aadhaar</div>
                      </span>
                      <img src="<?= $disp_client[0]['files'][2]['doc_url'];?>" class="clientDoc img-responsive" border="0" alt="" style="width:80%">
                    </div>
                    <input type="file" name="aadhaar_card" id="c_aadhaar" class="showme hidden" style="float:right">
                  </div>

                  <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                    <div class="info_details">
                      <span class="info_icon"><i class="material-icons" id="other_crd">photo</i>
                      <div class="mdl-tooltip mdl-tooltip--bottom" for="other_crd">Other Card</div>
                      </span>
                      <img src="<?= $disp_client[0]['files'][3]['doc_url'];?>" class="clientDoc img-responsive" border="0" alt="" style="width:80%">
                    </div>
                    <input type="file" name="other_card" id="c_other" class="showme hidden" style="float:right">
                  </div>

                </div>
               </form>
              </div>
            </div>
          </div>
        </div>
      </main>
<script type="text/javascript" src="<?php echo base_url().'assets/js/client.js';?>"></script>
   