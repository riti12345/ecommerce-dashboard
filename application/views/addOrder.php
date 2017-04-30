<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Add Order</span>
      <div class="mdl-layout-spacer"></div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="add_order_search">
      <i class="material-icons hidden search-hide">search</i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input hidden search-hide" type="text" id="add_order_search" autofocus autocomplete="off" placeholder="Search..">
      <label class="mdl-textfield__label" for="add_order_search"></label>
    </div>
  </div>
      
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">

  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="mdl-breadcrum">
        <div class="breadcrumb flat"><a href="#" class="active">Select Client</a><a href="#">Add Items</a><a href="#">Create Order</a><a href="#">Confirm Order</a></div>
      </div> 
    </div>
  </div>
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col-desktop  mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <!-- Add client screen -->
      <div class="mdl-card-event_add_order mdl-shadow--2dp clientScreen">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--2-col-desktop mdl-cell--3-col-tablet  mdl-cell--3-col-phone mdl-typography--text-center"></div>
          <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center"> 
              <div class="mdl-textfield mdl-textfield_addOrder mdl-js-textfield mdl-textfield--floating-label search_client">
                <input class="mdl-textfield__input input_search " type="text" id="searchClient" autocomplete="off" placeholder="" tabindex="1">
                <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                  <span class="mdl-chip__text"></span>
                  <button type="button" class="mdl-chip__action">
                  <i class="material-icons">cancel</i></button>
                </span>
                <label class="mdl-textfield__label mdl-textfield__label_addOrder" for="searchClient">Client</label>
                <div class="suggestionClient hidden">
                   <ul class="suggestionListClient" style="width: 98%;"></ul>
                </div>
              </div>
              <!-- <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div> -->
              <div class="mdl-textfield mdl-textfield_addOrder mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input validate_date" type="text" id="datepicker" placeholder="" tabindex="2">
                <!--<input class="mdl-textfield__input validate_date hidden" type="text" id="to" placeholder="Select Date" >-->
                <label class="mdl-textfield__label mdl-textfield__label_addOrder" for="datepicker">Delivery date</label>
              </div>
              <div id = "reference" class="mdl-textfield mdl-textfield_addOrder mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="order_ref" placeholder="" tabindex="3">
                <label class="mdl-textfield__label" for="order_ref">Order Reference</label>
              </div>
              <div class="mdl-tooltip" data-mdl-for="reference">By Purchase Order/Email/Call</div>
          </div>
          <div class="mdl-cell  mdl-cell--4-col-desktop mdl-cell--4-col-tablet  mdl-cell--4-col-phone mdl-typography--text-center">
            <div style="margin-bottom:-40px;"></div>
            <button class="mdl-button mdl_button_manual mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent manualOrder" tabindex="3">Next</button>
          </div>
        </div>
      </div>
      <!-- manual order screen Add  -->

        <div class="card-details selectItemScreen mdl-shadow--2dp hidden">
          <table class="mdl-data-table_order_head mdl-js-data-table">
            <a class="mdl-button mdl-js-button mdl-button--icon btn-back-manual" style=" min-width: 20px;" data-upgraded=",MaterialButton" tabindex="4">
              <i class="material-icons">arrow_back</i>
            </a>
            <tbody>
              <div class="disp-client">
                <span><b>Client : </b><span class="client-name"></span></span><span class="pull-right"><b>Delivery Date : </b><span class="del-date"></span></span>
              </div>
              <tr class="select_item_row">
                <td></td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label" style="">
                    <input class="mdl-textfield__input input_search inputSelect" type="text" id="selectOrderItem" autocomplete="off" placeholder="" tabindex="5">
                    <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                      <span class="mdl-chip__text"></span>
                      <button type="button" class="mdl-chip__action">
                      <i class="material-icons">cancel</i></button>
                    </span>
                    <label class="mdl-textfield__label" for="selectOrderItem">Select Items</label>
                    <div class="suggestionClient hidden">
                       <ul class="suggestionListClient "></ul>
                    </div>
                  </div>
                </td>
                <td style="">
                  <!-- <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label getmdl-select inputSku">
                    <input class="mdl-textfield__input" type="number" id="sku" value="1" placeholder="" readonly >
                      <label for="sample1" class="mdl-textfield__label" for="sku">Sku</label>
                      <!-- <ul for="sample1" class="mdl--menu mdl-menu-bottom-left mdl-js-menu">
                      </ul> 
                  </div> -->
                  <div class='mdl-selectfield mdl-selectfield_order mdl-js-selectfield mdl-selectfield--floating-label'>
                    <select id='sku' class='mdl-selectfield__select' style="width:50%;">
                     <option value='1' select='selected'></option>
                    </select>
                    <label class='mdl-selectfield__label' for=''>Sku</label>
                  </div>
                </td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputUnit">
                    <input class="mdl-textfield__input" type="number" id="units" placeholder="" tabindex="6">
                    <label class="mdl-textfield__label" for="units">Units</label>
                  </div>
                </td>

                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputUnit">
                    <input class="mdl-textfield__input" type="text" id="uom" placeholder="">
                    <label class="mdl-textfield__label" for="uom">UOM</label>
                  </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputRate">
                      <input class="mdl-textfield__input" type="number" id="rate" placeholder="" readonly>
                      <label class="mdl-textfield__label" for="rate">Rate</label>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputComment">
                      <input class="mdl-textfield__input " type="text" id="comment" placeholder="" tabindex="7">
                      <label class="mdl-textfield__label" for="rate">Comment</label>
                    </div>
                </td>
                <td>
                  <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner"></div>   
                  <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="appendItems" tabindex="8">
                    <i class="material-icons">done</i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mdl-card-event_add_order mdl-card addOrderScreen mdl-shadow--2dp hidden">
          <table class="mdl-data-table mdl-data-table_order mdl-js-data-table">
            <thead>
              <tr>
                <th style="padding-left: 14px;">Sr. No.</th>
                <th class="mdl-data-table__cell--non-numeric" id="sortItems">Items</th>
                <th>Sku</th>
                <th>Units</th>
                <th>UOM</th>
                <th>Rate<a></th>
                <th>Comment<a></th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="tbody">
              <tr class="order-item hidden">
                <td class="count"></td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                  </div>
                </td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                  </div>
                </td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="edit_unit" readonly>
                  </div>
                </td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                  </div>
                </td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                  </div>
                </td>
                <td>
                  <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                  </div>
                </td>
                <td>
                  <button class="mdl-button mdl-js-button mdl-button--icon order_edit add-order-row-edit" tabindex="9">
                    <i class="material-icons ">create</i>
                  </button>
                  <button class="mdl-button mdl-js-button mdl-button--icon order_delete add-order-row-remove" tabindex="10">
                    <i class="material-icons ">delete</i>
                  </button>
                  <button class="mdl-button mdl-js-button mdl-button--icon order_update add-order-row-done hidden" tabindex="10">
                    <i class="material-icons ">done</i>
                  </button>
                  <button class="mdl-button mdl-js-button mdl-button--icon order_delete add-order-row-cancel hidden" tabindex="10">
                    <i class="material-icons ">cancel</i>
                  </button>
                </td>
              </tr>
            </tbody>
            <!-- <tfoot> 
              <tr role="row"> 
                <td></td>
                <td rowspan="1" colspan="3"  class=''><b>Total Price</b></td>
                <td rowspan="1" colspan="2" class=''></td> 
                </tr> 
            </tfoot> -->
          </table>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent createManualOrder" tabindex="11">Create Order</button>
            </div>
          </div>
        </div>
      <!-- create order screen-->
      <div class="createOrderScreen hidden card-details mdl-shadow--2dp">
        <table class="mdl-data-table mdl-js-data-table mdl-data-table_order">
          <a class="mdl-button mdl-js-button mdl-button--icon btn-back-confirm" style=" min-width: 20px;" data-upgraded=",MaterialButton" tabindex="12">
            <i class="material-icons">arrow_back</i>
          </a>
          <div class="disp-client">
            <span><b>Selected Client : </b><span class="client-name"></span></span><span class="pull-right"><b>Delivery Date : </b><span class="del-date"></span></span>
          </div>
          <thead>
            <tr>
              <th style="padding-left: 14px;">Sr. No.</th>
              <th class="mdl-data-table__cell--non-numeric" id="sortItems">Items</th>
              <th>Sku</th>
              <th>Units</th>
              <th>Price</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody class="pre_order_body">
            <tr class="pre_order hidden">
              <td class="count"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
          <tfoot> 
            <tr role="row"> 
              <td rowspan="1" colspan="5" class='pull_center'></td>
              <td rowspan="1" colspan="1"  class='pull_center'></td>
             </tr> 
          </tfoot>
        </table>
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent confirmManualOrder" tabindex="13">Confirm Order</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
  
  <dialog id="add_order_dialog" class="mdl-dialog print_width" style="width: 40%;height: auto;-webkit-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 299px 3333px rgba(0,0,0,0.75);">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
        <div class="addOrder_dialog_msg">
          <h3 style="text-align:center;">Fixed rate is not defined !</h3>
          <h4 style="text-align:center;">Do you want to enter rate from general ratelist ?</h4>
        </div>
        <div class="addOrder_dialog_action_btn">
          <button id="get_general_rate" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
          OK
          </button>
          <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-dialog__actions" id="order-dialog-close" style="background-color: #ea4335;color: #ffffff; float:right;">
          Cancel
          </button>
        </div>
      </div>
    </div>
  </dialog>
    
<script src="<?php echo base_url().'assets/js/order.js';?>"></script>  
    
  