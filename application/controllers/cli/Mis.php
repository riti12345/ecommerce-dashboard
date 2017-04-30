<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Mis extends OS_Controller {

  public function __construct() {
    parent::__construct();
    if(!is_cli()) exit('This script can only be accessed via the command line');
    // Load the excel Library
    $this->load->library("excel");
  } 
  
  public function daily_report() {
   $dt = date("Y-m-d", strtotime("-1 days"));
    $attach = [];
    $from = 'noreply@ordersquare.com';
    $from_name =  'Analytics';
    $to = 'riti.verma@ordersquare.com,aditya@ordersquare.com, ahmad.nazeeb@ordersquare.com, dhaval@ordersquare.com,sunil.nikhar@ordersquare.com,ifra.rajwadkar@ordersquare.com';
    $subject = 'MIS-no-reply | '.$dt;
    $style = '<head>
                  <style>
                  table {
                      border-collapse: collapse;
                      width: 100%;
                  }

                  th, td {
                      text-align: left;
                      padding: 8px;
                  }

                  tr:nth-child(even){background-color: #f2f2f2}

                  th {
                      background-color: #4CAF50;
                      color: white;
                  }
                  </style>
                </head>';
    $data = $style.'<h2><u>Report on "'.$dt.'"</u></h2>';
    $day_sale = total_day_sale();
    $day_sale_hosp = total_day_sale(FALSE,TRUE,FALSE);
    $day_sale_ret = total_day_sale(TRUE,FALSE,FALSE);
    $actual_sale = total_actual_sale();
    $actual_sale_hosp = total_actual_sale(FALSE,TRUE,FALSE);
    $actual_sale_ret = total_actual_sale(TRUE,FALSE,FALSE);
    $client_wise_sale_ret = client_wise_sale(TRUE,FALSE,FALSE);
    $client_wise_sale_hosp = client_wise_sale(FALSE,TRUE,FALSE);
    $category_wise_sale = category_wise_sale();
    $category_wise_day_total_qty = category_wise_day_total_qty();
    $purchase_sale = get_purchase_sale();
    $day_purchase_amt = total_day_purchase_amt();
    $avg_purchase_per_unit = avg_purchase_per_unit();
    $avg_sale_per_unit = avg_sale_per_unit();
    $total_short_supply_qty = total_short_supply_qty();
    $total_return_qty = total_return_qty();
    $total_item_qty = 0.0;
    $total_return = 0.0;
    $get_item_wise_purchase_sale = get_item_wise_purchase_sale();
    $get_item_wise_average_sale = get_item_wise_average_sale();
   
    foreach($purchase_sale as $sale)
    {

      $sum += $sale['total'];
    }

    if(isset($client_wise_sale_hosp) && !empty($client_wise_sale_hosp)) {
      /*$data .= '<h3><u>Total expected sale : '.$day_sale['sale'].'</u></h3>';
      $data .= '<h3><u>Total expected sale hospitality : '.$day_sale_hosp['sale'].'</u></h3>';
      $data .= '<h3><u>Total expected sale retailers: '.$day_sale_ret['sale'].'</u></h3>';
      $data .= '<h3><u>Total actual sale : '.$actual_sale['sale'].'</u></h3>';
      $data .= '<h3><u>Total actual sale hospitality: '.$actual_sale_hosp['sale'].'</u></h3>';
      $data .= '<h3><u>Total actual sale retailer: '.$actual_sale_ret['sale'].'</u></h3>';*/
      
      $data .= '<h3><u>Total Sale : '.$day_sale['sale'].'</u></h3>';
      $data .= '<h3><u>COGS : '.$sum.'</u></h3>';
      $data .= '<h3><u>Margin : '.round((($day_sale['sale']-$sum)/$day_sale['sale'])*100).'%</u></h3>';
      $this->excel->stream('client_wise_sale_hosp'.$dt.'.xls', $client_wise_sale_hosp);
      $attach[] = 'exported/client_wise_sale_hosp'.$dt.'.xls';
      $this->excel->stream('client_wise_sale_ret'.$dt.'.xls', $client_wise_sale_ret);
      $attach[] = 'exported/client_wise_sale_ret'.$dt.'.xls';
    }
  
    if(isset($category_wise_sale) && !empty($category_wise_sale)) {
      $data .= '<h3><u>Category sale :</u></h3>';
      $data .= '<table><tr><th>Category</th><th>Total sale (INR)</th><th>COGS</th><th>Margin</th></tr>';
      foreach($category_wise_sale as $sale) {
        $key = array_search($sale['category'], array_column($purchase_sale, 'category'));
        $data .= '<tr><td>'.$sale['name'].'</td><td>'.$sale['total_sale'].'</td><td>'.$purchase_sale[$key]['total'].'</td><td>'.round((($sale['total_sale'] - $purchase_sale[$key]['total'])/$sale['total_sale'])*100).'%</td></tr>';
      }
      $data .= '</table>';
    }

    if(isset($category_wise_day_total_qty) && !empty($category_wise_day_total_qty)) {
      $data .= '<h3><u>Category quantity :</u></h3>';
      $data .= '<table><tr><th>Category</th><th>Total quantity</th><th>UOM</th></tr>';
      foreach($category_wise_day_total_qty as $sale) {
        $data .= '<tr><td>'.$sale['category'].'</td><td>'.$sale['total_qty'].'</td><td>'.$sale['uom'].'</td></tr>';
        $total_item_qty += $sale['total_qty'];
      }
      $data .= '</table>';
    }

   if(isset($get_item_wise_purchase_sale) && !empty($get_item_wise_purchase_sale)) {
      $data .= '<h3><u>Item Name:</u></h3>';
      $data .= '<table><tr><th>Item Name</th><th>Total Quantity</th><th>UOM</th><th>Average rate (INR)</th><th>Purchase Rate</th><th>Margin</th></tr>';
      foreach($get_item_wise_purchase_sale as $sale) {
        $key = array_search($sale['name'], array_column($get_item_wise_purchase_sale, 'name'));
        $data .= '<tr><td>'.$sale['name'].'</td><td>'.$sale['total_qty'].'</td><td>'.$sale['uom'].'</td><td>'.$get_item_wise_average_sale[$key]['avg_rate'].'</td><td>'.$get_item_wise_purchase_sale[$key]['rate'].'</td><td>'.round((($get_item_wise_average_sale[$key]['avg_rate'] - $get_item_wise_purchase_sale[$key]['total'])/$get_item_wise_average_sale[$key]['avg_rate'])*100).'%</td></tr>';
      }
      $data .= '</table>';
    }
    /*if(isset($total_short_supply_qty) && !empty($total_short_supply_qty)) {
      $data .= '<h3><u>Short supply quantity :</u></h3>';
      $data .= '<table><tr><th>Item name</th><th>Quantity</th><th>UOM</th></tr>';
      foreach($total_short_supply_qty as $item) {
        $data .= '<tr><td>'.$item['item_name'].'</td><td>'.$item['short_supply'].'</td><td>'.$item['uom'].'</td></tr>';
      }
      $data .= '</table>';
    }*/

    /*if(isset($total_return_qty) && !empty($total_return_qty)) {
      $data .= '<h3><u>Return quantity :</u></h3>';
      $data .= '<table><tr><th>Item name</th><th>Quantity</th><th>UOM</th></tr>';
      foreach($total_return_qty as $item) {
        $data .= '<tr><td>'.$item['item_name'].'</td><td>'.$item['return_qty'].'</td><td>'.$item['uom'].'</td></tr>';
        $total_return += $item['return_qty'];
      }
      $data .= '</table>';
    }*/

    if(isset($purchase_sale) && !empty($purchase_sale)) {
      $final_amt = 0;
      foreach($purchase_sale as $sale) {
        $final_amt += $sale['total'];
      }

  /*   if(isset($avg_purchase_per_unit)){
        $data .= '<h3><u>AVG per unit :</u></h3>';
        $data .= '<table><tr><th>Category</th><th>Avg purchase/Unit</th><th>UOM</th></tr>';
        foreach($avg_purchase_per_unit as $purchase) {
          $data .= '<tr><td>'.$purchase['category'].'</td><td>'.$purchase['purchase_qty'].'</td><td>'.$purchase['uom'].'</td></tr>';
        }
        $data .= '</table>';
      }

      $data .= '<table><tr><th>Category</th><th>Avg sale/Unit</th><th>UOM</th></tr>';
      foreach($avg_sale_per_unit as $sale) {
        $data .= '<tr><td>'.$sale['category'].'</td><td>'.$sale['avg'].'</td><td>'.$sale['uom'].'</td></tr>';
      }
      $data .= '</table>';*/

      /*$data .= '<h3><u>Purchase aganist total Sale : '.$final_amt.'</u></h3>';
      $data .= '<h3><u>Margin : '.($day_sale['sale'] - $final_amt).'</u></h3>';
      $data .= '<h3><u>Margin (%) : '.((($day_sale['sale'] - $final_amt)/$day_sale['sale'])*100).' % </u></h3>';
      $data .= '<h3><u>Inventory value : '.($day_purchase_amt['purchase'] - $final_amt).'</ul></h3>';
      $data .= '<h3><u>Rejection (%) : '.(($total_return / $total_item_qty) * 100).' %</ul></h3>';*/

      $this->excel->stream('purchase_sale'.$dt.'.xls', $purchase_sale);
      $attach[] = 'exported/purchase_sale'.$dt.'.xls';
    }
  
    send_mail($from,$from_name, $to, $subject, $data, $attach);
  }

  public function weekly_report() {
    $dt = date("W", strtotime("last week"));
    $attach = [];
    $from = 'noreply@ordersquare.com';
    $from_name =  'Analytics';
    //vsk@ordersquare.com, aditya@ordersquare.com, khalid.ali@ordersquare.com, ahmad.nazeeb@ordersquare.com, dhaval@ordersquare.com
    $to = 'riti.verma@ordersquare.com ,aditya@ordersquare.com,ahmad.nazeeb@ordersquare.com, dhaval@ordersquare.com';
    $subject = 'MIS-Weekly | Week - '.$dt;
    $style = '<head>
                  <style>
                  table {
                      border-collapse: collapse;
                      width: 100%;
                  }

                  th, td {
                      text-align: left;
                      padding: 8px;
                  }

                  tr:nth-child(even){background-color: #f2f2f2}

                  th {
                      background-color: #4CAF50;
                      color: white;
                  }
                  </style>
                </head>';
    $data = $style.'<h2><u>Report of week '.$dt.'</u></h2>';
    $week_sale = total_week_sale();
    $actual_sale = total_week_actual_sale();
    $client_wise_sale = client_week_wise_sale();
    $category_wise_sale = category_week_wise_sale();
    $category_wise_day_total_qty = category_week_wise_day_total_qty();
    $purchase_sale = get_week_purchase_sale();
    $day_purchase_amt = total_week_purchase_amt();
    $avg_purchase_per_unit = avg_week_purchase_per_unit();
    $avg_sale_per_unit = avg_week_sale_per_unit();
    $total_return_qty = total_week_return_qty();
    $return_qty_total = 0.0;
    $category_total_qty = 0.0;

      foreach($purchase_sale as $sale)
      {
      //  print_r($sale['total']);
        $sum += $sale['total'];
      }

    if(isset($client_wise_sale) && !empty($client_wise_sale)) {
      $data .= '<h3><u>Total Sale : '.$week_sale['sale'].'</u></h3>';
      $data .= '<h3><u>COGS : '.$sum.'</u></h3>';
      $data .= '<h3><u>Margin : '.round((($week_sale['sale']-$sum)/$week_sale['sale'])*100).'%</u></h3>';
      $this->excel->stream('client_wise_sale'.$dt.'.xls', $client_wise_sale);
      $attach[] = 'exported/client_wise_sale'.$dt.'.xls';
    }

    if(isset($category_wise_sale) && !empty($category_wise_sale)) {
      $data .= '<h3><u>Category sale :</u></h3>';
      $data .= '<table><tr><th>Category</th><th>Total sale (INR)</th><th>COGS</th><th>Margin</th></tr>';
      foreach($category_wise_sale as $sale) {
        $key = array_search($sale['category'], array_column($purchase_sale, 'category'));
        $data .= '<tr><td>'.$sale['name'].'</td><td>'.$sale['total_sale'].'</td><td>'.$purchase_sale[$key]['total'].'</td><td>'.round((($sale['total_sale'] - $purchase_sale[$key]['total'])/$sale['total_sale'])*100).'%</td></tr>';
      }
      $data .= '</table>';
    }

    if(isset($category_wise_day_total_qty) && !empty($category_wise_day_total_qty)) {
      $data .= '<h3><u>Category quantity :</u></h3>';
      $data .= '<table><tr><th>Category</th><th>Total quantity</th><th>UOM</th></tr>';
      foreach($category_wise_day_total_qty as $sale) {
        $data .= '<tr><td>'.$sale['category'].'</td><td>'.$sale['total_qty'].'</td><td>'.$sale['uom'].'</td></tr>';
        $category_total_qty += $sale['total_qty'];
      }
      $data .= '</table>';
    }

    if(isset($total_return_qty) && !empty($total_return_qty)) {
      foreach($total_return_qty as $item) {
        $return_qty_total += $item['return_qty'];
      }
    }

    if(isset($purchase_sale) && !empty($purchase_sale)) {
      $final_amt = 0;
      foreach($purchase_sale as $sale) {
        $final_amt += $sale['total'];
      }

     /* if(isset($avg_purchase_per_unit)){
        $data .= '<h3><u>AVG per unit :</u></h3>';
        $data .= '<table><tr><th>Category</th><th>Avg purchase/Unit</th><th>UOM</th></tr>';
        foreach($avg_purchase_per_unit as $purchase) {
          $data .= '<tr><td>'.$purchase['category'].'</td><td>'.$purchase['purchase_qty'].'</td><td>'.$purchase['uom'].'</td></tr>';
        }
        $data .= '</table>';
      }*/

      /*$data .= '<table><tr><th>Category</th><th>Avg sale/Unit</th><th>UOM</th></tr>';
      foreach($avg_sale_per_unit as $sale) {
        $data .= '<tr><td>'.$sale['category'].'</td><td>'.$sale['avg'].'</td><td>'.$sale['uom'].'</td></tr>';
      }
      $data .= '</table>';

      $data .= '<h3><u>Purchase aganist total Sale : '.$final_amt.'</u></h3>';
      $data .= '<h3><u>Margin : '.($week_sale['sale'] - $final_amt).'</u></h3>';
      $data .= '<h3><u>Margin (%) : '.((($week_sale['sale'] - $final_amt)/$week_sale['sale'])*100).' % </u></h3>';

      $data .= '<h3><u>Rejection (%) : '.(($return_qty_total / $category_total_qty) * 100).' %</ul></h3>';*/

      $this->excel->stream('purchase_sale'.$dt.'.xls', $purchase_sale);
      $attach[] = 'exported/purchase_sale'.$dt.'.xls';
    }

    send_mail($from,$from_name, $to, $subject, $data, $attach);
  }

  public function procure_daily_report() {
    $dt = date("Y-m-d");
    $attach = [];
    $procurement_data = procurement_day_purchase_data();
    $from = 'noreply@ordersquare.com';
    $from_name =  'Analytics';
    $to = 'riti.verma@ordersquare.com, mudassir.ansari@ordersquare.com, suraj.prajapati@ordersquare.com,aditya@ordersquare.com ,ahmad.nazeeb@ordersquare.com, dhaval@ordersquare.com';
    $subject = 'MIS-Procure Data-Daily | '.$dt;
    $data = 'Todays procurement data.<br>PFA,';

    $this->excel->stream('procurement_data_'.$dt.'.xls', $procurement_data);
    $attach[] = 'exported/procurement_data_'.$dt.'.xls';
    send_mail($from,$from_name, $to, $subject, $data, $attach);
  }

  public function jit_daily_report(){
   $dt = date("Y-m-d", strtotime("-1 days"));
    $attach =[];
    $jit_data = jit_day_purchase_data();
    $jit_total_qty=jit_day_purchase_total_qty();
    $jit_total_price=jit_day_purchase_total_price();
    $from = 'noreply@ordersquare.com';
    $from_name = 'Analytics';
    $to = 'riti.verma@ordersquare.com, mudassir.ansari@ordersquare.com, suraj.prajapati@ordersquare.com,aditya@ordersquare.com ,ahmad.nazeeb@ordersquare.com, dhaval@ordersquare.com';
    $subject = 'MIS-JIT Data-Daily | '.$dt;
    if(isset($jit_data) && !empty($jit_data)) {
    $data .= 'Total Quantity:'.$jit_total_qty['total_qty'].'<br>';
    $data .= 'Total Price:'.$jit_total_price['total_price'].'<br>';
    $data .= 'Today Jit data.<br>PFA,';
    $this->excel->stream('jit_data_'.$dt.'.xls', $jit_data);
    $attach[] = 'exported/jit_data_'.$dt.'.xls';}
    send_mail($from, $from_name, $to, $subject ,$data, $attach);
  }

  public function test() {
    $dt = date("Y-m-d");
    $from = 'noreply@ordersquare.com';
    $from_name =  'TEST MAIL';
    $to = 'riti.verma@ordersquare.com';
    $subject = 'Testing mail'.$dt;
    $data = 'WOW working....'.$dt;
    send_mail($from, $from_name, $to, $subject ,$data);
  }

 public function client_weekly_bulk_report()
  {
    $dt=date("Y-m-d");
    $attach=[];
    $from='noreply@ordersquare.com';
    $from_name='Invoice';
  
    $subject='MIS-no-reply |'.$dt;
    $style = '<html>
              <head>
              </head>
              <body>
              <style>
                body{font-family:"Calibri";}
                table, th, td {text-align:center;border: 1px solid black;border-collapse: collapse;height: 28px;}
                @media print{
                  footer {page-break-after: always !important;}
                  @page { margin: 5px 20px 10px 50px; }
                }
              </style>';
              
   $data1 .= $style.'<h2><u>Report on '.$dt.'</u></h2>';
   $result=invoice_weekly_report();
   $to=$result['data'][0]['name'];
  print_r($result);die;
	// echo print_array($result['total']);
	// echo print_array($result['data']);
	// array_check($result['total']);
	// print_r($result['nuke']);die;
	$max = max(array_column($result['nuke'],'delivery_date'));
	$min = min(array_column($result['nuke'],'delivery_date'));
  $data1.=$style.'<table class="" style="width: 100%">
  <table class="" style="width: 100%">
  <thead></thead>
   <tbody>
    <tr>
		<td colspan=5s><b>FUNKY VEGETABLES &amp; FRUITS PVT LTD</b></td>
	</tr>
	<tr>
		<td colspan=5+count('.$result['nuke'].');><b> KRISHNA MILLS COMPOUND, LAL BAHADUR SHASTRI MARG, BHANDUP INDUSTRIAL AREA, SONAPUR, BHANDUP WEST, MUMBAI - 400078. </b></td>
	</tr>
	<tr>
		<td style = "text-align:left;padding: 0 140px 0 0;"><b>Invoice&nbsp;No.</b></td>
		<td style = "text-align:left" colspan= 4+count('.$result['nuke'].')>
			<b>
			</b>		
		</td>
	</tr>
	<tr>
		<td style = "text-align: left"><b>Name of the Party</b></td>
		<td style = "text-align": leftcolspan= 4+count('.$result['nuke'].')>
			<b>
			'. $result['data'][0]['company_name'].'
			</b>
		</td>	
	</tr>
	<tr>
		<td style ="text-align: left"><b>Name of Outlet</b></td>
		<td style ="text-align: left "colspan= 4+count('.$result['nuke'].')>
			<b> '.$result['data'][0]['name'].'</b>
		</td>	
	</tr>
	<tr>
		<td style ="text-align: left">Periods</td>
		<td style ="text-align: left" colspan= 4+count('.$result['nuke'].')> ';
   date("d/m/Y",strtotime($min)).' to '.date("d/m/Y",strtotime($max));
  
   $data1.=$style.' </td>
	</tr>
    <tr>
    	<td style ="text-align: left"><b>Date</b></td>';
      

		foreach ($result['nuke'] as $key => $value) {
		$data1.=$style. "<td style='font-size: 0.9em;'><b>".date("d-M-y",strtotime($value['delivery_date']))."</b></td>";
		}
	$data1.=$style.'<td colspan="3"></td>
	</tr>
    <tr>
    	<td style =" text-align: left"><b>Challan Number</b></td>';
      // $max = date("Y-m-d",strtotime($max1)-1);
		foreach ($result['nuke'] as $key => $value) {
			$data1.=$style. "<td style='font-size: .9em;'><b>";
				$retailer = ($result['category'] == 6) ? 'R'.(1000000+$value['invoice_id_retailer']) : 'H'.(1000000+$value['invoice_id']);
					$data1.=$style. $retailer.'/<br>'.(date("Y",strtotime($value['delivery_date']))-1).'-'.date("y",strtotime($value['delivery_date'])); 
			$data1.=$style."</b></td>";
		}
    $data1.=$style.'<td colspan="3"><b>TOTAL</b></td>
	</tr>	
	  <tr>
	  <td></td>';
	 	foreach ($result['nuke'] as $key => $value) {
			$data1.=$style. "<td style='font-size:small'><b>QTY</b></td>";
		}
	
	 $data1.=$style.'	<td style="font-size:small; padding: 0px 50px 0 50px;"><b>QTY</b></td>
	 	<td style="font-size:small; padding: 0px 50px 0 50px;"><b>RATE</b></td>
	 	<td style="font-size:small; padding: 0px 50px 0 50px;"><b>AMT</b></td>
	 </tr>
	';
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
$data1.=$style.'	<tr>
	      <td style = "text-align: left">'.$value['item_name'].'</td>';
		foreach ($value['details'] as $key1 => $value1) {
		         $grand_qty += $value1['final_qty'];
		  			$data1.=$style."<td>".$value1['final_qty']."</td>";
		}
	    	$data1.=$style."<td>".$value['total_qty']."</td>
	  	     <td>".$value['unit_price']."</td>
	  		 <td>".$value['total_price']."</td>
    </tr>";
}
 $data1.=$style.'</tbody>
<tfoot>
	<thead style="text-align: left;">
		<th style = "text-align: left"><b>Sub-Total Amount</b></th>';
		  
		    $grand_total = 0;
			 foreach ($result['total'] as $key => $value) {
			   $grand_total += $value['total'];
			  	$data1.=$style. "<th>".$value['total']."</th>";
			 }
			$data1.=$style. "<th>".$grand_qty."</th><th></th><th>".$grand_total."</th>";
	
$data1.=$style.'	</thead>';
  if(!(array_check($result['total']))):
  $data1.=$style.'<thead style="text-align: left;">
		<th style = "text-align: left"><b>Discount</b></th>';
     $grand_total = 0;
			 foreach ($result['total'] as $key => $value) {
			   $grand_total += $value['total'];
			   // echo "<th>".$value['total']."</th>";
			  	$data1.=$style. "<th>".calculate_discount($value['discount_type'],$value['discount_value'],$value['total'])."</th>";
			 }
			 	$data1.=$style. "<th>".$grand_qty."</th><th></th><th>".$grand_total."</th>";
       $data1.=$style.'</thead>';
       endif;
       $data1.=$style.'<thead style="text-align: left;">
		<th style = "text-align: left"><b>Total Amount</b></th>';
    $grand_total = 0;
		    $discounted_grand_total = 0;
			 foreach ($result['total'] as $key => $value) {
			   // $grand_total += $value['total'];
			   $discounted_grand_total += calculate_discounted_amount($value['discount_type'],$value['discount_value'],$value['total']);
			   // echo "<th>".$value['total']."</th>";
			   	$data1.=$style. "<th>".calculate_discounted_amount($value['discount_type'],$value['discount_value'],$value['total'])."</th>";
			 }
				$data1.=$style. "<th>".$grand_qty."</th><th></th><th>".$discounted_grand_total."</th>";
       $data1.=$style.'</thead>	
	<tr>
		<td style = "text-align: left"><b>Grand Total</b></td>';
   	$data1.=$style."<td colspan=".(4+count($result['nuke']))." style = 'text-align: left'>
			<b>".$discounted_grand_total."</b>
		</td>";
    $data1.=$style.'</tr>
	<tr>
		<td style = "text-align: left"><b>RUPEES</b></td>';
   	$data1.= $style."<td colspan=".(4+count($result['nuke']))." style = 'text-align: left'>
			<b>".convert_number_to_words($discounted_grand_total)." Only </b>
		</td>";
    $data1.=$style.'	</td>";
	</tr>
</tfoot>
</table>';

  $data1.=$style.'</body>
</html>';
 // $this->excel->stream('client_weekly_bulk_report'.$dt.'.xls', $result);
 //     $attach[] = 'exported/client_weekly_bulk_report'.$dt.'.xls';
  
    send_mail($from,$from_name, $to, $subject, $data1, $attach);

   
  }
 
}