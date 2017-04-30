<?php
  $order_id  = $this->input->get('id');
  $request = $this->input->get('request');
  if(isset($order_id)) {
    $order = get_all_orders($request ,$order_id);
    // echo print_array($vendor);die;
    $disp_order = json_decode($order,true);
    // echo print_array($disp_order);die;
    $perm_array = [0,2,3];
    $permissions =get_session_data()['user']['permissions'];
  }
?>
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?= $disp_order[0]['client']['name'];?></span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="order_info_search">
              <i class="material-icons">search</i>
              <div class="mdl-tooltip mdl-tooltip--left" for="order_info_search" >Search an item</div>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="order_info_search" autofocus autocomplete="off" placeholder="Search..">
              <label class="mdl-textfield__label" for="order_info_search"></label>
            </div>
          </div>
        </div>
    </header>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <?php
              $decode_category=['','Vegetables','English Vegetables','Fruits'];
              $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];
              $sr_counter=0;
              $statusDelete = ['delete','undo'];
              $Edit_show = ['','hidden'];
              $action_button = ['','hidden','hidden','hidden','hidden','hidden'];
              $order_status = ['','hidden','hidden','hidden','hidden','hidden'];
              $originalDate = $disp_order[0]['delivery_date'];
              $newDate = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($originalDate));
              $added_on = $disp_order[0]['added_on'];
              $added_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($added_on));
              echo"
            <div class='mdl-card-event_info_order mdl-shadow--2dp'>
              <div class='card-details mdl-shadow--2dp' data-order-id='".$disp_order[0]['id']."'>
                <button class='mdl-button mdl-js-button mdl-button--icon btn_icon_shadow' onclick='window.history.back()' style='min-width: 20px;'' data-upgraded=',MaterialButton'>
                  <i class='material-icons'>arrow_back</i>
                </button>
                <button class='mdl-button mdl-js-button cancel_btn' style=' float:right;' data-upgraded=',MaterialButton' id='order_cancel' ".$order_status[$disp_order[0]['status']].">
                  Cancel order
                  <div class='mdl-tooltip mdl-tooltip--left' for='order_cancel'>Cancel order </div>
                </button>
                <div class='order_details'>
                <ul class='list li1'>
                  <li><b>Order Id</b> : ".$disp_order[0]['id']."</li>
                  <li style=''><b>Ordered On</b> : ". $added_date."</li>
                  <li class=''></li>
                </ul>
                <ul class='list li2'>
                  
                  <li><b>Delivery On</b> : ".$newDate."</li>
                  <li style=''><b>Delivery Slot</b> : ".$this->config->item($disp_order[0]['client']['delivery_slot'],'delivery_slot')."</li>
                  <li style=''><b>No. of Items</b>: ".count($disp_order[0]['items'])."</li>
                </ul>
                <ul class='list li3'>
                  <li><b>POC</b> : ".$disp_order[0]['client']['poc']."</li>
                  <li style=''><b>POC number</b> : ".$disp_order[0]['client']['phone']."</li>
                  
                  <li class='total_price".$disp_order[0]['id']."'data-value='".$disp_order[0]['total_price']."'><b>Total : &#8377 </b>".$disp_order[0]['total_price']."</li>
                </ul>
              </div>
            </div>";
              
          echo "<table class='mdl-data-table orderAddInfo_table  mdl-js-data-table mdl-shadow--2dp'>
                  <tbody>
                    <tr class='addItem hidden' data_value='" .$disp_order[0]['client']['id']."' data-order-id='".$disp_order[0]['track_id'][0]['id']."'>
                     <td></td>
                     <td>
                      <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input  input_search' type='text' id='order_item' placeholder='' tabindex='1' />
                        
                        <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                          <span class='mdl-chip__text'></span>
                          <button type='button' class='mdl-chip__action'>
                          <i class='material-icons'>cancel</i></button>
                        </span>
                      
                        <label class='mdl-textfield__label' for='order_item'>Select Item</label>
                        <div class='suggestionClient hidden'>
                          <ul class='suggestionListClient' style='width: 98%;'></ul>
                        </div> 
                      </div>
                     </td>
                     <td>
                      <div class='mdl-selectfield mdl-selectfield_order mdl-js-selectfield mdl-selectfield--floating-label'>
                          <select id='order_sku' class='mdl-selectfield__select'>
                           <option value='1' select='selected'></option>
                          </select>
                          <label class='mdl-selectfield__label' for='order_sku'>Sku</label>
                      </div>                      
                     </td>
                     <td>
                       <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputUnit'>
                        <input class='mdl-textfield__input' type='number' id='order_units' placeholder='' tabindex='2'/>
                       <label class='mdl-textfield__label' for='order_units'>Units</label>
                       </div>
                     </td>
                     <td>
                      <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputUnit'>
                        <input class='mdl-textfield__input' type='text' id='order_uom' placeholder='' readonly>
                        <label class='mdl-textfield__label' for='order_uom'>UOM</label>
                      </div>
                     </td>
                      <td>
                          <div class='mdl-textfield mdl-textfield_order mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputRate'>
                            <input class='mdl-textfield__input validate_number ' type='number' id='order_rate' placeholder='' readonly >
                            <label class='mdl-textfield__label' for='order_rate'>Rate</label>
                          </div>
                      </td>
                      <td>
                       <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label inputUnit'>
                        <input class='mdl-textfield__input' type='text' id='order_comment' placeholder='' tabindex='3'/>
                       <label class='mdl-textfield__label' for='order_comment'>Comments</label>
                       </div>
                     </td>
                     <td>
                      <button class='mdl-button mdl-js-button mdl-button--icon mdl-button--colored order_additem' tabindex='4'/><i class='material-icons save_btn'>check_circle</i></button>  
                      <button class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect  order_addcancel'tabindex='5'/><i class='material-icons c_rate_cancel'>cancel</i></button>
                     </td>
                   </tr>
                  </tbody>
                </table>
                <table class='mdl-data-table mdl-js-data-table orderInfo_table' data-order-id='".$disp_order[0]['id']."'>
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th class='' id='sortItems'>Items</th>
                      <th>Sku</th>
                      <th class=''>Units</th>
                      <th>Uom</th>
                      <th class=''>Price</th>
                      <th class=''>Comments</th>";

                      if(in_array($permissions,$perm_array)){
                        echo "<th class='action".$disp_order[0]['status']."' ".$action_button[$disp_order[0]['status']].">Action</th>";
                      }

                    echo"</tr>
                  </thead>
                  <tbody class='order_info_body'>
                    <tr class='order_addtRow hidden'>
                      <td class='count'></td>
                      <td>
                        <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label'>
                          <input style= 'width: initial' class='mdl-textfield__input mdl-textfield__input_border' type='text' id='' readonly>
                        </div>
                      </td>
                      <td>
                       <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label'>
                          <input class='mdl-textfield__input mdl-textfield__input_border' type='text' id='' readonly>
                        </div>
                      </td>
                      <td>
                        <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label'>
                          <input class='mdl-textfield__input mdl-textfield__input_border' type='text' readonly id='edit_addunits' value=' '>
                        </div>
                      </td>
                      <td>
                       <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label'>
                          <input class='mdl-textfield__input mdl-textfield__input_border' type='text' id='' readonly>
                        </div>
                      </td>
                      <td>
                       <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label'>
                          <input style= 'width: initial' class='mdl-textfield__input mdl-textfield__input_border' type='text' id='' readonly>
                        </div>
                      </td>
                      <td>
                       <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label'>
                          <input style= 'width: initial' class='mdl-textfield__input mdl-textfield__input_border' type='text' id='edit_comments' readonly>
                        </div>
                      </td>
                      <td>
                        <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect new_edit'><i class='material-icons'>edit</i></a>
                        <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect new_add' data-id='' ><i class='material-icons save_btn'>check_circle</i></a>  
                        <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect new_edit_cancel'><i class='material-icons cancel_btn'>cancel</i></a>  
                        <a class='mdl-button mdl-js-button mdl-button--icon order_delete order_newremove' data-id=''><i class='material-icons'>delete</i></a>
                      </td>
                    </tr>";  
                        
                  foreach ($disp_order[0]['items'] as $i => $value) :
                    echo "<tr class='order_info_row'>
                            <td class='count' width='1%;'></td>
                            <td class=' orderItemName'>".get_item_by_id($disp_order[0]['items'][$i]['item_id'])['item_name']."<span class='hidden'>".$decode_category[$disp_order[0]['items'][$i]['category']]."</span><span class='hidden'>".$decode_subcategory[$disp_order[0]['items'][$i]['subcategory']]."</span></td>
                            <td class=' edit-item hidden'>
                              <div class='mdl-textfield_order_info'>
                                <input class='mdl-textfield__input input_search' type='search' id='selectItemInfo' value='".get_item_by_id($disp_order[0]['items'][$i]['item_id'])['item_name']."' data_item_id='".$disp_order[0]['items'][$i]['item_id']."' autocomplete='off'>
                                <label class='mdl-textfield__label' for='selectItemInfo' placeholder='' required!></label>
                                <div class='suggestionClient hidden'>
                                   <ul class='suggestionListClient'></ul>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label' style='width:50%;'>
                                <select class='mdl-selectfield__select edit_sku_order_info' disabled style='width:20%;'>
                                  <option select='selected'  data-id='".$disp_order[0]['items'][$i]['sku_id']."'>".$disp_order[0]['items'][$i]['sku']."</option>
                                </select>
                                <label class='mdl-selectfield__label' for=''>Sku</label>
                              </div>
                            </td>
                            <td class=' edit-quantity  show_class".$disp_order[0]['items'][$i]['item_id']."' id='quantity".$disp_order[0]['items'][$i]['item_id']."'>".$disp_order[0]['items'][$i]['quantity']."</td>
                            <td class=' hidden  hidden_class".$disp_order[0]['items'][$i]['item_id']."'>
                              <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
                                <input class='mdl-textfield__input   ' type='text' pattern='-?[0-9]*(\.[0-9]+)?'' id='quantity' value='".$disp_order[0]['items'][$i]['quantity']."'>
                                
                                <span class='mdl-textfield__error'>Input is not a number!</span>
                              </div>
                            </td>
                            <td>".$this->config->item($disp_order[0]['items'][$i]['uom'],'uom')."
                            </td>
                            <td class='' id='price".$disp_order[0]['items'][$i]['item_id']."'>".$disp_order[0]['items'][$i]['price']."</td>
                            <td class=' hidden'>
                              <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
                                <input class='mdl-textfield__input ' type='text' pattern='-?[0-9]*(\.[0-9]+)?'' id='edit_price' value='".$disp_order[0]['items'][$i]['price']."'>
                                
                                <span class='mdl-textfield__error'>Input is not a number!</span>
                              </div>
                            </td>
                             <td class=' edit-comments  show_class".$disp_order[0]['items'][$i]['item_id']."' id='comments".$disp_order[0]['items'][$i]['item_id']."'>".$disp_order[0]['items'][$i]['comment']."</td>
                             <td class=' hidden hidden_class".$disp_order[0]['items'][$i]['item_id']."'>
                              <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
                                <input class='mdl-textfield__input' type='text' id='comments' value='".$disp_order[0]['items'][$i]['comment']."'>
                              </div>
                            </td>";
                          
                            if(in_array($permissions,$perm_array)){
                            echo "<td class='action pull_center action".$disp_order[0]['status']."' ".$action_button[$disp_order[0]['status']]." data-item-id='".$disp_order[0]['items'][$i]['item_id']."' data-value='".$disp_order[0]['client']['name']."'>
                              <a class='mdl-button mdl-js-button mdl-button--icon mdl-button--colored order-info-row-edit show_class".$disp_order[0]['items'][$i]['item_id']."' ".$Edit_show[$disp_order[0]['items'][$i]['status']]." data-status='".$disp_order[0]['items'][$i]['status']."'>
                                  <i class='material-icons order_edit'>create</i>
                              </a>
                              <a class='mdl-button mdl-js-button mdl-button--icon  order-info-row-delete show_class".$disp_order[0]['items'][$i]['item_id']."' data-id='".$disp_order[0]['items'][$i]['id']."' data-status='".$disp_order[0]['items'][$i]['status']."'>
                                  <i class='material-icons order_delete'> ".$statusDelete[$disp_order[0]['items'][$i]['status']]."</i>
                              </a>
                              <a class='mdl-button mdl-js-button mdl-button--icon  order-info-row-done hidden hidden_class".$disp_order[0]['items'][$i]['item_id']."' data-id='".$disp_order[0]['items'][$i]['id']."'>
                                  <i class='material-icons rate_update'>done</i>
                              </a>
                              <a class='mdl-button mdl-js-button mdl-button--icon order-info-row-cancel hidden hidden_class".$disp_order[0]['items'][$i]['item_id']."'>
                                  <i class='material-icons order_delete'>cancel</i>
                              </a>
                            </td>";
                            }
                            echo "<td class='hidden'>
                              <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
                                <input class='mdl-textfield__input num_width' type='text' pattern='-?[0-9]*(\.[0-9]+)?'' id='rate'>
                              </div>
                            </td>
                         </tr>";
                  endforeach;

                   echo" </tbody>
                   <tfoot> 
                      <tr role='row'> 
                        <td rowspan='1' colspan='4' ></td>
                        <td rowspan='1' colspan='1'  class=''>Total Price : </b></td>
                        <td rowspan='1' colspan='1' style='text-align:left;' class='tfoot_total_price".$disp_order[0]['id']."'>&#8377; ".$disp_order[0]['total_price']."</td> 
                      </tr> 
                    </tfoot>";
                   ?>
                </table>
            </div>
          </div>
        </div>
      </main>

      <?php
      $order_status = ['','hidden','hidden','hidden','hidden','hidden'];
      if(in_array($permissions,$perm_array)):      
      echo"<div class='fixed-action-btn'>
        <a class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored' id='order_newitem' href='#' ".$order_status[$disp_order[0]['status']].">
          <i class='material-icons'>add</i>
          <div class='mdl-tooltip mdl-tooltip--top' for='order_newitem' >add new item</div>
        </a>
      </div>";
      endif
      ?>

    <script src="<?php echo base_url().'assets/js/order.js';?>"></script>    
    
  