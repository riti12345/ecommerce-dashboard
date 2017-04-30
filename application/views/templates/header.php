<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $session_data = get_session_data();
    //print_r($session_data);die;
?>
<!DOCTYPE html>
  <html ng-app="angular-app">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
      <title>OrderSquare - Procurement Simplified</title>
      
      <link rel="icon" href="<?php echo base_url().'assets/image/favicon.png';?>" type="image/gif" sizes="16x16">
      <link rel="stylesheet" href="<?php echo base_url().'assets/css/material_teal.css';?>">
      <link rel="stylesheet" href="<?php echo base_url().'assets/sweetalert-master/dist/sweetalert.css';?>">
      <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css';?>">
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      
      <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-1.12.3.js';?>"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url().'assets/js/app.js';?>"></script>
      <style>
        #view-source {
          position: fixed;
          display: block;
          right: 0;
          bottom: 0;
          margin-right: 40px;
          margin-bottom: 40px;
          z-index: 900;
        }
       #itemsChild{
        display: none;
       }
      </style>
      <script type="text/javascript">
        $(document).ready(function(){
          $.ajaxSetup({
              headers: { "X-API-KEY": "<?php //echo $session_data['X-API-KEY']; ?>" }
          });

          $('items_p').click(function(){
            //$( 'itemsChild').toggleClass( "hidden" );
            //$('.itemsChild').slideToggle();
          });
        });
        //$('.arrow_element').toggleClass('open');
        var d = new Date();
        var start_time = d.getTime();
      </script>
    </head>

  <body class="hold-transition skin-green sidebar-mini fixed">
    <?php if(isset($session_data['logged_in'])): ?>    
      <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <div class="demo-drawer mdl-layout__drawer mdl-color--teal mdl-color-text--blue-grey-50">
          <div class="hidden" id="load_time"></div>
          <header class="demo-drawer-header custom_nav--bg">
            <!-- <img src="assets/images/user.jpg" class="demo-avatar"> -->
            <div class="demo-avatar-dropdown">
              <span style="text-transform: capitalize; font-size: 18px;"><?php echo $session_data['user']['name']; ?></span>
              <!-- <span><?php  $session_data; ?></span> -->
              <div class="mdl-layout-spacer"></div>
              <?php if(isset(get_profile(get_session_data()['user']['id'])['id'])) : ?>
              <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" style="">
                <i class="material-icons" role="presentation">settings</i>
                <span class="visuallyhidden">Accounts</span><?php if(get_all_personal_notification((get_profile(get_session_data()['user']['id'])['id']))): ?><span class="mdl-badge" style="margin-left:55%;" data-badge=<?= get_all_personal_notification((get_profile(get_session_data()['user']['id'])['id']));?>></span><?php endif;?>
              </button>
              <?php else: ?>
              <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" style="">
                <i class="material-icons" role="presentation">settings</i>
                <span class="visuallyhidden">Accounts</span>
              </button>
              <?php endif; ?>
              <div class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn" style="">
                <a href="profile" class="mdl-menu__item"><i class="material-icons margin_right_10" >perm_identity</i> Profile</a>
                <a href="addTeam" class="mdl-menu__item"><i class="material-icons margin_right_10">person_add</i>  Add Team</a>
                <a href="viewTeam" class="mdl-menu__item"><i class="material-icons margin_right_10">people</i>  View Team</a>
                <a href="api/logout" class="mdl-menu__item"><i class="material-icons margin_right_10">power_settings_new</i> Logout</a>
              </div>
            </div>
          </header>
          <nav class="demo-navigation mdl-navigation mdl-color--grey-100">
