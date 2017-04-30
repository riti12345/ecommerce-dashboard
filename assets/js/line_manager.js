$(document).ready(function(){
  var deliveryTeam = []; 
   
  $.get("api/manage-team/team/line_manager", function(data){
    deliveryTeam =JSON.parse(JSON.stringify(data)).data;
    
    for(var i=0; i<deliveryTeam.length; i++){
      var card = $('.line_manager_card').clone();
      card.removeClass('line_manager_card').addClass('line_manager_card_cloned').removeClass('hidden');
      $('.line_manager').append(card);
      
      card.attr('data-team-id',deliveryTeam[i].id);
      card.children().children().eq(0).children().append(deliveryTeam[i].username);
      card.children().children().eq(1).children().eq(0).attr('href','lineManagerHistory?id='+deliveryTeam[i].id).attr('line_manager-id',deliveryTeam[i].id);
    }
  });

  // Search delivery boys card
   $("#line_manager_search_view").on('keyup',function(e){
    var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
    var card = $(".line_manager_card_cloned");
    var input;
    $.each(card,function(index,data){
      input = $.trim($(this).children().children().children().text()).toLowerCase().replace(/ +/g, '');
      (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
    });
  });

  // search row 
  $("#line_manager_history_info_search").on('keyup',function(e){
    var text = $.trim($(this).val()).replace(/ +/g, '').toLowerCase();
    var tRow = $(".del-boy-hist-row");
    var input;
    $.each(tRow,function(index,data){
      input = $.trim($(this).children().text()).toLowerCase().replace(/ +/g, '');
      (!~input.indexOf(text) == 0) ? $(this).show() : $(this).hide();
    });
  });
});