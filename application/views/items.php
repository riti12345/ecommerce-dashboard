  <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Items</span>
      <div class="mdl-layout-spacer">
        <!-- <a href="addItem" class="mdl-button mdl-js-button  mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style=" margin-left:15px;    padding: 0px 12px;">Add Item</a> -->
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
        <label class="mdl-button mdl-js-button mdl-button--icon" for="searchItem">
          <i class="material-icons" for="searchIcon">search</i>
          <div class="mdl-tooltip mdl-tooltip--bottom" for="searchItem" > Search Items</div>
        </label>
        <div class="mdl-textfield__expandable-holder">
          <input class="mdl-textfield__input" type="text" id="searchItem" autofocus autocomplete="off" placeholder="Search..">
          <label class="mdl-textfield__label" for="searchItem"></label>
        </div>
      </div>
  </header>
  <main class="mdl-layout__content mdl-color--grey-100" ng-controller="itemCtrl">
      <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
      <div class="mdl-grid itemView">
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--1-col-phone  noMarTop noMarBottom"> 
          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
            <select required="" id="search_item_category" class="mdl-selectfield__select" >
                <option selected="selected" value="0">All</option>
                <option value="1">Vegetables</option>
                <option value="2">English Vegetables</option>
                <option value="3">Fruits</option>
            </select>
            <label class="mdl-selectfield__label" for="item_category">Category</label>
          </div>  
        </div> 
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone  noMarTop noMarBottom">  
          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
              <select required="" id="search_item_sub_category" class="mdl-selectfield__select">
                <option selected="selected" value="0">All</option>
                    <option value="1">Domestic</option>
                    <option value="2">Leafy</option>
                    <option value="3">OTP</option>
                    <option value="4">Herbs</option>
                    <option value="5">Lettuces</option>
                    <option value="6">Sprouts</option>
                    <option value="7">Greens</option>
                    <option value="8">Continental</option>
                    <option value="9">Chinese &amp; Thai </option>
                    <option value="10">Mint</option>
                    <option value="11">Microgreens</option>
                    <option value="12">Cheery Tomatoes</option>
                    <option value="13">Regular</option>  
                    <option value="14">Local</option>  
                    <option value="15">Imported</option>   
              </select>
              <label class="mdl-selectfield__label" for="item_sub_category">Sub-Category</label>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone">  
          <div class="header_icon pull-right" id="view_item_list">
            <span class="list_view mdl-button mdl-js-button mdl-button--icon" value="list_view">
              <i class="material-icons" id="goff">view_list</i>
              <div class="mdl-tooltip mdl-tooltip--left" for="goff" >List View</div>
            </span>
            <span  class="grid_view mdl-button mdl-js-button mdl-button--icon  hidden " value="grid_view">
              <i class="material-icons " id="gon">grid_on</i>
              <div class="mdl-tooltip mdl-tooltip--left" for="gon" >Grid View</div>
            </span>
          </div>
        </div>
        
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone itemCardEmpty animate slideInUp" ng-repeat="item in manageItems.data.items ">
          <div class="mdl-card mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand  card_gradient">
              <div class="img_wrap"> 
                <img class="img-responsive" src="assets/images/Alfalfa_Sprouts_1.png">  
              </div>
            </div>
            <div class="mdl-card__supporting-text">
              <h2 class="mdl-card__title-text itemName">{{item.item_name}}</h2>
              <h2 class="mdl-card__title-text hindiName">{{item.alternate_name}}</h2>
              <p class="hidden"></p>
              <p class="hidden"></p>
              <p class="hidden"></p>
              <p class="hidden"></p>
            </div>
            <div class="mdl-card__actions mdl-card--border">
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="info_tool6" href="itemsInfo">
                <i class="material-icons" title="Info" >info_outline</i> 
                <div class="mdl-tooltip mdl-tooltip--top" for="info_tool6" >Info </div>
              </a>
            </div>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone hidden">
          <table class="client_list_table mdl-data-table mdl-js-data-table  mdl-shadow--4dp itemTableEmpty is_list_view  animate fadeIn">
              <thead>
                <tr>
                  <th></th>
                  <th>Item Name</th>
                  <th>Alternate Name</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Uom</th>
                  <th>Shelf Life</th>
                </tr>
              </thead>
              <tbody class ="itemTbody">
                <tr class="itemTrowEmpty hidden">
                  <td>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon" id="" href="itemsInfo" style="height: 30px;">
                      <i class="icon material-icons" style=" font-size: 18px;">info_outline</i> 
                        <div class="mdl-tooltip mdl-tooltip--right" for="" >Info </div>
                    </a>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
          </table>
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
      <div class="mdl-grid searchResult"></div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more">
        Show More
    </button>
  </main>
  <script src="<?php echo base_url().'assets/js/item.js';?>"></script>
  <script>
  
  </script>