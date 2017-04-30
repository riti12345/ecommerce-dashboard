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
               
                <th >Item Name</th>
                <th >Alternate Name </th>
                <th>UOM</th>
                <th>Price</th>
                <th>Type</th>
              </tr>
             </thead>
             <tbody >
                  
         <?php 
	      		
  		        foreach($d[0]['rate_list'] as $i => $value):
                         		
                    echo "<tr >
                    <td>".$d[0]['rate_list'][$i]['item_name']."</td>
                    <td>".$d[0]['rate_list'][$i]['alternate_name']."</td>
                    <td>".$d[0]['rate_list'][$i]['uom']."</td>
                    <td>".$d[0]['rate_list'][$i]['price']."</td>
                    <td>".$this->config->item($d[0]['rate_list'][$i]['period'],'period')."</td> </tr>";

			
		   		endforeach;
                   
		?>
                 
            </tbody>
            </table>