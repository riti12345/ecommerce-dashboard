<?php 
 $tid = $this->input->get('tid');
 $team_data = get_team_by_id($tid);
//  echo print_array($team_data);die;
?>  
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">

    <span class="mdl-layout-title">User's Details</span>
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

          <div style="float:right; width: 120px;position: absolute;right: 22px;top: 44px;">
            
            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect " id="t_edit" style="float:right;">
              <div class="mdl-tooltip mdl-tooltip--top" for="t_edit" >Edit</div>
              <i class="material-icons">mode_edit</i>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect showme hidden" id="t_cancel" data-id="<?= $team_data['id']; ?>" style="margin-left:1%">
              <div class="mdl-tooltip mdl-tooltip--top" for="t_cancel" >Cancel</div>
              <i class="material-icons">clear</i>
            </button>

            <button class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect showme hidden" id="t_save" data-id="<?= $team_data['id']; ?>" style="margin-left:1%">
              <div class="mdl-tooltip mdl-tooltip--top" for="t_save" >Save</div>
              <i class="material-icons">save</i>
            </button>
          </div>

          <form action="#" id="t_form">
          
          <span class="act_inact" >
           <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" id="statusIcon" for="t_status" style="float:right">
            <input type="checkbox" id="t_status" value="yes" data-disabled="disabled" class="mdl-switch__input tog_disable" <?php if ($team_data['status']==1) echo "checked"; else echo ""; ?>>
            <span class="mdl-switch__label"></span>
           </label>
           <div class="mdl-tooltip mdl-tooltip--top" for="statusIcon"><?php if ($team_data['status']==1) echo "Status : Active"; else echo "Status : In-Active"; ?></div>
          </span>
          
          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="teamIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="teamIcon">Username</div>
                <h4 class="mdl-card__subInfo hideme"><?= $team_data ['username'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="text" id="t_name" value="<?= $team_data['username'] ;?>">
                  <label class="mdl-textfield__label" for="t_name">Username</label>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="team_emailIcon">mail_outline</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="team_emailIcon">Email</div>
                <h4 class="mdl-card__subInfo hideme"><?= $team_data ['email'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="email" id="t_email" value="<?= $team_data['email'] ;?>">
                  <label class="mdl-textfield__label" for="t_email">Email</label>
                </div>
              </div>
            </div>
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="team_passwordIcon">lock_outline</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="team_passwordIcon">Password</div>
                <h4 class="mdl-card__subInfo hideme">Enter a New Password</h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="password" id="t_password" >
                  <label class="mdl-textfield__label" for="t_password">Password</label>
                </div>
              </div>
            </div> 
            
            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="team_permissionsIcon">account_box</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="team_permissionsIcon">Permission/Designation</div>
                <h2 class="mdl-card__subInfo hideme"><?= $team_data['designation'];?></h2>
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label showme hidden">
                  <select id="t_permissions" class="mdl-selectfield__select input">
                    <option selected="selected" value="<?= $team_data['permissions'];?>"><?= $this->config->item($team_data['permissions'],'os_team_status');?></option>
                    <option value=0>Super Admin</option>
                    <option value=4>Procurement Manager</option>
                    <option value=5>Delivery Boy</option>
                    <option value=6>Line Manager</option>
                    <option value=8>Data Operator</option>
                  </select>
                  <label class="mdl-selectfield__label" for="t_permissions">Permissions/Designation</label>
                </div>  
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="team_mobileIcon">call</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="team_mobileIcon">Contact No.</div>
                <h4 class="mdl-card__subInfo hideme"><?= $team_data ['mobile'] ;?></h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                  <input class="mdl-textfield__input" type="number" id="t_mobile" value="<?= $team_data['mobile'] ;?>">
                  <label class="mdl-textfield__label" for="t_mobile">Contact No.</label>
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
<script type="text/javascript" src="<?php echo base_url().'assets/js/team.js';?>"></script>
