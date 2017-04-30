$(document).ready(function(){
	var total_category=[], total_subcategory=[] ,total_assets=[] ,allocated=[] ,free=[];
  
  // Add Assets post request
  $("#assetsForm").submit(function(event) {
        var formData = new FormData();

       formData.append('asset_tag_unique_name'   , $("#assets_name").val());
      // formData.append('cat_name'                , $("#category_name").val());
      // formData.append('sub_name'            , $("#subcategory_name").val());
       formData.append('price'                   , $("#price").val());
       formData.append('prop_name'               , $("#properties").val());
       formData.append('unique_code'             , $("#unique_code").val());
       //formData.append('cat_id'                  , $("#category_name").attr('data-id'));
       formData.append('sub_cat_id'              , $("#subcategory_name").attr('data-id'));
       //formData.append('prop_id'                 , 1);
       formData.append('brand_name'              , $("#brand_name").val());
       formData.append('doc'                     , document.getElementById('doc_bill').files[0]);
       formData.append('date_of_purchase'        , $("#datepicker1").val());
       formData.append('Comments'                , $("#comment").val());
       swal({
           
              title: "Are you sure ?",
              text: "Do you want to add Assets?",
              type: "info",
              showCancelButton: true,
              closeOnConfirm: true,
              animation: "slide-from-top",
              showLoaderOnConfirm: false,
            },
            function() {
                $.ajax({
                    url: 'api/Manage_assets/add_assets',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: 'Successfully added!'
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                      window.location.href = "os_assets";
                    },
                    error: function(error) {
                        var error_msg = JSON.stringify(error.responseJSON.errors);
                        sweetAlert('Oops... ', error_msg, "error");
                    }
                });
            });
            event.preventDefault();
    });
/*--------------------------Display view category and subcategory----------------------*/
  // Display Category Get request
  $.ajax({
        url: 'api/Manage_assets/category',
        type: 'GET',
        success:categorySuccess,
        error:categoryError
  });

  function categorySuccess(response){
    var a = '';
    $.each(response.data,function(key,value){
       a += '<a class="mdl-menu__item"><li value="'+value+'" data-id="'+key+'" >'+value+'<i class="material-icons edit_category_btn hidden ">mode_edit</i></li></a>';
    });
    var a_add = '<a class="mdl-menu__item add_category"><li value="Add Category">Add Category<i class="material-icons add_category_btn hidden">add</i></li></a>';
    $('.cat_div').html(a).append(a_add);

    $('.info-category .mdl-menu__item').each(function(){
      
      $(this).on('click',function(event){
        $('#category_name').val($(this).children().attr('value')).attr('cat-id',$(this).children().attr('data-id'));
        $('#subcategory').find('input').attr('disabled', false);
        $('#subcategory_name').parent().removeClass('is-disabled');
        $('#subcategory_name').attr('cat-id',$('#category_name').attr('cat-id'));
        subcategory_get($('#category_name').attr('cat-id'));
      });

      $(this).on('mouseover',function(){
        $(this).children().children().removeClass('hidden');
      }).on('mouseout',function(){
        $(this).children().children().addClass('hidden');
      });

      // pop up for add and edit category
      $(this).children().children().on('click',function(){

        var dialog = document.querySelector('dialog');
        dialog.showModal();
        if($(this).hasClass('edit_category_btn')){
          $('#edit_category').val($(this).parent().attr('value')).attr('cat-id',$(this).parent().attr('data-id'));
          $('.edit_view').removeClass('hidden');
          $('.add_view').addClass('hidden');
          $('.sub_cat_add_view ,.sub_cat_edit_view').addClass('hidden');
        }else{
          $('.edit_view').addClass('hidden');
          $('.add_view').removeClass('hidden');
          $('.sub_cat_add_view ,.sub_cat_edit_view').addClass('hidden');
        }
      });
    }); 

    // Display card a/c to  category 
    $.each(response.data,function(key,value){
      
      var card_clone = $('.assetsCard').clone();
      card_clone.removeClass('assetsCard').removeClass('hidden').addClass('assetsCardCloned');
      $('.os_category').append(card_clone);
      card_clone.children().attr('card-id',key);
      card_clone.children().find('h4').append(value);

      card_clone.on('click',function(){
        window.document.location.href = 'assetsSubCategory?category_id='+key;
      });
    }); 
    //alert('subcategory'+total_subcategory.length);    
  }

  function categoryError(error){
    if (status == 404 || status == 400) {
      $('#subcategory').find('input').attr('disabled', true);
      $('#subcategory_name').parent().addClass('is-disabled');
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {
            message: 'No Category were Found !'
        };
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  }

  if (window.location.pathname == '/os/assetsSubCategory') {
    var cat_id = $('.os_subcategory').attr('cat-id');
    subcategory_get(cat_id);
  }

  // Display sub Category Get request
  function subcategory_get(id){
    $.ajax({
          url: 'api/Manage_assets/subcategory?id='+id,
          type: 'GET',
          success:subcategorySuccess,
          error:subcategoryError
    });
  }

  function subcategorySuccess(response){
    var a = '';
    $.each(response.data,function(key,value){
       a += '<a class="mdl-menu__item"><li value="'+value+'" data-id="'+key+'" >'+value+'<i class="material-icons edit_sub_category_btn hidden ">mode_edit</i></li></a>';
    });

    var a_add = '<a class="mdl-menu__item add_sub_category"><li value="Add Category">Add subCategory<i class="material-icons add_sub_category_btn hidden">add</i></li></a>';
    $('.sub_cat_div').html(a).append(a_add);

    $('.info-sub_category .mdl-menu__item').each(function(){
      
      $(this).on('click',function(){
        $('#subcategory_name').val($(this).children().attr('value')).attr('data-id',$(this).children().attr('data-id'));
      });

      $(this).on('mouseover',function(){
        $(this).children().children().removeClass('hidden');
      }).on('mouseout',function(){
        $(this).children().children().addClass('hidden');
      });

      //pop up edit and update subcategory
      $(this).children().children().on('click',function(){

        var dialog = document.querySelector('dialog');
        dialog.showModal();
        if($(this).hasClass('edit_sub_category_btn')){
          $('#edit_sub_category').val($(this).parent().attr('value')).attr('sub-id',$(this).parent().attr('data-id'));
          $('.sub_cat_edit_view').removeClass('hidden');
          $('.add_view ,.edit_view').addClass('hidden');
          
        }else if($(this).hasClass('add_sub_category_btn')){
          $('.sub_cat_add_view').removeClass('hidden');
          $('.add_view ,.edit_view').addClass('hidden');
        }
      });
    });

    // Display card a/c to  subcategory 
    $.each(response.data,function(key,value){
      total_subcategory.push(key);
      var card_clone = $('.assetsCardSubCategory').clone();
      card_clone.removeClass('assetsCardSubCategory').removeClass('hidden').addClass('assetsCardSubCategoryCloned');
      $('.os_subcategory').append(card_clone);
      card_clone.children().attr('card-id',key);
      card_clone.children().find('h4').append(value);

      card_clone.on('click',function(){
        window.document.location.href = '/os/assetsSubCategoryInfo?subCategory_id='+key;
      });
    });
  }

  function subcategoryError(error){
    
    if (error.status == 404 || error.status == 400) {
      $('#subcategory').find('input').attr('disabled', true);
      $('#subcategory_name').parent().addClass('is-disabled');
      //var a_add = '<a class="mdl-menu__item add_sub_category"><li value="Add Category">Add subCategory<i class="material-icons add_sub_category_btn">add</i></li></a>';
      //$('.sub_cat_div').html(a_add);
         'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {
            message: 'No subcategory were found'
        };
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  }
  
  if(window.location.pathname == '/os/assetsSubCategoryInfo') {
    var sub_id = $('.assets_subcategoryInfo').attr('sub-id');
    displayAssets(sub_id , 0);
  }
/*---------------------------Display subcategory Details -------------------------------*/
  function displayAssets(sub_id , offset){
    $.ajax({
          url: 'api/Manage_assets/assets/id/'+sub_id+'/offset/'+offset+'/limit/' + 12,
          type: 'GET',
          success:displayAssetsSuccess,
          error:displayAssetsError
    });
  }

  function displayAssetsSuccess(response) {
    var response1 = response.data.assets;
    
    // Display assets details tables  
    /*response1.forEach(function(index,i){
      var t_Row = $('.subcategoryInfo_trow').clone();
      t_Row.removeClass('subcategoryInfo_trow').removeClass('hidden').addClass('subcategoryInfo_trowCloned');
      $('.subcategoryInfo_tbody').append(t_Row);
      //t_Row.children().eq(1).append(response1[i].sub_name);
      t_Row.children().eq(1).append(response1[i].asset_tag_unique_name);
      t_Row.children().eq(2).find('input').val(response1[i].asset_tag_unique_name).attr('value',response1[i].asset_tag_unique_name);
      t_Row.children().eq(3).append(response1[i].brand_name);
      t_Row.children().eq(4).find('input').val(response1[i].brand_name).attr('value',response1[i].brand_name);
      t_Row.children().eq(5).append(response1[i].unique_code);
      t_Row.children().eq(6).find('input').val(response1[i].unique_code).attr('value',response1[i].unique_code);
      t_Row.children().eq(7).append(response1[i].prop_name);
      t_Row.children().eq(8).find('input').val(response1[i].prop_name).attr('value',response1[i].prop_name);
      t_Row.children().eq(9).append(response1[i].price);
      t_Row.children().eq(10).find('input').val(response1[i].price).attr('value',response1[i].price);
      t_Row.children().eq(11).append(response1[i].date_of_purchase);
      t_Row.children().eq(12).children().find('img').attr('src',response1[i].doc);
      t_Row.children().eq(13).append(response1[i].Comments);
      t_Row.children().eq(14).find('input').val(response1[i].Comments).attr('value',response1[i].Comments);
      t_Row.children().eq(15).children().eq(1).attr('data-id',response1[i].id).attr('prop-id',response1[i].prop_id).attr('sub-id',response1[i].sub_cat_id).attr('assets_id',response1[i].assets_id);
    });*/
  }

  function displayAssetsError(error){
    if (error.status == 404 || error.status == 400) {
        'use strict';
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {
            message: 'No assets were found'
        };
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }
  }
/*---------------------------Add and Edit category --------------------------------------*/
  // Add Category post request
  $('#add_btn').on('click',function(){
    var category_name = $('#add_category').val();
      alert('Are You Sure ?');
      $.ajax({
            url:'api/Manage_assets/add_category',
            method:'POST',
            data:{
              cat_name:category_name
            },
            success:function(response){
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {
                  message: 'Successfully added Category!',
                  timeout: 3000
              };
              var dialog = document.querySelector('dialog');
              dialog.close();
              location.reload();
            },
            error:function(error){

            }
      });
  });

  // Edit Category Post request
  $('#edit_btn').on('click',function(){
     var category_name = $('#edit_category').val();
     var category_id = $('#edit_category').attr('cat-id');
      alert('Are You Sure ?');
      $.ajax({
            url:'api/Manage_assets/update_category',
            method:'POST',
            data:{
              cat_name:category_name,
              id:category_id
            },
            success:function(response){
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {
                  message: 'Successfully Updated Category!',
                  timeout: 3000
              };
              var dialog = document.querySelector('dialog');
              dialog.close();
              location.reload();
            },
            error:function(error){

            }
      });
  });


  // close dialog
  $('#asset-dialog-close').on('click',function(){
    var dialog = document.querySelector('dialog');
    dialog.close();
  });

  // open Dialog subcategory
  $('.add_sub_category_btn').on('click',function()
  {
    var dialog = document.querySelector('dialog');
    dialog.showModal();
    if($(this).hasClass('add_sub_category_btn')){
      $('.sub_cat_add_view').removeClass('hidden');
      $('.add_view ,.edit_view').addClass('hidden');
    }else{
      $('.sub_cat_edit_view').removeClass('hidden');
      $('.add_view ,.edit_view').addClass('hidden');
    }
  });

  // open dialog category
  $('.add_category_btn').on('click',function()
  {
    var dialog = document.querySelector('dialog');
    dialog.showModal();
    if($(this).hasClass('add_category_btn')){
      $('.sub_cat_add_view ,.sub_cat_edit_view').addClass('hidden');
      $('.add_view').removeClass('hidden');
    }else{
      $('.edit_view').removeClass('hidden');
      $('.sub_cat_add_view ,.sub_cat_edit_view').addClass('hidden');
    }
  });
/*-------------------------Add and edit subcategory--------------------------------------*/
  // Add SubCategory post request
  $('#add_sub_cat_btn').on('click',function(){
    var sub_category_name = $('#add_sub_category').val();
    var cat_id = $('#subcategory_name').attr('cat-id');
      alert('Are You Sure ?');
      $.ajax({
            url:'api/Manage_assets/add_subcategory',
            method:'POST',
            data:{
              sub_name:sub_category_name,
              cat_id:cat_id
            },
            success:function(response){
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {
                  message: 'Successfully added Sub Category!',
                  timeout: 3000
              };
              var dialog = document.querySelector('dialog');
              dialog.close();
              location.reload();
            },
            error:function(error){

            }
      });
  });

  $('#edit_sub_cat_btn').on('click',function(){
    var sub_category_name = $('#edit_sub_category').val();
    var cat_id =  $('#edit_category').attr('cat-id');
    var sub_id = $('#edit_sub_category').attr('sub-id');
      alert('Are You Sure ?');
      $.ajax({
            url:'api/Manage_assets/update_subcategory',
            method:'POST',
            data:{
              sub_name:sub_category_name,
              cat_id:cat_id,
              id:sub_id
            },
            success:function(response){
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {
                  message: 'Successfully Updated Sub Category!',
                  timeout: 3000
              };
              var dialog = document.querySelector('dialog');
              dialog.close();
              location.reload();
            },
            error:function(error){

            }
      });
  });

/*------------------------Update Assets --------------------------------------------------*/
  $('table').delegate('.assets-info-row-edit','click',function(){
    var id= $(this).attr('data-id');
    $('.show_class'+id).addClass('hidden');
    $('.hide_class').removeClass('hidden');
    $('.hide_class'+id).removeClass('hidden');
  });

  $('table').delegate('.assets-info-row-cancel','click',function(){
    var id= $(this).attr('data-id');
    $('.show_class'+id).removeClass('hidden');
    $('.hide_class'+id).addClass('hidden');
    $('.hide_class').addClass('hidden');
  });

  $('table').delegate('.assets-info-row-done','click',function(){
    var id= $(this).attr('data-id');
    var prop_id = $(this).attr('prop-id');
    var assets_id = $(this).attr('assets-id');
    var brand_name = $(this).parent('td').parent('tr').children().eq(4).find('input').val();
    var asset_tag_unique_name = $(this).parent('td').parent('tr').children().eq(2).find('input').val();
    var unique_code = $(this).parent('td').parent('tr').children().eq(6).find('input').val();
    var prop_name = $(this).parent('td').parent('tr').children().eq(8).find('input').val();
    var price = $(this).parent('td').parent('tr').children().eq(10).find('input').val();
    var Comments = $(this).parent('td').parent('tr').children().eq(14).find('input').val();
    var doc = $(this).parent('td').parent('tr').children().eq(12).children().attr('src');
    var formData = new FormData();

       
       formData.append('id'                      , id);
       formData.append('prop_id'                 , prop_id);
       formData.append('assets_id'               , assets_id);
       formData.append('asset_tag_unique_name'   , asset_tag_unique_name);
       formData.append('brand_name'              , brand_name);
       formData.append('unique_code'             , unique_code);
       formData.append('prop_name'               , prop_name);
       formData.append('price'                   , price);
       //formData.append('doc'                     , document.getElementById('doc_bill').files[0]);
       formData.append('Comments'                , Comments);
    
    swal({
        title: "Are you sure ?",
        text: "Do you want to Update this assets?",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: true,
        animation: "slide-from-top",
        showLoaderOnConfirm: false,
      },
      function() {
        $.ajax({
            url: 'api/Manage_assets/update_assets',
            type: 'POST',
            data:formData,
            contentType: false,
            processData: false,
            success: function(response) {
              $('.show_class'+id).removeClass('hidden');
              $('.hide_class'+id).addClass('hidden');
              'use strict';
              var snackbarContainer = document.querySelector('#demo-toast-example');
              var data = {
                  message: 'Successfully Updated Assets!',
                  timeout: 3000
              };
              location.reload();

            },
            error:function(error){

            }
        });
      });
  });
/*-----------------------------Add properties -----------------------------*/
  var maxField =6,
        x = 1;

    $('#add_properties').on('click', function() {
        if (x < maxField) {
            var html = '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="margin-left: 70px;">' +
                ' <input required class="mdl-textfield__input properties_value" type="text" id="properties" tabindex="8">' +
                '<label class="mdl-textfield__label" for="properties">properties</label>' +
                '</div>'+'<a type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button-sku remove_properties">' +
                '<i class="material-icons">remove_circle</i>' +
                '</a>&emsp;';

            x++;
            $('#properties_append').append(html);
        }
    });
    
    $('body').delegate('.remove_properties', 'click', function() {
        $(this).prev().remove();
        $(this).remove();
    });

    $('.assets-card-event').on('click',function(){

    });

/*----------------------------Allocate Assets------------------------------*/
  // Display assets allocation tables
  
  /*$.ajax({
        url: 'api/Manage_assets/assets',
        type: 'GET',
        success:viewAllocateAssetsSuccess,
        error:viewAllocateAssetsError
  });

  function viewAllocateAssetsSuccess(response){
    var response1 =  response.data.assets;

    response1.forEach(function(index,i){
      var t_row1 = $('.allocateAssets_trow').clone();
      t_row1.removeClass('allocateAssets_trow').removeClass('hidden').addClass('allocateAssets_trowCloned');
      $('.allocateAssets_tbody').append(t_row1);
      t_row1.children().eq(1).append(response1[i].asset_tag_unique_name);
      t_row1.children().eq(2).append(response1[i].unique_code);
      t_row1.children().eq(3).append(response1[i].cat_id);
      t_row1.children().eq(4).append(response1[i].sub_name); 
    });
  }

  function viewAllocateAssetsError(error){
    if (error.status == 404 || error.status == 400) {
      'use strict';
      var snackbarContainer = document.querySelector('#demo-toast-example');
      var data = {
          message: 'No assets were found'
      };
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
      return false;
    }
  }*/
  //Assignee drop down 
    $.ajax({
            url: 'api/Manage_employee/employee',
            type: 'GET',
            success: function(response) {
              var response = JSON.parse(JSON.stringify(response));
              var employees = response.data.employees; 
              for (var i = 0; i < employees.length; i++) {
              $('.allocate_assets').append('<option value=' + employees[i].id + '>' + employees[i].name + '</option>');
              }
            },
            error:function(error){}
    });

  // Allocate assets post request
  $('.allocate_assets').on('change', function() {
    /*if ($(this).val() == 'notselected') {
        var snackbarContainer = document.querySelector('#demo-toast-example');
        var data = {
            message: 'Please select proper Assignee!!!',
            timeout: 2000
        };
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        return false;
    }*/
    var assets_id = $(this).attr('assets-id');
    var assigned_to_id = $(this).find(":selected").val();
    var data = {
                assets_id       : assets_id,
                assigned_to_id  : assigned_to_id  
    }
      swal({
          title: "Are you sure ?",
          text: "Do you want to Allocate this assets?",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: true,
          animation: "slide-from-top",
          showLoaderOnConfirm: false,
          },
            function() {
              $.ajax({
                  url: 'api/Manage_assets/assets_allocation',
                  type: 'POST',
                  data:data,
                  success: function(response) {
                    'use strict';
                    var snackbarContainer = document.querySelector('#demo-toast-example');
                    var data = {
                        message: 'Successfully Allocated!',
                        timeout: 3000
                    };
                    location.reload();
                  },
                  error:function(error){

                  }
              });
      });
  });
      
});