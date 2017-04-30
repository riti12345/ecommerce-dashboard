$(document).ready(function() {
    var has_items = [];
    var has_process_items = [];
    var monthArray = ["", "Jan", "Feb", "March", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
    var markets_names = new Array("");
    var market_names_id = [];
    var market;
    var manager_names = new Array("");
    var items_array = new Array();
    var items_names = new Array(); //var inv_status = {"status":{},"inw_quan":{}};
    var items_uom = new Array();
    var inv_status = {};
    var disp_items = new Array();
    var inv_disable = new Array("", "disabled");
    var vendor_names = [];
    var vendor_names_id = [];
    var onspot_vendor_names = new Array("None");
    var inward = [], processing = [], processed = [], history = [], inward_hist = [] , return_inward =[] , return_inward_hist = [];
    var wastage_today=[],wastage_history=[];
    //  for (i = 0; i<allItems.data.items.length;  i++){            
    //     items_array[i] = allItems.data.items[i];
    //     items_names[i] = allItems.data.items[i].item_name;
    //     items_uom[i] = allItems.data.items[i].uom;
    //  }
    // for (i = 0; i < allVendors.length; i++) {
    //              //   optionVendor += '<option class="vendor" value="' +allVendors[i].name + '" data-vendor-id="' + allVendors[i].id + '">';
    //              //   $(this).attr('data-vendor-id', allVendors[i].id);
    //                vendor_names[allVendors[i].id] = allVendors[i].name;
    //                vendor_names_id[allVendors[i].name] = allVendors[i].id;
    //                 arrayRateList = allVendors[i].rate_list;
    //              }
    /*--------------------------appending assignee for crates---------------------------------------*/
    $.get("api/manage-team/team/line_manager", function(data) {
        deliveryTeam = JSON.parse(JSON.stringify(data)).data;
        for (var i = 0; i < deliveryTeam.length; i++) {
            $('.assignee_append').append('<option value=' + deliveryTeam[i].id + '>' + deliveryTeam[i].username + '</option>');
        }
    });

    $.get("api/manage-markets/markets", function(data) {
        markets = JSON.parse(JSON.stringify(data));
        var optionMarket = '';
        for (i = 0; i < markets.data.length; i++) {
            optionMarket += '<option class="market" value="' + markets.data[i].name + '" data-item-id="' + markets.data[i].id + '" >';
            $(this).attr('data-item-id', markets.data[i].id);
            markets_names.push(markets.data[i].name);
            market_names_id[markets.data[i].name] = markets.data[i].id;
        }
        $('.MarketList').html(optionMarket);

        function searchMarket(market) {
            var obj = markets.data.filter(function(obj) {
                return obj.name === market;
            })[0];
            return obj;
        }

        $('#market_id').on('input', function() {
            var market = this.value;
            var search = searchMarket(market);
            var id = search.id;
            $(this).attr('data-id', id);
        });
        return markets_names;
    });

    $.get("api/manage_vendors/onspotVendors", function(data) {
        var onpspot = JSON.stringify(data);
        var onspot_array = JSON.parse(onpspot);
        for (i = 0; i < onspot_array.data.vendors.length; i++) {
            onspot_vendor_names[onspot_array.data.vendors[i].id] = onspot_array.data.vendors[i].name;
        }
        return onspot_vendor_names;
    });

    $.get("api/manage_vendors/onspotVendors", function(data) {
        var onpspot = JSON.stringify(data);
        var onspot_array = JSON.parse(onpspot);
        for (i = 0; i < onspot_array.data.vendors.length; i++) {
            onspot_vendor_names[onspot_array.data.vendors[i].id] = onspot_array.data.vendors[i].name;
        }
        return onspot_vendor_names;
    });

    if (window.location.pathname == '/os/inward') {
        displayInwardCard(0, 1);
    }
    $('.inward_tab_1').one('click', function() {
        displayInwardCard($(".inwardCloned1").length, 1);
        console.log($(".inwardCloned1").length);
    });
    $('.inward_tab_2').one('click', function() {
        displayInwardCard(0, 2);
    });
    //generate proc cards for inventory inward
    function displayInwardCard(offset, tab) {
        // $("#inward-cards").ready(function(){
        // var team_id =''; 
        $.ajax({
            url: 'api/manage_inventory/inward_cards/offset/' + offset + '/limit/' + 12 + '/tab/' + tab,
            type: 'GET',
            success: function(response) {
                var proc_data = JSON.parse(JSON.stringify(response)).data;
                var cr = 0;
                // proc_data.sort(function (a, b) {
                //   var vA= a.id;
                //     var vB= b.id;
                //     var n = vB-vA;
                //     return n;
                // });
                proc_data.forEach(function(Index, i) {
                    var date = new Date(proc_data[i].procure_date);
                    var d = date.getDate();
                    var m = date.getMonth();
                    m += 1; // JavaScript months are 0-11
                    var y = date.getFullYear();
                    var superScript;
                    // alert(proc_data[i].assignee_id);
                    if (d == 1 || d == 31) {
                        superScript = 'st';
                    } else if (d == 2 || d == 22) {
                        superScript = 'nd';
                    } else if (d == 3 || d == 23) {
                        superScript = 'rd';
                    } else {
                        superScript = 'th';
                    }

                    var card = $('.inventory-card-template').clone(true, true);
                    if (tab == 1) {
                        card.removeClass('inventory-card-template hide').addClass('inwardCloned1');
                        $('.show_more').removeClass('hidden');
                    }
                    if (tab == 2) {
                        card.removeClass('inventory-card-template hide').addClass('inwardCloned2');
                        $('.show_more_hist').removeClass('hidden');
                    }
                    var foundNames = $.grep(proc_data[i].data, function(v) {
                        // return v.status == 1 || v.status == 4;
                        return v.proc_item_status >= 0;
                    });
                    var leftItems = $.grep(proc_data[i].data, function(v) {
                        // return v.status == 1 || v.status == 4;
                        return v.proc_item_status < 5;
                    });
                    // inward.push(proc_data[i]);
                    var count = foundNames.length;
                    card.children().children().eq(0).children().eq(0).append(proc_data[i].id);
                    card.children().children().eq(1).children().eq(0).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                    card.children().children().eq(2).append(count);
                    card.children().children().eq(3).append(leftItems.length);
                    card.children().children().eq(4).children().eq(0).attr('href', 'inwardInfo?tid=' + null + '&uid=' + proc_data[i].id);
                    card.children().children().eq(4).children().eq(0).attr('id', 'infoTool' + i);
                    card.children().children().eq(4).children().eq(1).attr('for', 'infoTool' + i);
                    if (proc_data[i].procure_date >= currentDate) {
                        $('#inward-cards').append(card);
                        $('.no_inwards').addClass('hidden');
                        inward.push(proc_data[i]);
                    } else {
                        $('#history-cards').append(card);
                        $('.no_inwards_hist').addClass('hidden');
                        inward_hist.push(proc_data[i]);
                    }
                });
                // if(inward.length == 0){
                //   $('div #inward-cards').append('<h3>Nothing !</h3>');
                // }
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
                    if (inward.length == 0 && tab == 1) {
                        $('.no_inwards').removeClass('hidden');
                    }
                    if (inward_hist.length == 0 && tab == 2) {
                        $('.no_inwards_hist').removeClass('hidden');
                    }
                    return false;
                }
            },
        });
    }
    $('.show_more').on('click', function() {
        var offset = $(".inwardCloned1").length;
        displayInwardCard(offset, 1);
    });
    $('.show_more_hist').on('click', function() {
        var offset = $(".inwardCloned2").length;
        displayInwardCard(offset, 2);
    });
    // card search 
    $("#view_inward_search").donetyping(function(e) {
        var text = $(this).val();
        if (text.length > 0) {
            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(function() {
                $.ajax({
                    url: 'api/manage-inventory/inward_search',
                    type: 'POST',
                    data: {
                        q: text
                    },
                    success: function(response) {
                        var proc_data = JSON.parse(JSON.stringify(response)).data;
                        $('.dynamic_search').removeClass('hidden');
                        $('.mdl-layout__tab-bar ,.show_more, .show_more_hist ,.page-content').addClass('hidden');

                        var cr = 0;
                        proc_data.sort(function(a, b) {
                            var vA = a.id;
                            var vB = b.id;
                            var n = vB - vA;
                            return n;
                        });
                        proc_data.forEach(function(Index, i) {
                            var date = new Date(proc_data[i].procure_date);
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

                            var card = $('.inventory-card-template').clone(true, true);
                            card.removeClass('inventory-card-template hide').removeClass('hidden');

                            var foundNames = $.grep(proc_data[i].data, function(v) {
                                // return v.status == 1 || v.status == 4;
                                return v.proc_item_status >= 0;
                            });
                            var leftItems = $.grep(proc_data[i].data, function(v) {
                                // return v.status == 1 || v.status == 4;
                                return v.proc_item_status < 5;
                            });
                            $('.searchResult').append(card);
                            // inward.push(proc_data[i]);
                            var count = foundNames.length;
                            card.children().children().eq(0).children().eq(0).append(proc_data[i].id);
                            card.children().children().eq(1).children().eq(0).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                            card.children().children().eq(2).append(count);
                            card.children().children().eq(3).append(leftItems.length);
                            card.children().children().eq(4).children().eq(0).attr('href', 'inwardInfo?tid=' + proc_data[i].assignee_id + '&uid=' + proc_data[i].id);
                            card.children().children().eq(4).children().eq(0).attr('id', 'infoTool' + i);
                            card.children().children().eq(4).children().eq(1).attr('for', 'infoTool' + i);
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
            $('.searchResult').empty();
            $(this).data('timer', wait);
        }
    });

    // inward info search 
    $("#inward_info_search").on('keyup', function(e) {
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        var tRow = $(".inward-info-row");
        var input;
        $.each(tRow, function(index, data) {
            input = $.trim($(this).children().eq(0).text()).toLowerCase().replace(/ +/g, '');
            (!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeIn hinge").show(): $(this).fadeOut(100).hide(100);
        });
    });

    // search items in salable info
    $("#salable_info_search").on('keyup', function(e) {
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        var tRow = $(".salable-info-row");
        var input;
        $.each(tRow, function(index, data) {
            input = $.trim($(this).children().eq(0).text()).toLowerCase().replace(/ +/g, '');
            (!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeIn hinge").show(): $(this).fadeOut(100).hide(100);
        });
    });

    // search items in Raw info 
    $("#raw_info_search").on('keyup', function(e) {
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        var tRow = $(".raw-info-row");
        var input;
        $.each(tRow, function(index, data) {
            input = $.trim($(this).children().eq(0).text()).toLowerCase().replace(/ +/g, '');
            (!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeIn hinge").show(): $(this).fadeOut(100).hide(100);
        });
    });

    //Single Item Entry(INWARD)
    $("body").delegate('.inward_add', "click", function() {
        var ele = $(this);
        if ($(this).attr('disabled') == 'disabled') {
            return false;
        } else {
            var procure_id = new Array();
            var inward_quantity = new Array();
            var order_id = new Array();
            var t = 0;
            var formData = new FormData;

            item_id = $(this).parent().parent().children().eq(0).attr('item-id');
            procure_id[t] = $(this).attr('data-proc');
            inward_quantity[t] = $(this).parent().parent().children().eq(4).find('input').val();
            if ($.trim($(this).parent().parent().children().eq(4).find('input').val()) == '' && ($(this).parent().parent().children().eq(4).find('input').attr('data-status') == 0) && ($(this).parent().parent().children().eq(4).find('input').attr('proc-status') == 1 || $(this).parent().parent().children().eq(4).find('input').attr('proc-status') == 4)) {
                $(this).parent().parent().children().eq(4).find('input').css({
                    "border-bottom": "2px solid #ff4646",
                    "background": "#fff"
                });
                swal({
                    title: "please fill all input !",
                    timer: 1000,
                    showConfirmButton: false
                });
                return false;
            } else {
                formData.append('procure_id[]', procure_id[t]);
                formData.append('inward_quantity[]', inward_quantity[t]);
            }
            swal({
                    title: "Are you sure ?",
                    text: "click ok and confirm!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    showLoaderOnConfirm: true,
                },
                function() {
                    $.ajax({
                        url: 'api/Manage_inventory/inward',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var response = JSON.stringify(response);
                            setTimeout(function() {
                                swal("Successfully Updated!");
                                // location.reload();
                                ele.attr('disabled', true);
                                ele.parent().parent().children().eq(3).text(ele.parent().parent().children().eq(4).find('input').val()).removeAttr('hidden');
                                ele.parent().parent().children().eq(4).hide();
                            }, 1000);
                        },
                        error: function(error) {
                            var error_msg = JSON.stringify(error.responseJSON.errors);
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    }); //Ajax End
                });

        }
    }); //End Single Item

    //Raw Edit
    $('table').on('click', '.raw_edit', function() {
        $(this).next().removeAttr('hidden');
        $(this).next().next().removeAttr('hidden');
        $(this).hide();
        // $(this).parent().parent().children().eq(0).attr('hidden','true');
        // $(this).parent().parent().children().eq(1).removeAttr('hidden');
        $(this).parent().parent().children().eq(2).attr('hidden', 'true');
        $(this).parent().parent().children().eq(3).removeAttr('hidden');
        // $(this).parent().parent().children().eq(4).attr('hidden','true');
        // $(this).parent().parent().children().eq(5).removeAttr('hidden');
    }); //End Raw Edit

    //Raw Edit->cancel
    $('table').on('click', '.raw_edit_cancel', function() {
        $(this).attr('hidden', 'true');
        $(this).prev().attr('hidden', 'true');
        $(this).prev().prev().show();
        // $(this).parent().parent().children().eq(1).attr('hidden','true');
        // $(this).parent().parent().children().eq(0).removeAttr('hidden');
        $(this).parent().parent().children().eq(3).attr('hidden', 'true');
        $(this).parent().parent().children().eq(2).removeAttr('hidden');
        // $(this).parent().parent().children().eq(5).attr('hidden','true');
        // $(this).parent().parent().children().eq(4).removeAttr('hidden');
    }); //End Raw Edit->cancel

    //Raw Post
    $('table').on('click', '.raw_add', function() {
        var ele = $(this);
        var raw_id = $(this).attr('raw-id');
        var quantity = $(this).parent().parent().children().eq(3).find('input').val();
        var item_id = $(this).attr('item-id');
        var crate_id = $(this).attr('crate-id');
        var proc_items_id = $(this).attr('proc-items-id')
        swal({
                title: "Are you sure ?",
                text: "click ok and confirm!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_inventory/update_raw',
                    type: 'POST',
                    data: {
                        id: raw_id,
                        item_id: item_id,
                        quantity: quantity,
                        crate_id: crate_id,
                        proc_items_id: proc_items_id
                    },

                    success: function(response) {
                        var response = JSON.stringify(response);
                        // setTimeout(function(){
                        swal("Successfully Updated!");
                        // location.reload();
                        ele.attr('hidden', 'true');
                        ele.next().attr('hidden', 'true');
                        ele.prev().show();
                        ele.parent().parent().children().eq(3).attr('hidden', 'true');
                        ele.parent().parent().children().eq(2).removeAttr('hidden');
                        ele.parent().parent().children().eq(2).html("Quantity: " + quantity);
                        // }, 1000);
                    },
                    error: function(error) {
                        var error = JSON.parse(error.status);
                        //var error_msg = JSON.stringify(error.responseJSON.errors);

                        if (error == 401) {
                            sweetAlert('Oops... ', 'Something Went Wrong !', "error");
                        } else if (error == 400) {
                            sweetAlert("Oops...", "Check your input!", "error");
                        }

                    }
                }); //Ajax end
            });
    }); //End Raw Post

    //Salaeble Edit
    $('table').on('click', '.saleable_edit', function() {
        $(this).next().removeAttr('hidden');
        $(this).next().next().removeAttr('hidden');
        $(this).hide();
        $(this).parent().parent().children().eq(4).attr('hidden', 'true');
        $(this).parent().parent().children().eq(5).removeAttr('hidden');
        $(this).parent().parent().children().eq(6).attr('hidden', 'true');
        $(this).parent().parent().children().eq(7).removeAttr('hidden');
    }); //End Saleable Edit

    //saleable Edit->cancel
    $('table').on('click', '.saleable_edit_cancel', function() {
        $(this).attr('hidden', 'true');
        $(this).prev().attr('hidden', 'true');
        $(this).prev().prev().show();
        $(this).parent().parent().children().eq(5).attr('hidden', 'true');
        $(this).parent().parent().children().eq(4).removeAttr('hidden');
        $(this).parent().parent().children().eq(7).attr('hidden', 'true');
        $(this).parent().parent().children().eq(6).removeAttr('hidden');
    }); //End saleable Edit->cancel

    //saleable Post
    /*$('table').on('click', '.saleable_update', function() {
        var ele = $(this);
        var saleable_id = $(this).attr('sal-id');
        var proc_items_id = $(this).attr('proc-items-id');
        var processing_id = $(this).attr('process-id');
        var crate_id = $(this).attr('crate-id');
        var item_id = $(this).attr('item-id');
        var quantity = $(this).parent().parent().children().eq(5).find('input').val();
        var min_quantity = $(this).parent().parent().children().eq(7).find('input').val();
        swal({
                title: "Are you sure ?",
                text: "click ok and confirm!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_inventory/saleable_update',
                    type: 'POST',
                    data: {
                        id: saleable_id,
                        proc_items_id: proc_items_id,
                        processing_id: processing_id,
                        crate_id: crate_id,
                        quantity: quantity,
                        min_quantity: min_quantity,
                        item_id: item_id
                    },

                    success: function(response) {
                        var response = JSON.stringify(response);
                        // setTimeout(function(){
                        swal("Successfully Updated!");
                        ele.attr('hidden', 'true');
                        ele.next().attr('hidden', 'true');
                        ele.prev().show();
                        ele.parent().parent().children().eq(5).attr('hidden', 'true');
                        ele.parent().parent().children().eq(4).removeAttr('hidden');
                        ele.parent().parent().children().eq(7).attr('hidden', 'true');
                        ele.parent().parent().children().eq(6).removeAttr('hidden');
                        ele.parent().parent().children().eq(4).html("Units: " + quantity);
                        ele.parent().parent().children().eq(6).html("Min-Units: " + min_quantity);
                        // location.reload();
                        // }, 2000);
                    },
                    error: function(error) {
                        var error = JSON.parse(error.status);
                        var error_msg = JSON.stringify(error.responseJSON.errors);
                        if (error == 401) {
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    }
                });
            });
    }); *///End Saleable Post

    // Crate autofill
    $('table').delegate('#crateNo, #inward_crate, #stepFive_crate ,#crate_edit, #sal_crate, #stepSix_crate , #stepSix_crate_edit ,#saleable_crate', 'keyup', function(e) {
        var $selector = $(this).next().next().next().children(), //ul element
            text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase(),
            crates = [];

        if (text.length > 0) {
            $selector.parent().removeClass('hidden');
            allCrates.forEach(function(index, i) {
                crates.push(allCrates[i].code);
            });
            autoComplete(text, crates, $selector);
        } else {
            $selector.parent().addClass('hidden');
        }
    });
    $('.inward_disabled').click(function() {
        if ($(this).attr('disabled') == 'disabled') {
            return false;
        }
    });
    $('.inward_disable').click(function() {
        var elem = $(this);
        if ($(this).attr('disabled') == 'disabled') {
            return false;
        }
        var action_btn = $(this);
        var proc_items_id = $(this).attr('proc_items_id');
        swal({
                title: "Are you sure ?",
                text: "You want to Close this inward item!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                showLoaderOnConfirm: false,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_inventory/disable_inward',
                    type: 'POST',
                    data: {
                        proc_items_id: proc_items_id
                    },
                    success: function(response) {
                        'use strict';
                        var snackbarContainer = document.querySelector('#demo-toast-example');
                        var data = {
                            message: 'Inward Closed !',
                            timeout: 3000
                        };
                        snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        elem.attr('disabled', true);
                        elem.attr('disabled', true);
                        //window.location.href = "order";
                    },
                    error: function(xhr, status, error) {
                        var error_msg = xhr.responseJSON.error;
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
    });
    // Add crates 
    $("#add_crates ,#add_return_inward_crates").click(function() {
        $('#inward_submit , #return_inward_submit').removeClass('hidden');
        var isValid = true;
        $("#inward_crate, #inward_comment, #inward_qty").each(function() {
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
            var tRow = $('.inward-item').clone();
            $('.inward_div').removeClass('hidden');
            tRow.removeClass('inward-item');
            tRow.addClass('inward-cloned');
            tRow.removeClass('hidden');
            $('.inward_tbody').append(tRow);

            tRow.children().eq(1).html($('#inward_item').val()).attr('value', $('#inward_item').val()).attr('item-id', $('#inward_item').attr('item-id'));
            tRow.children().eq(2).html($('#inward_uom').val());
            tRow.children().eq(3).find('input').val($('#inward_crate').val());
            tRow.children().eq(4).find('input').val($('#inward_qty').val());
            tRow.children().eq(5).find('input').val($('#inward_comment').find(':selected').val());

            // empty input row
            $('#inward_crate, #inward_qty, #inward_comment').val('');
            $('#inward_crate').removeClass('hidden');
            $('#inward_crate').next().addClass('hidden');
        } else {
            'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'please fill all input !',
                timeout: 1000
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
    });

    $('#inward_submit ,#return_inward_submit').click(function() {
        var current = $(this);
        // var name = $('#inward_crate').val();
        /* var crate_id = crateId(name).id;
         console.log(name);*/
        var proc_items_id = [],
            item_id = [],
            crate_id = [],
            quantity = [],
            comment = [];
        $('.inward-cloned').each(function(index) {
            if(document.getElementById('return_inward_submit')){
            proc_items_id = 0;
            }else{
            proc_items_id.push(current.attr('data-items'));
            }
            item_id.push($(this).children().eq(1).attr('item-id'));
            crate_id.push(crateId($(this).children().eq(3).find('input').val()).id);
            quantity.push($(this).children().eq(4).children().children().eq(0).val());
            comment.push($(this).children().eq(5).children().children().eq(0).val());
        });
        swal({
                title: "Are you sure ?",
                text: "",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
            },
            function() {
                $.ajax({
                    url: 'api/manage_inventory/add_inward_crates',
                    type: 'POST',
                    data: {
                        proc_items_id: proc_items_id,
                        item_id: item_id,
                        crate_id: crate_id,
                        quantity: quantity,
                        comment: comment
                    },
                    success: function(response) {
                        'use strict';
                        var snackbarContainer = document.querySelector('#demo-toast-example');
                        var data = {
                            message: 'Inward successfull.',
                            timeout: 3000
                        };
                        snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        setTimeout(function() {
                            window.history.back();
                        }, 500);
                    },
                    error: function(error) {
                        //var error_msg = JSON.stringify(error.responseJSON.errors);
                        sweetAlert('Oops... ', 'Something went wrong !', "error");
                    }
                });
            });
    });

    //Inward-Crates Table Remove rows
    $('table').on('click', '.inward-crate-row-remove', function() {
        var element = $(this);
        swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: true
            },
            function() {
                element.parent('td').parent('tr').remove();
                'use strict';
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {
                    message: 'Deleted successfully.',
                    timeout: 3000
                };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
            });
    });

    // Inward-Crates edit_row pencil button    
    $('table').on('click', '.inward-crate-row-edit', function() {
        $('.edit_unit').addClass('blink');
        $(this).parent().parent().children().eq(2).nextUntil(5).find('input').removeAttr('readonly').removeClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(1).addClass('hidden');
        $(this).parent().children().eq(1).nextUntil(3).removeClass('hidden');
        //$(this).parent().children().eq(3).removeClass('hidden');    
    });

    // Inward crates row done   
    $('table').on('click', '.inward-crate-row-done', function() {
        $(this).parent().parent().children().eq(2).nextUntil(5).find('input').addClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(3).addClass('hidden');
        $(this).parent().children().eq(0).removeClass('hidden');
        $(this).parent().children().eq(1).removeClass('hidden');
    });

    //Inward-crates Edit->cancel    
    $('table').on('click', '.inward-crate-row-cancel', function() {
        $('#edit_unit').removeClass('blink');
        $(this).parent().parent().children().eq(2).nextUntil(5).find('input').addClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(2).addClass('hidden');
        $(this).parent().children().eq(0).removeClass('hidden');
        $(this).parent().children().eq(1).removeClass('hidden');
    });

    /*------------------------Show Sub-menu for raw-item lists--------------------------------------*/
    $('.raw_info').click(function() {
        $(this).children().eq(0).html() == "expand_less" ? $(this).children().eq(0).html('expand_more') : $(this).children().eq(0).html('expand_less');
        var proc_items_id = $(this).attr('data-items');
        $('.raw-info-row').each(function() {
            if ($(this).attr('data-items') == proc_items_id) {
                $(this).toggleClass('hidden');
            }
        });
    }); //End sub-menu for raw-item lists

    /*------------------------Show Sub-menu for saleable-item lists--------------------------------------*/
    $('.saleable_info').click(function() {
        $(this).children().eq(0).html() == "expand_less" ? $(this).children().eq(0).html('expand_more') : $(this).children().eq(0).html('expand_less');
        var item_id = $(this).attr('item-id');
        $('.salable-info-row').each(function() {
            if ($(this).attr('item-id') == item_id) {
                $(this).toggleClass('hidden');
            }
        });
    }); //End sub-menu for saleable-item lists  

    /*------------------------Show Sub-menu for leftovers-item lists--------------------------------------*/
    $('.leftovers_info').click(function() {
        $(this).children().eq(0).html() == "expand_less" ? $(this).children().eq(0).html('expand_more') : $(this).children().eq(0).html('expand_less');
        var item_id = $(this).attr('item-id');
        $('.salable-info-row').each(function() {
            if ($(this).attr('item-id') == item_id) {
                $(this).toggleClass('hidden');
            }
        });
    }); //End sub-menu for leftovers-item lists  

    /*-------------------------select assignee for processing crates---------------------------------*/
    $('.assignee_append').on('change', function() {
        if ($(this).val() == 'notselected') {
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {
                message: 'Please select proper Assignee!!!',
                timeout: 2000
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;
        }
        var sku_id = $(this).parent().parent().prev().children().find(":selected").val();
        var proc_items_id = $(this).attr('data-items');
        var processing_id = $(this).attr('processing_id');
        var raw_id = $(this).attr('raw-id');
        var item_id = $(this).attr('item-id');
        var quantity = $(this).attr('data-qty');
        var crate_id = $(this).attr('crate-id');
        var assignee_id = $(this).find(":selected").val();
        console.log(sku_id);
        $.ajax({
            url: 'api/Manage_inventory/processing_assignee',
            type: 'POST',
            data: {
                proc_items_id: proc_items_id,
                processing_id:processing_id,
                raw_id: raw_id,
                item_id: item_id,
                quantity: quantity,
                crate_id: crate_id,
                assignee_id: assignee_id,
                sku_id: sku_id
            },
            success: function(response) {
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {
                    message: 'Assigned Successfully.',
                    timeout: 3000
                };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
            },
            error: function(error) {
                sweetAlert("Oops...", "Something went wrong!", "error");
            }
        });
    });
    /*----------------------------------Function to view processing cards-------------------------------------------------*/
    if (window.location.pathname == '/os/processing') {
        processingCard(0, 1);
    }

    $('.tab_1').one('click', function() {
        processingCard($(".demoCardCloned1").length, 1);
    });
    $('.tab_2').one('click', function() {
        processingCard(0, 2);
    });
    $('.tab_3').one('click', function() {
        processingCard(0, 3);
    });

    $('.show_more_processing').on('click', function() {
        processingCard($(".demoCardCloned1").length, 1);
    });
    $('.show_more_processed').on('click', function() {
        processingCard($(".demoCardCloned2").length, 2);
    });
    $('.show_more_hist').on('click', function() {
        processingCard($(".demoCardCloned3").length, 3);
    });

    function processingCard(offset, tab) {
        $.ajax({
            url: 'api/Manage_inventory/processing/offset/' + offset + '/limit/' + 8 + '/tab/' + tab + '',
            type: 'GET',
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                var allProcessInfo = response.data;
                // allProcessInfo.sort(function(a,b){
                //   vA = a.raw_id;
                //   vB = b.raw_id;
                //   return vB-vA;
                // });
                allProcessInfo.forEach(function(Index, i) {
                    var added_on = allProcessInfo[i].added_on;
                    var updated_on = allProcessInfo[i].updated_on;
                    var added_date = added_on.split(' ');
                    var updated_date = updated_on.split(' ');
                    var clone = $(".demoCardProcessing").clone();
                    //alert('currentDate'+currentDate+ ' ' + updated_date[0]);
                    if (tab == 1) {
                        clone.removeClass('demoCardProcessing').addClass('demoCardCloned1').removeClass('hidden');
                    }
                    if (tab == 2) {
                        clone.removeClass('demoCardProcessing').addClass('demoCardCloned2').removeClass('hidden');
                    }
                    if (tab == 3) {
                        clone.removeClass('demoCardProcessing').addClass('demoCardCloned3').removeClass('hidden');
                    }

                    if (allProcessInfo[i].status < 5) {
                        $('.no_process').addClass('hidden');
                        $('.processingTab').append(clone);
                        processing.push(allProcessInfo[i]);
                        $('.show_more_processing').removeClass('hidden');
                    } else if (allProcessInfo[i].status == 5 && updated_date[0] == currentDate) {
                        $('.process_comp').addClass('hidden');
                        $('.processedTab').append(clone);
                        processed.push(allProcessInfo[i]);
                        $('.show_more_processed').removeClass('hidden');
                    } else if (allProcessInfo[i].status == 5 && added_date[0] < currentDate) {
                        $('.no_process_hist').addClass('hidden');
                        $('.historyTab').append(clone);
                        history.push(allProcessInfo[i]);
                        $('.show_more_hist').removeClass('hidden');
                    }
                    clone.children().children().eq(0).children().eq(0).html(allProcessInfo[i].item_name);
                    clone.children().children().eq(1).children().eq(0).html('Assigned to: <b>' + allProcessInfo[i].assignee_name + '</b>');
                    clone.children().children().eq(2).children().eq(0).html('Quantity: <b>' + allProcessInfo[i].quantity + '</b>');
                    clone.children().children().eq(3).children().eq(0).html('Crate: <b>' + allProcessInfo[i].crate_no + '</b>');
                    clone.children().children().eq(4).children().eq(0).attr('id', 'raw_id' + allProcessInfo[i].raw_id);
                    clone.children().children().eq(4).children().eq(1).attr('for', 'raw_id' + allProcessInfo[i].raw_id);
                    if (allProcessInfo[i].status == 5) {
                        clone.children().children().eq(4).children().eq(0).children().eq(0).html('info_outline');
                        clone.children().children().eq(4).children().eq(1).html('Info');
                    }

                    // List view/ table view 
                    var tRowClone = $('.processingTrowEmpty').clone();
                    tRowClone.removeClass('processingTrowEmpty').addClass('processingTrowCloned').removeClass('hidden');

                    tRowClone.children().eq(0).children().eq(0).attr('id', 'raw_id' + allProcessInfo[i].raw_id);
                    tRowClone.children().eq(0).children().eq(1).attr('for', 'raw_id' + allProcessInfo[i].raw_id);
                    tRowClone.children().eq(1).html(allProcessInfo[i].item_name);
                    tRowClone.children().eq(2).html('Assigned to: <b>' + allProcessInfo[i].assignee_name + '</b>');
                    tRowClone.children().eq(3).html('Quantity: <b>' + allProcessInfo[i].quantity + '</b>');
                    tRowClone.children().eq(4).html('Crate: <b>' + allProcessInfo[i].crate_no + '</b>');
                    if (allProcessInfo[i].status == 5) {
                        tRowClone.children().eq(0).children().eq(0).children().eq(0).html('info_outline');
                        tRowClone.children().eq(0).children().eq(1).html('Info');
                    }

                    //Append list view and grid view 
                    $('.list_view').click(function() {
                        $('.show_more_processing,.show_more_processed,.show_more_hist').addClass('hidden');
                        $('.grid_view').removeClass('hidden');
                        $(this).hide();
                        $('.grid_view').show();

                        if (allProcessInfo[i].status < 5 || added_date[0] >= currentDate) {
                            $('.processingTbody').append(tRowClone);
                        } else if (allProcessInfo[i].status == 5 && added_date[0] == currentDate) {
                            $('.processedTbody').append(tRowClone);
                        } else if (allProcessInfo[i].status == 5 && added_date[0] < currentDate) {
                            $('.historyTbody').append(tRowClone);
                        }
                        if (tab == 1) {
                            $('.demoCardCloned1').addClass('hidden');
                        }
                        if (tab == 2) {
                            $('.demoCardCloned2').addClass('hidden');
                        }
                        if (tab == 3) {
                            $('.demoCardCloned3').addClass('hidden');
                        }
                        $('.processingTableEmpty').parent().removeClass('hidden');
                    });

                    $('.grid_view').click(function() {
                        $(this).hide();
                        $('.show_more_processing,.show_more_processed,.show_more_hist').removeClass('hidden');
                        $('.list_view').show();
                        if (allProcessInfo[i].status < 5 || added_date[0] >= currentDate) {
                            $('.processingTab').append(clone);
                            processing.push(allProcessInfo[i]);
                        } else if (allProcessInfo[i].status == 5 && added_date[0] == currentDate) {
                            $('.processedTab').append(clone);
                            processed.push(allProcessInfo[i]);
                        } else if (allProcessInfo[i].status == 5 && added_date[0] < currentDate) {

                            $('.historyTab').append(clone);
                            history.push(allProcessInfo[i]);

                        }
                        if (tab == 1) {
                            $('.demoCardCloned1').removeClass('hidden');
                        }
                        if (tab == 2) {
                            $('.demoCardCloned2').removeClass('hidden');
                        }
                        if (tab == 3) {
                            $('.demoCardCloned3').removeClass('hidden');
                        }
                        $('.processingTableEmpty').parent().addClass('hidden');
                    });

                    //console.log(allProcessInfo[i].steps[length-1].step ,allProcessInfo[i].steps[length-1].qty);
                    $("#raw_id" + allProcessInfo[i].raw_id).on('click', function() {
                        var length = allProcessInfo[i].steps.length;
                        var step;
                        if (length == 0) {
                            step = 'undefined';
                        } else {
                            step = allProcessInfo[i].steps[length - 1].step;
                        }

                        if (allProcessInfo[i].status == 5) {
                            window.location.href = 'processingInfo?procid=' + allProcessInfo[i].proc_items_id + '&prossid=' + allProcessInfo[i].processing_id + '&step=' + step + '&status=' + allProcessInfo[i].status + '&item_id=' + allProcessInfo[i].item_id;
                            return false;
                        }
                        var raw_id = allProcessInfo[i].raw_id;
                        var processing_id = allProcessInfo[i].processing_id;
                        var crate_id = allProcessInfo[i].crate_id;

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
                                        url: 'api/manage_inventory/disable_raw',
                                        type: 'POST',
                                        data: {
                                              raw_id: raw_id,
                                              processing_id:processing_id,
                                              crate_id : crate_id
                                            },
                                        success:function(response){
                                          window.location.href = 'processingStart?data='+btoa('procid='+allProcessInfo[i].proc_items_id+'&prossid='+allProcessInfo[i].processing_id+'&step='+step+'&status='+allProcessInfo[i].status+'&item_id='+allProcessInfo[i].item_id +'&quantity='+allProcessInfo[i].quantity +'&crate_no='+allProcessInfo[i].crate_no);
                                            
                                        },
                                        error:function(error){
                                          sweetAlert("Oops...", "Something went wrong!", "error");
                                        }
                                  });
                        });
                    });
                  });
            },
            error:function(error){
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {message: 'No data found !',timeout:1000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
              if(processing.length == 0 && tab == 1){
                // $('div .processingTab').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>  Nothing to process. <br> <br> Take Rest for a while.</h3></p></div>');
                 $('.no_process').removeClass('hidden');
              }
              if(processed.length == 0 && tab == 2){
                // $('div .processedTab').append('<div class="mdl-card-status mdl-shadow--2dp history"><p><i class="material-icons status_icon">error</i></p><p><h3> Processing Completed ! </h3></p></div>');
                 $('.process_comp').removeClass('hidden');
              }
              if(history.length == 0 && tab == 3){
               // $('div .historyTab').append('<div class="mdl-card-status mdl-shadow--2dp history"><p><i class="material-icons status_icon">error</i></p><p><h3> Processing History Null! </h3></p></div>'); 
                 $('.no_process_hist').removeClass('hidden');
              }
              return false;
            }
        });
    }

    // card search 
    $("#processing_search").donetyping(function() {
        var text = $(this).val();
        if (text.length > 0) {
            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(function() {
                $.ajax({
                    url: 'api/manage-inventory/processing_search',
                    type: 'POST',
                    data: {
                        q: text
                    },
                    success: function(response) {
                        var response = JSON.parse(JSON.stringify(response));
                        var allProcessInfo = response.data;
                        allProcessInfo.sort(function(a, b) {
                            vA = a.raw_id;
                            vB = b.raw_id;
                            return vB - vA;
                        });
                        $('.dynamic_search').removeClass('hidden');
                        $('.mdl-layout__tab-bar ,.show_more_processing ,.show_more_processed, .show_more_hist ,.page-content').addClass('hidden');
                        allProcessInfo.forEach(function(Index, i) {
                            var added_on = allProcessInfo[i].added_on;
                            var updated_on = allProcessInfo[i].updated_on;
                            var added_date = added_on.split(' ');
                            var updated_date = updated_on.split(' ');
                            var clone = $(".demoCardProcessing").clone();
                            clone.removeClass('demoCardProcessing').removeClass('hidden');
                            $('.searchResult').append(clone);

                            clone.children().children().eq(0).children().eq(0).html(allProcessInfo[i].item_name);
                            clone.children().children().eq(1).children().eq(0).html('Assigned to: <b>' + allProcessInfo[i].assignee_name + '</b>');
                            clone.children().children().eq(2).children().eq(0).html('Quantity: <b>' + allProcessInfo[i].quantity + '</b>');
                            clone.children().children().eq(3).children().eq(0).html('Crate: <b>' + allProcessInfo[i].crate_no + '</b>');
                            clone.children().children().eq(4).children().eq(0).attr('id', 'raw_id' + allProcessInfo[i].raw_id);
                            clone.children().children().eq(4).children().eq(1).attr('for', 'raw_id' + allProcessInfo[i].raw_id);
                            if (allProcessInfo[i].status == 5) {
                                clone.children().children().eq(4).children().eq(0).children().html('info_outline');
                                clone.children().children().eq(4).children().eq(1).html('Info');
                            }
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
            $('.searchResult').empty();
            $(this).data('timer', wait);
        }

    });
    $('#dynamic_div_close').on('click', function() {
        $('.dynamic_search').addClass('hidden');
        $('.page-content ,.mdl-layout__tab-bar ,.show_more_processing , .show_more_processed , .show_more_hist').removeClass('hidden');
        $('.searchResult').empty();
    });

    /*if(processing.length == 0){
      $('div .processingTab').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>  Nothing to process. <br> <br> Take Rest for a while.</h3></p></div>');
    }
    if(processed.length == 0){
      $('div .processedTab').append('<div class="mdl-card-status mdl-shadow--2dp history"><p><i class="material-icons status_icon">error</i></p><p><h3> Processing Completed ! </h3></p></div>');
    }
    if(history.length == 0){
     $('div .historyTab').append('<div class="mdl-card-status mdl-shadow--2dp history"><p><i class="material-icons status_icon">error</i></p><p><h3> Processing History Null! </h3></p></div>'); 
    }*/

    /*----------------------------------Processing Start page -------------------------------------------------------------*/
    // prevent by entering value more than max attribute
    var quant_b, quant_c, error_msg_val;
    $('#quantity_stepOne').on('keyup', function(e) {
        if ($(this).val() >= $(this).attr('max') && ($(this).val().length >= $(this).attr('max').length)) {
            e.preventDefault();
            $(this).val($(this).attr('max'));
        } else if ($(this).val() <= $(this).attr('max') && ($(this).val().length >= $(this).attr('max').length + 1)) {
            e.preventDefault();
            $(this).val($(this).attr('max'));
        }
    });
    $('#quantity_stepTwo').on('keyup', function(e) {
        var quant = $('.stepTwoErrMsg').attr('data-error');
        if (($(this).val() >= quant) && ($(this).val().length >= quant.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        } else if (($(this).val() <= quant) && ($(this).val().length >= quant.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        }
        $('.stepTwoErrMsg').text('We can not accept value more than ' + quant + ' !');
    });
    $('#quantity_stepThree').on('keyup', function(e) {
        var quant = $('.stepThreeErrMsg').attr('data-error');
        if (($(this).val() >= quant) && ($(this).val().length >= quant.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        } else if (($(this).val() <= quant) && ($(this).val().length >= quant.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        }
        $('.stepThreeErrMsg').text('We can not accept value more than ' + quant + ' !');
    });

    $('#quantity_grade_a').on('keyup', function(e) {
        var quant = $('.gradeAErrMsg').attr('data-error');
        if (($(this).val() >= quant) && ($(this).val().length >= quant.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        } else if (($(this).val() <= quant) && ($(this).val().length >= quant.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        }
        
        $('.gradeAErrMsg').text('We can not accept value more than ' + quant + ' !');
    }).on('change', function() {
        var quant = $('.gradeAErrMsg').attr('data-error');
        $(this).attr('value', $(this).val());
        quant_b = parseFloat(quant) - parseFloat($(this).attr('value'));
        setTimeout(function() {
            $('#quantity_grade_b').focus();
        }, 250);
    });

    // grade B prevent from entering value more than grade A max value
    $('#quantity_grade_b').on('keyup', function(e) {
        //quant_b = parseFloat($('.gradeAErrMsg').attr('data-error')) - parseFloat($('#quantity_grade_a').attr('value'));
        if (($(this).val() >= quant_b) && ($(this).val().length >= quant_b.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant_b);
        } else if (($(this).val() <= quant_b) && ($(this).val().length >= quant_b.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant_b);
        }
        $('.gradeBErrMsg').text('We can not accept value more than ' + quant_b + ' !');
    }).on('change', function() {
        $(this).attr('value', $(this).val());
        if ($(this).val() != 0) {
            quant_c = parseFloat($('.stepThreeErrMsg').attr('data-error')) - (parseFloat($('#quantity_grade_a').attr('value')) + parseFloat($(this).attr('value')));
        } else {
            quant_c = 0;
        }
        $('#quantity_grade_c').val(quant_c).attr('value', quant_c);
        $('.gradeCErrMsg').text('We can not accept value more than ' + quant_c + ' !');

    });
    $('.grade_a_weight').text($('.stepFiveErrMsg').attr('data-error')).attr('value', $('.stepFiveErrMsg').attr('data-error'));
    
    $('#quantity_stepFive').on('keyup', function(e) {
        var quant = $('.stepFiveErrMsg').attr('data-error');
        if (($(this).val() >= quant) && ($(this).val().length >= quant.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        } else if (($(this).val() <= quant) && ($(this).val().length >= quant.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(quant);
        }
        $('.stepFiveErrMsg').text('We can not accept value more than ' + quant + ' !');
    });

    $('.grade_bc').on('change', function() {
        if ($(this).find(":selected").val() == 'B') {
            $('#quantity_stepSix').val($(this).find(":selected").attr('data-value'));
            error_msg_val = $(this).find(":selected").attr('data-value');
            
        } 
        if ($(this).find(":selected").val() == 'C') {
            $('#quantity_stepSix').val($(this).find(":selected").attr('data-value'));
            error_msg_val = $(this).find(":selected").attr('data-value');
        }
    });

    $('#quantity_stepSix').on('keyup', function(e) {
        if (($(this).val() >= error_msg_val) && ($(this).val().length >= error_msg_val.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(error_msg_val);
        } else if (($(this).val() <= error_msg_val) && ($(this).val().length >= error_msg_val.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
            e.preventDefault();
            $(this).val(error_msg_val);
        }
        //$('.stepSixErrMsg').text('We can not accept value more than '+error_msg_val+' !');
    });
    // Post request function for each step
    var error_msg_val;
    $('.button').on('click', function() {
        var step_id, processing_id, proc_items_id, item_id, quantity, crate_no;
        processing_id = $(this).attr('process-id');
        proc_items_id = $(this).attr('proc-id');
        item_id = $(this).attr('item-id');
        create_no = $(this).attr('crate-no');

        var elem = $(this);
        // Step one next button onclick show step two screen
        if ($(this).hasClass('stepOne')) {
            step_id = 1;
            quantity = $('#quantity_stepOne').val();

            // prevent by entering value more than step 1 max attribute
            /*$('#quantity_stepTwo').on('keyup',function(e){
              if (($(this).val() >= $('#quantity_stepOne').val()) && ($(this).val().length >= $('#quantity_stepOne').val().length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9){
               e.preventDefault();
               $(this).val($('#quantity_stepOne').val());
              }else if(($(this).val() <= $('#quantity_stepOne').val()) && ($(this).val().length >= $('#quantity_stepOne').val().length +1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9){
                e.preventDefault();
                $(this).val($('#quantity_stepOne').val());
              }
              $('.stepTwoErrMsg').text('We can not accept value more than '+$('#quantity_stepOne').val()+' !');
            });*/

        } else if ($(this).hasClass('stepTwo')) { //step two next button onclick show step three screen
            step_id = 2;
            quantity = $('#quantity_stepTwo').val();

            $('#quantity_stepThree').on('keyup', function(e) {
                if (($(this).val() >= $('#quantity_stepTwo').val()) && ($(this).val().length >= $('#quantity_stepTwo').val().length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val($('#quantity_stepTwo').val());
                } else if (($(this).val() <= $('#quantity_stepTwo').val()) && ($(this).val().length >= $('#quantity_stepTwo').val().length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val($('#quantity_stepTwo').val());
                }
                $('.stepThreeErrMsg').text('We can not accept value more than ' + $('#quantity_stepTwo').val() + ' !');
            });

        } else if ($(this).hasClass('stepThree')) { //step three next button onclick show step four screen
            var quant_b, quant_c;
            step_id = 3;
            quantity = $('#quantity_stepThree').val();

            // grade A prevent from entering value more than step 3 max value
            $('#quantity_grade_a').on('keyup', function(e) {
                if (($(this).val() >= $('#quantity_stepThree').val()) && ($(this).val().length >= $('#quantity_stepThree').val().length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    //$(this).val($('#quantity_stepThree').val());
                } else if (($(this).val() <= $('#quantity_stepThree').val()) && ($(this).val().length >= $('#quantity_stepThree').val().length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    //$(this).val($('#quantity_stepThree').val());
                }
                $('.gradeAErrMsg').text('We can not accept value more than ' + $('#quantity_stepThree').val() + ' !');
            }).on('change', function() {
                $(this).attr('value', $(this).val());
                quant_b = parseFloat($('#quantity_stepThree').val()) - parseFloat($(this).attr('value'));
                setTimeout(function() {
                    $('#quantity_grade_b').focus();
                }, 250);
            });

            // grade B prevent from entering value more than grade A max value
            $('#quantity_grade_b').on('keyup', function(e) {
                if (($(this).val() >= quant_b) && ($(this).val().length >= quant_b.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val(quant_b);
                } else if (($(this).val() <= quant_b) && ($(this).val().length >= quant_b.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val(quant_b);
                }
                $('.gradeBErrMsg').text('We can not accept value more than ' + quant_b + ' !');
            }).on('change', function() {
                $(this).attr('value', $(this).val());
                quant_c = parseFloat($('#quantity_stepThree').val()) - (parseFloat($('#quantity_grade_a').attr('value')) + parseFloat($(this).attr('value')));
                $('#quantity_grade_c').val(quant_c).attr('value', quant_c);

                if (quant_c == NaN) {
                    $('.gradeCErrMsg').text('We can not accept value more than 0 !');
                } else {
                    $('.gradeCErrMsg').text('We can not accept value more than ' + quant_c + ' !');
                }
            });

            // grade C prevent from entering value more than grade B max value
            /*$('#quantity_grade_c').on('keyup',function(e){
              if ($(this).val() >= quant_c){
               e.preventDefault();
               $(this).val(quant_c);
              }
              
            });*/
        }

        var data = {
            step_id: step_id,
            quantity: quantity,
            processing_id: processing_id,
            proc_items_id: proc_items_id,
            item_id: item_id
        };
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
                            url: 'api/manage_inventory/processing_steps',
                            type: 'POST',
                            data: data,
                            success:function(response){
                              console.log(response);
                              if(elem.hasClass('stepOne')){
                                 /*$.ajax({
                                        url: 'api/Manage_inventory/processing/'+processing_id,
                                        type: 'GET', 
                                        succes:function(response){},
                                        error:function(){}
                                      });*/
                                $('.stepOneScreen').addClass('hidden');
                                $('.stepTwoScreen').removeClass('hidden');
                                $('.breadcrumb >a:nth-child(2)').addClass('active');
                                  window.location.href = 'processingStart?data='+btoa('procid='+proc_items_id+'&prossid='+processing_id+'&crate_no='+crate_no+'&item_id='+item_id);
                                 setTimeout(function(){
                                 $('#quantity_stepTwo').focus(); }, 250);
                              }else if(elem.hasClass('stepTwo')){
                                $('.stepTwoScreen').addClass('hidden');
                                $('.stepThreeScreen').removeClass('hidden');
                                $('.breadcrumb >a:nth-child(3)').addClass('active');
                                setTimeout(function(){ $('#quantity_stepThree').focus(); }, 250);
                              }else if(elem.hasClass('stepThree')){
                                $('.stepThreeScreen').addClass('hidden');
                                $('.stepFourScreen').removeClass('hidden');
                                $('.breadcrumb >a:nth-child(4)').addClass('active');
                                setTimeout(function(){
                                  //window.location.href = 'processingInfo?procid='+proc_items_id+'&prossid='+processing_id+'&item_id='+item_id;
                                  $('#quantity_grade_a').focus(); }, 250);
                              }
                            },
                            error:function(error){
                              sweetAlert("Oops...", "Something went wrong!", "error");
                            }
                      });
        });
        // Step 4 
        if ($(this).hasClass('stepFour')) {
            var ga = $('#quantity_grade_a').val();
            var gb = $('#quantity_grade_b').val();
            var gc = $('#quantity_grade_c').val();
            var gabc = $('#quantity_grade_a').val() + $('#quantity_grade_b').val() + $('#quantity_grade_c').val();
            $('.grade_a_weight').text($('#quantity_grade_a').val()).attr('value', $('#quantity_grade_a').val());
            $('#quantity_stepFive').on('keyup', function(e) {
                if (($(this).val() >= $('.grade_a_weight').attr('value')) && ($(this).val().length >= $('.grade_a_weight').attr('value').length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val($('.grade_a_weight').attr('value'));
                } else if (($(this).val() <= $('.grade_a_weight').attr('value')) && ($(this).val().length >= $('.grade_a_weight').attr('value').length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val($('.grade_a_weight').attr('value'));
                }
                $('.stepFiveErrMsg').text('We can not accept value more than ' + $('.grade_a_weight').attr('value') + ' !');
            });
            var data_stepFour = {
                processing_id: processing_id,
                proc_items_id: proc_items_id,
                item_id: item_id,
                ga: ga,
                gb: gb,
                gc: gc
            }
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
                        url: 'api/manage_inventory/processing_grading',
                        type: 'POST',
                        data: data_stepFour,
                        success: function(response) {
                            /**/
                            $('.stepFourScreen').addClass('hidden');
                            $('.stepFiveScreen').removeClass('hidden');
                            $('.breadcrumb >a:nth-child(5)').addClass('active');
                            window.location.href = 'processingStart?data='+btoa('procid='+proc_items_id+'&prossid='+processing_id+'&crate_no='+crate_no+'&item_id='+item_id);
                          },
                          error:function(error){
                            sweetAlert("Oops...", "Something went wrong!", "error");
                        }
                    });
                });
        }

        // step 5 post request 
        if ($(this).hasClass('stepFive_submitBtn')) {
            var quantity = [];
            var item_id = [];
            var crate_id = [];
            var process_id = [];
            var proc_id = [];
            var sku_id = [];
            var tRowCloned = $('.StepFive_cloned_item_row');
            $.each(tRowCloned, function(index, data) {
                item_id.push($(this).children().eq(1).find('input').attr('item-id'));
                crate_id.push($(this).children().eq(2).find('input').attr('crate-id'));
                quantity.push($(this).children().eq(4).find('input').attr('value'));
                sku_id.push($(this).children().eq(3).find('input').attr('sku_id'));
                process_id.push(processing_id);
                proc_id.push(proc_items_id);
            });
            //step six screen
            $('.grade_bc').on('change', function() {
                if ($(this).find(":selected").val() == 'B') {
                    $('#quantity_stepSix').val($('#quantity_grade_b').attr('value'));
                    error_msg_val = $('#quantity_grade_b').attr('value');
                } 
                if ($(this).find(":selected").val() == 'C') {
                    $('#quantity_stepSix').val($('#quantity_grade_c').attr('value'));
                    error_msg_val = $('#quantity_grade_c').attr('value');
                }
            });

            $('#quantity_stepSix').on('keyup', function(e) {
                if (($(this).val() >= error_msg_val) && ($(this).val().length >= error_msg_val.length) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val(error_msg_val);
                } else if (($(this).val() <= error_msg_val) && ($(this).val().length >= error_msg_val.length + 1) && e.keyCode != 46 && e.keyCode != 8 && e.keyCode != 9) {
                    e.preventDefault();
                    $(this).val(error_msg_val);
                }
                //$('.stepSixErrMsg').text('We can not accept value more than '+error_msg_val+' !');
            });
            var data_stepFive = {
                processing_id: process_id,
                proc_items_id: proc_id,
                item_id: item_id,
                crate_id: crate_id,
                sku_id: sku_id,
                quantity: quantity
            }
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
                        url: 'api/manage_inventory/saleable_final',
                        type: 'POST',
                        data: data_stepFive,
                        success: function(response) {
                            $('.stepFiveScreen').addClass('hidden');
                            $('.stepSixScreen').removeClass('hidden');
                            $('.breadcrumb >a:nth-child(6)').addClass('active');
                            //window.location.href = 'processingStart?procid='+proc_items_id+'&prossid='+processing_id+'&crate_no='+crate_no;
                        },
                        error: function(error) {
                            sweetAlert("Oops...", "Something went wrong!", "error");
                        }
                    });
                });
        }

        // step 6 post request
        if ($(this).hasClass('stepSix_submitBtn')) {
            var quantity = [];
            var crate_id = [];
            var process_id = [];
            var proc_id = [];
            var grade = [];
            var itemId = [];
            var RowClone = $('.StepSix_cloned_item_row');

            $.each(RowClone, function(index, data) {
                grade.push($(this).children().eq(1).find('input').attr('value'));
                crate_id.push($(this).children().eq(2).find('input').attr('crate-id'));
                quantity.push($(this).children().eq(3).find('input').attr('value'));
                process_id.push(processing_id);
                proc_id.push(proc_items_id);
                itemId.push(item_id);
            });
            var data = {
                proc_items_id: proc_id,
                processing_id: process_id,
                item_id: itemId,
                grade: grade,
                quantity: quantity,
                crate_id: crate_id
            }
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
                        url: 'api/manage_inventory/leftovers',
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'Processing completed !',
                                timeout: 3000
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                            window.location.href = "processing";
                        },
                        error: function(error) {
                            sweetAlert("Oops...", "Something went wrong!", "error");
                        }
                    });
                });


        }
    });
    // item autofill for step five
    $('#stepFive_selectItem').on('input', function(e) {
        var $selector = $(this).next().next().next().children(), //ul element
            text = $(this).val(),
            typeCode = 1;
        row = $('.StepFive_select_item_row');
        if (text.length > 0) {
            $selector.parent().removeClass('hidden');
            itemSearch(text, typeCode, $selector);

            /*$selector.children().on('click',function(e){
              
            });*/
        } else {
            $selector.parent().addClass('hidden');
        }
    }).on('blur', function(e) {
        var text = $(this).val(),
            typeCode = 1;
        itemId = $(this).attr('item-id');
        $('#stepFive_selectItem').attr('item-id', itemId);
        /*var value = $('#stepFive_selectItem').attr('sku_val');
        var sku = $('#stepFive_selectItem').attr('sku_id');*/
        searchItemName(text, typeCode, itemId).success(function(response) {
            var response_data = JSON.parse(JSON.stringify(response));
            for (var j = 0; j < response_data.data.data.items.length; j++) {
                if (response_data.data.data.items[j].id == itemId) {
                    var skuData = response_data.data.data.items[j].sku;
                    uom = response_data.data.data.items[j].uom;
                    var sku, sku_id;
                    //searchItemName(text , typeCode ,id);
                    $.each(skuData, function(key, value) {
                        //$('#stepFive_sku').val(value).attr('sku-id',key);
                        row.children().eq(3).find('input').val(value).attr('sku-id', key).attr('sku_val', value);
                    });
                }
            }
        });
    });

    // append items step 5
    $('.stepFive_append_item').on('click', function() {
        var isValid = true;
        var input = $('.StepFive_append_item_row').siblings().children().eq(1).find('input');
        $("#stepFive_selectItem,#quantity_stepFive").each(function() {
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
        if ($('.grade_a_weight').attr('value') != 0) {
            if (isValid == true) {
                $('.stepFiveScreen_appendTable').removeClass('hidden');
                var name = $('#stepFive_selectItem').val();
                var itemId = $('#stepFive_selectItem').attr('item-id');
                var crateCode = crateId($('#stepFive_crate').val());
                var crate_id = crateCode.id;
                var sku_val = $('.StepFive_select_item_row').children().eq(3).find('input').attr('sku_val');
                var sku_id = $('.StepFive_select_item_row').children().eq(3).find('input').attr('sku-id');
                var remain_quant = parseFloat($('.grade_a_weight').attr('value')) - parseFloat($('#quantity_stepFive').val());
                //after reoad 
                var remain_quant_ = parseFloat($('.stepFiveErrMsg').attr('data-error')) - parseFloat($('#quantity_stepFive').val());
                $('.grade_a_weight').text(remain_quant).attr('value', remain_quant);

                $('.stepFiveErrMsg').text('We can not accept value more than ' + remain_quant + ' !');


                var tRow = $('.StepFive_append_item_row').clone();
                tRow.removeClass('StepFive_append_item_row').addClass('StepFive_cloned_item_row').removeClass('hidden');
                $('.stepFive_tbody').prepend(tRow);
                tRow.children().eq(1).find('input').attr('item-id', itemId).val(name);
                tRow.children().eq(2).find('input').val($('#stepFive_crate').val()).attr('crate-id', crate_id);
                tRow.children().eq(3).find('input').val(sku_val).attr('sku_id', sku_id);
                tRow.children().eq(4).find('input').val($('#quantity_stepFive').val()).attr('value', $('#quantity_stepFive').val());

                $('#stepFive_selectItem,#quantity_stepFive, #stepFive_crate, #stepFive_sku').val('');
                $('#stepFive_sku').attr('sku-id', '');
                $('#stepFive_selectItem, #stepFive_crate').removeClass('hidden');
                $('#stepFive_selectItem ,#stepFive_crate').next().addClass('hidden');
                setTimeout(function() {
                    $('#stepFive_selectItem').focus();
                }, 250);
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
            /*'use strict';
            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {message: 'you added all quantity !',timeout:1000};
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            return false;*/
            swal("You have added all quantity !", "Please click on submit button ", "success");
        }
    });

    // append items step 6
    $('.stepSix_append_item').on('click', function() {
        var crateCode = crateId($('#stepSix_crate').val());
        var crate_id = crateCode.id;
        var grade = $('.grade_bc').find(":selected").val();
        var Row = $('.StepSix_append_item_row').clone();
        Row.removeClass('StepSix_append_item_row').addClass('StepSix_cloned_item_row').removeClass('hidden');
        var isValid = true;
        $("#stepSix_crate,#quantity_stepSix").each(function() {
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

        //if(($('#quantity_grade_b').attr('value')!=0) || ($('#quantity_grade_c').attr('value')!=0)){
        if (isValid == true) {
            $('.stepSixScreen_appendTable').removeClass('hidden');
            $('.stepSix_tbody').prepend(Row);

            Row.children().eq(1).find('input').val(grade).attr('value', grade);
            Row.children().eq(2).find('input').val($('#stepSix_crate').val()).attr('crate-id', crate_id);
            Row.children().eq(3).find('input').val($('#quantity_stepSix').val()).attr('value', $('#quantity_stepSix').val());

            $('.grade_bc,#quantity_stepSix, #stepSix_crate').val('');
            $(' #stepSix_crate').removeClass('hidden');
            $('#stepSix_crate').next().addClass('hidden');
            /*if(($('#quantity_grade_b').attr('value')==0) && ($('.grade_bc').find(":selected").val() == 'C')){
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {message: 'you have added all grade B quantity  !',timeout:1000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
              return false;
              //swal("You have added all quantity !", "Please click on submit button ", "success");
            }else if(($('#quantity_grade_c').attr('value')==0) && ($('.grade_bc').find(":selected").val() == 'C')){
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {message: 'you have added all grade C quantity  !',timeout:1000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
              return false;
              //swal("You have added all quantity !", "Please click on submit button ", "success");
            }*/
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
        /*}else{
          $('.stepSixScreen_appendTable').removeClass('hidden');
          $('.stepSix_tbody').prepend(Row);
                
          Row.children().eq(1).find('input').val(grade).attr('value',0);
          Row.children().eq(2).find('input').val($('#stepSix_crate').val()).attr('crate-id',0);
          Row.children().eq(3).find('input').val($('#quantity_stepSix').val()).attr('value',$('#quantity_stepSix').val());
          
        }*/
    });


    // remove  add order row
    $('table').on('click', '.stepFive-row-delete', function() {
        var element = $(this);
        var quantity = $(this).parent().parent().children().eq(4).find('input').attr('value');
        var changed_quantity = parseFloat($('.grade_a_weight').attr('value')) + parseFloat(quantity);

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
                $('.grade_a_weight').text(changed_quantity).attr('value', changed_quantity);
                $('.stepFiveErrMsg').text('We can not accept value more than ' + changed_quantity + ' !');
                element.parent('td').parent('tr').remove();
                swal("Deleted!", "removed.", "success");
            });
    });

    // edit add_order row 
    $('table').on('click', '.stepFive-row-edit', function() {
        $('.edit_unit').addClass('blink');
        $(this).parent().parent().children().eq(1).nextUntil(4).find('input').removeAttr('readonly').removeClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(1).addClass('hidden');
        $(this).parent().children().eq(2).removeClass('hidden');
        $(this).parent().children().eq(3).removeClass('hidden');
    });

    // update add_order row
    $('table').on('click', '.stepFive-row-done', function() {
        $('.edit_unit').removeClass('blink');
        $(this).parent().parent().children().eq(1).nextUntil(3).find('input').addClass('mdl-textfield__input_border');
        var quantity = parseFloat($(this).parent().parent().children().eq(4).find('input').attr('value')) - parseFloat($(this).parent().parent().children().eq(4).find('input').val());
        $('#edit_quantity').attr('value', $(this).parent().parent().children().eq(4).find('input').val());
        var changed_quantity = parseFloat($('.grade_a_weight').attr('value')) + parseFloat(quantity);
        $('.grade_a_weight').text(changed_quantity).attr('value', changed_quantity);
        $('.stepFiveErrMsg').text('We can not accept value more than ' + changed_quantity + ' !');
        $(this).addClass('hidden');
        $(this).parent().children().eq(3).addClass('hidden');
        $(this).parent().children().eq(0).removeClass('hidden');
        $(this).parent().children().eq(1).removeClass('hidden');
    });

    // reset add_order row
    $('table').on('click', '.stepFive-row-cancel', function() {
        $('#edit_unit').removeClass('blink');
        $(this).parent().parent().children().eq(2).find('input').addClass('mdl-textfield__input_border');
        $(this).addClass('hidden');
        $(this).parent().children().eq(2).addClass('hidden');
        $(this).parent().children().eq(0).removeClass('hidden');
        $(this).parent().children().eq(1).removeClass('hidden');
    });

    //leftovers Edit
    $('table').on('click', '.leftovers_edit', function() {
        $(this).next().removeAttr('hidden');
        $(this).next().next().removeAttr('hidden');
        $(this).hide();
        $(this).parent().parent().children().eq(5).attr('hidden', 'true');
        $(this).parent().parent().children().eq(6).removeAttr('hidden');

    }); //End leftovers Edit

    //leftovers Edit->cancel
    $('table').on('click', '.leftovers_edit_cancel', function() {
        $(this).attr('hidden', 'true');
        $(this).prev().attr('hidden', 'true');
        $(this).prev().prev().show();
        $(this).parent().parent().children().eq(6).attr('hidden', 'true');
        $(this).parent().parent().children().eq(5).removeAttr('hidden');

    }); //End leftovers Edit->cancel

    //Leftovers Post
    $('table').on('click', '.leftovers_update', function() {

        var id = $(this).attr('data-id');
        var crate_id = $(this).attr('crate-id');
        var quantity = $(this).parent().parent().children().eq(6).find('input').val();
        // console.log(id,crate_id,quantity);return false;
        swal({
                title: "Are you sure ?",
                text: "click ok and confirm!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_inventory/leftovers_update',
                    type: 'POST',
                    data: {
                        id: id,
                        crate_id: crate_id,
                        quantity: quantity
                    },

                    success: function(response) {
                        var response = JSON.stringify(response);
                        setTimeout(function() {
                            swal("Successfully Updated!");
                            location.reload();
                            return false;
                        }, 2000);
                    },
                    error: function(error) {
                        var error = JSON.parse(error.status);
                        var error_msg = JSON.stringify(error.responseJSON.errors);
                        if (error == 401) {
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    }
                });
            });
    }); //End Leftovers Post

    // Leftovers info search 
    $("#leftovers_info_search").on('keyup', function(e) {
        var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
        var tRow = $(".salable-info-row");
        var input;
        $.each(tRow, function(index, data) {
            input = $.trim($(this).children().eq(0).text()).toLowerCase().replace(/ +/g, '');
            (!~input.indexOf(text) == 0) ? $(this).addClass("animate fadeIn hinge").show(): $(this).fadeOut(100).hide(100);
        });
    });

    //Crates
    $.ajax({
        url: 'api/Manage_inventory/all_crates',
        type: 'GET',
        success: function(response) {
            var response = JSON.parse(JSON.stringify(response));
            var Crates = response.data;
            // setTimeout(function(){

            Crates.forEach(function(Index, i) {
                var tRow = $('.crate_row').clone();
                tRow.removeClass('hidden').removeClass('crate_row');
                tRow.addClass('crateCloned');
                $('.crate_infoTbody').append(tRow);
                $.each(tRow, function(Index, data) {
                    tRow.children().eq(1).children().children().attr('data-id', Crates[i].id);
                    tRow.children().eq(1).children().children().attr('value', Crates[i].code);
                    tRow.children().eq(2).children().children().attr('value', Crates[i].type);
                    tRow.children().eq(3).children().children().children().eq(0).attr('value', Crates[i].status).text(crates_status[Crates[i].status]);
                });
            });
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
        },
    });

    //table Edit
    $('table').on('click', '.edit_crate', function() {
        $(this).next().removeAttr('hidden');
        $(this).next().next().removeAttr('hidden');
        $(this).hide();
        $(this).parent().parent().children().eq(3).children().find('select').removeAttr('disabled');
    }); //End table Edit

    //table Edit->cancel
    $('table').on('click', '.cancel_crate', function() {
        $(this).attr('hidden', 'true');
        $(this).prev().attr('hidden', 'true');
        $(this).prev().prev().show();
        $(this).parent().parent().children().eq(3).children().find('select').attr('disabled', 'true');
    }); //End table Edit->cancel

    //table Update
    $('table').on('click', '.update_crate', function() {
        var ele = $(this);
        var Crate_id = $(this).parent().parent().children().eq(1).children().children().attr('data-id');
        var Crate_type = $(this).parent().parent().children().eq(2).children().children().val();
        var Crate_status = $(this).parent().parent().children().eq(3).children().children().val();

        swal({
                title: "Are you sure ?",
                text: "click ok and confirm!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: true,
                animation: "slide-from-top",
                showLoaderOnConfirm: false
            },

            function() {
                $.ajax({
                    url: 'api/Manage_inventory/update_crates',
                    type: 'POST',
                    data: {
                        id: Crate_id,
                        type: Crate_type,
                        status: Crate_status
                    },
                    success: function(response) {
                        var response = JSON.parse(JSON.stringify(response));
                        console.log(response);
                        //swal("Successfully Updated!");
                        'use strict';
                        var snackbarContainer = document.querySelector('#demo-toast-example');
                        var data = {
                            message: 'Successfully Updated !',
                            timeout: 3000
                        };
                        snackbarContainer.MaterialSnackbar.showSnackbar(data);
                        // location.reload();
                        // ele.attr('data-id',response.id);
                        ele.attr('hidden', 'true');
                        ele.next().attr('hidden', 'true');
                        ele.prev().show();
                        ele.parent().parent().children().eq(2).children().find('input').val(Crate_type).attr('readonly', 'true').css({
                            'background-color': 'inherit',
                            'border-bottom': ''
                        });
                        ele.parent().parent().children().eq(3).children().find('select').val(Crate_status).attr('disabled', 'true').css({
                            'background-color': 'inherit',
                            'border-bottom': ''
                        });
                        // ele.parent().parent().children().eq(8).children().find('input').val(final_km).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});          
                    },
                    error: function(error) {
                        var error = JSON.parse(error.status);
                        if (error == 401) {
                            var error_msg = JSON.stringify(error.responseJSON.errors);
                            sweetAlert('Oops... ', error_msg, "error");
                        } else if (error == 400) {
                            sweetAlert("Oops...", "Check your input!", "error");
                        }
                    }
                }); //Ajax end
            }); //End confirm alert
    }); //End Post

    $("#crateForm").submit(function(e) {
        var isValid = true;
        $('#crate_code,#crate_type').each(function() {
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
        var crate_Code = $("#crate_code").val();
        var crate_Type = $("#crate_type").val();
        if (isValid == true) {
            swal({
                    title: "Are you sure ?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    showLoaderOnConfirm: true,
                },
                function() {
                    $.ajax({
                        url: 'api/Manage_inventory/add_crates',
                        type: 'POST',
                        data: {
                            code: crate_Code,
                            type: crate_Type
                        },
                        success: function(response) {
                            setTimeout(function() {
                                swal("Successfully Added Crate!");
                                // window.location.href = 'crates';
                            }, 1000);
                        },
                        error: function(error) {
                            var error_msg = JSON.stringify(error.responseJSON.errors);
                            sweetAlert('Oops... ', error_msg, "error");
                            return false;
                        }
                    });
                });
        } else {
            swal({
                title: "please fill all input !",
                timer: 1000,
                showConfirmButton: false
            });
            return false;
        }
        e.preventDefault();
    });

 /*----------------------------------Return Inward page -------------------------------------------------------------*/
    function ReturnInwardCard(offset ,tab) {
        $.ajax({
                url: 'api/manage-inventory/return_inward/offset/' + offset + '/limit/' + 8+'/tab/'+tab,
                type: 'GET',
                success: function(response) {
                    var response = JSON.parse(JSON.stringify(response));
                    var inward = response;
                    inward.data.forEach(function(Index, i) {
                        var date = new Date(inward.data[i].delivery_date);
                        var d = date.getDate();
                        var m = date.getMonth();
                        m += 1; // JavaScript months are 0-11
                        var y = date.getFullYear();
                        var superScript;
                        // alert(proc_data[i].assignee_id);
                        if (d == 1 || d == 31) {
                            superScript = 'st';
                        } else if (d == 2 || d == 22) {
                            superScript = 'nd';
                        } else if (d == 3 || d == 23) {
                            superScript = 'rd';
                        } else {
                            superScript = 'th';
                        }
                        var clone = $(".inventory-card-template").clone();
                        if (tab == 1) {
                        clone.removeClass('inventory-card-template').addClass('returnInventoryCloned1').removeClass('hidden');
                        }
                        if (tab == 2) {
                            clone.removeClass('inventory-card-template').addClass('returnInventoryCloned2').removeClass('hidden');
                        }
                        if(inward.data[i].delivery_date >= currentDate){
                            $('#return-inward-cards').append(clone);
                            return_inward.push(inward.data[i]);
                            $('.show_more_return_inward').removeClass('hidden');
                        }else{
                            $('#return-inward-history-cards').append(clone);
                            return_inward_hist.push(inward.data[i]);
                            $('.show_more_return_inward_hist').removeClass('hidden');
                        }
                        clone.children().children().eq(0).append(inward.data[i].client_name);
                        clone.children().children().eq(1).children().eq(0).append(inward.data[i].order_id);
                        clone.children().children().eq(2).children().eq(0).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                        clone.children().children().eq(3).children().eq(0).attr('href', 'returnInwardInfo?&Oid='+inward.data[i].order_id);
                        clone.children().children().eq(3).children().eq(0).attr('id', 'infoTool' + i);
                        clone.children().children().eq(3).children().eq(1).attr('for', 'infoTool' + i);
                    });
                },
                error:function(error){
                  'use strict';
                  var snackbarContainer = document.querySelector('#demo-toast-example');
                  var data = {message: 'No data found !',timeout:1000};
                  snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  if(return_inward.length == 0 && tab == 1){
                    // $('div .processingTab').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>  Nothing to process. <br> <br> Take Rest for a while.</h3></p></div>');
                     $('.no_inwards_return').removeClass('hidden');
                  }
                  if(return_inward_hist.length == 0 && tab == 2){
                    // $('div .processedTab').append('<div class="mdl-card-status mdl-shadow--2dp history"><p><i class="material-icons status_icon">error</i></p><p><h3> Processing Completed ! </h3></p></div>');
                     $('.no_inwards_return_hist').removeClass('hidden');
                  }
                  return false;
                }
            });
    }
    if (window.location.pathname == '/os/returnInward') {
        ReturnInwardCard(0 ,1);
        //createCookie("currenturl", 'api/manage-items/items/offset/'+0+'/limit/'+8, 1);   
    }

    $('.return_inward_tab_1').one('click', function() {
        ReturnInwardCard($(".returnInventoryCloned1").length, 1);
    });
    $('.return_inward_tab_2').one('click', function() {
        ReturnInwardCard(0, 2);
    });
    $('.show_more_return_inward').on('click', function() {
        var offset = $(".returnInventoryCloned1").length;
        ReturnInwardCard(offset, 1);
    });
    $('.show_more_return_inward_hist').on('click', function() {
        var offset = $(".returnInventoryCloned2").length;
        ReturnInwardCard(offset, 2);
    });

    // card search 
    $("#return_inward_search").donetyping(function(e) {
        var text = $(this).val();
        if (text.length > 0) {
            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(function() {
                $.ajax({
                    url: 'api/manage-inventory/return_inward_search',
                    type: 'POST',
                    data: {
                        q: text
                    },
                    success: function(response) {
                        var response = JSON.parse(JSON.stringify(response));
                        var inward = response;
                        $('.dynamic_search').removeClass('hidden');
                        $('.mdl-layout__tab-bar ,.show_more_return_inward, .show_more_return_inward_hist ,.page-content').addClass('hidden');
                        inward.data.forEach(function(Index, i) {
                        var date = new Date(inward.data[i].delivery_date);
                        var d = date.getDate();
                        var m = date.getMonth();
                        m += 1; // JavaScript months are 0-11
                        var y = date.getFullYear();
                        var superScript;
                        // alert(proc_data[i].assignee_id);
                        if (d == 1 || d == 31) {
                            superScript = 'st';
                        } else if (d == 2 || d == 22) {
                            superScript = 'nd';
                        } else if (d == 3 || d == 23) {
                            superScript = 'rd';
                        } else {
                            superScript = 'th';
                        }

                        var clone = $(".inventory-card-template").clone();
                        clone.removeClass('inventory-card-template').addClass('returnInventoryCloned').removeClass('hidden');

                        $('.searchResult').append(clone);
                        clone.children().children().eq(0).append(inward.data[i].client_name);
                        clone.children().children().eq(1).children().eq(0).append(inward.data[i].order_id);
                        clone.children().children().eq(2).children().eq(0).append(d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
                        clone.children().children().eq(3).children().eq(0).attr('href', 'returnInwardInfo?&Oid='+inward.data[i].order_id);
                        clone.children().children().eq(3).children().eq(0).attr('id', 'infoTool' + i);
                        clone.children().children().eq(3).children().eq(1).attr('for', 'infoTool' + i);
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
            $('.searchResult').empty();
            $(this).data('timer', wait);
        }
    });
/*-------------------------Saleable new -----------------------------------*/
$('#saleable_submit').on('click',function(){
    
    var isValid = true;
    $('#saleable_quant,#saleable_crate').each(function() {
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
    var proc_items_id = [];
    var item_id =[];
    var crate_id =[];
    var quantity =[];

    var rows = $('.saleable-info-row');
    $.each(rows,function(index) {
        var crateCode = crateId($(this).children().eq(3).find('input').val());
        var crate_Id = crateCode.id;
        proc_items_id.push($(this).attr('proc-id'));
        item_id.push($(this).attr('item-id'))
        crate_id.push(crate_Id);
        quantity.push($(this).children().eq(2).find('input').val());
        //console.log(proc_items_id , item_id , crate_id ,quantity);
    });
    
    var data = {
            proc_items_id: proc_items_id,
            item_id: item_id,
            crate_id: crate_id,
            quantity: quantity
        }
        if (isValid == true) {
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
                        url: 'api/manage_inventory/saleable_final',
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            
                            //window.location.href = 'processingStart?procid='+proc_items_id+'&prossid='+processing_id+'&crate_no='+crate_no;
                        },
                        error: function(error) {
                            sweetAlert("Oops...", "Something went wrong!", "error");
                        }
                    });
                })
        }
});


    // saleable info edit 
    $('table').on('click','.saleable-info-row-edit',function(){
        var data_item_id = $(this).parent().attr('data-item-id');
        var data_saleable_id = $(this).parent().attr('data-saleable-id');
        $(this).parent().attr('hidden',false);
        $('.show_saleable_class'+data_saleable_id).addClass('hidden');
        $('.hide_saleable_class'+data_saleable_id).removeClass('hidden');
         
    });
    // saleable reset 
    $('table').on('click','.saleable-info-row-cancel',function(){
        var data_item_id = $(this).parent().attr('data-item-id');
        var data_saleable_id = $(this).parent().attr('data-saleable-id');
        $(this).parent().attr('hidden',false);
        $('.show_saleable_class'+data_saleable_id).removeClass('hidden').attr('hidden',false).show();
        $('.hide_saleable_class'+data_saleable_id).addClass('hidden');
         
    });
    // update row post request
    $('table').on('click', '.saleable-info-row-done', function() {
        var ele = $(this);
        var item_id = $(this).parent().attr('data-item-id');
        var saleable_id = $(this).parent().attr('data-saleable-id');
        var proc_items_id = $(this).attr('data-items');
        var crate_id = crateId($(this).parent().parent().children().eq(5).children().find('input').attr('value')).id;
        var quantity = $(this).parent().parent().children().eq(3).find('input').val();
        //var min_quantity = $(this).parent().parent().children().eq(7).find('input').val();
        swal({
                title: "Are you sure ?",
                text: "click ok and confirm!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_inventory/saleable_update',
                    type: 'POST',
                    data: {
                        id: saleable_id,
                        proc_items_id: proc_items_id,
                        crate_id: crate_id,
                        quantity: quantity,
                        item_id: item_id
                    },

                    success: function(response) {
                        var response = JSON.stringify(response);
                        // setTimeout(function(){
                        swal("Successfully Updated!");
                        $('.show_saleable_class'+saleable_id).removeClass('hidden').attr('hidden',false).show();
                        $('.hide_saleable_class'+saleable_id).addClass('hidden');
                        ele.parent().parent().children().eq(4).html(ele.parent().parent().children().eq(5).children().find('input').val());
                        ele.parent().parent().children().eq(2).html(quantity);
                        // location.reload();
                        // }, 2000);
                    },
                    error: function(error) {
                        var error = JSON.parse(error.status);
                        var error_msg = JSON.stringify(error.responseJSON.errors);
                        if (error == 401) {
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    }
                });
            });
    }); 

    // delete row post request
    $('table').on('click', '.saleable-info-row-delete', function() {
        var ele = $(this);
        var saleable_id = $(this).parent().attr('data-saleable-id');
         swal({
                title: "Are you sure ?",
                text: "click ok and confirm!",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_inventory/saleable_delete',
                    type: 'POST',
                    data: {
                        id: saleable_id
                    },

                    success: function(response) {
                        var response = JSON.stringify(response);
                        // setTimeout(function(){
                        swal("Successfully Deleted!");
                        /*$('.show_undo_class'+saleable_id).removeClass('hidden');
                        $('.show_saleable_class'+saleable_id).removeClass('hidden').attr('hidden',true).hide();
                        $('.hide_saleable_class'+saleable_id).addClass('hidden');*/
                        // location.reload();
                        // }, 2000);
                    },
                    error: function(error) {
                        var error = JSON.parse(error.status);
                        var error_msg = JSON.stringify(error.responseJSON.errors);
                        if (error == 401) {
                            sweetAlert('Oops... ', error_msg, "error");
                        }
                    }
                });
            });
    });

$('#wastage_submit').on('click',function(){
    var isValid = true;
    var proc_items_id = [];
    var item_id =[];
    var crate_id =[];
    var quantity =[];
    var rows = $('.wastage_info_row');
    
    $.each(rows,function(index) {
        var crateCode = crateId($(this).children().eq(4).find('input').val());
        var crate_Id = crateCode.id;
        proc_items_id.push($(this).attr('proc-id'));
        item_id.push($(this).attr('item-id'))
        crate_id.push(crate_Id);
        quantity.push($(this).children().eq(3).find('input').val());
        //console.log(proc_items_id , item_id , crate_id ,quantity);
    });
    
    var data = {
            proc_items_id: proc_items_id,
            item_id: item_id,
            crate_id: crate_id,
            quantity: quantity
        }
        if (isValid == true) {
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
                        url: 'api/manage_inventory/add_wastage',
                        type: 'POST',
                        data: data,
                        success: function(response) {
                            location.reload();
                            //window.location.href = 'processingStart?procid='+proc_items_id+'&prossid='+processing_id+'&crate_no='+crate_no;
                        },
                        error: function(error) {
                            sweetAlert("Oops...", "Something went wrong!", "error");
                        }
                    });
                })
        }
    });
   
    function wastageCards(offset,tab) {
        $.ajax({
            url: 'api/Manage_inventory/wastage/offset/' + offset + '/limit/' + 16+'/tab/'+tab,
            type: 'GET',
            success: function(response) {
                 var wastage_data = JSON.parse(JSON.stringify(response)).data;
                 wastage_data.forEach(function(Index,i){
                       var date = new Date(wastage_data[i].added_on);
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
                       var clone = $('.demoCardwastage').clone();
                       if (tab == 1) {
                         clone.removeClass('demoCardwastage').addClass('wastageCardsCloned1').removeClass('hidden');
                       }
                       if (tab == 2) {
                         clone.removeClass('demoCardwastage').addClass('wastageCardsCloned2').removeClass('hidden');
                       }
                       if(wastage_data[i].added_on >= currentDate){
                         $('div .wastage_today').append(clone);
                         wastage_today.push(wastage_data[i]);
                         $('.show_more_wastage').removeClass('hidden');
                       }else{
                         $('div .wastage_history').append(clone);
                         wastage_history.push(wastage_data[i]);
                         $('.show_more_wastage_hist').removeClass('hidden');
                        } 
                        clone.children().children().eq(0).children().append(wastage_data[i].item_name);
                        clone.children().children().eq(1).children().append("Total Quantity: "+wastage_data[i].total_qty);
                        clone.children().children().eq(3).children().attr('href','wastageInfo?id='+wastage_data[i].item_id);
                        // clone.children().children().eq(2).children().append("Date: "+d + '<sup>' + superScript + '</sup>' + " " + monthArray[m] + ' ' + y);
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
                     if(wastage_today.length == 0 && tab == 1){
                         $('.no_wastage_today').removeClass('hidden');
                     }
                     if(wastage_history.length == 0 && tab == 2){
                     // $('div .processingTab').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>  Nothing to process. <br> <br> Take Rest for a while.</h3></p></div>');
                      $('.no_wastage_history').removeClass('hidden');
                     }
                     return false;
                  }
                     
                 }
        });
        return false;
    }
        
    $('.wastage_tab_1').one('click', function() {
        wastageCards($(".wastageCardsCloned1").length, 1);
    });
    $('.wastage_tab_2').one('click', function() {
        wastageCards(0, 2);
    });
    $('.show_more_wastage').on('click', function() {
        var offset = $(".wastageCardsCloned1").length;
        wastageCards(offset, 1);
    });
    $('.show_more_wastage_hist').on('click', function() {
        var offset = $(".wastageCardsCloned2").length;
        wastageCards(offset, 2);
    });

     //table Edit
  $('table').on('click','.edit_wastage',function(){ 
    $(this).next().removeAttr('hidden');
    $(this).next().next().removeAttr('hidden');
    $(this).hide();
    $(this).parent().parent().children().eq(4).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
    $(this).parent().parent().children().eq(5).children().find('input').removeAttr('readonly').css({'background-color':'inherit','border-bottom':'1px solid rgb(0, 142, 60) '});
  });//End table Edit

  //table Edit->cancel
  $('table').on('click','.cancel_wastage',function(){  
    $(this).attr('hidden','true');
    $(this).prev().attr('hidden','true');
    $(this).prev().prev().show();
    $(this).parent().parent().children().eq(4).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
    $(this).parent().parent().children().eq(5).children().find('input').attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
  });//End table Edit->cancel

  //table Update
  $('table').on('click','.update_wastage',function(){
    var ele          = $(this);
    var id           = $(this).attr('data-id');
    var crateCode    = crateId($('.crate_id').val());
    if(crateCode == null){
        var crate_id = $('.crate_id').attr('data-id');
    }else{
        var crate_id = crateCode.id;
    }
    var quantity     = $(this).parent().parent().children().eq(4).find('input').val();

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
          url: 'api/Manage_inventory/update_wastage',
          type: 'POST',
          data: {id : id , quantity : quantity,crate_id : crate_id},
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
              ele.parent().parent().children().eq(4).children().find('input').val(quantity).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
            //   ele.parent().parent().children().eq(5).children().find('input').val(crate_id).attr('readonly','true').css({'background-color':'inherit','border-bottom':''});
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

  /*-------------------------------Function to Search Wastage Items-----------------------------------------------------------------------------*/

$("#wastage_search").donetyping(function(e) {
      var text = $(this).val();
      if (text.length >= 3) {
          clearTimeout($.data(this, 'timer'));
          var wait = setTimeout(function() {
            $.ajax({
                url: 'api/Manage_inventory/wastage_search',
                type: 'POST',
                data: {
                    q: text
                },
                success: function(response) {
                 var wastage_search = JSON.parse(JSON.stringify(response)).data;
                 $('.dynamic_search').removeClass('hidden');
                 $('.show_more_wastage,.show_more_wastage_hist,.page-content').addClass('hidden');
                 wastage_search.forEach(function(Index,i){
                       var date = new Date(wastage_search[i].added_on);
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
                       var clone = $('.demoCardwastage').clone();
                       clone.removeClass('demoCardwastage').addClass('wastageCardsSearch').removeClass('hidden');
                       $('div .searchResultCards').append(clone);
                        clone.children().children().eq(0).children().append(wastage_search[i].item_name);
                        clone.children().children().eq(1).children().append("Total Quantity: "+wastage_search[i].total_qty);
                        clone.children().children().eq(3).children().attr('href','wastageInfo?id='+wastage_search[i].item_id);
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

    $('#dynamic_div_close').on('click',function(){
      $('.dynamic_search').addClass('hidden');
      $('.page-content,.show_more').removeClass('hidden');
      $('.searchResultCards').empty();
    });
}); //Document Ends Here