<?php
  $employee_id = $this->input->get('id');
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Add Request</span>
    <div class="mdl-layout-spacer"></div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100 request" data-id="<?= $employee_id; ?>">
  <div class="page-content">
    <div class="mdl-grid invoice_report">
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
        <form action="#" id="ReqForm">
        <div class="mdl-grid">
         
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <div class="mdl-card-event mdl-card mdl-shadow--2dp mdl-card__hr_requestInfo">
              <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                <button style="float:right;margin-right:12%;"type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" tabindex="4">Submit</button>
              </div>
               <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone " >
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="reqtoIcon">arrow_forward</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="reqtoIcon">To</div>
                  <div style="width:30%;"class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input input_search" type="text" id="req_employee" placeholder="" tabindex="1">
                      <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                        <span class="mdl-chip__text"></span>
                        <button type="button" class="mdl-chip__action"><i class="material-icons">cancel</i></button>
                    </span>
                    <label class="mdl-textfield__label" for="req_employee">To</label>
                    <div class="suggestionClient hidden">
                      <ul class="suggestionListClient" style="width: 98%;"></ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone " >
                <div class="info_details">
                  <span class="info_icon"><i class="material-icons" id="resubIcon">subject</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="resubIcon">Subject</div>
                  <div style="width:50%;"class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="req_sub" placeholder="" tabindex="2">
                    <label class="mdl-textfield__label" for="req_sub">Subject</label>
                  </div>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone  ">
                <div class="info_details">
                  <span style="margin-top:2%;"class="info_icon"><i class="material-icons" id="reqmsgIcon">mail_outline</i></span>
                  <div class="mdl-tooltip mdl-tooltip--bottom" for="reqmsgIcon">Message</div>
                  <div class="mdl-textfield mdl-js-textfield hr_request_h4">
                    <textarea class="mdl-textfield__input" type="text" rows= "8" id="req_msg" tabindex="3"></textarea>
                    <label class="mdl-textfield__label" for="req_msg">Message</label>
                  </div>
                </div>
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
<script type="text/javascript" src="<?php echo base_url().'assets/js/hr.js';?>"></script>