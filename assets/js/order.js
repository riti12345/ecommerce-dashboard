$(document).ready(function() {
    var has_items = [],
        has_single_items = [],
        rateList, itemsData, status, orderId,
        statusDelete = ['delete', 'undo'],
        history = [],
        today = [];
/*----------------------------view order page start----------------------------------------*/
function displayCard(offset, tab) {
        $.ajax({
            url: 'api/manage_orders/load_orders',
            type: 'POST',
            data: {
                offset: offset,
                tab: tab,
            },
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                var orders = response.data;
                // card display
                orders.forEach(function(Index, i) {
                    status = orders[i].status;
                    orderId = orders[i].id;
                    var clone = $(".orderCardEmpty").clone();
                    var date = new Date(orders[i].delivery_date);
                    var d = date.getDate();
                    var m = date.getMonth();
                    m += 1; // JavaScript months are 0-11
                    var y = date.getFullYear();
                    var superScript;

                    if (d == 1 || d == 31) {superScript = 'st';} else if (d == 2 || d == 22) {superScript = 'nd';} else if (d == 3 || d == 23) { superScript = 'rd';} else {superScript = 'th';
                    }
                    if (tab == 1) {
                        clone.removeClass('orderCardEmpty').addClass('orderCardCloned1').removeClass('hidden');
                    }
                    if (tab == 2) {
                        clone.removeClass('orderCardEmpty').addClass('orderCardCloned2').removeClass('hidden');
                    }
                    if (orders[i].delivery_date >= currentDate && orders.length > 0 && (orders[i].status == 0 || orders[i].status == 1 || orders[i].status == 2 || orders[i].status == 4 || orders[i].status == 3 || orders[i].status == 5)) {
                        $('.no_orders').addClass('hidden');
                        $('.show_more_today').removeClass('hidden');
                        $('div .order').append(clone);
                        today.push(orders[i]);
                    } else {
                        $('.no_history').addClass('hidden');
                        $('.show_more_hist').removeClass('hidden');
                        $('div .history').append(clone);
                        history.push(orders[i]);
                    }
                    var retailer = (orders[i].client.category == 6) ? 'R' : 'H';
                    clone.children().attr('data-id', orders[i].id);
                    clone.children().children().eq(0).children().append(orders[i].client.name);
                    clone.children().children().eq(1).children().eq(0).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                    clone.children().children().eq(1).children().eq(1).append(orders[i].delivery_date);
                    clone.children().children().eq(2).children().append(orderId);
                    if ((orders[i].invoice_id) !== null){
                        if(orders[i].delivery_date <= '2017-03-31'){
                            clone.children().children().eq(3).children().append(retailer+(1000000+parseInt(orders[i].invoice_id))+'/'+(date.getFullYear()-1)+'-'+(date.getYear()-100));
                        }else{
                            clone.children().children().eq(3).children().append(retailer+(parseInt(orders[i].invoice_id))+'/'+(date.getFullYear())+'-'+(date.getYear()-99));
                        }    
                    }else{
                        clone.children().children().eq(3).hide();
                    }
                    clone.children().children().eq(4).children().eq(0).attr('href', 'orderInfo?id=' + orderId + '&request=dashboard').attr('id', 'infoTool' + orderId);
                    clone.children().children().eq(4).children().eq(0).children().eq(1).attr('for', 'infoTool' + orderId);
                    clone.children().children().eq(4).children().eq(2).append(status_array[orders[i].status]);
                    clone.children().children().eq(4).children().eq(1).attr('data-id', orderId).attr('id', 'print' + orderId + '').addClass('print_invoice');
                    clone.children().children().eq(4).children().eq(1).children().eq(1).attr('for', 'print' + orderId + '');
                    clone.children().children().eq(5).children().attr('data-id', orderId).addClass('track_order');
                    clone.children().children().eq(5).children().attr('href', 'trackVehicle?id=' + orderId + '&client_id=' + orders[i].client.id + '&client_name=' + orders[i].client.name + '&request=dashboard');
                    clone.children().children().eq(5).find('i').attr('id', 'track' + orderId);
                    clone.children().children().eq(5).find('div').attr('for', 'track' + orderId);
                    if (orders[i].status <= 0) {
                        clone.children().children().eq(4).children().eq(1).prop('disabled', true).css({
                            "color": "#B2DFDB"
                        });
                    }

                    // List view/ table view 
                    var tRowClone = $('.orderTrowEmpty').clone();
                    tRowClone.removeClass('orderTrowEmpty').addClass('orderTrowCloned').removeClass('hidden');

                    tRowClone.children().eq(0).children().attr('href', 'orderInfo?id=' + orderId + '&request=dashboard').attr('id', 'infoTool' + orders);
                    tRowClone.children().eq(0).children().children().eq(1).attr('for', 'infoTool' + orders);
                    tRowClone.children().eq(1).append(orderId);
                    tRowClone.children().eq(2).append(orders[i].client.name);
                    tRowClone.children().eq(3).append(orders[i].client.poc);
                    tRowClone.children().eq(4).append(orders[i].client.poc_contact);
                    tRowClone.children().eq(5).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                    tRowClone.children().eq(6).append(orders[i].total_price);
                    tRowClone.children().eq(7).append(orders[i].delivery_date);
                    if (orders[i].delivery_date >= currentDate && orders.length > 0 && (orders[i].status == 0 || orders[i].status == 1 || orders[i].status == 2 || orders[i].status == 4 || orders[i].status == 3 || orders[i].status == 5)) {
                        $('.orderTbody').append(tRowClone);
                    } else {
                        $('.orderTbody_history').append(tRowClone);
                    }
                    if(document.getElementById('view_card_search')){
                       //$('div .searchResultCard').append(clone);
                       $('.orderTableEmpty').parent().addClass('hidden');
                    }else if(document.getElementById('view_list_search')){
                        //$('div .searchResultList').append(tRowClone);
                        $('.orderCardCloned1 ,.orderCardCloned2').addClass('hidden');
                    }
                    
                }); //End View Item Cards       
                // }, 1000);
            },
            error: function(xhr, status, error) {
                // var error = JSON.parse(error.status);
                // var err = eval("(" + xhr.responseText + ")");
                if (xhr.status == 404) {
                    var error_msg = xhr.responseJSON.error;
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: error_msg
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);

                    if (today.length == 0 && tab == 1) {
                        // $('div .order').append(
                        //  '<div class="mdl-card-status mdl-shadow--2dp">'+
                        //          '<p><i class="material-icons status_icon">error</i><p>'+
                        //  '<p><h3> No Orders ! <br> <br> Take Rest for a while.</h3></p>'+
                        //  '</div>');
                        $('.no_orders').removeClass('hidden');
                        $('.show_more_today').addClass('hidden');
                        $('.order_view_icon').hide();
                    }
                    if (history.length == 0 && tab == 2) {
                        // $('div .history').append(
                        //  '<div class="mdl-card-status mdl-shadow--2dp">'+
                        //          '<p><i class="material-icons status_icon">history</i><p>'+
                        //  '<p><h3> No History.<br> <br> Take an order to create some.</h3></p>'+
                        //  '</div>');
                        $('.no_history').removeClass('hidden');
                        $('.show_more_hist').addClass('hidden');
                        $('.history_view_icon').hide();
                    }
                    return false;
                }
            }
        });
    }

    if (window.location.pathname == '/os/order') {
    // setTimeout(function(){  displayCard(0,1); }, 500);
    $(window).load(function() {
        displayCard(0, 1);
    });
    }
    $('.tab_1').one('click', function() {
        displayCard($(".orderCardCloned1").length, 1);
    });
    $('.tab_2').one('click', function() {
        displayCard(0, 2);
    });
    $('.show_more_today').on('click', function() {
        var offset = $(".orderCardCloned1").length;
        displayCard(offset, 1);
    });
    $('.show_more_hist').on('click', function() {
        var offset = $(".orderCardCloned2").length;
        displayCard(offset, 2);
    });
    /*if(today == 0){
	$('div .order').append(
	'<div class="mdl-card-status mdl-shadow--2dp">'+
    	'<p><i class="material-icons status_icon">error</i><p>'+
	'<p><h3> No Orders ! <br> <br> Take Rest for a while.</h3></p>'+
	'</div>');
        $('.order_view_icon').hide();
    }else{
    	$('.show_more_today').removeClass('hidden');
    }
	if(history == 0){
	$('div .history').append(
	'<div class="mdl-card-status mdl-shadow--2dp">'+
    	'<p><i class="material-icons status_icon">history</i><p>'+
	'<p><h3> No History.<br> <br> Take an order to create some.</h3></p>'+
	'</div>');
    	$('.history_view_icon').hide();
	}else{
    	$('.show_more_hist').removeClass('hidden');
    }*/
    //Append list view and grid view 
    $('.list_view').click(function() {
        $('.grid_view ,.print_view').removeClass('hidden');
        $('.list_view').addClass('hidden');
        $('.orderTableEmpty').parent().removeClass('hidden');

        $('.orderCardCloned1 ,.orderCardCloned2 ,.orderCardEmpty ').attr('id','');
        $('.orderTbody,.orderTbody_history').attr('id','view_list_search');
        $('div .searchResultList').removeClass('hidden');
        $('div .searchResultCard').addClass('hidden');
        if ($('.tab_1')) {
            $('.orderCardCloned1').addClass('hidden');
        }
        if ($('.tab_2')) {
            $('.orderCardCloned2').addClass('hidden');
        }

    });

    $('.grid_view').click(function() {
        $('.grid_view ,.print_view').addClass('hidden');
        $('.list_view').removeClass('hidden');
        $('.orderTableEmpty').parent().addClass('hidden');
        $('.orderTbody,.orderTbody_history').attr('id','');
        $('.orderCardCloned1 ,.orderCardCloned2').attr('id','view_card_search');
        $('div .searchResultList').addClass('hidden');
        $('div .searchResultCard').removeClass('hidden');
        if ($('.tab_1')) {
            $('.orderCardCloned1').removeClass('hidden');
        }
        if ($('.tab_2')) {
            $('.orderCardCloned2').removeClass('hidden');
        }
    });
    // card search 
    $("#view_order_search").donetyping(function() {
        var text = $.trim($(this).val()).toLowerCase();
        if (text.length > 0) {
            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(function() {
                $.ajax({
                    url: 'api/manage-orders/search',
                    type: 'POST',
                    data: {
                        q: text
                    },
                    success: function(response) {
                        var response = JSON.parse(JSON.stringify(response));
                        //console.log(response.data[0]);
                        $('.dynamic_search').removeClass('hidden');
                        $('.mdl-layout__tab-bar ,.show_more_hist ,.show_more_today,.page-content').addClass('hidden');
                        for (var i = 0; i < response.data.length; i++) {
                            status = response.data[i].status;
                            orderId = response.data[i].id;
                            var clone = $(".orderCardEmpty").clone();
                            clone.removeClass('orderCardEmpty').removeClass('hidden');
                            $('div .searchResultCard').append(clone);
                            var date = new Date(response.data[i].delivery_date);
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
                            var retailer = (response.data[i].client.category == 6) ? 'R' : 'H';
                            clone.children().attr('data-id', response.data[i].id);
                            clone.children().children().eq(0).children().append(response.data[i].client.name);
                            clone.children().children().eq(1).children().eq(0).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                            clone.children().children().eq(1).children().eq(1).append(response.data[i].delivery_date);
                            clone.children().children().eq(2).children().append(orderId);
                            if ((response.data[i].invoice_id) !== null){
                                if(response.data[i].delivery_date <= '2017-03-31'){
                                    clone.children().children().eq(3).children().append(retailer+(1000000+parseInt(response.data[i].invoice_id))+'/'+(date.getFullYear()-1)+'-'+(date.getYear()-100));
                                }else{
                                    clone.children().children().eq(3).children().append(retailer+(parseInt(response.data[i].invoice_id))+'/'+(date.getFullYear())+'-'+(date.getYear()-99));
                                }    
                            }else{
                                clone.children().children().eq(3).hide();
                            }
                            clone.children().children().eq(4).children().eq(0).attr('href', 'orderInfo?id=' + orderId + '&request=dashboard').attr('id', 'infoTool' + i);
                            clone.children().children().eq(4).children().eq(0).children().eq(1).attr('for', 'infoTool' + i);
                            clone.children().children().eq(4).children().eq(2).append(status_array[response.data[i].status]);
                            clone.children().children().eq(4).children().eq(1).attr('data-id', orderId).attr('id', 'print' + i).addClass('print_invoice');
                            clone.children().children().eq(4).children().eq(1).children().eq(1).attr('for', 'print' + i);
                            clone.children().children().eq(5).children().attr('data-id', orderId).attr('id', 'track' + i).addClass('track_order');
                            clone.children().children().eq(5).children().attr('href', 'trackVehicle?id=' + orderId + '&client_id=' + response.data[i].client.id + '&client_name=' + response.data[i].client.name + '&request=dashboard').attr('id', 'infoTool' + i);
                            clone.children().children().eq(5).children().children().eq(1).attr('for', 'track' + i);
                            if (response.data[i].status <= 0) {
                                clone.children().children().eq(4).children().eq(1).prop('disabled', true).css({
                                    "color": "#B2DFDB"
                                });
                            }
                            // List view/ table view 
                            var tRowClone = $('.orderTrowEmpty').clone();
                            tRowClone.removeClass('orderTrowEmpty').addClass('orderTrowCloned').removeClass('hidden');
                            $('div .searchResultList').append(tRowClone);
                            
                            tRowClone.children().eq(0).children().attr('href', 'orderInfo?id=' + orderId + '&request=dashboard').attr('id', 'infoTool' + i);
                            tRowClone.children().eq(0).children().children().eq(1).attr('for', 'infoTool' + i);
                            tRowClone.children().eq(1).append(orderId);
                            tRowClone.children().eq(2).append(response.data[i].client.name);
                            tRowClone.children().eq(3).append(response.data[i].client.poc);
                            tRowClone.children().eq(4).append(response.data[i].client.poc_contact);
                            tRowClone.children().eq(5).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                            tRowClone.children().eq(6).append(response.data[i].total_price);
                            tRowClone.children().eq(7).append(response.data[i].delivery_date);
                            if(document.getElementById('view_card_search')){
                               
                            }else if(document.getElementById('view_list_search')){
                                $('div .searchResultList').append(tRowClone);
                                
                            }
                        }
                        //$('.searchResult').empty();
                    },
                    error: function(xhr, status, error) {
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
            $('.searchResultCard , .searchResultList').empty();
            $(this).data('timer', wait);
        }
    });

    $('#dynamic_div_close').on('click', function() {
        $('.dynamic_search').addClass('hidden');
        $('.page-content ,.mdl-layout__tab-bar ,.show_more_today , .show_more_hist').removeClass('hidden');
        $('.searchResultCard , .searchResultList').empty();
    });

    // search by date 
    $(".date_search_order,date_search_order_history").on('click', function() {
        var text = $(this).val();
        var card = $(".orderCardCloned");
        var row = $(".orderTrowCloned");
        var input;
        $.each(card, function(index, data) {
            input = $(this).children().children().eq(2).children().eq(1).text();
            (input == text) ? $(this).hide(): $(this).show();
            //(!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeInUp hinge").show() : $(this).fadeOut(100).hide(100) ;
        });

        $.each(row, function(index, data) {
            input = $(this).children().eq(7).text();
            (input == text) ? $(this).hide(): $(this).show();
        });
    });

    /*-----------------------------Add order page start------------------------------------------*/

    // manual order screen
    $(".mdl_button_manual").click(function() {
        var isValid = true;
        var date = new Date($('#datepicker').val());
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

        $("#searchClient,#datepicker").each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({
                    "border-bottom": "2px solid #ff4646",
                    "background": "#fff"
                }).addClass('blink');
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
            $(this).change(function() {
                if ($.trim($(this).val()) !== '') {
                    $(this).css({
                        "border": "",
                        "background": ""
                    }).removeClass('blink');
                } else {
                    $(this).css({
                        "border-bottom": "2px solid #ff4646",
                        "background": "#fff"
                    }).addClass('blink');
                }
            });
        });
        if (isValid == true) {

            $(".selectItemScreen, .search-hide").removeClass('hidden');
            $('.clientScreen').addClass('hidden');
            $('.title > h5 ').html("Manual Order");
            $('.breadcrumb >a:nth-child(2)').addClass('active');
            $('.client-name').html($('#searchClient').attr('value'));
            $('.del-date').html(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
        } else {
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'please fill all input !'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
    });

    //back button
    $(".btn-back-manual").click(function() {
        swal({
                title: "Are you sure ?",
                text: "You will lose all data!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                showLoaderOnConfirm: false,
            },
            function() {
                $(".clonedRow").remove();
                $(".addOrderScreen,.search-hide,.selectItemScreen,.createOrderScreen").addClass('hidden');
                $(".clientScreen, #searchClient").removeClass('hidden');
                $('.breadcrumb >a:nth-child(2)').removeClass('active');
                $('#searchClient').val('').attr('value', '');
                $('#searchClient').next().addClass('hidden');
                $('#searchClient').next().children().eq(0).text('');
                var elem = $('#selectOrderItem').next().children();
                mdlActionClose(elem);
                var row = $('.select_item_row');
                row.children().eq(0).nextUntil(6).find('input').val('').focus();
                $('#datepicker').val('');
                has_items.length = 0;
            });
    });

    // client autofill 
    $('body').delegate('#searchClient', 'input', function(e) {
        var $selector = $(this).next().next().next().children(), // ul element
            text = $(this).val(),
            json = [],
            clientCode = '';
        if (text.length >= 3) {
            $selector.parent().removeClass('hidden');
            $.ajax({
                url: 'api/manage-clients/search',
                type: 'POST',
                data: {q   : text ,type:1},
                success: function(response){
                    var response = JSON.parse(JSON.stringify(response));
                    for (var i = 0; i < response.data.length; i++) {
                        json.push(response.data[i].name);
                        if (json[i] != null) {
                            clientCode += '<li class="" value="' + json[i] + '" id="' + response.data[i].id + '">' + json[i] + '</li>';
                        }
                    }
                    $selector.html(clientCode);
                    $selector.children().eq(0).addClass('selected');
                    $selector.children().on('mousedown', function(e) {
                        e.preventDefault();
                    }).on('click', function() {
                        var name = $(this).attr('value');
                        $(this).parent().parent().prev().prev().prev().attr('data-id', $('.selected').attr('id')).attr('value', $('.selected').attr('value'));
                        $(this).parent().parent().prev().prev().removeClass('hidden');
                        $(this).parent().parent().prev().prev().children().eq(0).html($('.selected').attr('value'));
                        $(this).parent().parent().prev().prev().prev().addClass('hidden');
                        $(this).parent().parent().addClass('hidden');
                        $(this).parent().empty();
                        $(this).removeClass('selected');
                    });

                    $('body').click(function() {
                        $selector.parent().addClass('hidden');
                    });

                    $selector.children().on('mouseover', function() {
                        $selector.children().removeClass('selected');
                        $(this).addClass('selected');
                        //console.log($('.selected').text());
                    });
                    //$('.searchResult').empty();
                },
                error: function(xhr, status, error) {}
            });
        } else {
            $selector.parent().addClass('hidden');
            return false;
        }
    });

    // item autofill 
    $('#selectOrderItem').on('input', function(e) {
        var $selector = $(this).next().next().next().children(), //ul element
            text = $(this).val(),
            typeCode = 1;
        if(text.length >= 3) {
            $selector.parent().removeClass('hidden');
            itemSearch(text, typeCode, $selector);
        } else {
            $selector.parent().addClass('hidden');
        }
    }).on('blur', function(e) {
        var itemName = $(this).attr('value');
        var itemId = $(this).attr('item-id');
        var client_id = $('#searchClient').attr('data-id'),
            uom;
        var text = $(this).val(),
            typeCode = 1;
        row = $('.select_item_row'); //tr
        var sku_select = $('#sku');
        var option = '';
        searchItemName(text, typeCode, itemId).success(function(response) {
            var response_data = JSON.parse(JSON.stringify(response));
            for (var j = 0; j < response_data.data.data.items.length; j++) {
                if (response_data.data.data.items[j].id == itemId) {
                    var skuData = response_data.data.data.items[j].sku;
                    uom = response_data.data.data.items[j].uom;
                    var sku, sku_id;
                    //searchItemName(text , typeCode ,id);
                    $.each(skuData, function(key, value) {
                        option += '<option sku_id="' + key + '" value="' + value + '">' + value + '</option>';
                    });
                    row.children().eq(4).find('input').val(uom_array[uom]).attr('data-uom', uom_array[uom]);
                }
            }
            sku_select.html(option);
        });
        /*var sku = $(this).attr('sku_id');
        	row.children().eq(2).find('input').attr('sku-id',sku);*/
        row.children().eq(3).find('input').val('').focus();
        row.children().eq(5).find('input').val('');
        if (text.length >= 3) {
            $.ajax({
                url: "api/manage-clients/item_rates",
                method: 'POST',
                data: {
                    client_id: client_id,
                    item_id: itemId
                },
                success: function(response) {
                    var response = JSON.parse(JSON.stringify(response)).data;
                    var row = $('.select_item_row'); 
                    if(response[0].price == 0){
                        var dialog = document.querySelector('dialog');
                        dialog.showModal();
                            $('#get_general_rate').on('click',function(){
                                $.ajax({
                                url: "api/manage-clients/item_general_rates",
                                method: 'POST',
                                data: {
                                    item_id: itemId
                                },
                                success:function(response){
                                    var response1 = JSON.parse(JSON.stringify(response)).data;
                                    dialog.close();
                                    row.children().eq(5).find('input').attr('value', response1[0].price);
                                    row.children().eq(5).find('input').val(response1[0].price);
                                },
                                error:function(error){
                                    console.log(error.responseJSON.error);
                                }
                            });
                        });
                            
                    }else{
                        row.children().eq(5).find('input').attr('value', response[0].price);
                        row.children().eq(5).find('input').val(response[0].price);
                    }
                },
                error: function(data) {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: data.responseJSON.error +'!',
                        timeout: 1000
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    return false;
                }
            });
        }
    });
    $('#order-dialog-close').on('click',function(){
        var dialog = document.querySelector('dialog');
        dialog.close();
        $('#selectOrderItem, #units,#uom, #rate ,#comment').val('');
        $('#selectOrderItem').removeClass('hidden');
        $('#selectOrderItem').next().addClass('hidden');
        $('#sku').find(':selected').val('');
        $('#rate').attr('value', '');
        $('.select_item_row').children().eq(1).find('input').attr('value', '').attr('item-id', '');
        setTimeout(function() {
            $('#selectOrderItem').focus();
        }, 250);
    });
    /*$('#sku').on('click',function(){
    	row = $('.select_item_row'); //tr
    	var sku = $(this).attr('sku_id');
    	//row.children().eq(2).find('input').attr('sku-id',sku).val($(this).attr('value'));
    });*/
    //append add order row
    $('#appendItems').on('click', function() {
        var total_price = 0;
        var ind_price;
        var ind_unit;
        var price = [];
        if ($('#rate').attr('value') != 0) {
            var isValid = true;
            $("#selectOrderItem,#sku,#units,#rate").each(function() {
                if ($.trim($(this).val()) == '') {
                    isValid = false;
                    $(this).css({
                        "border-bottom": "2px solid #ff4646",
                        "background": "#fff"
                    }).addClass('blink');
                } else {
                    $(this).css({
                        "border-bottom": "2px solid #299035",
                        "background": ""
                    }).removeClass('blink');
                    setTimeout($.proxy(function() {
                        $(this).css({
                            "border": "",
                            "background": ""
                        });
                    }, this), 2000);
                }
                $(this).change(function() {
                    if ($.trim($(this).val()) !== '') {
                        $(this).css({
                            "border": "",
                            "background": ""
                        }).removeClass('blink');
                    } else {
                        $(this).css({
                            "border-bottom": "2px solid #ff4646",
                            "background": "#fff"
                        }).addClass('blink');
                    }
                });
            });

            if (isValid == true) {
                if ($.inArray($('#selectOrderItem').attr('item-id'), has_items) == -1) {
                    $(".addOrderScreen").removeClass('hidden');
                    //var $li =$(this).parent().parent().children().eq(1).children().children().eq(2).children().children();
                    var tRow = $('.order-item').clone();
                    tRow.removeClass('order-item').addClass('clonedRow').removeClass('hidden');
                    $('.tbody').prepend(tRow);
                    tRow.children().eq(1).find('input').attr('item-id', $('#selectOrderItem').attr('item-id')).val($('#selectOrderItem').attr('value'));
                    has_items.push($('#selectOrderItem').attr('item-id'));
                    tRow.children().eq(2).find('input').attr('sku-id', $('#sku').find(":selected").attr('sku_id')).val($('#sku').find(":selected").attr('value'));
                    tRow.children().eq(3).find('input').attr('value', $('#units').val()).val($('#units').val());
                    tRow.children().eq(4).find('input').attr('value', $('#uom').attr('data-uom')).val($('#uom').attr('data-uom'));
                    tRow.children().eq(5).find('input').attr('value', $('#rate').val()).val($('#rate').val());
                    tRow.children().eq(6).find('input').attr('value', $('#comment').val()).val($('#comment').val());
                    ind_unit = tRow.children().eq(3).find('input').val();
                    ind_price = tRow.children().eq(5).find('input').val();

                    // empty input row
                    $('#selectOrderItem, #units, #rate ,#comment').val('');
                    $('#selectOrderItem').removeClass('hidden');
                    $('#selectOrderItem').next().addClass('hidden');

                    $('#rate').attr('value', '');
                    $('.select_item_row').children().eq(1).find('input').attr('value', '').attr('item-id', '');
                    setTimeout(function() {
                        $('#selectOrderItem').focus();
                    }, 250);
                } else {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: 'Item Already Added !'
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    return false;
                }
            } else {
                'use strict';
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {
                    message: 'Please fill all input !',
                    timeout: 1000
                };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                return false;
            }
        } else {
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'We can not add this item !',
                timeout: 1000
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
    });

    // find items in table
    $('#add_order_search').on('keyup', function(e) {
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        var tRow = $('.clonedRow');
        var confirm_tRow = $('.pre_order_cloned');
        $.each(tRow, function(index, data) {
            var input = $(this).children().eq(1).children().children().eq(0).val(),
                textL = $.trim(input).toLowerCase().replace(/ +/g, '');
            (!~textL.indexOf(text) == 0) ? $(this).show(): $(this).hide();
        });
        $.each(confirm_tRow, function(index, data) {
            var input = $(this).children().eq(1).text(),
                textL = $.trim(input).toLowerCase().replace(/ +/g, '');
            (!~textL.indexOf(text) == 0) ? $(this).show(): $(this).hide();
        });
    });
    // back button confirm
    $(".btn-back-confirm").click(function() {
        swal({
                title: "Are you sure ?",
                text: "",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                showLoaderOnConfirm: false,
            },
            function() {
                $(".addOrderScreen,.createOrderScreen").addClass('hidden');
                $('.addOrderScreen ,.selectItemScreen').removeClass('hidden');
                $('.breadcrumb >a:nth-child(3)').removeClass('active');
                $('.pre_order_cloned').remove();
                item_id = [];
                item_sku_id = [];
                units = [];
                comment = [];
            });
    });

    // remove  add order row
    $('table').on('click', '.add-order-row-remove', function() {
        var element = $(this);
        var delete_item = element.parent().parent().children().eq(1).find('input').attr('item-id');
        if ($.inArray(delete_item, has_items) !== -1) { //Deleting item from has_items array
            delete has_items[$.inArray(delete_item, has_items)];
        }
        swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: false
            },
            function() {
                element.parent('td').parent('tr').remove();
                swal("Deleted!", "removed.", "success");
            });
    });

    // edit add_order row 
    $('table').on('click', '.add-order-row-edit', function() {
        $('#edit_unit').addClass('blink');
        $(this).parent().parent().children().eq(3).find('input').removeAttr('readonly').removeClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(1).addClass('hidden');
        $(this).parent().children().eq(2).removeClass('hidden');
        $(this).parent().children().eq(3).removeClass('hidden');
    });

    // update add_order row
    $('table').on('click', '.add-order-row-done', function() {
        $(this).parent().parent().children().eq(3).find('input').addClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(3).addClass('hidden');
        $(this).parent().children().eq(0).removeClass('hidden');
        $(this).parent().children().eq(1).removeClass('hidden');
    });

    // reset add_order row
    $('table').on('click', '.add-order-row-cancel', function() {
        $('#edit_unit').removeClass('blink');
        $(this).parent().parent().children().eq(3).find('input').addClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(2).addClass('hidden');
        $(this).parent().children().eq(0).removeClass('hidden');
        $(this).parent().children().eq(1).removeClass('hidden');
    });

    // post request manual order
    var client_id;
    var item_id = [];
    var item_sku_id = [];
    var units = [];
    var delivery_date;
    var data = {};
    var comment =[];
    // preorder post request
    $('.createManualOrder').on('click', function() {
        delivery_date = $('#datepicker').val();
        var rows = $('.clonedRow');
        var client_id = $('#searchClient').attr('data-id');
        var order_reference = $('#order_ref').val();
        $(rows).each(function(index) {
            item_id.push($(this).children().eq(1).children().children().eq(0).attr('item-id'));
            item_sku_id.push($(this).children().eq(2).children().children().eq(0).attr('sku-id'));
            units.push($(this).children().eq(3).children().children().eq(0).val());
            comment.push($(this).children().eq(6).children().children().eq(0).val());
        });

        data = {
            client_id: client_id,
            item_id: item_id,
            item_sku_id: item_sku_id,
            units: units,
            delivery_date: delivery_date,
            comment:comment,
            order_reference:order_reference
        };
        //console.log(data);
        $.ajax({
            url: 'api/manage-orders/pre-orders',
            type: 'POST',
            data: data,
            beforeSend: function() {
                $('.createManualOrder').attr('disabled', true);
            },
            complete: function() {
                $('.createManualOrder').attr('disabled', false);
            },
            success: function(response) {
                $('.breadcrumb >a:nth-child(3)').addClass('active');
                $('.createOrderScreen').removeClass('hidden');
                $('.addOrderScreen ,.selectItemScreen').addClass('hidden');
                var preOrder = JSON.parse(JSON.stringify(response));
                preOrder.order.forEach(function(index, p) {
                    preOrder.order[p].items.forEach(function(index, i) {
                        var clone = $('.pre_order').clone();
                        clone.removeClass('hidden').removeClass('pre_order').addClass('pre_order_cloned');
                        $('.pre_order_body').append(clone);

                        var name = preOrder.order[p].items[i].item_name;
                        clone.children().eq(1).html(name);
                        clone.children().eq(2).html(1);
                        clone.children().eq(3).html(preOrder.order[p].items[i].units);
                        //clone.children().eq(4).html(preOrder.order[p].items[i].uom);
                        clone.children().eq(4).html(preOrder.order[p].items[i].price);
                        clone.children().eq(5).html(preOrder.order[p].items[i].comment);
                    });
                    $('tfoot').children().children().eq(1).html('<b>Total : </b>' + preOrder.order[p].total_price);
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
    });

    // confirm order post request
    $('.confirmManualOrder').on('click', function() {
        swal({
                title: "Are you sure ?",
                text: "You want to Confirm the Order!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
            },
            function() {
                $.ajax({
                    url: 'api/manage-orders/orders',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        $('.breadcrumb >a:nth-child(4)').addClass('active');
                        'use strict';
                        var snackbarContainer = document.querySelector('#demo-toast-example');
                        var data = {
                            message: 'Order Successfull !',
                            timeout: 3000
                        };
                        snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        window.location.href = "order";
                    },
                    error: function(xhr, status, error) {
                        var error_msg = xhr.responseJSON.error;
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
    });

    /*.---------------------------------order info page start------------------------------------*/
    // find item in order info 
    $('#order_info_search').on('keyup', function() {
        var tRow = $('.order_info_row').siblings();
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        $.each(tRow, function(index, data) {
            var input = $(this).children().eq(1).text(),
                textL = $.trim(input).toLowerCase().replace(/ +/g, '');
            //console.log(input);
            (!~textL.indexOf(text) == 0) ? $(this).show(): $(this).hide();
        });
    });

    // remove  add order row
    $('table').on('click', '.order_row_remove', function() {
        var element = $(this);
        var delete_item = element.parent().parent().children().eq(1).find('input').attr('item-id');
        if ($.inArray(delete_item, has_items) !== -1) { //Deleting item from has_items array
            delete has_items[$.inArray(delete_item, has_items)];
        }
        swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: false
            },
            function() {
                element.parent('td').parent('tr').remove();
                swal("Deleted!", "removed.", "success");
            });
    });



    // Edit and Update order Info action button event start
    var initial_rate, initial_item_id, initial_quantity, initial_total_price, initial_item_price, order_id;

    // edit_row pencil button
    $('table').on('click', '.order-info-row-edit', function() {
        var data_item_id = $(this).parent().attr('data-item-id');
        $('.show_class' + data_item_id).addClass('hidden');
        $('.hidden_class' + data_item_id).removeClass('hidden');
        $('#quantity').addClass('blink');
        $('.hidden_class' + data_item_id).find('input').css({
            "border-bottom": "2px solid #ff4646"
        });

        initial_quantity = $(this).parent().parent().children().eq(5).find('input').attr('value');
        var name = $(this).parent().parent().children().eq(2).find('input').attr('value');
        order_id = $(this).parent('td').parent().parent().parent().attr('data-order-id');
        initial_total_price = $('.total_price' + order_id).attr('data-value');
        var clientName = $(this).parent().attr('data-value');
        initial_item_price = $(this).parent().parent().children().eq(8).find('input').attr('value');

        initial_rate = initial_item_price / initial_quantity;

        $(this).parent().parent().children().eq(2).find('input').attr('data-id', data_item_id);
        $(this).parent().parent().children().eq(12).find('input').attr('value', initial_rate).val(initial_rate);

        var sku_select = $('.edit_sku_order_info');
        sku_select.attr('disabled', true);
        var option = '';
        searchItemName(name, 1, data_item_id).success(function(response) {
            var response_data = JSON.parse(JSON.stringify(response));
            if (data_item_id == response_data.data.data.items[j].id) {
                for (var j = 0; j < response_data.data.data.items.length; j++) {
                    var skuData = response_data.data.data.items[j].sku;
                    var sku, sku_id;
                    //console.log(skuData);
                    $.each(skuData, function(key, value) {
                        option += '<option data-id="' + key + '" value="' + value + '">' + value + '</option>';
                    });
                }
            }
            sku_select.html(option);
        });

        /*var clientRateList = searchClientRateList(data_item_id,clientName);
	var generalRateList = searchGeneralRateList(data_item_id);
	   	if (clientRateList == undefined) {
                initial_rate = generalRateList.price;
	        $(this).parent().parent().children().eq(10).find('input').attr('value',initial_rate).val(initial_rate);
	       
	    }else{
	    	initial_rate = clientRateList.price;
	        $(this).parent().parent().children().eq(10).find('input').attr('value',initial_rate).val(initial_rate);
	    }*/
    });

    // edit_row cancel button
    $('table').on('click', '.order-info-row-cancel', function() {
        var data_item_id = $(this).parent().attr('data-item-id');
        $('.hidden_class' + data_item_id).addClass('hidden');
        $('.show_class' + data_item_id).removeClass('hidden');
        $('#quantity').removeClass('blink');
    });

    // edit_row save button post request
    $('table').on('click', '.order-info-row-done', function() {
        var element = $(this);
        var data_item_id = $(this).parent().attr('data-item-id');
        var name = $(this).parent().parent().children().eq(2).find('input').attr('value');
        var orders_items_id = $(this).attr('data-id'),
            item_id = $(this).parent().parent().children().eq(2).find('input').attr('data-id'),
            sku_id = $('.edit_sku_order_info').find(":selected").attr('data-id'),
            quantity = $(this).parent().parent().children().eq(5).find('input').val();
        // price = $(this).parent().parent().children().eq(8).children().children().eq(0).attr('value');
        var rateOfItem;
        rateOfItem = $(this).parent().parent().children().eq(12).find('input').attr('value');
        
        //console.log(initial_item_price);
        var priceOfItem = 1 * quantity * rateOfItem;
        var final_price = parseFloat(initial_total_price) + (parseFloat(priceOfItem) - parseFloat(initial_item_price));
        var comment = $(this).parent().parent().children().eq(10).find('input').val();

        //console.log(quantity ,priceOfItem,final_price);
        data = {
            orders_items_id: orders_items_id,
            item_id: item_id,
            sku_id: sku_id,
            quantity: quantity,
            price: priceOfItem,
            comment : comment
        };
        swal({
                title: "Are you sure ?",
                text: "Want to update this item!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                showLoaderOnConfirm: false,
            },
            function() {
                $('.hidden_class' + data_item_id).addClass('hidden');
                $('.show_class' + data_item_id).removeClass('hidden');
                $.ajax({
                    url: 'api/Manage_orders/orders_update',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        response = JSON.stringify(response);
                        $('.total_price' + order_id).html('<b>Total Price</b>: &#8377;' + parseFloat(final_price));
                        $('.total_price' + order_id).attr('data-value', parseFloat(final_price));
                        $('.tfoot_total_price' + order_id).html(parseFloat(final_price));
                        $('#quantity' + data_item_id).html(quantity);
                        $('#quantity' + data_item_id).next().find('input').attr('value', quantity);
                        $('#price' + data_item_id).html(priceOfItem);
                        $('#price' + data_item_id).next().find('input').attr('value', priceOfItem);
                        $('#comments' + data_item_id).html(comment);
                        $('#comments' + data_item_id).next().find('input').attr('value', comment);
                        'use strict';
                        var snackbarContainer = document.querySelector('#demo-toast-example');
                        var data = {
                            message: 'Updated Successfully !'
                        };
                        snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        //location.reload();
                    },
                    error: function(xhr, status, error) {
                        var error_msg = xhr.responseJSON.error;
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
    });

    // edit_row delete button post request 
    $('table').on('click', '.order-info-row-delete', function() {
        var id = [];
        var element = $(this),
            status = $(this).attr('data-status');

        id.push($(this).attr('data-id'));
        order_id = $(this).parent('td').parent().parent().parent().attr('data-order-id');
        initial_total_price = $('.total_price' + order_id).attr('data-value');
        initial_item_price = $(this).parent().parent().children().eq(8).find('input').attr('value');
        var final_price;
        if (status == 0) {
            final_price = parseFloat($('.total_price' + order_id).attr('data-value')) - parseFloat(initial_item_price);
            //console.log('delete'+final_price);
        } else {
            final_price = parseFloat($('.total_price' + order_id).attr('data-value')) + parseFloat(initial_item_price);
        }
        var data = {
            order_items_id: id,
        };
        swal({
                title: "Are you sure ?",
                text: "",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                showLoaderOnConfirm: false,
            },
            function() {
                $.ajax({
                    url: 'api/manage-orders/items_cancel',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        $('.total_price' + order_id).html('<b>Total Price</b>: &#8377;' + final_price);
                        $('.total_price' + order_id).attr('data-value', final_price);
                        $('.tfoot_total_price' + order_id).html(parseFloat(final_price));
                        element.children('.material-icons').html($(this).attr('data-status') == 0 ? statusDelete[1] : statusDelete[0]);
                        element.attr('data-status', $(this).attr('data-status') == 0 ? 1 : 0);
                        if (status == 0) {
                            element.prev().removeClass('hidden');
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'removed successfully !'
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        } else {
                            element.prev().addClass('hidden');
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'undo successfully !'
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        }
                        //location.reload();
                    },
                    error: function(xhr, status, error) {
                        var error_msg = xhr.responseJSON.error;
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
    });

    // Order cancel  post request 
    $("#order_cancel").on('click', function() {
        var id = $(this).parent().attr('data-order-id');
        var element = $(this);
        data = {
            orders_id: id,
        };
        swal({
                title: "Do you want to cancel the order ? ",
                text: "Are you sure ?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: 'api/manage-orders/orders_cancel',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        setTimeout(function() {
                            element.addClass('hidden');
                            swal("Deleted !", "Order canceled !", "success");
                            window.location.href = 'order';
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        var error_msg = xhr.responseJSON.error;
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
    });

    // print invoice
    $("body").delegate(".print_invoice", "click", function() {
        var id = $(this).attr('data-id');
        $('.invoice_content').empty();
        // $('.order_discount').removeAttr('hidden');
        $('#add_discount').attr('data-id',$(this).attr('data-id'));
        $.ajax({
            url: 'api/invoice',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $('.invoice_content').append(response);
                // var demo_nv = document.getElementsByClassName('.invoice_content');
                var dialog = document.querySelector('dialog');
                dialog.showModal();
                // setTimeout(function(){ window.print(); }, 500);
                /* Or dialog.show(); to show the dialog without a backdrop. */


                // var win=window.open('about:blank');
                //  win.document.write(response);

            }
        });
    });
    
    $('#dialog-close').click(function() { dialog.close(); });
    /*====================================Function To Print INVOICE IN BULK====================================*/
    $("body").delegate(".print_bulk_invoice", "click", function() {
        // var id = $(this).attr('data-id');
        $('.invoice_content').empty();
        var start_date = $('#datepicker1').val();
        var end_date = $('#datepicker2').val();
        var client_id = $('#searchClient').attr('data-id');
        if (typeof(client_id) == "undefined") {
            client_id = null;
        }
        $.ajax({
            url: 'api/invoice_bulk',
            type: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
                client_id: client_id,
            },
            success: function(response) {
                var win = window.open('about:blank');
                win.document.write(response);
                // $('.invoice_content').append(response);
                // var dialog = document.querySelector('dialog');
                // dialog.showModal();
                // $('#dialog-close').click(function() {
                //   dialog.close();
                // });
            }
        });
    });
    //=======================Add single item in order info page =======================================//

    $('#order_newitem').on('click', function() {
        $('.order_item').removeClass('hidden');
        $('.addItem').removeClass('hidden');
        $(".card-details").addClass('hidden');
        $('#order_item').focus();
    });

    $('table').delegate('.order_addcancel', 'click', function() {
        $('.order_item').addClass('hidden');
        $('.addItem').addClass('hidden');
        $(".card-details").removeClass('hidden');
        has_items.length = 0;
        $('#order_item,#order_units,#order_rate').val('');
    });

    // item autofill    
    $('#order_item').on('input', function(e) {
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
        var itemName = $(this).attr('value');
        var itemId = $(this).attr('item-id');
        var client_id = $('.addItem').attr('data_value');
        var text = $(this).val();
        typeCode = 1;

        var row = $('.addItem'); //tr
        var sku_select = $('#order_sku');
        var option = '';

        searchItemName(text, typeCode, itemId).success(function(response) {
            var response_data = JSON.parse(JSON.stringify(response));
            for (var j = 0; j < response_data.data.data.items.length; j++) {
                if (response_data.data.data.items[j].id == itemId) {
                    var skuData = response_data.data.data.items[j].sku;
                    var sku, sku_id;
                    var uom = response_data.data.data.items[j].uom;

                    $.each(skuData, function(key, value) {
                        option += '<option sku_id="' + key + '" value="' + value + '">' + value + '</option>';
                    });
                    row.children().eq(4).find('input').val(uom_array[uom]);
                }
            }
            sku_select.html(option);
        });

        row.children().eq(3).find('input').val('').focus();
        row.children().eq(5).find('input').val('');

        if (text.length >= 3) {
            $.ajax({
                url: "api/manage-clients/item_rates",
                method: 'POST',
                data: {
                    client_id: client_id,
                    item_id: itemId
                },
                success: function(response) {
                    var response = JSON.parse(JSON.stringify(response)).data;
                    //console.log(response[0].price);
                    row.children().eq(5).find('input').attr('value', response[0].price);
                    row.children().eq(5).find('input').val(response[0].price);
                },
                error: function(data) {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: 'Oops something went wrong !',
                        timeout: 1000
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    return false;
                }
            });
        }
    });

    $('.order_additem').on('click', function() {
        var Item_sku_id = [];
        var Item_id = [];
        var Units = $("#order_units").val();
        var Rate = $("#order_rate").val();
        var row = $('.addItem');
        var Order_track_id = $('.addItem').attr('data-order-id');
        var Client_id = $('.addItem').attr('data_value');
        var comments = $('#order_comment').val();

        if ($('#order_rate').attr('value') != 0) {
            var isValid = true;

            $("#order_item,#order_sku, #order_units,#order_rate").each(function() {
                if ($.trim($(this).val()) == '') {
                    isValid = false;
                    $(this).css({
                        "border-bottom": "2px solid #ff4646",
                        "background": "#fff"
                    }).addClass('blink');
                } else {
                    $(this).css({
                        "border-bottom": "2px solid #299035",
                        "background": ""
                    }).removeClass('blink');
                    setTimeout($.proxy(function() {
                        $(this).css({
                            "border": "",
                            "background": ""
                        });
                    }, this), 2000);
                }
                $(this).change(function() {
                    if ($.trim($(this).val()) !== '') {
                        $(this).css({
                            "border": "",
                            "background": ""
                        }).removeClass('blink');
                    } else {
                        $(this).css({
                            "border-bottom": "2px solid #ff4646",
                            "background": "#fff"
                        }).addClass('blink');
                    }
                });
            });

            if (isValid == true) {
                $('.order_info_row').each(function() {
                    has_single_items.push($(this).children().eq(2).find('input').attr('data_item_id'));
                });

                if ($.inArray($('#order_item').attr('item-id'), has_single_items) == -1) {
                    $(row).each(function(index) {
                        Item_id = $(this).children().eq(1).find('input').attr('item-id');
                        Item_sku_id = $(this).children().eq(2).find(':selected').attr('sku_id');
                    });

                    $.ajax({
                        url: 'api/manage_orders/single_item_add',
                        type: 'POST',
                        data: {
                            order_track_id: Order_track_id,
                            client_id: Client_id,
                            item_id: Item_id,
                            item_sku_id: Item_sku_id,
                            units: Units,
                            comment:comments
                        },
                        success: function(response) {
                            var response = JSON.parse(JSON.stringify(response));
                            console.log(response.data);
                            var tRow = $('.order_addtRow').clone();
                            tRow.removeClass('order_addtRow').addClass('order_addtRow_clonedRow').removeClass('hidden');
                            $.each(tRow, function(Index, data) {
                                $(this).children().eq(1).find('input').attr('item-id', $('#order_item').attr('item-id')).val($('#order_item').attr('value'));
                                has_single_items.push($(this).children().eq(1).find('input').attr('item-id'));
                                $(this).children().eq(2).find('input').attr('sku-id', $('#order_sku').find(":selected").attr('sku_id')).val($('#order_sku').find(":selected").attr('value'));
                                $(this).children().eq(3).find('input').attr('value', $('#order_units').val()).val($('#order_units').val());
                                $(this).children().eq(4).find('input').attr('value', $('#order_uom').val()).val($('#order_uom').val()).attr('data-rate', $('#order_rate').val());
                                $(this).children().eq(5).find('input').attr('value', (parseFloat($('#order_units').val()) * parseFloat($('#order_rate').val()))).val(parseFloat($('#order_units').val()) * parseFloat($('#order_rate').val()));
                                $(this).children().eq(6).find('input').attr('value', $('#order_comment').val()).val($('#order_comment').val());
                                $(this).children().eq(7).children().eq(1).attr('data-id', response.data.id);
                                $(this).children().eq(7).children().eq(3).attr('data-id', response.data.id);
                            });

                            $('.order_info_body').append(tRow);
                            $("#order_item,#order_rate,#order_units,#order_uom").val('');
                            $('#order_item').removeClass('hidden').attr('data-id', '').attr('value', '');
                            $('#order_item').next().addClass('hidden');
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'Item Successfully Added!',
                                timeout: 3000
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                             $('#order_item').focus();
                        },
                        error: function(xhr, status, error) {
                            var error_msg = xhr.responseJSON.error;
                            sweetAlert("Oops...", error_msg, "error");
                        }
                    });
                } else {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: 'Item Already Added !'
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                    return false;
                }
            } else {
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {
                    message: '"Please fill all input!"',
                    timeout: 3000
                };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                return false;
            }
        } else {
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: '"We can not add this item !"',
                timeout: 3000
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
    });

    // Order edit_row pencil button
    $('table').on('click', '.new_edit', function() {
        $('#edit_addunits').addClass('blink');
        $(this).next().removeAttr('hidden');
        $(this).next().next().removeAttr('hidden');
        $(this).next().next().next().attr('hidden', 'true');
        $(this).hide();
        $(this).parent().parent().children().eq(3).find('input').removeAttr('readonly').removeClass('mdl-textfield__input_border').removeClass('mdl-textfield__input_border');
        $(this).parent().parent().children().eq(6).find('input').removeAttr('readonly').removeClass('mdl-textfield__input_border').removeClass('mdl-textfield__input_border');
    });


    //Order Edit->cancel
    $('table').on('click', '.new_edit_cancel', function() {
        $(this).attr('hidden', 'true');
        $(this).prev().attr('hidden', 'true');
        $(this).next().removeAttr('hidden');
        $(this).prev().prev().show();
        $(this).parent().parent().children().eq(3).find('input').attr('readonly', 'true').addClass('mdl-textfield__input_border').addClass('mdl-textfield__input_border');
        $(this).parent().parent().children().eq(6).find('input').attr('readonly', 'true').addClass('mdl-textfield__input_border').addClass('mdl-textfield__input_border');
    });

    //Order Edit->Add
    $('table').on('click', '.new_add', function() {
        $(this).attr('hidden', 'true');
        $(this).next().next().removeAttr('hidden');
        $(this).next().attr('hidden', 'true');
        $(this).prev().show();
        $(this).parent().parent().children().eq(3).find('input').attr('readonly', 'true').addClass('mdl-textfield__input_border').addClass('mdl-textfield__input_border');

        var element = $(this);
        var order_item_id = $(this).attr('data-id');
        var items_id = $(this).parent().parent().children().eq(1).find('input').attr('item-id');
        var sKu_id = $(this).parent().parent().children().eq(2).find('input').attr('sku-id');
        var unit = parseFloat($(this).parent().parent().children().eq(3).find('input').val());
        var rateofItem = parseFloat($(this).parent().parent().children().eq(4).find('input').attr('data-rate'));
        var priceofItem = 1 * unit * rateofItem;
        var comments = $(this).parent().parent().children().eq(6).find('input').attr('value');

        data = {
            orders_items_id: order_item_id,
            item_id: items_id,
            sku_id: sKu_id,
            quantity: unit,
            price: priceofItem,
            comment:comments
        };

        swal({
                title: "Are you sure ?",
                text: "Want to update this item!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                showLoaderOnConfirm: false,
            },
            function() {

                $.ajax({
                    url: 'api/Manage_orders/orders_update',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        response = JSON.stringify(response);
                        $('.order_addtRow_clonedRow').children().eq(5).children().find('input').attr('value', priceofItem);
                        
                        'use strict';
                        var snackbarContainer = document.querySelector('#demo-toast-example');
                        var data = {
                            message: 'Updated Successfully !'
                        };
                        snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        //location.reload();
                    },
                    error: function(xhr, status, error) {
                        var error_msg = xhr.responseJSON.error;
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
    });
    // remove  add order row
    $('table').on('click', '.order_newremove', function() {
        var element = $(this);
        var delete_item = element.parent().parent().children().eq(1).find('input').attr('item-id');
        if ($.inArray(delete_item, has_single_items) !== -1) { //Deleting item from has_single_items array
            delete has_single_items[$.inArray(delete_item, has_single_items)];
        }
        swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: false
            },
            function() {
                element.parent('td').parent('tr').remove();
                swal("Deleted!", "removed.", "success");
            });
    });

    //=======================end of Add single item in order info page =======================================//

    // search filter for client ratelist by item id
    /*window.searchClientRateList = function(id ,name){
	//var clientName = $('#searchClient').attr('value');
	var client_data = searchClientId(name);
	        var clientId = client_data.id;
	        var rate = client_data.rate_list;
	        obj = rate.filter(function(obj) {
            return obj.item_id === id;
        })[0];
         	//console.log(obj);
        	return obj;
    }

    window.searchGeneralRateList = function(id){
    	obj = generalRates.filter(function(obj)
    	{ 
    	return obj.item_id === id;
    	})[0];
        	//console.log(obj);
        	return obj;
    };*/

    /*-----------------------------------On Scroll Append (ORDER)Cards----------------------------*/
    // (function () {
    //     var previousScroll = 0;
    //     $('.mdl-layout__content').scroll(function () {
    // 	var w_height = $('.mdl-layout__content').height();
    // 	var currentScroll = $(this).scrollTop();
    // console.log($(this).scrollTop() + $(this).innerHeight(),$(this)[0].scrollHeight);
    // if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
    //console.log(window.location.pathname);

    //   });
    // }());//Scroll FNC END

    // Invoice Report
	$('#invoice_type').on('change',function(){
	    if($(this).val() == 1){
	        $('#invoice_submit').removeClass('print_bulk_invoice');
	        // $('#datepicker2').parent().removeClass('hidden');
	        $('#invoice_submit').addClass('report_submit');
    	}
	    if($(this).val() == 2){
	        $('#invoice_submit').removeClass('report_submit');
	        $('#invoice_submit').addClass('print_bulk_invoice');
	        // $('#datepicker2').parent().addClass('hidden');
	     }
	});
	
	$("body").delegate(".report_submit", "click", function() {
	    var client_id  = $('#searchClient').attr('data-id');
	    var start_date = $('#datepicker1').val();
	    var end_date   = $('#datepicker2').val();	
	    $('.invoice_content').empty();

	    $.ajax({
	        url: 'api/manage_orders/invoice_report',
	        type: 'POST',
	        data:{ 
	            client_id  : client_id ,
	            start_date : start_date,
	            end_date   : end_date 
	        },
	        success: function(response){
	            var win = window.open('about:blank');
                win.document.write(response);
	            // setTimeout(function(){

	            // $('.invoice_content').append(response);
               	// var demo_nv = document.getElementsByClassName('.invoice_content');
                // var dialog = document.querySelector('dialog');
                //  dialog.showModal();
	          	// setTimeout(function(){ window.print(); }, 500);
	          	/* Or dialog.show(); to show the dialog without a backdrop. */
	            //   $('#dialog-close').click(function() {
	            //      dialog.close();
	            //   });
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

    // Add Discount to Orders
    $("body").delegate("#add_discount", "click", function() {
        var order_id       = $(this).attr('data-id');
        var invoice_id     = $('.invoice_class').attr('data-invoice');
        var total          = $('.invoice_class').attr('data-total');
        var discount_type  = $('#discount_type').val();
        var discount_value = $('#discount_value').val();

        if($('#discount_value').val() == 0){
            $('.set_discount').addClass('hidden');
        }
        if($('#discount_value').val() > 0){
            $('.set_discount').removeClass('hidden');
        }
    // console.log('order_id:'+order_id,'invoice_id:'+invoice_id,'total:'+total,'discount_type:'+discount_type,'discount_value:'+discount_value );
        $.ajax({
            url: 'api/manage_orders/orders_discount',
            type: 'POST',
            data: {
                order_id       : order_id,
                invoice_id     : invoice_id,
                total          : total,
                discount_type  : discount_type,
                discount_value : discount_value,

            },
            success: function(response) {
                    var response_data = JSON.parse(JSON.stringify(response)).data;
                    console.log(response_data);
                    alert('Discount Applied Successfully!!!');
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = { message: 'Discount Applied Successfully!!!'};
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);

                    $('#append_discount').html('Discount : '+response_data.discount);
                    $('#append_rupees').html('<b> Rupees : '+response_data.rupees+'</b>');
                    $('#append_total').html('<b> Grand Total INR &emsp;'+response_data.total+'</b>');
            },
            error:function (xhr, status, error) {
                    alert(JSON.parse(xhr.responseText).error);
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
            },
        });
    });

    // Employee autofill 
    $('body').delegate('#searchEmployee', 'input', function(e) {
        var $selector = $(this).next().next().next().children(), // ul element
            text = $(this).val(),
            json = [],
            clientCode = '';
        if (text.length >= 3) {
            $selector.parent().removeClass('hidden');
            $.ajax({
                url: 'api/Manage_employee/search',
                type: 'POST',
                data: {q   : text },
                success: function(response){
                    var response = JSON.parse(JSON.stringify(response));
                    for (var i = 0; i < response.data.length; i++) {
                        json.push(response.data[i].name);
                        if (json[i] != null) {
                            clientCode += '<li class="" value="' + json[i] + '" id="' + response.data[i].id + '">' + json[i] + '</li>';
                        }
                    }
                    $selector.html(clientCode);
                    $selector.children().eq(0).addClass('selected');
                    $selector.children().on('mousedown', function(e) {
                        e.preventDefault();
                    }).on('click', function() {
                        var name = $(this).attr('value');
                        $(this).parent().parent().prev().prev().prev().attr('data-id', $('.selected').attr('id')).attr('value', $('.selected').attr('value'));
                        $(this).parent().parent().prev().prev().removeClass('hidden');
                        $(this).parent().parent().prev().prev().children().eq(0).html($('.selected').attr('value'));
                        $(this).parent().parent().prev().prev().prev().addClass('hidden');
                        $(this).parent().parent().addClass('hidden');
                        $(this).parent().empty();
                        $(this).removeClass('selected');
                    });

                    $('body').click(function() {
                        $selector.parent().addClass('hidden');
                    });

                    $selector.children().on('mouseover', function() {
                        $selector.children().removeClass('selected');
                        $(this).addClass('selected');
                        //console.log($('.selected').text());
                    });
                    //$('.searchResult').empty();
                },
                error: function(xhr, status, error) {}
            });
        } else {
            $selector.parent().addClass('hidden');
            return false;
        }
    });
    
    $('#order_type').on('change',function(){
        if($(this).val() == 1){
            $(".search_client").addClass('hidden');
            $(".search_employee").removeClass('hidden');
        }
        if($(this).val() == 2){
            $(".search_employee").addClass('hidden');
            $(".search_client").removeClass('hidden');
        }
    });

});//DOCUMENT ENDS HERE