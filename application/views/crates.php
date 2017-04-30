<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Crates</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="crates_update_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="crates_update_search" autofocus placeholder="Search.." autocomplete='off'>
        <label class="mdl-textfield__label" for="crates_update_search"></label>
      </div>
    </div>
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="page-content">
    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="card-details mdl-shadow--2dp">
        <div class="mdl-card-event_crate mdl-shadow--2dp">
        <table class="mdl-data-table table_crate mdl-js-data-table crateTableInfo">
          <thead>
            <tr>
              <th>Sr No.</th> 
              <th>Crate Code</th>
              <th>Crate Type</th>
              <th >Crate Status</th>
            </tr>
          </thead>
          <tbody class="crate_infoTbody">
            <tr class='crate_row hidden'>
                <td class='count update_td'></td>
                <td>
                  <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                    <input class='mdl-textfield__input mdl-textfield__input_border' value='' type='text' id='' readonly>
                  </div>
                </td>
                <td>
                  <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                    <input class='mdl-textfield__input mdl-textfield__input_border' value='' type='text' id='' readonly>
                  </div>
                </td>
                <td>
                  <div class="mdl-selectfield mdl-selectfield--floating-label">
                    <select required="" id="crate_status" class="mdl-selectfield__select input" disabled='disabled'>
                      <option selected="selected"></option>
                      <option value="0">In Use</option>
                      <option value="1">Not In Use</option>
                    </select>
                </div>
              </td>
              <td> 
                <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect edit_crate'><i class='material-icons'>edit</i></a>
                <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect update_crate' ><i class='material-icons save_btn'>check_circle</i></a>  
                <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect cancel_crate'><i class='material-icons cancel_btn'>cancel</i></a>  
              </td>           
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>