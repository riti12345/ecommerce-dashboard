<?php
  $client_id  = $this->input->get('id');
  if(isset($client_id)) {
    $client = get_all_clients($client_id);
    // echo print_array($client);die;
    $disp_client = json_decode($client,true);
    //echo print_array($disp_client[0]);die;
    $perm_array  = [0,2,3];
    $permissions = get_session_data()['user']['permissions'];
  }
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title"><?=$disp_client[0]['name'];?>'s Ratelist</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="searchClientRate">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder ">
        <input class="mdl-textfield__input" type="text" id="searchClientRate" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="searchClientRate"></label>
      </div>
    </div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="">
        <div class="client_ratelist_table">
        <div class="mdl-grid template">
            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <button class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back()" style=" min-width: 20px;">
                <i class="material-icons">arrow_back</i>
              </button>
              <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="<?php echo base_url()."api/manage_clients/pdf_rateList?id=".$client_id;?>">Download Ratelist</a>
              <a style="right:5%;position:absolute;" href="download/csv/crl_template" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                Download template
              </a>
            </div>
           <?php
           $thead = ["hidden",""];
                $sr_counter=0;
                $decode_category=['','Vegetables','English Vegetables','Fruits'];
                $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];
                $count = count($disp_client[0]['rate_list']);
                if($count == 0){
                  $length =0;
                  echo"<div class='mdl-card-status mdl-shadow--2dp'>
                          <p><i class='material-icons status_icon'>error</i><p>
                        <p><h3> Ratelist not yet uploaded ! <br> <br> Upload a Rate list.</h3></p>
                      </div>";
                }else{
                  $length=1;
                }
          echo"<table class='mdl-data-table tableClientRateList mdl-js-data-table  mdl-shadow--2dp' id='clients_list'>
                  <thead ".$thead[$length].">
                    <tr>
                      <th>Sr. No.</th>
                      <th id='sortItems'>Item Name <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                      <th id='sortItems'>Alternate Name <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                      <th>UOM</th>
                      <th class=''>Price</th>
                      <th>Type</th>";
                      if(in_array($permissions,$perm_array)){
                      echo"<th>Actions</th>";
                      }
                    echo "</tr>
                  </thead>
                  <tbody>
                    <tr class='addItem hidden'>
                       <td class='count'></td>
                        <td><div class='mdl-textfield mdl-js-textfield'>
                        <input class='mdl-textfield__input input_search' autocomplete='off' type='text' id='add_item_name'>
                        <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                          <span class='mdl-chip__text'></span>
                          <button type='button' class='mdl-chip__action'>
                          <i class='material-icons'>cancel</i></button>
                        </span>
                        <label class='mdl-textfield__label' for='add_item_name'>Item Name...</label>
                         <div class='suggestionClient hidden'>
                          <ul class='suggestionListClient' style='width: 98%;'></ul>
                         </div>
                        </div> </td>
                        <td><div class='mdl-textfield mdl-js-textfield'>
                        <input class='mdl-textfield__input' type='text' id='add_alternate_name' placeholder='auto' readonly=''>
                        <label class='mdl-textfield__label' for='add_alternate_name'>alternate Item Name...</label>
                        </div></td>
                        <td>
                          <div class='mdl-textfield mdl-js-textfield'>
                              <input style='width:55%;' class='mdl-textfield__input' readonly='' placeholder='auto'>
                              <label> </label>
                            </div>
                          </td>
                          <td>
                            <div class='mdl-textfield mdl-js-textfield'>
                              <input style='width:55%;' class='validate_number mdl-textfield__input' pattern='-?[0-9]*(\.[0-9]+)?' id='Price'>
                              <span class='mdl-textfield__error'>Input is not a number!</span>
                              <label> </label>
                            </div>
                          </td>
                           <td>
                            <div class='mdl-selectfield mdl-js-selectfield clientSelectField' style='width:150px;'>
                              <select required=' id='add_item_period' class='mdl-selectfield__select input'>
                                <option value='0'>Daily</option>
                                <option value='1'>Weekly</option>
                                <option value='2'>Monthly</option>
                                <option value='3'>Annual</option>
                              </select>
                              
                            </div>
                          </td>
                           <td>
                            <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect c_add_item' client-id='".$client_id."'><i class='material-icons save_btn'>check_circle</i></a>  
                            <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect  c_ratelist_cancel'><i class='material-icons c_rate_cancel'>cancel</i></a>
                          </td>
                        </tr>";
                foreach ($disp_client[0]['rate_list'] as $i => $value) :
                  echo "<tr class='client_rateList_row'>
                          <td class='count'></td>
                          <td class='mdl-data-table__cell--non-numeric'>".$disp_client[0]['rate_list'][$i]['item_name']."<span class='hidden'>".$decode_category[$disp_client[0]['rate_list'][$i]['category']]."</span></td>
                          <td class='mdl-data-table__cell--non-numeric'>".$disp_client[0]['rate_list'][$i]['alternate_name']."<span class='hidden'>".$decode_subcategory[$disp_client[0]['rate_list'][$i]['subcategory']]."</span></td>
                          <td>".$this->config->item($disp_client[0]['rate_list'][$i]['uom'],'uom')."</td>
                          <td class=''> &#8377; ".$disp_client[0]['rate_list'][$i]['price']."</td>
                          <td hidden>
                            <div class='mdl-textfield mdl-js-textfield'>
                              <input style='width:55%;' class='validate_number mdl-textfield__input' pattern='-?[0-9]*(\.[0-9]+)?' id='newPrice' value=".$disp_client[0]['rate_list'][$i]['price']." >
                              <span class='mdl-textfield__error'>Input is not a number!</span>
                              <label> </label>
                            </div>
                          </td>
                          <td>".$this->config->item($disp_client[0]['rate_list'][$i]['period'],'period')."</td>
                          <td hidden>
                            <div class='mdl-selectfield mdl-js-selectfield clientSelectField'>
                              <select required=' id='item_period' class='mdl-selectfield__select input'>
                                <option value='".$disp_client[0]['rate_list'][$i]['period']."' selected='selected'>".$this->config->item($disp_client[0]['rate_list'][$i]['period'],'period')."</option>
                                <option value='0'>Daily</option>
                                <option value='1'>Weekly</option>
                                <option value='2'>Monthly</option>
                                <option value='3'>Annual</option>
                              </select>
                              
                            </div>
                          </td>";
                          if(in_array($permissions,$perm_array)){
                          echo"<td>
                            <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored c_rate_edit'><i class='material-icons'>edit</i></a>
                            <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored c_rate_update' item-id='".$disp_client[0]['rate_list'][$i]['item_id']."' client-id='".$client_id."'><i class='material-icons save_btn'>check_circle</i></a>  
                            <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored c_rate_cancel'><i class='material-icons cancel_btn'>cancel</i></a>
                          </td>";
                          }
                       echo"</tr>";
                endforeach;
              ?>
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php if(in_array($permissions,$perm_array)):?>
<div class="fixed-action-btn">
  <input type="file" id="c_ratelist" style="display:none">
  <label for="c_ratelist" id="ratelistlabel" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
    <i class="material-icons">attach_file</i>
    <div class="mdl-tooltip mdl-tooltip--top" for="ratelistlabel" >Choose File</div>
  </label>
  <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-id="<?= $client_id; ?>" id="c_RatelistUpload" href="#">
    <i class="material-icons">file_upload</i>
    <div class="mdl-tooltip mdl-tooltip--top" for="c_RatelistUpload" >Upload</div>
  </a>
  <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-id="<?= $client_id; ?>" id="c_add_new_item" href="#">
    <i class="material-icons">add</i>
    <div class="mdl-tooltip mdl-tooltip--top" for="c_add_new_item" >add new item</div>
  </a>
</div>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url().'assets/js/client.js';?>"></script>