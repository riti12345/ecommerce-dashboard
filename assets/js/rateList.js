$(document).ready(function(){
  
  // General Ratelist Search 
  $("#rateList_info_search").on('keyup',function(e){
    var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
    var tRow = $(".rateList_info_raw");
    var input;
    $.each(tRow,function(index,data){
      input = $.trim($(this).children().eq(0).nextUntil(2).text()).toLowerCase().replace(/ +/g, '');
      (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
    });
  });

   // Category Search 
      $('#search_rateList_category').on('change',function(){
        $('#search_rateList_sub_category').val(function () {
          return $(this).find('option').filter(function () {
              return $(this).prop('SelectedIndex',0);
          }).val();
        });
        $('#search_rateList_sub_category').next().next().children().eq(1).text('All');
        $('#search_rateList_sub_category').next().next().next().children().children().eq(0).addClass('is-selected');
        $('#search_rateList_sub_category').next().next().next().children().children().siblings().removeClass('is-selected');
        
        var category = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        var row = $(".rateList_info_raw");
        var input;
            // search in table
            $.each(row,function(index,data){
              input = $.trim($(this).children().eq(1).children().text()).replace(/ +/g, '').toLowerCase();
              (input == category) ? $(this).show() : $(this).hide() ;
            });

            if($(this).val() == 'all'){
              $.each(row,function(index,data){
                $(this).show();
              });
            }
      });

      // Sub_Category Search 
      $('#search_rateList_sub_category').on('change',function(){
        $('#search_rateList_category').val(function () {
          return $(this).find('option').filter(function () {
              return $(this).prop('SelectedIndex',0);
          }).val();
        });
        $('#search_rateList_category').next().next().children().eq(1).text('All');
        $('#search_rateList_category').next().next().next().children().children().eq(0).addClass('is-selected');
        $('#search_rateList_category').next().next().next().children().children().siblings().removeClass('is-selected');
       
        var sub_category = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        var row = $(".rateList_info_raw");
        var input;
            // search in table
            $.each(row,function(index,data){
              input = $.trim($(this).children().eq(2).children().text()).replace(/ +/g, '').toLowerCase();
              console.log(input+'.....'+sub_category);
              (input == sub_category) ? $(this).show() : $(this).hide() ;
            });

            if($(this).val() == 'all'){
               $.each(row,function(index,data){
                $(this).show();
              });
            }
      });

  //Rate Edit->Edit
  $('table').on('click','.rate_edit',function(){  
    $(this).next().removeAttr('hidden');
    $(this).next().next().removeAttr('hidden');
    $(this).hide();
    $(this).parent().parent().children().eq(3).attr('hidden','true');
    $(this).parent().parent().children().eq(4).removeAttr('hidden');
  });//End Raw Edit

  //Rate Edit->Cancel
  $('table').on('click','.rate_cancel',function(){  
    $(this).attr('hidden','true');
    $(this).prev().attr('hidden','true');
    $(this).prev().prev().show();
    $(this).parent().parent().children().eq(4).attr('hidden','true');
    // $(this).parent().parent().children().eq(4).find('input').val('');
    $(this).parent().parent().children().eq(3).removeAttr('hidden');
  });//End Raw Edit->cancel

/*--------------------------------General RateList Bulk Upload--------------------------------------------------------------------------*/
  $('#ratelist_bulkUpload').click(function(event){
    event.preventDefault();
  	var formData = new FormData();
    formData.append('rates', document.getElementById('general_ratelist').files[0]);

    var isValid = true;
    $("#general_ratelist").each(function() { if($.trim($(this).val()) == '') { isValid = false; $('#ratelistlabel').css({'box-shadow':'0px 0px 23px 8px #ff4646'});}else{$('#ratelistlabel').css({'box-shadow':'none'});} });

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
				      url: 'api/manage_items/upload_general_rates',
				      type: 'POST',
				      data: formData,
				      contentType: false,
				      processData: false,
				      success: function(response) {
				          //alert("successfully Added general rate list");
                  'use strict';
                  var snackbarContainer = document.querySelector('#demo-toast-example');
                  var data = {message: 'Successfully added general rate list !',timeout: 3000};
                  snackbarContainer.MaterialSnackbar.showSnackbar(data);
				          location.reload();
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
        //swal({ title: "please select a file !", timer: 2000, showConfirmButton: false });
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Please select a file !',timeout: 1000};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  });
/*--------------------------------Single Upload General RateList-------------------------------------------------------*/
  $('table').on('click','.rate_update', function(){
    var isValid = true;
    var element = $(this);
    var price   = $(this).parent().parent().children().eq(4).find('input').val();
    var item_id = $(this).attr('item-id');
    if($.trim($(this).parent().parent().children().eq(4).find('input').val()) == ''){
       isValid = false;
       $(this).parent().parent().children().eq(4).find('input').css({"border-bottom": "2px solid #ff4646","background": "#fff"});
    }else{
       $(this).parent().parent().children().eq(4).find('input').css({'border-bottom':'none',"background": ""});
    }
    if (isValid == true) {
      swal({
           title: "Are you sure ?",
           text: "Do you want to update this item ?",
           type: "info",
           showCancelButton: true,
           closeOnConfirm: true,
           animation: "slide-from-top",
           showLoaderOnConfirm: false, },
           function(){
         $.ajax({
              url: 'api/manage_items/single_upload_general_rates',
              type: 'POST',
              data: {
                     item_id : item_id,
                     price   : price,
                    },
              success: function(response) {
                var response = JSON.stringify(response);
                  //swal("Successfully Updated!");
                  'use strict';
                  var snackbarContainer = document.querySelector('#demo-toast-example');
                  var data = {message: 'Successfully updated !',timeout: 3000};
                  snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  element.parent().parent().children().eq(4).find('input').val(price);
                  element.parent().parent().children().eq(5).children().eq(0).show();
                  element.parent().parent().children().eq(5).children().eq(1).attr('hidden','true');
                  element.parent().parent().children().eq(5).children().eq(2).attr('hidden','true');
                  //location.reload();
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
        //swal({ title: "Please Enter Price !", timer: 1000, showConfirmButton: false });
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {message: 'Please enter price !',timeout: 1000};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  });

});//Document Ends Here