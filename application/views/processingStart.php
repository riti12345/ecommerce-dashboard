<?php
  $url = base64_decode($this->input->get('data'));
  // print_r($url);die;
  parse_str(parse_url($url)['path'], $query);

  $procid   = $query['procid'];
  $prossid  = $query['prossid'];
  $item_id  = $query['item_id'];
  $quantity = (isset($query['quantity'])) ? $query['quantity'] : NULL;
  $crate_no = (isset($query['crate_no'])) ? $query['crate_no'] : NULL;    
  $step_no  = (isset($query['step']))     ? $query['step']     : NULL;
  $status   = (isset($query['status']))   ? $query['status']   : NULL;  
  // print_r('<br>procid:'.$procid.'<br>prossid:'.$prossid.'<br>item_id:'.$item_id.'<br>quantity:'.$quantity.'<br>crate_no:'.$crate_no.'<br>step_no:'.$step_no.'<br>status:'.$status);die;

    $item = get_all_items($item_id);
    $disp_item = json_decode($item,true);

    $process =  json_decode(get_all_process($prossid),true);
    //echo print_array($process);die;
    //echo print_array($disp_item);die;
    $step_length = count($process[0]['steps']);
    $last_step = $step_length -1;
    $status_=$process[0]['status'];
    //echo print_array($process[0]['steps'][$last_step]['ga']);die;
    $data=$disp_item['data']['items'][0];
    $show =["hidden" ,""];
