<?php if(isset($order['invoice_id']) && !empty($order['invoice_id'])){ 
//echo count(print_array(array_column($order['dm_ids'],'id')));
//echo print_array($order);die;
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
	<style type="text/css">
		body,table,thead,tbody,tfoot,tr,th,td,p,li,h1,h2,h3,h4,h5 { font-family:"Lato"; font-size:small;color: #212121;}
		table,thead,tbody,tfoot,tr,th,td{text-align:center;	border: 1px solid #BDBDBD;border-collapse: collapse;}
		tbody {counter-reset:section;}
		html{background-color: #FFFFFF;}
		.count:before{ counter-increment:section; content:counter(section);}	
		.table_content td{border: 1px solid #CCC;}
		.hidden{display: none;}
		@media print{
		  footer {page-break-after: always !important;}
		  @page { margin: 5px 20px 10px 50px; }
		  /*th{-webkit-print-color-adjust: exact; }*/
		}
	</style>
</head>
<body height="1500px">
<div id="pBreak<?= $order['order_id'];?>" class="invoice_class" data-invoice="<?= $order['invoice_id'];?>" data-total="<?= $order['total']; ?>">
	
<table width="100%">
  <tbody>
	<tr>
		<td rowspan="5" colspan="5"><img style="width: 70%" height="70" alt="sig" src="<?php echo base_url().'assets/image/logo.png'; ?>" /></td>
		<td colspan="9"   height="17" style="color:#10243E; font-size: large">
			<b> Funky Vegetables & Fruits Pvt. Ltd. </b> 
		</td>
	</tr>
	<tr>
		<td colspan="14" height="17"><b>Gala No.8, Krishna Mills Compound, LBS Marg, Sonapur, Bhandup West, Mumbai - 400078 </b></td>
	</tr>
	<tr>
		<td colspan="14" height="19"><b>Tel : +91-9209015999  Contact: contact@ordersquare.com </b></td>
	</tr>
	<tr>
		<td colspan="14" height="19"><b>CIN Number : U74999MH201SPTC267123 </b></td>
	</tr>
	<tr>
		<td colspan="14" height="19"><b>FSSAI No.11516007000602 </b></td>
	</tr>
	<tr>
		<td style="font-size:large;color:#C00000;text-decoration:underline" colspan="14"  height="32"><b class="invoice_type">TAX INVOICE</b></td>
	</tr>
	<tr>
		<td colspan="8" align="left" height="21"  style="text-align:left;"><b> Name of Company : <?php echo $order['company_name'] ?> </b></td>
		<td rowspan="2" colspan="3"><b>INVOICE.NO.</b></td>
		<td rowspan="2" colspan="3">
			<b>
				<?php 
					$retailer = ($order['category'] == 6) ? 'R' : 'H';
					if($order['delivery_date'] <= '2017-03-31'){
						echo $retailer.(1000000+$order['invoice_id']).'/'.(date("Y",strtotime($order['delivery_date']))-1).'-'.date("y",strtotime($order['delivery_date'])); 
					}else{
						echo $retailer.($order['invoice_id']).'/'.(date("Y",strtotime($order['delivery_date']))).'-'.(date("y",strtotime($order['delivery_date']))+1); 
					}
				?>
			</b>
		</td>
	</tr>
	<tr>
		<td colspan="8" align="left" height="21" style="text-align:left;"><b> Name of Consignee : <?php echo $order['name'] ?></b></td>
	</tr>
	<tr>
		<td rowspan="2" colspan="8" align="left" height="21" style="text-align:left;"> Delivery Address : <?php echo $order['delivery_address'] ?> </td>
		<td rowspan="3" colspan="3"><b>Challan No.</b></td>
		<td rowspan="3" colspan="3" >
			<b>
				<?php
					$retailer = ($order['category'] == 6) ? 'R' : 'H';
					if($order['delivery_date'] <= '2017-03-31'){
						echo $retailer.(1000000+$order['invoice_id']).'/'.(date("Y",strtotime($order['delivery_date']))-1).'-'.date("y",strtotime($order['delivery_date'])); 
					}else{
						echo $retailer.($order['invoice_id']).'/'.(date("Y",strtotime($order['delivery_date']))).'-'.(date("y",strtotime($order['delivery_date']))+1); 
					}
				?> 
			</b>
		</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="8" align="left" height="17" style="text-align:left;">POC Contact : <?php echo $order['poc_phone']; ?></td>
		<td rowspan="1" colspan="3"><b>Delivery Date : </b></td>
		<td rowspan="1" colspan="3">
		<b><?php echo date("d-m-Y",strtotime($order['delivery_date'])); ?></b></td>

	</tr>
	<tr>
		<td colspan="8" align="left" height="21" style="text-align:left;">POC Name : <?php echo $order['poc_name']; ?></td>
		<td rowspan="1"  colspan="3" >
		  <b>Client ID :</b>   </td>
		<td rowspan="1" colspan="3"  sdval=""  >
			<b><?php echo $order['client_id']; ?></b>
		</td>

	</tr>
	<tr>
		<td colspan="14" align="left" height="21" style="text-align:left;">Order Reference: <?php echo $order['order'][0]['order_reference']; ?></td>
	</tr>
	<tr>
		<td width="70"> <b>Sr. No</b>     </td>
		<td colspan="4"><b>Description</b></td>
		<td colspan="2"><b>UOM</b>        </td>
		<td colspan="2"><b>Quantity</b>   </td>
		<td colspan="2"><b>Unit Price</b> </td>
		<td colspan="3" bgcolor="#DCE6F2"><b>Amount</b></td>
	</tr>

	<?php
		  // echo print_array($order);die;	
		$data = $order['order'];  
		(sizeof($data) > 5) ? $trs = sizeof($data) : $trs = 5;
		for ($i=0; $i < $trs; $i++)
		{ 		
			if((isset($data[$i]['item_id'])))
			{
				if(($data[$i]['final_qty'] == 0) && ($data[$i]['status'] > 3)){
					continue;
				}
				$unit_price = $data[$i]['price']/$data[$i]['quantity'];	
					echo '<tr class="table_content" >
							<td height="20" class="count"></td>
							<td colspan="4">'.$data[$i]['item_name'].'</td>
							<td colspan="2">'.$data[$i]['item_uom'].'</td>
							<td colspan="2">'.$data[$i]['final_qty'].'</td>
							<td colspan="2"> <span> </span> <span>'.$unit_price.'</span>  </td>
							<td colspan="3" bgcolor="#DCE6F2"  >&emsp; '. $data[$i]['final_price'] .'</td>
						</tr>';	
				
			}
			else
			{
					echo '<tr class="table_content" >
							<td height="20">    </td>
							<td colspan="4">    </td>
							<td colspan="2"><br></td>
							<td colspan="2"><br></td>
							<td colspan="2">    </td>
							<td colspan="3" bgcolor="#DCE6F2"></td>
						  </tr>';		
			}		
		}    
    ?>

	<tr class="table_content">
		<td height="20"></td>
		<td colspan="4"></td>
		<td colspan="2"><br></td>
		<td colspan="2"><br></td>
		<td colspan="2"></td>
		<td colspan="3" bgcolor="#DCE6F2">Sub Total &emsp;<span style="margin-left: 25px;"> INR <?php echo $order['total']; ?> </span></td>
	</tr>	
	<tr class="table_content">
		<td height="20"></td>
		<td colspan="4"></td>
		<td colspan="2"><br></td>
		<td colspan="2"><br></td>
		<td colspan="2"></td>
		<td colspan="3" bgcolor="#DCE6F2"  >Other Charges  &emsp; <span> INR 0</span> </td>
	</tr>

	
	<tr class="table_content set_discount <?php if(!($order['discount_value'] > 0)): echo "hidden"; endif;?>">
		<td height="20"></td>
		<td colspan="4"></td>
		<td colspan="2"><br></td>
		<td colspan="2"><br></td>
		<td colspan="2"></td>
		<td colspan="3"	bgcolor="#DCE6F2"   id="append_discount">Discount :&emsp; 
			<?php 
			 echo calculate_discount($order['discount_type'],$order['discount_value'],$order['total']);
			?>
		</td>
	</tr>
	<tr class="table_content">
		<td height="20"></td>
		<td colspan="4"></td>
		<td colspan="6" id="append_rupees">
          <b>
		  <?php echo' Rupees : '.convert_number_to_words(calculate_discounted_amount($order['discount_type'],$order['discount_value'],$order['total'])).' only';?>
		  </b>
		</td>
		<td id="append_total" colspan="3" bgcolor="#DCE6F2"><b>Grand Total &emsp; <span style="margin-left: 15px;">INR 
		<?php echo calculate_discounted_amount($order['discount_type'],$order['discount_value'],$order['total'])."/-"; ?>
		</b></span>
		</td>
	</tr>
</tbody>
</table>
<!--printing No of DMs-->
<span style="font-size:0.7em;font-weight:bolder;padding:0px 2px 0px 2px;border: 1px solid #ccc;color:#757575">
	<?= 'D'.count(array_column($order['dm_ids'],'id'));?>
</span>

<div>
	<p style="padding-top: 12px;margin: 0;"><b>Terms &amp; Conditions :-</b>
		<ol>
		 	<li> 
		 		Payment to be made in favour of <b>"Funky Vegetables &amp; Fruits Pvt. Ltd."</b>
		 	</li>
		 	<li>Payments accepted in Cheque/RTGS.</li>
		 	<li>RTGS Details :-
				<ol>
					<li>Bank Name     :- ICICI Bank Ltd.</li>
					<li>A/C No .      :- 195605000082</li>
					<li>Branch        :- Central Avenue,Hiranandani Business Park, Powai,400076</li>
			     	<li>IFSC          :- ICIC0001956</li>
			   	</ol>  
			</li>	
		</ol>					
	</p>
</div>

<p style="float:left">
<h3><b>Authorized Signature & Stamp</b></h3>
<img style="width:20%;height:auto;" src="<?php echo base_url()."/img/stamp.png"; ?>" /> 
</p>	
<!--<h3 style="float:right"><b>Received Authorized Signature & Stamp <?php //echo $order['company_name'] ?> </b> 
	
<?php //if($order['sign']): ;?>
<img style="float:right" width="160" height="120" src="<?php //echo 'data:image/png;base64,'.$order['sign'] ?>"/>
<?php //endif; ?>
</h3>-->


<p id="footer<?= $order['order_id'];?>"><span><h1 style="color:transparent;">&nbsp;</h1></span></p>
</div>
</body>
<!-- <embed
    type="application/pdf"
    src=""
    id="pdfDocument"
    width="100%"
    height="100%">
</embed> -->
<!-- <script>	
	// document.close();
	// window.print();
	// document.getElementById("footer").style.pageBreakAfter = "always";
	document.getElementById("footer").style.pageBreakAfter = "always";
</script> -->
<script>
	document.getElementById("pBreak<?= $order['order_id'];?>").style.pageBreakBefore = "always";	
	// document.getElementById("footer<?// $order['order_id'];?>").style.pageBreakAfter = "always";	
</script>
<!-- <footer ><h1>PBrk After ME</h1></footer> -->
</html>
<?php 
}else{
	echo "<h1>No Invoice for Order No: ".$order['order_id']."</h1>";
}
?>