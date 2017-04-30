$(document).ready(function() {
  var item_name = [];
  var quantity = [];
  var m = [];
  var data_graph = [];
  var ctx = document.getElementById("myChart");

  
  /*var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: options
  });*/
    
    $.get("api/Manage_orders/graph/", function(response){
        // console.log(response.data);
        response.data.forEach(function(Index,i){
             item_name.push(response.data[i].item_name);
             quantity.push(response.data[i].quantity);
             
             var myChart = new Chart (ctx,{
                type: 'doughnut',
                responsive: true,
                animation:{
                  animateScale:true
                },
                data: {
                    labels: item_name,
                    datasets: [{
                        label: 'Todays Sale',
                        data: quantity,
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFEB3B',
                            '#43A047',
                            '#3F51B5',
                            '#9C27B0'
                        ],
                        borderWidth: 2
                    }]
                },
      
                options: {
                    responsive : true
                }
             });
        });
        // console.log(item_name);
    });

    $.get("api/Manage_orders/monthly_graph/", function(response){
        var date = new Date();
        // console.log(response);
        response.data.forEach(function(Index,i){
             m.push(monthArray[(response.data[i].month)]);
             data_graph.push(response.data[i].quantity);
            var myBarChart = document.getElementById("myChart2");
            var data =  new Chart (myBarChart , {
              type: 'bar',
              responsive: true,
              data : {
                labels: m,
                datasets: [
                    {
                        label: "My First dataset",
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        data: data_graph,
                    }
                ]
              },
              options: {
                    responsive : true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

        });
    });

});//closed
  