?>    
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
      <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Processing</span>
          <div class="mdl-layout-spacer"></div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
        <label class="mdl-button mdl-js-button mdl-button--icon" for="processing_start__search">
          <i class="material-icons hidden search-hide">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
          <input class="mdl-textfield__input hidden search-hide" type="text" id="processing_start__search" autofocus autocomplete="off" placeholder="Search..">
          <label class="mdl-textfield__label" for="processing_start__search"></label>
        </div>
      </div>
          
      </div>
    </header>
      <main class="mdl-layout__content mdl-color--grey-100 processing_start">
        <!-- breadcrum start -->
        <div class="mdl-grid processing_bread" >
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <div class="mdl-breadcrum">
            <?php
            //screen 1
            if( isset($process[0]['steps'][0]['step']) =='undefined'){
              $val = 0;
            }else{$val =1;}
            echo"<div class='breadcrumb flat' ".$show[$val]."><a href='#' class='active'>Step 1</a><a href='#'>Step 2</a><a href='#'>Step 3</a><a href='#'>Step 4</a><a href='#'>Step 5</a><a href='#'>Step 6</a></div>";
            
            // screen 2
            if(isset($process[0]['steps'][$last_step]['step'])){
            if($process[0]['steps'][$last_step]['step'] == 1 && $status_ == 2){
              $val = 1;
            }else{$val = 0;}
            echo"<div class='breadcrumb flat' ".$show[$val]."><a href='#' class='active'>Step 1</a><a href='#' class='active'>Step 2</a><a href='#'>Step 3</a><a href='#'>Step 4</a><a href='#'>Step 5</a><a href='#'>Step 6</a></div>";
            }
            // screen 3
            if(isset($process[0]['steps'][$last_step]['step'])){
            if($process[0]['steps'][$last_step]['step'] == 2 && $status_ == 2){
              $val = 1;
            }else{$val = 0;}
            echo"<div class='breadcrumb flat' ".$show[$val]."><a href='#' class='active'>Step 1</a><a href='#' class='active'>Step 2</a><a href='#' class='active'>Step 3</a><a href='#'>Step 4</a><a href='#'>Step 5</a><a href='#'>Step 6</a></div>";
            }
            // screen 4
            if(isset($process[0]['steps'][$last_step]['step'])){
            if($process[0]['steps'][$last_step]['step'] == 3 && $status_ == 2){
              $val = 1;
            }else{$val = 0;}
            echo"<div class='breadcrumb flat' ".$show[$val]."><a href='#' class='active'>Step 1</a><a href='#' class='active'>Step 2</a><a href='#' class='active'>Step 3</a><a href='#' class='active'>Step 4</a><a href='#'>Step 5</a><a href='#'>Step 6</a></div>";
            }
            // screen 5
            if(isset($process[0]['steps'][$last_step]['ga']) || (isset($process[0]['steps'][0]['ga']) =='undefined')) { 
            if($status == (2||3) || $status_== (2||3)){
              $val = 1;
            }else{$val =0;}
            echo"<div class='breadcrumb flat' ".$show[$val]."><a href='#' class='active'>Step 1</a><a href='#' class='active'>Step 2</a><a href='#' class='active'>Step 3</a><a href='#' class='active'>Step 4</a><a href='#' class='active'>Step 5</a><a href='#'>Step 6</a></div>";
            }
            //screen 6
            if(isset($process[0]['steps'][3]['gb']) && isset($process[0]['steps'][3]['gc']) || (isset($process[0]['steps'][0]['gb']) =='undefined') || (isset($process[0]['steps'][0]['gc']) =='undefined')){
             if($status == (4) || $status_ == (4)){
              $val = 1;
            }else{$val =0;}
            echo"<div class='breadcrumb flat' ".$show[$val]."><a href='#' class='active'>Step 1</a><a href='#' class='active'>Step 2</a><a href='#' class='active'>Step 3</a><a href='#' class='active'>Step 4</a><a href='#' class='active'>Step 5</a><a href='#' class='active'>Step 6</a></div>";
            }
            ?>
            </div> 
          </div>
        </div>
        <!-- breadcrum end -->
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col-desktop  mdl-cell--12-col-tablet  mdl-cell--12-col-phone" data-step="<?=$step_no?>;">
            <!-- Step 1 screen -->
            <?php
            if( isset($process[0]['steps'][0]['step']) =='undefined'){
              $val = 0;
            }else{$val =1;}
        echo"<div class='mdl-card-event_processing_start mdl-shadow--2dp stepOneScreen ".$show[$val]."'>
              <div> <h4 style='text-align:center;'><strong>STEP 1</strong></h4></div>
              <div class='mdl-grid'>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <h4>". $data['item_name']."</h4>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'>   
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input' type='text' max='".$process[0]['quantity']."' pattern='[0-9]{10,10}?$' id='quantity_stepOne' placeholder='' tabindex='1' autofocus>
                      <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_stepOne'>Quantity</label>
                      <span class='mdl-textfield__error'>We can not accept value more than ".$quantity." !</span>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                      <button class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored button stepOne' proc-id =".$procid." process-id =".$prossid." item-id =".$item_id." crate-no =".$crate_no." tabindex='2'>
                        <i class='material-icons'>navigate_next</i>
                      </button>
                  </div>
              </div>
            </div>";
            // step 2 screen
            if(isset($process[0]['steps'][$last_step]['step'])){
            if($process[0]['steps'][$last_step]['step'] == 1 && $status_ == 2){
              $val = 1;
            }else{$val = 0;}
        echo"<div class='mdl-card-event_processing_start mdl-shadow--2dp stepTwoScreen ".$show[$val]."'>
              <div> <h4 style='text-align:center;'><strong>STEP 2</strong></h4></div>
              <div class='mdl-grid'>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <h4>".$data['item_name']."</h4>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'>   
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input' type='text' pattern='[0-9]{10,10}?$' id='quantity_stepTwo' placeholder='' tabindex='3'>
                      <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_stepTwo'>Quantity</label>
                      <span class='mdl-textfield__error stepTwoErrMsg' data-error=".$process[0]['steps'][$last_step]['qty'].">We can not accept value more than ".$process[0]['steps'][$last_step]['qty']." !</span>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                      <button class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored button stepTwo' proc-id=".$procid." process-id =".$prossid." item-id =".$item_id." crate-no =".$crate_no." tabindex='4'>
                        <i class='material-icons'>navigate_next</i>
                      </button>
                  </div>
              </div>
            </div>";
          }
            // step 3 screen
            if(isset($process[0]['steps'][$last_step]['step'])){
            if($process[0]['steps'][$last_step]['step'] == 2 && $status_ == 2){
              $val = 1;
            }else{$val =0;}
        echo"<div class='mdl-card-event_processing_start mdl-shadow--2dp stepThreeScreen ".$show[$val]."'>
              <div> <h4 style='text-align:center;'><strong>STEP 3</strong></h4></div>
              <div class='mdl-grid'>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <h4>".$data['item_name']."</h4>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'>   
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input' type='text' pattern='[0-9]{10,10}?$' id='quantity_stepThree' placeholder='' tabindex='5'>
                      <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_stepThree'>Quantity</label>
                      <span class='mdl-textfield__error stepThreeErrMsg' data-error=".$process[0]['steps'][$last_step]['qty'].">We can not accept value more than ".$process[0]['steps'][$last_step]['qty']." !</span>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                      <button class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored button stepThree' proc-id=".$procid." process-id =".$prossid." item-id =".$item_id." crate-no =".$crate_no." tabindex='6'>
                        <i class='material-icons'>navigate_next</i>
                      </button>
                  </div>
              </div>
            </div>";
          }
            // step 4 screen grading
            if(isset($process[0]['steps'][$last_step]['step'])){
             if(($process[0]['steps'][$last_step]['step'] == 3 && $status_ == 2)){
              $val = 1;
            }else{$val =0;}
        echo"<div class='mdl-card-event_processing_start mdl-shadow--2dp stepFourScreen ".$show[$val]."'>
              <div> <h4 style='text-align:center;'><strong>GRADING</strong></h4></div>
              <div class='mdl-grid'>
                  <div class='mdl-cell mdl-cell--4-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <h4>".$data['item_name']."</h4>
                    </div>
                  </div>
              
                  <div class='mdl-cell mdl-cell--2-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'>   
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input' type='text' pattern='[0-9]{10,10}?$' id='quantity_grade_a' placeholder='Quantity' tabindex='7'>
                      <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_grade_a'>Grade A</label>
                      <span class='mdl-textfield__error gradeAErrMsg' data-error= ".$process[0]['steps'][$last_step]['qty'].">We can not accept value more than ".$process[0]['steps'][$last_step]['qty']." !</span>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--2-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'>   
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input' type='text' pattern='[0-9]{10,10}?$' id='quantity_grade_b' placeholder='Quantity' tabindex='8'>
                      <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_grade_b'>Grade B</label>
                      <span class='mdl-textfield__error gradeBErrMsg'></span>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--2-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'>   
                    <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                      <input class='mdl-textfield__input' type='text' pattern='[0-9]{10,10}?$' id='quantity_grade_c' placeholder='Quantity' tabindex='9'>
                      <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_grade_c'>Grade C</label>
                      <span class='mdl-textfield__error gradeCErrMsg'></span>
                    </div>
                  </div>
                  <div class='mdl-cell mdl-cell--2-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center'> 
                      <button class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored button stepFour' proc-id=".$procid." process-id =".$prossid." item-id =".$item_id." crate-no =".$crate_no." tabindex='10'>
                        <i class='material-icons'>navigate_next</i>
                      </button>
                  </div>
              </div>
            </div>";
          }
            // step 5 screen sealable screen
          if(isset($process[0]['steps'][$last_step]['ga']) || (isset($process[0]['steps'][0]['ga']) =='undefined')) { 
            if($status == (2||3) || $status_== (2||3)){
              $val = 1;
            }else{$val =0;}
        echo"<div class='mdl-card-event_processing_start mdl-shadow--2dp stepFiveScreen ".$show[$val]."'>
               <div> <h4 style='text-align:center;'><strong>SALEABLE</strong></h4></div>
              <div class='mdl-grid'>
                  <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone mdl-typography--text-center'> 
                    <table class='mdl-data-table_StepFive_head mdl-js-data-table'>
                      <tbody>
                        <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                          
                          <span><h4>".$data['item_name']." : <span class='grade_a_weight'>".$process[0]['steps'][$last_step]['ga']."</span> </h4> </span>";
                         // <span><h4>Crate No : ".$crate_no." </h4></span>
                        echo"</div>
                        <tr class='StepFive_select_item_row'>
                          <td></td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label' style=''>
                              <input class='mdl-textfield__input input_search' type='text' id='stepFive_selectItem' autocomplete='off' placeholder='' tabindex='11'>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label' for='selectOrderItem'>Select Items</label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient'></ul>
                              </div>
                            </div>   
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input input_search' type='text' id='stepFive_crate' autocomplete='off' placeholder='' tabindex='12'/>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label mdl-textfield__label_addOrder' for='stepFive_crate'>Crate No.</label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient' style='width:130%;text-align:left;'></ul>
                              </div>
                            </div>
                          </td>
                          <td>
                             <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input ' type='text' id='stepFive_sku' value='' placeholder='' readonly='' />
                              <label class='mdl-textfield__label' for='stepFive_sku'>SKU</label>
                             </div>
                           </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input' type='text' pattern='[0-9]{10,10}?$' id='quantity_stepFive' placeholder='' tabindex='13'>
                              <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_stepFive'>Quantity</label>
                              <span class='mdl-textfield__error stepFiveErrMsg' data-error=".$process[0]['steps'][3]['ga'].">We can not accept value more than ".$process[0]['steps'][3]['ga']." !</span>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-spinner mdl-spinner--single-color mdl-js-spinner'></div>
                            <button class='mdl-button mdl-js-button mdl-button--icon mdl-button--colored stepFive_append_item' id='' tabindex='14'>
                              <i class='material-icons'>done</i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone mdl-typography--text-center stepFiveScreen_appendTable hidden'> 
                    <table class='mdl-data-table mdl-data-table_stepFive mdl-js-data-table'>
                      <thead>
                        <tr>
                          <th style='padding-left: 14px;'>Sr. No.</th>
                          <th class='mdl-data-table__cell--non-numeric' id='sortItems'>Items</th>
                          <th>Crate No.<a></th>
                          <th>Sku</th>
                          <th>Quantity<a></th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class='stepFive_tbody'>
                        <tr class='StepFive_append_item_row hidden'>
                          <td class='count'></td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_processing_stepFive mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border' type='text' readonly>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_processing_stepFive mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border' type='text' id='crate_edit' readonly>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label' for='crate_edit'></label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient'></ul>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_processing_stepFive mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border' type='number' id='edit_sku' readonly>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_processing_stepFive mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border edit_unit' type='number' id='edit_quantity' readonly>
                            </div>
                          </td>
                          <td>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_edit stepFive-row-edit' tabindex='15'>
                              <i class='material-icons'>create</i>
                            </button>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_delete stepFive-row-delete' tabindex='16'>
                              <i class='material-icons'>delete</i>
                            </button>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_update stepFive-row-done hidden' tabindex='16'>
                              <i class='material-icons'>done</i>
                            </button>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_delete stepFive-row-cancel hidden' tabindex='17'>
                              <i class='material-icons'>cancel</i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot> 
                        <tr role='row'> 
                          <td></td>
                          <td rowspan='1' colspan='3'  class=''>
                            <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone'>
                              <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent button stepFive_submitBtn' proc-id=".$procid." process-id =".$prossid." crate-no =".$crate_no." tabindex='18'>Submit</button>
                            </div>
                          </td>
                          <td rowspan='1' colspan='2' class=''></td> 
                        </tr> 
                      </tfoot>
                    </table>
                  </div>
              </div>
            </div>";
        } 
           //step 6 screen leftovers
        if(isset($process[0]['steps'][3]['gb']) && isset($process[0]['steps'][3]['gc']) || (isset($process[0]['steps'][0]['gb']) =='undefined') || (isset($process[0]['steps'][0]['gc']) =='undefined')){
             if($status == (4) || $status_ == (4)){
              $val = 1;
            }else{$val =0;}
        echo"<div class='mdl-card-event_processing_start mdl-shadow--2dp stepSixScreen ".$show[$val]."'>
              <div> <h4 style='text-align:center;'><strong>LEFTOVERS</strong></h4></div>
              <div class='mdl-grid'>
                  <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone mdl-typography--text-center'> 
                    <table class='mdl-data-table_StepSix_head mdl-js-data-table'>
                      <tbody>
                        <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                          <span><h4>".$data['item_name']." </h4> </span></br>
                          <p><span><b>Grade B </b> :".$process[0]['steps'][3]['gb']." </span><span><b>Grade C </b>:".$process[0]['steps'][3]['gc']." </span></p>
                        </div>
                        <tr class='StepSix_select_item_row'>
                          <td></td>
                          <td>
                            <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
                              <select class='mdl-selectfield__select grade_bc' id='gradeBC'>
                               <option value='' select='selected'></option>
                               <option value='B' data-value=".$process[0]['steps'][3]['gb'].">Grade B</option>
                               <option value='C' data-value=".$process[0]['steps'][3]['gc'].">Grade C</option>
                              </select>
                              <label class='mdl-selectfield__label' for='gradeBC'>Grade</label>
                            </div>   
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input input_search' type='text' id='stepSix_crate' autocomplete='off' placeholder='' tabindex='12'/>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label' for='stepSix_crate'>Crate No.</label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient' style='width:130%;text-align:left;'></ul>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_Processing_start mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input' type='text' pattern='[0-9]{10,10}?$'' id='quantity_stepSix' placeholder='' tabindex='13'>
                              <label class='mdl-textfield__label mdl-textfield__label_processing_start' for='quantity_stepSix'>Quantity</label>
                              <span class='mdl-textfield__error stepSixErrMsg'></span>
                            </div>
                          </td>
                          <td>
                            <button class='mdl-button mdl-js-button mdl-button--icon mdl-button--colored stepSix_append_item' id='' tabindex='14'>
                              <i class='material-icons'>done</i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet  mdl-cell--6-col-phone mdl-typography--text-center stepSixScreen_appendTable hidden'> 
                    <table class='mdl-data-table mdl-data-table_stepSix mdl-js-data-table'>
                      <thead>
                        <tr>
                          <th style='padding-left: 14px;'>Sr. No.</th>
                          <th class='mdl-data-table__cell--non-numeric' id='sortItems'>Grade</th>
                          <th>Crate No.<a></th>
                          <th>Quantity<a></th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class='stepSix_tbody'>
                        <tr class='StepSix_append_item_row hidden'>
                          <td class='count'></td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_processing_stepSix mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border' type='text' readonly>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_processing_stepSix mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border' type='text' id='stepSix_crate_edit' readonly>
                              <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                                <span class='mdl-chip__text'></span>
                                <button type='button' class='mdl-chip__action'>
                                <i class='material-icons'>cancel</i></button>
                              </span>
                              <label class='mdl-textfield__label' for='stepSix_crate_edit'></label>
                              <div class='suggestionClient hidden'>
                                 <ul class='suggestionListClient'></ul>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-textfield_processing_stepSix mdl-js-textfield mdl-textfield--floating-label'>
                              <input class='mdl-textfield__input mdl-textfield__input_border edit_unit' type='number' id='stepSix_edit_quantity' readonly>
                            </div>
                          </td>
                          <td>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_edit stepSix-row-edit' tabindex='15'>
                              <i class='material-icons'>create</i>
                            </button>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_delete stepSix-row-delete' tabindex='16'>
                              <i class='material-icons'>delete</i>
                            </button>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_update stepSix-row-done hidden' tabindex='16'>
                              <i class='material-icons'>done</i>
                            </button>
                            <button class='mdl-button mdl-js-button mdl-button--icon processingStart_delete stepSix-row-cancel hidden' tabindex='17'>
                              <i class='material-icons'>cancel</i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot> 
                        <tr role='row'> 
                          <td></td>
                          <td rowspan='1' colspan='3'  class=''>
                            <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone'>
                              <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent button stepSix_submitBtn' proc-id=".$procid." process-id =".$prossid." item-id =".$item_id." crate-no =".$crate_no." tabindex='18'>Submit</button>
                            </div>
                          </td>
                          <td rowspan='1' colspan='2' class=''></td> 
                        </tr> 
                      </tfoot>
                    </table>
                  </div>
              </div>
            </div>";
        }
            ?>
          </div>
        </div>
      </main>
     
    <script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
    <script>
     var allCrates = <?php echo get_all_crates()?>;
    </script>