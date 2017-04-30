<?php
  $id = $this->input->get('request_id');
  $request = json_decode(get_all_hr_info_request($id),true)[0];
  $employees = json_decode(get_all_employees($request['employee_id']),true)[0];
  $to = json_decode(get_all_employees($request['assigned_to']),true)[0];
  // echo print_array($request);die;
  // echo print_array($to);die;
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Request Info</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100 request" data-id="<?= $id; ?>">
  <div class="page-content">
    <div class="mdl-grid">

      <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
        <i class="material-icons">arrow_back</i>
      </button>
        
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
        <div class="mdl-grid">

          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <div class="mdl-card-event mdl-card mdl-shadow--2dp mdl-card__hr_requestInfo" >
              
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="reFromIcon">send</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="reFromIcon">From</div>
                  <h4 class="mdl-card__subInfo hideme"><?= $employees['name'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                    <input class="mdl-textfield__input" type="text" id="request_from" value="<?= $employees['name'] ;?> "tabindex="1">
                    <label class="mdl-textfield__label" for="request_from">To</label>
                  </div>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="reToIcon">arrow_forward</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="reToIcon">To</div>
                  <h4 class="mdl-card__subInfo hideme"><?= $to['name'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                    <input class="mdl-textfield__input" type="text" id="request_to" value="<?= $to['name'] ;?> "tabindex="1">
                    <label class="mdl-textfield__label" for="request_to">To</label>
                  </div>
                </div>
              </div>                 
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone " >
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="resubIcon">subject</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="resubIcon">Subject</div>
                  <h4 class="mdl-card__subInfo hideme"><?= $request['subject'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label showme hidden">
                    <input class="mdl-textfield__input" type="text" id="request_subject" value="<?= $request['subject'] ;?>">
                    <label class="mdl-textfield__label" for="request_subject">Subject</label>
                  </div>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone  ">
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="reqmsgIcon">mail_outline</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="reqmsgIcon">Message</div>
                  <h4  class="mdl-card__subInfo hr_request_h4 hideme"><?= $request['message'] ;?></h4>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label hr_request_h4 showme hidden">
                    <textarea class="mdl-textfield__input" type="text" row="8" id="request_message"><?= $request['message'] ;?></textarea>
                    <label class="mdl-textfield__label" for="request_message">Message</label>
                  </div>
                </div>
              </div>

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
            
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript" src="<?php echo base_url().'assets/js/hr.js';?>"></script>