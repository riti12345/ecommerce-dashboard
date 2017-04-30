<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Team</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="team_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="team_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="team_info_search"></label>
      </div>
    </div> 
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
          <form action="#" id="teamForm">
           <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " style="min-width: 20px;right:5%;float:right;position:fixed">Save</button>
          
          <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="teamIcon">account_circle</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="teamIcon">Username</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="text"  id="team_username" tabindex="1">
                  <label class="mdl-textfield__label" for="team_username">Username</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="teamEmalIcon">mail_outline</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="teamEmalIcon">Email</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="email"  id="team_email" tabindex="2">
                  <label class="mdl-textfield__label" for="team_email">Email</label>
                </div>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="teampasswordIcon">lock_outline</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="teampasswordIcon">Password</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="password"  id="team_password" tabindex="3">
                  <label class="mdl-textfield__label" for="team_password">Password</label>
                </div>
              </div>
            </div>

             <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="teampermissionsIcon">account_box</i>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="teampermissionsIcon"> Permissions</div>
                </span>
                 <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label ">
                   <select required="" id="team_permissions" class="mdl-selectfield__select">
                     <option select="selected" ></option>
                     <option value=0>Super Admin</option>
                     <option value=4>Procurement Manager</option>
                     <option value=5>Delivery Boy</option>
                     <option value=6>Line Manager</option>
                     <option value=8>Data Operator</option>
                   </select>
                   <label class="mdl-selectfield__label" for="team_permissions">Permissions/Designation</label>
                 </div>  
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon_1"><i class="material-icons" id="teammobileIcon">call</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="teammobileIcon">Mobile</div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                  <input required="" class="mdl-textfield__input" type="number"  id="team_mobile" tabindex="4">
                  <label class="mdl-textfield__label" for="team_mobile">Mobile</label>
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
<script src="<?php echo base_url().'assets/js/team.js';?>"></script>
