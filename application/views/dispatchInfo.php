<?php
  $disp_id = $this->input->get('id');
  if(isset($disp_id)) {
    $dispatch = get_all_dispatch($disp_id);
    // echo print_array($vendor);die;
    $data = json_decode($dispatch,true);
    //echo print_array($data);die;
  }  
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title"><?= $data[0]['client']['name'];?></span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="dispatch-info-search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="dispatch-info-search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="dispatch-info-search"></label>
      </div>
    </div>
  </div>
</header>
<main class="dispatch mdl-layout__content mdl-color--grey-100">
  <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
  <?php
    $decode_category=['','Vegetables','English Vegetables','Fruits'];
    $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];
    $disp_status_dispatched =["","hidden","hidden","hidden","hidden","hidden"];
    $disp_status_processing =['hidden',"","","",""];
    $uom_array = ["","KGS","BDL","PKT","DZN","PCS"];

    $disp_status_history =["hidden","","","hidden","","hidden"];
    $originalDate = $data[0]['delivery_date'];
    $newDate = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($originalDate));
    $status_array = ["Placed","Processing","Return and Replace","Cancelled","Unsigned","Closed"];
  echo"<div class='mdl-grid' ".$disp_status_dispatched[$data[0]['status']].">
    <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone'>
      <div class='mdl-breadcrum'>
        <div class='breadcrumb flat'><a href='#' class='active'>Dispatch</a><a href='#''>Confirm Dispatch</a><a href='#'>Choose Assignee</a><a href='#'>Dispatched</a></div>
      </div> 
    </div>
  </div>

  <div class='mdl-grid'>
    <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone'>
      <button class='mdl-button mdl-js-button mdl-button--icon btn_icon_shadow dispatchScreen' onclick='window.history.back()' style=' min-width: 20px;    margin-bottom: 10px;'>
        <i class='material-icons'>arrow_back</i>
      </button>
      
      <a class='mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-button--colored mdl-js-ripple-effect pull-right' style='position: absolute;right: 20px;top: 20px;' id='dr_print' data-id='".$data[0]['id']."'>
        <i class='material-icons'>print</i>
        <div class='mdl-tooltip mdl-tooltip--left' for='dr_print'>Print Dispatch Report</div>
      </a>
      
      <!-- Dispatch screen -->
            <div class='card-details mdl-shadow--2dp' ".$disp_status_processing[$data[0]['status']].">
                <div class='dispBtn' ".$disp_status_history[$data[0]['status']].">
                  <button class='mdl-button mdl-js-button' id='demo-menu-lower-right' style=' float:right;' data-upgraded=',MaterialButton'>
                    Change Assignee
                  </button>
                  <ul class='mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect' for='demo-menu-lower-right' data-order-id='".$data[0]['order_id']."'>
                  </ul>
                </div>
                <ul class='list li1'>
                  <li><b>Order Id</b> : ".$data[0]['order_id']."</li>
                  <li style=''><b>Delivery On</b> : ".$newDate."</li>
                  <li class=''></li>
                </ul>
                <ul class='list li2'>
                  <li><b>Assignee</b> : ".$data[0]['assign_to_name']."</li>
                  <li style=''><b>Order status</b> : ".$status_array[$data[0]['order_status']]."</li>
                  <li style=''><b>No. of Items</b>: ".count($data[0]['items'])."</li>
                </ul>
                <ul class='list li3'>
                </ul>
              </div>";
     echo" <div class='mdl-card-event_dispatch dispatchScreen'>
        <table class='mdl-data-table dispatch_table mdl-js-data-table mdl-shadow--2dp'>
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th id='sortItems'>Items <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
              <th>Sku</th>
              <th>Units</th>
              <th>Uom</th>
              <th>Dispatch Sku</th>
              <th>Dispatch Units</th>
            </tr>
          </thead>
          <tbody>";
          
            $sr_counter=1;
            foreach ($data[0]['items'] as $i => $value) :
              echo "<tr class='dispatch-info-row'>
                      <td class='count'></td>
                      <td class='mdl-data-table__cell--non-numeric'>".$data[0]['items'][$i]['item_name']." <span class='hidden'>".$decode_category[$data[0]['items'][$i]['category']]."</span><span class='hidden'>".$decode_subcategory[$data[0]['items'][$i]['subcategory']]."</span></td>
                      <td>".$data[0]['items'][$i]['sku']."</td>
                      <td>".$data[0]['items'][$i]['quantity']."</td>
                      <td>". $uom_array[$data[0]['items'][$i]['uom']]."</td>";
              if(isset($data[0]['dispatched']) && !empty(($data[0]['dispatched']))){
                 echo "<td>".$data[0]['dispatched'][$i]['sku']."</td>
                       <td>".$data[0]['dispatched'][$i]['units']."</td>";
              }else{
                 echo "<td>
                         <input class='mdl-textfield__input mdl-textfield__input_border pull_center' type='number' id='' data-item='".$data[0]['items'][$i]['item_id']."' data-id='".$data[0]['id']."' value='".$data[0]['items'][$i]['sku']."' data-item-id='".$data[0]['items'][$i]['id']."' style='width:50%; '>
                      </td>
                      <td>
                        <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label' style='width:40%'>
                          <input class='mdl-textfield__input pull_center ' type='number' id='dispatch_unit' value=''  tabindex='".$sr_counter."'>
                        </div>
                       </td>";
                      }
              echo "</tr>";
              $sr_counter++;
            endforeach;
            
          echo"</tbody>
        </table>";
        echo"<div class='mdl-grid noPadLeft noPadRight '  ".$disp_status_dispatched[$data[0]['status']].">
          <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone noMarAll'>
            <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent createDispatch'>Dispatch</button>
          </div>
        </div>
      </div>";
      ?>
      <!--confirm dispatch screen -->
      <div class="mdl-card-event_assignee confirmDispatchScreen hidden">  
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
          <a class='mdl-button mdl-js-button mdl-button--icon confirm_dispatch_btn' style='min-width: 20px;'>
            <i class='material-icons'>arrow_back</i>
          </a>
          <div class="dispatch-card-details">
            <?php
             $originalDate = $data[0]['delivery_date'];
            $newDate = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($originalDate));
            echo"<div class='card-details mdl-shadow--2dp' data-order-id='".$data[0]['order_id']."'>
             
              <ul class='li1 list '>
                <li><b>Order ID</b> : ".$data[0]['order_id']."</li>
                <li><b>Track ID</b> : ".$data[0]['track_id']."</li>
                <li><b>Delivery On</b> : ".$newDate."</li>
              </ul>
              <ul class=' li2 list'>
                <li><b>POC</b> : ".$data[0]['client']['poc_name']."</li>
                <li><b>POC number</b> : ".$data[0]['client']['poc_phone']."</li>
                <li><b>Number Of Items</b>: ".count($data[0]['items'])."</li>
              </ul>
                
              <ul class='li3 list '>
                <li><b>Address </b>: ".$data[0]['client']['address']."</li>
              </ul>
            </div>";
            ?>
          </div>
          <div class="dispatch-table-details">
          </div>
          <div class="mdl-grid noPadRight noPadLeft" >
            <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone noMarLeft noMarRight'>
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-order="<?= $data[0]['order_id'];?>" id="send_dispatch" <?php if(isset($data[0]['dispatched']) && !empty(($data[0]['dispatched']))){echo "disabled";}; ?> style="float:right;">
                Confirm Dispatch
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- choose assignee screen -->
      <div class="mdl-card-event_assignee mdl-shadow--2dp assignScreen hidden">
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center"> 
          <div class="mdl-grid dispatch_delivery_boy">
            <div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet mdl-cell--6-col-phone  dispatch_delivery_boy_card  hidden" data-order-id="<?= $data[0]['order_id'];?>">
              <div class="dispatch_delivery_boy-event mdl-card mdl-shadow--2dp ">
                <div class="mdl-card__title "><h4></h4></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Assignee details -->
      <div class="mdl-card-event_assignee mdl-shadow--2dp selectedAssigneeScreen hidden" style="background:white;">
        <a class='mdl-button mdl-js-button mdl-button--icon assignee_back_btn' style='min-width: 20px;'>
          <i class='material-icons'>arrow_back</i>
        </a>
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone mdl-typography--text-center">
          <table class="mdl-data-table mdl-js-data-table selectedAssigneeInfo">
            
            <div class="disp-client">
              <span><b>Assignee : </b><span class="Assignee_name"></span></span>
            </div>
            <thead class="selected_assignee_thead hidden">
              <tr>
                <th class='hidden'></th>
                <th>Order ID</th>
                <th>Client Name</th>
                <th>Delivery Address</th>
                <th>Order Status</th>
                <th>Delivery Date</th>
              </tr>
            </thead>
            <tbody class="selected_assignee_tbody">
              <tr class="selected_assignee_trow hidden">
                <td class='hidden'></td>  
                <td></td> 
                <td></td>  
                <td></td> 
                <td></td> 
                <td></td>  
              </tr>             
            </tbody>
          </table>
          <div class="mdl-grid">
            <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone'>
              <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-order="<?= $data[0]['order_id'];?>" id="Assign" <?php if(isset($data[0]['dispatched']) && !empty(($data[0]['dispatched']))){echo "disabled";}; ?> style="float:right;">
                Assign
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  
</main>

<!--Empty Modal for dispatch-Report-->
<dialog id="dialog" class="mdl-dialog print_width" style="width: 64%;height: auto;-webkit-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 264px 194px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 299px 3333px rgba(0,0,0,0.75);">
    <button type="button" style="margin: 10px 0px 0px 25px;" onclick="window.print()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent print_hide">
    <i class="material-icons">print</i> Print
    </button>
  <div class="mdl-dialog__actions" style="float: right;">
    <button type="button" id="dialog-close" style="background-color: #ea4335;color: #ffffff;" class="mdl-button mdl-js-button mdl-button--fab btn_fab_for_edit mdl-js-ripple-effect print_hide">
    <i class="material-icons">clear</i>
    </button>
  </div>
  <div class="mdl-dialog__content dispatch_content">
   
  </div>
</dialog>

<script src="<?php echo base_url().'assets/js/globalFunction.js';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/dispatch.js';?>"></script>


