$(document).ready(function() {

    (function() {
        var previousScroll = 0;
        $('.mdl-layout__content').scroll(function() {
            var currentScroll = $(this).scrollTop();
            if (currentScroll > previousScroll) {
                $('.fixed-action-btn').fadeOut();
            } else {
                $('.fixed-action-btn').fadeIn();
            }
            previousScroll = currentScroll;
        });
    }());
    /*------------------------------------table sort function--------------------------------------*/
    $('th').click(function() {
        var table = $(this).parents('table').eq(0);
        var tr = table.find('tr:gt(0)').toArray().sort(compare($(this).index()));
        this.asc = !this.asc;
        if (!this.asc) {
            tr = tr.reverse();
        }
        for (var i = 0; i < tr.length; i++) {
            table.append(tr[i]);
        }
    });

    function compare(index) {
        return function(a, b) {
            var A = getValue(a, index),
                B = getValue(b, index);
            return $.isNumeric(A) && $.isNumeric(B) ? A - B : A.localeCompare(B);
        }
    }

    function getValue(row, index) {
        return $(row).children('td').eq(index).html();
    }
    // sweetalert for tab key
    (function() {
        var _swal = window.swal;
        window.swal = function() {
            var previousWindowKeyDown = window.onkeydown;
            _swal.apply(this, Array.prototype.slice.call(arguments, 0));
            window.onkeydown = previousWindowKeyDown;
        };
    })();
    /*---------------------date validation ----------------------------------------------------------*/
    /* $('#Date,#jitProcurementDate,#bill_date').datepicker({
         dateFormat: 'yy-mm-dd',
         changeMonth:true,
         changeYear:true
     });*/
    /*$('#to').datepicker({
        defaultDate: "+1w",
        beforeShow: function() {
            $(this).datepicker('option', 'minDate', $('#delivery_date').val());
            if ($('#delivery_date').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
    });*/
    /*------------------------------------autocomplete function--------------------------------------*/

    window.autoComplete = function(term, json, $selector) {
        var clientCode = '';
        json.sort();
        for (var i = 0; i < json.length; i++) {
            if (json[i] != null) {
                clientCode += '<li class="" value="' + json[i] + '" id="li">' + json[i] + '</li>';
            }
        }

        $selector.html(clientCode);
        $selector.children().each(function() {
            var text = $(this).text(),
                textL = $.trim(text).toLowerCase().replace(/ +/g, '');
            //htmlR = '<b>' + text.substr(0, length) + '</b>' + text.substr(length);
            if (!~textL.indexOf(term) != 0) {
                $(this).remove();
            } else {
                $(this).addClass('active');
                $selector.children().eq(0).addClass('selected');
            }
        });

        $selector.children().on('mousedown', function(e) {
            e.preventDefault();
        }).on('click', function() {
            var name = $(this).attr('value');
            $(this).parent().parent().prev().prev().prev().attr('value', $('.selected').attr('value'));
            $(this).parent().parent().prev().prev().prev().val($('.selected').attr('value'));
            //$(this).parent().parent().prev().append('');
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

    }
    window.mdlActionClose = function(selector){
       selector.parent().addClass('hidden');
       selector.parent().prev().removeClass('hidden');
       selector.prev().text('');
       selector.parent().parent().children().eq(0).attr('value', '').attr('data-id', '').attr('item-id', '').attr('vendor-id', '');
       selector.parent().parent().children().eq(0).val('');  
    }
    $(".input_search").on("keydown", function(e) {
        var $listItems = $(this).next().next().next().children().children(); //li
        var key = e.keyCode,
            $selected = $listItems.filter('.selected'),
            $current;
        $(this).next().children().eq(1).on('click', function() {
            var elem = $(this);
            mdlActionClose(elem);
            var row = $('.select_item_row');
            row.children().eq(1).nextUntil(6).find('input').val('').focus();
            //row.children().eq(4).find('input').val('');
            var single_item_add_row = $('.addItem');
            single_item_add_row.children().eq(2).nextUntil(5).find('input').val('').attr('value','');
            /*single_item_add_row.children().eq(3).children().children().val('');
            single_item_add_row.children().eq(4).children().children().val('');
            single_item_add_row.children().eq(5).children().children().attr('value', '').val('');*/

            var row = $('.update_add_row');
            row.children().eq(2).find('input').val('');
        });

        if (key != 13 && key != 9) return;
        $listItems.removeClass('selected');

        // enter key
        if (key == 13 || key == 9) {
            $('.is-focused').removeClass('is-focused');
            if ($selected.length > -1) {
                $selected.length = -1;
                $(this).addClass('hidden');
                $(this).next().removeClass('hidden');
                $(this).next().children().eq(0).html($selected.attr('value'));
                $(this).attr('value', $selected.attr('value')).attr('data-id', $selected.attr('id')).attr('vendor-id', $selected.attr('vendor_id')).attr('item-id', $selected.attr('item_id')).attr('sku_id', $selected.attr('sku_id')).attr('sku_val', $selected.attr('sku')).attr('transport_id', $selected.attr('transport_id')).attr('reg_no', $selected.attr('reg_no'));
                $(this).val($selected.attr('value'));
                $(this).next().next().next().addClass('hidden');
                $listItems.parent().empty();
                $listItems.removeClass('selected');

                if ($(this).is('#stepFive_selectItem')) {
                    var text = $('#stepFive_selectItem').val(),
                        typeCode = 1;
                    itemId = $('#stepFive_selectItem').attr('item-id');
                    $('#stepFive_selectItem').attr('item-id', itemId);
                    var value = $('#stepFive_selectItem').attr('sku_val');
                    var sku = $('#stepFive_selectItem').attr('sku_id');
                    //$('#stepFive_sku').val(value).attr('sku-id',sku);

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
                }

                /*if($(this).is('#vendor_id')){
                  var vendorName = $(this).attr('value');
                  $(this).val(vendorName);
                  var row = $('.bill_add_row'); //tr
                  var vendor_Id = getVendorID(vendorName);
                  row.children().eq(2).children().children().eq(0).attr('vendor-id',vendor_Id);
                }*/
            }
        }
        e.preventDefault();
        return false;
    }).on("keyup", function(e) {
        var $listItems = $(this).next().next().next().children().children(); //li
        var key = e.keyCode,
            $selected = $listItems.filter('.selected'),
            $current;
        if (key != 40 && key != 38) return;
        $listItems.removeClass('selected');

        // Down key
        if (key == 40) {
            //$selector.children().off('mouseover');
            if (!$selected.length || $selected.is(':last-child')) {
                $current = $listItems.eq(0);
                $current.addClass('selected');
                // $current.scrollTop = $current.scrollTop +25;
            } else {
                $current = $selected.next();
                $current.addClass('selected');
            }
        }
        // Up key
        else if (key == 38) {
            //$selector.children().off('mouseover');
            if (!$selected.length || $selected.is(':first-child')) {
                $current = $listItems.last();
                $current.addClass('selected');
            } else {
                $current = $selected.prev();
                $current.addClass('selected');
            }
        }
        e.preventDefault();
        return false;
    });

    /*------------------------------------filter function--------------------------------------*/

    // filter function for finding client details by id
    /*
  
    // filter function for finding client id by name
    window.searchClientId = function(name) {
      obj = allClients.filter(function(obj) {
          return obj.name === name;
      })[0];
      //console.log(obj);
      return obj;
    }*/

    // filter function for finding item id by name
    /*window.searchItemId = function(name) {
      obj = allItems.data.items.filter(function(obj) {
        if(obj.alternate_name == name)
        {
          return obj.alternate_name === name;
        }else if(obj.item_name == name){
          return obj.item_name === name;
        }
      })[0];
      //console.log(obj);
      return obj;
    }*/

    // filter function for finding name by item id
    window.searchItemName = function(text, typeCode, id) {
        return $.ajax({
            url: 'api/manage-items/search',
            type: 'POST',
            data: {
                q: text,
                type: typeCode
            },
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                obj = response.data.data.items.filter(function(obj) {
                    return obj.id === id;
                })[0];
                return obj;
                console.log(obj);
            },
            error: function(error) {

            }
        });

    }
    // filter function for finding client details
    /*window.searchClientDetails = function(name) {
      $.ajax({
            url: 'api/manage-clients/search',
            type: 'POST',
            data: {q   : name },
            success: clientRespCallBack
      });
    }

    function clientRespCallBack(clientData){
    console.log(clientData);
    }*/
    // filter function for finding market id by name
    window.getMarketID = function(mrkt_name) {
        obj = allMarkets.filter(function(obj) {
            return obj.name === mrkt_name;
        })[0];
        //console.log(obj);
        return obj;
    }

    // filter function to get vendor id from vendor name 
    /*window.getVendorID = function(vendor_name){
      var vendor_id;
      for (i = 0; i < allVendors.length; i++) {
         if(allVendors[i].name == vendor_name){
           vendor_id =  allVendors[i].id;                        
          }
      }
    return vendor_id;
    } */

    // filter function to get vendor id from vendor name 
    /*window.getVendorName = function(vendor_id){
      var vendor_name;
      for (i = 0; i < allVendors.length; i++) {
         if(allVendors[i].id == vendor_id){
           vendor_name =  allVendors[i].name;                        
          }
      }
    return vendor_name;
    }*/

    window.estQuantity = function(id) {
        var estd_qty;
        for (var i = 0; i < estdQty.length; i++) {
            if (id == estdQty[i].ItemID) {
                estd_qty = estdQty[i].TotalQty;
            }
        }
        return estd_qty;
    }

    window.crateId = function(name) {
        obj = allCrates.filter(function(obj) {
            return obj.code === name;
        })[0];
        //console.log(obj);
        return obj;
    }

    // window.getVehicleNumber = function(name){
    //   obj = allTransport.filter(function(obj){
    //       return obj.owner_name = name;
    //   })[0];
    //   return obj;
    // }

    /*------------------------------------dynamic search function--------------------------------------*/
    // Item search function
    window.itemSearch = function(text, typeCode, $selector) {
        var html_li = '';
        $.ajax({
            url: 'api/manage-items/search',
            type: 'POST',
            data: {
                q: text,
                type: typeCode
            },
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                var json = [];
                //$('.mdl-spinner-item').addClass('is-active');
                for (var i = 0; i < response.data.data.items.length; i++) {
                    var name = response.data.data.items[i].item_name;
                    var alternate_name = response.data.data.items[i].alternate_name;
                    var id = response.data.data.items[i].id;
                    var skuData = response.data.data.items[i].sku;
                    //console.log(skuData);

                    html_li += '<li class="" value="' + name + '" item_id="' + id + '">' + name + ' / ' + alternate_name + '</li>';
                }
                $selector.html(html_li);
                $selector.children().eq(0).addClass('selected');
                $selector.children().on('mousedown', function(e) {
                    e.preventDefault();
                }).on('click', function() {
                    var name = $(this).attr('value');
                    var id = $(this).attr('item_id');
                    var sku = $(this).attr('sku');

                    $(this).parent().parent().prev().prev().prev().attr('value', $('.selected').attr('value')).attr('item-id', id);
                    $(this).parent().parent().prev().prev().prev().val($('.selected').attr('value'));
                    //$(this).parent().parent().prev().append('');
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
            },
            error: function(xhr, status, error) {}
        });
    }

    // vendor autocomplete function
    window.vendorSearch = function(text, typeCode, $selector) {
        var clientCode = '';
        $.ajax({
            url: 'api/manage_vendors/search',
            type: 'POST',
            data: {
                q: text,
                type: typeCode
            },
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                //console.log(response.data);
                var json = [];
                for (var i = 0; i < response.data.length; i++) {
                    var name = response.data[i].name;
                    var id = response.data[i].id;

                    json.push(name);
                    if (json[i] != null) {
                        clientCode += '<li class="" value="' + json[i] + '" vendor_id="' + id + '">' + json[i] + '</li>';
                    }
                }
                $selector.html(clientCode);
                $selector.children().eq(0).addClass('selected');
                $selector.children().on('mousedown', function(e) {
                    e.preventDefault();
                }).on('click', function() {
                    var name = $(this).attr('value');
                    var id = $(this).attr('vendor_id');
                    $(this).parent().parent().prev().prev().prev().attr('value', $('.selected').attr('value')).attr('vendor-id', id);
                    $(this).parent().parent().prev().prev().prev().val($('.selected').attr('value'));
                    //$(this).parent().parent().prev().append('');
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
            },
            error: function(xhr, status, error) {}
        });
    }

    // vehicle autocomplete function
    window.vehicleSearch = function(text, typeCode, $selector) {
        var clientCode = '';
        $.ajax({
            url: 'api/manage_delivery/search',
            type: 'POST',
            data: {
                q: text
            },
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                // console.log(response.data);
                var json = [];


                for (var i = 0; i < response.data.length; i++) {
                    var driver_name = response.data[i].owner_name;
                    var transport_id = response.data[i].id;
                    var reg_no = response.data[i].reg_no;


                    json.push(driver_name);
                    if (json[i] != null) {
                        clientCode += '<li class="" value="' + json[i] + '" reg_no="' + reg_no + '" transport_id="' + transport_id + '">' + json[i] + '</li>';
                    }
                }
                $selector.html(clientCode);
                $selector.children().eq(0).addClass('selected');
                $selector.children().on('mousedown', function(e) {
                    e.preventDefault();

                }).on('click', function() {
                    var driver_name = $(this).attr('value');
                    var transport_id = $(this).attr('transport_id');

                    $(this).parent().parent().prev().prev().prev().attr('value', $('.selected').attr('value')).attr('transport_id', transport_id).attr('reg_no', reg_no);
                    $(this).parent().parent().prev().prev().prev().val($('.selected').attr('value'));
                    // $(this).parent().parent().prev().append('');
                    $(this).parent().parent().prev().prev().removeClass('hidden');
                    $(this).parent().parent().prev().prev().children().eq(0).html($('.selected').attr('value'));
                    $(this).parent().parent().prev().prev().prev().addClass('hidden');
                    $(this).parent().parent().addClass('hidden');
                    //  $(this).parent().parent().parent().parent().parent().next().children().children().eq(0).val(reg_no);
                    $(this).parent().empty();
                    $(this).removeClass('selected');
                });

                $('body').click(function() {
                    $selector.parent().addClass('hidden');
                });

                $selector.children().on('mouseover', function() {
                    $selector.children().removeClass('selected');
                    $(this).addClass('selected');
                    // console.log($('.selected').text());
                });
            },
            error: function(xhr, status, error) {}
        });
    }

/*-------------------------mdl-spiner loading---------------------------------------------------*/    
    $.ajaxSetup({
        beforeSend: function() {
            $('.mdl-spinner').addClass('is-active');
            $('#p2').fadeIn();
        },
        complete: function() {
            $('.mdl-spinner').removeClass('is-active');
            $('#p2').fadeOut();
        }

    });
    /*var data = [];
    for (var i = 0; i < 100000; i++) {
        var tmp = [];
        for (var i = 0; i < 100000; i++) {
            tmp[i] = 'hue';
        }
        data[i] = tmp;
    };
    $.ajax({
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    console.log(percentComplete);
                    $('#p2').css({
                        width: percentComplete * 100 + '%'
                    });
                    if (percentComplete === 1) {
                        $('#p2').addClass('hide');
                    }
                }
            }, false);
            xhr.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    console.log(percentComplete);
                    $('#p2').css({
                        width: percentComplete * 100 + '%'
                    });
                }
            }, false);
            return xhr;
        },
        type: 'POST',
        url: "/os/items",
        data: data,
        success: function (data) {}
    });*/

    /*----------------------------donetyping time interval for keyup/keydown ajax request -----------------*/
    $.fn.extend({
        donetyping: function(callback, timeout) {
            timeout = timeout || 0.1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el) {
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i, el) {
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste', function(e) {
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type == 'keyup' && e.keyCode != 8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function() {
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur', function() {
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
    /*-----------------------------Print table ------------------------------------------------------------*/
    window.PrintTable = function(divId) {
        var divToPrint = document.getElementById(divId);
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    /*-------------------------Export table to excel ,csv ,pdf ---------------------------*/
    $('.export').on('change',function(){
        
        var table
        if(document.getElementById('disp_search_table')){
            table = $('#disp_search_table');
        }else if(document.getElementById('disp_hist_table')){
            table = $('#disp_hist_table');
        }else if(document.getElementById('disp_dispatched_table')){
            table = $('#disp_dispatched_table');
        }else if(document.getElementById('disp_upcom_table')){
            table = $('#disp_upcom_table');
        }else if(document.getElementById('order_today_table')){
            table = $('#order_today_table');
        }else if(document.getElementById('order_hist_table')){
            table = $('#order_hist_table');
        }else if(document.getElementById('order_search_table')){
            table = $('#order_search_table');
        }else if(document.getElementById('item_table')){
            table = $('#item_table');
        }
        else {
            table = $('table');
        }
        
        if($(this).find(":selected").val() == 'print'){
            $('table').attr('id','export');
            $('.print_hide').hide();
            window.print();
        }else if($(this).find(":selected").val() == 'excel'){
            table.tableExport({
                 type:'excel',
                 escape:'false',
                 ignoreColumn:[0]
            });
        }else if($(this).find(":selected").val() == 'pdf'){
            //dialog.showModal();
            table.tableExport({
                 type:'pdf',
                 escape:'false',
                 pdfFontSize:7,
                 pdfLeftMargin:-40,
                 ignoreColumn:[0],
                 trimWhitespace: true,
                 ignoreCSS: ".tableexport-ignore",
                 emptyCSS: ".tableexport-empty",
                 htmlContent:'false',
                 consoleLog:'false' 
            });
        }else if($(this).find(":selected").val() == 'csv'){
            table.tableExport({
                ignoreColumn: [0],
                tableName:'client_list',
                type:'csv',
                pdfFontSize:14,
                pdfLeftMargin:20,
                escape:'true',
                htmlContent:'false',
                consoleLog:'false'
            });
        }
    });
    /*-------------------------cookies ------------------------------------------------------*/
    window.newDoc = function(url) {
        createCookie("currenturl", url, 1);
    }

    window.createCookie = function(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        } else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    //readCookie('http://localhost/os/items');
    function eraseCookie(name) {
        createCookie(name, "", -1);
    }
/*------------------------------navbar onclick-----------------------------------*/
    switch(window.location.pathname){
        case "/os/generalRateList":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(1).addClass('is_active');
                break;
        case "/os/items":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(2).addClass('is_active');
                break;
        case "/os/addItem":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(2).addClass('is_active');
                break;
        case "/os/clients":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(4).addClass('is_active');
                break;
        case "/os/addClient":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(4).addClass('is_active');
                break;
        case "/os/vendors":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(6).addClass('is_active');
                break;
        case "/os/addVendor":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(6).addClass('is_active');
                break;
        case "/os/order":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(9).addClass('is_active');
                break;
        case "/os/addOrder":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(9).addClass('is_active');
                break;
        case "/os/inward":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(12).addClass('is_active');
                break;
        case "/os/returnInward":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(12).addClass('is_active');
                break;
        case "/os/raw":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(12).addClass('is_active');
                break;
        case "/os/salable":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(12).addClass('is_active');
                break;
        /*case "/os/leftOvers":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(12).addClass('is_active');
                break;
        case "/os/processing":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(19).addClass('is_active');
                break;
        case "/os/processingIssue":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(19).addClass('is_active');
                break;*/
        case "/os/procurement":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(18).addClass('is_active');
                break;
        case "/os/jit":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(18).addClass('is_active');
                break;
        case "/os/dispatch":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(21).addClass('is_active');
                break;
        case "/os/delivery_boy":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(21).addClass('is_active');
                break;
        case "/os/viewVehicle":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(25).addClass('is_active');
                break;
        case "/os/vehicleUpdates":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(25).addClass('is_active');
                break; 
        case "/os/warehouse_Manager":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(29).addClass('is_active');
                break;
        case "/os/line_Manager":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(29).addClass('is_active');
                break;
        case "/os/employees":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(33).addClass('is_active');
                break;
        case "/os/addEmployee":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(33).addClass('is_active');
                break;
        case "/os/os_assets":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(37).addClass('is_active');
                break;
        case "/os/addAssets":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(37).addClass('is_active');
                break;
        case "/os/allocateAssets":
                $('.mdl-navigation__link').removeClass('is_active');
                $('.demo-navigation').children().eq(37).addClass('is_active');
                break;       
        default: $('.demo-navigation').children().eq(0).addClass('is_active');
    }

/*-----------------------permissions -------------------------------------------*/
/*var permission = $('#employee_permissions').find(":selected").val();
    switch(permission){
      case 8:
       $('.itemsChild, .clientsChild, .vendorsChild, .orders_p, .ordersChild,.inward,.processing,.procurement,.jit,.dispatch,.transport,.warehouse,.employees,.assets').addClass('hidden');
        break;
      case 4:
      //alert('case4');
        //$('#itemsChild,.ordersChild').addClass('hidden');
        $('.itemsChild, .clientsChild, .vendorsChild, .transport,.employees,.assets').addClass('hidden');
        break;
    }*/

});