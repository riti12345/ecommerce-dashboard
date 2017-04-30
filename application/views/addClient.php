
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Client</span>
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
          <form action="#" id="clientForm">
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " style="min-width: 20px;right:5%;float:right;position:fixed">Save</button>
          
          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="clientIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="clientIcon">Client Name</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="client_name" tabindex="1">
                  <label class="mdl-textfield__label" for="client_name">Client Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="contactIcon">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="contactIcon" >Contact No.</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text" pattern="[0-9]{10,10}?$" value="" id="client_phone" tabindex="2" max='10'>
                  <label class="mdl-textfield__label" for="client_phone">Contact No.</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="emailIcon">email</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emailIcon">Email</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text"  id="client_email" tabindex="1">
                  <label class="mdl-textfield__label" for="client_email">Email</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="brandIcon">star</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="brandIcon" >Brand Name</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input" type="text" value="" id="client_brand_name" tabindex="3">
                  <label class="mdl-textfield__label" for="client_brand_name">Brand Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="companyIcon">account_balance</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="companyIcon" >Company Name</div>
                </span>
                <h2 class="mdl-card__subInfo hideme"></h2>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input" type="text" id="client_cmpName" tabindex="4">
                  <label class="mdl-textfield__label" for="client_cmpName">Company Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="creditIcon">access_time</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="creditIcon" >Credit Period</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" type="number" class="mdl-textfield__input" type="number"  id="client_creditPeriod" tabindex="5">
                  <label class="mdl-textfield__label" for="client_creditPeriod">Credit Period</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="creditLiIcon">timelapse</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="creditLiIcon" >Credit Limit</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" type="number" class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" value="" id="client_creditLimit" tabindex="6">
                  <label class="mdl-textfield__label" for="client_creditLimit">Credit Limit</label>
                  <span class="mdl-textfield__error">Input is not a number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="gradeIcon">loyalty</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="gradeIcon"> Grade</div>
                </span>
                 <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label ">
                   <select required="" id="client_grade" class="mdl-selectfield__select" tabindex="7">
                     <option select="selected" ></option>
                     <option>A</option>
                     <option>B</option>
                     <option>C</option>
                     <option>D</option>
                   </select>
                   <label class="mdl-selectfield__label" for="client_grade">Grade</label>
                 </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="categoryIcon">format_list_numbered</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="categoryIcon" >Category</div>
                </span>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                  <select required="" id="client_category" class="mdl-selectfield__select input">
                    <option selected="selected"></option>
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
                  <label class="mdl-selectfield__label" for="client_category">Category</label>
                </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1">
                  <i class="material-icons" id="locationIcon">location_on</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="locationIcon" >Address</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input required="" class="mdl-textfield__input" type="text" id="client_address" tabindex="8">
                  <label class="mdl-textfield__label" for="client_address">Address</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1">
                  <i class="material-icons" id="AvgIcon">add_shopping_cart</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="AvgIcon" >Average Orders</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input required="" class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="client_avg_orders" tabindex="9">
                  <label class="mdl-textfield__label" for="client_avg_orders">Average Orders</label>
                  <span class="mdl-textfield__error">Input is not a number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1">
                  <i class="material-icons" id="RemarksIcon">thumbs_up_down</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="RemarksIcon" >Remarks</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input required="" class="mdl-textfield__input" type="text" id="client_remarks" tabindex="10">
                  <label class="mdl-textfield__label" for="client_remarks">Remarks</label>
                </div>
              </div>
            </div>            

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details" style="padding: 40px 0px 0px 0px;">
                <span class="" style="margin: 0px 40px 0px 0px;">
                  <i class="material-icons" id="paymentIcon">payment</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="paymentIcon" >Payment Method </div>
                </span>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect " for="client_cash">
                  <input type="checkbox" value="yes" id="client_cash" class="mdl-checkbox__input" tabindex="11">
                  <span class="mdl-checkbox__label">Cash</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="client_cheque">
                  <input type="checkbox" value="yes" id="client_cheque" class="mdl-checkbox__input" >
                  <span class="mdl-checkbox__label">Cheque</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="client_rtgs">
                  <input type="checkbox" value="yes" id="client_rtgs" class="mdl-checkbox__input">
                  <span class="mdl-checkbox__label">RTGS</span>
                </label>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="client_neft">
                  <input type="checkbox" value="yes" id="client_neft" class="mdl-checkbox__input">
                  <span class="mdl-checkbox__label">NEFT</span>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="pocNameIcon">perm_contact_calendar</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pocNameIcon" >POC Name</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="client_pocName" tabindex="12">
                  <label class="mdl-textfield__label" for="client_pocName">POC Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="pocIcon">contact_phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pocIcon" >POC Contact</div>
                </span>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input" type="text" pattern="[0-9]{10,10}?$" id="client_poc_ph" tabindex="13">
                  <label class="mdl-textfield__label" for="client_poc_ph">POC Contact</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="DesignationIcon">person_pin</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="DesignationIcon" >POC Designation</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input" type="text"  id="client_poc_desig" tabindex="14">
                  <label class="mdl-textfield__label" for="client_poc_desig">POC Designation</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="slotIcon">av_timer</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="slotIcon"> Delivery Slot</div>
                </span>
                 <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label  ">
                   <select required="" id="client_delSlot" class="mdl-selectfield__select">
                     <option select="selected" ></option>
                     <option value="0" >00 hrs - 03 hrs</option>
                     <option value="1" >03 hrs - 06 hrs</option>
                     <option value="2" >06 hrs - 09 hrs</option>
                     <option value="3" >09 hrs - 12 hrs</option>
                     <option value="4" >12 hrs - 15 hrs</option>
                     <option value="5" >15 hrs - 18 hrs</option>
                     <option value="6" >19 hrs - 21 hrs</option>
                     <option value="7" >22 hrs - 24 hrs</option>
                   </select>
                   <label class="mdl-selectfield__label" for="client_delSlot">Delivery Slot</label>
                 </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="delAddrIcon">place</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="delAddrIcon" >Delivery Address</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input" type="text" value="" id="client_delAddress" tabindex="15">
                  <label class="mdl-textfield__label" for="client_delAddress">Delivery Address</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="cityIcon">local_offer</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="cityIcon">City</div>
                  </span>
                  <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label" >
                    <select required="" class="mdl-selectfield__select" id="client_city">
                      <option select="selected"></option>
                      <option value="1">Mumbai</option>
                    </select>
                    <label class="mdl-selectfield__label" for="client_city">City</label>
                  </div>
                </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="pincodeIcon">pin_drop</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pincodeIcon">Pin Code</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input validate_pincode" type="text" pattern="[0-9]{6,6}?$" id="client_pincode" tabindex="16">
                  <label class="mdl-textfield__label" for="client_pincode">Pincode</label>
                  <span class="mdl-textfield__error">Invalid pincode!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="latIcon">my_location</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="latIcon">Latitude</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input class="mdl-textfield__input" type="text" id="client_lat" tabindex="17">
                  <label class="mdl-textfield__label" for="client_lat">Latitude</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--3-col mdl-cell--3-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="longIcon">my_location</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="longIcon">Longitude</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input class="mdl-textfield__input" type="text" id="client_long" tabindex="18">
                  <label class="mdl-textfield__label" for="client_long">Longitude</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="pan_crd">featured_video</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="pan_crd">Pan Card</div>
                </span>
              <input type="file" name="pan_card" id="client_pan" class="" style="display:none" tabindex="19">
                <label style="width:56%" for="client_pan" id="Panlabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
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
              <input type="file" name="licence_card" id="client_licence" class="" style="display:none" tabindex="20">
                <label style="width:56%" for="client_licence" id="Licencelabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
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
              <input type="file" name="aadhaar_card" id="client_aadhaar" class="" style="display:none" tabindex="21">
                <label style="width:56%" for="client_aadhaar" id="Aadhaarlabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Aadhaar
                  <div class="mdl-tooltip mdl-tooltip--top" for="Aadhaarlabel">Choose File</div>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="other_crd">web</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="other_crd">Other Card</div>
                </span>
              <input type="file" name="other_card" id="client_other" class="" style="display:none" tabindex="22">
                <label style="width:56%" for="client_other" id="otherlabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Other Card
                  <div class="mdl-tooltip mdl-tooltip--top" for="otherlabel">Choose File</div>
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
<script type="text/javascript" src="<?php echo base_url().'assets/js/client.js';?>"></script>

