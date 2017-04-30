<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Vendor </span>
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

          <form action="#" id="vendorForm" novalidate="">

          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " style="min-width: 20px;right:5%;float:right;position:fixed">Save</button>
          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="clientIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="clientIcon">Vendor Name</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input  class="mdl-textfield__input" type="text" id="vendor_name" tabindex = "1">
                  <label class="mdl-textfield__label" for="vendor_name">Vendor&rsquo;s Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="contactIcon">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="contactIcon" >Contact No.</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input  class="mdl-textfield__input" type="text" pattern="[0-9]{10,10}?$" id="vendor_phone" tabindex = "2">
                  <label class="mdl-textfield__label" for="vendor_phone">Contact No.</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details" style="padding: 45px 0px 0px 0px;">
                <span class="" style="margin: 0px 40px 0px 0px;">
                  <i class="material-icons" id="specSelectIcon">whatshot</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="specSelectIcon" >Speciality </div>
                </span>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="vendor_spec_item">
                  <input type="radio" id="vendor_spec_item" name="speciality" class="mdl-radio__button"tabindex = "3">
                  <span class="mdl-radio__label">Item</span>
                </label>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="vendor_spec_category">
                  <input type="radio" id="vendor_spec_category" name="speciality" class="mdl-radio__button">
                  <span class="mdl-radio__label">Category</span>
                </label>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="vendor_spec_sub_cat">
                  <input type="radio" id="vendor_spec_sub_cat" name="speciality" class="mdl-radio__button">
                  <span class="mdl-radio__label">Sub-Category</span>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone item_show hidden">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="iIcon">loyalty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="iIcon" >Item </div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input input_search" type="text" id="vendor_item" tabindex = "4">
                   <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                      <span class="mdl-chip__text"></span>
                      <button type="button" class="mdl-chip__action">
                      <i class="material-icons">cancel</i></button>
                    </span>
                  <label class="mdl-textfield__label" for="vendor_item">Speciality as Item</label>
                  <div class="suggestionClient hidden">
                     <ul class="suggestionListClient"></ul>
                  </div>  
                </div>
                <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone category_show hidden">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="cIcon">loyalty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="cIcon" >Category </div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                  <select id="vendor_cat" class="mdl-selectfield__select input">
                    <option selected="selected"></option>
                    <option value="1">Vegetables</option>
                    <option value="2">English Vegetables</option>
                    <option value="3">Fruits</option>
                  </select>
                  <label class="mdl-selectfield__label" for="vendor_cat">Speciality as Category</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone sub_cat_show hidden">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="sIcon">loyalty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="sIcon" >Sub-Category </div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                  <select id="vendor_sub_cat" class="mdl-selectfield__select input ">
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
                  <label class="mdl-selectfield__label" for="vendor_sub_cat">Sub-Category</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="companyIcon">account_balance</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="companyIcon" >Company Name</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input  class="mdl-textfield__input" type="text" id="vendor_cmp_name" tabindex = "5">
                  <label class="mdl-textfield__label" for="vendor_cmp_name">Company Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="creditIcon">access_time</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="creditIcon" >Credit Period</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="number" id="vendor_credit_cycle" tabindex = "6">
                  <label class="mdl-textfield__label" for="vendor_credit_cycle">Credit Period</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="creditLiIcon">timelapse</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="creditLiIcon" >Credit Limit</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text" id="vendor_credit_limit" pattern="-?[0-9]*(\.[0-9]+)?"tabindex = "7">
                  <label class="mdl-textfield__label" for="vendor_credit_limit">Credit Limit</label>
                  <span class="mdl-textfield__error">Input is not a number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1">
                  <i class="material-icons" id="locationIcon">location_on</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="locationIcon" >Address</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input  class="mdl-textfield__input" type="text" id="vendor_address" tabindex = "8">
                  <label class="mdl-textfield__label" for="vendor_address">Address</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details" style="padding: 45px 0px 0px 0px;">
                <span class="" style="margin: 0px 40px 0px 0px;">
                  <i class="material-icons" id="paymentIcon">payment</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="paymentIcon" >Payment Method </div>
                </span>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect " for="vendor_cash">
                  <input type="checkbox" value="yes" id="vendor_cash" class="mdl-checkbox__input" tabindex = "9">
                  <span class="mdl-checkbox__label">Cash</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="vendor_cheque">
                  <input type="checkbox" value="yes" id="vendor_cheque" class="mdl-checkbox__input">
                  <span class="mdl-checkbox__label">Cheque</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="vendor_rtgs">
                  <input type="checkbox" value="yes" id="vendor_rtgs" class="mdl-checkbox__input">
                  <span class="mdl-checkbox__label">RTGS</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="vendor_neft">
                  <input type="checkbox" value="yes" id="vendor_neft" class="mdl-checkbox__input">
                  <span class="mdl-checkbox__label">NEFT</span>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="acc_no">filter_9_plus</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="acc_no">Account No.</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text" pattern="[0-9]{9,18}?" id="vendor_account_no" tabindex = "10">
                  <label class="mdl-textfield__label" for="vendor_account_no">Account No.</label>
                  <span class="mdl-textfield__error">Invalid account number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="ifsc">priority_high</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="ifsc">IFSC Code</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text" id="vendor_ifsc" tabindex = "11">
                  <label class="mdl-textfield__label" for="vendor_ifsc">IFSC Code</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="chequeNameIcon">chrome_reader_mode</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="chequeNameIcon">Cheque Name</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text" id="vendor_cheque_name" tabindex = "12">
                  <label class="mdl-textfield__label" for="vendor_cheque_name">Cheque Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="cityIcon">local_offer</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="cityIcon">City</div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                    <select  class="mdl-selectfield__select" id="vendor_city">
                      <option select="selected"></option>
                      <option value="1">Mumbai</option>
                    </select>
                    <label class="mdl-selectfield__label" for="vendor_city">City</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="stateIcon">place</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="stateIcon">State</div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                    <select  class="mdl-selectfield__select" id="vendor_state">
                      <option select="selected"></option>
                      <option value="0">Maharashtra</option>
                    </select>
                    <label class="mdl-selectfield__label" for="vendor_state">State</label>
                </div>
              </div>
            </div>
            
             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="pincodeIcon">pin_drop</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pincodeIcon">Pincode</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input  class="mdl-textfield__input" type="text" pattern="[0-9]{6,6}?$" id="vendor_pincode" tabindex = "13">
                  <label class="mdl-textfield__label" for="vendor_pincode">Pincode</label>
                  <span class="mdl-textfield__error">Invalid pincode!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="emailIcon">email</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emailIcon">Email</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="email" id="vendor_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" tabindex = "14">
                  <label class="mdl-textfield__label" for="vendor_email">Email</label>
                  <span class="mdl-textfield__error">Invalid Email!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="altVendor">people</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="altVendor">Alternate Vendor</div>
                </span>
                <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label '>
                  <input class='mdl-textfield__input v_alt_vendor' type='text' id='alt_Vname' tabindex = "15">
                  <label class='mdl-textfield__label' for='alt_Vname'>Alernate Vendor Name</label>
                </div>
                <a id='addinput' class='mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-button--colored '><i class='material-icons'>add_circle</i></a> <div class='mdl-tooltip mdl-tooltip--bottom' for='addinput'>Add Alternate Vendor</div><span class='appendme'></span>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="pan_crd">featured_video</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pan_crd">Pan Card</div>
                </span>
              <input type="file" id="vendor_pancard" class="" style="display:none" tabindex = "16">
              <label style="width:56%" for="vendor_pancard" id="Panlabel" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Pan Card
                  <div class="mdl-tooltip mdl-tooltip--top" for="Panlabel">Choose File</div>
              </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="licence_crd">featured_play_list</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="licence_crd">Licence</div>
                </span>
              <input type="file" id="vendor_licence" class="" style="display:none">
               <label style="width:56%" for="vendor_licence" id="Licencelabel" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Licence
                  <div class="mdl-tooltip mdl-tooltip--top" for="Licencelabel">Choose File</div>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="aadhaar_crd">subtitles</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="aadhaar_crd">Aadhaar</div>
                </span>
              <input type="file" id="vendor_aadhaar" class="" style="display:none">
              <label style="width:56%" for="vendor_aadhaar" id="Adhaarlabel" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Aadhaar
                  <div class="mdl-tooltip mdl-tooltip--top" for="Adhaarlabel">Choose File</div>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="other_crd">web</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="other_crd">Other Card</div>
                </span>
              <input type="file" id="vendor_other" class="" style="display:none">
              <label style="width:56%" for="vendor_other" id="Otherlabel" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Other Card
                  <div class="mdl-tooltip mdl-tooltip--top" for="Otherlabel">Choose File</div>
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
<script type="text/javascript" src="<?php echo base_url().'assets/js/vendor.js';?>"></script>
