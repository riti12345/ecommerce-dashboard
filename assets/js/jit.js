$(document).ready(function(){
    var old_item_price;
    var markets_names = new Array("");
    var upcomming = [];
    var history =[];
    var today = new Date();
      var day = today.getDate();
      var month = today.getMonth()+1;
      if(month <= 9 ){month = '0'+month}
      if(day <= 9 ){day = '0'+day}
      var year = today.getFullYear();
      var aaj = year+'-'+month+'-'+day;

    $('table').delegate('#selectJitItem ,#editJitItem','keyup',function(e){
        var $selector =$(this).next().next().next().children(),  //ul element
        text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase(),
        typeCode = 1,
        rate;
        if(text.length>0){
          $selector.parent().removeClass('hidden');
          itemSearch(text,typeCode ,$selector);
        }else{
            $selector.parent().addClass('hidden');
        }
    });

    // Markets autofill
    $('table').delegate('#selectMarkets , #editJitMarkets','keyup',function(e){
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
    })

    // Append rows
    $('#jitAppendRow').on('click',function(){
      var isValid = true;
      $("#selectJitItem, #selectMarkets, #quantity, #price, #reason, #datepicker").each(function() {
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
      });
      if (isValid == true) {
        $('.addJitScreen').removeClass('hidden');
        var tRow = $('.jit-item').clone();
        tRow.removeClass('jit-item').addClass('jitCloned').removeClass('hidden');
        $('.jit_tbody').prepend(tRow);
        
        tRow.children().eq(1).find('input').val($('#selectJitItem').val()).attr('item-id',$('#selectJitItem').attr('item-id'));
        tRow.children().eq(2).find('input').val($('#selectMarkets').val());
        tRow.children().eq(3).find('input').attr('value',$('#quantity').val()).val($('#quantity').val());
        tRow.children().eq(4).find('input').attr('value',$('#price').val()).val($('#price').val());
        tRow.children().eq(5).find('input').attr('value',$('#reason').val()).val($('#reason').val());
        // empty input row
        $('#selectJitItem, #selectMarkets, #quantity, #price, #reason').val('');
        $('#selectJitItem,#selectMarkets').removeClass('hidden').attr('value','').attr('data-id','');
        $('#selectJitItem,#selectMarkets').next().addClass('hidden');
        setTimeout(function(){ $('#selectJitItem').focus(); }, 250);
      }else{
          'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {message: 'please fill all input !',timeout:1000};
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
          return false;
      }
    });

    // Remove rows
    $('table').on('click', '.jit-row-remove', function(){
        var element = $(this);
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
            swal("Deleted!", "Removed.", "Success"); 
        });
    });
    // edit add_order row 
  $('table').on('click','.jit-row-edit',function(){
    $('.edit_unit').addClass('blink');
    $(this).parent().parent().children().find('input').removeAttr('readonly').removeClass('mdl-textfield__input_border');
    $(this).addClass('hidden');
    $(this).parent().children().eq(1).addClass('hidden');
    $(this).parent().children().eq(2).removeClass('hidden');
    $(this).parent().children().eq(3).removeClass('hidden');
  });

  // update add_order row
  $('table').on('click','.jit-row-done',function(){
    $(this).parent().parent().children().find('input').addClass('mdl-textfield__input_border');
    $(this).parent().parent().children().eq(0).nextUntil(2).find('input').removeClass('hidden');
    $(this).parent().parent().children().eq(0).nextUntil(2).find('input').next().addClass('hidden');
    $(this).addClass('hidden');
    $(this).parent().children().eq(3).addClass('hidden');
    $(this).parent().children().eq(0).removeClass('hidden');
    $(this).parent().children().eq(1).removeClass('hidden');
  });

  // reset add_order row
  $('table').on('click','.jit-row-cancel',function(){
    $('.edit_unit').removeClass('blink');
    $(this).parent().parent().children().find('input').addClass('mdl-textfield__input_border');
    $(this).addClass('hidden');
    $(this).parent().children().eq(2).addClass('hidden');
    $(this).parent().children().eq(0).removeClass('hidden');
    $(this).parent().children().eq(1).removeClass('hidden');
  });
    // Post request
    var item_id = [];
    var quantity = [];
    var target_price = [];
    var reason = [];
    var jit_date = [];
    var market_id = [];
    var other_charges = [];
    var assign_to = [];

    $('#submit_jit').on('click',function(){
      var procureDate = $('#datepicker').val();

      var rows = $('.jitCloned');
      $(rows).each(function() {
        var market = getMarketID($(this).children().eq(2).find('input').val());
        var marketId = market.id;
        item_id.push($(this).children().eq(1).find('input').attr('item-id'));
        market_id.push(marketId);
        quantity.push($(this).children().eq(3).children().children().eq(0).attr('value'));
        target_price.push($(this).children().eq(4).children().children().eq(0).attr('value'));
        reason.push($(this).children().eq(5).children().children().eq(0).attr('value'));
        jit_date.push(procureDate);
        assign_to.push($('#team').val());
      });
      var data = {
          item_id          : item_id,
          quantity         : quantity,
          target_price      : target_price,
          assignee_id      : assign_to,
          jit_date         : jit_date,
          reason           : JSON.stringify(reason),
          market_id        : market_id
      };
      //console.log(data);
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
               url: 'api/Manage_procure/jit',
                  type: 'POST',
                  data: data,
                  success: function(response) {
                      'use strict';
                      var snackbarContainer = document.querySelector('#demo-toast-example');
                      var data = {message: 'Successfully procured !',timeout:3000};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                      window.location.href = "jit";
                  },
                  error: function(error) {
                    //var error_msg = JSON.stringify(error.responseJSON.errors);
                    sweetAlert('Oops... ','Something went wrong !',"error");
                  }
              });
      });
    });
    
    /*===============================Jit card dispay=============================================*/ 
    var team_id = '';
    $.get("api/manage_procure/jit_details/"+team_id, function(data){
        var manage_ProcData = JSON.parse(JSON.stringify(data)).data;
        // console.log(manage_ProcData);
        var cr=0;
        manage_ProcData.forEach(function(index,i) {
          var date = new Date(manage_ProcData[i].jit_date);
          var d = date.getDate();
          var m =  date.getMonth();
          m += 1;  // JavaScript months are 0-11
          var y = date.getFullYear();
          var superScript;
          if(d == 1 || d==31){superScript = 'st';}else if(d==2 || d ==22){superScript ='nd';}else if(d==3 || d==23){superScript ='rd';}else{superScript = 'th';}
            
          var clone=$(".jitCardEmpty").clone();
          clone.removeClass('jitCardEmpty').addClass('jitCardCloned').removeClass('hidden');
          
         

          if(manage_ProcData[i].jit_date >= aaj ){
             $('.jitProcureView').append(clone);
             upcomming.push(manage_ProcData[i]);
          }else{ 
            history.push(manage_ProcData[i]);
             $('.jitHistoryView').append(clone);
          }
          var temp=0;
          for (var j = 0; j < manage_ProcData[i].data.length; j++) {
            if(manage_ProcData[i].data[j].status==1){
                if(manage_ProcData[i].data[j].jit_date >= aaj){       
                   temp = temp + (parseFloat(proc_data[i].data[j].target_price * parseFloat(proc_data[i].data[j].quantity)));
                }else{
                  temp = temp + parseFloat(proc_data[i].data[j].final_price);
                }
            }
          }
            clone.children().children().eq(0).children().append(d+'<sup>'+superScript+'</sup>'+" "+monthArray[m]+' '+y);
            clone.children().children().eq(1).children().append(temp.toFixed(2));//Math.round(temp)
            if(manage_ProcData[i].jit_date >= aaj ){
              clone.children().children().eq(2).children().eq(0).attr('href','jitInfo?&jitid='+manage_ProcData[i].id+'&tab_stat=upcomming_tab').attr('id','infoToolproc'+cr);
            }else{clone.children().children().eq(2).children().eq(0).attr('href','jitInfo?&jitid='+manage_ProcData[i].id+'&tab_stat=history_tab').attr('id','infoToolproc'+cr);
            }
            clone.children().children().eq(2).children().eq(0).children().eq(1).attr('for','infoToolproc'+cr);
            clone.children().children().eq(2).children().eq(1).attr('data-id',manage_ProcData[i].id).attr('data-assignee',manage_ProcData[i].assignee_id);
        });
      
        if(upcomming.length == 0){
            $('div .jitProcureView').append(
              '<div class="mdl-card-status mdl-shadow--2dp">'+
                '<p><i class="material-icons status_icon">history</i><p>'+
                '<p><h3> Nothing to procure.  <br> <br> Take Rest for a while </h3></p>'+
              '</div>');
        }
        if(history.length == 0){
          $('div .jitHistoryView').append(
            '<div class="mdl-card-status mdl-shadow--2dp">'+
              '<p><i class="material-icons status_icon">history</i><p>'+
              '<p><h3> History None.</h3></p>'+
            '</div>');
        }
    });
    
     // find card in today's procured items
    $('#view_jit_search').on('keyup',function(){
      var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
      var card = $(".jitCardCloned");
      var input;
      $.each(card,function(index,data)
        {
          input = $.trim($(this).children().children().children().text()).toLowerCase().replace(/ +/g, '');
          (!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeInUp hinge").show() : $(this).fadeOut(100).hide(100) ;
        });
      });
    // find item in jit info 
    $('#jit_info_search').on('keyup',function(){
        var tRow = $('.jit_info_row');
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
            $.each(tRow,function(index,data){
                var input  = $(this).children().text(),
                textL = $.trim(input).toLowerCase().replace(/ +/g, '');
                //console.log(input);
                (!~textL.indexOf(text) == 0) ? $(this).addClass("animate fadeIn hinge").show() : $(this).fadeOut(100).hide(100) ;
            });
    });
    // find item in jit add procure 
    $('#add_order_row_search').on('keyup',function(){
        var tRow = $('.jit-item').siblings();
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
            $.each(tRow,function(index,data){
                var input  = $(this).children().text(),
                textL = $.trim(input).toLowerCase().replace(/ +/g, '');
                //console.log(input);
                (!~textL.indexOf(text) == 0) ? $(this).addClass("animate fadeInUp hinge").show() : $(this).fadeOut(100).hide(100) ;
            });
    });

    $.get("api/manage-team/team/line_manager", function(data){
      deliveryTeam =JSON.parse(JSON.stringify(data)).data;
      for(var i=0; i < deliveryTeam.length; i++){
        $('#team').append('<option value='+deliveryTeam[i].id+'>'+deliveryTeam[i].username+'</option>');
      }
    });

    /*====================JIT INFO =========================================================*/
      // ROW EDIT
      $('table').on('click','.jit-info-row-edit',function(){
        var data_item_id = $(this).parent().attr('data-item-id');
        /*initial_quantity = $(this).parent().parent().children().eq(9).find('input').val();
        var single_price = $(this).parent().parent().children().eq(11).find('input').val();
        initial_price = parseFloat(initial_quantity)* parseFloat(single_price);
        initial_total_price = $('.total_price').attr('value');*/
        if ($(this).attr('disabled')=='disabled'){
            return false;
        }else{
            $('.show_jit_class'+data_item_id).addClass('hidden');
            $('.show_jit_class').addClass('hidden');
            $('.hide_jit_class'+data_item_id).removeClass('hidden');
        }
      });

      // row reset 
      $('table').on('click','.jit-info-row-cancel',function(){
        var data_item_id = $(this).parent().attr('data-item-id');
        $('.show_jit_class').removeClass('hidden');
        $('.show_jit_class'+data_item_id).removeClass('hidden');
        $('.hide_jit_class'+data_item_id).addClass('hidden');
      });//End Procured Items Cancel(BTN)

      // Delete row
      $('table').on('click','.jit-info-row-delete',function(){
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
                $('.show_jit_class').removeClass('hidden');
                $('.show_jit_class'+data_item_id).removeClass('hidden');
                $('.hide_jit_class'+data_item_id).addClass('hidden');
            
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
    
    // post update
    $('table').on('click','.jit-info-row-done',function(){
      var data_item_id = $(this).parent().attr('data-item-id');
      var ipn_arr ={};
      var element = $(this);
         ipn_arr['jit_items_id'] = $(this).attr("data-items");
         ipn_arr['jit_id']    = $(this).attr("data-proc");
         
         $(this).parent().parent().children().find('input').each(function(key, value){
             ipn_arr[$(this).attr("name")] = $(this).val();      
         });
          /*var quantity = $(this).parent().parent().children().eq(9).find('input').val();
          var price = $(this).parent().parent().children().eq(11).find('input').val();
          var total_price = parseFloat(initial_total_price) - parseFloat(initial_price) + parseFloat((quantity)*(price));*/
          /*var get_item_id = searchItemId(ipn_arr['item_id']);*/
         ipn_arr['item_id']  =  $('#editJitItem').attr('item-id');
         ipn_arr['assignee_id'] = $(this).parent().parent().children().find('select').find(":selected").val();
         ipn_arr['quantity']= $('#proc_quantity').val();
         ipn_arr['market_id'] = $('#editJitMarkets').attr('data-id');
         ipn_arr['final_price'] = $('#final_price').val();
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
                    url: 'api/Manage-procure/update_jit',
                    type: 'POST',
                    data: ipn_arr,
                    success: function(response){
                    /*element.parent().parent().children().eq(1).html(get_item_id.item_name);
                    element.parent().parent().children().eq(4).html(element.parent().parent().children().eq(5).find('input').val());
                    element.parent().parent().children().eq(8).html(element.parent().parent().children().eq(9).find('input').val());
                    element.parent().parent().children().eq(10).html(element.parent().parent().children().eq(11).find('input').val());
                    $('.total_price').text(total_price);
                    $('.total_price').attr('value',total_price);*/
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {message: 'Updated successfully !',timeout:1000};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    location.reload();
                    },
                    error: function (error) {
                      //var error_msg = JSON.stringify(error.responseJSON.errors);
                      sweetAlert('Oops... ','Something went wrong!',"error");
                    }
              });//End Ajax
      });//End sweet alert
    });//End procured Items row Done Function

      // Delete row
      $('table').on('click','.jit-info-row-delete',function(){
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
                $('.show_jit_class').removeClass('hidden');
                $('.show_jit_class'+data_item_id).removeClass('hidden');
                $('.hide_jit_class'+data_item_id).addClass('hidden');
            
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
    /*====================Purchase Order Print Function======================================*/
    $("body").delegate(".print_p_o", "click", function() {
      var assignee_id =  $(this).attr('data-assignee'); 


      var procure_id =  $(this).attr('data-id');

      $('.p_o_content').empty();
    
      $.ajax({
        url: 'View/purchase_jit_orders',
        type: 'POST',
        data:{ 
        assignee_id : assignee_id ,
        procure_id  : procure_id,

        vendor_id   : ""

        },
        success: function(response){
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

});//Document Ends Here
