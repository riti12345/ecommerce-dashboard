$(document).ready(function(){

var processing = [];
var dispatch = [];
var history =[];
var deliveryTeam = [];
var assignee_id;
var today = new Date();
var day = today.getDate();
var month = today.getMonth()+1;
if(month <= 9 ){month = '0'+month}
if(day <= 9 ){day = '0'+day}
var year = today.getFullYear();
var aaj = year+'-'+month+'-'+day;

/*===================================Function to View dispatch details==========================================================*/
 //load (auto) upcomming cards
  if(window.location.pathname == '/os/dispatch'){
    displayCard(0,1);
  }
  //load (on click) dispatched cards
  $('.tab_1').one('click', function(){ displayCard($(".dispatchCardCloned1").length,1); });
  $('.tab_2').one('click', function(){ displayCard(0,2); });
  //load (on click) history cards
  $('.tab_3').one('click', function(){ displayCard(0,3); });
  $('.show_more_upcomming').on('click',function(){
    var offset = $(".dispatchCardCloned1").length;
    displayCard(offset,1);
  });

  $('.show_more_dispatched').on('click',function(){
    var offset = $(".dispatchCardCloned2").length;
    displayCard(offset,2);
  });

  $('.show_more_hist').on('click',function(){
    var offset = $(".dispatchCardCloned3").length;
    displayCard(offset,3);
  });

    function displayCard(offset,tab){
      $.ajax({
              url: 'api/Manage_dispatch/load_disp_cards',
              type: 'POST',
              data: {
              offset : offset,
              tab    : tab,
          },  
        success: function(response){
          var response = JSON.parse(JSON.stringify(response));
          var dispatched   = response.data;
          // card display
          dispatched.forEach(function(Index, i) {
            var date = new Date(dispatched[i].delivery_date);
            var d = date.getDate();
            var m =  date.getMonth();
            m += 1;  // JavaScript months are 0-11
            var y = date.getFullYear();
              if(d == 1 || d==31){superScript = 'st';}else if(d==2 || d ==22){superScript ='nd';}else if(d==3 || d==23){superScript ='rd';}else{superScript = 'th';}

              var clone=$(".demoCardUpcomming").clone();
              if(tab == 1){
                 clone.removeClass('demoCardUpcomming').addClass('dispatchCardCloned1').removeClass('hidden');
              }
              if(tab == 2){
                 clone.removeClass('demoCardUpcomming').addClass('dispatchCardCloned2').removeClass('hidden');
              }
              if(tab == 3){
                 clone.removeClass('demoCardUpcomming').addClass('dispatchCardCloned3').removeClass('hidden');
              }

              clone.children().children().eq(0).children().append(dispatched[i].client.name);

              if(dispatched[i].status!=0){
                clone.children().children().eq(0).children().eq(1).attr('data-order',dispatched[i].order_id);
                clone.children().children().eq(1).children().eq(0).append('<span>Assigned To : ' + dispatched[i].assign_to_name +'</span>');
                clone.children().children().eq(2).children().append('<span> Phone : ' + dispatched[i].assign_to_phone+'</span>');
              }
              clone.children().children().eq(3).children().children().eq(0).append(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
              clone.children().children().eq(3).children().children().eq(1).append(dispatched[i].order_id);//css({"border":"1px solid green"})
              clone.children().children().eq(3).children().children().eq(2).append(dispatched[i].track_id);
              clone.children().children().eq(4).children().eq(0).attr('href','dispatchInfo?id='+dispatched[i].id+'').attr('id','dispInfoTool'+i);
              clone.children().children().eq(4).children().eq(0).children().eq(1).attr('for','dispInfoTool'+i);
              clone.children().children().eq(4).children().eq(1).attr('data-id',dispatched[i].track_id).attr('order-id',dispatched[i].order_id).attr('id','disPrintTool'+i);
              clone.children().children().eq(4).children().eq(1).children().eq(1).attr('for','disPrintTool'+i);
              // if(dispatched[i].status < 2){
              if(dispatched[i].status < 1){
                clone.children().children().eq(4).children().eq(1).attr('disabled','true').css({"color":"#B2DFDB"});
              }
              clone.children().children().eq(4).children().eq(2).append(dispatch_status[dispatched[i].status]);
            
              if(dispatched[i].delivery_date >= aaj && dispatched[i].status == 0){
                 $('.disp_null').addClass('hidden');
                 $('.show_more_upcomming').removeClass('hidden');
                 processing.push(dispatched[i]);
                 $('div .dispUpcomming').append(clone);
                 //$('.dispatch_sku'+i+'').val(myvar['sku']);
                 //$('#dispatch_units'+i+'').val($('#dispatch_units'+i+'').parent().prev().prev().html());
              }
              if(dispatched[i].delivery_date == aaj && dispatched[i].status >=1 ){
                $('.disp_disp_none').addClass('hidden');
                $('.show_more_dispatched').removeClass('hidden');
                 dispatch.push(dispatched[i]);
                 $('div .dispDispatched').append(clone);
              }
              if(dispatched[i].delivery_date < aaj ){
                 $('.disp_hist_none').addClass('hidden');
                 $('.show_more_hist').removeClass('hidden');
                 history.push(dispatched[i]);
                 $('div .dispHistory').append(clone);
                 $('.cancel_btn').hide();                
               }
           
              // List view/ table view 
              var tRowClone = $('.dispatchTrowEmpty').clone();
              tRowClone.removeClass('dispatchTrowEmpty').addClass('dispatchTrowCloned').removeClass('hidden');

              tRowClone.children().eq(0).children().attr('href','dispatchInfo?id='+dispatched[i].id+'').attr('id','dispInfoTool'+i);
              tRowClone.children().eq(0).children().children().eq(1).attr('for','dispInfoTool'+i);
              tRowClone.children().eq(1).append(dispatched[i].order_id);
              tRowClone.children().eq(2).append(dispatched[i].client.name);
              tRowClone.children().eq(3).append(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
              tRowClone.children().eq(4).append(dispatched[i].track_id);
              if(dispatched[i].status!=0){
                tRowClone.children().eq(5).append(dispatched[i].assign_to_name);
                tRowClone.children().eq(6).append(dispatched[i].assign_to_phone);
              }
              
              if(dispatched[i].delivery_date >= aaj && dispatched[i].status == 0){
                 $('.dispatch_upTbody').append(tRowClone);
              }
              else if(dispatched[i].delivery_date == aaj && dispatched[i].status >=1){
                $('.dispatchedTbody').append(tRowClone);
              }
              if(dispatched[i].delivery_date < aaj){
                 $('.dispatch_histTbody').append(tRowClone);
              }

              if(document.getElementById('view_card_search')){
                 //$('div .searchResultCard').append(clone);
                 $('.dispatchTableEmpty').parent().addClass('hidden');
              }else if(document.getElementById('view_list_search')){
                  //$('div .searchResultList').append(tRowClone);
                  $('.dispatchCardCloned1 ,.dispatchCardCloned2 ,.dispatchCardCloned3,.demoCardUpcomming ').addClass('hidden');
              }
             
            // }        
          });//End View Item Cards    
                  // }, 1000);
              },
              error: function (xhr, status, error) {
                  // var error = JSON.parse(error.status);
                  // var err = eval("(" + xhr.responseText + ")");
                  if(xhr.status == 404){
                     var error_msg = xhr.responseJSON.error;
                     'use strict';
                     var snackbarContainer = document.querySelector('#demo-toast-example');
                     var data = {message: 'No Data Found!! ',timeout:1000};
                     setTimeout(function(){
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                     },1000);
                      if(tab == 1 && processing.length == 0){
                        // $('div .dispUpcomming').append(
                        //     '<div class="mdl-card-status mdl-shadow--2dp">'+
                        //       '<p><i class="material-icons status_icon">error</i><p>'+
                        //       '<p><h3> Nothing to Dispatch ! <br> <br> Take Rest for a while.</h3></p>'+
                        //     '</div>');
                        $('.disp_null').removeClass('hidden');
                        $('.show_more_upcomming').addClass('hidden');
                        $('.upcomming_view').hide();
                        }

                      if(tab == 2 && dispatch.length == 0){
                      //   $('div .dispDispatched').html(
                      //       '<div class="mdl-card-status mdl-shadow--2dp">'+
                      //         '<p><i class="material-icons status_icon_done">done_all</i><p>'+
                      //         '<p><h3> Hurray !!  <br> <br> Dispatch completed !</h3></p>'+
                      //       '</div>');
                      $('.disp_disp_none').removeClass('hidden');
                      $('.show_more_dispatched').addClass('hidden');
                        $('.dispDispatched_view').hide();
                      }
                      if(tab == 3 && history.length == 0){
                      //   $('div .dispHistory').html(
                      //       '<div class="mdl-card-status mdl-shadow--2dp">'+
                      //         '<p><i class="material-icons status_icon">history</i><p>'+
                      //         '<p><h3> Dispatch history none !!  <br> <br> Dispatch an order to create some.</h3></p>'+
                      //       '</div>');
                      $('.disp_hist_none').removeClass('hidden');
                      $('.show_more_hist').addClass('hidden');
                        $('.dispHistory_view').hide();
                      }
                     return false;
                  }
        }
      });
    }

     //Append list view and grid view 
      $('.list_view').click(function(){
        $('.grid_view , .print_view').removeClass('hidden');
        $('.list_view').addClass('hidden');
         $('.dispatchTableEmpty').parent().removeClass('hidden');
         $('div .searchResultList').removeClass('hidden');
         $('div .searchResultCard').addClass('hidden');
         if($('.tab_1')){$('.dispatchCardCloned1').addClass('hidden');}
         if($('.tab_2')){$('.dispatchCardCloned2').addClass('hidden');}
         if($('.tab_3')){$('.dispatchCardCloned3').addClass('hidden');}
        $('.dispatchCardCloned1 ,.dispatchCardCloned2 ,.dispatchCardCloned3,.demoCardUpcomming ').attr('id','');
        $('.dispatch_upTbody ,.dispatchedTbody ,.dispatch_histTbody').attr('id','view_list_search');
      });

      $('.grid_view').click(function(){ 
          $('.grid_view , .print_view').addClass('hidden');
          $('.list_view').removeClass('hidden');
          $('.dispatchCardCloned1 ,.dispatchCardCloned2 ,.dispatchCardCloned3 ').attr('id','view_card_search');
          $('.dispatch_upTbody ,.dispatchedTbody ,.dispatch_histTbody').attr('id','');
          $('div .searchResultList').addClass('hidden');
          $('div .searchResultCard').removeClass('hidden');
          if($('.tab_1')){$('.dispatchCardCloned1').removeClass('hidden');}
          if($('.tab_2')){$('.dispatchCardCloned2').removeClass('hidden');}
          if($('.tab_3')){$('.dispatchCardCloned3').removeClass('hidden');}
          $('.dispatchTableEmpty').parent().addClass('hidden');
          // $('.dispatchTrowCloned').remove();
      });

    // search card by name and order id
    $("#searchDispatch").donetyping(function(){
      var text = $(this).val();
      if(text.length>0){
        clearTimeout($.data(this, 'timer'));
        var wait =setTimeout(function(){
          $.ajax({
                url: 'api/Manage_dispatch/search',
                type: 'POST',
                data: {q   : text },
                success: function(response){
                    var response = JSON.parse(JSON.stringify(response));
                    var dispatched   = response.data;
                    $('.dynamic_search').removeClass('hidden');
                    $('.mdl-layout__tab-bar ,.show_more_upcomming ,.show_more_dispatched , .show_more_hist ,.page-content').addClass('hidden');
                  dispatched.forEach(function(Index, i) {
                    var date = new Date(dispatched[i].delivery_date);
                    var d = date.getDate();
                    var m =  date.getMonth();
                    m += 1;  // JavaScript months are 0-11
                    var y = date.getFullYear();
                    if(d == 1 || d==31){superScript = 'st';}else if(d==2 || d ==22){superScript ='nd';}else if(d==3 || d==23){superScript ='rd';}else{superScript = 'th';}

                    // if(!(dispatched[i].order_status == 3)){
                    //console.log(allDispatch);
                    var clone=$(".demoCardUpcomming").clone();
                    clone.removeClass('demoCardUpcomming').removeClass('hidden');
                    $('div .searchResultCard').append(clone);
                    clone.children().children().eq(0).children().append(dispatched[i].client.name);

                    if(dispatched[i].status!=0){
                      clone.children().children().eq(0).children().eq(1).attr('data-order',dispatched[i].order_id);
                      clone.children().children().eq(1).children().eq(0).append('<span>Assigned To : ' + dispatched[i].assign_to_name +'</span>');
                      clone.children().children().eq(2).children().append('<span> Phone : ' + dispatched[i].assign_to_phone+'</span>');
                    }
                    clone.children().children().eq(3).children().children().eq(0).append(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
                    clone.children().children().eq(3).children().children().eq(1).append(dispatched[i].order_id);//css({"border":"1px solid green"})
                    clone.children().children().eq(3).children().children().eq(2).append(dispatched[i].track_id);
                    clone.children().children().eq(4).children().eq(0).attr('href','dispatchInfo?id='+dispatched[i].id+'').attr('id','dispInfoTool'+i);
                    clone.children().children().eq(4).children().eq(0).children().eq(1).attr('for','dispInfoTool'+i);
                    clone.children().children().eq(4).children().eq(1).attr('data-id',dispatched[i].track_id).attr('order-id',dispatched[i].order_id).attr('id','disPrintTool'+i);
                    clone.children().children().eq(4).children().eq(1).children().eq(1).attr('for','disPrintTool'+i);
                    // if(dispatched[i].status < 2){

                    // List view/ table view 
                    var tRowClone = $('.dispatchTrowEmpty').clone();
                    tRowClone.removeClass('dispatchTrowEmpty').addClass('dispatchTrowCloned').removeClass('hidden');
                    $('div .searchResultList').append(tRowClone);
                    tRowClone.children().eq(0).children().attr('href','dispatchInfo?id='+dispatched[i].id+'').attr('id','dispInfoTool'+i);
                    tRowClone.children().eq(0).children().children().eq(1).attr('for','dispInfoTool'+i);
                    tRowClone.children().eq(1).append(dispatched[i].order_id);
                    tRowClone.children().eq(2).append(dispatched[i].client.name);
                    tRowClone.children().eq(3).append(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
                    tRowClone.children().eq(4).append(dispatched[i].track_id);
                    
                    if(document.getElementById('view_card_search')){
                    }else if(document.getElementById('view_list_search')){
                    }
                    if(dispatched[i].status!=0){
                      tRowClone.children().eq(5).append(dispatched[i].assign_to_name);
                      tRowClone.children().eq(6).append(dispatched[i].assign_to_phone);
                    }
                      if(dispatched[i].status < 1){
                        clone.children().children().eq(4).children().eq(1).attr('disabled','true').css({"color":"#B2DFDB"});
                      }
                      clone.children().children().eq(4).children().eq(2).append(dispatch_status[dispatched[i].status]);
                  
                      if(dispatched[i].delivery_date >= aaj && dispatched[i].status == 0){
                       $('.disp_null').addClass('hidden');
                       $('.show_more_upcomming').removeClass('hidden');
                       //$('.dispatch_sku'+i+'').val(myvar['sku']);
                       //$('#dispatch_units'+i+'').val($('#dispatch_units'+i+'').parent().prev().prev().html());
                      }
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
        $('.searchResultCard , .searchResultList').empty();
        $(this).data('timer', wait);
      }

    });
    $('#dynamic_div_close').on('click',function(){
      $('.dynamic_search').addClass('hidden');
      $('.page-content ,.mdl-layout__tab-bar ,.show_more_upcomming ,.show_more_dispatched , .show_more_hist ').removeClass('hidden');
      $('.searchResultCard , .searchResultList').empty();
    });
    // search item details in dispatch info row
    $("#dispatch-info-search").on('keyup',function(){
      var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
      var card = $(".dispatch-info-row");
      var cardCloned = $('.dispatch-info-row-cloned');
      var input;

      //create dispatch
      $.each(card,function(index,data){
          input = $.trim($(this).children().text()).toLowerCase().replace(/ +/g, '');
          (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
        });

      // confirm dispatch
      $.each(cardCloned,function(index,data){
          input = $.trim($(this).children().text()).toLowerCase().replace(/ +/g, '');
          (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
        });
    });

  // create dispatch button
  $('.createDispatch').on('click',function(){
    var row = $('.dispatch-info-row');
    var isValid = true;
      row.each(function() {
          if ($.trim($(this).children().eq(6).children().children().val()) == '') {
              isValid = false;
              $(this).children().eq(6).children().children().css({"border-bottom": "2px solid #ff4646","background": "#fff"});
          } else {
              //$(this).children().eq(6).children().children().css({"border-bottom": "2px solid #299035","background": ""});
              setTimeout($.proxy(function(){
              $(this).css({"border": "","background": ""});},this),2500);               
          }
      });
      if (isValid == true) {
        $('.dispatch-table-details').empty();
        var table = $('.dispatch_table').clone();
        table.removeClass('dispatch_table').addClass('dispatch_table_cloned');
        $('.dispatch-table-details').append(table);
        $(this).attr('disabled',true);
        table.children('tbody').children('tr').removeClass('dispatch-info-row').addClass('dispatch-info-row-cloned');
        var dispatch_row = table.children('tbody').children('tr');
        dispatch_row.each(function(){
          $(this).children('td').eq(5).children().addClass('dispatch_sku');
        });
        $('.confirmDispatchScreen').removeClass('hidden');
        $('.dispatchScreen').addClass('hidden');
        $('.breadcrumb >a:nth-child(2)').addClass('active');

        var rowCloned = $('.dispatch_table_cloned').children('tbody').children('tr');
        rowCloned.each(function() {
           $(this).children().eq(6).children().children().addClass('mdl-textfield__input_border');
           $(this).children().eq(6).children().children().prop( "disabled", true );
        });
      }else{
          'use strict';
          var snackbarContainer = document.querySelector('#demo-toast-example');
          var data = {message: 'please fill number of units !',timeout:1000};
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
          return false;
      }
      
  });
  $('.confirm_dispatch_btn').on('click',function(){
    swal({ title: "Are you sure ?",   
            text: "You will lost all data!",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: true, 
            animation: "slide-from-top",  
            showLoaderOnConfirm: false, }, 
            function(){
                $('.confirmDispatchScreen').addClass('hidden');
                $('.dispatchScreen').removeClass('hidden');
                $('.breadcrumb >a:nth-child(2)').removeClass('active');
                $('.createDispatch').attr('disabled',false);
                 var row = $('.dispatch-info-row');
                 row.each(function() {
                  $(this).children().eq(6).children().children().val('');
                });
                $('.dispatch_table_cloned').remove();
        });
   
  });

/*====================================Function for Dispatch Send===============================================================*/
  $("body").delegate("#send_dispatch", "click", function(){
    var indi = $(this).attr('data-index');
    var order_id = $(this).attr('data-order');
    var orders_items_id = new Array(); var dispatch_sku = new Array(); 
    var dispatch_price = new Array();  // var dataSku = [];//  alert(order_id);
    var dispatch_units = new Array(); var item_id = new Array(); 
    var track_id = new Array();  var t = 0;
    var formData = new FormData;
      
    $.each($('.dispatch_sku'), function(){
      orders_items_id[t] = $(this).attr("data-item-id");
      track_id[t] = $(this).attr("data-id");
      item_id[t] = $(this).attr("data-item");
      dispatch_sku[t] = $(this).val();
      dispatch_units[t] = $(this).parent('td').next().children().find('input').val();
      console.log(dispatch_units[t]);
      // dispatch_price[t] = $(this).parent().next().next().html();
      formData.append('orders_items_id[]', orders_items_id[t]);
      formData.append('track_id[]', track_id[t]);
      formData.append('item_id[]', item_id[t]);
      formData.append('dispatch_sku[]',   dispatch_sku[t]);
      formData.append('dispatch_units[]', dispatch_units[t]);
      // formData.append('dispatch_price[]', dispatch_price[t]);
      t++;
    });
    formData.append('order_id', order_id);
      swal({ 
          title: "Are you sure ?",   
          text: "You want to Dispatch this order!",   
          type: "info",   
          showCancelButton: true,   
          closeOnConfirm: true, 
          animation: "slide-from-top",  
          showLoaderOnConfirm: false, }, 
          function(){
            $.ajax({
                url: 'api/Manage_dispatch/dispatch',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                  $('.createDispatch').attr('disabled',true);
                  $('#send_dispatch').attr('disabled',true);
                },
                
                success: function(response){
                  $('.confirmDispatchScreen').addClass('hidden');
                  $('.assignScreen').removeClass('hidden');
                  $('.breadcrumb >a:nth-child(3)').addClass('active');
                  //$(this).attr('disabled','true'); 

                  // Append Assignee card 
                    $.get("api/manage-team/team/delivery", function(data){
                      deliveryTeam =JSON.parse(JSON.stringify(data)).data;
                      for(var i=0; i<deliveryTeam.length; i++){
                        var card = $('.dispatch_delivery_boy_card').clone();
                        card.removeClass('dispatch_delivery_boy_card').addClass('dispatch_delivery_boy_cloned' ).removeClass('hidden');
                        card.attr('data-value',deliveryTeam[i].username);
                        card.attr('data-team-id',deliveryTeam[i].id);
                        $('.dispatch_delivery_boy').append(card);   
                          $.each(card,function(){
                             $(this).children().children().eq(0).children().append(deliveryTeam[i].username);
                          });
                      }
                      
                     
                    });
                 },
                error: function (error) {
                  //sweetAlert("Oops...", "Something went wrong!", "error");
                  var error_msg = JSON.stringify(error.responseJSON.errors);
                  sweetAlert('Oops... ',error_msg,"error");
                }
            });
      });
      
  });

/*====================================Function To Print DM=====================================================================*/
    $("body").delegate(".print_dm", "click", function() {
      var id = $(this).attr('data-id');
      var order_id = $(this).attr('order-id');
      $('.dispatch_content').empty();
      $.ajax({
        url: 'api/dm',
        type: 'POST',
        data: {id: id,order_id:order_id},
        success: function(response) {
                 // var win=window.open('about:blank');
                 // win.document.write(response);
                 $('.dispatch_content').append(response);
                 var dialog = document.querySelector('dialog');
                 dialog.showModal();
                 $('#dialog-close').click(function() {
                   dialog.close();
                 });
        }
      });
    });
    
    //Dispatch Report
    $('#dm_type').on('change',function(){
      if($(this).val() == 1){
        $('#dm_submit').addClass('print_dispatch_summary');
        $('div .client').addClass('hidden');
        $('div .client_type').removeClass('hidden');
        $('#dm_submit').removeClass('print_dm_bulk');
      }
      if($(this).val() == 2){
        $('#dm_submit').addClass('print_dm_bulk');
        $('div .client').removeClass('hidden');
        $('#dm_submit').removeClass('print_dispatch_summary');
        $('div .client_type').addClass('hidden');
      }
    });

    // client autofill 
	  $('body').delegate('#searchClient','input',function(e) {
	  	var $selector =$(this).next().next().next().children(), // ul element
          text = $(this).val(),
          json = [],
          clientCode = '';
          if(text.length>=3){
	          $selector.parent().removeClass('hidden');
	          $.ajax({
                  url: 'api/manage-clients/search',
                  type: 'POST',
                  data: {q   : text ,type:1},
                  success: function(response){
                      var response = JSON.parse(JSON.stringify(response));
                      for(var i=0; i<response.data.length; i++){
                      	json.push(response.data[i].name);
                      	if(json[i] != null){
                        		clientCode += '<li class="" value="'+json[i]+'" id="'+response.data[i].id+'">' +json[i]+ '</li>';
                        	}
                      } 
                      $selector.html(clientCode);
                      $selector.children().eq(0).addClass('selected');
                      $selector.children().on('mousedown', function(e) {
                        e.preventDefault();
                      }).on('click',function(){
                        var name = $(this).attr('value');
                        $(this).parent().parent().prev().prev().prev().attr('data-id',$('.selected').attr('id')).attr('value',$('.selected').attr('value'));
                        $(this).parent().parent().prev().prev().removeClass('hidden');
                        $(this).parent().parent().prev().prev().children().eq(0).html($('.selected').attr('value'));
                        $(this).parent().parent().prev().prev().prev().addClass('hidden');
                        $(this).parent().parent().addClass('hidden');
                        $(this).parent().empty();
                        $(this).removeClass('selected');
                      });

                      $('body').click(function(){
                        $selector.parent().addClass('hidden');
                      });

                      $selector.children().on('mouseover',function() {
                        $selector.children().removeClass('selected');
                        $(this).addClass('selected');
                        //console.log($('.selected').text());
                      });
                      //$('.searchResult').empty();
                    },
                    error:function (xhr, status, error) {
                    }
            });
      	}else{
	  		$selector.parent().addClass('hidden');
	  		return false;
	  	  }
    });

  /*====================================Function To Print Dispatch Summary====================================*/
    $("body").delegate(".print_dispatch_summary", "click", function() {
      // var id = $(this).attr('data-id');
      $('.dispatch_content').empty();
        var start_date = $('#datepicker1').val();
        var end_date   = $('#datepicker2').val();
        var client_category = $('#client_type').val();	
          $.ajax({
            url: 'api/Manage_dispatch/dispatch_summary',
            type: 'POST',
            data: {
			    			    start_date : start_date,
			    			    end_date   : end_date,
                    client_category:client_category 
            },
            success: function(response) {
                     var win=window.open('about:blank');
                     win.document.write(response);
                     // $('.dispatch_content').append(response);
                     // var dialog = document.querySelector('dialog');
                     // dialog.showModal();
                     // $('#dialog-close').click(function() {
                     //   dialog.close();
                     // });
            }
          });
    });

/*====================================Function To Print DM IN BULK====================================*/
    $("body").delegate(".print_dm_bulk", "click", function() {
      // var id = $(this).attr('data-id');
      $('.dispatch_content').empty();
        var client_id  = $('#searchClient').attr('data-id');
        var start_date = $('#datepicker1').val();
        var end_date   = $('#datepicker2').val();	
          $.ajax({
            url: 'api/dm_bulk',
            type: 'POST',
            data: {
                    client_id  : client_id ,
			    			    start_date : start_date,
			    			    end_date   : end_date 
            },
            success: function(response) {
                     var win=window.open('about:blank');
                     win.document.write(response);
                     // $('.dispatch_content').append(response);
                     // var dialog = document.querySelector('dialog');
                     // dialog.showModal();
                     // $('#dialog-close').click(function() {
                     //   dialog.close();
                     // });
            }
          });
    });

/*====================================Function To Print Dispatch Report=====================================================================*/
    $("body").delegate("#dr_print", "click", function() {
      
      var id = $(this).attr('data-id');
      $('.dispatch_content').empty();
      $.ajax({
        url: 'api/dr',
        type: 'POST',
        data: {
                id  : id ,
              },
        success: function(response) {   
                 // var win=window.open('about:blank');
                 // win.document.write(response);
                 $('.dispatch_content').append(response);
                 var dialog = document.querySelector('dialog');
                 dialog.showModal();
                 $('#dialog-close').click(function() {
                   dialog.close();
                 });
        }
      });
    });
/*===================================Function For Choosing Assignee============================================================*/
 
  // Assignee back button
  $('.assignee_back_btn').on('click',function(){
    $('.selectedAssigneeScreen').addClass('hidden');
    $('.assignScreen').removeClass('hidden');
    $('.selected_assignee_trow_cloned').remove();
    $('.selected_assignee_trow_cloned').empty();
    $('#Assign').attr('data_value','').attr('data-id','');
  });

  // Delivery boy history table
  $("body").delegate(".dispatch_delivery_boy_cloned", "click", function(){
    var assign_to ;
    var order_id =  $(this).attr("data-order-id"); ;
    var boy = $(this).attr('data-value');
    assign_to = $(this).attr('data-team-id');
    var dispatched_order =[];
    
    $('.selectedAssigneeScreen').removeClass('hidden');
    $('.assignScreen').addClass('hidden');
    $('#Assign').attr('data_value',boy).attr('data-data-id',assign_to);
    $('.Assignee_name').html(boy);

    $.get("api/manage_delivery/delivery_boys_history", function(data){
          deliveryTeam =JSON.parse(JSON.stringify(data));
          for(var i=0; i<deliveryTeam.data.length; i++){
              var date = new Date(deliveryTeam.data[i].delivery_date);
              var d = date.getDate();
              var m =  date.getMonth();
              m += 1;  // JavaScript months are 0-11
              var y = date.getFullYear();
              var superScript;
              if(d == 1 || d==31){superScript = 'st';}else if(d==2 || d ==22){superScript ='nd';}else if(d==3 || d==23){superScript ='rd';}else{superScript = 'th';}
              
              var row = $('.selected_assignee_trow').clone();
              row.removeClass('selected_assignee_trow').addClass('selected_assignee_trow_cloned').removeClass('hidden');
              if(deliveryTeam.data[i].assign_to == assign_to){
                $.each(row,function(data){
                  $(this).children().eq(1).html(deliveryTeam.data[i].order_id);
                  $(this).children().eq(2).html(deliveryTeam.data[i].client_name);
                  $(this).children().eq(3).html(deliveryTeam.data[i].delivery_address);
                  $(this).children().eq(4).html(status_array[deliveryTeam.data[i].status]);
                  $(this).children().eq(5).html(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
                  $('#Assign').attr('data_value',deliveryTeam.data[i].assign_to_name).attr('data-id',deliveryTeam.data[i].assign_to);
                  $('.Assignee_name').html(deliveryTeam.data[i].assign_to_name);
                  $('.selected_assignee_thead').removeClass('hidden');
                });

                  if((deliveryTeam.data[i].status ==1) && (deliveryTeam.data[i].delivery_date == aaj)){
                    $('.selected_assignee_tbody').append(row);
                    dispatched_order.push(deliveryTeam.data[i]);
                  }
              }else{
                $('#Assign').attr('data_value',boy).attr('data-id',assign_to);
                $('.Assignee_name').html(boy);
                //$('.selected_assignee_thead').addClass('hidden');
              }
          }
         
        });                
   
  });//End Assign-To Function

  $("#Assign").on("click",function(){
    var order_id =  $(this).attr("data-order"); ;
    var boy = $(this).attr('data_value');
    assign_to = $(this).attr('data-id');

    var formData = new FormData;
    formData.append('assign_to', assign_to);
    formData.append('order_id', order_id);
 
    swal({   
        title: "Do you want to Assign this order to "+boy+"?",   
        text: "Click OK and Confirm!",   
        type: "info",   
        showCancelButton: true,   
        closeOnConfirm: false, 
        animation: "slide-from-top",  
        showLoaderOnConfirm: true, },
        function(){
          $.ajax({
              url: 'api/Manage_delivery/assignee_update',
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success:function(response){
                      $('.assignScreen').addClass('hidden');
                      $('.breadcrumb >a:nth-child(4)').addClass('active');
                        setTimeout(function(){
                          swal('Order '+order_id+' assigned to  '+boy);
                           window.location.href = "dispatch"; 
                        }, 1500);
              },
              error:function (error) {
                    var error_msg = JSON.stringify(error.responseJSON.errors);
                    sweetAlert('Oops... ',error_msg,"error");
              }
          });
    });
  });
/*===================================Function For Choose and update Assignee============================================================*/

  $.get("api/manage-team/team/delivery", function(data){
    deliveryTeam =JSON.parse(JSON.stringify(data)).data;
    var li='';
    for(var i=0; i<deliveryTeam.length; i++){

       li +="<li class='mdl-menu__item update_assignee' value="+deliveryTeam[i].id+">"+deliveryTeam[i].username+"</li>";
    }
    $('.dispBtn ul').append(li);
  });

  $('body').delegate('.update_assignee','click',function(){
    var assign_to = $(this).attr('value');
    var boy = $(this).text();
    var order_id = $(this).parent().attr('data-order-id');
    var element = $(this);
    var formData = new FormData;
    formData.append('assign_to', assign_to);
    formData.append('order_id', order_id);
 
    swal({   
        title: "Do you want to Assign this order to "+boy+"?",   
        text: "click ok and confirm!",   
        type: "info",   
        showCancelButton: true,   
        closeOnConfirm: false, 
        animation: "slide-from-top",  
        showLoaderOnConfirm:true, },
        function(){
          $.ajax({
              url: 'api/Manage_delivery/assignee_update',
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response){
                      swal('Order '+order_id+' :is assigned to -'+boy);
                      element.parent().parent().parent().parent().children().eq(2).children().eq(0).html('<b>Assignee : </b>'+boy);
              },
              error: function (error) {
              // sweetAlert("Oops...", "Something went wrong!", "error");
              var error_msg = JSON.stringify(error.responseJSON.errors);
              sweetAlert('Oops... ',error_msg,"error");
              }
          });
    });
  });


});//Document Ends Here