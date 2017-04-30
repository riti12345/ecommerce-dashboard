$(document).ready(function(){
 var vendor_name = new Array();
 var market_name = new Array("");
 var onspot_name = new Array();  
 var team_name = new Array(); 
 var rateList = [];
 var ratelist_length = [];
 var vendor_history_card = [];
 var onspot_Vendor_card =[];
 var onspot_Vendor_History_card = [];
 var empty_bills_today = [];
 var empty_bills_history = [];

 /*===Function to Add or Remove Alternate Vendor Names For Vendor Addition===*/
 $("#addinput").click(function() {
   var a ='<div class="mdl-textfield mdl-js-textfield"><input style="" type="text" class="mdl-textfield__input v_alt_vendor" placeholder="Enter Alternate Vendor Name">'
         +'</div>' //New input field html 
         +'<a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-button--colored remove_alt" href="javascript:void(0)"><i class="material-icons">remove_circle</i></a>'; 
         $('.appendme').append(a);
 });
 $('.appendme').on('click','.remove_alt',function() {
   if (confirm("Are you sure?")) {
       $(this).prev().remove();
       $(this).remove();
   }return false;
 }); 

/*------Toggle  button----*/


$('#v_status').click( function (){
  if ($(this).attr('data-disabled')=='disabled'){
    return false;  
  }
});

/*------Toggle  button----*/

    
/*==================Function to get ItemName=============*/
 /* function get_item_name(item_id){
  var n_item = new Array() ;
  for (q = 0; q<allItems.data.items.length;q++){
        if(allItems.data.items[q]['id'] == item_id){
         n_item =  allItems.data.items[q].item_name;                        
        }
     }
  return n_item;
  }*/

 /*=================Function to get UOM===================*/
  function get_item_uom(item_id){
    var n_item = new Array() ;
    
    for (b = 0; b<allItems.data.items.length;b++){
      if(allItems.data.items[b]['id'] == item_id){
        n_item['uom'] =  allItems.data.items[b]['uom'];                        
      }
    }
    return n_item;
  }

/*==========Function to get item_ID from ItemName=========*/                                            
  function get_item_id(itemName){
   var item_id;
   for (q = 0; q<allItems.data.items.length;q++){
       if((allItems.data.items[q]['item_name'] == itemName) || (allItems.data.items[q]['alternate_name'] == itemName)){
       item_id =  allItems.data.items[q]['id'];
       // item_id['sku'] = allItems.data.items[q]['sku'];
       }
     }
     return item_id;
 }
 
/*===============Get=Vendor=Name==========================*/
 function get_vendor_name(v_id){
  for(i=0; i < allVendors.length; i++){
    if(v_id == allVendors[i].id)
    vendor_name = allVendors[i].name;
  }
  return vendor_name;
 } 
/*===================================Function to view Vendors details==========================================================*/
  
  function displayCard(offset){
    $.ajax({
            url: 'api/manage-vendors/vendors/offset/'+offset +'/limit/'+16,
            type: 'GET',                    
            success: function(response){
            var response = JSON.parse(JSON.stringify(response));
            var Vendors   = response.data.vendors;

            // setTimeout(function(){
              // card display
              Vendors.forEach(function(Index, i) {
                var vendor_name =Vendors[i].name;
                var vendor_phone=Vendors[i].phone;
                var vendor_speciality=Vendors[i].speciality;
                var company_name=Vendors[i].company_name;
                var city_id=Vendors[i].city_id;
                var clone=$(".demoCardEmpty").clone();
                clone.removeClass('demoCardEmpty').addClass('demoCardCloned').removeClass('hidden');
                $('div .vendor').append(clone);
              
                clone.children().children().eq(0).children().eq(0).append(vendor_name).addClass('vendorName');
                clone.children().children().eq(1).children().eq(1).append(vendor_phone);
                if(typeof(Vendors[i].speciality['item_id'])){
                    clone.children().children().eq(2).children().eq(1).append(Vendors[i].speciality['item_name']);
                }
                if(typeof(Vendors[i].speciality['category'])){
                    clone.children().children().eq(2).children().eq(1).append(decode_category[Vendors[i].speciality['category']]);
                }
                if(typeof(Vendors[i].speciality['sub_category'])){
                    clone.children().children().eq(2).children().eq(1).append(decode_subcategory[Vendors[i].speciality['sub_category']]);
                }
                clone.children().children().eq(3).children().eq(0).attr('href','vendorsInfo?id='+Vendors[i].id+'').attr('id','infoTool'+i);//css({"border":"1px solid green"})
                clone.children().children().eq(3).children().eq(0).children().eq(1).attr('for','infoTool'+i);
                clone.children().children().eq(3).children().eq(2).attr('href','vendorRatelist?id='+Vendors[i].id+'').attr('id','ratelistTool'+i);
                clone.children().children().eq(3).children().eq(2).children().eq(1).attr('for','ratelistTool'+i);
                clone.children().children().eq(3).children().eq(1).attr('href','vendorHistory?id='+Vendors[i].id+'').attr('id','historyTool'+i);
                clone.children().children().eq(3).children().eq(1).children().eq(1).attr('for','historyTool'+i);
                ratelist_length.push(Vendors[i].rate_list);
                if(Vendors[i].status == 0){
                      clone.children().children().eq(4).children().children().eq(0).html('visibility_off');
                }
                // List view/ table view 
                var tRowClone = $('.vendorTrowEmpty').clone();
                tRowClone.removeClass('vendorTrowEmpty').addClass('vendorTrowCloned').removeClass('hidden');
                $('.vendorTbody').append(tRowClone);
                tRowClone.children().eq(0).children().attr('href','vendorsInfo?id='+Vendors[i].id+'').attr('id','infoTool'+i);
                tRowClone.children().eq(0).children().children().eq(1).attr('for','infoTool'+i);
                tRowClone.children().eq(1).append(vendor_name);
                tRowClone.children().eq(2).append(company_name);
                if(typeof(Vendors[i].speciality['item_id'])){
                    tRowClone.children().eq(3).append(Vendors[i].speciality['item_name']);
                }
                if(typeof(Vendors[i].speciality['category'])){
                    tRowClone.children().eq(3).append(decode_category[Vendors[i].speciality['category']]);
                }
                if(typeof(Vendors[i].speciality['sub_category'])){
                    tRowClone.children().eq(3).append(decode_subcategory[Vendors[i].speciality['sub_category']]);
                }
                tRowClone.children().eq(4).append(vendor_phone);
                tRowClone.children().eq(5).append(city_name[city_id]);

                if(document.getElementById('view_card_search')){
                   //$('div .searchResultCard').append(clone);
                   $('.vendorTableEmpty').parent().addClass('hidden');
                }else if(document.getElementById('view_list_search')){
                    //$('div .searchResultList').append(tRowClone);
                    $('.vendorTbody ,.vendorTbody2').addClass('hidden');
                }
              });  
                      // }, 1000);
                  },
                  error: function (xhr, status, error) {
                      // var error = JSON.parse(error.status);
                      // var err = eval("(" + xhr.responseText + ")");
                      if(xhr.status == 404){
                        var error_msg = xhr.responseJSON.error;
                  'use strict';
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {message: error_msg};
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                   return false;
                      }
            },
          });
          return false;
          // $('#p2').fadeOut(1000);
  }
  //Append list view and grid view 
  $('.list_view').click(function(){
      $('.grid_view ,.print_view').removeClass('hidden');
      $('.vendorTableEmpty').parent().removeClass('hidden');
      $('.demoCardCloned ,.list_view').addClass('hidden');
      $('.demoCardCloned ,.demoCardEmpty ').attr('id','');
      $('div .searchResultCard').addClass('hidden');
      $('div .searchResultList').removeClass('hidden');
      $('.vendorTbody , .vendorTbody2').attr('id','view_list_search');
  });

  $('.grid_view').click(function(){ 
      $('.grid_view ,.print_view').addClass('hidden');
      $('.demoCardCloned ,.list_view').removeClass('hidden');
      $('.vendorTableEmpty').parent().addClass('hidden');
      $('.demoCardCloned').attr('id','view_card_search');
      $('.vendorTbody , .vendorTbody2').attr('id','');
      $('div .searchResultList').addClass('hidden');
      $('div .searchResultCard').removeClass('hidden');
  });
  if(window.location.pathname == '/os/vendors'){
      displayCard(0);
  }
  $(".show_more").on('click',function(){
      var offset = $(".demoCardCloned").length;
      displayCard(offset);  
  });

    //if(ratelist_length ==0){
      //$('div .vendor_ratelist_table').append(
        //'<div class="mdl-card-status mdl-shadow--2dp">'+
          //'<p><i class="material-icons status_icon">error</i><p>'+
         // '<p><h3> Ratelist not yet uploaded ! <br> <br> Upload a Rate list.</h3></p>'+
       // '</div>');
     // $('div .vendor_ratelist_table table').hide();
   // }
  $("#searchVendor").donetyping(function() {
      var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
      var card = $(".demoCardCloned");
      var onSpotCard = $('.demoCardCloned2');
      var onSpotRow = $('.vendorTrowCloned2');
      var row = $(".vendorTrowCloned");
      var input;
      
      // // search in vendor registered card
      // $.each(card,function(index,data){
      //   input = $.trim($(this).children().children().text()).toLowerCase().replace(/ +/g, '');
      //   (!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeInUp hinge").show() : $(this).fadeOut(100).hide(100);
      // });
      
      // // Search in vendor registered table
      // $.each(row,function(index,data) {
      //     if(isNaN(text)){
      //     input = $.trim($(this).children().eq(0).nextUntil(4).text()).toLowerCase().replace(/ +/g, '');
      //     }else{
      //       input = $.trim($(this).children().eq(5).text()).toLowerCase().replace(/ +/g, ''); //search phone numbers
      //     }
      //     (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
      //   });

      // search in on spot vendor card
      $.each(onSpotCard,function(index,data){
        input = $.trim($(this).children().children().text()).toLowerCase().replace(/ +/g, '');
        (!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeInUp hinge").show() : $(this).fadeOut(100).hide(100);
      });
      
      // Search in on spot vendor table
      $.each(onSpotRow,function(index,data) {
          if(isNaN(text)){
          input = $.trim($(this).children().eq(0).nextUntil(4).text()).toLowerCase().replace(/ +/g, '');
          }else{
            input = $.trim($(this).children().eq(3).text()).toLowerCase().replace(/ +/g, ''); //search phone numbers
          }
          (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
        });
  });

  /*-------------------------------Function to Search Vendor Cards-----------------------------------------------------------------------------*/
    function search(text,typeCode){
        clearTimeout($.data(this, 'timer'));
        var wait =setTimeout(function(){
          $.ajax({
                url: 'api/manage_vendors/search',
                type: 'POST',
                data: {q   : text,
                       type: typeCode },
                success: function(response){
                    
                    var response = JSON.parse(JSON.stringify(response));
                     console.log(response);
                    $('.dynamic_search').removeClass('hidden');
                    $('.show_more').addClass('hidden');
                    $('.vendor').addClass('hidden');
                    for(var i=0; i<response.data.length; i++){
                      var vendor_name =response.data[i].name;
                      var vendor_phone=response.data[i].phone;
                      var vendor_speciality=response.data[i].speciality;
                      var company_name=response.data[i].company_name;
                      var city_id=response.data[i].city_id;
                      
                      //console.log(response.data.data.items[i].alternate_name);
                      var clone=$(".demoCardEmpty").clone();
                      clone.removeClass('demoCardEmpty').addClass('demoCardCloned').removeClass('hidden');
                      //$('div .searchResult').append(clone);
                      $('div .searchResultCard').append(clone);
                      clone.children().children().eq(0).children().eq(0).append(vendor_name).addClass('vendorName');
                      clone.children().children().eq(1).children().eq(1).append(vendor_phone);
                      if(typeof(response.data[i].speciality)['item_id']){
                          clone.children().children().eq(2).children().eq(1).append(response.data[i].speciality['item_name']);
                      }
                      if(typeof(response.data[i].speciality)['category']){
                          clone.children().children().eq(2).children().eq(1).append(decode_category[response.data[i].speciality['category']]);
                      }
                      if(typeof(response.data[i].speciality)['sub_category']){
                          clone.children().children().eq(2).children().eq(1).append(decode_subcategory[response.data[i].speciality['sub_category']]);
                      }
                      clone.children().children().eq(3).children().eq(0).attr('href','vendorsInfo?id='+response.data[i].id+'').attr('id','infoTool'+i);//css({"border":"1px solid green"})
                      clone.children().children().eq(3).children().eq(0).children().eq(1).attr('for','infoTool'+i);
                      clone.children().children().eq(3).children().eq(2).attr('href','vendorRatelist?id='+response.data[i].id+'').attr('id','ratelistTool'+i);
                      clone.children().children().eq(3).children().eq(2).children().eq(1).attr('for','ratelistTool'+i);
                      clone.children().children().eq(3).children().eq(1).attr('href','vendorHistory?id='+response.data[i].id+'').attr('id','historyTool'+i);
                      clone.children().children().eq(3).children().eq(1).children().eq(1).attr('for','historyTool'+i);
                     
                      if(response.data[i].status == 0){
                            clone.children().children().eq(4).children().children().eq(0).html('visibility_off');
                      }
                      // List view/ table view 
                      var tRowClone = $('.vendorTrowEmpty').clone();
                      tRowClone.removeClass('vendorTrowEmpty').addClass('vendorTrowCloned').removeClass('hidden');
                      $('div .searchResultList').append(tRowClone);
                      
                      tRowClone.children().eq(0).children().attr('href','vendorsInfo?id='+response.data[i].id+'').attr('id','infoTool'+i);
                      tRowClone.children().eq(0).children().children().eq(1).attr('for','infoTool'+i);
                      tRowClone.children().eq(1).append(vendor_name);
                      tRowClone.children().eq(2).append(company_name);
                      if(typeof(response.data[i].speciality['item_id'])){
                          tRowClone.children().eq(3).append(response.data[i].speciality['item_name']);
                      }
                      if(typeof(response.data[i].speciality['category'])){
                          tRowClone.children().eq(3).append(decode_category[response.data[i].speciality['category']]);
                      }
                      if(typeof(response.data[i].speciality['sub_category'])){
                          tRowClone.children().eq(3).append(decode_subcategory[response.data[i].speciality['sub_category']]);
                      }
                      tRowClone.children().eq(4).append(vendor_phone);
                      tRowClone.children().eq(5).append(city_name[city_id]); 
                      

                      if(document.getElementById('view_card_search')){
                         //$('.vendorTableEmpty').parent().addClass('hidden');
                      }else if(document.getElementById('view_list_search')){
                          //$('.vendorTbody ,.vendorTbody2').addClass('hidden');
                      }
                   } //$('.searchResult').empty();
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
        },500);
        $('.searchResultCard , .searchResultList').empty();
        $(this).data('timer', wait);
    }
    // Grid view search
    $("#searchVendor").donetyping(function(){
      var text = $.trim($(this).val()).toLowerCase();
      var typeCode = 1;

    if(text.length>=3){
      search(text,typeCode);
    }
    });
    $('#dynamic_div_close').on('click',function(){
      $('.dynamic_search').addClass('hidden');
      $('.vendor').removeClass('hidden');
      $('.show_more').removeClass('hidden');
      $('.searchResultCard , .searchResultList').empty();
      $('#search_vendor_category').next().next().children().eq(1).text('All');
      $('#search_vendor_category').next().next().next().children().children().eq(0).addClass('is-selected');
      $('#search_vendor_category').next().next().next().children().children().siblings().removeClass('is-selected');
      $('#search_vendor_sub_category').next().next().children().eq(1).text('All');
      $('#search_vendor_sub_category').next().next().next().children().children().eq(0).addClass('is-selected');
      $('#search_vendor_sub_category').next().next().next().children().children().siblings().removeClass('is-selected');
    });
      // Category Search 
      $('#search_vendor_category').on('change',function(){
        var category = $(this).val();
        var type = 3;
        $('#search_vendor_sub_category').val(function () {
          return $(this).find('option').filter(function () {
              return $(this).prop('SelectedIndex',0);
          }).val();
        });
        $('#search_vendor_sub_category').next().next().children().eq(1).text('All');
        $('#search_vendor_sub_category').next().next().next().children().children().eq(0).addClass('is-selected');
        $('#search_vendor_sub_category').next().next().next().children().children().siblings().removeClass('is-selected');
        
        if($(this).val() == 0){
          $('.dynamic_search').addClass('hidden');
          $('.vendor').removeClass('hidden');
          $('.searchResult').empty();
        }else{
          search(category,type);
        }
      });

      // Sub_Category Search 
      $('#search_vendor_sub_category').on('change',function(){
        var sub_category = $(this).val();
        var type = 4;
        
        $('#search_vendor_category').val(function () {
          return $(this).find('option').filter(function () {
              return $(this).prop('SelectedIndex',0);
          }).val();
        });
        $('#search_vendor_category').next().next().children().eq(1).text('All');
        $('#search_vendor_category').next().next().next().children().children().eq(0).addClass('is-selected');
        $('#search_vendor_category').next().next().next().children().children().siblings().removeClass('is-selected');
        
        if($(this).val() == 0){
             $('.dynamic_search').addClass('hidden');
            $('.vendor').removeClass('hidden');
            $('.searchResult').empty();
          }else{
            search(sub_category ,type);
          }
      });
/*===================================Function to view Onspot Vendors details==========================================================*/
  if((typeof(allOnspotVendors) !== "undefined")){
    allOnspotVendors.forEach(function(Index, i) {
        onspot_Vendor_card.push(allOnspotVendors[i]);
         //card view
          var clone=$(".demoCardEmptyOnspot").clone();
          clone.removeClass('demoCardEmptyOnspot').addClass('demoCardCloned2');
          clone.removeClass('hidden');
          $('div .onspotVendor').append(clone);
        
          clone.children().children().eq(0).children().append(allOnspotVendors[i].name);
          clone.children().children().eq(1).children().append(allOnspotVendors[i].phone);
          clone.children().children().eq(2).children().append(allOnspotVendors[i].address);
          // clone.children().children().eq(3).children().eq(0).attr('href','vendorsInfo?id='+allVendors[i].id+'');//css({"border":"1px solid green"})
          // clone.children().children().eq(3).children().eq(2).attr('href','vendorRatelist?id='+allVendors[i].id+'');
          clone.children().children().eq(3).children().eq(0).attr('href','onspotVendorHistory?id='+allOnspotVendors[i].id+'').attr('id','OSInfoTool'+i);
          clone.children().children().eq(3).children().eq(0).children().eq(1).attr('for','OSInfoTool'+i);
      
          // List view/ table view 
          var tRowClone = $('.vendorTrowEmpty2').clone();
          tRowClone.removeClass('vendorTrowEmpty2').addClass('vendorTrowCloned2').removeClass('hidden');
          
          tRowClone.children().eq(0).children().attr('href','onspotVendorHistory?id='+allOnspotVendors[i].id+'').attr('id','OSInfoTool'+i);
          tRowClone.children().eq(0).children().children().eq(1).attr('for','OSInfoTool'+i);
          tRowClone.children().eq(1).append(allOnspotVendors[i].name);
          tRowClone.children().eq(2).append(allOnspotVendors[i].id);
          tRowClone.children().eq(3).append(allOnspotVendors[i].phone);
          tRowClone.children().eq(4).append(allOnspotVendors[i].address);
         

          //Append list view and grid view 
          $('.list_view2').click(function(){
              $('.grid_view2').removeClass('hidden');
              $(this).hide();
              $('.grid_view2').show();
              $('.vendorTbody2').append(tRowClone);
              $('.vendorTableEmpty2').parent().removeClass('hidden');
              $('.demoCardCloned2').addClass('hidden');
              $('.demoCardCloned2').remove();
          });
          
          $('.grid_view2').click(function(){ 
              $(this).hide();
              $('.list_view2').show();
              $('div .onspotVendor').append(clone);
              $('.demoCardCloned2').removeClass('hidden');
              $('.vendorTableEmpty2').parent().addClass('hidden');
              $('.vendorTrowCloned2').remove();
          });
 });
  
}
  if(onspot_Vendor_card.length == 0){
      $('div .onspotVendor').append(
          '<div class="mdl-card-status mdl-shadow--2dp">'+
            '<p><i class="material-icons status_icon">history</i><p>'+
            '<p><h3> Onspot vendor none.<br> <br> </h3></p>'+
          '</div>');
  }
/*===================================Function to View Vendors History==========================================================*/
  if((typeof(allVendorsHistory) !== "undefined")){
    $.each(allVendorsHistory,function(prop, allVendorsHistory) {
          var tot_price = 0,tot_quantity=0; 
          for(i=0; i < allVendorsHistory['details'].length; i++){
            vendor_history_card.push(allVendorsHistory['details'][i]);
              if(!(allVendorsHistory['details'][i]['other_charges']==null)){
                 tot_price += parseFloat(allVendorsHistory['details'][i].final_price) + parseFloat(allVendorsHistory['details'][i]['other_charges'].extra_charges) + parseFloat(allVendorsHistory['details'][i]['other_charges'].labor_charges);
                 tot_quantity += parseFloat(allVendorsHistory['details'][i].final_quantity);
              }
          }
          var clone=$(".demoCardEmpty1").clone();
          clone.removeClass('demoCardEmpty1').addClass('demoHistory');
          clone.removeClass('hidden');
          $('div .vendorHistory').append(clone);
          clone.children().children().eq(0).children().append(prop);
          clone.children().children().eq(1).children().eq(1).append(tot_price);
          clone.children().children().eq(2).children().eq(1).append(tot_quantity);
          clone.children().children().eq(3).children().eq(0).attr('href','vendorHistoryInfo?id='+allVendorsHistory['vendor_id']+'&proc_date='+prop+'').attr('id','v_histTool'+i);//css({"border":"1px solid green"})
          clone.children().children().eq(3).children().eq(0).children().eq(1).attr('for','v_histTool'+i);
         
          // List view/ table view 
          var tRowClone = $('.vendorTrowEmpty1').clone();
          tRowClone.removeClass('vendorTrowEmpty1').addClass('vendorTrowCloned1').removeClass('hidden');
          
          tRowClone.children().eq(0).children().attr('href','vendorHistoryInfo?id='+allVendorsHistory['vendor_id']+'&proc_date='+prop+'').attr('id','v_histTool'+i);
          tRowClone.children().eq(0).children().children().eq(1).attr('for','v_histTool'+i);
          tRowClone.children().eq(1).append(prop);
          tRowClone.children().eq(2).append(tot_price);
          tRowClone.children().eq(3).append(tot_quantity);
         
          //Append list view and grid view 
          $('.list_view1').click(function(){
              $('.grid_view1').removeClass('hidden');
              $(this).hide();
              $('.grid_view1').show();
              $('.vendorTbody1').append(tRowClone);
              $('.vendorTableEmpty1').parent().removeClass('hidden');
              $('.demoHistory').addClass('hidden');
              $('.demoHistory').remove();
          });
          
          $('.grid_view1').click(function(){ 
              $(this).hide();
              $('.list_view1').show();
              $('div .vendorHistory').append(clone);
              $('.demoHistory').removeClass('hidden');
              $('.vendorTableEmpty1').parent().addClass('hidden');
              $('.vendorTrowCloned1').remove();
          });
   });
  }

    if(vendor_history_card.length == 0){
      $('div .vendorHistory').append(
        '<div class="mdl-card-status mdl-shadow--2dp">'+
          '<p><i class="material-icons status_icon">history</i><p>'+
          '<p><h3> No History of Vendor.<br> <br> </h3></p>'+
        '</div>');
    }

  /*-----------------------------search vendor history------------------------------------*/
  $("#search-vendor-history").on('keyup',function(){
    var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
    var card = $(".demoHistory");
    var input;
    $.each(card,function(index,data)
      {
        input = $.trim($(this).children().children().text()).toLowerCase().replace(/ +/g, '');
        (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
      });
  });
  /*===================================Function to View Onspot Vendors History==========================================================*/
  if((typeof(allOnspotVendorsHistory) !== "undefined")){
      $.each(allOnspotVendorsHistory,function(prop, allOnspotVendorsHistory) {
          var t_price = 0,t_quantity=0; 
          for(i=0; i < allOnspotVendorsHistory['details'].length; i++){
              onspot_Vendor_History_card.push(allOnspotVendorsHistory['details'][i]);
              if(!(allOnspotVendorsHistory['details'][i]['other_charges']==null)){
                 t_price += parseFloat(allOnspotVendorsHistory['details'][i].final_price) + parseFloat(allOnspotVendorsHistory['details'][i]['other_charges'].extra_charges) + parseFloat(allOnspotVendorsHistory['details'][i]['other_charges'].labor_charges);
                 t_quantity += parseFloat(allOnspotVendorsHistory['details'][i].final_quantity);
              }
          }
          var clone=$(".demoCardEmptyOS").clone();
          clone.removeClass('demoCardEmptyOS').addClass('demoHistory');
          clone.removeClass('hidden');
          $('div .onSpotVendorHistory').append(clone);
          clone.children().children().eq(0).children().append(prop);
          clone.children().children().eq(1).children().eq(1).append(t_price);
          clone.children().children().eq(2).children().eq(1).append(t_quantity);
          clone.children().children().eq(3).children().eq(0).attr('href','onspotVendorHistoryInfo?id='+allOnspotVendorsHistory['onspot_vendor_id']+'&proc_date='+prop+'').attr('id','OSV_histTool'+i);//css({"border":"1px solid green"})
          clone.children().children().eq(3).children().eq(0).children().eq(1).attr('for','OSV_histTool'+i);
      });
  }
    if(onspot_Vendor_History_card.length ==0){
      $('div .onSpotVendorHistory').append(
        '<div class="mdl-card-status mdl-shadow--2dp">'+
          '<p><i class="material-icons status_icon">history</i><p>'+
          '<p><h3> Vendor History None.<br> <br> </h3></p>'+
        '</div>');
    }
/*-----------------------------search vendor history info ------------------------------------------------------------------------------------------*/
  $("#search-vendor-history-info").on('keyup',function(){
  var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
  var row = $(".history-info-row");
  var input;
  $.each(row,function(index,data)
    {
      input = $.trim($(this).children().text()).toLowerCase().replace(/ +/g, '');
      (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
    });
  });
/*------------------------------Function to Edit Vendor Info---------------------------------------------------------------------------------------*/
  $('#v_edit').click(function(){
    $('span.info_icon').addClass('info_icon_1').removeClass('info_icon');
    $(this).hide();
    $('.showme').fadeIn().removeClass('hidden');
    $('.tog_disable').removeAttr('disabled');
    $('#v_status').removeAttr('data-disabled');
    $('.hideme').hide();
    $('label.mdl-checkbox').addClass("info_icon_1" );
    $('#pan_crd').parent().addClass('info_icon');

  });
/*------------------------------Function to Cancel Vendor Info---------------------------------------------------------------------------------------*/
  $('#v_cancel').click(function(){
    $('span.info_icon_1').removeClass('info_icon_1').addClass('info_icon');
    $('#v_edit').show();
    $('#v_form').trigger("reset");
    $('.showme').fadeOut().addClass('hidden');
    $('.tog_disable').attr('disabled','true');
    $('#v_status').attr('data-disabled','disabled');
    $('.hideme').show();
    $('label.mdl-checkbox').removeClass("info_icon_1" );
    $('#pan_crd').parent().addClass('info_icon');
  });

/*==============================Speciality Toggle Hide/Show================================================================*/
  $("#vendor_spec_item").click(function(){
    $('.item_show').removeClass('hidden');
    $('.category_show').addClass('hidden');$('.sub_cat_show').addClass('hidden');
  });
  $("#vendor_spec_category").click(function(){
    $('.category_show').removeClass('hidden');
    $('.item_show').addClass('hidden');$('.sub_cat_show').addClass('hidden');
  });
  $("#vendor_spec_sub_cat").click(function(){
    $('.sub_cat_show').removeClass('hidden');
    $('.item_show').addClass('hidden');$('.category_show').addClass('hidden');
  });
  
/*Removing leading spaces in vendor speciality as item*/
$('#v_spec_item').val($.trim($('#v_spec_item').val()));
/*==============================Function to Update the Details of Vendors==================================================*/ 
$("#v_save").click(function(){
  var isValid = true;
  //Validating required Fields
  $("#v_name,#v_cmp_name,#v_address,#v_phone,#v_pincode").each(function() {
    if ($.trim($(this).val()) == '') {
        isValid = false;
        $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
    } else {
        $(this).css({"border-bottom": "2px solid #299035","background": ""});
        setTimeout($.proxy(function(){
        $(this).css({"border": "","background": ""});},this),2000);               
    }
  });
  
  //Validating if atleast one type of Speciality is checked
  if ($("#v_form input[type='radio']:checked").length==0) {
      var snackbarContainer = document.querySelector('#demo-toast-example');
      var data = {message: 'Please Select atleast One Speciality !',timeout: 3000};
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
     $("#v_form input[type='radio']").focus().css({'outline':'1px solid red'});
    return false;
  }//End atleast one type of Speciality is checked
  
  //Validation of Item only As Speciality
  var speciality = $('#v_spec_item').attr('item-id');
  if ($("#vendor_spec_item").is(':checked') && speciality.length == 0) {
    'use strict';
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var data = {message: 'Please Enter Valid Speciality '};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
    return false;
  }//End Validation of Item only As Speciality

  //Validation of Speciality(if particular speciality is checked and not filled)
  if($("#vendor_spec_item").is(':checked')){
    if($.trim($('#v_spec_item').val()) == ''){
       swal({title: "please fill Item as Speciality !",timer: 1000,showConfirmButton: false });
       return false;
    }
  }
  if($("#vendor_spec_category").is(':checked')){
    if($.trim($('#v_spec_cat').val()) == ''){
       swal({title: "please fill Category as Speciality !",timer: 1000,showConfirmButton: false });
       return false;
    }
  }
  if($("#vendor_spec_sub_cat").is(':checked')){
    if($.trim($('#v_spec_sub_cat').val()) == ''){
       swal({title: "please fill Sub-Category as Speciality !",timer: 1000,showConfirmButton: false });
       return false;
    }
  }//End Validation of Speciality

  //Validating if atleast one method of payment is checked
  if ($("#v_form input[type='checkbox']:checked").length==0){
     'use strict';
      var snackbarContainer = document.querySelector('#demo-toast-example');
      var data = {message: 'Please Select atleast One Method of Payment !',timeout: 3000};
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
     $("#v_form input[type='checkbox']").css({'outline':'1px solid red'});
     return false;
  }//End if atleast one method of payment is checked

  if(isValid == true) {
    if ($("#v_status:checked").val() && $("#v_status:checked").val()=='yes') {var status = 1;}else{var status=0;}
    var mop_cash   = "no";
    var mop_cheque = "no";
    var mop_rtgs   = "no";
    var mop_neft   = "no";
    if ($("#v_cash:checked").val()) {mop_cash   = $("#v_cash:checked").val();}
    if ($("#v_cheque:checked").val()) {mop_cheque = $("#v_cheque:checked").val();}
    if ($("#v_rtgs:checked").val()) {mop_rtgs   = $("#v_rtgs:checked").val();}
    if ($("#v_neft:checked").val()) {mop_neft   = $("#v_neft:checked").val();}

    //speciality data get
    var spec = {'item_id':0,'category':0,'sub_category':0};
    if ($("#vendor_spec_item").is(':checked'))     {spec['item_id'      ] = parseInt($('#v_spec_item'   ).attr('item-id'))}; 
    if ($("#vendor_spec_category").is(':checked')) {spec['category'     ] = parseInt($('#v_spec_cat'    ).val()          )}; 
    if ($("#vendor_spec_sub_cat").is(':checked'))  {spec['sub_category' ] = parseInt($('#v_spec_sub_cat').val()          )}; 
    //End speciality data get

    var alt_vendor_name = [];
    $(".v_alt_vendor").each(function(){alt_vendor_name.push($(this).val());});
    var formData     = new FormData();
    formData.append('id'             , $(this).attr("data-id")      );
    formData.append('name'           , $("#v_name"           ).val());
    formData.append('company_name'   , $("#v_cmp_name"       ).val());
    formData.append('address'        , $("#v_address"        ).val());
    formData.append('phone'          , $('#v_phone'          ).val());
    formData.append('account_no'     , $('#v_account_no'     ).val());
    formData.append('ifsc'           , $('#v_ifsc'           ).val());
    formData.append('credit_cycle'   , $('#v_credit_cycle'   ).val());
    formData.append('credit_limit'   , $('#v_credit_limit'   ).val());
    formData.append('pincode'        , $('#v_pincode'        ).val());
    formData.append('email'          , $('#v_email'          ).val());
    formData.append('cheque_name'    , $('#v_cheque_name'    ).val());
    formData.append('speciality'     , JSON.stringify(spec)         );
    formData.append('status'         , status                       );
    formData.append('mop_cash'       , mop_cash                     );
    formData.append('mop_rtgs'       , mop_rtgs                     );
    formData.append('mop_cheque'     , mop_cheque                   );
    formData.append('mop_neft'       , mop_neft                     );
    formData.append('alt_vendor_name', JSON.stringify(alt_vendor_name));
    formData.append('city_id'        , $('#v_city'           ).attr("data-id"));
    formData.append('state'          , $('#v_state'          ).attr("data-id"));
    formData.append('pan_card'       , document.getElementById('v_pancard').files[0]);
    formData.append('licence'        , document.getElementById('v_licence').files[0]);
    formData.append('aadhaar_card'   , document.getElementById('v_aadhaar').files[0]);
    formData.append('other_card'     , document.getElementById('v_other').files[0]);

    swal({   
        title: "Are you sure ?",   
        text: "click ok and confirm!",   
        type: "info",   
        showCancelButton: true,   
        closeOnConfirm: false, 
        animation: "slide-from-top",  
        showLoaderOnConfirm: true, },
        function(){      
          $.ajax({
                  url: 'api/manage_vendors/update',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response){
                          //swal("Successfully Updated!");
                          'use strict';
                          var snackbarContainer = document.querySelector('#demo-toast-example');
                          var data = {message: 'Successfully Updated !',timeout: 3000};
                          snackbarContainer.MaterialSnackbar.showSnackbar(data);
                          location.reload();
                  },
                  error: function (error) {
                    var error_msg = JSON.stringify(error.responseJSON.errors);
                    sweetAlert('Oops... ',error_msg,"error");
                  }
          });
    }); 
  }else{
    'use strict';
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var data = {message: 'Please fill all input !'};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
    return false;
  }
  // $('.save'+id).hide();
});
/*===================X===========X============End Update Function for details of vendors===X============X==================*/ 

  /*=============If Image Not Loaded(error) Load Default Image============*/
  $('.vcardimg img').error(function(){
    if (!($(this).attr('src','./assets/img/default.png')))
          $(this).attr('src','./assets/img/default.png');
  });
          
/*=====================================Funtion to upload the Ratelist of Vendors========================================*/
$("#v_RatelistUpload").click(function(){
  var id=$(this).attr("data-id");
  //alert(id);
  var file =document.getElementById('v_ratelist').files[0];
  var formData=new FormData();
  formData.append('vendor_id', id);
  formData.append('file', file);
  var isValid = true;
    $("#v_ratelist").each(function() {
      if ($.trim($(this).val()) == '') {
          isValid = false;
          $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
      } else {
          $(this).css({"border-bottom": "2px solid #299035","background": ""});
          setTimeout($.proxy(function(){
          $(this).css({"border": "","background": ""});},this),2000);               
      }
    });
    if (isValid == true){
      $.ajax({
             url: 'api/manage_vendors/upload_rate_list',
             type: 'POST',
             data: formData,
             contentType: false,
             processData: false,
             success: function(response){
              swal("Successfully uploaded!", "", "success");
              location.reload();
             },
             error: function (error) {
                var error_msg = JSON.stringify(error.responseJSON.errors);
                sweetAlert('Oops... ',error_msg,"error");        
             }
      });
    }else{
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Please Select a File !'};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
        }
});

/*---------------------search in vendor ratelist -----------------------------------------------*/
  $("#search-vendor-rate").on('keyup',function(){
  var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
  var row = $(".vendor-rateList-row");
  var input;
  $.each(row,function(index,data)
    {
      input = $.trim($(this).children().text()).toLowerCase().replace(/ +/g, '');
      (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
    });
  });
      
/*=============X==============X========END LOOP VENDOR DETAILS AND RATELIST============X============X====================*/

/*===========================================Funtion to add the vendors==================================================*/
$("#vendorForm").submit(function(event) {
  event.preventDefault();
  var isValid = true;
  //Validation of Required Fields Start
  $("#vendor_name,#vendor_cmp_name,#vendor_address,#vendor_phone,#vendor_state,#vendor_pincode,#vendor_city").each(function() {
      if ($.trim($(this).val()) == '') {
          isValid = false;
          $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"}).addClass('blink');
      } else {
          $(this).css({"border-bottom": "2px solid #299035","background": ""}).removeClass('blink');
          setTimeout($.proxy(function(){
          $(this).css({"border": "","background": ""});},this),2000);               
      }
      $(this).change(function(){
        if ($.trim($(this).val()) !== '') {
            $(this).css({"border": "","background": ""}).removeClass('blink');               
        }else{$(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"}).addClass('blink');}
      });
  });//End Validation of Required Fields

  //Validating if atleast one type of Speciality is checked
  if ($("#vendorForm input[type='radio']:checked").length==0) {
      var snackbarContainer = document.querySelector('#demo-toast-example');
      var data = {message: 'Please Select atleast One Speciality !',timeout: 3000};
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
     $("#vendorForm input[type='radio']").focus().css({'outline':'1px solid red'});
    return false;
  }//End atleast one type of Speciality is checked
  
  //Validation of Item only As Speciality
  var speciality   = $('#vendor_item').attr('item-id');
  if ($("#vendor_spec_item").is(':checked') && speciality.length == 0) {
    'use strict';
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var data = {message: 'Please Enter Valid Speciality '};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
    return false;
  }//End Validation of Item only As Speciality

  //Validation of Speciality(if particular speciality is checked and not filled)
  if($("#vendor_spec_item").is(':checked')){
    if($.trim($('#vendor_item').val()) == ''){
       swal({title: "please fill Item as Speciality !",timer: 1000,showConfirmButton: false });
       return false;
    }
  }
  if($("#vendor_spec_category").is(':checked')){
    if($.trim($('#vendor_cat').val()) == ''){
       swal({title: "please fill Category as Speciality !",timer: 1000,showConfirmButton: false });
       return false;
    }
  }
  if($("#vendor_spec_sub_cat").is(':checked')){
    if($.trim($('#vendor_sub_cat').val()) == ''){
       swal({title: "please fill Sub-Category as Speciality !",timer: 1000,showConfirmButton: false });
       return false;
    }
  }//End Validation of Speciality

  //Validating if atleast one method of payment is checked
  if ($("#vendorForm input[type='checkbox']:checked").length==0){
     'use strict';
      var snackbarContainer = document.querySelector('#demo-toast-example');
      var data = {message: 'Please Select atleast One Method of Payment !',timeout: 3000};
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
     $("#vendorForm input[type='checkbox']").css({'outline':'1px solid red'});
     return false;
  }//End if atleast one method of payment is checked

  if (isValid == true) {
      var alt_vendor_name = [];
      //mop data get
      var mop_cash   = "no";
      var mop_cheque = "no";
      var mop_rtgs   = "no";
      var mop_neft   = "no";
      if ($("#vendor_cash:checked").val())  { mop_cash   = $("#vendor_cash:checked").val();}
      if ($("#vendor_cheque:checked").val()){ mop_cheque = $("#vendor_cheque:checked").val();}
      if ($("#vendor_rtgs:checked").val())  { mop_rtgs   = $("#vendor_rtgs:checked").val();}
      if ($("#vendor_neft:checked").val())  { mop_neft   = $("#vendor_neft:checked").val();}
      //End mop data get

      //speciality data get
      var spec = {'item_id':0,'category':0,'sub_category':0};
      if ($("#vendor_spec_item").is(':checked'))     {spec['item_id']      = parseInt($('#vendor_item'   ).attr('item-id'))};
      if ($("#vendor_spec_category").is(':checked')) {spec['category']     = parseInt($('#vendor_cat'    ).val()          )};
      if ($("#vendor_spec_sub_cat").is(':checked'))  {spec['sub_category'] = parseInt($('#vendor_sub_cat').val()          )};
      //End speciality data get

      $(".v_alt_vendor").each(function(){alt_vendor_name.push($(this).val());});
      var formData        = new FormData();
      formData.append('status'         , 1                                         );
      formData.append('name'           , $('#vendor_name'                   ).val());
      formData.append('company_name'   , $('#vendor_cmp_name'               ).val());
      formData.append('address'        , $('#vendor_address'                ).val());
      formData.append('phone'          , $('#vendor_phone'                  ).val());
      formData.append('account_no'     , $('#vendor_account_no'             ).val());
      formData.append('ifsc'           , $('#vendor_ifsc'                   ).val());
      formData.append('state'          , $('#vendor_state'                  ).val());
      formData.append('credit_cycle'   , $('#vendor_credit_cycle'           ).val());
      formData.append('pincode'        , $('#vendor_pincode'                ).val());
      formData.append('email'          , $('#vendor_email'                  ).val());
      formData.append('city_id'        , $('#vendor_city'                   ).val());
      formData.append('cheque_name'    , $('#vendor_cheque_name'            ).val());
      formData.append('credit_limit'   , $('#vendor_credit_limit'           ).val());
      formData.append('alt_vendor_name', JSON.stringify(alt_vendor_name)           );
      formData.append('mop_cash'       , mop_cash                                  );
      formData.append('mop_rtgs'       , mop_rtgs                                  );
      formData.append('mop_cheque'     , mop_cheque                                );
      formData.append('mop_neft'       , mop_neft                                  );
      formData.append('speciality'     , JSON.stringify(spec)                      );
      formData.append('pan_card'       , document.getElementById('vendor_pancard').files[0]);
      formData.append('licence'        , document.getElementById('vendor_licence').files[0]);
      formData.append('aadhaar_card'   , document.getElementById('vendor_aadhaar').files[0]);
      formData.append('other_card'     , document.getElementById('vendor_other').files[0]);
        swal({   
            title: "Are you sure ?",   
            text: "You want to add this vendor !",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: false, 
            animation: "slide-from-top",  
            showLoaderOnConfirm: true, }, 
            function(){
              $.ajax({
                  url: 'api/manage_vendors/vendors',
                  type: 'POST',
                  data:formData,
                  processData: false,
                  contentType: false,
                  success: function(response){
                          //swal("Successfully added vendor!", "", "success");
                          'use strict';
                          var snackbarContainer = document.querySelector('#demo-toast-example');
                          var data = {message: 'Successfully added Vendor !',timeout: 3000};
                          snackbarContainer.MaterialSnackbar.showSnackbar(data);
                          window.location.href = "vendors";
                  },
                  error: function (error) {
                    var error_msg = JSON.stringify(error.responseJSON.errors);
                    sweetAlert('Oops... ',error_msg,"error");
                  }
              });
          });
      }else{ swal({title: "please fill all input !",timer: 1000,showConfirmButton: false });
             return false;
      } 
});//End Add Vendor Function

// /*=========================Function to Sort Vendor Card Alphabetically====================*/
//   var $divs = $("div.regvencards");
//   var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
//       var vA= $(a).find("h4.vendorName").text();
//       var vB= $(b).find("h4.vendorName").text();
//       return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
//   });
//   $(".vendor").append(alphabeticallyOrderedDivs);
// /*========X========X===End Function to Sort Vendor Card Alphabetically====X======X========*/

/*---------------------------Item Auto Fill-----------------------------------------------*/
$('#v_spec_item,#vendor_item,#bill_item_id').on('keyup',function(e){
  var ele= $(this);
  var $selector =$(this).next().next().next().children(),  //ul element
    text = $(this).val(),
    typeCode = 1;
    
    if(text.length>0){
      $selector.parent().removeClass('hidden');
      itemSearch(text , typeCode ,$selector);
    }else{
      $selector.parent().addClass('hidden');
    }
    e.preventDefault();
    return false;
});  //End Item AutoFill

  //RateList Edit->Edit
  $('table').on('click','.v_rate_edit',function(){  
    $(this).next().removeAttr('hidden');
    $(this).next().next().removeAttr('hidden');
    $(this).hide();
    $(this).parent().parent().children().eq(4).attr('hidden','true');
    $(this).parent().parent().children().eq(5).removeAttr('hidden');
    $(this).parent().parent().children().eq(6).attr('hidden','true');
    $(this).parent().parent().children().eq(7).removeAttr('hidden');
  });//End RateList Edit

  //RateList Edit->Cancel
  $('table').on('click','.v_rate_cancel',function(){  
    $(this).attr('hidden','true');
    $(this).prev().attr('hidden','true');
    $(this).prev().prev().show();
    $(this).parent().parent().children().eq(5).attr('hidden','true');
    // $(this).parent().parent().children().eq(4).find('input').val('');
    $(this).parent().parent().children().eq(4).removeAttr('hidden');
    $(this).parent().parent().children().eq(7).attr('hidden','true');
    $(this).parent().parent().children().eq(6).removeAttr('hidden');
  });//End RateList Edit->cancel

/*--------------------------------Single Upload General RateList-------------------------------------------------------*/
  $('table').on('click','.v_rate_update', function(){
    var isValid   = true;
    var vendor_id = $(this).attr('vendor-id');
    var item_id   = $(this).attr('item-id');
    var price     = $(this).parent().parent().children().eq(5).find('input').val();
    var period    = $(this).parent().parent().children().eq(7).find('select').val();
    if($.trim($(this).parent().parent().children().eq(5).find('input').val()) == '' ){
       isValid = false;
       $(this).parent().parent().children().eq(5).find('input').css({"border-bottom": "2px solid #ff4646","background": "#fff"});
    }else{
       $(this).parent().parent().children().eq(5).find('input').css({'border-bottom':'none',"background": ""});
    }
    if($.trim($(this).parent().parent().children().eq(7).find('select').val()) == ''){
       isValid = false;
       $(this).parent().parent().children().eq(7).find('select').css({"border-bottom": "2px solid #ff4646","background": "#fff"});
    }else{
       $(this).parent().parent().children().eq(7).find('select').css({'border-bottom':'none',"background": ""});
    }
    if (isValid == true) {
      swal({
           title: "Are you sure ?",
           text: "",
           type: "info",
           showCancelButton: true,
           closeOnConfirm: true,
           animation: "slide-from-top",
           showLoaderOnConfirm: true, },
           function(){
         $.ajax({
              url: 'api/manage_vendors/single_ratelist_upload',
              type: 'POST',
              data: {
                     vendor_id : vendor_id,
                     item_id   : item_id,
                     price     : price,
                     period    : period,
                    },
              success: function(response) {
                var response = JSON.stringify(response);
                  //swal("Successfully Updated!");
                  'use strict';
                  var snackbarContainer = document.querySelector('#demo-toast-example');
                  var data = {message: 'Successfully Updated !',timeout: 3000};
                  snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  // location.reload();
                  return false;
              },
              error: function(error) {
                  var error = JSON.parse(error.status);
                  if (error == 401) {
                    var error_msg = JSON.stringify(error.responseJSON.errors);
                    sweetAlert('Oops... ',error_msg,"error");
                  }
              }
         });
    });
    }else{
        //swal({ title: "Please fill all the fields !", timer: 1000, showConfirmButton: false });
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Please fill all the fields !'};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  });
  
  /*----------------------------Vendor autofill-----------------------------------*/
  $('#vendor_id,#vendor_auto').on('input',function(e) {
  var $selector =$(this).next().next().next().children(), // ul element
    text = $(this).val(),
    typeCode =1;

    if(text.length>0){
      $selector.parent().removeClass('hidden');
      vendorSearch(text ,typeCode , $selector);
    }else{
      $selector.parent().addClass('hidden');
      return false;
    }
  e.preventDefault();
    return false;
  });//End Vendor AutoFill

    // Append rows
    $('#add_bill').on('click',function(){
      var isValid     = true;
      var bill_no     = $('#bill_no').val();
      var bill_amt    = $('#bill_amt').val();
      var vendor_id   = $('#vendor_id').attr('vendor-id');
      var bill_date   = $('#datepicker').val();
      var comment     = $('#comment').val();
      var bill_status = $('#bill_status').val();
      $("#bill_no, #bill_amt, #vendor_id, #datepicker,#comment").each(function() {

          if ($.trim($(this).val()) == '') {
              isValid = false;
              $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
          } else {
              $(this).css({"border-bottom": "2px solid #299035","background": ""});
              setTimeout($.proxy(function(){
              $(this).css({"border": "","background": ""});},this),2000);               
          }
      });
      if (isValid == true) {
         swal({   
            title: "Are you sure ?",   
            text: "click ok and confirm!",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: true, 
            animation: "slide-from-top",  
            showLoaderOnConfirm: false, },
            function(){
          $.ajax({
                url: 'api/manage_vendors/add_vendor_bills',
                type: 'POST',
                data:{
                     bill_no     : bill_no,
                     bill_amt    : bill_amt,
                     vendor_id   : vendor_id,
                     bill_date   : bill_date,
                     comment     : comment,
                     bill_status : bill_status
                     },
                success: function(response){
                  var response = JSON.parse(JSON.stringify(response));
                   //swal("Successfully Added!");
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {message: 'Successfully Added !',timeout:3000};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);

                    var tRow = $('.bill-item').clone();
                    tRow.removeClass('bill-item');
                    tRow.addClass('billCloned').addClass('bill_row');
                    tRow.removeClass('hidden');
                    $('.bill_tbody').prepend(tRow);
                    $.each(tRow,function(Index, data){
                        $(this).children().eq(0).addClass('bill_td');
                        $(this).children().eq(1).children().children().eq(0).val($('#bill_no').val());
                        $(this).children().eq(2).children().children().eq(0).val($('#bill_amt').val());
                        $(this).children().eq(3).children().children().eq(0).val($('#vendor_id').val()).attr('vendor-id',$('#vendor_id').attr('vendor-id'));
                        $(this).children().eq(4).children().children().eq(0).val($('#datepicker').val());
                        $(this).children().eq(5).children().children().eq(0).val($('#comment').val());
                        $(this).children().eq(6).children().children().eq(0).children().eq(0).text($('#bill_status :selected').text()).attr('value',$('#bill_status').val()).attr('selected','selected');
                        $(this).children().eq(7).children().eq(1).attr('data-id',response.id);
                    });
                    // empty input row
                    $('#bill_no, #bill_amt, #vendor_id, #datepicker,#comment').val('');
                    $('#vendor_id').next().addClass('hidden');
                    $('#vendor_id').removeClass('hidden');
                    setTimeout(function(){ $('#bill_no').focus(); }, 250);
                  },
                  error: function (error) {var error = JSON.parse(error.status);
                    if (error == 401) {
                      var error_msg = JSON.stringify(error.responseJSON.errors);
                      sweetAlert('Oops... ',error_msg,"error");}
                  }
          });//Ajax End
          });

      }else{
          'use strict';
          var snackbarContainer = document.querySelector('#demo-toast-example');
          var data = {message: 'Please fill all the inputs !'};
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
          return false;
      }
    });

  //Bill Edit
  $('table').on('click','.bill_edit',function(){  
    $(this).next().removeAttr('hidden');
    $(this).next().next().removeAttr('hidden');
    $(this).hide();
    $(this).parent().parent().children().eq(1).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(2).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(3).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(4).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(5).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(6).children().find('select').removeAttr('disabled').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    
    var id = $(this).attr('data-id');
    var date_id =('datepicker'+id);
    var picker = new Pikaday({
         field: document.getElementById(date_id),
         format: 'YYYY-MM-DD',
         onSelect: function() {
             console.log(this.getMoment().format('Do MMMM YYYY'));
         }
    });
  });//End Bill Edit

  //Bill Edit->cancel
  $('table').on('click','.bill_edit_cancel',function(){  
    $(this).attr('hidden','true');
    $(this).prev().attr('hidden','true');
    $(this).prev().prev().show();
    $(this).parent().parent().children().eq(1).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(2).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(3).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(4).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(5).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(6).children().find('select').attr('disabled','true').css({'background-color':'inherit','border-bottom':''});
  });//End Bill Edit->cancel

  //Bill Update
  $('table').on('click','.bill_update',function(){
    var ele           = $(this);
    var id            = $(this).attr('data-id');
    var bill_no       = $(this).parent().parent().children().eq(1).find('input').val();
    var bill_amt      = $(this).parent().parent().children().eq(2).find('input').val();
    var vendor_id     = $(this).parent().parent().children().eq(3).children().children().attr('vendor-id');
    var bill_date     = $(this).parent().parent().children().eq(4).find('input').val();
    var comment       = $(this).parent().parent().children().eq(5).find('input').val();
    var bill_status   = $(this).parent().parent().children().eq(6).find('select').val();
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
      url: 'api/manage_vendors/update_vendor_bills',
      type: 'POST',
      data: {id : id , bill_no : bill_no, bill_amt : bill_amt, vendor_id : vendor_id, bill_date : bill_date, comment : comment, bill_status : bill_status},
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
          ele.parent().parent().children().eq(1).children().find('input').val(bill_no).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(2).children().find('input').val(bill_amt).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(4).children().find('input').val(bill_date).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(5).children().find('input').val(comment).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(6).children().find('select').children().eq(0).text(bill_status_arr[bill_status]).attr('value',bill_status).attr('selected','selected');
          ele.parent().parent().children().eq(6).children().find('select').attr('disabled','true').css({'background-color':'inherit','border-bottom':''});
          
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
  });//End Raw Post

/*---------------------search in vendor bills -----------------------------------------------*/
  // $("#vendor_bill_search").on('keyup',function(){
  //   var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
  //   var row = $(".bill_row");
  //   var input;
  //   $.each(row,function(index,data){
  //     input = $.trim($(this).children().eq(8).children().text()).toLowerCase().replace(/ +/g, '');
  //     (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
  //   });
  // });//End Vendor bills Search

/*------------------------------Item autofill for vendor Bills-------------------------------------*/

/*----------------- Function for Vendor Bill Modal-Show----------------------------------------------*/
$('table').delegate('.count,.bill_td','click',function(){
  var id = $(this).parent().children().eq(7).children().eq(1).attr('data-id');
  var bill_no = $(this).parent().children().eq(1).children().children().eq(0).val();
  var bill_total = $(this).parent().children().eq(2).children().children().eq(0).val();
  
  //Appending bill details on modal
  $('.for_bill_no').html('<h4><b>Bill No:</b> '+bill_no+'</h4>');
  $('.for_bill_tot').html('<h4><b>Bill Total:</b> '+bill_total+'</h4>');
  $('#add_bill_log').attr('data-id',id).attr('data-bill',bill_no);

  var dialog = document.querySelector('dialog');
  dialog.showModal();//show modal

  //Get Vendor items for Bills
  $('.bill_iTbody').empty();$('.bill_iTotal').empty();
  $.ajax({
        url: 'api/manage_vendors/get_vendor_bills_log_items',
        type: 'POST',
        data:{id : id, bill_no : bill_no,},
        success: function(response){
          var bill_data = JSON.parse(JSON.stringify(response));
          var total = 0 ;
          if((typeof(bill_data.data) !== "undefined")){
            //Appending All Items if Present in Bill Log
            bill_data.data.forEach(function(Index, i) {
              var tRow = $('.bill_item').clone();
              tRow.removeClass('bill_item');
              tRow.addClass('billCloned');
              tRow.removeClass('hidden');
              $('.bill_iTbody').prepend(tRow);
              $.each(tRow,function(Index, data){
                  $(this).attr('item-id',bill_data.data[i].item_id);
                  $(this).children().eq(1).children().children().eq(0).val(bill_data.data[i].item_name);
                  $(this).children().eq(2).children().children().eq(0).val(bill_data.data[i].rate);
                  $(this).children().eq(3).children().children().eq(0).val(bill_data.data[i].qty);
                  $(this).children().eq(4).children().children().eq(0).val(bill_data.data[i].apmc_tax);
                  $(this).children().eq(5).children().children().eq(0).val(bill_data.data[i].levi_tax);
                  $(this).children().eq(6).children().eq(0).attr('data-id',bill_data.data[i].bill_id).attr('data-bill',bill_data.data[i].bill_no);
                  total +=parseFloat(bill_data.data[i].rate) * parseFloat(bill_data.data[i].qty)+ parseFloat(bill_data.data[i].apmc_tax)+parseFloat(bill_data.data[i].levi_tax);
                  $('.bill_iTotal').html(total);
              });
            });//End Append bill Items
          }  
        },//end success function
        error: function (error) {var error = JSON.parse(error.status);
          if (error == 401) {/*sweetAlert("Oops...", "Something went wrong!", "error");*/ //alert('Something Went Wrong!');
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {message: 'Something Went Wrong !'};
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
          }
        }//end error function
  });//Ajax End for Get Vendor Items in Bills  
});//End Vendor Bill Modal Show

/*----------------------------------Function to Add Bill Item------------------------------------------------*/
$('body').delegate('#add_bill_log','click',function(){
    var isValid  = true;
    var bill_id  = $(this).attr('data-id');
    var bill_no  = $(this).attr('data-bill');
    var rate     = $('#bill_rate').val();
    var qty      = $('#bill_qty').val();
    var apmc_tax = $('#bill_apmc_tax').val();
    var levi_tax = $('#bill_levi_tax').val();
    var item_id = $('#bill_item_id').attr('item-id');
    $("#bill_item_id, #bill_rate, #bill_qty, #bill_apmc_tax,#bill_levi_tax").each(function() {
          if ($.trim($(this).val()) == '') {
              isValid = false;
              $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
          } else {
              $(this).css({"border-bottom": "2px solid #299035","background": ""});
              setTimeout($.proxy(function(){
              $(this).css({"border": "","background": ""});},this),2000);               
          }
    });
    if (isValid == true) {
         // swal({   
         //    title: "Are you sure ?",   
         //    text: "click ok and confirm!",   
         //    type: "info",   
         //    showCancelButton: true,   
         //    closeOnConfirm: false, 
         //    animation: "slide-from-top",  
         //    showLoaderOnConfirm: true, },
         //    function(){
        // if(confirm("Are You Sure?")){
          $.ajax({
                url: 'api/manage_vendors/add_vendor_bills_logs',
                type: 'POST',
                data:{
                        bill_id  :bill_id ,
                        bill_no  :bill_no ,       
                        item_id  :item_id ,       
                        rate     :rate    ,    
                        qty      :qty     ,   
                        apmc_tax :apmc_tax,        
                        levi_tax :levi_tax,          
                     },
                success: function(response){
                  var response = JSON.parse(JSON.stringify(response));
                    // swal("Successfully Added!");
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {message: 'Successfully Added !'};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);

                    $(".billCloned").each(function() {
                        if($(this).attr('item-id') == item_id){
                          $(this).remove();
                          var tmp_itotal   = parseFloat($('.bill_iTotal').text()); 
                          var tmp_rate     = parseFloat($(this).children().eq(2).children().children().eq(0).val());
                          var tmp_qty      = parseFloat($(this).children().eq(3).children().children().eq(0).val());
                          var tmp_apmc_tax = parseFloat($(this).children().eq(4).children().children().eq(0).val());
                          var tmp_levi_tax = parseFloat($(this).children().eq(5).children().children().eq(0).val());
                          var tmp_tot = (tmp_rate * tmp_qty) + tmp_apmc_tax + tmp_levi_tax;
                          $('.bill_iTotal').html(tmp_itotal - tmp_tot);
                        }
                    });
                    //Append row on success of adding item
                    var tRow = $('.bill_item').clone();
                    var total = parseFloat($('.bill_iTotal').text());
                    tRow.removeClass('bill_item');
                    tRow.addClass('billCloned');
                    tRow.removeClass('hidden');
                    $('.bill_iTbody').prepend(tRow);
                    $.each(tRow,function(Index, data){
                        $(this).attr('item-id',item_id);
                        $(this).children().eq(1).children().children().eq(0).val($('#bill_item_id').next().children().eq(0).text());
                        $(this).children().eq(2).children().children().eq(0).val($('#bill_rate').val());
                        $(this).children().eq(3).children().children().eq(0).val($('#bill_qty').val());
                        $(this).children().eq(4).children().children().eq(0).val($('#bill_apmc_tax').val());
                        $(this).children().eq(5).children().children().eq(0).val($('#bill_levi_tax').val());
                        $(this).children().eq(6).children().eq(0).attr('data-id',bill_id).attr('data-bill',bill_no);
                        total += parseFloat($('#bill_rate').val()) * parseFloat($('#bill_qty').val()) + parseFloat($('#bill_apmc_tax').val()) + parseFloat($('#bill_levi_tax').val());
                        $('.bill_iTotal').html(total);
                        $('#bill_item_id, #bill_rate, #bill_qty, #bill_apmc_tax,#bill_levi_tax').val('');
                    });//End Append row
                    // empty input row
                    $('#bill_item_id, #bill_rate, #bill_qty, #bill_apmc_tax,#bill_levi_tax').val('');
                    $('#bill_item_id').removeClass('hidden');
                    $('#bill_item_id').next().addClass('hidden');

                  },//end success fnc
                  error: function (error) {var error = JSON.parse(error.status);
                    $('#bill_item_id, #bill_rate, #bill_qty, #bill_apmc_tax,#bill_levi_tax').val('');
                    if (error == 401) {/*sweetAlert("Oops...", "Something went wrong!", "error");*/ alert('Something Went Wrong!')}
                    if (error == 500) {/*sweetAlert("Oops...", "Something went wrong!", "error");*/ alert('Something Went Wrong!\n(Check if Item Already Added.)')}
                  }//end error fnc
          });//Ajax End
          // });
          // }else{return false;}

      }else{
          //swal({ title: "please fill all input !", timer: 1000, showConfirmButton: false });
          'use strict';
          var snackbarContainer = document.querySelector('#demo-toast-example');
          var data = {message: 'Please fill all input !'};
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
          return false;
      }
  });//End Add Bill Log

/*-------------------------Vendor Bill Modal-CLose----------------------------------------------------------*/
$('#dialog-close').click(function() {
  dialog.close();
  $('#bill_item_id, #bill_rate, #bill_qty, #bill_apmc_tax,#bill_levi_tax').val('');
  $('#bill_item_id').removeClass('hidden');
  $('#bill_item_id').next().addClass('hidden');
});//End Vendor bill Modal Close

/*-------------------------Fuction to calculate current items total------------------------------------------*/
$('table').delegate('#bill_qty,#bill_rate,#bill_apmc_tax,#bill_levi_tax','keyup',function(){
  var tot = 0;
  var bill_rate   = parseFloat($('#bill_rate').val());
  var bill_qty    = parseFloat($('#bill_qty').val());
  var apmc_tax    = parseFloat($('#bill_apmc_tax').val());
  var levi_tax    = parseFloat($('#bill_levi_tax').val());
  tot = bill_rate * bill_qty + apmc_tax+ levi_tax;
  $('.for_bill_itot').html("<h4><b>Item Total:</b> "+tot);
  // $('.for_bill_ftot').html("<h4><b>Final Total:</b> "+tot);
});//End current item total function

/*-----------------------------Function to delete Bill Items--------------------------------------------------*/
$('table').delegate('#bill_delete','click',function(){
  var bill_id  = $(this).attr('data-id');
  var bill_no  = $(this).attr('data-bill');
  var item_id  = $(this).parent().parent().attr('item-id');
  var ele      = $(this);

  if(confirm("Are You Sure?")){
    $.ajax({
      url: 'api/manage_vendors/delete_vendor_bills_items',
      type: 'POST',
      data:{
              bill_id  :bill_id ,
              bill_no  :bill_no ,       
              item_id  :item_id ,       
           },
      success: function(response){
        var response = JSON.parse(JSON.stringify(response));
          // swal("Successfully Added!");

        // if($(this).parent().parent().attr('item-id') == item_id){
          var tmp_itotal   = parseFloat($('.bill_iTotal').text()); 
          var tmp_rate     = parseFloat(ele.parent().parent().children().eq(2).children().children().eq(0).val());
          var tmp_qty      = parseFloat(ele.parent().parent().children().eq(3).children().children().eq(0).val());
          var tmp_apmc_tax = parseFloat(ele.parent().parent().children().eq(4).children().children().eq(0).val());
          var tmp_levi_tax = parseFloat(ele.parent().parent().children().eq(5).children().children().eq(0).val());
          var tmp_tot = (tmp_rate * tmp_qty) + tmp_apmc_tax + tmp_levi_tax;
          $('.bill_iTotal').html(tmp_itotal - tmp_tot);
          ele.parent().parent().remove();
        // }
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Successfully Deleted !',timeout:3000};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
      },//end success fnc
      error: function (error) {var error = JSON.parse(error.status);
          if (error == 401) {/*sweetAlert("Oops...", "Something went wrong!", "error");*/ alert('Something Went Wrong!')}
      }//end error fnc
    });//Ajax End
  }else{return false;}  
});//End Function Delete Bill Items

/*-------------------------------Function to View Vendor Bills-----------------------------------------------------------------------------*/

function displayTable(offset) {
        $.ajax({
            url: 'api/manage_vendors/get_vendor_bills/offset/' + offset + '/limit/' + 16,
            type: 'GET',
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                // console.log(response.data);
                response.data.forEach(function(Index, i) {
                var tRow = $('.bill-item').clone();
                    tRow.removeClass('bill-item');
                    tRow.addClass('billCloned').addClass('bill_row');
                    tRow.removeClass('hidden');
                    $('.bill_tbody').append(tRow);
                        tRow.children().eq(0).addClass('bill_td');
                        tRow.children().eq(1).children().children().eq(0).val(response.data[i].bill_no);
                        tRow.children().eq(2).children().children().eq(0).val(response.data[i].bill_amt);
                        tRow.children().eq(3).children().children().eq(0).val(response.data[i].vendor_id).attr('vendor-id',response.data[i].vendor_id);
                        tRow.children().eq(4).children().children().eq(0).val(response.data[i].bill_date);
                        tRow.children().eq(5).children().children().eq(0).val(response.data[i].comment);
                        tRow.children().eq(6).children().children().eq(0).children().eq(0).text(bill_status_arr[response.data[i].status]).attr('value',response.data[i].status).attr('selected','selected');
                        tRow.children().eq(7).children().eq(1).attr('data-id',response.data[i].id);
                    });
                
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
        return false;
    }

    $(".show_more").on('click', function() {
        var offset = $(".bill_row").length;
        displayTable(offset);
    });

 /*-------------------------------Function to Search Vendor Bills-----------------------------------------------------------------------------*/

    $("#vendor_bill_search").donetyping(function(e) {
      var text = $(this).val();
      if (text.length >= 3) {
        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(function() {
          $.ajax({
              url: 'api/manage_vendors/vendor_bills_search',
              type: 'POST',
              data: {
                  q: text
              },
              success: function(response) {
                  var response = JSON.parse(JSON.stringify(response));
                  $('.dynamic_search').removeClass('hidden');
                  $('.show_more,.page-content').addClass('hidden');
                 response.data.forEach(function(Index, i) {
                    var tRow = $('.bill-item').clone();
                    tRow.removeClass('bill-item');
                    tRow.addClass('billsearchCloned');
                    tRow.removeClass('hidden');
                    $('.searchResultTable').append(tRow);
                    tRow.children().eq(0).addClass('bill_td');
                    tRow.children().eq(1).children().children().eq(0).val(response.data[i].bill_no);
                    tRow.children().eq(2).children().children().eq(0).val(response.data[i].bill_amt);
                    tRow.children().eq(3).children().children().eq(0).val(response.data[i].vendor_id).attr('vendor-id',response.data[i].vendor_id);
                    tRow.children().eq(4).children().children().eq(0).val(response.data[i].bill_date);
                    tRow.children().eq(5).children().children().eq(0).val(response.data[i].comment);
                    tRow.children().eq(6).children().children().eq(0).children().eq(0).text(bill_status_arr[response.data[i].status]).attr('value',response.data[i].status).attr('selected','selected');
                    tRow.children().eq(7).children().eq(1).attr('data-id',response.data[i].id);
                 });
              },
              error: function(error) {
                  'use strict';
                  var snackbarContainer = document.querySelector('#demo-toast-example');
                  var data = {
                      message: 'No data found !',
                      timeout: 1000
                  };
                  snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  return false;
              }
          });
          }, 500);
          $('.searchResultTable').empty();
          $(this).data('timer', wait);
      }
    });

    $('#dynamic_div_close').on('click',function(){
        $('.dynamic_search').addClass('hidden');
        $('.page-content,.show_more').removeClass('hidden');
        $('.searchResultTable').empty();
    });

 /*-----------------------------Vendor Bills Cards------------------------------------*/

    function displayCardBills(offset,tab) {
        $.ajax({
            url: 'api/manage_vendors/get_vendor_bills/offset/' + offset + '/limit/' + 16+'/tab/'+tab,
            type: 'GET',
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                response.data.forEach(function(Index, i) {
                  var date = new Date(response.data[i].bill_date);
                  var d = date.getDate();
                  var m = date.getMonth();
                  m += 1; // JavaScript months are 0-11
                  var y = date.getFullYear();
                  var superScript;
                  if (d == 1 || d == 31) {
                      superScript = 'st';
                  } else if (d == 2 || d == 22) {
                      superScript = 'nd';
                  } else if (d == 3 || d == 23) {
                      superScript = 'rd';
                  } else {
                      superScript = 'th';
                  }
                  var clone = $('.demoCardBills').clone();
                  if (tab == 1) {
                    clone.removeClass('demoCardBills').addClass('billCardsCloned1').removeClass('hidden');
                  }
                  if (tab == 2) {
                    clone.removeClass('demoCardBills').addClass('billCardsCloned2').removeClass('hidden');
                  }

                  if(response.data[i].bill_date >= currentDate){
                    $('.bills_today').append(clone);
                    empty_bills_today.push(response.data[i]);
                    $('.show_more_bills_today').removeClass('hidden');
                  }else{
                    $('.bills_history').append(clone);
                    empty_bills_history.push(response.data[i]);
                    $('.show_more_bills_history').removeClass('hidden');
                  }
                  clone.children().children().eq(0).children().append(response.data[i].bill_no);
                  clone.children().children().eq(1).children().append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                  clone.children().children().eq(2).children().append(response.data[i].vendor_name);
                  clone.children().children().eq(3).children().attr('href','vendorBillsInfo?id='+response.data[i].id+'&bill_no='+response.data[i].bill_no);
                });
                
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
                    if(empty_bills_today.length == 0 && tab == 1){
                    // $('div .processingTab').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>  Nothing to process. <br> <br> Take Rest for a while.</h3></p></div>');
                     $('.no_bills_today').removeClass('hidden');
                    }
                    if(empty_bills_history.length == 0 && tab == 2){
                    // $('div .processingTab').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>  Nothing to process. <br> <br> Take Rest for a while.</h3></p></div>');
                     $('.no_bills_history').removeClass('hidden');
                    }
                    return false;
                }
            }
        });
        return false;
    }

    // if (window.location.pathname == '/os/vendorBills') {
    //     displayCardBills(0 ,1);
    // }
    
    $('.vendor_bills_tab_1').one('click', function() {
        displayCardBills($(".billCardsCloned1").length, 1);
    });
    $('.vendor_bills_tab_2').one('click', function() {
        displayCardBills(0, 2);
    });
    $('.show_more_bills_today').on('click', function() {
        var offset = $(".billCardsCloned1").length;
        displayCardBills(offset, 1);
    });
    $('.show_more_bills_history').on('click', function() {
        var offset = $(".billCardsCloned2").length;
        displayCardBills(offset, 2);
    });

    //table Edit
  $('table').on('click','.edit_bill_item',function(){ 
    $(this).next().removeAttr('hidden');
    $(this).next().next().removeAttr('hidden');
    $(this).hide();
    $(this).parent().parent().children().eq(2).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(3).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(4).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(5).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
  });//End table Edit

  //table Edit->cancel
  $('table').on('click','.cancel_bill_item',function(){  
    $(this).attr('hidden','true');
    $(this).prev().attr('hidden','true');
    $(this).prev().prev().show();
    $(this).parent().parent().children().eq(2).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(3).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(4).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(5).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
  });//End table Edit->cancel

  //table Update
  $('table').on('click','.update_bill_item',function(){
    var ele           = $(this);
    var id            = $(this).attr('data-id');
    var rate          = $(this).parent().parent().children().eq(2).find('input').val();
    var quantity      = $(this).parent().parent().children().eq(3).find('input').val();
    var apmc_tax      = $(this).parent().parent().children().eq(4).find('input').val();
    var levi_tax      = $(this).parent().parent().children().eq(5).find('input').val();

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
      url: 'api/Manage_vendors/update_bills_item',
      type: 'POST',
      data: {id : id , rate : rate, qty : quantity,apmc_tax : apmc_tax,levi_tax : levi_tax},
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
          ele.parent().parent().children().eq(2).children().find('input').val(rate).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(3).children().find('input').val(quantity).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(4).children().find('input').val(apmc_tax).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(5).children().find('input').val(levi_tax).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
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

  /*-------------------------------Function to Search Vendor Bills (Cards)-----------------------------------------------------------------------------*/

    $("#bill_search").donetyping(function(e) {
      var text = $(this).val();
      if (text.length >= 3) {
          clearTimeout($.data(this, 'timer'));
          var wait = setTimeout(function() {
            $.ajax({
                url: 'api/manage_vendors/vendor_bills_search',
                type: 'POST',
                data: {
                    q: text
                },
                success: function(response) {
                   var response = JSON.parse(JSON.stringify(response));
                   $('.dynamic_search').removeClass('hidden');
                   $('.show_more_bills_history,.show_more_bills_today,.page-content').addClass('hidden');
                   response.data.forEach(function(Index, i) {
                     var date = new Date(response.data[i].bill_date);
                     var d = date.getDate();
                     var m = date.getMonth();
                     m += 1; // JavaScript months are 0-11
                     var y = date.getFullYear();
                     var superScript;
                     if (d == 1 || d == 31) {
                         superScript = 'st';
                     } else if (d == 2 || d == 22) {
                         superScript = 'nd';
                     } else if (d == 3 || d == 23) {
                         superScript = 'rd';
                     } else {
                         superScript = 'th';
                     }
                     var clone = $('.demoCardBills').clone();
                     clone.removeClass('demoCardBills').addClass('billCardsSearch').removeClass('hidden');
                     $('.searchResultCards').append(clone);
                     clone.children().children().eq(0).children().append(response.data[i].bill_no);
                     clone.children().children().eq(1).children().append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                     clone.children().children().eq(2).children().append(response.data[i].vendor_name);
                     clone.children().children().eq(3).children().attr('href','vendorBillsInfo?id='+response.data[i].id+'&bill_no='+response.data[i].bill_no);
                   });
                }, 
                error: function(error) {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: 'No data found !',
                        timeout: 1000
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    return false;
                }
            });
            }, 500);
            $('.searchResultCards').empty();
            $(this).data('timer', wait);
      }
    });

    $('.vendor_bills_tab').on('click', function() {
      $('.card_search').addClass('hidden');
      $('.list_search').removeClass('hidden');
      $('.search_table').removeClass('hidden');
      $('.dynamic_search').addClass('hidden');
      $('.page-content').removeClass('hidden');
      $('.searchResultCards').empty();
    });

    $('.vendor_bills_tab_1').on('click', function() {
      $('.card_search').removeClass('hidden');
      $('.list_search').addClass('hidden');
      $('.search_table').addClass('hidden');
      $('.dynamic_search').addClass('hidden');
      $('.page-content').removeClass('hidden');
      $('.searchResultTable').empty();
    });

    $('.vendor_bills_tab_2').on('click', function() {
      $('.card_search').removeClass('hidden');
      $('.list_search').addClass('hidden');
      $('.search_table').addClass('hidden'); 
      $('.dynamic_search').addClass('hidden');
      $('.page-content').removeClass('hidden');
      $('.searchResultTable').empty();
    });

    $('#dynamic_div_close').on('click',function(){
      $('.dynamic_search').addClass('hidden');
      $('.page-content,.show_more').removeClass('hidden');
      $('.searchResultTable').empty();
    });

}); ///Documents ends here