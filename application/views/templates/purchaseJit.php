<?php 
// echo print_array($data);die;
 ?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Purchase Orders</title>
	
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
					<th rowspan="5" colspan="2">			
						<img style= alt="sig" src="<?php echo base_url().'assets/image/logo.png'; ?>" />
					</th>
					<th colspan="16"><b> Funky Vegetables & Fruits Pvt. Ltd. </b> </th>
				</tr>
				<tr>
					<th  colspan="16">
					<b>	Gala No.8, Krishna Mills Compound, Lal Bahadur Shastri Marg, Bhandup Industrial Area, Sonapur, Bhandup West, Mumbai - 400078 </b></th>
				</tr>
				<tr>
					<th  colspan="16"><b>  Tel : +91-9209015999  Contact: contact@ordersquare.com </b></th>
				</tr>
				<tr>
					<th  colspan="16"><b>  CIN Number : U74999MH201SPTC267123 </b></th>
				</tr>
				<tr>
					<th  colspan="16"><b>  FSSAI No.11516007000602 </b></th>
				</tr>
				<tr>
					<th  colspan="18" style="font-size: large;color: #C00000;text-align: center;"><b>PURCHASE ORDER</b></th>
				</tr>
				<tr>
					<th  colspan="2"  style="text-align: center;">ID</th>
					<th  colspan="16" style="text-align: left;">JIT<?=(1000000+$data[0]['id'])?></th>
				</tr>
				<tr>
					<th  colspan="2"  style="text-align: center;"><b>Procurement Date</b></th>
					<th  colspan="16" style="text-align: left;"><b><?=date("d-m-Y",strtotime($data[0]['jit_date']))?></b></th>
				</tr>
				<tr>
					<th  colspan="2"  style="text-align: center;"><b>Name of Vendor</b></th>
					<th  colspan="16" style="text-align: left;"></th>
				</tr>
				<tr>
					<th colspan="2"  style="text-align: center;"><b>Company Name</b></th>
					<th colspan="16" style="text-align: left;"><b></b></th>
				</tr>
				<tr>
					<th colspan="2"  style="text-align: center;"><b>Address</b></th>
					<th colspan="16" style="text-align: left;"><b></b></th>
				</tr>
				<tr>
					<th colspan="2"  style="text-align: center;"><b>Contact No.</b></th>
					<th colspan="16" style="text-align: left;"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style='width:5%'><b>Sr. No.</b></td>
					<td style='width:15%' align="center"> <b>Item Name        </b> </td>
					<td style='width:1%'  align="center"> <b>UOM              </b> </td>
					<td style='width:12%' align="center"> <b>Quantity Ordered </b> </td>
					<td style='width:12%' align="center"> <b>Quantity Received</b> </td>
					<td style='width:10%' align="center"> <b>Unit Price       </b> </td>
					<td style='width:10%' align="center"> <b>Remarks          </b> </td>
					<td style='width:10%' align="center"> <b>Transport And Miscellaneous</b> </td> 
					<td style='width:10%'><b>Amount </b></td>
				</tr>
				<?php
					//echo print_array($data);die;	
					$data1 = $data[0]['data'];  
					(sizeof($data1) > 5) ? $trs = sizeof($data1) : $trs = 5;
					for ($i=0; $i < $trs; $i++)
					{ 		
						if((isset($data[0]['data'][$i]['item_id'])))
						{
								echo '<tr>
							
										<td align="center" height="20" class="count"></td>
										<td align="center">'.$data[0]['data'][$i]['item_name'].'</td>
										<td align="center">'. $this->config->item($data[0]['data'][$i]['uom'],'uom') .'</td>
										<td align="center">'. $data[0]['data'][$i]['quantity'] .'</td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center">&emsp; </td>
									</tr>';	
								
						}
						else
						{
								echo '<tr>
										<td align="center" height="20"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										</tr>';
						}		
					}    
	    		?>
				<tr>
					<td style="border: none" align="center" height="20"></td>
					<td style="border: none" align="center"></td>
					<td style="border: none" align="center"></td>
					<td style="border: none" align="center"></td>
					<td style="border: none" align="center"></td>
					<td style="border: none" align="center"></td>
					<td style="border: none" align="center"></td>
					<td style = "text-align:center;" valign="left"><b>Total</b></td>
					<td style="border: none" align="center"></td>
				</tr>

			</tbody>
		</table>
		
		<div>
			<p><b>Terms &amp; Conditions :-</b>
				<ol style="font-size:0.9em;">
					<li>
						All items will be checked for quality and quantity at the warehouse of <b>"Funky Vegetables & Fruits Pvt. Ltd"</b>.<b>"Funky Vegetables & Fruits Pvt. Ltd"</b> will have the final sayin terms of quality of items received as well as weight of items.
					</li>
					<li>
						Rates quoted are subject to mutual negotiation between the "Vendor" and <b>"Funky Vegetables & Fruits Pvt. Ltd"</b> based on the market rates as collated by "<b>Funky Vegetables & Fruits Pvt. Ltd"</b>, except when a fixed rate for items has been agreed upon by "<b>Funky Vegetables & Fruits Pvt. Ltd</b>". 
					</li>
					<li>
						Transport and labour(hamali) charges will be shared equally between the "Vendor" and <b>"Funky Vegetables & Fruits Pvt. Ltd"</b> for one time purchases. 
					</li>
					<li>
						<b>"Funky Vegetables & Fruits Pvt. Ltd"</b> reserves the right to return items within one(1) working day of receiving the items from the "Vendor", if the quality of the items is sub par to the agreed requirements. 
					</li>
					<li>
					 	A quality specification sheet will be provided to the "Vendor" by <b>"Funky Vegetables & Fruits Pvt. Ltd"</b> before start of supply.
					</li>
					<li>
						In case of short supply greater than 10% in weight/quality of items, <b>"Funky Vegetables & Fruits Pvt. Ltd"</b> reserves the right to debit the "Vendor" with the difference in monetary amount for purchase for open market for the items that have not been fulfilled/ have received short supply for. <b>"Funky Vegetables & Fruits Pvt. Ltd"</b> will have the final say in terms of the amount of debit and the "Vendor" will reduce the amount from the current bill issued and will submit the updated bill within one(1) working day. 
					</li>
					<li>
						Bills/Tax Invoices compliant with Indian Accounting Standards(IAS) have to be submitted by the "Vendor" to the authorized person at <b>"Funky Vegetables & Fruits Pvt. Ltd"</b> the same day the items are received. 
					</li>
					<li>
						Payments will be made on a fixed date as mutually decided by the "Vendor" & <b>"Funky Vegetables & Fruits Pvt. Ltd"</b>. No payments will be released prior to proper submission and scrutiny of bills. Once payments are made for a particular period of working, no new bills will be entertained in the future for the same period mentioned above. All payments will be made via Cheque/RTGS. Cash payments will not be made.
					</li>
					<li>
						 In case of sudden default/stoppage of supply by the "Vendor", "Vendor" forfeits any outstanding receivables from <b>"Funky Vegetables & Fruits Pvt. Ltd"</b> and all bills outstanding will be considered settled. 
					</li>
					<li>
						ALL INVOICES TO BE MADE IN THE NAME OF <b>“FUNKY VEGETABLES AND FRUITS PVT.LTD.”</b> 
					</li>
				</ol>
			</p>
		</div>
			<p><b><h3>Authorized Signatory :-</h3></b></p>
			<p>
			  <b style="margin-left:2%">Warehouse Manager</b> 
			  <b style="float:right;margin-right:8%">Vendor</b>
			</p>
			<p style="color: #ccc">
			  <b>(. . . . . . . . . . . . . . . . . . . . . . . )</b> 
			  <b style="float:right;margin-right:1%">(. . . . . . . . . . . . . . . . . . . . . . . )</b>
			</p>
			
	</body>
</html>	
	