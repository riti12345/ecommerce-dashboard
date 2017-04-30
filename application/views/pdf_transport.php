            <head>
            <style>
            table, td, th {    
                border: 1px solid #ddd;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width:100%;
            }
            
             th, td {
                padding:8px;
                text-align: left;
            }

           th {
              background-color: #6CB31D;
              color: black;
           }
            </style>
            </head>

            <table >
            <thead >
              <tr>
               
                <th >DATE</th>
                <th >NAME OF THE DRIVER</th>
                <th>VEHICLE NUMBER</th>
                <th>IN TIME</th>
                 <th>IN KM</th>
                <th>OUT TIME</th>
                <th>OUT KM</th>
                 <th>TOTAL KM</th>

              </tr>
             </thead>
             <tbody >
                  
         <?php 
	      		
  		        foreach($d as $i => $value):
                         		
                    echo "<tr >
                    <td>".$value['date']."</td>
                    <td>".$value['owner_name']."</td>
                    <td>".$value['reg_no']."</td>
                    <td>".$value['in_time']."</td>
                    <td>".$value['in_km']."</td>
                    <td>".$value['out_time']."</td>
                    <td>".$value['out_km']."</td> 
                    <td>".$value['final_km']."</td>
                    </tr>";

			
		   		endforeach;
                   
		?>
                 
            </tbody>
            </table>