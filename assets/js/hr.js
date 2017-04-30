$(document).ready(function() {
    var pending = [];
    var completed= [];
    var others = [];
/*------------------------------Function to Add Employee-------------------------------------------------------------------*/
    $("#employeeForm").submit(function(event) {
       var emergency_phone = [];
       $(".emergency_contact").each(function(){emergency_phone.push($(this).val());});
       var formData = new FormData();

       formData.append('name'              , $("#employee_name").val());
       formData.append('email'             , $("#employee_email").val());
       formData.append('phone'             , $("#employee_phone").val());
       formData.append('designation'       , $("#employee_desig").val());
       formData.append('localadd'          , $("#employee_temp").val());
       formData.append('permanentadd'      , $("#employee_perm").val());
       formData.append('doj'               , $("#datepicker1").val());
       formData.append('company_assets'    , $("#employee_assets").val());
       formData.append('reporting_manager' , $("#employee_manager").val());
       formData.append('department'        , $("#employee_department").val());
       formData.append('permissions'       , parseInt($("#employee_permissions").val()));
       formData.append('company_no'        , $("#company_phone").val());
       formData.append('company_email'     , $("#company_mail").val());
       formData.append('password'          , $("#employee_password").val());
       formData.append('emergency_no'      , JSON.stringify(emergency_phone));
       formData.append('pan_card'          , document.getElementById('employee_pan').files[0]);
       formData.append('photo'             , document.getElementById('employee_photo').files[0]);
       formData.append('aadhaar_card'      , document.getElementById('employee_aadhaar').files[0]);
       formData.append('other_card'        , document.getElementById('employee_other').files[0]);

       swal({
           
              title: "Are you sure ?",
              text: "Do you want to add this Employee?",
              type: "info",
              showCancelButton: true,
              closeOnConfirm: true,
              animation: "slide-from-top",
              showLoaderOnConfirm: false,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_employee/add_employee',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: 'Successfully added Employee!',
                        timeout: 3000
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                      window.location.href = "employees";
                    },
                    error: function(error) {
                        var error_msg = JSON.stringify(error.responseJSON.errors);
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
            event.preventDefault();
    });

    /*------------------------------Function to Display Employee Cards------------------------------------------------*/
    function displayCard(offset) {
        $.ajax({
            url: 'api/Manage_employee/employee/offset/' + offset + '/limit/' + 12,
            type: 'GET',
            success: function(response) {
                var response = JSON.parse(JSON.stringify(response));
                var employees = response.data.employees;
                // console.log(employees);
                $(".show_more").removeClass("hidden");
                employees.forEach(function(Index, i) {
                    var hr_details=employees[i].hr.length;
                    var clone = $(".employeeCardEmpty").clone();
                    clone.removeClass('employeeCardEmpty').addClass('employeeCardCloned').removeClass('hidden');
                    $('div .grid_hr').append(clone);
                    clone.children().children().eq(0).children().append(employees[i].name);
                    if(employees[i].phone === ''){
                       clone.children().children().eq(1).children().eq(0).children().eq(0).children().eq(1).append("Contact not given.").css({'color':'rgba(0, 0, 0, 0.54)'}); 
                    }else{
                       clone.children().children().eq(1).children().eq(0).children().eq(0).children().eq(1).append(employees[i].phone);
                    }
                    clone.children().children().eq(1).children().eq(0).children().eq(1).children().eq(1).append(employees[i].designation);
                    clone.children().children().eq(1).children().eq(0).children().eq(2).children().eq(1).append(employees[i].company_email);
                    clone.children().children().eq(1).children().eq(1).children().attr('src',employees[i].files[3].doc_url);
                    clone.children().children().eq(2).children().eq(0).attr('href','employeeInfo?employee_id=' + employees[i].id);
                    clone.children().children().eq(2).children().eq(1).attr('href','employeeRequest?employee_id=' + employees[i].id);
                    if(hr_details > 0){
                        clone.children().children().eq(2).children().eq(1).children().eq(0).attr('data-badge',hr_details);
                    }
                    
                }); //End View Employee Cards 
                
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
                    $(".show_more").addClass('hidden');
                    return false;
                }
            }
        });
        return false;
    }

     if (window.location.pathname == '/os/employees') {
        displayCard(0);
    }
    $(".show_more").on('click', function() {
        var offset = $(".employeeCardCloned").length;
        displayCard(offset);
    });

/*---------------------------------------Start of Employee Info page---------------------------------------------------------------*/
    
    /*------Toggle  button----*/
    $('#e_status').click( function (){
      if ($(this).attr('data-disabled')=='disabled'){
        return false;  
      }
    });
    /*------Toggle  button----*/

  /*------------------------------Function to Edit Employee Info-----------------------------------------------------*/
  $('#e_edit').click(function(){
    $(this).hide();
    $('span.info_icon').addClass('info_icon_1').removeClass('info_icon');
    $('.showme').fadeIn().removeClass('hidden');
    $('.tog_disable').removeAttr('disabled');
    $('#e_status').removeAttr('data-disabled');
    $('.hideme').hide();
   
  });
/*------------------------------Function to Cancel Employee Info-------------------------------------------------------*/
  $('#e_cancel').click(function(){
    $('span.info_icon_1').removeClass('info_icon_1').addClass('info_icon');
    $('#e_edit').show();
    $('#e_form').trigger("reset");
    $('.showme').fadeOut().addClass('hidden');
    $('.tog_disable').attr('disabled','true');
    $('#e_status').attr('data-disabled','disabled');
    $('.hideme').show();
  
});

/*==============================Function to Update the Details of Employee================================================*/ 
$("#e_save").click(function(){
     var isValid = true;
     if ($("#e_status:checked").val() && $("#e_status:checked").val()=='yes') {var status = 1;}else{var status=0;} 

     var emergency_phone = [];
     $(".emergency_contact").each(function(){emergency_phone.push($(this).val());});
     var formData = new FormData();
       formData.append('id'                , $(this).attr('data-id'));
       formData.append('team_id'           , $(this).attr('data-team'));
       formData.append('status'            , status);
       formData.append('name'              , $("#employee_name").val());
       formData.append('email'             , $("#employee_email").val());
       formData.append('phone'             , $("#employee_phone").val());
       formData.append('designation'       , $("#employee_desig").val());
       formData.append('localadd'          , $("#employee_temp").val());
       formData.append('permanentadd'      , $("#employee_perm").val());
       formData.append('doj'               , $("#datepicker1").val());
       formData.append('company_assets'    , $("#employee_assets").val());
       formData.append('reporting_manager' , $("#employee_manager").val());
       formData.append('department'        , $("#employee_department").val());
       formData.append('permissions'       , parseInt($("#employee_permissions").val()));
       formData.append('company_no'        , $("#company_phone").val());
       formData.append('company_email'     , $("#company_mail").val());
       formData.append('password'          , $("#employee_password").val());
       formData.append('emergency_no'      , JSON.stringify(emergency_phone));
       formData.append('pan_card'          , document.getElementById('e_pan').files[0]);
       formData.append('photo'             , document.getElementById('e_photo').files[0]);
       formData.append('aadhaar_card'      , document.getElementById('e_aadhaar').files[0]);
       formData.append('other_card'        , document.getElementById('e_other').files[0]);

       
    //   $("#employee_name,#employee_email,#employee_phone,#employee_desig,#employee_perm,#datepicker1,#employee_manager").each(function() {
    //       if ($.trim($(this).val()) == '') {
    //           isValid = false;
    //           $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
    //       } else {
    //           $(this).css({"border-bottom": "2px solid #299035","background": ""});
    //           setTimeout($.proxy(function(){
    //           $(this).css({"border": "","background": ""});},this),2000);               
    //       }
    //   });
    if(isValid == true) {
        swal({   
            title: "Are you sure ?",   
            text: "click ok and confirm!",   
            type: "info",   
            showCancelButton: true,   
            closeOnConfirm: true, 
            animation: "slide-from-top",  
            showLoaderOnConfirm: false, },
            function() {
                    $.ajax({
                        url: 'api/Manage_employee/employee_update',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            'use strict';
                            var snackbarContainer = document.querySelector('#demo-toast-example');
                            var data = {
                                message: 'Successfully Updated !',
                                timeout: 3000
                            };
                            snackbarContainer.MaterialSnackbar.showSnackbar(data);
                            location.reload();
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
        swal({    
              title: "please fill all input !",   
              timer: 1000,   
              showConfirmButton: false });
        return false;
    }
 
});

/*======================================== End of Employee Info page =================================================================*/

/*----------------------------Employee Cards Search------------------------------------------*/
$("#employees_search").donetyping(function(e) {
    var text = $(this).val();
    if (text.length >= 3) {
        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(function() {
            $.ajax({
                    url: 'api/Manage_employee/search',
                    type: 'POST',
                    data: {
                        q: text
                    },
                    success: function(response) {
                        var response = JSON.parse(JSON.stringify(response));
                        $('.dynamic_search').removeClass('hidden');
                        $('.show_more,.page-content').addClass('hidden');
                        response.data.forEach(function(Index, i) {
                            var hr_search = response.data[i].hr.length;
                            var clone = $(".employeeCardEmpty").clone();
                            clone.removeClass('employeeCardEmpty').addClass('employeeCardCloned').removeClass('hidden');
                            $('.searchResult').append(clone);
                            clone.children().children().eq(0).children().append(response.data[i].name);
                            if(response.data[i].phone === ''){
                               clone.children().children().eq(1).children().eq(0).children().eq(0).children().eq(1).append("Contact not given.").css({'color':'rgba(0, 0, 0, 0.54)'}); 
                            }else{
                               clone.children().children().eq(1).children().eq(0).children().eq(0).children().eq(1).append(response.data[i].phone);
                            }
                            clone.children().children().eq(1).children().eq(0).children().eq(1).children().eq(1).append(response.data[i].designation);
                            clone.children().children().eq(1).children().eq(0).children().eq(2).children().eq(1).append(response.data[i].company_email);
                            clone.children().children().eq(1).children().eq(1).children().attr('src',response.data[i].files[3].doc_url);
                            clone.children().children().eq(2).children().eq(0).attr('href','employeeInfo?employee_id=' + response.data[i].id);
                            clone.children().children().eq(2).children().eq(1).attr('href','employeeRequest?employee_id=' + response.data[i].id);
                            if(hr_search > 0){
                                clone.children().children().eq(2).children().eq(1).children().eq(0).attr('data-badge',hr_search);
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

    $('#dynamic_div_close').on('click',function(){
        $('.dynamic_search').addClass('hidden');
        $('.page-content,.show_more').removeClass('hidden');
        $('.searchResult').empty();
    });

/*------------------------------Function to Add Employee Request------------------------------------------------*/
    $("#ReqForm").submit(function(e){
        var isValid = true;
        $('#req_sub,#req_msg').each(function(){
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
            }else{
                $(this).css({"border-bottom": "2px solid #299035","background": ""});
                setTimeout($.proxy(function(){
                $(this).css({"border": "","background": ""});},this),2000);   
            }
        });
        var employee_id= $('.request').attr('data-id');
        var subject     = $("#req_sub").val();
        var message     = $("#req_msg").val();
        var assigned_to = $("#req_employee").attr('data-id');

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
                      url: 'api/Manage_employee/add_hr_request',
                      type: 'POST',
                      data:{ 
                            employee_id : employee_id,
                            subject     : subject    , 
                            message     : message    ,
                            assigned_to : assigned_to
                           },
                      success: function(response){
                        setTimeout(function(){
                          swal("Successfully Added Request!");
                          window.location.href = 'profile';
                        }, 1000);
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
            swal({ title: "please fill all input !", timer: 1000, showConfirmButton: false });
            return false;
        }  
        e.preventDefault();
    });

/*----------------------------------------Employee Request Cards-------------------------------------------------------*/

    if(window.location.pathname == '/os/employeeRequest' || window.location.pathname == '/os/profile'){
        $.get("api/Manage_employee/hr_request/employee_id/"+$('.user_profile').attr('data-id'), function(response){
            var request= response.data.data;
            console.log(request);
            if((typeof(request) !== "undefined")){
              request.forEach(function(Index, i) {
                var clone=$(".demoCardRequest").clone();
                clone.removeClass('demoCardRequest');
                clone.addClass('demoCardRequestCloned');
                clone.removeClass('hidden');
                var formatted_date = new Date(request[i].added_on);
                var d =formatted_date.getDate();
                var m =formatted_date.getMonth();
                var y =formatted_date.getFullYear();
                
                if(request[i].status > 1){
                     if(request[i].status < 3){
                        completed.push(request[i]);
                        $('div .completed_request').append(clone);
                     }
                }else{
                    pending.push(request[i]);
                    $('div .pending_request').append(clone);
                }
                
                $.each(clone,function(Index, data){
                    $(this).children().children().eq(0).children().eq(1).append(request[i].subject);
                    $(this).children().children().eq(1).children().eq(1).append(d + "/" + m + "/" + y);
                    if (window.location.pathname == '/os/employeeRequest') {
                        $(this).children().children().eq(3).children().eq(0).attr('href','hrRequestInfo?request_id='+request[i].id);
                    }else{
                        $(this).children().children().eq(3).children().eq(0).attr('href','employeeReqInfo?request_id='+request[i].id);
                    }
                });
              });
              if(pending.length == 0){
                $('div .pending_request').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>No Request Found!</h3></p></div>');
              }
              if(completed.length == 0){
                $('div .completed_request').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>No Request Found!</h3></p></div>');
              }
            }
        }).fail(function(xhr, status, error) {
            if (xhr.status == 404 || xhr.status == 400) {
                var error_msg = xhr.responseJSON.error;
                'use strict';
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {
                    message: error_msg
                };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                if(pending.length == 0){
                    $('div .pending_request').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>No Request Found!</h3></p></div>');
                }
                if(completed.length == 0){
                    $('div .completed_request').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>No Request Found!</h3></p></div>');
                }
            }
        });
    } 

    if(window.location.pathname == '/os/profile'){
        var employee_id = $('.user_profile').attr('data-id');
        $.get("api/Manage_employee/hr_all_info", function(response){
            var all_request= response.data.data;
            // console.log(all_request);
            if((typeof(all_request) !== "undefined")){
              all_request.forEach(function(Index, i) {
                var clone=$(".demoCardRequest").clone();
                clone.removeClass('demoCardRequest');
                clone.addClass('demoCardRequestCloned');
                clone.removeClass('hidden');
                var formatted_date = new Date(all_request[i].added_on);
                var d =formatted_date.getDate();
                var m =formatted_date.getMonth();
                var y =formatted_date.getFullYear();
                
                if(all_request[i].assigned_to == employee_id){
                    if(all_request[i].status <3){
                        $('div .other_request').append(clone);
                        others.push(all_request[i]);
                    }
                }
                $.each(clone,function(Index, data){
                    $(this).children().children().eq(0).children().eq(1).append(all_request[i].subject);
                    $(this).children().children().eq(1).children().eq(1).append(d + "/" + m + "/" + y);
                    $(this).children().children().eq(3).children().eq(0).attr('href','requestInfo?request_id='+all_request[i].id);
                });
              });
              if(others.length == 0){
                $('div .other_request').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>No Request Found!</h3></p></div>');
              }
            }
        }).fail(function(xhr, status, error) {
            if (xhr.status == 404 || xhr.status == 400) {
                var error_msg = xhr.responseJSON.error;
                'use strict';
                var snackbarContainer = document.querySelector('#demo-toast-example');
                var data = {
                    message: error_msg
                };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                if(others.length == 0){
                    $('div .other_request').append('<div class="mdl-card-status mdl-shadow--2dp info"><p><i class="material-icons status_icon">error</i></p><p><h3>No Request Found!</h3></p></div>');
                }
            }
        });
    } 

    //Request Reply Post 
    $(".reply_request").on('click', function(){
        var id = $(this).attr('data-id');
        var approval_message =$("textarea#request_reply").val();
        var element = $(this);
        data = {
                hr_request_id:id,
                approval_message:approval_message
        };
        swal({
              title:"Are you sure ?",
              text: "Do you want to reply to this Request?",
              type: "info",
              showCancelButton: true,
              closeOnConfirm: true,
              animation: "slide-from-top",
              showLoaderOnConfirm: false,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_employee/hr_approval',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        setTimeout(function() {
                            element.addClass('hidden');
                            location.reload();
                        }, 2000);
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
    });
    
   /*----------------------Request cancel  post request-------------------------------------*/ 
    $(".cancel_request").on('click', function(){
        var id = $(this).attr('data-id');
        var element = $('.mdl-card__hr_requestInfo');
        data = {
                id: id,
        };
        swal({
                title:"Do you want to cancel this Request ?",
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
                    url: 'api/Manage_employee/hr_request_cancel',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        setTimeout(function() {
                            element.addClass('hidden');
                            swal("Request cancelled !");
                        }, 2000);
                        window.location.href = "profile";
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
    });

/*------------------------------------Employee Request Info Page Start---------------------------------------------------------------*/

    /*----------------------Function to Edit Employee Request Info---------------------*/
    $('#request_edit').click(function(){
      $(this).hide();
      $('span.info_icon').addClass('info_icon_1').removeClass('info_icon');
      $('.showme').fadeIn().removeClass('hidden');
      $('.tog_disable').removeAttr('disabled');
      $('.hideme').hide();
    
    });
    
    /*---------------------Function to Cancel Employee Request Info Edit-----------------*/
    $('#request_cancel').click(function(){
      $('span.info_icon_1').removeClass('info_icon_1').addClass('info_icon');
      $('#request_edit').show();
      $('#request_form').trigger("reset");
      $('.showme').fadeOut().addClass('hidden');
      $('.tog_disable').attr('disabled','true');
      $('.hideme').show();
    });

    /*================Function to Update the Details of Employee Request====================*/ 
    $("#request_save").click(function(){
         var isValid = true;
         var formData = new FormData();
           formData.append('id'       , $(this).attr('data-id'));
           formData.append('subject'  , $("#request_subject").val());
           formData.append('message'  , $("#request_message").val());
        
        if(isValid == true) {
            swal({   
                title: "Are you sure ?",   
                text: "click ok and confirm!",   
                type: "info",   
                showCancelButton: true,   
                closeOnConfirm: true, 
                animation: "slide-from-top",  
                showLoaderOnConfirm: false, },
                function() {
                        $.ajax({
                            url: 'api/Manage_employee/update_hr_request',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                'use strict';
                                var snackbarContainer = document.querySelector('#demo-toast-example');
                                var data = {
                                    message: 'Successfully Updated !',
                                    timeout: 3000
                                };
                                snackbarContainer.MaterialSnackbar.showSnackbar(data);
                                location.reload();
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
        swal({    
              title: "please fill all input !",   
              timer: 1000,   
              showConfirmButton: false });
        return false;
        }
    
    });

    // Employee autofill 
    $('body').delegate('#req_employee', 'input', function(e) {
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
/*------------------------------------End of Employee Request Info Page---------------------------------------------------------------*/

});//Document Ends Here