<<<<<<< HEAD
            <a class="mdl-navigation__link" href="dashboard"><i class="mdl-font-color material-icons" role="presentation">home</i>Home</a>
            <a class="mdl-navigation__link" href="generalRateList"><i class="mdl-font-color material-icons" role="presentation">description</i>General Rates</a>
            <a class="mdl-navigation__link items_p" href="items"><i class="mdl-font-color material-icons" role="presentation">list</i>Items  </a>
            <a class="mdl-navigation__link itemsChild child_1 " id="itemsChild" href="addItem" style=""><i class="mdl-font-color material-icons" role="presentation"></i> Add</a>
            <a class="mdl-navigation__link clients_p" href="clients"><i class="mdl-font-color material-icons" role="presentation">restaurant</i>Clients</a>
            <a class="mdl-navigation__link clientsChild child_1" id="clientsChild" href="addClient"><i class="mdl-font-color material-icons" role="presentation"></i> Add</a>
            <a class="mdl-navigation__link vendors_p" href="vendors"><i class="mdl-font-color material-icons" role="presentation">people</i>Vendors</a>
            <a class="mdl-navigation__link vendorsChild child_1" href="addVendor"><i class="mdl-font-color material-icons" role="presentation"></i> Add</a>
            <div class="android-drawer-separator"></div>
            <a class="mdl-navigation__link orders_p" href="order"><i class="mdl-font-color material-icons" role="presentation">shopping_cart</i>Order</a>
            <!-- <a class="mdl-navigation__link child_1" href="order"><i class="mdl-font-color material-icons" role="presentation"></i> View</a> -->
            <a class="mdl-navigation__link ordersChild child_1" href="addOrder"><i class="mdl-font-color material-icons" role="presentation"></i> Add</a>

            <div class="android-drawer-separator"></div>
            <a class="mdl-navigation__link" href="inward"><i class="mdl-font-color material-icons" role="presentation">store</i>Inventory</a>
            <a class="mdl-navigation__link child_1" href="inward"><i class="mdl-font-color material-icons" role="presentation"></i> Inward</a>
            <a class="mdl-navigation__link child_1" href="raw"><i class="mdl-font-color material-icons" role="presentation"></i> Raw</a>
            <a class="mdl-navigation__link child_1" href="salable"><i class="mdl-font-color material-icons" role="presentation"></i> Saleable</a>
            <a class="mdl-navigation__link child_1" href="leftOvers"><i class="mdl-font-color material-icons" role="presentation"></i> Leftovers</a>
            <div class="android-drawer-separator"></div>
            <a class="mdl-navigation__link " href="processing"><i class="mdl-font-color material-icons" role="presentation">settings_applications</i> Processing</a>
            <a class="mdl-navigation__link child_1" href="processingIssue"><i class="mdl-font-color material-icons" role="presentation"></i> Issue</a>
            <div class="android-drawer-separator"></div>
            <a class="mdl-navigation__link" href="procurement"><i class="mdl-font-color material-icons" role="presentation">file_download</i>Procurement</a>
            <!-- <a class="mdl-navigation__link child_1" href="procurement"><i class="mdl-font-color material-icons"></i>Procurement</a> -->
            <a class="mdl-navigation__link child_1" href="jit"><i class="mdl-font-color material-icons" role="presentation"></i>JIT</a>
            <div class="android-drawer-separator"></div>
            <a class="mdl-navigation__link" href="dispatch"><i class="mdl-font-color material-icons" role="presentation">local_shipping</i>Delivery</a>
            <a class="mdl-navigation__link child_1" href="dispatch"><i class="mdl-font-color material-icons"></i>Dispatch</a>
            <a class="mdl-navigation__link child_1" href="delivery_boy"><i class="mdl-font-color material-icons" role="presentation"></i>Delivery </a>
            <div class="android-drawer-separator"></div>
            <a class="mdl-navigation__link" href="viewVehicle"><i class="mdl-font-color material-icons" role="presentation">directions_bus</i>Transport</a>
            <a class="mdl-navigation__link child_1" href="addVehicle"><i class="mdl-font-color material-icons"></i>Add</a>
            <a class="mdl-navigation__link child_1" href="vehicleUpdates"><i class="mdl-font-color material-icons"></i>Track</a>
            <div class="android-drawer-separator"></div>
            <a class="mdl-navigation__link" href="line_Manager"><i class="mdl-font-color material-icons" role="presentation">storage</i>Warehouse</a>
            <a class="mdl-navigation__link child_1" href="warehouse_Manager"><i class="mdl-font-color material-icons"></i>Warehouse_Manager</a>
            <a class="mdl-navigation__link child_1" href="line_Manager"><i class="mdl-font-color material-icons" role="presentation"></i>Line_Manager</a>
            <div class="mdl-layout-spacer"></div>
