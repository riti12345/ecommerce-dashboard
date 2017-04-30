$(document).ready(function() {
    
    /*----------------------------Function to View Client Cards-------------------------------------------------------------*/
    function displayCard(offset) {
        //offset = $(".clientCardCloned").length;
        $.ajax({
            url: 'api/manage_clients/clients/offset/' + offset + '/limit/' + 8,
            type: 'GET',
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                var clients = response.data;
                // card display
                clients.forEach(function(Index, i) {
                    var client_name = clients[i].name;
                    var poc_name = clients[i].poc_name;
                    var brand_name = clients[i].brand_name;
                    var company_name = clients[i].company_name;
                    var poc_phone = clients[i].poc_phone;
                    var client_id = clients[i].id;
                    var city_name = ["", "Mumbai"];

                    // Grid/card view 
                    var clone = $(".clientCardEmpty").clone();
                    clone.removeClass('clientCardEmpty').addClass('clientCardCloned').removeClass('hidden');
                    $('div .client').append(clone);
                    clone.children().children().eq(0).children().append(client_name).addClass('clientName');
                    clone.children().children().eq(1).children().eq(1).append(poc_name);
                    clone.children().children().eq(2).children().append(brand_name);
                    clone.children().children().eq(3).children().append(company_name);
                    clone.children().children().eq(4).children().eq(1).append(poc_phone);
                    clone.children().children().eq(5).children().eq(0).attr('href', 'clientInfo?id=' + client_id + '').attr('id', 'infoTool' + i); //css({"border":"1px solid green"})
                    clone.children().children().eq(5).children().eq(0).children().eq(1).attr('for', 'infoTool' + i);
                    clone.children().children().eq(5).children().eq(1).attr('href', 'clientRatelist?id=' + client_id + '').attr('id', 'ratelistTool' + i);
                    clone.children().children().eq(5).children().eq(1).children().eq(1).attr('for', 'ratelistTool' + i);
                    if (clients[i].status == 0) {
                        clone.children().children().eq(6).children().children().eq(0).html('visibility_off');
                    }
                    // List view/ table view 
                    var tRowClone = $('.clientTrowEmpty').clone();
                    tRowClone.removeClass('clientTrowEmpty').addClass('clientTrowCloned').removeClass('hidden');
                    $('.clientTbody').append(tRowClone);
                    tRowClone.children().eq(0).children().attr('href', 'clientInfo?id=' + client_id + '').attr('id', 'infoTool' + i);
                    tRowClone.children().eq(0).children().children().eq(1).attr('for', 'infoTool' + i);
                    tRowClone.children().eq(1).append(client_name);
                    tRowClone.children().eq(2).append(company_name);
                    tRowClone.children().eq(3).append(poc_name);
                    tRowClone.children().eq(4).append(poc_phone);
                    tRowClone.children().eq(5).append(city_name[clients[i].city_id]);
                }); //End View Clients Cards 
                if(document.getElementById('view_card_search')){
                   //$('div .searchResultCard').append(clone);
                   $('.clientTableEmpty').parent().addClass('hidden'); 
                }else if(document.getElementById('view_list_search')){
                    //$('div .searchResultList').append(tRowClone);
                    $('.regclientcards').addClass('hidden');
                }  
                // }, 1000);
            },
            error: function(xhr, status, error) {
                if (xhr.status == 404) {
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
    
    //Append list view and grid view 
    $('.list_view').click(function() {
        $('.grid_view, .print_view ,.clientTrowCloned').removeClass('hidden');
        $('.clientCardCloned,.list_view').addClass('hidden');
        $('.clientTableEmpty').parent().removeClass('hidden');
        $('.clientCardEmpty ,.clientCardCloned').attr('id','');
        $('div .searchResultList').removeClass('hidden');
        $('div .searchResultCard').addClass('hidden');
        $('.clientTbody').attr('id','view_list_search');
    });

    $('.grid_view').click(function() {
        $('.print_view ,.grid_view ,.clientTrowCloned').addClass('hidden');
        $('.clientCardCloned,.list_view').removeClass('hidden');
        $('.clientTableEmpty').parent().addClass('hidden');
        $('.clientTbody').attr('id','');
        $('div .searchResultList').addClass('hidden');
        $('div .searchResultCard').removeClass('hidden');
        $('.clientCardEmpty ,.clientCardCloned').attr('id','view_card_search');
    });
    if (window.location.pathname == '/os/clients') {
        displayCard(0);
    }
    $(".show_more").on('click', function() {
        var offset = $(".clientCardCloned").length;
        displayCard(offset);
    });
    /*$(".show_more_list").on('click', function() {
        var offset = $(".clientTrowCloned").length;
        displayCard(offset);
    });*/

    //search client 
    function clientSearch(text,typeCode){
        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(function() {
            $.ajax({
                  url: 'api/manage-clients/search',
                  type: 'POST',
                  data: {q   : text, 
                        type : typeCode
                        },
                  success: function(response){
                      var response = JSON.parse(JSON.stringify(response));
                      $('.dynamic_search').removeClass('hidden');
                      //$('.show_more_card , .show_more_list').addClass('hidden');
                      $('.page-content').addClass('hidden');
                    for(var i=0; i<response.data.length; i++){
                        var client_name = response.data[i].name;
                         poc_name = response.data[i].poc_name,
                         brand_name = response.data[i].brand_name,
                         company_name = response.data[i].company_name,
                         poc_phone = response.data[i].phone,
                         client_id = response.data[i].id,
                         city_name = ["", "Mumbai"];

                        clone=$(".clientCardEmpty").clone();
                        clone.removeClass('clientCardEmpty').addClass('clientCardCloned').removeClass('hidden');
                        $('div .searchResultCard').append(clone);
                        clone.children().children().eq(0).children().append(client_name).addClass('clientName');
                        clone.children().children().eq(1).children().eq(1).append(poc_name);
                        clone.children().children().eq(2).children().append(brand_name); 
                        clone.children().children().eq(3).children().append(company_name);
                        clone.children().children().eq(4).children().eq(1).append(poc_phone);
                        clone.children().children().eq(5).children().eq(0).attr('href','clientInfo?id='+client_id+'').attr('id','infoTool'+i);//css({"border":"1px solid green"})
                        clone.children().children().eq(5).children().eq(0).children().eq(1).attr('for','infoTool'+i);
                        clone.children().children().eq(5).children().eq(1).attr('href','clientRatelist?id='+client_id+'').attr('id','ratelistTool'+i);
                        clone.children().children().eq(5).children().eq(1).children().eq(1).attr('for','ratelistTool'+i);
                        if(response.data[i].status == 0){
                           clone.children().children().eq(6).children().children().eq(0).html('visibility_off');
                        }
                        // List view/ table view 
                        var tRowClone = $('.clientTrowEmpty').clone();
                        tRowClone.removeClass('clientTrowEmpty').addClass('clientTrowCloned').removeClass('hidden');
                        $('div .searchResultList').append(tRowClone);
                        tRowClone.children().eq(0).children().attr('href', 'clientInfo?id=' + client_id + '').attr('id', 'infoTool' + i);
                        tRowClone.children().eq(0).children().children().eq(1).attr('for', 'infoTool' + i);
                        tRowClone.children().eq(1).append(client_name);
                        tRowClone.children().eq(2).append(company_name);
                        tRowClone.children().eq(3).append(poc_name);
                        tRowClone.children().eq(4).append(poc_phone);
                        tRowClone.children().eq(5).append(city_name[response.data[i].city_id]);
                       
                        if(document.getElementById('view_card_search')){
                           $('.show_more').addClass('hidden'); 
                        }else if(document.getElementById('view_list_search')){
                           $('.show_more').addClass('hidden');
                        }
                    }
                      //$('.searchResult').empty();
                    },
                    error:function (xhr, status, error) {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var msg = 'No Data Found';
                    var data = {message: msg,timeout:1000};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    return false;
                  }
            });
        }, 500);
        $('.searchResultCard ,.searchResultList').empty();
        $(this).data('timer', wait);
    } 
   
  // find cards
  $("#searchClient").donetyping(function(e)
    {
      //console.log('Event last fired @ ' + (new Date().toUTCString()));
      var text = $.trim($(this).val()).toLowerCase();
      var typeCode = 1;
      if(text.length>=3){
      clientSearch(text,typeCode);
      } 
      $('.searchResultCard ,.searchResultList').empty();
  });

  $('#dynamic_div_close').on('click',function(){
    $('.dynamic_search').addClass('hidden');
    $('.page-content,.show_more').removeClass('hidden');
    $('.searchResultCard ,.searchResultList').empty();
    $('#search_client_category').next().next().children().eq(1).text('All');
    $('#search_client_category').next().next().next().children().children().eq(0).addClass('is-selected');
    $('#search_client_category').next().next().next().children().children().siblings().removeClass('is-selected');
  });

  // Category Search 
  $('#search_client_category').on('change',function(){
    var category = $(this).val();
    var type = 2;

    if($(this).val() == 0){
      $('.dynamic_search').addClass('hidden');
      $('.client').removeClass('hidden');
      $('.searchResult').empty();
    }else{
      clientSearch(category,type);
    }
  });
  
  // find items in client table ratelist
    $('#searchClientRate').on('keyup',function(e){
      var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
      var tRow = $('.client_rateList_row');
        $.each(tRow,function(index,data){
          var input  = $(this).children().text(),
              textL = $.trim(input).toLowerCase().replace(/ +/g, '');
              (!~textL.indexOf(text) == 0) ? $(this).addClass("animate fadeIn hinge").show() : $(this).fadeOut(100).hide(100);
        });
    });
    /*------Toggle  button----*/


    $('#c_status').click(function() {
        if ($(this).attr('data-disabled') == 'disabled') {
            return false;
        }
    });

    /*------Toggle  button----*/
    /*------------------------------Function to Edit Client Info------------------------------------------------------------*/
    $('#c_edit').click(function() {
        $(this).hide();
        $('.showme').fadeIn().removeClass('hidden');
        $('.tog_disable').removeAttr('disabled');
        $('#c_status').removeAttr('data-disabled');
        $('.hideme').hide();
        $('span.info_icon').addClass('info_icon_1').removeClass('info_icon');
        $('#pan_crd').parent().addClass('info_icon');
    });

    /*------------------------------Function to Cancel Client Info----------------------------------------------------------*/
    $('#c_cancel').click(function() {
        $('#c_edit').show();
        $('#c_form').trigger("reset");
        $('.showme').fadeOut().addClass('hidden');
        $('.tog_disable').attr('disabled', 'true');
        $('#c_status').attr('data-disabled', 'disabled');
        $('.hideme').show();
        $('span.info_icon_1').removeClass('info_icon_1').addClass('info_icon');
        $('#pan_crd').parent().addClass('info_icon');
    });

    $('table').delegate('.c_ratelist_cancel', 'click', function() {
        $('.addItem').addClass('hidden');
        $(this).parent().parent().children().eq(1).find('input').val('');
        $(this).parent().parent().children().eq(2).find('input').val('');
        $(this).parent().parent().children().eq(3).find('select').val('');
        $(this).parent().parent().children().eq(4).find('input').val('');
        $(this).parent().parent().children().eq(5).find('select').val('');
    });
    /*------------------------------Function to Sort Client Cards Alphabetically---------------------------------------------*/
    var $divs = $("div.regclientcards");
    var alphabeticallyOrderedDivs = $divs.sort(function(a, b) {
        var vA = $(a).find("h4.clientName").text();
        var vB = $(b).find("h4.clientName").text();
        return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
    });
    $(".client").append(alphabeticallyOrderedDivs);
    /*---------X-------------X--------End Sort Client Cards Alphabetically Function---------------X-----------------X--------*/

    /*--------------------------------Add Client Function Start--------------------------------------------------------------*/
    $("#clientForm").submit(function(event) {
        var mop_cash = "no";
        var mop_cheque = "no";
        var mop_rtgs = "no";
        var mop_neft = "no";
        if ($("#client_cash:checked").val()) {
            mop_cash = $("#client_cash:checked").val();
        }
        if ($("#client_cheque:checked").val()) {
            mop_cheque = $("#client_cheque:checked").val();
        }
        if ($("#client_rtgs:checked").val()) {
            mop_rtgs = $("#client_rtgs:checked").val();
        }
        if ($("#client_neft:checked").val()) {
            mop_neft = $("#client_neft:checked").val();
        }
        var formData = new FormData();

        formData.append('name', $("#client_name").val());
        formData.append('phone', $("#client_phone").val());
        formData.append('email', $("#client_email").val());
        formData.append('address', $("#client_address").val());
        formData.append('pincode', $("#client_pincode").val());
        formData.append('lat', $("#client_lat").val());
        formData.append('long', $("#client_long").val());
        formData.append('credit_limit', $("#client_creditLimit").val());
        formData.append('city_id', $("#client_city").val());
        formData.append('grade', $("#client_grade").val());
        formData.append('category', $("#client_category").val());
        formData.append('delivery_address', $("#client_delAddress").val());
        formData.append('credit_period', $("#client_creditPeriod").val());
        formData.append('delivery_slot', $("#client_delSlot").val());
        formData.append('avg_order', $("#client_avg_orders").val());
        formData.append('remarks', $("#client_remarks").val());
        formData.append('poc_name', $("#client_pocName").val());
        formData.append('poc_phone', $("#client_poc_ph").val());
        formData.append('designation', $("#client_poc_desig").val());
        formData.append('brand_name', $("#client_brand_name").val());
        formData.append('company_name', $("#client_cmpName").val());
        formData.append('mop_cash', mop_cash);
        formData.append('mop_rtgs', mop_rtgs);
        formData.append('mop_cheque', mop_cheque);
        formData.append('mop_neft', mop_neft);
        formData.append('pan_card', document.getElementById('client_pan').files[0]);
        formData.append('licence', document.getElementById('client_licence').files[0]);
        formData.append('aadhaar_card', document.getElementById('client_aadhaar').files[0]);
        formData.append('other_card', document.getElementById('client_other').files[0]);

        if ($("#clientForm input[type='checkbox']:checked").length == 0) {
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'Please Select atleast One Method of Payment!'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            $("#clientForm input[type='checkbox']").css({
                'outline': '1px solid red'
            });
        } else {
            swal({
                    title: "Are you sure ?",
                    text: "You want to add this Client!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    showLoaderOnConfirm: true,
                },
                function() {
                    $.ajax({
                        url: 'api/manage_clients/clients',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            //swal("Successfully added client!", "", "success");
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'Successfully added Client!',
                                timeout: 3000
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                            window.location.href = "clients";
                        },
                        error: function(error) {
                            //sweetAlert("Oops...", "Something went wrong!", "error");
                            var error_msg = JSON.stringify(error.responseJSON.errors);
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    });
                });
        }
        event.preventDefault(); // Prevent default posting of form
    }); //Add Client Function End
    /*End Add Client Function*/

    /*-------------------------------Start Clients Update Function-----------------------------------------------------------*/
    $('#c_save').click(function() {
        // var client_id=
        if ($("#c_status:checked").val() && $("#c_status:checked").val() == 'yes') {
            var status = 1;
        } else {
            var status = 0;
        }
        var mop_cash = "no";
        var mop_cheque = "no";
        var mop_rtgs = "no";
        var mop_neft = "no";
        if ($("#c_cash:checked").val()) {
            mop_cash = $("#c_cash:checked").val();
        }
        if ($("#c_cheque:checked").val()) {
            mop_cheque = $("#c_cheque:checked").val();
        }
        if ($("#c_rtgs:checked").val()) {
            mop_rtgs = $("#c_rtgs:checked").val();
        }
        if ($("#c_neft:checked").val()) {
            mop_neft = $("#c_neft:checked").val();
        }
        var formData = new FormData();
        formData.append('client_id', $(this).attr("data-id"));
        formData.append('name', $('#c_name').val());
        formData.append('status', status);
        formData.append('phone', $('#c_phone').val());
        formData.append('email', $('#c_email').val());
        formData.append('address', $('#c_address').val());
        formData.append('brand_name', $('#c_brand_name').val());
        formData.append('company_name', $('#c_cmpName').val());
        formData.append('credit_limit', $('#c_creditLimit').val());
        formData.append('credit_period', $('#c_creditPeriod').val());
        formData.append('delivery_address', $('#c_delAddress').val());
        formData.append('delivery_slot', $('#c_delSlot').val());
        formData.append('pincode', $('#c_pincode').val());
        formData.append('lat', $('#c_latitude').val());
        formData.append('long', $('#c_longitude').val());
        formData.append('grade', $('#c_grade').val());
        formData.append('category', $('#c_category').val());
        formData.append('poc_name', $('#c_pocName').val());
        formData.append('poc_phone', $('#c_poc_ph').val());
        formData.append('designation', $('#c_poc_desig').val());
        formData.append('mop_cash', mop_cash);
        formData.append('mop_cheque', mop_cheque);
        formData.append('mop_rtgs', mop_rtgs);
        formData.append('mop_neft', mop_neft);
        formData.append('city_id', $('#c_city').attr("data-value"));
        formData.append('pan_card', document.getElementById('c_pan').files[0]);
        formData.append('licence', document.getElementById('c_licence').files[0]);
        formData.append('aadhaar_card', document.getElementById('c_aadhaar').files[0]);
        formData.append('other_card', document.getElementById('c_other').files[0]);

        var isValid = true;
        $("#c_delSlot,#c_name,#c_phone,#c_address,#c_brand_name,#c_cmpName,#c_creditLimit,#c_creditPeriod,#c_delAddress,#c_pincode,#c_grade,#c_category,#c_pocName,#c_poc_ph,#c_poc_desig").each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border-bottom": "2px solid #ff4646",
                    "background": "#fff"
                });
            } else {
                $(this).css({
                    "border-bottom": "2px solid #299035",
                    "background": ""
                });
                setTimeout($.proxy(function() {
                    $(this).css({
                        "border": "",
                        "background": ""
                    });
                }, this), 2000);
            }
        });
        if (isValid == true) {
            swal({
                    title: "Are you sure ?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    showLoaderOnConfirm: true,
                },
                function() {
                    $.ajax({
                        url: 'api/manage_clients/update',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            //swal("Successfully Updated!");
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'Successfully Updated !',
                                timeout: 3000
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                            location.reload();
                        },
                        error: function(error) {
                            //sweetAlert("Oops...", "Something went wrong!", "error");
                            var error_msg = JSON.stringify(error.responseJSON.errors);
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    });
                });
        } else {
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'Please fill all input !'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
        // $('#c_save').hide();
    }); //End Client Upload Funciton
    /*------------X------------X----------End Clients Update Function------------X--------------X------------------------------*/

    /*------------------------------------Start Rate List Upload---------------------------------------------------------------*/
    $("#c_RatelistUpload").click(function(event) {
        var id = $(this).attr("data-id");
        var file = document.getElementById('c_ratelist').files[0];
        var formData = new FormData();

        formData.append('client_id', id);
        formData.append('rates', file);
        var isValid = true;
        $("#c_ratelist").each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border-bottom": "2px solid #ff4646",
                    "background": "#fff"
                });
            } else {
                $(this).css({
                    "border-bottom": "2px solid #299035",
                    "background": ""
                });
                setTimeout($.proxy(function() {
                    $(this).css({
                        "border": "",
                        "background": ""
                    });
                }, this), 2000);
            }
        });
        if (isValid == true) {
            $.ajax({
                url: 'api/manage_clients/upload_rate_list',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    swal("Successfully uploaded!", "", "success");
                    location.reload();
                },
                error: function(error) {
                    sweetAlert('Oops... ',error.responseJSON.data +'!' , "error");
                }
            });
        } else {
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'Please Select a file !'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
    });
    /*-------------X------------X---------End Rate List Upload--------------X-----------------X-------------------------------*/
    //RateList Edit->Edit
    $('table').on('click', '.c_rate_edit', function() {
        $(this).next().removeAttr('hidden');
        $(this).next().next().removeAttr('hidden');
        $(this).hide();
        $(this).parent().parent().children().eq(4).attr('hidden', 'true');
        $(this).parent().parent().children().eq(5).removeAttr('hidden');
        $(this).parent().parent().children().eq(6).attr('hidden', 'true');
        $(this).parent().parent().children().eq(7).removeAttr('hidden');
    }); //End RateList Edit

    //RateList Edit->Cancel
    $('table').on('click', '.c_rate_cancel', function() {
        $(this).attr('hidden', 'true');
        $(this).prev().attr('hidden', 'true');
        $(this).prev().prev().show();
        $(this).parent().parent().children().eq(5).attr('hidden', 'true');
        // $(this).parent().parent().children().eq(4).find('input').val('');
        $(this).parent().parent().children().eq(4).removeAttr('hidden');
        $(this).parent().parent().children().eq(7).attr('hidden', 'true');
        $(this).parent().parent().children().eq(6).removeAttr('hidden');
    }); //End RateList Edit->cancel
    /* ----------------------------- add new field for item items--------------------------------------*/
    $('#c_add_new_item').click(function() {
        $('.addItem').removeClass('hidden');
    });
    /* ---------------------------------end of adding field for  item--------------------*/
    /* ----------------------------- add new item --------------------------------------*/
    $('table').on('click', '.c_add_item', function() {
        var isValid = true;
        var notFound = true;
        var ele = $(this).parent().parent().children();
        var client_id = $(this).attr('client-id');
        var item_id = $(this).parent().parent().children().eq(1).children().children().attr('item-id');
        var price = $(this).parent().parent().children().eq(4).find('input').val();
        var period = $(this).parent().parent().children().eq(5).find('select').val();
        /*var is_there = searchClientDetails(client_id);
        for (var i = 0; i < is_there.rate_list.length; i++) {
          if(item_id == is_there.rate_list[i].item_id){notFound = false;}
        }*/
        if (notFound === true) {
            if ($.trim(ele.eq(1).find('input').val()) == '') {
                isValid = false;
                ele.eq(1).find('input').css({
                    "border-bottom": "2px solid #ff4646",
                    "background": "#fff"
                });
            } else {
                ele.eq(1).children().css({
                    'border-bottom': '1px #ccc',
                    "background": ""
                });
            }

            if ($.trim(ele.eq(4).find('input').val()) == '') {
                isValid = false;
                ele.eq(4).find('input').css({
                    "border-bottom": "2px solid #ff4646",
                    "background": "#fff"
                });
            } else {
                ele.eq(4).children().css({
                    'border-bottom': '1px #ccc',
                    "background": ""
                });
            }

            if (isValid == true) {
                swal({
                        title: "Are you sure ?",
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: true,
                        animation: "slide-from-top",
                        showLoaderOnConfirm: true,
                    },
                    function() {
                        $.ajax({
                            url: 'api/manage_clients/add_item_ratelist',
                            type: 'POST',
                            data: {
                                client_id: client_id,
                                item_id: item_id,
                                price: price,
                                period: period
                            },
                            success: function(response) {
                                var response = JSON.stringify(response);
                                //swal("Successfully Added!");
                                'use strict';
                                var snackbarContainer = document.querySelector('#demo-toast-example');
                                var data = {
                                    message: 'Successfully Added !',
                                    timeout: 3000
                                };
                                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                                location.reload();
                                return false;
                            },
                            error: function(error) {
                                //var error = JSON.parse(error.status);
                                //var error_msg = JSON.stringify(error.responseJSON.errors);
                                sweetAlert('Oops... ', 'Something went wrong', "error");
                            }
                        });
                    });
            } else {
                //swal({ title: "Please fill all the fields !", timer: 1000, showConfirmButton: false });
                'use strict';
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {
                    message: 'Please fill all the fields !',
                    timeout: 3000
                };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                return false;
            }
        } else {
            // swal({ title: "Item already in RateList.\nPlease update instead !!!", showConfirmButton: true });
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'Item already in Ratelist.\nPlease update instead !!!'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
    });
    /* ---------------------------------end of adding new item--------------------*/


    /*--------------------------------Single Upload General RateList-------------------------------------------------------*/
    $('table').on('click', '.c_rate_update', function() {
        var isValid = true;
        var client_id = $(this).attr('client-id');
        var item_id = $(this).attr('item-id');
        var price = $(this).parent().parent().children().eq(5).find('input').val();
        var period = $(this).parent().parent().children().eq(7).find('select').val();
        if ($.trim($(this).parent().parent().children().eq(5).find('input').val()) == '') {
            isValid = false;
            $(this).parent().parent().children().eq(5).find('input').css({
                "border-bottom": "2px solid #ff4646",
                "background": "#fff"
            });
        } else {
            $(this).parent().parent().children().eq(5).find('input').css({
                'border-bottom': 'none',
                "background": ""
            });
        }
        if ($.trim($(this).parent().parent().children().eq(7).find('select').val()) == '') {
            isValid = false;
            $(this).parent().parent().children().eq(7).find('select').css({
                "border-bottom": "2px solid #ff4646",
                "background": "#fff"
            });
        } else {
            $(this).parent().parent().children().eq(7).find('select').css({
                'border-bottom': 'none',
                "background": ""
            });
        }
        if (isValid == true) {
            swal({
                    title: "Are you sure ?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    animation: "slide-from-top",
                    showLoaderOnConfirm: true,
                },
                function() {
                    $.ajax({
                        url: 'api/manage_clients/single_upload_client_rates',
                        type: 'POST',
                        data: {
                            client_id: client_id,
                            item_id: item_id,
                            price: price,
                            period: period,
                        },
                        success: function(response) {
                            var response = JSON.stringify(response);
                            //swal("Successfully Updated!");
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'Successfully Updated !'
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                            location.reload();
                        },
                        error: function(error) {
                            var error_msg = JSON.stringify(error.responseJSON.errors);
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    });
                });
        } else {
            // swal({ title: "Please fill all the fields !", timer: 1000, showConfirmButton: false });
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'Please fill all the fields !'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
    });

    // item autofill 
    $('#add_item_name').on('input', function(e) {
        var $selector = $(this).next().next().next().children(), //ul element
            text = $(this).val(),
            typeCode = 1;
        if (text.length >= 3) {
            $selector.parent().removeClass('hidden');
            itemSearch(text, typeCode, $selector);
        } else {
            $selector.parent().addClass('hidden');
        }

    }).on('blur', function(e) {
        var $selector = $(this).next().next().next().children();
        var itemName = $(this).attr('value');
        var itemId = $(this).attr('item-id');
        var text = $(this).val(),
            typeCode = 1;
        row = $selector.parent().parent().parent().parent(); //tr
        row.children().eq(1).children().children().eq(0).attr('item-id', itemId);

        searchItemName(text, typeCode, itemId).success(function(response) {
            var response_data = JSON.parse(JSON.stringify(response));
            for (var j = 0; j < response_data.data.data.items.length; j++) {
                if (response_data.data.data.items[j].item_name == itemName) {
                    row.children().eq(2).children().children().eq(0).val(response_data.data.data.items[j].alternate_name);
                    row.children().eq(3).children().children().eq(0).val(uom_array[response_data.data.data.items[j].uom]);
                }
                /*else if(itemName == result.alternate_name){
                               row.children().eq(2).children().children().eq(0).val(result.item_name);
                               row.children().eq(3).children().children().eq(0).val(uom_array[result.uom]);
                            }*/
            }
        });
    });

}); //Document Ends Here