$(document).ready(function(){
  var deliveryTeam = []; 
   
  $.get("api/manage-team/team/delivery", function(data){
    deliveryTeam =JSON.parse(JSON.stringify(data)).data;
    
        for(var i=0; i<deliveryTeam.length; i++){
          var card = $('.delivery_boy_card').clone();
          card.removeClass('delivery_boy_card').addClass('delivery_boy_cloned').removeClass('hidden');
          $('.delivery_boy').append(card);
          
          card.attr('data-team-id',deliveryTeam[i].id);
          card.children().children().eq(0).children().append(deliveryTeam[i].username);
          card.children().children().eq(1).children().eq(0).attr('href','deliveryBoyHistory?id='+deliveryTeam[i].id).attr('data-assignee-id',deliveryTeam[i].id);
        }
  });

  // Search delivery boys card
   $("#delivery_boy_search_view").on('keyup',function(e){
    var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
    var card = $(".delivery_boy_cloned");
    var input;
    $.each(card,function(index,data){
      input = $.trim($(this).children().children().children().text()).toLowerCase().replace(/ +/g, '');
      (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
    });
  });

  // search row 
  $("#delivery_boy_history_info_search").on('keyup',function(e){
    var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
    var tRow = $(".del-boy-hist-row");
    var input;
    $.each(tRow,function(index,data){
      input = $.trim($(this).children().text()).toLowerCase().replace(/ +/g, '');
      (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
    });
  });

  /*$('.delivery_boy_cloned').on('click',function(){
      var assign_to = $(this).attr('data-team-id');
        alert(assign_to);
      $.get("api/manage_delivery/delivery_boys_history", function(data){

          deliveryTeam =JSON.parse(JSON.stringify(data));
          for(var i=0; i<deliveryTeam.data.length; i++){
            $('.del_boy_name').html(deliveryTeam.data[i].assign_to_name);
            var row = $('.del-boy-hist-row').clone();
            row.removeClass('del-boy-hist-row').addClass('del-boy-hist-row-cloned').removeClass('hidden');
             $('.del-boy-hist-tbody').append(row);
            if(deliveryTeam.data[i].assign_to == assign_to){
              $.each(row,function(data){
                $(this).children().eq(1).append(deliveryTeam.data[i].order_id);
                $(this).children().eq(2).append(deliveryTeam.data[i].client_name);
                $(this).children().eq(3).append(deliveryTeam.data[i].delivery_address);
                $(this).children().eq(4).append(deliveryTeam.data[i].order_status);
                $(this).children().eq(5).append(deliveryTeam.data[i].delivery_date);
                });
            }else{
             
            }
          }
          
         
        });
  });*/

});