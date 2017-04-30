<html>
<head>
</head>
<body>
<style>
	body{font-family:'Calibri';}
	table, th, td {text-align:center;border: 1px solid black;border-collapse: collapse;height: 28px;}
	@media print{
	  footer {page-break-after: always !important;}
	  @page { margin: 5px 20px 10px 50px; }
	}
</style>
<?php
// print_r(get_item_wise_purchase_sale());die;
	if(isset($result['data']) && !empty($result['data'])):
	// echo print_array($result['total']);
	// echo print_array($result['data']);
	// array_check($result['total']);
	// print_r($result['nuke']);die;
	$max = max(array_column($result['nuke'],'delivery_date'));
	$min = min(array_column($result['nuke'],'delivery_date'));
?>
<table class="" style="width: 100%">
<thead></thead>
   <tbody>
    <tr>
		<td colspan=<?= 5+count($result['nuke']); ?>><b>FUNKY VEGETABLES &amp; FRUITS PVT LTD</b></td>
	</tr>
	<tr>
		<td colspan=<?= 5+count($result['nuke']); ?>><b> KRISHNA MILLS COMPOUND, LAL BAHADUR SHASTRI MARG, BHANDUP INDUSTRIAL AREA, SONAPUR, BHANDUP WEST, MUMBAI - 400078. </b></td>
	</tr>
	<tr>
		<td style = 'text-align:left;padding: 0 140px 0 0;'><b>Invoice&nbsp;No.</b></td>
		<td style = 'text-align:left' colspan=<?= 4+count($result['nuke']); ?>>
			<b>
			<?php
			  // $value = $result['data'][0]['company_name'];
			  // echo strtok($value, " ").'/'.(date("Y")-1).'-'.date("y");
			?>
			</b>		
		</td>
	</tr>
	<tr>
		<td style = 'text-align: left'><b>Name of the Party</b></td>
		<td style = 'text-align: left' colspan=<?= 4+count($result['nuke']); ?>>
			<b>
			<?= $result['data'][0]['company_name'];?>
			</b>
		</td>	
	</tr>
	<tr>
		<td style ='text-align: left'><b>Name of Outlet</b></td>
		<td style ='text-align: left' colspan=<?= 4+count($result['nuke']); ?>>
			<b><?= $result['data'][0]['name'];?></b>
		</td>	
	</tr>
	<tr>
		<td style ='text-align: left'>Periods</td>
		<td style ='text-align: left' colspan=<?= 4+count($result['nuke']); ?>><?= date("d/m/Y",strtotime($min)).' to '.date("d/m/Y",strtotime($max))?></td>
	</tr>
    <tr>
    	<td style ='text-align: left'><b>Date</b></td>
		<?php
		// $max = date("Y-m-d",strtotime($max1)-1);
		foreach ($result['nuke'] as $key => $value) {
			echo "<td style='font-size: 0.9em;'><b>".date("d-M-y",strtotime($value['delivery_date']))."</b></td>";
		}
		?>	
	<td colspan="3"></td>
	</tr>
    <tr>
    	<td style = 'text-align: left'><b>Challan Number</b></td>
		<?php
		// $max = date("Y-m-d",strtotime($max1)-1);
		foreach ($result['nuke'] as $key => $value) {
			echo "<td style='font-size: .9em;'><b>";
				if($value['delivery_date'] <= '2017-03-31'):
				$retailer = ($result['category'] == 6) ? 'R'.(1000000+$value['invoice_id_retailer']) : 'H'.(1000000+$value['invoice_id']);
				echo $retailer.'/<br>'.(date("Y",strtotime($value['delivery_date']))-1).'-'.date("y",strtotime($value['delivery_date']));
				else:
				$retailer = ($result['category'] == 6) ? 'R'.($value['invoice_id_retailer']) : 'H'.($value['invoice_id']);
				echo $retailer.'/<br>'.date("Y",strtotime($value['delivery_date'])).'-'.(date("y",strtotime($value['delivery_date']))+1);
				endif;	 
			echo"</b></td>";
		}
		?>	
	<td colspan="3"><b>TOTAL</b></td>
	</tr>	
	  <tr>
	  <td></td>
	 <?php	foreach ($result['nuke'] as $key => $value) {
			echo "<td style='font-size:small'><b>QTY</b></td>";
		}
	 ?>
	 	<td style='font-size:small; padding: 0px 50px 0 50px;'><b>QTY</b></td>
	 	<td style='font-size:small; padding: 0px 50px 0 50px;'><b>RATE</b></td>
	 	<td style='font-size:small; padding: 0px 50px 0 50px;'><b>AMT</b></td>
	 </tr>
	
