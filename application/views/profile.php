<?php 
     if(get_profile(get_session_data()['user']['id'])): 
     $employees = get_profile(get_session_data()['user']['id']);
    //  echo print_array($employees);die;
?>
 <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Profile</span>
    <div class="mdl-layout-spacer"></div>
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab  tab_1 is-active">Profile</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab tab_2">Pending</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab tab_3">Completed</a>
    <a href="#scroll-tab-4" class="mdl-layout__tab tab_4">Others</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100 user_profile" data-id="<?= $employees['id']?>">
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
        <div class="wrap mdl_card_2 mdl-shadow--4dp">
          <div class="mdl-card__clientInfo">

            <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
              <i class="material-icons">arrow_back</i>
            </button>

            <div style="float:right; width: 120px;position: absolute;right: 22px;top: 44px;">
              <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored " id="e_edit" style="float:right;">
                <i class="material-icons">mode_edit</i>
                <div class="mdl-tooltip mdl-tooltip--top " for="e_edit" >Edit</div>
              </button>
              <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden" id="e_cancel" data-id="<?= $employees['id']; ?>" data-team ="<?= $employees['team_id']; ?>" style="margin-left:1%">
                <i class="material-icons">clear</i>
                <div class="mdl-tooltip mdl-tooltip--top" for="e_cancel" >Cancel</div>
              </button>
              <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden" id="e_save" data-id="<?= $employees['id']; ?>" data-team ="<?= $employees['team_id']; ?>" style="margin-left:1%">
                <i class="material-icons">save</i>
                <div class="mdl-tooltip mdl-tooltip--top" for="e_save">Save</div>
              </button>
            </div> 
            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <a style="margin-left:23%;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="<?php echo "addRequest?id=".$employees['id']."";?>">Add Request</a>
            </div>
            <form action="#" id="e_form">
              <span class="act_inact">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" id="statusIcon" for="e_status" style="float:right">
                  <input type="checkbox" id="e_status" value="yes" data-disabled="disabled" class="mdl-switch__input tog_disable" <?php if ($employees['status']==1) echo "checked"; else echo ""; ?>>
                  <span class="mdl-switch__label"></span>
               </label>
               <div class="mdl-tooltip mdl-tooltip--top" for="statusIcon"><?php if ($employees['status']==1) echo "Status : Active"; else echo "Status : In-Active"; ?></div>
              </span>
            
              <div class="mdl-grid ">

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="employeeIcon">account_circle</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="employeeIcon">Full Name</div>
                  <h4 class="mdl-card__subInfo "><?= $employees ['name'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                    <input class="mdl-textfield__input" type="text" id="employee_name" value="<?= $employees['name'] ;?>">
                    <label class="mdl-textfield__label" for="employee_name">Full Name</label>
                  </div>
                </div>
              </div>
              
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="employee_emailIcon">email</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_emailIcon">Personal Email</div>
                <h4 class="mdl-card__subInfo "><?= $employees ['email'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input required="" class="mdl-textfield__input" type="text"  id="employee_email" value="<?= $employees['email'] ;?>">
                  <label class="mdl-textfield__label" for="employee_email">Personal Email</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="employee_tempIcon">location_on</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_tempIcon">Temporary Address</div>
                <h4 class="mdl-card__subInfo "><?= $employees ['localadd'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input class="mdl-textfield__input" type="text"  id="employee_temp" value="<?= $employees['localadd'] ;?>">
                  <label class="mdl-textfield__label" for="employee_temp">Temporary Address</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="employee_permIcon">location_on</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_permIcon">Permanent Address</div>
                <h4 class="mdl-card__subInfo "><?= $employees ['permanentadd'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input required="" class="mdl-textfield__input" type="text"  id="employee_perm" value="<?= $employees['permanentadd'] ;?>">
                  <label class="mdl-textfield__label" for="employee_perm">Permanent Address</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="employee_contactIcon">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="employee_contactIcon" >Contact No.</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['phone'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input required="" class="mdl-textfield__input" type="text" pattern="[0-9]{10,10}?$" value="<?= $employees['phone'] ;?>" id="employee_phone" max='10'>
                  <label class="mdl-textfield__label" for="employee_phone">Contact No.</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="DesignationIcon">person_pin</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="DesignationIcon" >Designation</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['designation'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input required="" class="mdl-textfield__input" type="text"  id="employee_desig" value="<?= $employees['designation'] ;?>">
                  <label class="mdl-textfield__label" for="employee_desig">Designation</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="slotIcon">assignment_ind</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="slotIcon"> Deparment</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $this->config->item($employees['department'],'os_employee_dept');?></h4>
                 <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label  hidden ">
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
                <span class="info_icon"><i class="material-icons" id="emppermissionsIcon">account_box</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emppermissionsIcon">Permissions</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $this->config->item($employees['permissions'],'os_team_status');?></h4>
                 <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label  hidden">
                   <select required="" id="employee_permissions" class="mdl-selectfield__select">
                     <option select="selected" ></option>
                     <option value=0>Super Admin</option>
                     <option value=4>Procurement Manager</option>
                     <option value=5>Delivery Boy</option>
                     <option value=6>Line Manager</option>
                     <option value=8>Data Operator</option>
                   </select>
                   <label class="mdl-selectfield__label" for="employee_permissions">Permissions</label>
                 </div>  
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="ReportingIcon">perm_identity</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="ReportingIcon" >Reporting Manager</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['reporting_manager'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden ">
                  <input required="" class="mdl-textfield__input" type="text"  id="employee_manager" value="<?= $employees['reporting_manager'] ;?>">
                  <label class="mdl-textfield__label" for="employee_manager">Reporting Manager</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="companyContactIcon">contact_phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="companyContactIcon" >Company Contact No.</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['company_no'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden ">
                  <input class="mdl-textfield__input" type="text"  pattern="[0-9]{10,10}?$" id="company_phone" value="<?= $employees['company_no'] ;?>">
                  <label class="mdl-textfield__label" for="company_phone">Company Contact No.</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="compMailIcon">contact_mail</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="compMailIcon" >Company Email</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['company_email'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label   hidden">
                  <input class="mdl-textfield__input" type="text"  id="company_mail" value="<?= $employees['company_email'] ;?>">
                  <label class="mdl-textfield__label" for="company_mail">Company Email</label>
                </div>
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="emppasswordIcon">lock_outline</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emppasswordIcon">Password</div>
                <h4 class="mdl-card__subInfo hideme">Change Password</h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input required="" class="mdl-textfield__input" type="password"  id="employee_password">
                  <label class="mdl-textfield__label" for="employee_password">Password</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="emergency_contactIcon1">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emergency_contactIcon1" >Emergency Contact No.1</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['emergency_no'][0] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input class="mdl-textfield__input emergency_contact" type="text" pattern="[0-9]{10,10}?$" value="" id="emergency_phone" value="<?= $employees['emergency_no'][0] ;?>" max='10'>
                  <label class="mdl-textfield__label" for="emergency_phone">Emergency Contact No.1</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
               </div>
             </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="emergency_contactIcon2">phone</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="emergency_contactIcon2" >Emergency Contact No.2</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['emergency_no'][1] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input class="mdl-textfield__input emergency_contact" type="text" pattern="[0-9]{10,10}?$" value="" id="emergency_phone_2" value="<?= $employees['emergency_no'][1] ;?>" max='10'>
                  <label class="mdl-textfield__label" for="emergency_phone_2">Emergency Contact No.2</label>
                  <span class="mdl-textfield__error">Invalid phone number!</span>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="dojIcon">date_range</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="dojIcon"> Date of Joining</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['doj'] ;?></h4>
                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                <input class="mdl-textfield__input validate_date" type="text" id="datepicker1" placeholder="" value="<?= $employees['doj'] ;?>">                           
                <label class="mdl-textfield__label mdl-textfield__label" for="datepicker1">Date of Joining</label>
              </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="assetsIcon">perm_identity</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="assetsIcon" >Company Assets</div>
                </span>
                <h4 class="mdl-card__subInfo "><?= $employees ['company_assets'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  hidden">
                  <input class="mdl-textfield__input" type="text"  id="employee_assets" value="<?= $employees['company_assets'] ;?>">
                  <label class="mdl-textfield__label" for="employee_assets">Company Assets</label>
                </div>
              </div>
            </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="aadhaar_crd">subtitles</i>
                    <div class="mdl-tooltip mdl-tooltip--bottom" for="aadhaar_crd">Aadhaar</div>
                  </span>
                  <img src="<?= $employees['files'][1]['doc_url'];?>" class="employeeDoc img-responsive" border="0" alt="" style="width:80%;height: 1%;">
                </div>
                <input type="file" name="aadhaar_card" id="e_aadhaar" class=" hidden" style="float:right">
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="pan_crd">featured_video</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="pan_crd">Pan Card</div>
                  </span>
                  <img src="<?= $employees['files'][2]['doc_url'];?>" class="employeeDoc" border="0" alt="" style="width:80%;height: 1%;">
                </div>
                <input type="file" name="pan_card" id="e_pan" class=" hidden" style="float:right">
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="photo">photo</i>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="photo">Photo</div>
                  </span>
                  <img src="<?= $employees['files'][3]['doc_url'];?>" class="employeeDoc" border="0" alt="" style="width:80%;height: 1%;">
                </div>
                <input type="file" name="licence_card" id="e_photo" class=" hidden" style="float:right">
              </div>

              <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="other_crd">web</i>
                    <div class="mdl-tooltip mdl-tooltip--bottom" for="other_crd">Other Card</div>
                  </span>
                  <img src="<?= $employees['files'][4]['doc_url'];?>" class="employeeDoc img-responsive" border="0" alt="" style="width:80%;height: 1%;">
                </div>
                <input type="file" name="other_card" id="e_other" class=" hidden" style="float:right">
              </div>
            
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
      <div id="hr-cards" class="mdl-grid pending_request">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--6-col-phone demoCardRequest hidden">
          <div class="request-cardInfo-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand"><i class="icon material-icons">subject</i><h4></h4></div>
            <div class="mdl-card__title mdl-card--expand"><i class="icon material-icons">date_range</i><h4></h4></div>
            <div class="mdl-card__title mdl-card--expand"><p></p></div>
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon pull-left" href="#" target="_blank">
                <i class="icon material-icons">info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--right">Info </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div class="page-content">
      <div id="hr-cards" class="mdl-grid completed_request">
      </div>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-4">
    <div class="page-content">
     <div id="hr-cards" class="mdl-grid other_request">
      </div> 
    </div>
  </section>
</main>
<?php endif;?>
<script type="text/javascript" src="<?php echo base_url().'assets/js/hr.js';?>"></script>
