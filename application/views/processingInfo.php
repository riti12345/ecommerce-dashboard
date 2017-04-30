<?php
    $prossid = $this->input->get('prossid');
    $data= get_processing_track_by_id($prossid);
     //echo print_array(get_processing_track_by_id(1));die;
?>    
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Processing Info</span>
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
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
      <div class="wrap mdl_card_2 mdl-shadow--4dp">
        <div class="mdl-card__processingInfo">
        
         <a class="mdl-button mdl-js-button mdl-button--icon" href="processing" style=" min-width: 20px;"><i class="material-icons">arrow_back</i></a>

        
        <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <h3 class="itemName__Info"> <?= $data[0]['item_name']; ?> </h3>
            </div>  
            <!--step 1 start -->
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone"></div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="step_1Icon">looks_one</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="step_1Icon">Step 1</div>
                <h4 class="mdl-card__subInfo">Step 1</h4>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon info_sub_icon"><i class="material-icons">compare_arrows</i></span>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--6-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon info_sub_icon"><i class="step_quant_icon" id="item_qtyIcon">Q</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="item_qtyIcon">Quantity</div>
                <h4 class="mdl-card__subInfo"> <?= $data[0]['quantity']; ?> </h4>
              </div>
            </div>
            <!--step 2 start -->
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone"></div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="step_2Icon">looks_two</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="step_2Icon">Step 2</div>
                <h4 class="mdl-card__subInfo">Step 2</h4>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon info_sub_icon"><i class="material-icons">compare_arrows</i></span>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon info_sub_icon"><i class="step_quant_icon" id="item_qtyIcon2">Q</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="item_qtyIcon2">Quantity</div>
                <h4 class="mdl-card__subInfo"> <?= $data[1]['quantity']; ?> </h4>
              </div>
            </div>
            <!--step 3 start -->
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone"></div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="step_3Icon">looks_3</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="step_3Icon">Step 3</div>
                <h4 class="mdl-card__subInfo">Step 3</h4>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon info_sub_icon"><i class="material-icons">compare_arrows</i></span>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon info_sub_icon"><i class="step_quant_icon" id="item_qtyIcon3">Q</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="item_qtyIcon3">Quantity</div>
                <h4 class="mdl-card__subInfo"> <?= $data[2]['quantity']; ?> </h4>
              </div>
            </div>
            <!--step 4 start -->
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone"></div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_icon"><i class="material-icons" id="step_4Icon">looks_4</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="step_4Icon">Step 4</div>
                <h4 class="mdl-card__subInfo">Step 4</h4>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--3-col-tablet  mdl-cell--3-col-phone">
              <div class="info_details">
                <span class="info_icon info_sub_icon"><i class="material-icons">compare_arrows</i></span>
              </div>
            </div>

            <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_grade_icon"><i class="step_4_grade" id="grade_aIcon">A</i>
                </span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="grade_aIcon">Grade A</div>
                <h5 class="mdl-card__subInfo"> <?= $data[0]['ga']; ?> </h5>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_grade_icon"><i class="step_4_grade" id="grade_bIcon">B</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="grade_bIcon">Grade B</div>
                <h5 class="mdl-card__subInfo"> <?= $data[0]['gb']; ?> </h5>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet  mdl-cell--12-col-phone">
              <div class="info_details">
                <span class="info_grade_icon"><i class="step_4_grade" id="grade_cIcon">C</i></span>
                <div class="mdl-tooltip mdl-tooltip--bottom" for="grade_cIcon">Grade C</div>
                <h5 class="mdl-card__subInfo"> <?= $data[0]['gc']; ?> </h5>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
 <script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>