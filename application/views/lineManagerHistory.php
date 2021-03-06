<?php
  $team_id = $this->input->get('id');
  if(isset($team_id)){
    $history = get_all_line_manager_history($team_id);
    //echo print_array($history);die;
    $today = date("Y-m-d");
    $processing = '';
    $completed = '';
    $old = '';
    $count_processing = 0;
    $count_completed = 0;
    $count_old = 0;
    foreach($history as $key => $value) {
        $ip = $value['added_on']; 
        $iparr = preg_split ("/[\s,]+/", $ip);
        $originalDate = $iparr[0];
        $newDate = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($originalDate));
      if((isset($value['status'])==1) && ($originalDate == $today)){
        $processing .= "<tr class='del-boy-hist-row'>
            <td class='hidden'></td>  
            <td>".$value['code']."</td> 
            <td>".$value['item_name']."</td>  
            <td>".$value['quantity']."</td> 
            <td>".$this->config->item($value['status'],'line_manager_status')."</td> 
            <td>".$newDate."</td>  
            </tr>";
            $count_processing++;
      }else if((isset($value['status']) ==5) && ($originalDate==$today)){
          $completed .= "<tr class='del-boy-hist-row'>
            <td class='hidden'></td>  
            <td>".$value['code']."</td> 
            <td>".$value['item_name']."</td>  
            <td>".$value['quantity']."</td> 
            <td>".$this->config->item($value['status'],'line_manager_status')."</td> 
            <td>".$newDate."</td>  
            </tr>";
            $count_completed++;
        }else if((isset($value['status'])==1) && $originalDate< $today){
          $old .= "<tr class='del-boy-hist-row'>
            <td class='hidden'></td>  
            <td>".$value['code']."</td> 
            <td>".$value['item_name']."</td>  
            <td>".$value['quantity']."</td> 
            <td>".$this->config->item($value['status'],'line_manager_status')."</td> 
            <td>".$newDate."</td>  
            </tr>";
            $count_old++;
          }    
    }
    //echo print_array($history);
    //die;
  }
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">History</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="line_manager_history_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="line_manager_history_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="line_manager_history_info_search"></label>
      </div>
    </div>
  </div>

  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab mdl-layout__tab_3  is-active">Processing</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab mdl-layout__tab_3 tab_switch">Completed</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab mdl-layout__tab_3 tab_switch">History</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
      
      <div class="mdl-grid">
      <!-- <button class='mdl-button mdl-js-button mdl-button--icon' onclick='window.history.back()' style='min-width: 20px;'>
        <i class='material-icons'>arrow_back</i>
      </button> -->
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone processing">
           <?php
              $thead = ["hidden",""];
                if($count_processing == 0){
                  $length =0;
                  echo"<div class='mdl-card-status mdl-shadow--2dp'>
                          <p><i class='material-icons status_icon'>error</i><p>
                        <p><h3> No Procurements. <br> <br> </h3></p>
                      </div>";
                }else{
                  $length=1;
                }
      echo" 
          <table class='mdl-data-table table_procureInfo mdl-js-data-table  mdl-shadow--2dp line-manager-hist-table' ".$thead[$length].">
            <thead>
              <tr>
                <th class='hidden'>Sr.No.</th>
                <th>Crate</th>
                <th>Item Name<span class='sort_out'><i class='material-icons sort_icon'>sort_by_alpha</i></span></th>
                <th>Quantity</th>
                <th>Processing Status</th>
                <th>Procure Date</th>
              </tr>
            </thead>
            <tbody class='line-manager-hist-tbody'>";
             echo $processing;
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone completed">
           <?php
          $thead = ["hidden",""];
                if($count_completed == 0){
                  $length =0;
                  echo"<div class='mdl-card-status mdl-shadow--2dp'>
                          <p><i class='material-icons status_icon'>error</i><p>
                        <p><h3> Procurement coming soon ! <br> <br> </h3></p>
                      </div>";
                }else{
                  $length=1;
                }
      echo" <a class='mdl-button mdl-js-button mdl-button--icon disp_none' href='line_manager' style='min-width: 20px;' ".$thead[$length].">
              <i class='material-icons'>arrow_back</i>
            </a>
          <table class='mdl-data-table table_procureInfo mdl-js-data-table  mdl-shadow--2dp line-manager-hist-table' ".$thead[$length].">
            <thead>
              <tr>
                <th class='hidden'>Sr.No.</th>
                <th>Crate</th>
                <th>Item Name <span class='sort_out'><i class='material-icons sort_icon'>sort_by_alpha</i></span></th>
                <th>Quantity</th>
                <th>Processing Status</th>
                <th>Procure Date</th>
              </tr>
            </thead>
            <tbody class='line-manager-hist-tbody'>";
              echo $completed;
                
                  ?>              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div class="page-content">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone history">
           <?php
          $thead = ["hidden",""];
                if($count_old == 0){
                  $length =0;
                  echo"<div class='mdl-card-status mdl-shadow--2dp'>
                          <p><i class='material-icons status_icon'>history</i><p>
                        <p><h3>No history! <br> <br></h3></p>
                      </div>";
                }else{
                  $length=1;
                }
      echo" <a class='mdl-button mdl-js-button mdl-button--icon disp_none' href='line_manager' style='min-width: 20px;' ".$thead[$length].">
              <i class='material-icons'>arrow_back</i>
            </a>
          <table class='mdl-data-table table_procureInfo mdl-js-data-table  mdl-shadow--2dp line-manager-hist-table' ".$thead[$length].">
            <thead>
              <tr>
                <th class='hidden'>Sr.No.</th>
                <th>Crate</th>
                <th>Item Name <span class='sort_out'><i class='material-icons sort_icon'>sort_by_alpha</i></span></th>
                <th>Quantity</th>
                <th>Processing Status</th>
                <th>Procure Date</th>
              </tr>
            </thead>
            <tbody class='line-manager-hist-tbody'>";
              echo $old;      
                  ?>              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>
<script src="<?php echo base_url().'assets/js/line_manager.js';?>"></script>