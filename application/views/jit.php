<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Just In time</span>
    <span class="mdl-layout-title">&emsp;<?php echo date('jS, M Y');?></span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="view_jit_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="view_jit_search" autofocus placeholder="Search.." autocomplete='off'>
        <label class="mdl-textfield__label" for="view_jit_search"></label>
      </div>
    </div>
   
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab mdl-layout__tab is-active">Add Procure</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab jit_view">Today's Procure</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab jit_view">History</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100 jit_view">
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
      <div class="mdl-grid jit">
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone orderCardEmpty ">
          <div class="mdl-textfield mdl-textfield_addJit mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input validate_date" type="text" id="datepicker" placeholder="" tabindex="1">
            <input class="mdl-textfield__input validate_date hidden" type="text" id="to" placeholder="Select Date">
            <input class="mdl-textfield__input validate_date hidden" type="text" id="vendor_id" placeholder="vendor">
            <label class="mdl-textfield__label mdl-textfield__label_addOrder" for="datepicker">Procurement Date</label>
          </div>

          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label" style="width: 90px;margin-left: 30px;">
            <select required="" id="team" class="mdl-selectfield__select" tabindex="6">
            </select>
            <label class="mdl-selectfield__label" for="team">Assign To</label>
          </div>

          <div class="card-details mdl-shadow--2dp">
            <table class="mdl-data-table_jit_head mdl-js-data-table">
              <tbody>
                <tr class="jit-add-row">
                  <td></td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield_procure_history_info mdl-textfield--floating-label">
                      <input class="mdl-textfield__input input_search" type="text" id="selectJitItem" autocomplete="off" placeholder="" tabindex="2">
                        <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                          <span class="mdl-chip__text"></span>
                          <button type="button" class="mdl-chip__action">
                          <i class="material-icons">cancel</i></button>
                        </span>
                      <label class="mdl-textfield__label" for="selectJitItem">Select Items</label>
                      <div class="suggestionClient hidden">
                        <ul class="suggestionListClient "></ul>
                      </div>
                    </div>   
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield_procure_history_info mdl-textfield--floating-label">
                      <input class="mdl-textfield__input input_search" type="text" id="selectMarkets" autocomplete="off" placeholder="" tabindex="3">
                        <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                          <span class="mdl-chip__text"></span>
                          <button type="button" class="mdl-chip__action">
                          <i class="material-icons">cancel</i></button>
                        </span>
                      <label class="mdl-textfield__label" for="selectMarkets">Select Markets</label>
                      <div class="suggestionClient hidden">
                         <ul class="suggestionListClient "></ul>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield_procure_history_info mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="number" id="quantity" placeholder="" tabindex="4">
                      <label class="mdl-textfield__label" for="quantity">Quantity</label>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure_history_info mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input validate_number" type="number" id="price" placeholder="" tabindex="5">
                      <label class="mdl-textfield__label" for="price">Price</label>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield  mdl-js-textfield mdl-textfield_procure_history_info mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="reason" placeholder="" tabindex="6">
                      <label class="mdl-textfield__label" for="rate">Reason</label>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>
                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="jitAppendRow" tabindex="7">
                      <i class="material-icons">done</i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="mdl-card-event_add_jit addJitScreen mdl-card mdl-shadow--2dp hidden">
            <table class="mdl-data-table table_jit mdl-js-data-table">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th class="mdl-data-table__cell--non-numeric" id="sortItems">Items</th>
                  <th>Markets</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Reason</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="jit_tbody">
                <tr class="jit-item hidden">
                  <td class="count"></td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input input_search mdl-textfield__input_border edit_unit" type="text" id="editJitItem" autocomplete="off" placeholder="" readonly>
                        <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                          <span class="mdl-chip__text"></span>
                          <button type="button" class="mdl-chip__action">
                          <i class="material-icons">cancel</i></button>
                        </span>
                      <label class="mdl-textfield__label" for="selectJitItem"></label>
                      <div class="suggestionClient hidden">
                         <ul class="suggestionListClient "></ul>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input input_search mdl-textfield__input_border edit_unit" type="text" id="editJitMarkets" autocomplete="off" placeholder="" readonly>
                        <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                          <span class="mdl-chip__text"></span>
                          <button type="button" class="mdl-chip__action">
                          <i class="material-icons">cancel</i></button>
                        </span>
                      <label class="mdl-textfield__label" for="selectMarkets"></label>
                      <div class="suggestionClient hidden">
                         <ul class="suggestionListClient "></ul>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border edit_unit" type="text" id="" readonly>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border edit_unit" type="text" id="" readonly>
                    </div>
                  </td>
                  <td>
                    <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input mdl-textfield__input_border edit_unit" type="text" id="" readonly>
                    </div>
                  </td>
                  <td>
                    <button class="mdl-button mdl-js-button mdl-button--icon jit_edit jit-row-edit" tabindex="8">
                      <i class="material-icons ">create</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--icon jit_delete jit-row-remove" tabindex="9">
                      <i class="material-icons ">delete</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--icon jit_update jit-row-done hidden" tabindex="9">
                      <i class="material-icons ">done</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--icon jit_delete jit-row-cancel hidden" tabindex="9">
                      <i class="material-icons ">cancel</i>
                    </button> 
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="submit_jit" tabindex="9">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mdl-layout__tab-panel " id="scroll-tab-2">
    <div class="page-content">
      <div class="mdl-grid jitProcureView">
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone jitCardEmpty hidden">
          <div class="jit-card-event mdl-card mdl-shadow--2dp" style="">
              <div class="mdl-card__title mdl-card--expand" style="padding: 8px 14px;"><h4></h4></div>
              <div class="mdl-card__title mdl-card--expand" style="padding: 8px 14px;"><p style="margin: 0 0 0px;">Total Price : </p></div>
              <!-- <div class="mdl-card__supporting-text">
                <p><span></span></p>
              </div> -->
               <div class="mdl-card__actions mdl-card--border" style="height: 45px;">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="info_tool1" 
                  href="" target="_blank">
                  <i class="icon material-icons info">info_outline</i> 
                  <div class="mdl-tooltip mdl-tooltip--top" for="info_tool1" >Info </div>
                </a>
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--icon print_p_o" id="print" style="float:right;">
                  <i class="icon material-icons">print</i>
                  <div class="mdl-tooltip mdl-tooltip--left" for="print" >Print Puchase Order</div>
                </a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div class="page-content">
      <div class="mdl-grid jitHistoryView">
        
      </div>
    </div>
  </section>
</main>
  <script src="<?php echo base_url().'assets/js/jit.js';?>"></script>
  <script type="text/javascript">
   var allMarkets = <?php echo get_all_markets(); ?>;
   var estdQty = <?php echo get_total_item_qty_from_orders(); ?>;
 </script>