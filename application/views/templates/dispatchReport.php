<html style="width:100%">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
	<style type="text/css">
		body,table,thead,tbody,tfoot,tr,th,td,p,h1,h2,h3,h4,h5 { 
			font-family:"Lato"; font-size:small;
		 	color: #212121;
		}	
		td {
			letter-spacing: .4px;		}
		@page{margin-top: 0.0in;margin-left: 0.1in;margin-right: 0.1in;}
		html{background-color: #FFFFFF;margin: 0px;}
		body{
			margin: 0mm 0mm 0mm 0mm;
		    /*padding: 30px 50px;*/
		}
		/*.table_content td{border-left: 1px solid #424242 !important;border-bottom: 1px solid #424242 !important;}*/
		@media print{
			footer {page-break-after: always !important;}
			@page { margin: 5px 20px 10px 50px; }
		}
	</style>
</head>
<body height="1500px" >	
<table border="1" cellspacing="0" width="100%" >
	
	<tbody>
	<tr>
		<td rowspan="2" colspan="7" align="center" height="37" valign="top">
			<img  style=" margin-top: 6px;" width="110" height="40" src="<?php echo base_url().'assets/image/logo.png'; ?>" />
		</td>
		<td colspan="7"  align="center" height="17" valign="center" style=";">
			Unit of - Funky Vegetables & Fruits Pvt. Ltd.
		</td>
	</tr>
	<tr>
		<td colspan="7"  align="center" height="17" valign="center" style="">
			Krishna Mills Compound, Lal Bahadur Shastri Marg, Bhandup Industrial Area, Sonapur, Bhandup West, Mumbai - 400078
		</td>
	</tr>
	<tr>
		<td colspan="14" align="center" height="32" valign="middle" style=" ">Warehouse Dispatch Report</td>
	</tr>
	<tr>
		<td align="left" colspan="6" valign="center">Delivery Date :- <?= date("Y-m-d");?> </td>
		<td rowspan="1" align="left" colspan="8" valign="center">Time :-</td>
	</tr>
	<tr>
		<td  colspan="14"  align="left" height="21" valign="center">Restaurant Name :- 
			<?php echo $order[0]['client']['name'] ?> </td>
	</tr>
	<tr>
		<td colspan="14" align="left" height="21" valign="center">Delivery Address :- <?php echo $order[0]['client']['delivery_address'] ?></td>
	</tr>
	<tr>

	</tr>
	<tr>
		
	</tr>
	
	<tr>
		<td width="40" align="center" ><b>Sr. No.</b></td>
		<td align="center" colspan="5"> Name of Item </td>
		<td align="center" colspan="1"> Comments </td>
		<td style="border-right: none;" align="center" colspan="1"> Quantity Ordered </td>
		<td style="border-left: 0; width:40px;"  align="center" colspan="1"></td>
		<td style="border-right: none;" align="center" colspan="1"> Dispatch Quantity </td>
		<td style="border-left: 0; width:40px;"  align="center" colspan="1"> </td>
		<td  align="center" colspan="1"> Deficit Quantity </td>
		<td  align="center" colspan="1"> Check  </td>
		<td align="center" colspan="2"> Crate No.   </td>
	</tr>

	<?php
		 //echo print_array($order[0]);die;	
		$data = $order[0]['items'];  
		(sizeof($data) > 5) ? $trs = sizeof($data) : $trs = 5;
		for ($i=0; $i < $trs; $i++)
		{ 		
			if((isset($data[$i]['item_id'])))
			{
				$unit_price = $data[$i]['price']/$data[$i]['quantity'];	
					echo '<tr class="table_content" >

							<td align="center" height="20" valign="center">'.($i+1).'</td>
							<td align="center" colspan="5" valign="center">'.$data[$i]['item_name']."(".$data[$i]['alternate_name'].")".'</td>
							<td align="center" valign="center">'. $data[$i]['comment'] .'</td>
							<td align="center" colspan="1" valign="center">'. $data[$i]['quantity'] .'</td>
							<td align="center" colspan="1" valign="center">'. $this->config->item($data[$i]['uom'],'uom') .'</td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="2" valign="center"></td>

						</tr>';	
				
			}
			else
			{
					echo '<tr class="table_content" >
							<td align="center" height="20" valign="center"></td>
							<td align="center" colspan="5" valign="center"></td>
							<td align="center"  valign="center"><br></td>
							<td align="center" colspan="1" valign="center"><br></td>
							<td align="center" colspan="1" valign="center"><br></td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="1" valign="center"></td>
							<td align="center" colspan="2" valign="center"></td>
						</tr>';		
			}		
		}    
    ?>
	<tr>
		<td align="left" colspan="10" valign="center">  Dispatch Executive:-  </td>
		<td align="left" colspan="4" valign="center">  Warehouse Out Time:-  </td>
	</tr>
	<tr>
		<td align="left" colspan="10" valign="center">  Dispatch Executive Signature:- </td>
		<td align="left" colspan="4" valign="center">    </td>
	</tr>
	<tr>
		<td align="left" colspan="10" valign="center">   Dispatch Incharge:-     </td>
		<td align="left" colspan="4" valign="center">  Check Time:-   </td>
	</tr>
	<tr>
		<td align="left" colspan="10" valign="center">   Dispatch Incharge Signature:-    </td>
		<td align="left" colspan="4" valign="center">    </td>
	</tr>
	<tr>
		<td align="left" colspan="14" valign="center" height="20">      </td>
	</tr>
	<tr>
		<td align="center" colspan="14" valign="center">   Remarks   </td>
	</tr>
</tbody>
</table>
</body>
<script>	
	// document.close();
	// window.print();
</script>
	
</html>