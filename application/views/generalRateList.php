 <?php
 // $id['item_id'] = $this->input->get('id');
    $data = json_decode(get_general_rates(), true);
    //$results=json_decode($data);
   //echo print_array($data);die;
   $perm_array  = [0,2,3];
   $permissions = get_session_data()['user']['permissions'];
 ?>
<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">General Rates</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="rateList_info_search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="search" id="rateList_info_search" autofocus autocomplete="off" placeholder="Search..">
        <label class="mdl-textfield__label" for="rateList_info_search"></label>
      </div>
    </div> 
  </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100" >
 <div class="mdl-grid" >
  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone ">
    <a href="download/csv/grl_template" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
      Download template
    </a>
  </div>
  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone noMarTop noMarBottom">
      <div class="info_details">
        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
          <select required="" id="search_rateList_category" class="mdl-selectfield__select" >
            <option selected="selected" value="all">All</option>
            <option value="Vegetables">Vegetables</option>
            <option value="English Vegetables">English Vegetables</option>
            <option value="Fruits">Fruits</option>
          </select>
          <label class="mdl-selectfield__label" for="item_category">Category</label>
        </div>  
      </div> 
  </div>
  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--2-col-tablet mdl-cell--1-col-phone noMarTop noMarBottom">
      <div class="info_details">
        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
          <select required="" id="search_rateList_sub_category" class="mdl-selectfield__select">
            <option selected="selected" value="all">All</option>
            <option value="Domestic">Domestic</option>
            <option value="Leafy">Leafy</option>
            <option value="OTP">OTP</option>
            <option value="Herbs">Herbs</option>
            <option value="Lettuces">Lettuces</option>
            <option value="Sprouts">Sprouts</option>
            <option value="Greens">Greens</option>
            <option value="Continental">Continental</option>
            <option value="Chinese &amp; Thai">Chinese &amp; Thai </option>
            <option value="Mint">Mint</option>
            <option value="Microgreens">Microgreens</option>
            <option value="Cheery Tomatoes">Cheery Tomatoes</option>
            <option value="Regular">Regular</option>  
            <option value="Local">Local</option>  
            <option value="Imported">Imported</option>  
          </select>
          <label class="mdl-selectfield__label" for="item_sub_category">Sub-Category</label>
        </div>
      </div>
  </div>
  <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
    <table class="mdl-data-table rateList_table mdl-js-data-table mdl-shadow--2dp">
      <thead>
          <tr>  
            <th >Item ID</th>
            <th > Name <span class="sort_out"> <i class="material-icons sort_icon">sort_by_alpha</i>  </span></th>
            <th > Alternate Name <span class="sort_out"> <i class="material-icons sort_icon">sort_by_alpha</i>  </span></th>
            <th >Price</th>
            <?php if(in_array($permissions,$perm_array)):?>
            <th>Action</th>
            <?php endif ?>
          </tr>
      </thead>
      <tbody>  
      <?php
        $count=0;
          $decode_category=['','Vegetables','English Vegetables','Fruits'];
          $decode_subcategory=['','DOMESTIC','LEAFY','OTP','HERBS','LETTUCES','SPROUTS','GREENS','CONTINENTAL','CHINESE & THAI','MINT','MICROGREENS','CHERRY TOMATOES','REGULAR','LOCAL','IMPORTED'];

          foreach($data as $row => $value ) :
          //if(isset($key['price'])){ $hidden = 'hidden'; $shown = '';}else{ $hidden = ''; $shown = 'hidden';}
          ?>
          <?php
          //  if($decode_category[$value['category']]=='Vegetables' and $decode_subcategory[$value['subcategory']]='DOMESTIC'){
            echo "<tr class='rateList_info_raw'>
                    <td> ". $value['item_id'] ."</td>
                    <td class=''> ". $value['item_name']. " <span class='hidden'>".$decode_category[$value['category']]."</span></td>
                    <td class=''> ". $value['alternate_name']. "<span class='hidden'>".$decode_subcategory[$value['subcategory']]."</span> </td>
                    <td > ". $value['price']. "  </td>
                    <td hidden  class=''>
                      <div class='mdl-textfield mdl-js-textfield'>
                        <input class='validate_number mdl-textfield__input pull_center' pattern='-?[0-9]*(\.[0-9]+)?' id='newPrice' value=".$value['price']." >
                        <span class='mdl-textfield__error'>Input is not a number!</span>
                        <label> </label>
                      </div>
                    </td>";
                    if(in_array($permissions,$perm_array)){
                    echo "<td> 
                      <a class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored rate_edit'><i class='material-icons'>edit</i></a>
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored rate_update' item-id='".$value['item_id']."'>
                        <i class='material-icons '>check_circle</i>
                      </a>  
                      <a hidden class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-button--colored rate_cancel'>
                        <i class='material-icons '>cancel</i>
                      </a>
                    </td>";
                    }
                  echo "</tr>";
                  // }
          endforeach;    
        ?>       
      </tbody>
    </table>
  </div>
 </div>
</main>
<?php if(in_array($permissions,$perm_array)):?>
<div class="fixed-action-btn" >
  <input type="file" id="general_ratelist" style="display:none">
  <label for="general_ratelist" id="ratelistlabel" class="mdl-button mdl-button--fab mdl-js-button mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">attach_file</i>
    <div class="mdl-tooltip mdl-tooltip--top" for="ratelistlabel" >Choose File</div>
  </label>
  <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="ratelist_bulkUpload" href="#">
    <i class="material-icons">file_upload</i>
    <div class="mdl-tooltip mdl-tooltip--top" for="ratelist_bulkUpload" >Upload</div>
  </a>
</div>
<?php endif ?>
<script src="<?php echo base_url().'assets/js/rateList.js';?>"></script>

