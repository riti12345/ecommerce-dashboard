<?php
  $id = $this->input->get('request_id');
  $request = json_decode(get_all_hr_info_request($id),true)[0];
  $employees = json_decode(get_all_employees($request['assigned_to']),true)[0];
  // echo print_array($request);die;
  // echo print_array($employees);die;
  // echo "$id";die;
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Request Info</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100 employee_request" data-id="<?= $id; ?>">
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
  <div class="page-content">
    <div class="mdl-grid">

      <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
        <i class="material-icons">arrow_back</i>
      </button>
        
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
       
        <div class="mdl-grid">

          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <div class="mdl-card-event mdl-card mdl-shadow--2dp mdl-card__hr_requestInfo">
              

            <?php
            $request_status = ['','','hidden','hidden'];
            echo "<div style='float:right; width: 120px;position: absolute;right: 22px;top: 44px;' ".$request_status[$request['status']].">
                  
              <button class='mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored' id='request_edit' style='float:right;'>
                <i class='material-icons'>mode_edit</i>
                <div class='mdl-tooltip mdl-tooltip--top' for='request_edit'>Edit</div>
              </button>

              <button class='mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden' id='request_cancel' data-id=".$id."  style='margin-left:1%'>
                <i class='material-icons'>clear</i>
                <div class='mdl-tooltip mdl-tooltip--top' for='request_cancel' >Cancel</div>
              </button>

              <button class='mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect mdl-button--colored showme hidden' id='request_save' data-id=".$id." style='margin-left:1%'>
                <i class='material-icons'>save</i>
                <div class='mdl-tooltip mdl-tooltip--top' for='request_save'>Save</div>
              </button>
            </div>"; 
            ?>
            <?php
              $request_status = ['','','hidden','hidden'];
              echo "<button style='width:15%;margin-left:70%;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent ".$request_status[$request['status']]." cancel_request' data-id=".$id.">Cancel Request</button>";
            ?>
              <form action="#" id="request_form">
              
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone " >
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="reToIcon">arrow_forward</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="reToIcon">To</div>
                  <h4 class="mdl-card__subInfo hideme"><?= $employees['name'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                    <input class="mdl-textfield__input" type="text" id="request_assigned_to" value="<?= $employees['name'] ;?> "tabindex="1">
                    <label class="mdl-textfield__label" for="request_assigned_to">To</label>
                  </div>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone " >
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="resubIcon">subject</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="resubIcon">Subject</div>
                  <h4 class="mdl-card__subInfo hideme"><?= $request['subject'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                    <input class="mdl-textfield__input" type="text" id="request_subject" value="<?= $request['subject'] ;?> "tabindex="1">
                    <label class="mdl-textfield__label" for="request_subject">Subject</label>
                  </div>
                </div>
              </div>
              
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="reqmsgIcon">mail_outline</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="reqmsgIcon">Message</div>
                  <h4 class="mdl-card__subInfo hr_request_h4 hideme"><?= $request['message'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label hr_request_h4 showme hidden">
                    <textarea class="mdl-textfield__input" type="text" rows= "8" id="request_message" tabindex="2"><?= $request['message'];?></textarea>
                    <label class="mdl-textfield__label" for="request_message">Message</label>
                  </div>
                </div>
              </div>

              <?php
              $request_status = ['','','display_none','display_none'];
              echo" <div style='margin-bottom:15%;' class='".$request_status[$request['status']]."'></div>";
              ?>

              <?php
              $request_status = ['hidden','hidden','','hidden'];
              echo"<div class='mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone' ".$request_status[$request['status']].">
                <div class='info_details'>
                  <span class='info_icon'><i class='material-icons' id='reqreplyIcon'>reply</i></span>
                  <div class='mdl-tooltip mdl-tooltip--bottom' for='reqreplyIcon'>Reply</div>
                  <h4 style='margin-bottom:15%;' class='mdl-card__subInfo hr_request_h4 hideme'> ".$request['approval_message']."</h4>
                </div>
              </div>";
              ?>
            
              </form>
              <?php
              $request_status = ['hidden','hidden','hidden',''];
              echo "<h4 class=".$request_status[$request['status']]."><b style='float:right;'>Cancelled!</b></h4>";
              ?>
             </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
 </section>
</main>
<script type="text/javascript" src="<?php echo base_url().'assets/js/hr.js';?>"></script>