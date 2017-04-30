<?php
$vehicle_id  = $this->input->get('vehicle_id');
$order_id = $this->input->get('id');
$client_id = $this->input->get('client_id');
$client_name = $this->input->get('client_name');
//$vehicles = json_decode(get_all_transport($vehicle_id),true)[0];
  // echo print_array($vehicles);die;
?>

<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Vehicle track details</span>
    <div class="mdl-layout-spacer"></div>
   </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100" onload = "myMap()" >
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__clientInfo">
          <button class="mdl-button mdl-js-button mdl-button--icon btn_icon_shadow" onclick="window.history.back()" style=" min-width: 20px;">
            <i class="material-icons">arrow_back</i>
          </button>
          <div class="mdl-grid">
            <div  class="mdl-cell--4-col mdl-cell--4-col-tablet  mdl-cell--4-col-phone">
              <p>Total Distance: <span id="total"></span>  </p>
              <p>Total time: <span id="time"></span></p>
            </div>
            <div class="mdl-cell--4-col mdl-cell--4-col-tablet  mdl-cell--4-col-phone">
              <p>Elapsed Distance:<span id="elapsed_d"></span> </p>
              <p>Elapsed Time:<span id="elapsed_t"></span></p>
            </div>
            <div class="mdl-cell--4-col mdl-cell--4-col-tablet  mdl-cell--4-col-phone">
              <p>Distance Covered:<span id="covered_d"></span> </p>
              <p>Time:<span id="consumed_t"></span></p>
            </div>
          </div>
        <div id="map" style="width:100%;height:500px" class="map_div" order-id="<?= $order_id; ?>" client-id="<?= $client_id; ?>" client-name="<?= $client_name; ?>">
        </div>
        <div id="floating-panel">
          <b>Mode of Travel: </b>
          <select id="mode">
            <option value="DRIVING">Driving</option>
            <option value="WALKING">Walking</option>
            <option value="BICYCLING">Bicycling</option>
            <option value="TRANSIT">Transit</option>
          </select>
        </div>
          
      </div> 
    </div>  
  </div>
</main>

<script src="<?php echo base_url().'assets/js/map.js';?>"></script>