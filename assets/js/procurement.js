$(document).ready(function(){
  var has_item = [];
  var price_array = [];
  var markets_names = new Array("");var market_names_id = [],
   manager_names = new Array(""),
   proc_slot_id = new Array(""),
   optionSlot,m_id;
 
  var vendor_names = []; var vendor_names_id = [];
  var onspot_vendor_names = new Array("None");
  window.markets=[];
  var upcomming =[];
  var history =[];
  var today = new Date();
  var day = today.getDate();
  var month = today.getMonth()+1;
  if(month <= 9 ){month = '0'+month}
  if(day <= 9 ){day = '0'+day}
  var year = today.getFullYear();
  var aaj = year+'-'+month+'-'+day;

  $('body').delegate('#check_all','click',function(){
    if($('#check_all').is(':checked')){
       $('tr.clonedRow').css('background', '#E0E0E0').addClass('tr-selected');
       $('td:first-child').find('input').attr('checked',true).addClass('is-selected');
       $('.vendor_hide').addClass('hidden');
       $('.vendor_span').removeClass('hidden');
    }
    if($('#check_all').is(':not(:checked)')){
       $('tr.clonedRow').css('background', 'inherit').removeClass('tr-selected');
       $('td:first-child').find('input').removeAttr('checked').removeClass('is-selected').css('background', 'inherit');;
        $('.vendor_span').addClass('hidden');
       $('.vendor_hide').removeClass('hidden');
    }   
  });
    
  $('body').delegate('tbody .check_me','click',function(){
    if($(this).is(':checked')){
       $(this).parent().parent().parent('tr').css('background', '#E0E0E0').addClass('tr-selected');
       $(this).addClass('is-selected').attr('checked');
       $('.vendor_hide').addClass('hidden');
       $('.vendor_span').removeClass('hidden');
    }
    if($(this).is(':not(:checked)')){
       $(this).parent().parent().parent('tr').css('background', 'inherit').removeClass('tr-selected');
       $(this).removeClass('is-selected').removeAttr('checked',true);
       $('.vendor_span').addClass('hidden');
       $('.vendor_hide').removeClass('hidden');
    }   
  });

$('.approve_vendor').click(function(){
  var v_name = $('.check_vendor_search').attr('value');
  var v_id = $('.check_vendor_search').attr('vendor-id');
  $('.tr-selected').each(function(){
    $(this).children().eq(3).children().find('input').val(v_name).attr('value',v_name);
    $(this).children().eq(3).children().find('input').attr('vendor-id',v_id);
    
  });
});

$('.disapprove_vendor').click(function(){
  
  $('.tr-selected').each(function(){
    $(this).children().eq(3).children().find('input').val("").attr('value',"");
    $(this).children().eq(3).children().find('input').attr('vendor-id',"");
    
  });
});

/*-----------------------------------Get Estd Quantity---------------------------------------------------------------------*/
$('.proc_select').click(function(){
  $('.proc_select').css({"color" : "inherit"});
});  

/*---------------------------------Function to Display Proc Managers Cards-------------------------------------------------*/  
  $.get("api/manage-team/team/procure", function(data){
  var procureManager =JSON.parse(JSON.stringify(data));
  procureData = procureManager.data;
  var optionProcureManager = '';
  	procureData.forEach(function(Index, i) {
    	var clone=$(".demoCardProcure").clone();
    	clone.removeClass('demoCardProcure').removeClass('hidden');
  	    $('.procure').append(clone);

		    clone.children().children().eq(0).children().append(procureData[i].username);
		    clone.children().children().eq(1).children().append(procureData[i].mobile);
		    clone.children().children().eq(2).children().children().append(proc_manager_status[procureData[i].status]);
		    clone.children().children().eq(3).children().eq(0).attr('href','procurementInfo?tid='+procureData[i].id+'&request=dashboard').attr('id','infoTool'+i);
			  clone.children().children().eq(3).children().eq(0).children().eq(1).attr('for','infoTool'+i);
		});
  });//End Function Disp Proc Managers

/*----------------------------------ProcureInfo Handling TABS---------------------------------------------------------------------------------*/
  // manual procure screen
  $(".manualProcure").click(function(){
      var isValid = true;
    $('#searchProcureMarkets,#proc_Slot,#datepicker').each(function(){
      if ($.trim($(this).val()) == '') {
          isValid = false;
          $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
      }else{
          $(this).css({"border-bottom": "2px solid #299035","background": ""});
          setTimeout($.proxy(function(){
          $(this).css({"border": "","background": ""});},this),2000);   
      }
    });
    
    //Validation of Valid Market
    var valid_market = getMarketID($('#searchProcureMarkets').val());
    if (typeof(valid_market) == "undefined") {
      'use strict';
      var snackbarContainer = document.querySelector('#demo-toast-example');
      var data = {message: 'Please Enter Valid Market !!!'};
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
      return false;
    }//End Validation of Valid Market

    if(isValid == true){
       $(".selectItemScreen").removeClass('hidden');
       $('.marketScreen').addClass('hidden');
       $('.title > h5 ').html("Manual Order");
       $('.breadcrumb >a:nth-child(2)').addClass('active');
       /*----------------------------------Auto Append Estimated Items---------------------------------------------*/
       $.each(estdQty, function(Index, i) {
         $(".addProcureScreen").removeClass('hidden');
           //var $li =$(this).parent().parent().children().eq(1).children().children().eq(2).children().children();
          var tRow = $('.procure-item').clone();
          tRow.removeClass('procure-item').addClass('clonedRow').removeClass('hidden');
          $('.tbody').prepend(tRow);
          $.each(tRow,function(Index, data){
            $(this).children().eq(1).find('input').val(i.item_name).attr('item-id',i.item_id).addClass('select_Item').attr('id','proc_Item');
            has_item.push(i.item_id);
            $(this).children().eq(2).find('input').addClass('search_Vendors').attr('id','proc_Vendor');
            $(this).children().eq(3).find('input').val(i.quantity).attr('id','proc_Quantity');
            $(this).children().eq(4).find('input').attr('id','proc_TPrice');
          }); 
       });
      }else{
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {message: 'please fill all input !',timeout:1000};
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }    
  });

  //back button
  $(".btn-back-manual").click(function(){
    swal({ 
      title: "Are you sure ?",   
      //text: "You will lose all data!",   
      type: "info",   
      showCancelButton: true,   
      closeOnConfirm: true, 
      animation: "slide-from-top",  
      showLoaderOnConfirm: false, }, 
      function(){
      $(".clonedRow").remove();
      $(".addProcureScreen, .selectItemScreen, .createProcureScreen").addClass('hidden');
      $(".marketScreen").removeClass('hidden');
      $('.breadcrumb >a:nth-child(2)').removeClass('active');
      has_item.length=0;
      price_array.length=0;
    });
  });
/*-------X----------------X-----------END Procure Handling TABS-----------X--------------------X------------------------------------------------*/

/*----------------------------------Append FNC--------------------------------------------------------------*/
  $('#appendItems').on('click',function(){
    if( $.inArray($('#selectProcItem').attr('item-id'), has_item) == -1){
    var isValid = true;
      $("#selectProcItem,#p_quantity,#p_target_price").each(function() {
          if ($.trim($(this).val()) == '') {
              isValid = false;
              $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
          } else {
              $(this).css({"border-bottom": "2px solid #299035","background": ""});
              setTimeout($.proxy(function(){
              $(this).css({"border": "","background": ""});},this),2000);               
          }
      });

      //Validation of Valid Item
      var valid_item = $('#selectProcItem').attr('item-id');
      if (typeof(valid_item) == "undefined") {
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Please enter valid Item !!!'};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
      }//End Validation of Valid Item

      if (isValid == true) {
        $(".addProcureScreen").removeClass('hidden');
        var tRow = $('.procure-item').clone();
        tRow.removeClass('procure-item').addClass('clonedRow').removeClass('hidden');
        $('.tbody').prepend(tRow);
        
          tRow.children().eq(2).find('input').attr('item-id',$('#selectProcItem').attr('item-id')).addClass('select_Item').attr('id','proc_Item').val($('#selectProcItem').val());
          has_item.push($('#selectProcItem').attr('item-id'));
          tRow.children().eq(3).find('input').attr('vendor-id',$('#searchVendors').attr('vendor-id')).addClass('search_Vendors').attr('id','proc_Vendor').val($('#searchVendors').val());
          tRow.children().eq(4).find('input').attr('value',$('#p_quantity').val()).attr('id','proc_Quantity').val($('#p_quantity').val());
          tRow.children().eq(5).find('input').attr('value',$('#p_target_price').val()).attr('id','proc_TPrice').val($('#p_target_price').val());
          price_array.push($('#p_target_price').val());
        // empty input row
        $('#selectProcItem,#searchVendors,#p_quantity,#p_target_price').val('');
        $('.proc_add_row').children().eq(1).find('input').attr('value','').attr('item-id','');
        $('#selectProcItem, #searchVendors').removeClass('hidden');
        $('#selectProcItem, #searchVendors').next().addClass('hidden');
        
        setTimeout(function(){ $('#selectProcItem').focus(); }, 250);
      }else{
          'use strict';
          var snackbarContainer = document.querySelector('#demo-toast-example');
          var data = {message: 'please fill all input !',timeout:2000};
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
          return false;
      }
    }else{
       'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Item already added !',timeout:2000};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    } 
  });

  // find card in today's procured items
    $('#add_procure_search').donetyping(function(){
      var text = $(this).val();
      var assignee_id = $('#team_id').attr('data-id');
      if(text.length>0){
        clearTimeout($.data(this, 'timer'));
        var wait =setTimeout(function(){
          $.ajax({
                url: 'api/manage-procure/search',
                type: 'POST',
                data: {q   : text,
                      assignee_id : assignee_id },
                success: function(response){
                    var proc_data =JSON.parse(JSON.stringify(response)).data;
                     var cr=0;
                    console.log(proc_data);
                    
                    $('.dynamic_search').removeClass('hidden');
                    $('.mdl-layout__tab-bar ,.page-content').addClass('hidden');
                
                  proc_data.forEach(function(Index, i) {
                    var date = new Date(proc_data[i].procure_date);
                    var d = date.getDate();
                    var m =  date.getMonth();
                    m += 1;  // JavaScript months are 0-11
                    var y = date.getFullYear();
                    var superScript;
                    if(d == 1 || d==31){superScript = 'st';}else if(d==2 || d ==22){superScript ='nd';}else if(d==3 || d==23){superScript ='rd';}else{superScript = 'th';}
         
                    var clone=$(".demoCardProchist").clone();
                    clone.removeClass('demoCardProchist').addClass('procureCardCloned').removeClass('hidden');
                    $('.searchResult').append(clone);
                    ++cr;
                    clone.children().children().eq(0).children().append('Procurement ID: '+proc_data[i].id);
                    clone.children().children().eq(1).children().append(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
                    
                    if(proc_data[i].procure_date >= aaj ){
                      clone.children().children().eq(3).children().eq(0).attr('href','procTrackDetails?tid='+proc_data[i].assignee_id+'&uid='+proc_data[i].id+'&tab_stat=upcomming_tab').attr('id','infoToolproc'+cr);
                    }else{clone.children().children().eq(3).children().eq(0).attr('href','procTrackDetails?tid='+proc_data[i].assignee_id+'&uid='+proc_data[i].id+'&tab_stat=history_tab').attr('id','infoToolproc'+cr);}
                    clone.children().children().eq(3).children().eq(0).children().eq(1).attr('for','infoToolproc'+cr);
                  });
                },
                error:function(error){
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {message: 'No data found !',timeout:1000};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    return false;
                }
          });
        },500);
        $('.searchResult').empty();
        $(this).data('timer', wait);
      }
    });
  
  $('#dynamic_div_close').on('click',function(){
      $('.dynamic_search').addClass('hidden');
      $('.page-content ,.mdl-layout__tab-bar ,.show_more_processing , .show_more_processed , .show_more_hist').removeClass('hidden');
      $('.searchResult').empty();
  });
  // find items in table
    $('#procure_history_info_search').on('keyup',function(e){
      var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
      var tRow = $('.procure-history-info-row');
        $.each(tRow,function(index,data){
          var input  = $(this).children().text(),
              textL = $.trim(input).toLowerCase().replace(/ +/g, '');
              (!~textL.indexOf(text) == 0) ? $(this).addClass("animate fadeIn hinge").show(): $(this).fadeOut(100).hide(100) ;
        });
    });
    
  /*-----------------------------Remove FNC--------------------------------------------------------------------------------*/
  // remove  add order row
  $('table').on('click', '.add-procure-row-remove', function(){
    var element = $(this);
    var delete_item = element.parent().parent().children().find('input').attr('item-id');
    if($.inArray(delete_item, has_item) !== -1){//Deleting item from has_items array
      delete has_item[$.inArray(delete_item, has_item)];
    }
    swal({   
      title: "Are you sure?",   
      text: "",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete!",   
      closeOnConfirm: false }, 
      function(){   
        element.parent('td').parent('tr').remove();
        swal("Deleted!", "Removed.", "success"); 
    });
    
  });

    // edit add_procure row 
  $('table').on('click','.add-procure-row-edit',function(){
    $('.edit_unit').addClass('blink');
    $(this).parent().parent().children().eq(1).nextUntil(4).find('input').removeAttr('readonly').removeClass('mdl-textfield__input_border');
    $(this).addClass('hidden');
    $(this).parent().children().eq(1).addClass('hidden');
    $(this).parent().children().eq(2).removeClass('hidden');
    $(this).parent().children().eq(3).removeClass('hidden');
  });

  // update add_procure row
  $('table').on('click','.add-procure-row-done',function(){
    $(this).parent().parent().children().eq(1).nextUntil(4).find('input').addClass('mdl-textfield__input_border');
    $(this).addClass('hidden');
    $(this).parent().children().eq(3).addClass('hidden');
    $(this).parent().children().eq(0).removeClass('hidden');
    $(this).parent().children().eq(1).removeClass('hidden');
  });

  // reset add_procure row
  $('table').on('click','.add-procure-row-cancel',function(){
    $('.edit_unit').removeClass('blink');
    $(this).parent().parent().children().eq(1).nextUntil(4).find('input').addClass('mdl-textfield__input_border');
    $(this).addClass('hidden');
    $(this).parent().children().eq(2).addClass('hidden');
    $(this).parent().children().eq(0).removeClass('hidden');
    $(this).parent().children().eq(1).removeClass('hidden');
  });
/*----------X-------------X--------End Append/Remove ROW FNC--------------X-----------------------X--------------------------*/



/*------------------------------Auto Fills Functions-------------------------------------------------------------------------*/
  
  //Item autofill
  $('#selectProcItem,.select_Item').on('input',function(e){
      var $selector =$(this).next().next().next().children(),  //ul element
        text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase(),
        typeCode =1;
        if(text.length>0){
          $selector.parent().removeClass('hidden');
          itemSearch(text,typeCode ,$selector);
        }else{
          $selector.parent().addClass('hidden');
        }
       e.preventDefault();
    return false;
  });/*.on('blur',function(e){
    var $selector =$(this).next().next().next().children();
    itemName = $(this).attr('value');
    $(this).val(itemName);
    row = $selector.parent().parent().parent().parent(); //tr
    result = searchItemId(itemName);
    itemId = result.id;
    row.children().eq(1).children().children().eq(0).attr('item-id',itemId);

    var searchEstQuantity = estQuantity(itemId);
    if(typeof(estQuantity(itemId)) == "undefined"){
       row.children().eq(3).children().children().eq(0).val();
    }else{
       row.children().eq(3).children().children().eq(0).val(searchEstQuantity);
    }
  });*/

  //Vendor autofill
  $('body').delegate('#searchVendors,.sr_vendors ,.search_Vendors ','input',function(e) {
  var $selector =$(this).next().next().next().children(), // ul element
    text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase(),
    typeCode = 1;
    if(text.length>0){
      $selector.parent().removeClass('hidden');
      vendorSearch(text ,typeCode , $selector);
    }else{
      $selector.parent().addClass('hidden');
    }
  });

  //Markets autofill
  $('body').delegate('#searchProcureMarkets,.search_Markets','keyup',function(e) {
    var $selector =$(this).next().next().next().children(), // ul element
    text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase(),
    json = [];
    if(text.length>0){
      $selector.parent().removeClass('hidden');
      allMarkets.forEach(function(index, c){
       markets_names.push(allMarkets[c].name);
       json.push(allMarkets[c].name);
      });
        autoComplete(text ,json, $selector);
    }else{
      $selector.parent().addClass('hidden');
    }
  });//End market AutoFill
/*---------X----------------X------End AUTO FILL FUNCTIONS------X----------------X--------------------------------------------*/
  // back button confirm
  $(".btn-back-confirm").click(function(){
    swal({ 
      title: "Are you sure ?",   
            text: "",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: true, 
            animation: "slide-from-top",  
            showLoaderOnConfirm: false, }, 
            function(){
            $(".addProcureScreen,.createProcureScreen").addClass('hidden');
            $('.addProcureScreen ,.selectItemScreen').removeClass('hidden');
            $('.breadcrumb >a:nth-child(3)').removeClass('active');
            $('.pre_procure_cloned').remove();
            pre_item_name = []; pre_vendor_name = []; pre_units = []; pre_target_price = [];
      });
  });
/*---------------------------------Pre Procurement Function------------------------------------------------------------------*/
  $('.createManualProcure').on('click',function(){
    var isValid = true;
    $('#proc_Item,#proc_Quantity,#proc_TPrice').each(function(){
      if ($.trim($(this).val()) == '') {
          isValid = false;
          $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
      }else{
          $(this).css({"border-bottom": "2px solid #299035","background": ""});
          setTimeout($.proxy(function(){
          $(this).css({"border": "","background": ""});},this),2000);   
      }
    });
    if(isValid == true){
    $('.breadcrumb >a:nth-child(3)').addClass('active');
    $('.createProcureScreen').removeClass('hidden');
    $('.addProcureScreen ,.selectItemScreen').addClass('hidden');

    var rows = $('.clonedRow');
    var total = 0;
    for (var i = 0; i < price_array.length; i++) {
      total += price_array[i] << 0;
    }
    // console.log(price_array);
    $(rows).each(function(index){
      var pre_item_name = '', pre_vendor_name = '', pre_units = '', pre_target_price = ''; 
      pre_item_name    = $(this).children().eq(2).find('input').val();
      pre_vendor_name  = $(this).children().eq(3).find('input').val();
      pre_units        = $(this).children().eq(4).find('input').val();
      pre_target_price = $(this).children().eq(5).find('input').val();

      var clone = $('.pre_procure').clone();
      clone.removeClass('hidden').removeClass('pre_procure').addClass('pre_procure_cloned');
      $('.pre_procure_body').append(clone);
        $(clone).each(function(index){
          $(this).children().eq(1).html(pre_item_name);
          $(this).children().eq(2).html(pre_vendor_name);
          $(this).children().eq(3).html(pre_units);
          $(this).children().eq(4).html(pre_target_price);
      });
    });
    $('.procure_total').children().eq(2).html(total);
    }else{
      'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'please fill all input !',timeout:1000};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  });//End PreProcoure

/*---------------------------------Post Procurement Function------------------------------------------------------------------*/
  $('.confirmManualProcure').on('click',function(){
    var procureDate=$('#datepicker').val();
    var start_bal=$('#start_balance').val();
    var proc_manager=$("#team_id").attr('value');
    var mid = $('#searchProcureMarkets').val();
    var item_id=[],quantity=[],target_price=[],vendor_id=[],procure_date=[],market_id=[],assignee_id =[],proc_slot = [],start_balance = [];
    var rows = $('.createManualProcure').parent().parent().prev().children('tbody').children('tr.clonedRow');

    $(rows).each(function() {
      item_id      .push($(this).children().eq(2).find('input').attr('item-id'));
      vendor_id    .push($(this).children().eq(3).find('input').attr('vendor-id'));
      quantity     .push($(this).children().eq(4).find('input').val());
      target_price .push($(this).children().eq(5).find('input').val());
      procure_date .push(procureDate);
      assignee_id  .push(proc_manager);
      start_balance.push(start_bal);
      market_id    .push(getMarketID($('#searchProcureMarkets').attr('value')).id);
      proc_slot    .push($('#proc_Slot').val());
    });
    // console.log(item_id,quantity,target_price,vendor_id,market_id,team_id,proc_slot,procure_date);
    var data={
               item_id      : item_id     ,
               quantity     : quantity    ,
               target_price : target_price,
               vendor_id    : vendor_id   ,
               market_id    : market_id   ,
               procure_slot : proc_slot   ,
               assignee_id  : assignee_id ,
               start_balance: start_balance ,
               procure_date : procure_date
              };
      swal({   
          title: "Are you sure ?",   
          text: "",   
          type: "info",   
          showCancelButton: true,   
          closeOnConfirm: false, 
          animation: "slide-from-top",  
          showLoaderOnConfirm: true, }, 
          function(){
            $.ajax({
              url: 'api/manage-procure/procurement',
              type: 'POST',
              data: data,
              success:function(response){
                $('.breadcrumb >a:nth-child(4)').addClass('active');
                // $('.addProcureScreen ,.selectItemScreen').addClass('hidden');
                      'use strict';
                      var snackbarContainer = document.querySelector('#demo-toast-example');
                      var data = {message: 'Successfully Procured !',timeout:3000};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                      window.location.href = 'procureInfo?tid='+proc_manager+'&request=dashboard';
              },
              error: function (xhr, status, error) {
                if(xhr.status == 404 || xhr.status == 400){
                  var error_msg = xhr.responseJSON.error;
                  'use strict';
                  var snackbarContainer = document.querySelector('#demo-toast-example');
                  var data = {message: error_msg};
                  snackbarContainer.MaterialSnackbar.showSnackbar(data);
                }
              }
            });//End AJAX
      });//End Sweet Alert
  });//End Post Procure

/*-----------------------------View Procured Cards----------------------------------------------------------------------------*/ 
if (window.location.pathname == '/os/procurementInfo') {  
  displayCard(0,1);
}
if (window.location.pathname == '/os/procureInfo' || window.location.pathname == '/os/procurement') {  
  $('.tab_1').one('click', function(){ displayCard(0,1); });
}
$('.tab_2').one('click', function(){ displayCard(0,2); });

function displayCard(offset,tab){
 // $("body").delegate(".tab_switch","click", function(){
  var team_id = $("#team_id").attr('data-id');
  // console.log(team_id);
  if(team_id.length == 0){
    team_id = 0;
  }
  // $('.procHistoryTab').empty();
  // $('.procUpcommingTab').empty();
    $.ajax({
        url:"api/manage_procure/procure_cards/assignee_id/"+team_id+"/offset/"+offset+"/limit/"+12+"/tab/"+tab,
        type: 'GET',                    
        success: function(response){
        var proc_data = JSON.parse(JSON.stringify(response)).data;
          var cr=0;
          proc_data.forEach(function(Index, i) {
            var date = new Date(proc_data[i].procure_date);
            var d = date.getDate();
            var m =  date.getMonth();
            m += 1;  // JavaScript months are 0-11
            var y = date.getFullYear();
            var superScript;
            if(d == 1 || d==31){superScript = 'st';}else if(d==2 || d ==22){superScript ='nd';}else if(d==3 || d==23){superScript ='rd';}else{superScript = 'th';}
         
            var clone=$(".demoCardProchist").clone();
            if(tab == 1){
               clone.removeClass('demoCardProchist').addClass('procureCardCloned1').removeClass('hidden');
            }
            if(tab == 2){
               clone.removeClass('demoCardProchist').addClass('procureCardCloned2').removeClass('hidden');
            }
            if(proc_data[i].procure_date >= aaj ){
               $('.no_proc').addClass('hidden');
               upcomming.push(proc_data[i]);
               $('.procUpcommingTab').append(clone);
               $('.show_more_upcomming').removeClass('hidden');
            }else{ 
              $('.no_proc_hist').addClass('hidden'); 
              history.push(proc_data[i]);
              $('.procHistoryTab').append(clone);
              $('.show_more_hist').removeClass('hidden');

            }

            var temp=0;
            for (var j = 0; j < proc_data[i].length; j++) {
              if(proc_data[i].data[j].status==1){
                 if(proc_data[i].data[j].procure_date >= aaj){       
                    temp = temp + (parseFloat(proc_data[i].data[j].target_price * parseFloat(proc_data[i].data[j].quantity)));
                 }else{
                    temp = temp + parseFloat(proc_data[i].data[j].final_price);
                 }
              }
            }

            ++cr;
            clone.children().children().eq(0).children().append('Procurement ID: '+proc_data[i].id);
            clone.children().children().eq(1).children().append(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
            
            if(proc_data[i].procure_date >= aaj ){
              clone.children().children().eq(2).children().eq(0).attr('href','procTrackDetails?tid='+proc_data[i].assignee_id+'&uid='+proc_data[i].id+'&tab_stat=upcomming_tab').attr('id','infoToolproc'+cr);
            }else{clone.children().children().eq(2).children().eq(0).attr('href','procTrackDetails?tid='+proc_data[i].assignee_id+'&uid='+proc_data[i].id+'&tab_stat=history_tab').attr('id','infoToolproc'+cr);}
            clone.children().children().eq(2).children().eq(0).children().eq(1).attr('for','infoToolproc'+cr);
          });//  End each loop of manage_Procdata
          },
          error: function (xhr, status, error) {
            if(xhr.status == 404 || xhr.status == 400){
              var error_msg = xhr.responseJSON.error;
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {message: error_msg};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
              if(upcomming.length == 0 && tab == 1){
                 $('.no_proc').removeClass('hidden');
                // $('div .procUpcommingTab').append('<div class="mdl-card-status mdl-shadow--2dp"><p><i class="material-icons status_icon">error</i><p><p><h3>  Nothing to procure. <br> <br> Take Rest for a while.</h3></p></div>');
              }
              if(history.length == 0 && tab == 2){
                 $('.no_proc_hist').removeClass('hidden');
                 // $('div .procHistoryTab').append('<div class="mdl-card-status mdl-shadow--2dp"><p><i class="material-icons status_icon">error</i><p><p><h3> Procurement History Null! </h3></p></div>');
              }
            }
          }
    });//End Ajax
    
  // });//End Procured Cards
 }
 
 $('.show_more_upcomming').on('click',function(){
      var offset = $(".procureCardCloned1").length;
      displayCard(offset,1);
  });
  $('.show_more_hist').on('click',function(){
      var offset = $(".procureCardCloned2").length;
      displayCard(offset,2);
  });
/*------------------------------Procured Items Row Edit Function------------------------------------------------------------------*/
    var initial_price, initial_total_price,initial_quantity;
    $('table').on('click','.procure-info-row-edit',function(){
      var data_item_id = $(this).parent().attr('data-item-id');
      initial_quantity = $(this).parent().parent().children().eq(9).find('input').val();
      var single_price = $(this).parent().parent().children().eq(11).find('input').val();
      initial_price = parseFloat(initial_quantity)* parseFloat(single_price);
      initial_total_price = $('.total_price').attr('value');
      if ($(this).attr('disabled')=='disabled'){
          return false;
      }else{
          $('.show_procure_class'+data_item_id).addClass('hidden');
          $('.show_procure_class').addClass('hidden');
          $('.hide_procure_class'+data_item_id).removeClass('hidden');
      }
    });//End Row Edit Function

/*------------------------------Procured Items Row Cancel Function------------------------------------------------------------------*/
    $('table').on('click','.procure-info-row-cancel',function(){
      var data_item_id = $(this).parent().attr('data-item-id');
      $('.show_procure_class').removeClass('hidden');
      $('.show_procure_class'+data_item_id).removeClass('hidden');
      $('.hide_procure_class'+data_item_id).addClass('hidden');
    });//End Procured Items Cancel(BTN)

/*------------------------------Procured Items Row Done Function------------------------------------------------------------------*/
    $('table').on('click','.procure-info-row-done',function(){
      var data_item_id = $(this).parent().attr('data-item-id');
      var ipn_arr ={};
      var element = $(this);
         ipn_arr['proc_items_id'] = $(this).attr("data-items");
         ipn_arr['procure_id']    = $(this).attr("data-proc");
         
         $(this).parent().parent().children().find('input').each(function(key, value){
             ipn_arr[$(this).attr("name")] = $(this).val();      
         });
          var quantity = $(this).parent().parent().children().eq(9).find('input').val();
          var price = $(this).parent().parent().children().eq(11).find('input').val();
          var total_price = parseFloat(initial_total_price) - parseFloat(initial_price) + parseFloat((quantity)*(price));
          var get_item_id = searchItemId(ipn_arr['item_id']);
         ipn_arr['item_id']  =  get_item_id.id;
         ipn_arr['vendor_id'] = getVendorID(ipn_arr['vendor_id']);
         delete ipn_arr.undefined;
      swal({   
          title: "Are you sure ?",   
          text: "You want to update this item!",   
          type: "info",   
          showCancelButton: true,   
          closeOnConfirm: true, 
          animation: "slide-from-top",  
          showLoaderOnConfirm: false, }, 
          function(){
              $('.hide_procure_class'+data_item_id).addClass('hidden');
              $('.show_procure_class'+data_item_id).removeClass('hidden');
              $('.show_procure_class').removeClass('hidden');
              $.ajax({
                    url: 'api/Manage_procure/update_procure',
                    type: 'POST',
                    data: ipn_arr,
                    success: function(response){
                    element.parent().parent().children().eq(1).html(get_item_id.item_name);
                    element.parent().parent().children().eq(4).html(element.parent().parent().children().eq(5).find('input').val());
                    element.parent().parent().children().eq(8).html(element.parent().parent().children().eq(9).find('input').val());
                    element.parent().parent().children().eq(10).html(element.parent().parent().children().eq(11).find('input').val());
                    $('.total_price').text(total_price);
                    $('.total_price').attr('value',total_price);
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {message: 'Updated successfully !',timeout:1000};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    },
                    error: function (error) {
                      var error_msg = JSON.stringify(error.responseJSON.errors);
                      sweetAlert('Oops... ',error_msg,"error");
                    }
              });//End Ajax
      });//End sweet alert
    });//End procured Items row Done Function

/*------------------------------Procured Items Row Delete Function---------------------------------------------------------------------*/
    $('table').on('click','.procure-info-row-delete',function(){
      var data_item_id = $(this).parent().attr('data-item-id');
      var element = $(this);
      if (element.attr('disabled')=='disabled'){
          return false;
      }else{
        var log_id = $(this).attr('data-log');
        var reason = prompt("Please enter specific reason.", "");
        swal({   
            title: "Are you sure ?",   
            text: "You want to delete !",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: true, 
            animation: "slide-from-top",  
            showLoaderOnConfirm: false, }, 
            function(){
              $('.show_procure_class').removeClass('hidden');
              $('.show_procure_class'+data_item_id).removeClass('hidden');
              $('.hide_procure_class'+data_item_id).addClass('hidden');
          
                $.ajax({
                    url: 'api/Manage_procure/disable_item',
                    type: 'POST',
                    data: {log_id:log_id,reason:JSON.stringify(reason)},
                    success: function(response){
                    //swal("removed successfully!");
                    'use strict';
                      var snackbarContainer = document.querySelector('#demo-toast-example');
                      var data = {message: 'Removed successfully !',timeout:1000};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                          return false;
                    }, 
                    error: function(error) {
                     var error_msg = JSON.stringify(error.responseJSON.errors);
                     sweetAlert('Oops... ',error_msg,"error");
                    } 
                });//End Ajax
        });//End Sweet Alert
      }//End IF-ELSE 
    });//End Items Row Delete

   /*===================================================Purchase Order Cards==========================================================*/
    $.get("api/Manage_procure/purchase_orders_cards/procure_id/"+$('.get_tid_uid').attr('data-uid')+"/team_id/"+$('.get_tid_uid').attr('data-tid'), function(response){
        if((typeof(response.data) !== "undefined")){
          response.data.forEach(function(Index, i) {
            var clone=$(".demoCardP_O").clone();
            clone.removeClass('demoCardP_O');
            clone.addClass('demoCardP_OCloned');
            clone.removeClass('hidden');
            $('div .purchase_orderTab').append(clone);
            $.each(clone,function(Index, data){
                $(this).children().children().eq(0).children().append(response.data[i].vendor_name);
                $(this).children().children().eq(1).children().append(response.data[i].market_name);
                $(this).children().children().eq(3).children().eq(0).attr('href','procTrackVendorDetails?tid='+response.data[i].assignee_id+'&uid='+response.data[i].id+'&vid='+response.data[i].vendor_id);
                $(this).children().children().eq(3).children().eq(1).attr('data-id',response.data[i].id).attr('data-vendor',response.data[i].vendor_id).attr('data-assignee',response.data[i].assignee_id);
            });
          });
        }
    });

  /*==========================Purchase Order Print Function========================================*/
    $("body").delegate(".print_p_o", "click", function() {
      var assignee_id =  $(this).attr('data-assignee'); 
      var procure_id =  $(this).attr('data-id'); 
      var vendor_id =  $(this).attr('data-vendor'); 
	    $('.p_o_content').empty();
    
	    $.ajax({
	      url: 'api/purchase_orders',
	      type: 'POST',
	      data:{ 
	      assignee_id  : assignee_id ,
	      procure_id : procure_id,
	      vendor_id   : vendor_id 
	      },
	      success: function(response){
	        var win = window.open('about:blank');
          win.document.write(response);
	      // setTimeout(function(){
        
	      // $('.p_o_content').append(response);
           //          	// var demo_nv = document.getElementsByClassName('.invoice_content');
           //          	var dialog = document.querySelector('dialog');
           //          	dialog.showModal();
	         //    	// setTimeout(function(){ window.print(); }, 500);
	         //    	/* Or dialog.show(); to show the dialog without a backdrop. */
	         //    	$('#dialog-close').click(function() {
	         //    	dialog.close();
	         //    	});
	      // }, 1000);
	      },
	      error:function (xhr, status, error) {
          'use strict';
	        var snackbarContainer = document.querySelector('#demo-toast-example');
	        if(typeof(JSON.parse(xhr.responseText)) == 'undefined'){
	          var msg = 'No Data Found';
	        }else{
	          var msg = JSON.parse(xhr.responseText).error;
	        }
	           var data = {message: msg,timeout:1000};
	           snackbarContainer.MaterialSnackbar.showSnackbar(data);
	           return false;
        }
	    });
	  }); 

  /*--------------------------------Procurement Bulk Upload--------------------------------------------------------------------------*/
  $('#procure_listUpload').click(function(){
  	var formData = new FormData();
    formData.append('procure_file', document.getElementById('procure_list').files[0]);

    var isValid = true;
    $("#procure_list").each(function() { if($.trim($(this).val()) == '') { isValid = false; $('#procurelistlabel').css({'box-shadow':'0px 0px 23px 8px #ff4646'});}else{$('#procurelistlabel').css({'box-shadow':'none'});} });

    if (isValid == true) {
	    swal({   
	         title: "Are you sure ?",   
	         text: "",   
	         type: "info",   
	         showCancelButton: true,   
	         closeOnConfirm: true, 
	         animation: "slide-from-top",  
	         showLoaderOnConfirm: false, }, 
	         function(){
			   $.ajax({
				      url: 'api/manage_procure/pre_bulk_procure',
				      type: 'POST',
				      data: formData,
				      contentType: false,
				      processData: false,
				      success: function(response) {
                  var response = JSON.parse(JSON.stringify(response)).data;
				          //alert("successfully Added general rate list");
                  // console.log(response);
                  $('.clonedRow').each(function(){
                    $(this).remove();
                    price_array.length=0;
                  });                  
                  response.forEach(function(Index, i) {
                    $(".addProcureScreen").removeClass('hidden');
                    var tRow = $('.procure-item').clone();
                    tRow.removeClass('procure-item').addClass('clonedRow').removeClass('hidden');
                    $('.tbody').append(tRow);
                      tRow.children().eq(0).find('input').attr('id','squaredOne'+response[i].item_id);
                      tRow.children().eq(0).find('label').attr('for','squaredOne'+response[i].item_id);
                      tRow.children().eq(2).find('input').attr('item-id',response[i].item_id).addClass('select_Item').attr('id','proc_Item').val(response[i].item_name);
                      has_item.push(response[i].item_id);
                      tRow.children().eq(3).find('input').attr('vendor-id',response[i].vendor_id).addClass('search_Vendors').attr('id','proc_Vendor').val(response[i].vendor_name);
                      tRow.children().eq(4).find('input').attr('value',response[i].units).attr('id','proc_Quantity').val(response[i].units);
                      tRow.children().eq(5).find('input').attr('value',response[i].target_price).attr('id','proc_TPrice').val(response[i].target_price);
                      price_array.push(response[i].target_price);
                  });
                  componentHandler.upgradeDom();
                  'use strict';
                  var snackbarContainer = document.querySelector('#demo-toast-example');
                  var data = {message: 'File Successfully Uploaded',timeout: 3000};
                  snackbarContainer.MaterialSnackbar.showSnackbar(data);
				      },
				      error: function(xhr, status, error) {
                  if (xhr.status == 404 || xhr.status == 400) {
                      var error_msg = xhr.responseJSON.error;
                      'use strict';
                      var snackbarContainer = document.querySelector('#demo-toast-example');
                      var data = {
                          message: error_msg
                      };
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                      return false;
                  }
             }
			   });
		});
    }else{
        //swal({ title: "please select a file !", timer: 2000, showConfirmButton: false });
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Please select a file !',timeout: 1000};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  });   

  // Remove Bulk row
$('table').on('click', '.bulk_procure_delete', function(){

    swal({   
          title: "Are you sure?",   
          text: "",   
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "Yes, delete!",   
          closeOnConfirm: false }, 
          function(){
          $('.tr-selected').each(function(){
                var element = $(this);
                var delete_item = $(this).children().eq(2).children().find('input').attr('item-id');
                if($.inArray(delete_item, has_item) !== -1){//Deleting item from has_items array
                  delete has_item[$.inArray(delete_item, has_item)];
                }   
                $(this).remove();
          });
                swal("Deleted!", "Removed.", "success"); 
      }); 
  });

  //Dialog Open
  $(".add_market").on('click',function(){
    var dialog = document.querySelector('dialog');
        dialog.showModal();
  });

  //Function to Add Market
  $("#add_btn").on('click',function(){
    alert("Are You Sure?");
    var name    = $('#market_name').val();
    var address = $('#market_address').val();
    $.ajax({
            url:'api/Manage_markets/add_markets',
            method:'POST',
            data:{
                name    : name,
                address : address
            },
            success:function(response){
              'use strict';
              alert("Successfully Added Market!");
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {
                  message: 'Successfully added Market!',
                  timeout: 3000
              };
              var dialog = document.querySelector('dialog');
              dialog.close();
              location.reload();
            },
            error:function(error){

            }
      });
  });

  // close dialog
  $('#market-dialog-close').on('click',function(){
    var dialog = document.querySelector('dialog');
    dialog.close();
  });

  /*===================================RTV Cards======================================================*/

    $.get("api/Manage_inventory/rtv_details/",function(response){
        var response = JSON.parse(JSON.stringify(response)).data;
        var rtv = response.data;
        // console.log(rtv);
        if(typeof(rtv !== 'undefined')){
          rtv.forEach(function(Index,i){
            // console.log(rtv);
            var rtv_date = new Date(rtv[i].procure_date);
            var d = rtv_date.getDate();
            var m = rtv_date.getMonth();
            var y = rtv_date.getFullYear();
            var clone = $('.demoCardProchist').clone();
            clone.removeClass('demoCardProchist');
            clone.addClass('rtvCards');
            clone.removeClass('hidden');
            $('div .rtvTab').append(clone);
            $.each(clone, function(Index,data){
              $(this).children().children().eq(0).children().append('Procurement ID: '+rtv[i].id);
              $(this).children().children().eq(1).children().append('Date: '+d+'/'+m+'/'+y);
              $(this).children().children().eq(2).children().eq(0).attr('href','rtvInfo?procure_id='+rtv[i].id);
            });
          });
        }
  
    });
     
     if(window.location.pathname == '/os/rtvInfo'){
     $.get("api/Manage_inventory/rtv_info/procure_id/"+$('.get_procure_id').attr('data-id'),function(response){
        var response = JSON.parse(JSON.stringify(response)).data;
        var rtv_info = response.data;
        // console.log(rtv_info);
        if(typeof(rtv_info !== 'undefined')){
          rtv_info.forEach(function(Index,i){
            var rtv_date = new Date(rtv_info[i].procure_date);
            var d = rtv_date.getDate();
            var m = rtv_date.getMonth();
            var y = rtv_date.getFullYear();
            var clone = $('.demoCardrtvInfo').clone();
            clone.removeClass('demoCardrtvInfo');
            clone.addClass('rtvInfoCards');
            clone.removeClass('hidden');
            $('div .rtvInfoTab').append(clone);
            $.each(clone, function(Index,data){
              $(this).children().children().eq(0).children().append(rtv_info[i].name);
              $(this).children().children().eq(1).children().append(rtv_info[i].market_name);
              $(this).children().children().eq(2).children().eq(0).attr('href','rtvDetails?pid='+rtv_info[i].id+'&vid='+rtv_info[i].vendor_id+'&tid='+rtv_info[i].assignee_id);
              $(this).children().children().eq(2).children().eq(1).attr('data-id',rtv_info[i].id).attr('data-vid',rtv_info[i].vendor_id).attr('data-tid',rtv_info[i].assignee_id);
            });
          });
        }
      });
     }

    $('body').delegate('.print_rtv',"click",function(){
      var procure_id  = $(this).attr('data-id');
      var assignee_id = $(this).attr('data-tid');
      var vendor_id   = $(this).attr('data-vid');

        $.ajax({
	      url: 'View/print_rtv',
	      type: 'POST',
	      data:{ 
	            procure_id  : procure_id,
	            assignee_id : assignee_id,
	            vendor_id   : vendor_id
	      },
	      success: function(response){
	        // console.log(response);
          var win = window.open('about:blank');
          win.document.write(response);
	      },
	      error:function (xhr, status, error) {
          'use strict';
	        var snackbarContainer = document.querySelector('#demo-toast-example');
	        if(typeof(JSON.parse(xhr.responseText)) == 'undefined'){
	          var msg = 'No Data Found';
	        }else{
	          var msg = JSON.parse(xhr.responseText).error;
	        }
	           var data = {message: msg,timeout:1000};
	           snackbarContainer.MaterialSnackbar.showSnackbar(data);
	           return false;
        }
	    });
	  });

  //table Edit
  $('table').on('click','.edit_rtv',function(){  
    $(this).next().removeAttr('hidden');
    $(this).next().next().removeAttr('hidden');
    $(this).hide();
    $(this).parent().parent().children().eq(3).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    // $(this).parent().parent().children().eq(2).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
  });//End table Edit

  //table Edit->cancel
  $('table').on('click','.cancel_rtv',function(){  
    $(this).attr('hidden','true');
    $(this).prev().attr('hidden','true');
    $(this).prev().prev().show();
    $(this).parent().parent().children().eq(3).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    // $(this).parent().parent().children().eq(2).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
  });//End table Edit->cancel

  //table Update
  $('table').on('click','.update_rtv',function(){
    var ele           = $(this);
    var id            = $(this).attr('data-id');
    var quantity      = $(this).parent().parent().children().eq(3).find('input').val();

    swal({   
        title: "Are you sure ?",   
        text: "click ok and confirm!",   
        type: "info",   
        showCancelButton: true,   
        closeOnConfirm: true, 
        animation: "slide-from-top",  
        showLoaderOnConfirm: false
      },
        function(){ 
    $.ajax({
      url: 'api/Manage_inventory/rtv_update',
      type: 'POST',
      data: {id : id , quantity : quantity},
      success: function(response){
        var response = JSON.parse(JSON.stringify(response));
          //swal("Successfully Updated!");
          'use strict';
          var snackbarContainer = document.querySelector('#demo-toast-example');
          var data = {message: 'Successfully Updated !',timeout:3000};
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
          // location.reload();
          // ele.attr('data-id',response.id);
          ele.attr('hidden','true');
          ele.next().attr('hidden','true');
          ele.prev().show();
          ele.parent().parent().children().eq(3).children().find('input').val(quantity).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
        },
        error: function (error) {var error = JSON.parse(error.status);
          if (error == 401) {
             var error_msg = JSON.stringify(error.responseJSON.errors);
            sweetAlert('Oops... ',error_msg,"error");
          }else if(error == 400){
              sweetAlert("Oops...", "Check your input!", "error");                                    
          }
        }
    });//Ajax end
    });//End confirm alert
  });//End Post 
    
});//Document Ends Here