$(document).ready(function(){
  $("#vehicleForm").submit(function(e){
      var isValid = true;
      $('#reg_no,#owner_name,#licence_no,#contact,#vehicle_brand,#vehicle_model').each(function(){
        if ($.trim($(this).val()) == '') {
            isValid = false;
            $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
        }else{
            $(this).css({"border-bottom": "2px solid #299035","background": ""});
            setTimeout($.proxy(function(){
            $(this).css({"border": "","background": ""});},this),2000);   
        }
      });
      var reg_no        = $("#reg_no").val();
      var owner_name    = $("#owner_name").val();
      var licence_no    = $("#licence_no").val();
      var contact       = $("#contact").val();
      var vehicle_brand = $("#vehicle_brand").val();
      var vehicle_model = $("#vehicle_model").val();
      // console.log(reg_no,owner_name,licence_no,contact,vehicle_brand,vehicle_model);return false;
      if(isValid == true){
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
                  url: 'api/manage_delivery/transport_add',
                  type: 'POST',
                  data:{ 
                        reg_no        : reg_no        , 
                        owner_name    : owner_name    , 
                        licence_no    : licence_no    ,
                        contact       : contact       , 
                        vehicle_brand : vehicle_brand , 
                        vehicle_model : vehicle_model 
                       },
                  success: function(response){
                    setTimeout(function(){
                      swal("Successfully Added Vehicle!");
                      window.location.href = 'viewVehicle';
                    }, 1000);
                    },
                    error: function (error) {
                      var error_msg = JSON.stringify(error.responseJSON.errors);
                      sweetAlert('Oops... ',error_msg,"error");
                      return false;
                 }
              });
        });
      }else{
            swal({ title: "please fill all input !", timer: 1000, showConfirmButton: false });
            return false;
      }  
       e.preventDefault();
    });

