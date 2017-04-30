<?php
	$dm_type = range('A', 'Z');
	$dm_index = array_column($order['dm_ids'],'id');
	// echo $dm_type[array_search($order['track_id'],$dm_index)];
	// echo print_array($dm_index);
	// die;
?>
<html style="width:100%">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
	<style type="text/css">
		body,table,thead,tbody,tfoot,tr,th,td,h4 { font-family:"Lato"; font-size:small; color: #212121;}
		table,thead,tbody,tfoot,tr,th,td{text-align:center;	border: 1px solid #BDBDBD;border-collapse: collapse;}
		tbody {counter-reset:section;}
		html{background-color: #FFFFFF;}
		.count:before{counter-increment:section; content:counter(section);}	
		.footer p{ font-size: 13px;}
		.table_content td{border: 1px solid #CCC;}
		@media print{
		footer {page-break-after: always !important;}
		@page { margin: 5px 20px 10px 50px; }
		}
	</style>
</head>
<body height="1500px">	
<div id="pBreak<?= $order['invoice_id'];?>">
<table width="100%">
  <tbody>
	<tr>
		<td rowspan="5" colspan="5" height="37"><img style="width:70%" height="50" src="<?php echo base_url().'assets/image/logo.png'; ?>"/></td>
	</tr>
	<tr>
		<td colspan="15" height="17"><b> Funky Vegetables & Fruits Pvt. Ltd. </b></td>
	</tr>
	<tr>
		<td colspan="15" height="17"><b> Krishna Mills Compound, Lal Bahadur Shastri Marg, Bhandup Industrial Area, Sonapur, Bhandup West, Mumbai - 400078 </b></td>
	</tr>
	<tr>
		<td colspan="15" height="19"><b> Tel : +91-9209015999  Contact: contact@ordersquare.com  </b></td>
	</tr>
	<tr>
		<td colspan="15" height="19"><b>  CIN Number : U74999MH201SPTC267123  </b></td>
	</tr>
	<tr>
		<td colspan="15" height="32"><b> Delivery Memo </b></td>
	</tr>
	<tr>
		<td colspan="8" style="text-align:left;" height="21" ><b>Name of Company : <?php echo $order['company_name'] ?> </b></td>
		<td colspan="7" style="text-align:left;" height="21" ><b>Name of Consignee : <?php echo $order['name'] ?> </b></td>
	</tr>
	<tr>
		<td rowspan="2" colspan="8" style="text-align:left;" height="21" >Delivery Address : <?php echo $order['delivery_address'] ?> </td>
		<td rowspan="3" colspan="3"><b>Challan No.</b></td>
		<td rowspan="3" colspan="4">
			<b><?php 
					$retailer = ($order['category'] == 6) ? 'R' : 'H';
					if($order['delivery_date'] <= '2017-03-31'){
						echo $retailer.(1000000+$order['invoice_id']).'/'.(date("Y",strtotime($order['delivery_date']))-1).'-'.date("y",strtotime($order['delivery_date'])); 
					}else{
						echo $retailer.($order['invoice_id']).'/'.(date("Y",strtotime($order['delivery_date']))).'-'.(date("y",strtotime($order['delivery_date']))+1); 
					}
			?> </b>
		</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="8" style="text-align:left;" height="17" >POC Contact : <?php echo $order['poc_phone'] ?></td>
		<td rowspan="1" colspan="3"><b>Delivery Date : </b></td>
		<td rowspan="1" colspan="4"><b><?php echo $order['delivery_date']; ?></b></td>
	</tr>
	<tr>
		<td colspan="8" style="text-align:left;" height="21">POC Name : <?php echo $order['poc_name'] ?></td>
		<td rowspan="1" colspan="3"><b>DM Type : </b></td>
		<td rowspan="1" colspan="4"><b><?= $dm_type[array_search($order['track_id'],$dm_index)]; ?></b></td>
	</tr>
	<tr>
		<td width="40" ><b>Sr. No.</b></td>
		<td colspan="4"><b>Name of Item</b></td>
		<td colspan="1"><b>Crate No.</b></td>
		<td colspan="2" style="border-right:none;"><b>Quantity Ordered</b></td>
		<td colspan="1" style="border-left:none;"></td>
		<td colspan="2" style="border-right:none;"><b>Quantity Dispatched</b></td>
		<td colspan="1" style="border-left:none;"></td>
		<td colspan="1"><b>Quantity Received</b></td>
		<td colspan="1"><b>Quantity Returned</b></td>
		<td colspan="1"><b>Remarks</b></td>
	</tr>

	<?php
		 // echo print_array($order);die;	
		$data = $order['order'];  
		(sizeof($data) > 5) ? $trs = sizeof($data) : $trs = 5;
		for ($i=0; $i < $trs; $i++){

			if((isset($data[$i]['item_id']))){

				$unit_price = $data[$i]['price']/$data[$i]['quantity'];	
				if (!empty($data[$i]['final_qty']) || $data[$i]['status'] > 1){ 
					$final_qty = $data[$i]['final_qty']; 
				}else if($data[$i]['status'] <= 1){
					$final_qty = '';
				}
				if (!empty($data[$i]['back_qty']) || $data[$i]['status'] > 1) { 
					$back_qty = $data[$i]['back_qty']; 
				}else if($data[$i]['status'] <= 1){
					$back_qty = '';
				}

				echo '<tr class="table_content">
						<td height="20">'.($i+1).'</td>
						<td colspan="4">'.$data[$i]['item_name'].'</td>
						<td colspan="1"></td>
						<td colspan="2">'.$data[$i]['quantity'].'</td>
						<td colspan="1">'.$data[$i]['item_uom'].'</td>
						<td colspan="2">'.$data[$i]['units'].'</td>
						<td colspan="1">'.$data[$i]['item_uom'].'</td>
						<td colspan="1">'.$final_qty.'</td>
						<td colspan="1">'.$back_qty.'</td>
						<td colspan="1">'.$data[$i]['reason'].'</td>
					</tr>';	
			}else{
				echo '<tr class="table_content">
						<td height="20"></td>
						<td colspan="4"></td>
						<td colspan="1"><br></td>
						<td colspan="2"><br></td>
						<td colspan="1"><br></td>
						<td colspan="2"></td>
						<td colspan="1"></td>
						<td colspan="1"></td>
						<td colspan="1"></td>
						<td colspan="1"></td>
					</tr>';		
			}		
		}    
    ?>
</tbody>
</table>

<div class="footer">
	<p style="padding-top: 12px;margin: 0;"><b>Terms &amp; Conditions :-</b>
	 <ol>
	 	<li> Goods accepted once cannot be returned. In case of any rejection please mention in DM under column quantity returned</b></li>
	 	<li> No Alterations in Bill will be accepted after finalisation  of  Delivery Challan.</li>
	 	<li> All goods rejected need to be returned to our Delivery representative at the time of delivery only. </li>		
		<li> For any queries please call us on <b>9209015999 / 022-40021305 </b></li>
	 </ol>														
	</p>
</div>
<div>
	<h4><b> Authorized Signatory for <?php echo $order['company_name'] ?> </b></h4>
	<?php if(isset($order['sign'])) : ?>
	<img width="160" height="120" src="<?php echo 'data:image/png;base64,'.$order['sign']; ?>" />
	<?php endif; ?>
</div>
<div id="footer<?= $order['invoice_id'];?>"></div>
</div>
</body>
<script>	
	// document.close();
	// window.print();
</script>
<script>
	document.getElementById("pBreak<?= $order['invoice_id'];?>").style.pageBreakBefore = "always";	
	document.getElementById("footer<?= $order['invoice_id'];?>").style.pageBreakAfter = "always";	
</script>	
</html>