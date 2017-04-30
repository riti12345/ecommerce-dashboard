<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Company's Assets</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="view_assets_category_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="view_assets_category_search" autofocus placeholder="Search.." autocomplete='off'>
        <label class="mdl-textfield__label" for="view_assets_category_search"></label>
      </div>
    </div>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid assets">
    <div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet  mdl-cell--12-col-phone"></div>
    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet  mdl-cell--12-col-phone">
      <div class="mdl-breadcrum">
        <div class="breadcrumb"><a href="dashboard" class="is_selected">Home</a><a href="os_assets" class="is_selected">Assets</a></div>
      </div> 
    </div>
  </div>

  <div class="mdl-grid os_category">
    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone assetsCard hidden">
      <div class="assets-card-event mdl-card mdl-shadow--2dp" style="min-height:100px;height:100px;">
          <div class="mdl-card__title mdl-card--expand" style="padding: 10px 30px;"><h4></h4></div><!-- 
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Subcategory</p><span style="margin-left:80px;">20</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Total Assets</p><span style="margin-left:85px;">200</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Allocated</p><span style="margin-left:100px;">150</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Free</p><span style="margin-left:130px;">50</span></div> -->
        </div>
    </div>
    
<!--      <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
      <div class="assets-card-event mdl-card mdl-shadow--2dp" style="">
          <div class="mdl-card__title mdl-card--expand" style="padding: 10px 30px;"><h4>Furniture</h4></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Subcategory</p><span style="margin-left:80px;">20</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Total Assets</p><span style="margin-left:85px;">200</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Allocated</p><span style="margin-left:100px;">150</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Free</p><span style="margin-left:130px;">50</span></div>
        </div>
    </div>
     <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
      <div class="assets-card-event mdl-card mdl-shadow--2dp" style="">
          <div class="mdl-card__title mdl-card--expand" style="padding: 10px 30px;"><h4>Appliances</h4></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Subcategory</p><span style="margin-left:80px;">20</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Total Assets</p><span style="margin-left:85px;">200</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Allocated</p><span style="margin-left:100px;">150</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Free</p><span style="margin-left:130px;">50</span></div>
        </div>
    </div>
     <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
      <div class="assets-card-event mdl-card mdl-shadow--2dp" style="">
          <div class="mdl-card__title mdl-card--expand" style="padding: 10px 30px;"><h4>Crates</h4></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Subcategory</p><span style="margin-left:80px;">20</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Total Assets</p><span style="margin-left:85px;">200</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Allocated</p><span style="margin-left:100px;">150</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Free</p><span style="margin-left:130px;">50</span></div>
        </div>
    </div>
     <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
      <div class="assets-card-event mdl-card mdl-shadow--2dp" style="">
          <div class="mdl-card__title mdl-card--expand" style="padding: 10px 30px;"><h4>Intangible Assets</h4></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Subcategory</p><span style="margin-left:80px;">20</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Total Assets</p><span style="margin-left:85px;">200</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Allocated</p><span style="margin-left:100px;">150</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Free</p><span style="margin-left:130px;">50</span></div>
        </div>
    </div>
    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
      <div class="assets-card-event mdl-card mdl-shadow--2dp" style="">
          <div class="mdl-card__title mdl-card--expand" style="padding: 10px 30px;"><h4>Stationary</h4></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Subcategory</p><span style="margin-left:80px;">20</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Total Assets</p><span style="margin-left:85px;">200</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Allocated</p><span style="margin-left:100px;">150</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Free</p><span style="margin-left:130px;">50</span></div>
        </div>
    </div>
    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
      <div class="assets-card-event mdl-card mdl-shadow--2dp" style="">
          <div class="mdl-card__title mdl-card--expand" style="padding: 10px 30px;"><h4>Others</h4></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Subcategory</p><span style="margin-left:80px;">20</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Total Assets</p><span style="margin-left:85px;">200</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Allocated</p><span style="margin-left:100px;">150</span></div>
          <div class="mdl-card__title mdl-card--expand" style="padding: 8px 32px;"><p style="margin: 0 0 0px;">Free</p><span style="margin-left:130px;">50</span></div>
        </div>
    </div> -->
  </div>
</main>

<script src="<?php echo base_url().'assets/js/assets.js';?>"></script> 

