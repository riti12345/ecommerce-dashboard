<html>
<head>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
	<style>
		table, th, td {text-align:center;border: 1px solid black;border-collapse: collapse;font-family:"Calibri";}
        .hidden{display: none;}
	    @media print{
		  footer {page-break-after: always !important;}
		  @page { margin: 5px 20px 10px 50px; }
		}
	</style>
</head>
<body>
<?php
	if(isset($result['data']) && !empty($result['data'])):
	// echo print_array($result['data']);die;
	// print_r($result['data']);die;
	$max = max(array_column($result['data'],'delivery_date'));
	$min = min(array_column($result['data'],'delivery_date'));
	// print_r($min); print_r($max);
	// die;
?>
<table>
	<thead></thead>
	<tbody>
	    <tr>
			<td colspan="9"><b>FUNKY VEGETABLES &amp; FRUITS PVT LTD</b></td>
		</tr>
		<tr>
			<td colspan="9"><b> Krishna Mills Compound, Lal Bahadur Shastri Marg, Bhandup Industrial Area, Sonapur, Bhandup West, Mumbai - 400078. </b></td>
		</tr>
		<tr>
			<td><b>Date</b></td>
			<td colspan="8">
			<b>
			 <?php
			 	echo ($min == $max) ? $max : date("d/m/Y",strtotime($min)).' to '.date("d/m/Y",strtotime($max));
			 ?>
			 </b>
			</td>
		</tr>
		<tr>
			<td><b>Sr. No.</b></td>
			<td><b>Name of Outlet</b></td>
			<td><b>Name of Party</b></td>
			<td><b>Delivery Date</b></td>
			<td><b>Status</b></td>
			<td><b>Bill No.</b></td>
			<td><b>Amount</b></td>
			<td><b>Discount</b></td>
			<td><b>Final Amount</b></td>
		</tr>
		<?php
		  $count = 0; 	
		  foreach ($result['data'] as $key => $value) {
			echo"<tr>
				<td>".++$count."</td>
				<td style='text-align:left'>".$value['name']."</td>
				<td style='text-align:left'>".$value['company_name']."</td>
				<td>".date("d/m/Y",strtotime($value['delivery_date']))."</td>
				<td>".$this->config->item($value['track_status'],'dispatch_status')."</td>
				<td>";
					if(isset($value['invoice_id']) && !empty($value['invoice_id'])){
						$retailer = ($value['category'] == 6) ? 'R' : 'H';
						if($value['delivery_date'] <= '2017-03-31'):
						echo $retailer.(1000000+$value['invoice_id'])
							 .'/'.(date("Y",strtotime($value['delivery_date']))-1)
							 .'-'.date("y",strtotime($value['delivery_date']));
						else:
						echo $retailer.($value['invoice_id'])
							 .'/'.date("Y",strtotime($value['delivery_date']))
							 .'-'.(date("y",strtotime($value['delivery_date']))+1);
						endif;
					}else{
						echo "Invoice not yet generated!";
					}
				echo"</td>
				<td>".$value['total_price']."</td>
				<td>".calculate_discount($value['discount_type'],$value['discount_value'],$value['total_price'])."</td>
				<td>".calculate_discounted_amount($value['discount_type'],$value['discount_value'],$value['total_price'])."</td>
			</tr>";
          }	
		?>
	</tbody>
</table>
<script>
	// setTimeout(function(){
	// 	window.print();
	// }, 1000);
</script>
<?php endif;?>
</body>
</html>