<?php
$new = [];$new1=[];

      // print_r(array_values(array_unique(array_column($result['nuke'], 'delivery_date'))));die;
$data = $result['data'];
$big = [];$big_data = [];

$arr = [
        'delivery_date'   => date("Y-m-d",strtotime($min)-1),
        'order_id'        => 0,    
        'final_price'     => NULL,
        'final_qty'       => NULL,
        'unit_price'      => NULL,
       ];

foreach ($data as $key => $value) {
  for ($i=0; $i < count(array_keys($result['nuke'])); $i++) { 
  	// print_r(array_keys($value['details']));die;
       if(sizeof($value['details']) == count(array_keys($result['nuke']))){
	        break;
	    }elseif( $i !== (array_search($i,array_keys($value['details'])))    ){
			$data[$key]['details'][$i] =  $arr;
	    }
  }
}

$grand_qty = 0;
foreach ($data as $key => $value) {
	echo"<tr>
	      <td style = 'text-align: left'>".$value['item_name']."</td>";
		foreach ($value['details'] as $key1 => $value1) {
		         $grand_qty += $value1['final_qty'];
		  		 echo "<td>".$value1['final_qty']."</td>";
		}
	    echo"<td>".$value['total_qty']."</td>
	  	     <td>".$value['unit_price']."</td>
	  		 <td>".$value['total_price']."</td>
    </tr>";
}
?>
</tbody>
<tfoot>
	<thead style="text-align: left;">
		<th style = 'text-align: left'><b>Sub-Total Amount</b></th>
		<?php  
		    $grand_total = 0;
			 foreach ($result['total'] as $key => $value) {
			   $grand_total += $value['total'];
			   echo "<th>".$value['total']."</th>";
			 }
			 echo "<th>".$grand_qty."</th><th></th><th>".$grand_total."</th>";
		?>
	</thead>
	<?php if(!(array_check($result['total']))):?>
	<thead style="text-align: left;">
		<th style = 'text-align: left'><b>Discount</b></th>
		<?php  
		    $grand_total = 0;
			 foreach ($result['total'] as $key => $value) {
			   $grand_total += $value['total'];
			   // echo "<th>".$value['total']."</th>";
			  echo "<th>".calculate_discount($value['discount_type'],$value['discount_value'],$value['total'])."</th>";
			 }
			 echo "<th>".$grand_qty."</th><th></th><th>".$grand_total."</th>";
		?>
	</thead>
	<?php endif;?>
	<thead style="text-align: left;">
		<th style = 'text-align: left'><b>Total Amount</b></th>
		<?php  
		    $grand_total = 0;
		    $discounted_grand_total = 0;
			 foreach ($result['total'] as $key => $value) {
			   // $grand_total += $value['total'];
			   $discounted_grand_total += calculate_discounted_amount($value['discount_type'],$value['discount_value'],$value['total']);
			   // echo "<th>".$value['total']."</th>";
			   echo "<th>".calculate_discounted_amount($value['discount_type'],$value['discount_value'],$value['total'])."</th>";
			 }
			 echo "<th>".$grand_qty."</th><th></th><th>".$discounted_grand_total."</th>";
		?>
	</thead>	
	<tr>
		<td style = 'text-align: left'><b>Grand Total</b></td>
		<?php echo"<td colspan=".(4+count($result['nuke']))." style = 'text-align: left'>
			<b>".$discounted_grand_total."</b>
		</td>";?>
	</tr>
	<tr>
		<td style = 'text-align: left'><b>RUPEES</b></td>
		<?php echo "<td colspan=".(4+count($result['nuke']))." style = 'text-align: left'>
			<b>".convert_number_to_words($discounted_grand_total)." Only </b>
		</td>";?>
	</tr>
</tfoot>
</table>
<?php 
	else:
		echo "No Reports between $min to $max";
	endif; 
?>
</body>
</html>