/*-------------------------------Function to View Transport Cards-----------------------------------------------------------------------------*/
    function displayCard(offset){
       $.ajax({
               url: 'api/manage_delivery/transport/offset/'+offset +'/limit/'+8,
               type: 'GET',                  
               beforeSend: function () {
                 $('#p2').fadeIn();
               },
               complete: function () {
                 $('#p2').fadeOut();
               },  
               success: function(response){
               var response = JSON.parse(JSON.stringify(response));
               console.log(response);
               var Vehicles   = response.data;
               
               // setTimeout(function(){
               // card display
               Vehicles.forEach(function(Index, i) {
                 var clone=$(".demoCardEmpty").clone(); 
                 clone.removeClass('demoCardEmpty');
                 clone.addClass('demoCardCloned');
                 clone.removeClass('hidden');
                 $('div .vehicle').append(clone);
                
                 clone.children().children().eq(0).children().append(Vehicles[i].owner_name);
                 clone.children().children().eq(1).children().eq(1).append(Vehicles[i].vehicle_brand);
                 clone.children().children().eq(2).children().eq(1).append(Vehicles[i].vehicle_model);
                 clone.children().children().eq(3).children().eq(1).append(Vehicles[i].contact);
                 clone.children().children().eq(4).children().eq(0).attr('href','vehicleInfo?vehicle_id='+Vehicles[i].id);
                
               });//End View Transport Cards    
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
    if(window.location.pathname == '/os/viewVehicle'){
       displayCard(0);
    }
    $(".show_more").on('click',function(){
        var offset = $(".demoCardCloned").length;
        displayCard(offset);  
    });
    
    /*-------------------------------Start of Vehicle Info page-----------------------------------------------------------------------------*/
    
    /*------Toggle  button----*/
    $('#vehicle_status').click( function (){
      if ($(this).attr('data-disabled')=='disabled'){
        return false;  
      }
    });
    /*------Toggle  button----*/

  /*------------------------------Function to Edit Vehicle Info---------------------------------------------------------------------------------------*/
  $('#vehicle_edit').click(function(){
    $(this).hide();
    $('span.info_icon').addClass('info_icon_1').removeClass('info_icon');
    $('.showme').fadeIn().removeClass('hidden');
    $('.tog_disable').removeAttr('disabled');
    $('#vehicle_status').removeAttr('data-disabled');
    $('.hideme').hide();
   
  });
/*------------------------------Function to Cancel Vehicle Info---------------------------------------------------------------------------------------*/
  $('#vehicle_cancel').click(function(){
    $('span.info_icon_1').removeClass('info_icon_1').addClass('info_icon');
    $('#vehicle_edit').show();
    $('#vehicle_form').trigger("reset");
    $('.showme').fadeOut().addClass('hidden');
    $('.tog_disable').attr('disabled','true');
    $('#vehicle_status').attr('data-disabled','disabled');
    $('.hideme').show();
  
});

/*==============================Function to Update the Details of Vehicle=======================================================*/ 
$("#vehicle_save").click(function(){
 
  if ($("#vehicle_status:checked").val() && $("#vehicle_status:checked").val()=='yes') {var status = 1;}else{var status=0;} 
 
     var isValid = true;
     var id             =   $(this).attr("data-id");
     var reg_no         =   $("#reg_no").val();
     var owner_name     =   $("#owner_name").val();
     var licence_no     =   $("#licence_no").val();
     var contact        =   $("#contact").val();
     var vehicle_brand  =   $("#vehicle_brand").val();
     var vehicle_model  =   $("#vehicle_model").val();
       
      $("#reg_no,#owner_name,#licence_no,#vehicle_brand,#vehicle_model").each(function() {
          if ($.trim($(this).val()) == '') {
              isValid = false;
              $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
          } else {
              $(this).css({"border-bottom": "2px solid #299035","background": ""});
              setTimeout($.proxy(function(){
              $(this).css({"border": "","background": ""});},this),2000);               
          }
      });
    if(isValid == true) {
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
                      url: 'api/manage_delivery/transport_update',
                      type: 'POST',
                      data: {
                             id            : id            , 
                             reg_no        : reg_no        , 
                             owner_name    : owner_name    , 
                             licence_no    : licence_no    ,
                             contact       : contact       , 
                             vehicle_brand : vehicle_brand , 
                             vehicle_model : vehicle_model ,
                             status        : status 
                            },
                      success: function(response){
                               setTimeout(function(){
                              swal("Successfully Updated!");
                              location.reload();
                              }, 2000);
                      },
                      error: function (error) {
                        var error_msg = JSON.stringify(error.responseJSON.errors);
                        sweetAlert('Oops... ',error_msg,"error");
                      }
              });
        }); 
      }else{
        swal({    
              title: "please fill all input !",   
              timer: 1000,   
              showConfirmButton: false });
            return false;
      }
  // $('.save'+id).hide();
});

// // card search 
//   $("#vehicle_info_search").on('keyup',function(){
//       var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
//       var card = $(".demoCardCloned");
//       var input;
      
//       $.each(card,function(index,data){
//         input = $.trim($(this).children().children().text()).toLowerCase().replace(/ +/g, '');
//         (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
//       //(!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeInUp hinge").show() : $(this).fadeOut(100).hide(100) ;
//         });
//   });


//==============================End of Vehicle Info page ===================================================//

