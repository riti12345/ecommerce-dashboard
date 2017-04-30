<?php 
// echo print_array($data);die;
 ?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>WAREHOUSE RETURN REPORT</title>
	
	<style>
		body,table{ width:100%;color: #263238 ;}
		table, th, td {
		text-align:center;	
	    border: 1px solid #616161;
	    border-collapse: collapse;
		font-family:"Calibri"; 
		}
		tbody {counter-reset:section;}
		.count:before
		{
		counter-increment:section;
		content:counter(section);
		}	
		@media print{
		  footer {page-break-after: always !important;}
		   @page { margin: 5px 20px 10px 50px; }
		}
	</style>
	</head>
	<body>
		<table>
		    <thead>
				<tr>
					<th style="width:10%" rowspan="5" colspan="2">			
						<img style= alt="sig" src="<?php echo base_url().'assets/image/logo.png'; ?>" />
					</th>
					<th colspan="14"><b> Funky Vegetables & Fruits Pvt. Ltd. </b> </th>
				</tr>
				<tr>
					<th  colspan="14">
					<b>	Gala No.8, Krishna Mills Compound, Lal Bahadur Shastri Marg, Bhandup Industrial Area, Sonapur, Bhandup West, Mumbai - 400078 </b></th>
				</tr>
				<tr>
					<th  colspan="14"><b>  Tel : +91-9209015999  Contact: contact@ordersquare.com </b></th>
				</tr>
				<tr>
					<th  colspan="14"><b>  CIN Number : U74999MH201SPTC267123 </b></th>
				</tr>
				<tr>
					<th  colspan="14"><b>  FSSAI No.11516007000602 </b></th>
				</tr>
				<tr>
					<th  colspan="16" style="font-size: large;color: #C00000;text-align: center;"><b>WAREHOUSE RETURN REPORT</b></th>
				</tr>
				<tr>
					<th  colspan="8"  style="text-align: left;"><b>Vendor Name:- <?= get_vendor_by_id($data[0]['vendor_id'])['name']; ?></b></th>
                    <th  colspan="8"  style="text-align: left;"><b>Date:- <?=$data[0]['procure_date'];?></b></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="width:1%"><b>Sr. No.</b></td>
					<td style='width:40%' align="center" colspan="7"><b>Item Name        </b> </td>
					<td style='width:18%' align="center"colspan="2"> <b>Return QTN       </b> </td>
					<td style='width:40%' align="center"colspan="7"> <b>Reason       </b> </td>
				</tr>
				<?php
					$data1 = $data[0]['data'];  
					(sizeof($data1) > 5) ? $trs = sizeof($data1) : $trs = 5;
					for ($i=0; $i < $trs; $i++){ 		
						if((isset($data[0]['data'][$i]['item_id']))){
								echo  '<tr>
										<td align="center" height="20" class="count" ></td>
										<td align="center" colspan="7">'.get_item_by_id($data[0]['data'][$i]['item_id'])['item_name'].'</td>
										<td align="center" colspan="1">'. $data[0]['data'][$i]['quantity'] .'</td>
										<td align="center" colspan="1">'. $this->config->item(get_item_by_id($data[0]['data'][$i]['item_id'])['uom'],'uom') .'</td>
										<td align="center" colspan="7"></td>
										
									</tr>';	
						}else{
								echo '<tr>
										<td align="center" height  ="20"></td>
										<td align="center" colspan = "7"></td>
										<td align="center" colspan = "1"></td>
										<td align="center" colspan = "1"></td>
										<td align="center" colspan = "7"></td>
									  </tr>';
						}		
					}    
	    		 ?>
				<tr>
					<td style="" align="center" height="20" colspan="6"><b>Warehouse Rep:-</b></td>
					<td style="" align="center" colspan="10"></td>
				</tr>
				<tr>
					<td style = "text-align:center;" valign="left" colspan="6"><b>Warehouse Rep. Signature:-</b></td>
					<td style = "text-align:center;" valign="left" colspan="10"></td>
				</tr>
					<tr>
					<td style = "text-align:center;" valign="left" colspan="6"><b>Procurement Executive:-</b></td>
					<td style = "text-align:center;" valign="left" colspan="10"></td>
					
				</tr>
				<tr>
					<td style = "text-align:center;" valign="left" colspan="6"><b>Procurement Executive Signature:-</b></td>
					<td style = "text-align:center;" valign="left" colspan="10"></td>
				</tr>

			</tbody>
		</table>
	</body>
</html>	
	