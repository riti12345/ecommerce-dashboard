<?php
$data = get_all_transport_track();
// echo print_array($data);die;
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
 <form class="navbar-form" role="search" action="<?php echo base_url()."api/manage_delivery/pdf_transport";?>" method="post">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Vehicle Updates</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="vehicle_update_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" name="search"  id="vehicle_update_search" autofocus placeholder="Search.." autocomplete='off'>
      </div>
    </div>
  </div>
  <div align="=right"  >
  <button  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Download </button>
   </div>    
    
   </form>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
 <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
  <div class="page-content">
     <div class="mdl-grid vehicle">
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
          <div class="card-details mdl-shadow--2dp">
            <table class="mdl-data-table_vehicle_head mdl-js-data-table vehicleTable">
                <tbody>
                     <tr class="update_add_row">
                        <td>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input validate_date" type="text" id="datepicker" placeholder=""/ tabindex="1">                           
                            <input class="mdl-textfield__input validate_date hidden" type="text" id="update_date" placeholder="" />
                            <label class="mdl-textfield__label mdl-textfield__label" for="update_date">Date</label>
                          </div>
                        </td>
                        <td>
                          <div class="mdl-textfield mdl-textfield_order mdl-js-textfield mdl-textfield--floating-label" style="">
                            <input class="mdl-textfield__input input_search" type="text" id="driver_name" autocomplete="off" placeholder="" tabindex="2">
                            <span class="mdl-chip mdl-chip--deletable Deletable_Chip hidden">
                              <span class="mdl-chip__text"></span>
                              <button type="button" class="mdl-chip__action">
                              <i class="material-icons">cancel</i></button>
                            </span>
                            <label class="mdl-textfield__label" for="driver_name">Name of the Driver</label>
                            <div class="suggestionClient hidden">
                               <ul class="suggestionListClient "></ul>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="vehicle_no" placeholder="" readonly>
                            <label class="mdl-textfield__label" for="vehicle_no">Vehicle Number</label>
                          </div>   
                        </td>
                        <td>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="time" id="in_time" placeholder="" tabindex="3">
                            <label class="mdl-textfield__label" for="in_time">In Time</label>
                          </div>   
                        </td>
                        <td>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="number" id="in_km" placeholder="" tabindex="4">
                            <label class="mdl-textfield__label" for="in_km">In KM</label>
                          </div>   
                        </td>
                        <td>
                          <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="add_update" tabindex="5">
                            <i class="material-icons">done</i>
                         </button>
                      </td>
                    </tr>                
                </tbody>                       
            </table>
          </div>
          <div class="mdl-card-event_add_vehicle addUpdateScreen mdl-card mdl-shadow--2dp">
            <table class="mdl-data-table table_vehicle mdl-js-data-table vehicleTableInfo">
              <thead>
                <tr>
                  <th>Sr No.</th> 
                  <th>Date</th>
                  <th class="pull_center">Name of the Driver</th>
                  <th class="pull_center">Vehicle Number</th>
                  <th>In Time</th>
                  <th>In KM</th>
                  <th>Out Time</th>
                  <th>Out KM</th>
                  <th>Total KM</th>
                  <th>Actions</th>
                  <th class='hidden'></th>
                </tr>
              </thead>
              <tbody class="vehicle_infoTbody">
              <?php
                foreach ($data as $key => $value):
                echo "<tr class='vehicle_row'>
                    <td class='count update_td'></td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['date']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['owner_name']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['reg_no']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['in_time']."' type='time' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border in' value='".$value['in_km']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['out_time']."' type='time' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border out' value='".$value['out_km']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td>
                      <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                        <input class='mdl-textfield__input mdl-textfield__input_border' value='".$value['final_km']."' type='text' id='' readonly>
                      </div>
                    </td>
                    <td> 
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored edit_track '><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored update_track' data-id=".$value['track_id']." data-trans=".$value['transport_id']."><i class='material-icons save_btn'>check_circle</i></a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored cancel_track'><i class='material-icons cancel_btn'>cancel</i></a>  
                    </td>
                </tr>";
                 endforeach;
                ?>              
              </tbody>
            </table>
            <table hidden="">
              <thead>
                <tr>
                  <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th> 
                </tr>
              </thead>
              <tbody class="" hidden="">
                <tr class="vehicle_item ">
                    <td class="count update_td"></td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border" type="time" id="" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border in" type="text" id="" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border" type="time" id="" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border out" type="text" id="" readonly>
                      </div>
                    </td>
                    <td>
                      <div class="mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input mdl-textfield__input_border" type="text" id="" readonly>
                      </div>
                    </td>
                    <td> 
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored edit_track '><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored update_track'><i class='material-icons save_btn'>check_circle</i></a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored cancel_track'><i class='material-icons cancel_btn'>cancel</i></a>  
                    </td>
                </tr>              
              </tbody>
            </table>
          </div>
        </div>
     </div>
  </div>
  <!-- Dynamic search div -->
   <div class="dynamic_search hidden">
     <div class="mdl-grid">
       <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone">
         <h4>SEARCH RESULTS</h4>
       </div>
       <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone">
         <h4>
            <button class="mdl-button mdl-js-button mdl-button--icon" id="dynamic_div_close"><i class="material-icons">clear</i></button>
          </h4>
        </div>
      </div>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--1-col-phone">
       <div class="mdl-card-event_add_vehicle addUpdateScreen mdl-card mdl-shadow--2dp">
        <table class="mdl-data-table table_vehicle mdl-js-data-table vehicleTableInfo">
            <thead>
              <tr>
                <th>Sr No.</th> 
                <th>Date</th>
                <th class="pull_center">Name of the Driver</th>
                <th class="pull_center">Vehicle Number</th>
                <th>In Time</th>
                <th>In KM</th>
                <th>Out Time</th>
                <th>Out KM</th>
                <th>Total KM</th>
                <th>Actions</th>
                <th class='hidden'></th>
              </tr>
            </thead>
           <tbody class="searchResultTable">
          </tbody>
        </table>
      </div>
     </div>
    </div> 
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more print_hide">
    Show More
  </button>
</main>
<script src="<?php echo base_url().'assets/js/vehicle.js';?>"></script>