=======
          <?php
            $user_permission = get_session_data()['user']['permissions'];
            $array1=[0,2,3,7,8];
            $array2 =[0,2,3,4,7,8];
            $array3 =[0,2,3,4,6,9];
            $array4=[0,2,3,5,6,7,8,9];
            $array5=[0,2,3];
            $array6=[0,6];
            $array7=[0,7];
            $array8=[0,2,3,4];
            echo"<a class='mdl-navigation__link dashboard' href='dashboard'><i class='mdl-font-color material-icons' role='presentation'>home</i>Home</a>";
            
            if(in_array($user_permission,$array1)) {
              echo"<a class='mdl-navigation__link generalRateList' href='generalRateList'><i class='mdl-font-color material-icons' role='presentation'>description</i>General Rates</a>
              <a class='mdl-navigation__link items_p' href='items'><i class='mdl-font-color material-icons' role='presentation'>list</i>Items  </a>
              <a class='mdl-navigation__link itemsChild child_1' id='itemsChild' href='addItem' style=''><i class='mdl-font-color material-icons' role='presentation'></i> Add</a>
              <a class='mdl-navigation__link clients_p' href='clients'><i class='mdl-font-color material-icons' role='presentation'>restaurant</i>Clients</a>
              <a class='mdl-navigation__link clientsChild child_1' id='clientsChild' href='addClient'><i class='mdl-font-color material-icons' role='presentation'></i> Add</a>";
            }
            if(in_array($user_permission,$array2))  {
              echo"<a class='mdl-navigation__link vendors_p' href='vendors'><i class='mdl-font-color material-icons' role='presentation'>people</i>Vendors</a>
                  <a class='mdl-navigation__link vendorsChild child_1' href='addVendor'><i class='mdl-font-color material-icons' role='presentation'></i> Add</a>";
            }
            if(in_array($user_permission,$array1)) {
              echo"<div class='android-drawer-separator orders_p'></div>
              <a class='mdl-navigation__link orders_p' href='order'><i class='mdl-font-color material-icons' role='presentation'>shopping_cart</i>";if(orders_notification()): echo"<span class='mdl-badge' data-badge=".orders_notification().">Order</span>"; else: echo"Order";endif;echo"</a>
              <a class='mdl-navigation__link ordersChild child_1' href='addOrder'><i class='mdl-font-color material-icons' role='presentation'></i> Add</a>";
            }
            if(in_array($user_permission,$array3))  {
              echo"<div class='android-drawer-separator inward'></div>
              <a class='mdl-navigation__link inward' href='inward'><i class='mdl-font-color material-icons' role='presentation'>store</i>Inventory</a>
              <a class='mdl-navigation__link inward child_1' href='inward'><i class='mdl-font-color material-icons' role='presentation'></i>";if(inward_notification()): echo"<span class='mdl-badge' data-badge=".inward_notification().">Inward</span>";else: echo"Inward";endif;echo"</a>
              <a class='mdl-navigation__link inward child_1 returninward' href='returnInward'><i class='mdl-font-color material-icons' role='presentation'></i>";if(return_inward_notification()): echo"<span class='mdl-badge' data-badge=".return_inward_notification().";>Return&nbsp;Inward</span>"; else: echo"Return&nbsp;Inward";endif;echo"</a>
              <a class='mdl-navigation__link inward child_1' href='raw'><i class='mdl-font-color material-icons' role='presentation'></i>";if(count(get_all_raw())): echo"<span class='mdl-badge' data-badge=".count(get_all_raw()).">Raw</span>";else: echo"Raw";endif; echo"</a>
              <a class='mdl-navigation__link inward child_1' href='saleable'><i class='mdl-font-color material-icons' role='presentation'></i>"; if(count(get_all_salable())): echo"<span class='mdl-badge' data-badge=".count(get_all_salable()).">Saleable</span>";else: echo"Saleable";endif;echo"</a>
              <a class='mdl-navigation__link inward child_1' href='wastage'><i class='mdl-font-color material-icons' role='presentation'></i>"; if(count(get_all_salable())): echo"<span class='mdl-badge' data-badge=".count(get_all_salable()).">Wastage</span>";else: echo"Wastage";endif;echo"</a>";
              // <a class="mdl-navigation__link inward child_1 hidden" href="leftOvers"><i class="mdl-font-color material-icons" role="presentation"></i><?php if(count(get_all_leftovers())): <span class="mdl-badge" data-badge=<?= count(get_all_leftovers());>Leftovers</span><?php else: echo"Leftovers";endif;</a>
              //<div class='android-drawer-separator processing hidden'></div>
              //<a class='mdl-navigation__link processing hidden' href='processing'><i class='mdl-font-color material-icons' role='presentation'>settings_applications</i>"; if(processing_notification()): echo"<span class='mdl-badge' data-badge=".processing_notification().";>Processing</span>"; else: echo"Processing";endif;echo"</a>";
              //<a class='mdl-navigation__link processing child_1 hidden' href='processingIssue'><i class='mdl-font-color material-icons' role='presentation'></i><?php if(count(get_all_raw())): <span class="mdl-badge" data-badge=<?= count(get_all_raw());> Issue</span><?php else: echo"Issue";endif;</a>
              echo"<div class='android-drawer-separator procurement'></div>";
               if(get_session_data()['user']['permissions'] == 0): 
              echo "<a class='mdl-navigation__link procurement' href='procurement'><i class='mdl-font-color material-icons' role='presentation'>file_download</i>Procurement</a>";
              else:
              echo "<a class='mdl-navigation__link procurement' href='procureInfo'><i class='mdl-font-color material-icons' role='presentation'>file_download</i>Procurement</a>";
              endif;
              // <a class="mdl-navigation__link child_1" href="procurement"><i class="mdl-font-color material-icons"></i>Procurement</a> -->
              if(in_array($user_permission,$array8)){
              echo"<a class='mdl-navigation__link assets child_1' href='vendorBills'><i class='mdl-font-color material-icons'></i>Vendor&nbsp;Bills</a>";
              }
              echo"<a class='mdl-navigation__link child_1 jit' href='jit'><i class='mdl-font-color material-icons' role='presentation'></i>";if(false): echo"<span class='mdl-badge' data-badge='0'>JIT</span>"; else: echo"JIT";endif;echo"</a>";
            }
            if(in_array($user_permission,$array4)){
              echo"<div class='android-drawer-separator dispatch'></div>
              <a class='mdl-navigation__link dispatch' href='dispatch'><i class='mdl-font-color material-icons' role='presentation'>local_shipping</i>Delivery</a>
              <a class='mdl-navigation__link dispatch child_1' href='dispatch'><i class='mdl-font-color material-icons'></i>"; if(dispatch_notification()): echo"<span class='mdl-badge' data-badge=".dispatch_notification().">Dispatch</span>";else: echo"Dispatch";endif;echo"</a>
              <a class='mdl-navigation__link dispatch child_1' href='delivery_boy'><i class='mdl-font-color material-icons' role='presentation'></i>Delivery </a>";
            } 
            if(in_array($user_permission,$array5)){
            echo"<div class='android-drawer-separator transport'></div>
            <a class='mdl-navigation__link transport' href='viewVehicle'><i class='mdl-font-color material-icons' role='presentation'>directions_bus</i>Transport</a>
            <a class='mdl-navigation__link transport child_1' href='addVehicle'><i class='mdl-font-color material-icons'></i>Add</a>
            <a class='mdl-navigation__link transport child_1' href='vehicleUpdates'><i class='mdl-font-color material-icons'></i>Track</a>";
            }
            if(in_array($user_permission,$array6)){
            echo"<div class='android-drawer-separator warehouse'></div>
            <a class='mdl-navigation__link warehouse' href='line_Manager'><i class='mdl-font-color material-icons' role='presentation'>storage</i>Warehouse</a>
            <a class='mdl-navigation__link child_1 warehouse' href='warehouse_Manager'><i class='mdl-font-color material-icons'></i>Warehouse<span>_</span>Manager</a>
            <a class='mdl-navigation__link child_1 linemanager' href='line_Manager'><i class='mdl-font-color material-icons' role='presentation'></i>Line<span>_</span>Manager</a>";
            }
            //<!--<div class="android-drawer-separator"></div>
            //<a class="mdl-navigation__link" href="crates"><i class="mdl-font-color material-icons" role="presentation">archive</i>Crates</a>
            //<a class="mdl-navigation__link child_1" href="addCrates"><i class="mdl-font-color material-icons"></i>Add</a>-->
            if(in_array($user_permission,$array7)){
            echo"<div class='android-drawer-separator'></div>
            <a class='mdl-navigation__link' href='employees'><i class='mdl-font-color material-icons' role='presentation'>supervisor_account</i>Accounts</a>
            <a class='mdl-navigation__link child_1' href='employees'><i class='mdl-font-color material-icons'></i>";if(get_all_hr_notification()): echo"<span class='mdl-badge' data-badge=".get_all_hr_notification().">HR</span>";else: echo"HR";endif;echo"</a>";
            echo"<a class='mdl-navigation__link child_1' href='addEmployee'><i class='mdl-font-color material-icons'></i>Add</a>
            <div class='mdl-layout-spacer'></div>
            <a class='mdl-navigation__link assets' href='os_assets'><i class='material-icons'>important_devices</i>Assets</a>
            <a class='mdl-navigation__link assets child_1' href='addAssets'><i class='mdl-font-color material-icons'></i>Add</a>
            <a class='mdl-navigation__link assets child_1' href='allocateAssets'><i class='mdl-font-color material-icons'></i>Allocate</a>
            <div class='mdl-layout-spacer'></div>";
            }
          ?>
>>>>>>> 097cd5e986b4472f027e43839d947768f3ee3595
          </nav>
        </div>
               
    <?php endif; ?>