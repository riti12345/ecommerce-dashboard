<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Employee</span>
    <div class="mdl-layout-spacer"></div>
    
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__employeeInfo">
          
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>
          <form action="#" id="employeeForm">
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " style="min-width: 20px;right:5%;float:right;position:fixed">Save</button>
          
          <div class="mdl-grid">
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="employeeIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employeeIcon">Full Name</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="employee_name" tabindex="1">
                  <label class="mdl-textfield__label" for="employee_name">Full Name</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="employee_emailIcon">email</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_emailIcon">Personal Email</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text"  id="employee_email" tabindex="2">
                  <label class="mdl-textfield__label" for="employee_email">Personal Email</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="employee_tempIcon">location_on</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_tempIcon">Temporary Address</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text"  id="employee_temp" tabindex="3">
                  <label class="mdl-textfield__label" for="employee_temp">Temporary Address</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="employee_permIcon">location_on</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_permIcon">Permanent Address</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text"  id="employee_perm" tabindex="4">
                  <label class="mdl-textfield__label" for="employee_perm">Permanent Address</label>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="employee_contactIcon">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_contactIcon" >Contact No.</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input" type="text" pattern="[0-9]{10,10}?$" value="" id="employee_phone" tabindex="5" max='10'>
                  <label class="mdl-textfield__label" for="employee_phone">Contact No.</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="DesignationIcon">person_pin</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="DesignationIcon" >Designation</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input" type="text"  id="employee_desig" tabindex="6">
                  <label class="mdl-textfield__label" for="employee_desig">Designation</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="slotIcon">assignment_ind</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="slotIcon"> Deparment</div>
                </span>
                 <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label  ">
                   <select required="" id="employee_department" class="mdl-selectfield__select">
                     <option select="selected" ></option>
                     <option value="1" >Accounts</option>
                     <option value="2" >Warehouse Staff</option>
                     <option value="3" >Procurement</option>
                     <option value="4" >Tech</option>
                     <option value="5" >Delivery</option>
                     <option value="6" >Data Operators</option>
                     <option value="7" >Sales</option>
                     <option value="8" >Call Center</option>
                     <option value="9" >Labours</option>
                     <option value="10" >Others</option>
                   </select>
                   <label class="mdl-selectfield__label" for="employee_department">Deparment</label>
                 </div>  
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="emppermissionsIcon">account_box</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emppermissionsIcon">Permissions</div>
                </span>
                 <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label ">
                   <select required="" id="employee_permissions" class="mdl-selectfield__select">
                     <option select="selected" ></option>
                     <option value=0>Super Admin</option>
                     <option value=2>Data Operator</option>
                     <option value=3>Data Analyst</option>
                     <option value=4>Procurement Manager</option>
                     <option value=5>Delivery Boy</option>
                     <option value=6>Line Manager</option>
                     <option value=7>Accounts</option>
                     <option value=8>Sales</option>
                     <option value=9>Warehouse Manager</option>
                   </select>
                   <label class="mdl-selectfield__label" for="employee_permissions">Permissions</label>
                 </div>  
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="ReportingIcon">perm_identity</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="ReportingIcon" >Reporting Manager</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input class="mdl-textfield__input" type="text"  id="employee_manager" tabindex="7">
                  <label class="mdl-textfield__label" for="employee_manager">Reporting Manager</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="ReportingIcon">contact_phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="ReportingIcon" >Company Contact No.</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input class="mdl-textfield__input" type="text"  pattern="[0-9]{10,10}?$" id="company_phone" tabindex="8">
                  <label class="mdl-textfield__label" for="company_phone">Company Contact No.</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="ReportingIcon">contact_mail</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="ReportingIcon" >Company Email</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input required="" class="mdl-textfield__input" type="text"  id="company_mail" tabindex="9">
                  <label class="mdl-textfield__label" for="company_mail">Company Email</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="emppasswordIcon">lock_outline</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emppasswordIcon">Password</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="password"  id="employee_password" tabindex="10">
                  <label class="mdl-textfield__label" for="employee_password">Password</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="emergency_contactIcon">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emergency_contactIcon" >Emergency Contact No.1</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input emergency_contact" type="text" pattern="[0-9]{10,10}?$" value="" id="emergency_phone" tabindex="11" max='10'>
                  <label class="mdl-textfield__label" for="emergency_phone">Emergency Contact No.1</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="emergency_contactIcon">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emergency_contactIcon" >Emergency Contact No.2</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input class="mdl-textfield__input emergency_contact" type="text" pattern="[0-9]{10,10}?$" value="" id="emergency_phone_2" tabindex="12" max='10'>
                  <label class="mdl-textfield__label" for="emergency_phone_2">Emergency Contact No.2</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="dojIcon">date_range</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="dojIcon"> Date of Joining</div>
                </span>
                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input validate_date" type="text" id="datepicker1" placeholder="" tabindex="13">                           
                <label class="mdl-textfield__label mdl-textfield__label" for="datepicker1">Date of Joining</label>
              </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="assetsIcon">perm_identity</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="assetsIcon" >Company Assets</div>
                </span>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  ">
                  <input class="mdl-textfield__input" type="text"  id="employee_assets" tabindex="14">
                  <label class="mdl-textfield__label" for="employee_assets">Company Assets</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="aadhaar_crd">subtitles</i>
                    <div class="mdl-tooltip mdl-tooltip--bottom" for="aadhaar_crd">Aadhaar</div>
                </span>
                <input type="file" name="aadhaar_card" id="employee_aadhaar" class="" style="display:none" tabindex="15">
                <label style="width:56%" for="employee_aadhaar" id="Aadhaarlabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Aadhaar
                  <div class="mdl-tooltip mdl-tooltip--top" for="Aadhaarlabel">Choose File</div>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="pan_crd">featured_video</i>
                    <div class="mdl-tooltip mdl-tooltip--bottom" for="pan_crd">Pan Card</div>
                </span>
                <input type="file" name="pan_card" id="employee_pan" class="" style="display:none" tabindex="16">
                <label style="width:56%" for="employee_pan" id="Panlabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Pan Card
                  <div class="mdl-tooltip mdl-tooltip--top" for="Panlabel">Choose File</div>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="photo">insert_photo</i>
                    <div class="mdl-tooltip mdl-tooltip--bottom" for="photo">Photo</div>
                </span>
                <input type="file" name="pan_card" id="employee_photo" class="" style="display:none" tabindex="17">
                <label style="width:56%" for="employee_photo" id="Photolabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
                  <i class="material-icons">attach_file</i>Photo
                  <div class="mdl-tooltip mdl-tooltip--top" for="Photolabel">Choose File</div>
                </label>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_2"><i class="material-icons" id="other_crd">web</i>
                    <div class="mdl-tooltip mdl-tooltip--bottom" for="other_crd">Other Card</div>
                </span>
                <input type="file" name="other_card" id="employee_other" class="" style="display:none" tabindex="18">
                <label style="width:56%" for="employee_other" id="otherlabel" class="mdl-button mdl-js-button  mdl-js-ripple-effect mdl-file--custom">
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

<script type="text/javascript" src="<?php echo base_url().'assets/js/hr.js';?>"></script>