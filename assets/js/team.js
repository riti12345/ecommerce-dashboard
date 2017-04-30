$(document).ready(function(){

    $("#teamForm").submit(function(e){
        var isValid = true;
        $('#team_username,#team_mobile,#team_email,#team_password,#team_permissions,#team_permissions').each(function(){
            if ($.trim($(this).val()) == '') {
                isValid = false;
                $(this).css({"border-bottom": "2px solid #ff4646","background": "#fff"});
            }else{
                $(this).css({"border-bottom": "2px solid #299035","background": ""});
                setTimeout($.proxy(function(){
                $(this).css({"border": "","background": ""});},this),2000);   
            }
        });
        var username    = $("#team_username").val();
        var mobile      = $("#team_mobile").val();
        var email       = $("#team_email").val();
        var password    = $("#team_password").val();
        var designation = $("#team_permissions :selected").text();
        var permissions = $("#team_permissions").val();
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
                      url: 'api/manage_team/add_team',
                      type: 'POST',
                      data:{ 
                            username    : username , 
                            mobile      : mobile, 
                            email       : email ,
                            password    : password, 
                            designation : designation, 
                            permissions : permissions 
                           },
                      success: function(response){
                        setTimeout(function(){
                          swal("Successfully Added Team!");
                          window.location.href = 'viewTeam';
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
    
    $.get("api/manage-team/team/all", function(data){
        allTeam =JSON.parse(JSON.stringify(data)).data;
        //console.log(allTeam);
        if((typeof(allTeam) !== "undefined")){
          allTeam.forEach(function(Index, i) {
            var clone=$(".demoCardEmpty").clone();
            clone.removeClass('demoCardEmpty');
            clone.addClass('demoCardCloned');
            clone.removeClass('hidden');
            $('div .team').append(clone);
            $.each(clone,function(Index, data){
                $(this).children().children().eq(0).children().append(allTeam[i].username);
                $(this).children().children().eq(1).children().eq(1).append(allTeam[i].designation);
                $(this).children().children().eq(2).children().eq(1).append(allTeam[i].mobile);
                $(this).children().children().eq(3).children().eq(0).attr('href','teamInfo?tid='+allTeam[i].id);
                $(this).children().children().eq(3).children().eq(1).attr('data-id',allTeam[i].id).attr('data-name',allTeam[i].username).attr('data-mail',allTeam[i].email);
            });
          });
        }
    });
/*------Toggle  button----*/


    $('#t_status').click( function (){
      if ($(this).attr('data-disabled')=='disabled'){
        return false;  
      }
    });

/*------Toggle  button----*/

/*------------------------------Function to Edit Team Info---------------------------------------------------------------------------------------*/
    $('#t_edit').click(function(){
        $(this).hide();
        $('span.info_icon').addClass('info_icon_1').removeClass('info_icon');
        $('.showme').fadeIn().removeClass('hidden');
        $('.tog_disable').removeAttr('disabled');
        $('#t_status').removeAttr('data-disabled');
        $('.hideme').hide();   
    });
/*------------------------------Function to Cancel Team Info---------------------------------------------------------------------------------------*/
    $('#t_cancel').click(function(){
        $('span.info_icon_1').removeClass('info_icon_1').addClass('info_icon');
        $('#t_edit').show();
        $('#t_form').trigger("reset");
        $('.showme').fadeOut().addClass('hidden');
        $('.tog_disable').attr('disabled','true');
        $('#t_status').attr('data-disabled','disabled');
        $('.hideme').show();    
    });


/*==============================Function to Update the Details of Team=======================================================*/ 
    $("#t_save").click(function(){

    if ($("#t_status:checked").val() && $("#t_status:checked").val()=='yes') {var status = 1;}else{var status=0;}
 
        var isValid = true;
        var id             =   $(this).attr("data-id");
        var username       =   $("#t_name").val();
        var mobile         =   $("#t_mobile").val();
        var email          =   $("#t_email").val();
        var password       =   $("#t_password").val();
        var designation    =   $("#t_permissions :selected").text();
        var permissions    =   $("#t_permissions").val(); 
      
        $("#t_name,#t_email,#t_password,#t_mobile,#t_designation").each(function() {
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
                          url: 'api/manage_team/update',
                          type: 'POST',
                          data: {
                                id          :   id          ,
                                username    :   username    ,
                                mobile      :   mobile      ,         
                                email       :   email       ,       
                                password    :   password    ,        
                                designation :   designation , 
                                permissions :   permissions ,
                                status      :   status     
                                },
                          success: function(response){
                                   setTimeout(function(){
                                  swal("Successfully Updated!");
                                  location.reload();
                                  }, 2000);
                          },
                          error: function (xhr, status, error) {
                            if(xhr.status == 404){
                                var error_msg = JSON.stringify(error.responseJSON.errors);
                                sweetAlert('Oops... ',error_msg,"error");
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
    // $('.save'+id).hide();
    });

     $("body").delegate(".link_team", "click", function() {
        var team_id  = $(this).attr('data-id');
        var username = $(this).attr('data-name');
        var email    = $(this).attr('data-mail');

        $.ajax({
	      url: 'api/Manage_employee/link_profile_search',
	      type: 'POST',
	      data:{ 
	      team_id  : team_id ,
	      username : username,
	      email    : email 
	      },
	      success: function(response){
	      var data = JSON.parse(JSON.stringify(response));
          console.log(data);
          return false;
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