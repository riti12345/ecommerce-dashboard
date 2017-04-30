<?php
  $raw = get_all_raw();
  $saleable = get_all_saleable();
  $card = "";
  //print_r($saleable);die; 
  $decode_category=['','Vegetables','English Vegetables','Fruits'];
  $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];
  $today = date("Y-m-d");
  foreach($saleable as $key) :
    $added_on = $key['added_on'];
    $added_date = date('j\<\s\u\p\>S\<\/\s\u\p\> M Y', strtotime($added_on));
    $card .="<div class='mdl-cell mdl-cell--3-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone'>
      <div class='saleable-card-event mdl-card mdl-shadow--2dp' style=''>
          <div class='mdl-card__title mdl-card--expand' style='padding: 8px 14px;'><h4>".get_item_by_id($key['item_id'])['item_name']."</h4></div>
          <div class='mdl-card__title mdl-card--expand' style='padding: 8px 14px;'><p style='margin: 0 0 0px;'>Total Quantity :".$key['total_qty']." </p></div>
          <div class='mdl-card__title mdl-card--expand' style='padding: 8px 14px;'><p style='margin: 0 0 0px;'>".$decode_category[$key['category']]."</p></div>
          
          <div class='mdl-card__actions mdl-card--border' style='height: 45px;'>
            <a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect btn_info mdl-button--icon' id='info_tool".$key['item_id']."' 
              href='saleableInfo?item_id=".$key['item_id']."' target='_blank'>
              <i class='icon material-icons info'>info_outline</i> 
              <div class='mdl-tooltip mdl-tooltip--top' for='info_tool".$key['item_id']."'>Info </div>
            </a>
          </div>
      </div>
    </div>";
    endforeach;
?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">Saleable</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="view_saleable_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="view_saleable_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="view_saleable_search"></label>
      </div>
    </div>
  </div>
  <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
    <a href="#scroll-tab-1" class="mdl-layout__tab saleable_tab_1 is-active inward" >Add Saleable</a>
    <a href="#scroll-tab-2" class="mdl-layout__tab saleable_tab_2  today">Today</a>
    <a href="#scroll-tab-3" class="mdl-layout__tab saleable_tab_3 history">History</a>
  </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">
  <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate custom-progress"></div>
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content">
      
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone ">
              <?php
              
             echo" <button class='mdl-button mdl-js-button mdl-button--icon btn_icon_shadow' onclick='window.history.back()' style='min-width: 20px;' 
              data-upgraded=',MaterialButton'>
                  <i class='material-icons'>arrow_back</i>
              </button>
              <table class='mdl-data-table raw_table mdl-js-data-table mdl-shadow--2dp'>
                  <thead>
                    <tr>
                      <th>Item <span class='sort_out'> <i class='material-icons sort_icon'>sort_by_alpha</i>  </span></th>
                      <th>UOM</th>
                      <th>Quantity</th>
                      <th>Crates</th>
                    </tr>
                  </thead>
                  <tbody>";
                  foreach($raw as $key) :
                    $procid = $key['proc_items_id'];
                    $item_id =$key['item_id'];
                  echo  "<tr class='saleable-info-row' proc-id=".$procid." item-id =".$item_id.">
                      <td item-id='".$key['item_id']."'>".get_item_by_id($key['item_id'])['item_name']." <span class='hidden'>".$decode_category[$key['category']]."</span> <span class='hidden'>".$decode_subcategory[$key['subcategory']]."</span></td>
                      <td>".$this->config->item(get_item_by_id($key['item_id'])['uom'],'uom')."</td>
                      <td>
                         <div class='mdl-textfield_raw mdl-js-textfield'>
                          <input class='mdl-textfield__input' type='number' id='saleable_quant' 
                            placeholder='Enter Quantity'/>
                        </div>
                      </td>
                      <td>
                         <div class='mdl-textfield mdl-textfield_procure mdl-js-textfield mdl-textfield--floating-label'>
                            <input class='mdl-textfield__input  input_search' type='text' id='saleable_crate'>
                            <span class='mdl-chip mdl-chip--deletable Deletable_Chip hidden'>
                              <span class='mdl-chip__text'></span>
                              <button type='button' class='mdl-chip__action'>
                              <i class='material-icons'>cancel</i></button>
                            </span>
                            <label class='mdl-textfield__label mdl-textfield__label_addOrder' for='saleable_crate'></label>
                            <div class='suggestionClient hidden'>
                               <ul class='suggestionListClient' style='width:130%; text-align:left;'></ul>
                            </div>
                          </div>
                      </td>
                    </tr>";
                      
                  endforeach;    
                echo"  </tbody>
              </table>
              <div class='mdl-grid'>
                <div class='mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet  mdl-cell--12-col-phone'>
                  <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent' id='saleable_submit'>SUBMIT</button>
                </div>
              </div>";
                ?> 
            </div>
    </div>
  </section> 
  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content">
     <div class="mdl-grid" id="today-cards">
      <?php
      if($added_date == $today){
        echo $card;
      }
      ?>
        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_saleable_today hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> Nothing History Found!</h3></p>
          </div>
        <!-- No Data messages -->

     </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_hist hidden">
      Show More
      
    </button>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div class="page-content">
     <div class="mdl-grid" id="history-cards">
      <?php
      if($added_date != $today){
        echo $card;
      }
      ?>
        <!-- No Data messages -->
          <div class="mdl-card-status mdl-shadow--2dp no_saleable_hist hidden">
          <p><i class="material-icons status_icon">error</i><p>
          <p><h3> Nothing History Found!</h3></p>
          </div>
        <!-- No Data messages -->

     </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent show_more_hist hidden">
      Show More
      
    </button>
  </section>
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
</main>
<script src="<?php echo base_url().'assets/js/inventory.js';?>"></script>
<script>
 var allCrates = <?php echo get_all_crates()?>;
</script>