  <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title"></span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
          <label class="mdl-button mdl-js-button mdl-button--icon" for="track_vehicle_history">
            <i class="material-icons">search</i>
            <div class="mdl-tooltip mdl-tooltip--left" for="track_vehicle_history" >Search an item</div>
          </label>
          <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" id="track_vehicle_history" autofocus autocomplete="off" placeholder="Search..">
            <label class="mdl-textfield__label" for="track_vehicle_history"></label>
          </div>
        </div>
      </div>
  </header>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
            <table class='mdl-data-table mdl-js-data-table orderInfo_table'>
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th class='' id='sortItems'>source</th>
                    <th>Destination</th>
                    <th class=''>route</th>
                    <th>distance travelled</th>
                    <th class=''>Duration</th>
                    <th >Date</th>
                  </tr>
                </thead>
                <tbody class='order_info_body'>
                  <tr class=''>
                    <td class='count'></td>
                    <td>Bhandup</td>
                    <td>Powai</td>
                    <td>Powai</td>
                    <td>10km</td>
                    <td>50m</td>
                    <td>14th jan 2017</td>
                  </tr> 
                  <tr class=''>
                    <td class='count'></td>
                    <td>Bhandup</td>
                    <td>Sakinaka</td>
                    <td>powai</td>
                    <td>15km</td>
                    <td>150m</td>
                    <td>12th dec 2016</td>
                  </tr> 
                  <tr class=''>
                    <td class='count'></td>
                    <td>Bhandup</td>
                    <td>Kanjur</td>
                    <td>Powai</td>
                    <td>5km</td>
                    <td>20m</td>
                    <td>3rd jan 2017</td>
                  </tr> 
                  <tr class=''>
                    <td class='count'></td>
                    <td>Bhandup</td>
                    <td>Kurla</td>
                    <td>powai</td>
                    <td>30km</td>
                    <td>300m</td>
                    <td>14th nov 2016</td>
                  </tr> 
                </tbody>
                 
              </table>
            </div>
          </div>
        </div>
      </main>
    <script src="<?php echo base_url().'assets/js/vehicle.js';?>"></script>    
    
  