/*-------------------------------Start of Transport Track -----------------------------------------------------------------------------*/
    // Append rows
    $('#add_update').on('click',function(){
      var isValid      = true                             ;
      var date         = $('#datepicker').val()           ;
      var transport_id = $('#driver_name').attr('transport_id');
    //   var reg_no      = $('#vehicle_no').val() ;
      var in_time      = $('#in_time').val()              ;
      var in_km        = $('#in_km').val()                ;
      
      $("#datepicker, #driver_name, #vehicle_no, #in_time, #in_km").each(function() {

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
                url: 'api/manage_delivery/transport_track',
                type: 'POST',
                data:{
                     date         : date        ,
                     transport_id : transport_id,
                    //  reg_no       : reg_no     ,
                     in_time      : in_time     ,
                     in_km        : in_km      
                     },
                success: function(response){
                  var response = JSON.parse(JSON.stringify(response));
                   //swal("Successfully Added!");
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {message: 'Successfully Added !',timeout:3000};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data); 

                    var tRow = $('.vehicle_item').clone();
                    tRow.removeClass('vehicle_item');
                    tRow.addClass('vehicleupdateCloned').addClass('vehicle_row');
                    tRow.removeClass('hidden');
                    $('.vehicle_infoTbody').prepend(tRow); 
                    $.each(tRow,function(Index, data){
                       $(this).children().eq(1).children().children().val(response.data[0].date);
                       $(this).children().eq(2).children().children().val(response.data[0].owner_name);
                       $(this).children().eq(3).children().children().val(response.data[0].reg_no);
                       $(this).children().eq(4).children().children().val(response.data[0].in_time);
                       $(this).children().eq(5).children().children().val(response.data[0].in_km);
                       $(this).children().eq(6).children().children().val(response.data[0].out_time);
                       $(this).children().eq(7).children().children().val(response.data[0].out_km);
                       $(this).children().eq(8).children().children().val(response.data[0].final_km);
                       $(this).children().eq(9).children().eq(1).attr('data-id',response.data[0].track_id).attr('data-trans',response.data[0].transport_id);
                    });
                // empty input row
                    $("#datepicker, #driver_name, #vehicle_no, #in_time, #in_km").val('');
                    setTimeout(function(){ $('#datepicker').focus(); }, 250);                    
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

  
  //Total
  $('table').delegate('.out','keyup',function(){
      var out_km = parseFloat($(this).val());
      var in_km = parseFloat($(this).parent().parent().parent().children().eq(5).children().children().val()); 
    //   console.log(out_km,in_km);
    $(this).parent().parent().parent().children().eq(8).children().children().val(out_km - in_km);
  
}); 
  
    //table Edit
  $('table').on('click','.edit_track',function(){  
    $(this).next().removeAttr('hidden');
    $(this).next().next().removeAttr('hidden');
    $(this).hide();
    $(this).parent().parent().children().eq(6).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(7).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(8).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
});//End table Edit

  //table Edit->cancel
  $('table').on('click','.cancel_track',function(){  
    $(this).attr('hidden','true');
    $(this).prev().attr('hidden','true');
    $(this).prev().prev().show();
    $(this).parent().parent().children().eq(6).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(7).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(8).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
  });//End table Edit->cancel

  //table Update
  $('table').on('click','.update_track',function(){
    var ele           = $(this);
    var id            = $(this).attr('data-id');
    var transport_id  = $(this).attr('data-trans');
    var out_time      = $(this).parent().parent().children().eq(6).find('input').val();
    var out_km        = parseFloat($(this).parent().parent().children().eq(7).find('input').val());
    var final_km      = parseFloat($(this).parent().parent().children().eq(8).find('input').val());
    var in_km         = parseFloat($(this).parent().parent().children().eq(5).children().children().val()); 
    if(out_km < in_km){
         'use strict';
          var snackbarContainer = document.querySelector('#demo-toast-example');
          var data = {message: 'Out km should be greater than In Km !',timeout:3000};
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
          return false;
    }
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
      url: 'api/manage_delivery/transport_track_update',
      type: 'POST',
      data: {id : id , transport_id : transport_id , out_time : out_time, out_km : out_km, final_km : final_km},
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
          ele.parent().parent().children().eq(6).children().find('input').val(out_time).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(7).children().find('input').val(out_km).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
          ele.parent().parent().children().eq(8).children().find('input').val(final_km).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});          
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

 // name of the driver autofill 
  $('#driver_name').on('keyup',function(e){
      var $selector =$(this).next().next().next().children(),  //ul element
        text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase(),
        driver_name = [];
        typeCode = 1;
        if(text.length>0){ 
	        $selector.parent().removeClass('hidden');
	        vehicleSearch(text,typeCode ,$selector);
		    }else{
			    $selector.parent().addClass('hidden');
		    }
        e.preventDefault();
        return false;
      }).on('blur',function(e){      
        var $selector =$(this).next().next().next().children();    
        var row = $selector.parent().parent().parent().parent(); //tr
        var vehicle_num = $(this).attr('reg_no');      
        row.children().eq(2).find('input').val(vehicle_num);
      });

/*-------------------------------Function to View Vehicle Track-----------------------------------------------------------------------------*/  
  function displayTable(offset) {
      $.ajax({
          url: 'api/manage_delivery/transport_track/offset/' + offset + '/limit/' + 16,
          type: 'GET',
          success: function(response) {
              var response = JSON.parse(JSON.stringify(response));
              // console.log(response.data);
               $(".show_more").removeClass("hidden");
              response.data.forEach(function(Index, i) {
              var tRow = $('.vehicle_item').clone();
                  tRow.removeClass('vehicle_item');
                  tRow.addClass('vehicleupdateCloned').addClass('vehicle_row');
                  tRow.removeClass('hidden');
                  $('.vehicle_infoTbody').append(tRow); 
                     tRow.children().eq(1).children().children().val(response.data[i].date);
                     tRow.children().eq(2).children().children().val(response.data[i].owner_name);
                     tRow.children().eq(3).children().children().val(response.data[i].reg_no);
                     tRow.children().eq(4).children().children().val(response.data[i].in_time);
                     tRow.children().eq(5).children().children().val(response.data[i].in_km);
                     tRow.children().eq(6).children().children().val(response.data[i].out_time);
                     tRow.children().eq(7).children().children().val(response.data[i].out_km);
                     tRow.children().eq(8).children().children().val(response.data[i].final_km);
                     tRow.children().eq(9).children().eq(1).attr('data-id',response.data[i].track_id).attr('data-trans',response.data[i].transport_id);
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
                   $(".show_more").addClass("hidden");
                  return false;
              }
          }
      });
      return false;
  }

  $(".show_more").on('click', function() {
      var offset = $(".vehicle_row").length;
      displayTable(offset);
  });

/*-------------------------------Function to Search Vehicle Track-----------------------------------------------------------------------------*/

    $("#vehicle_update_search").donetyping(function(e) {
      var text = $(this).val();
      if (text.length >= 3) {
          clearTimeout($.data(this, 'timer'));
          var wait = setTimeout(function() {
              $.ajax({
                      url: 'api/manage_delivery/search_track',
                      type: 'POST',
                      data: {
                          q: text
                      },
                      success: function(response) {
                          var response = JSON.parse(JSON.stringify(response));
                          $('.dynamic_search').removeClass('hidden');
                          $('.show_more,.page-content').addClass('hidden');
                         response.data.forEach(function(Index, i) {
                          var tRow = $('.vehicle_item').clone();
                          tRow.removeClass('vehicle_item');
                          tRow.addClass('vehicleSearchCloned');
                          tRow.removeClass('hidden');
                          $('.searchResultTable').append(tRow); 
                             tRow.children().eq(1).children().children().val(response.data[i].date);
                             tRow.children().eq(2).children().children().val(response.data[i].owner_name);
                             tRow.children().eq(3).children().children().val(response.data[i].reg_no);
                             tRow.children().eq(4).children().children().val(response.data[i].in_time);
                             tRow.children().eq(5).children().children().val(response.data[i].in_km);
                             tRow.children().eq(6).children().children().val(response.data[i].out_time);
                             tRow.children().eq(7).children().children().val(response.data[i].out_km);
                             tRow.children().eq(8).children().children().val(response.data[i].final_km);
                             tRow.children().eq(9).children().eq(1).attr('data-id',response.data[i].track_id).attr('data-trans',response.data[i].transport_id);
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
//==============================End of Transport Track  page ===================================================//

  // find cards
  $("#vehicle_info_search").on('keyup',function()
    {
      var text = $.trim($(this).val()).toLowerCase();
      if(text.length>=3){
        clearTimeout($.data(this, 'timer'));
        var wait =setTimeout(function(){
          $.ajax({
                url: 'api/manage_delivery/search',
                type: 'POST',
                data: {q   : text },
                success: function(response){
                    var response = JSON.parse(JSON.stringify(response));
                    $('.dynamic_search').removeClass('hidden');
                    $('.page-content').addClass('hidden');
                    for(var i=0; i<response.data.length; i++){
                      var clone=$(".demoCardEmpty").clone(); 
                      clone.removeClass('demoCardEmpty');
                      clone.addClass('demoCardCloned');
                      clone.removeClass('hidden');
                      $('.searchResult').append(clone);
                    
                      clone.children().children().eq(0).children().append(response.data[i].owner_name);
                      clone.children().children().eq(1).children().eq(1).append(response.data[i].vehicle_brand);
                      clone.children().children().eq(2).children().eq(1).append(response.data[i].vehicle_model);
                      clone.children().children().eq(3).children().eq(1).append(response.data[i].contact);
                      clone.children().children().eq(4).children().eq(0).attr('href','vehicleInfo?vehicle_id='+response.data[i].id);
                    
                    }
                    //$('.searchResult').empty();
                  },
                  error:function (xhr, status, error) {
                  }
          });
        },500);
        $('.searchResult').empty();
        $(this).data('timer', wait);
      }
  });
  $('#dynamic_div_close').on('click',function(){
    $('.dynamic_search').addClass('hidden');
    $('.page-content').removeClass('hidden');
    $('.searchResult').empty();
  });

/*-----------------------------Google map -------------------------------------------------------------*/
     var latlang = [{lat: 19.1510, lng: 72.9315},{lat: 19.2210, lng: 72.9615},{lat: 19.3010, lng: 73.0015},{lat: 19.4009, lng: 73.1115}];
     
      google.maps.event.addDomListener(window, 'load', myMap);
      var source, destination;
      source = {lat: 19.1056763, lng: 72.8875521};
      destination = {lat: 19.0891, lng: 72.8899};
      function myMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {lat: 19.1056763, lng: 72.8875521}
        });
        var marker = null;
       /* function autoUpdate() {
            for(var i =0; i<latlang.length; i++)
            {
              console.log(latlang[i].lat , latlang[i].lng);
              var newPoint = new google.maps.LatLng(latlang[i].lat, 
                                                  latlang[i].lng);
            }
          navigator.geolocation.getCurrentPosition(function(position) {  
              var newPoint = new google.maps.LatLng(position.coords.latitude, 
                                          position.coords.longitude);

            if (marker) {
              marker.setPosition(newPoint);
            }
            else {
              // Marker does not exist - Create it
              marker = new google.maps.Marker({
              position: newPoint,
              map: map
              });
            }
            // Center the map on the new position
            map.setCenter(newPoint);
          });
           // Call the autoUpdate() function every 5 seconds
            setTimeout(autoUpdate, 5000);
        }*/
        //autoUpdate();
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);

        document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }
      
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
        var request = {
        origin: {lat:  19.1056763, lng: 72.8875521},
        destination: {lat: 19.0891, lng: 72.8899},
        travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
      
    //*********DISTANCE AND DURATION**********************//
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: [source],
        destinations: [destination],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
    }, function (response, status) {
        if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
            var distance = response.rows[0].elements[0].distance.text;
            var duration = response.rows[0].elements[0].duration.text;
            var dvDistance = document.getElementById("dvDistance");
            dvDistance.innerHTML = "";
            dvDistance.innerHTML += "Distance Travelled : " + distance + "<br />";
            dvDistance.innerHTML += "Duration:" + duration;
 
        } else {
            alert("Unable to find the distance via road.");
        }
    });

});