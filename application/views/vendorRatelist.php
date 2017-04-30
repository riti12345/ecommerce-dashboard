<?php
  $vendor_id  = $this->input->get('id');
  if(isset($vendor_id)) {
    $vendor = get_all_vendors($vendor_id);
    // echo print_array($vendor);die;
    $disp_vendor = json_decode($vendor,true);
    // echo print_array($disp_vendor[0]);die;
  }
  $permissions =get_session_data()['user']['permissions'];
  $perm_array = [0,2,3];
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">

    <span class="mdl-layout-title"><?= $disp_vendor[0]['name']; ?>'s Ratelist</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="search-vendor-rate">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="search-vendor-rate" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="search-vendor-rate"></label>
      </div>
    </div>
    
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="">
        <div class="vendor_ratelist_table">
          <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>
          <a style="right:5%;position:absolute;" href="download/csv/vrl_template" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                Download template
          </a>
          <?php if(sizeof($disp_vendor[0]['rateList']) > 0) : 
      echo"<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th id='sortItems'>Item Name <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                <th  id='sortItems'>Alternate Name <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                <th>UOM</th>
                <th>Price</th>
                <th>Period</th>";
                if(in_array($permissions,$perm_array)){
                echo"<th>Actions</th>";
                }
              echo"</tr>
            </thead>
            <tbody>";
              
                $sr_counter=0;
                foreach ($disp_vendor[0]['rateList'] as $i => $value) :
                  echo "<tr class='vendor-rateList-row'>
                          <td class='count'></td>
                          <td class='mdl-data-table__cell--non-numeric'>".$disp_vendor[0]['rateList'][$i]['item_name']."</td>
                          <td class='mdl-data-table__cell--non-numeric'>".$disp_vendor[0]['rateList'][$i]['alternate_name']."</td>
                          <td>".$this->config->item($disp_vendor[0]['rateList'][$i]['uom'],'uom')."</td>
                          <td>".$disp_vendor[0]['rateList'][$i]['price']."</td>
                          <td hidden>
                            <div class='mdl-textfield mdl-js-textfield'>
                              <input style='width:22%;' class='validate_number mdl-textfield__input' pattern='-?[0-9]*(\.[0-9]+)?' id='newPrice' value=".$disp_vendor[0]['rateList'][$i]['price']." >
                              <span class='mdl-textfield__error'>Input is not a number!</span>
                              <label> </label>
                            </div>
                          </td>
                          <td>".$this->config->item($disp_vendor[0]['rateList'][$i]['period'],'period')."</td>
                          <td hidden>
                            <div class='mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label'>
                              <select required=' id='item_period' class='mdl-selectfield__select input'>
                                <option value='".$disp_vendor[0]['rateList'][$i]['period']."' selected='selected'>".$this->config->item($disp_vendor[0]['rateList'][$i]['period'],'period')."</option>
                                <option value='0'>Daily</option>
                                <option value='1'>Weekly</option>
                                <option value='2'>Monthly</option>
                                <option value='3'>Anually</option>
                              </select>
                              <label class='mdl-selectfield__label' for='item_period'>Period</label>
                            </div>
                          </td>";
                          if(in_array($permissions,$perm_array)){
                          echo "<td>
                            <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored v_rate_edit'><i class='material-icons'>edit</i></a>
                            <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored v_rate_update' item-id='".$disp_vendor[0]['rateList'][$i]['item_id']."' vendor-id='".$vendor_id."'><i class='material-icons save_btn'>check_circle</i></a>  
                            <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored v_rate_cancel'><i class='material-icons cancel_btn'>cancel</i></a>
                          </td>";
                          }
                       echo"</tr>";?>

           <?php endforeach; ?>                    
            </tbody>
           </table>
           <?php else:
                  echo "<div class='mdl-card-status mdl-shadow--2dp'>
                  <p><i class='material-icons status_icon'>error</i><p>
                  <p><h3> Ratelist not yet uploaded ! <br> <br> Upload a Rate list.</h3></p>
                  </div>";
                endif;
           ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php if(in_array($permissions,$perm_array)):?>
<div class="fixed-action-btn">
  <input type="file" id="v_ratelist" style="display:none">
  <label for="v_ratelist" id="ratelistlabel" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
    <i class="material-icons">attach_file</i>
    <div class="mdl-tooltip mdl-tooltip--top" for="ratelistlabel" >Choose File</div>
  </label>
  <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-id="<?= $vendor_id; ?>" id="v_RatelistUpload" href="#">
    <i class="material-icons">file_upload</i>
    <div class="mdl-tooltip mdl-tooltip--top" for="v_RatelistUpload" >Upload</div>
  </a>
</div>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url().'assets/js/vendor.js';?>"></script>
