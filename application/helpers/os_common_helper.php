<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* sends basic session data of logged in user set in the system 
* user_id, name etc...
*/
function get_session_data() {
        return ($_SESSION);
}

/**
* Formats the string representation of an array for human readability
*
* @param Array $arr The array to get the string representation of
* @param Boolean $htmlentities Whether the string representation be HTML encoded (default: FALSE)
* @param Boolean $pre_tags Whether the string representation have <pre> tags around (default: TRUE)
* @return String String representation of the array
*/
function print_array($arr, $htmlentities = FALSE, $pre_tags = TRUE) {
 $prefix = ' ';
 $suffix = ' ';
 if ($pre_tags) {
   $prefix = '<pre>';
   $suffix = '</pre>';
 }
 if ($htmlentities === TRUE) {
   return $prefix . htmlentities(print_r($arr, TRUE)) . $suffix;
 } else {
   return $prefix . print_r($arr, TRUE) . $suffix;
 }
}

/**
* Removes spaces, hyphens, parantheses and plus signs from the Phone number and retains last 10 digits
*
* @param String $phone Phone number to clean
* @return Int Cleaned Phone number
*/
function sanitize_phone_number($phone) {
 $phone = str_replace(')', '',
                    str_replace('(', '',
                    str_replace('+', '',
                    str_replace('-', '',
                    str_replace(' ', '', $phone))))); // TODO: Better handling of phones
 if (preg_match('/^91\d{10}$/', $phone)) $phone = substr($phone, 2);
 else if (preg_match('/^0\d{10}$/', $phone)) $phone = substr($phone, 1);
 return $phone ? $phone : FALSE; // Otherwise, it would return 0 and that would be displayed in the textbox if user did not submit anything!
}

/**
* Validates if a phone number begins with 1 to 9 and is ten digits long.
*
* @param String $phone Phone number to validate
* @return Boolean TRUE, if the phone number is valid; false, otherwise.
*/
function valid_phone($phone) {
 return sanitize_phone_number($phone);
}

function is_valid_mobile_number($mobile_number) {
 return preg_match('/^[789]\d{9}$/', $mobile_number);
}

function get_parts_from_phone_number($number) {
 $number = sanitize_phone_number($number);
 return array('isd_code' => '91', 'std_code' => substr($number, 0, 2), 'phone_number' => substr($number, 2));
}

function get_phone_number_from_parts($isd_code, $std_code, $phone_number, $type) {
 switch ($type) {
   case 'text': $number = '0' . $std_code . $phone_number; //022*****
     break;
   case 'text_intl': $number = '+' . $isd_code . $std_code . $phone_number; //+9122****
     break;
   case 'html': $number = '<span class="ds-phone">(0' . $std_code . ') ' . substr($phone_number, 0, 4) . ' ' . substr($phone_number, 4) . '</span>'; //<span class="ds-phone">(022) 6001 6002</span>
   case 'html_intl': $number = '<span class="ds-phone">(+' . $isd_code . '-' . $std_code . ') ' . substr($phone_number, 0, 4) . ' ' . substr($phone_number, 4) . '</span>'; //<span class="ds-phone">(+91-22) 6001 6002</span>
     break;
   default: $number = FALSE;
     break;
 }
 return $number;
}
// function createpdf($data)
// {
//   require(APPPATH .'/third_party/mpdf/mpdf.php');
// //  require_once('library/mpdf.php');

//  $mpdf = new mPDF();
//   $header=$this->load->view("login");
//   $mpdf->WriteHTML($header);
// $test="<table  border='1' style='width:100%; border-collapse:collapse'>";
//  foreach($data as $d)
//    {$test.="<tr>";
//      foreach($d as $key=>$value)
//      {
//         $test.="<th>".$key."</th>";
//      }$test.="</tr>";break;
//    }
// //$test='<p style="color:green">Your first taste of creating PDF from HTML</p>';
//   foreach($data as $d)
//    {$test.="<tr>";
//      foreach($d as $key=>$value)
//      {
//         $test.="<td>".$value."</td>";
//      }$test.="</tr><br>";
//    }
// $test.="</table>";
// $mpdf->WriteHTML($test);

  

//  $mpdf->Output();

//  exit;

          
// }

function get_all_items($id = NULL) {
  $ci = &get_instance();
  $ci->load->model('items_model');
  $result = $ci->items_model->view_items($id);
  if($result['status']) {
    return json_encode($result);
  }
  return json_encode([]);
}

function get_all_clients($id = NULL,  $search = FALSE, $search_term = NULL,$search_type = NULL, $offset = 0, $limit = 12, $rate_list = TRUE) {
  $ci = &get_instance();
  $ci->load->model('clients_model');
  $users = $ci->clients_model->clients_get($id,$search, $search_term,$search_type, $offset, $limit, $rate_list = TRUE); 
  if($users){
    return json_encode($users);
  }
  return json_encode([]);
}

function get_all_vendors($id = NULL) {
  $ci = &get_instance();
  $ci->load->model('vendormodel');
  $data = $ci->vendormodel->get_vendors($id);  
  if($data){
    return json_encode($data);
  }
  return json_encode([]);
}

function get_all_onspotVendors($id = NULL) {
  $ci = &get_instance();
  $ci->load->model('vendormodel');
  $data = $ci->vendormodel->get_Onspotvendors($id);
  if($data){
    return json_encode($data);
  }
  return json_encode([]);
}

function get_all_vendors_history($id = NULL) {
  $ci = &get_instance();
  $ci->load->model('vendormodel');
  $data = $ci->vendormodel->get_vendor_history($id);  
  if($data){
    return json_encode($data);
  }
  return json_encode([]);
}

function get_all_OnspotVendors_history($id = NULL) {
  $ci = &get_instance();
  $ci->load->model('vendormodel');
  $data = $ci->vendormodel->getOnspotHistory($id);  
  if($data){
    return json_encode($data);
  }
  return json_encode([]);
}

function get_all_orders($request = NULL, $client_id = NULL) {
  $ci = &get_instance();
  $ci->load->model('orders_model');
  // $request = '';
  $orders = $ci->orders_model->orders_get($request, $client_id);  
  if($orders){
    return json_encode($orders);
  }
  return json_encode([]);
}

function get_all_dispatch($id = NULL) {
  $ci = &get_instance();
  $ci->load->model('Dispatch_model');
  $request = '';
  // $orders = $ci->orders_model->orders_get($request,$request);
  $dispatch = $ci->Dispatch_model->delivery_orders($id);
  // print_r($dispatch);
  if($dispatch){
    return json_encode($dispatch);
  }
  return json_encode([]);
}

function get_all_markets(){
  $ci = &get_instance();
  $ci->load->model('markets_model');
  $markets = $ci->markets_model->get_markets();
  if($markets){
    return json_encode($markets);
  }
  return json_encode([]);
}

function get_all_proc_history($data){
  $ci = &get_instance();
  $ci->load->model('Procure_model');
  $proc_hist = $ci->Procure_model->get_procHistory($data);
    $result = $proc_hist ? json_encode($proc_hist) : json_encode([]);
    return $result;
}

function get_all_proc_details($assignee_id = NULL,$procure_id = NULL,$vendor_id = NULL){
  $ci = &get_instance();
  $ci->load->model('Procure_model');
  $proc_hist = $ci->Procure_model->get_proc_details($assignee_id,$procure_id,$vendor_id,FAlSE,NULL,0,1000);
    $result = $proc_hist ? $proc_hist[0] : [];
    return $result;
}

function get_all_jit_details($assignee_id = NULL,$jit_id = NULL){
  $ci = &get_instance();
  $ci->load->model('Procure_model');
  $jit_hist = $ci->Procure_model->get_jit_details($assignee_id,$jit_id,FAlSE,NULL,0,1000);
    $result = $jit_hist ? $jit_hist[0] : [];
    return $result;
}


function get_all_onspot_vendors($id = NULL){
  $ci = &get_instance();
  $ci->load->model('vendormodel');
  $onspot_vendor = $ci->vendormodel->get_Onspotvendors($id);
  if($onspot_vendor){
    return json_encode($onspot_vendor);
  }
  return json_encode([]);
}

function get_all_inward($assignee_id = NULL,$procure_id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_inward_details($assignee_id,$procure_id);
  $result = $query['status'] ? $query['data'] : json_encode([]);
  return $result;
}

function get_all_raw($id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_raw($id);   
  $result = $query['status'] ? $query['data'] : [];
  return $result;
}

function get_all_salable($id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_salable($id);
  $result = $query['status'] ? $query['data'] : [];
  return $result;
}

function get_all_leftovers($id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_leftovers($id);
  $result = $query['status'] ? $query['data'] : [];
  return $result;
}

function get_all_vendor_bills(){
  $ci = &get_instance();
  $ci->load->model('vendormodel');
  $query = $ci->vendormodel->get_bills();
  $result = $query ? $query : [];
  return $result;
}

function get_all_crates(){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_crates();
  $result = $query ? json_encode($query) : json_encode([]);
  return $result; 
}

function get_all_process($processing_id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_processing($processing_id);
  $result = $query ? json_encode($query) : json_encode([]);
  return $result;  
}

function get_all_inward_items($id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_inward_items($id);
  $result = $query['status'] ? $query['data'] : [];
  return $result;  
}

function get_all_line_manager_history($id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_line_manager_history($id);
  $result = $query ? $query : [];
  return $result;  
}

function get_all_transport($id = NULL){
  $ci = &get_instance();
  $ci->load->model('Delivery_model');
  $query = $ci->Delivery_model->get_transport($id);
  $result = $query ? json_encode($query) : json_encode([]);
  return $result;  
}

function get_all_transport_track($id = NULL){
  $ci = &get_instance();
  $ci->load->model('Delivery_model');
  $query = $ci->Delivery_model->get_transport_track($id);
  $result = $query ? $query : [];
  return $result;  
}

function get_all_return_inward($order_id = NULL){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->returned_orders_for_inward($order_id);
  $result = $query ? $query[0] : [];
  return $result;  
}

function get_all_assets($id=NULL, $offset = 0, $limit = 12){
  $ci = &get_instance();
  $ci->load->model('Assets_model');
  $query = $ci->Assets_model->assets_get($id, $offset = 0, $limit = 12);
  $result = $query ? $query : [];
  return $result;  
}
function get_all_assets_allocation($id=NULL, $offset = 0, $limit = 12){
  $ci = &get_instance();
  $ci->load->model('Assets_model');
  $query = $ci->Assets_model->assets_allocation_get($id, $offset = 0, $limit = 12);
  $result = $query ? $query : [];
  return $result;  
}

function get_item_id_for_search($search_term){
  $ci = &get_instance();
  $item_id = $ci->db->select('os_items.id')->like('os_items.item_name',$search_term)->from('os_items')->get();
  $result = ($item_id->num_rows() > 0) ? $item_id->row('id') : FALSE ;
  return $result;
}

function download_csv_from_database($columns, $table, $filename) {
  if(!isset($columns) || !isset($table)) return FALSE;

  $ci = &get_instance();
  $ci->load->dbutil();
  $ci->db->select($columns);
  $ci->db->where('status', 1);
  $query = $ci->db->get($table);
  $data = $ci->dbutil->csv_from_result($query);
  // Load download helper
  $ci->load->helper('download');
  // Stream download
  force_download($filename.date("Ymd").'.csv', $data);
  //return $ci->dbutil->csv_from_result($query);
}

function download_csv_for_client_ratelist($columns ,$client_id,$table ,$table2,$filename) {
  if(!isset($client_id) || !isset($table)) return FALSE;
  $ci = &get_instance();
  $ci->load->dbutil();
  $ci->db->select($columns);
  $ci->db->where('client_id', $client_id);
  $ci->db->join('os_items' , 'os_clients_rate_list.item_id = os_items.id');
  $query = $ci->db->get($table);
  $data = $ci->dbutil->csv_from_result($query);
  // Load download helper
  $ci->load->helper('download');
  // Stream download
  force_download($filename.date("Ymd").'.csv', $data);
  //print_r($filename); die;
  //return $ci->dbutil->csv_from_result($query);
}

function read_csv($filepath) {
  $ci = &get_instance();
  $ci->load->library('csv_reader');
  $result =   $ci->csv_reader->parse_file($filepath);//path to csv file
  $data =  $result;
  
  return $data;
}

function get_general_rates() {
  $ci = &get_instance();
  $ci->db->select('item_id,os_items.item_name,os_items.alternate_name,os_items.category,os_items.subcategory,os_items.uom, price');
  $ci->db->where('os_general_rate_list.status', 1);
  $ci->db->join('os_items', 'os_general_rate_list.item_id = os_items.id')->order_by('item_id','ASC');
  $query = $ci->db->get('os_general_rate_list');
  
  $result = $query ? $query->result_array() : [];
  
  return json_encode($result);
}

function get_total_item_qty_from_orders() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.id AS item_id,os_items.item_name AS item_name,ROUND(SUM(os_item_sku.sku * os_orders_items.quantity),2) AS total_qty
                            FROM os_items
                            JOIN os_item_sku On os_items.id = os_item_sku.item_id
                            JOIN os_orders_items ON os_items.id = os_orders_items.item_id
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders_track.orders_id = os_orders.id
                            WHERE os_orders.delivery_date >= "'.$dt.' " AND os_orders.status = 0 
                            GROUP BY os_items.id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : [];
  
  return json_encode($result);
}

function get_items_for_procure(){
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $result = [];
  $total_qty_orders = get_total_item_qty_from_orders();
  $qty_orders = json_decode($total_qty_orders,true);
  // echo print_array($qty_orders);die;  

  $temp=0;

  // foreach ($result as $key => $value) {
  //   foreach ($qty_orders as $key1 => $value1) {
  //     if($value['item_id'] != $value1['ItemID']){
  //           echo "Value : ".$value['item_id']." Value1 : ".$value1['ItemID']."<br>";
  //            // $new[$temp]['quantity']    = abs($result[$key]['quantity'] - $result[$key]['min_quantity']);
  //            // $new[$temp]['item_id']     = $result[$key]['item_id'];
  //            // $new[$temp]['item_name']   = $result[$key]['item_name'];
  //     }else{
  //            continue;
  //     }
  //   }
  //            $temp++;
  // } 

  // foreach ($result as $key => $value) {
    foreach ($qty_orders as $key => $value) {

      $ci->db->select('os_inventory_saleable.item_id,os_inventory_saleable.quantity, min_quantity');
      $query = $ci->db->get_where('os_inventory_saleable',['os_inventory_saleable.status'=>1,'os_inventory_saleable.item_id'=>$value['item_id']]);
      $inventory = $query->num_rows() > 0 ? $query->row_array() : [];
      if($query->num_rows() > 0){
         if(($inventory['quantity'] - $value['total_qty']) < $inventory['min_quantity'] ){
            $result[$key]['quantity']  = abs($inventory['quantity'] - ($inventory['min_quantity'] + $value['total_qty']));
            $result[$key]['item_id']   = $value['item_id'];
            $result[$key]['item_name'] = $value['item_name'];
         }
      }else{
          $result[$key]['quantity']  = $value['total_qty'];
          $result[$key]['item_id']   = $value['item_id'];
          $result[$key]['item_name'] = $value['item_name'];
      }
    }
  // }
      // print_r($result);die;
  return json_encode($result);
}

function update_order_status(){
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $ci->load->model('Orders_model');
  $ci->db->select('os_orders.id AS orders_id');
  $query = $ci->db->get_where('os_orders',['os_orders.delivery_date < ' => $dt, 'os_orders.status' => 0]);
  if($query->num_rows() > 0){
     $result = $query->result_array();
     foreach ($result as $key => $value) {
        $ci->Orders_model->orders_cancel($value);
     }
  }

}
function print_client_invoice($order_id) {//echo print_array($result['order']);die;
  $ci = &get_instance();
  //----------ITEMS ARRAY-------
  $ci->db->select('id');
  $ci->db->from('os_orders_track');
  $ci->db->where(array('orders_id' => $order_id));  
  $query1 = $ci->db->get();
  $item_array1 = $query1->result_array();
  foreach ($item_array1 as $key => $value) {
    $track_list[] = $value['id'];
  }
  $ci->db->select('*,os_orders_invoice.id as invoice_id,os_orders_invoice_retailer.id as invoice_id_retailer');
  $ci->db->from('os_orders_log');
  $ci->db->where_in('order_track_id', $track_list);
  $ci->db->join('os_orders_items', 'os_orders_items.id = os_orders_log.orders_items_id','LEFT');
  $ci->db->join('os_orders_track', 'os_orders_items.order_track_id = os_orders_track.id','LEFT');  
  $ci->db->join('os_orders', 'os_orders_track.orders_id = os_orders.id','LEFT');
  $ci->db->join('os_orders_invoice', 'os_orders_invoice.order_id = os_orders.id','LEFT');
  $ci->db->join('os_orders_invoice_retailer', 'os_orders_invoice_retailer.order_id = os_orders.id','LEFT');
  $query = $ci->db->get();
  $item_array = $query->result_array();
  // print_r($item_array);die;
  $total_amt = 0;
  if($query->num_rows() > 0){
        foreach ($item_array as $key => $value) {
           $ci->db->select('item_name,uom');
           $ci->db->where(['id' => $value['item_id']]);
           $item_det = $ci->db->get('os_items');
           $item_result = $item_det->result_array(); 
           $item_array[$key]['item_name'] = $item_result[0]['item_name'];
           $item_array[$key]['item_uom']  = $ci->config->item($item_result[0]['uom'],'uom');
           $total_amt += $value['final_price'];
        }
  }
//----------CLIENT DETAILS----

  $ci->load->model('Clients_model');
  $cid = isset($item_array[0]['client_id']) ? $item_array[0]['client_id'] : NULL;
  $client =  $ci->Clients_model->clients_get($cid);
  $result['name']               =         $client[0]['name'];
  $result['company_name']       =         $client[0]['company_name'];
  $result['poc_name']           =         $client[0]['poc_name'];
  $result['poc_phone']         =          $client[0]['poc_phone'];
  $result['category']         =          $client[0]['category'];
  $result['client_id']          =         $cid;
  $result['delivery_address']   =         $client[0]['delivery_address'];

//----------SIGN--------------
  $is_retailer = (is_retailer($order_id));
  $ci->db->select('auth,added_on,id as invoice_id,discount_type,discount_value');
  $ci->db->where(['order_id' => $order_id]);
  if($is_retailer){
    $sign = $ci->db->get('os_orders_invoice_retailer');
  }else{
    $sign = $ci->db->get('os_orders_invoice');
  }
  $auth = $sign->result_array();
  
//----------RESULT--------------
  $result['order'] = $query ? $item_array : FALSE;
  $result['total'] = $total_amt;
  // $sign ? ($result['delivery_on'] = $auth[0]['added_on']) : FALSE;
  ($sign->num_rows() > 0) ? ($result['invoice_id'] = $auth[0]['invoice_id']) : ($result['invoice_id'] = NULL);
  ($sign->num_rows() > 0) ? ($result['discount_type'] = $auth[0]['discount_type']) : ($result['discount_type'] = 0);
  ($sign->num_rows() > 0) ? ($result['discount_value'] = $auth[0]['discount_value']) : ($result['discount_value'] = 0);
  $delivery_date = isset($item_array[0]['delivery_date']) ? $item_array[0]['delivery_date'] : NULL;
  $result['delivery_date'] = $delivery_date;
  ($sign->num_rows() > 0) ? ($result['sign'] = $auth[0]['auth']) : $result['sign'] = '';

  $dm_ids = $ci->db->select('os_orders_track.id')->get_where('os_orders_track',['os_orders_track.orders_id'=>$order_id]);
  $result['dm_ids'] = ($dm_ids->num_rows() > 0) ? $dm_ids->result_array() : NULL;
  
  return $result; 
}

function convert_number_to_words($number) {
    $ci = &get_instance();
    
		if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}
		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */
		$res = "";
		if ($Gn) {
			$res .= convert_number_to_words($Gn) .  "Million";
		}
		if ($kn) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($kn) . " Thousand";
		}
		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($Hn) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "zero";
		}
		return $res;
	}

  function print_client_dm($track_id,$order_id) {

    $ci = &get_instance();
    $track_status = $ci->db->select('updated_on,status,auth')->get_where('os_orders_track',['id'=>$track_id])->result_array();
    //Taking All Details
    // if($track_status[0]['status'] >= 2){
    $ci->db->select('*')->from('os_orders_log');
    $ci->db->where_in('order_track_id',$track_id);
    $ci->db->join('os_orders_items', 'os_orders_items.id = os_orders_log.orders_items_id');
    $ci->db->join('os_orders_track', 'os_orders_items.order_track_id = os_orders_track.id');  
    $ci->db->join('os_orders_dispatch', 'os_orders_dispatch.orders_items_id = os_orders_items.id');
    $query = $ci->db->get();
    $all_data = $query->result_array();
    $total_amt = 0;
    //Taking Client_vals
    $client_details=$ci->db->select('client_id,delivery_date')->get_where('os_orders',['id'=>$all_data[0]['orders_id']])->result_array();
    $all_data[0]['client_id']=$client_details[0]['client_id'];

    if($query->num_rows() > 0){
        foreach ($all_data as $key => $value) {
           $item_det = $ci->db->select('item_name,uom')->get_where('os_items',['id' => $value['item_id']]);
           $item_result = $item_det->result_array(); 
           $all_data[$key]['item_name'] = $item_result[0]['item_name'];
           $all_data[$key]['item_uom']  = $ci->config->item($item_result[0]['uom'],'uom');
           $total_amt += $value['final_price'];
        }
    }

  //----------CLIENT DETAILS----
  $ci->load->model('Clients_model');
  $client =  $ci->Clients_model->clients_get($all_data[0]['client_id']);
  $result['name']               =         $client[0]['name'];
  $result['company_name']       =         $client[0]['company_name'];
  $result['poc_name']           =         $client[0]['poc_name'];
  $result['poc_phone']         =         $client[0]['poc_phone'];
  $result['category']         =         $client[0]['category'];
  $result['client_id']          =         $all_data[0]['client_id'];
  $result['delivery_address']   =         $client[0]['delivery_address'];
 
  //----------RESULT--------------
  $result['order'] = $query ? $all_data : FALSE;
  $result['total'] = $total_amt;
  $result['track_id'] = $track_id;
  $result['delivery_on'] = $track_status[0]['updated_on'];
  $result['delivery_date'] = $client_details[0]['delivery_date'];
  $all_data[0]['auth'] ? ($result['sign'] = $all_data[0]['auth']) : $all_data[0]['auth'] = '';
  
  //----------Invoice ID--------------
  if(is_retailer($order_id)){
     $ci->db->select('id')->from('os_orders_invoice_retailer');
  }else{
     $ci->db->select('id')->from('os_orders_invoice');
  }
  $ci->db->where(['order_id' => $order_id]);
  $invoice_id = $ci->db->get();
  ($invoice_id->num_rows() > 0) ?($result['invoice_id']= $invoice_id->row('id')) : ($result['invoice_id']= "###" );

  $dm_ids = $ci->db->select('os_orders_track.id')->get_where('os_orders_track',['os_orders_track.orders_id'=>$order_id]);
  $result['dm_ids'] = ($dm_ids->num_rows() > 0) ? $dm_ids->result_array() : NULL;
  // }else{
    
  //   $result = ['status'=>FALSE,'data'=>'Order Not Yet Delivered'];
  // }
  return $result; 
  }

  function print_dispatch_report($id) {
    $ci = &get_instance();
    $ci->load->model('Dispatch_model');
    $dr = $ci->Dispatch_model->delivery_orders($id);
    $result = $dr ? $dr : FALSE;

    return $result;
  }

  function print_purchase_orders($assignee_id,$procure_id,$vendor_id) {
    $ci = &get_instance();
    $ci->load->model('Procure_model');
    $purchase_orders = $ci->Procure_model->get_proc_details($assignee_id,$procure_id,$vendor_id,FAlSE,NULL,0,1000);
    $result = $purchase_orders ? $purchase_orders : FALSE;

    return $result;
  }  

  function print_purchase_jit_orders($assignee_id,$jit_id) {
    $ci = &get_instance();
    $ci->load->model('Procure_model');
    $purchase_orders = $ci->Procure_model->get_jit_details($assignee_id,$jit_id,FAlSE,NULL,0,1000);
    $result = $purchase_orders ? $purchase_orders : FALSE;

    return $result;
  } 
function get_item_by_id($id = NULL) {
  $ci = &get_instance();

  if(!$id) return false;
  
  $ci->load->model('Items_model');
  $result = $ci->Items_model->view_items($id);

  $data = $result['status'] ? $result['data']['items'][0] : $result['status'];

  return $data;
}

function get_vendor_by_id($id = NULL) {
  $ci = &get_instance();

  if(!$id) return false;
  
  $ci->load->model('vendormodel');
  $result = $ci->vendormodel->get_vendors($id);

  $data = $result ? $result[0] : $result;

  return $data;
}

function get_market_by_id($id = NULL) {
  $ci = &get_instance();

  if(!$id) return false;
  
  $ci->load->model('markets_model');
  $result = $ci->markets_model->get_markets($id);

  $data = $result ? $result[0] : $result;

  return $data;
}

function get_team_by_id($id = NULL) {
  $ci = &get_instance();
  $result = [];
  if(!$id) return false;
  $query = $ci->db->select('id, username, mobile, email, designation, permissions,status')->get_where('os_team',['id'=>$id]);
  if($query->num_rows() > 0){
    return $result = $query->result_array()[0];
  }else{
    return [];
  }      
}

function get_sku_by_id($id = NULL) {
  $ci = &get_instance();
  $result = [];
  if(!$id) return false;
  $query = $ci->db->select('id, item_id, sku, status')->get_where('os_item_sku',['id'=>$id]);
  $result = ($query->num_rows() > 0) ? $query->result_array()[0] : [];
  return $result;
}

function get_processing_track_by_id($id = NULL){
  $ci = &get_instance();
  $result = [];
  if(!$id) return false; 
  $ci->load->model('Inventory_model');
  $result = $ci->Inventory_model->get_processing_track($id);
  $data = $result ? $result : $result;
  return $data;
}

function get_api_key_for_user_id($id = NULL) {
  $ci = &get_instance();
  if(!$id) return false;
  
  $result = $ci->db->get_where('os_api_keys',['user_id' => $id])->row()->key;
  
  return $result;
}


function get_delivery_boys($id = NULL){
  $ci = &get_instance();
  $result = [];
  $ci->load->model('Delivery_model');
  $data = $ci->Delivery_model->delivery_boys_history($id);
  $result = $data['status'] ? $data['data'] : [];
  return $result;
}

function send_mail($from,$from_name, $to, $subject, $msg, $attach = NULL) {
    $api_key=MAILGUN_API_KEY;
    $domain =MAILGUN_DOMAIN;
    $now = date("Y-m-d H:i:s");
    //$user = get_session_data();
    $send = ['from' => $from_name.'<'.$from.'>',
            'to' => $to,
            'subject' => $subject,
            'html' => $msg];

    if(isset($attach) && is_array($attach) && !empty($attach))  {
      foreach($attach as $k => $file) {
        $send['attachment['.($k+1).']'] = curl_file_create($file);
      }
    }
    //echo print_array($send);die;
    $ci = &get_instance();
    $ci->load->model('Mail_model');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $send);
    $result = curl_exec($ch);
    $result_array = json_decode($result,true);//echo print_array($result_array);die;
    $data = array(
      'from'=>$from,
      'to'=>$to,
      'from_name'=>$from_name,
      'subject'=>$subject,
      'message'=>$msg,
      'response_id'=>$result_array['id'],
      'response_dump'=>$result,
      "added_on" => $now,
      "added_by" => 0);
    $output = $ci->Mail_model->email_entry($data);
    if($output['status']) {
      $output['message'] = "email sent successfully";
      return $output;
    }
    curl_close($ch);
    return $output;
  }

function test_ut() {
  $ci = &get_instance();
  $ci->load->dbutil();
  // $result = $ci->dbutil->optimize_database();
  // if ($result !== FALSE)
  // {
  //         return ($result);
  // }
  
  // if ($ci->dbutil->repair_table('os_items'))
  // {
  //         echo 'Success!';
  // }
  // Load the DB utility class
  $ci->load->dbutil();

  // Backup your entire database and assign it to a variable
  $backup = $ci->dbutil->backup();

  // Load the file helper and write the file to your server
  $ci->load->helper('file');
  write_file('/var/www/html/mybackup.gz', $backup);

  // Load the download helper and send the file to your desktop
  $ci->load->helper('download');
  force_download('mybackup.gz', $backup);
}

function client_wise_sale($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_orders.client_id AS client_id,os_clients.name AS client_name, ROUND(SUM(os_orders_items.quantity),2) AS total_qty, os_items.uom,
                            ROUND(SUM(os_orders_items.price),2) AS total_sale 
                            From os_orders
                            JOIN os_orders_track ON os_orders.id = os_orders_track.orders_id
                            JOIN os_orders_items ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_clients ON os_orders.client_id = os_clients.id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            WHERE os_orders.delivery_date= "'.$dt.'"
                            '.$sql.'
                            GROUP BY os_orders.client_id,os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;
  $clients = [];

  if(isset($result)) {
    foreach($result as $k => $client){
      $client['total_qty'] = $client['total_qty'].' '.$ci->config->item($client['uom'], 'uom');
      $key = array_search($client['client_id'], array_map(function($data) {return $data['client_id'];}, $clients));
      if($key !== false) {
        $clients[$key]['total_qty'] .= ','.$client['total_qty'];
        $clients[$key]['total_sale'] += $client['total_sale'];
      }else {
        unset($client['uom']);
        $clients[] = $client;
      }
      unset($result[$k]);
    }
  }

  return $clients;
}

function client_week_wise_sale($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_orders.client_id AS client_id,os_clients.name AS client_name, ROUND(SUM(os_orders_items.quantity),2) AS total_qty, os_items.uom,
                            ROUND(SUM(os_orders_items.price),2) AS total_sale 
                            From os_orders
                            JOIN os_orders_track ON os_orders.id = os_orders_track.orders_id
                            JOIN os_orders_items ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_clients ON os_orders.client_id = os_clients.id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            WHERE WEEK(os_orders.delivery_date)= WEEK("'.$dt.'") - 1
                            '.$sql.'
                            GROUP BY os_orders.client_id,os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;
  $clients = [];

  if(isset($result)) {
    foreach($result as $k => $client){
      $client['total_qty'] = $client['total_qty'].' '.$ci->config->item($client['uom'], 'uom');
      $key = array_search($client['client_id'], array_map(function($data) {return $data['client_id'];}, $clients));
      if($key !== false) {
        $clients[$key]['total_qty'] .= ','.$client['total_qty'];
        $clients[$key]['total_sale'] += $client['total_sale'];
      }else {
        unset($client['uom']);
        $clients[] = $client;
      }
      unset($result[$k]);
    }
  }

  return $clients;
}

function total_day_sale($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
 $dt = date("Y-m-d", strtotime("-1 days"));

  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT ROUND(SUM(os_orders_items.price),2) AS sale 
                            From os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_clients ON os_clients.id = os_orders.client_id
                            WHERE os_orders.delivery_date = "'.$dt.'"'.$sql);
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : ['sale' => 1];

  return $result;
}

function total_week_sale($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT ROUND(SUM(os_orders_items.price),2) AS sale 
                            From os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            WHERE WEEK(os_orders.delivery_date) = WEEK("'.$dt.'") - 1'.$sql);
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : ['sale' => 1];

  return $result;
}

function category_wise_sale($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
 $dt = date("Y-m-d", strtotime("-1 days"));
 
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.category AS category,ROUND(SUM(os_orders_items.price),2) AS total_sale
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            WHERE os_orders.delivery_date="'.$dt.'"
                            '.$sql.'
                            GROUP BY os_items.category');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['name'] = $ci->config->item($value['category'], 'category');
    }
  }
  return $result;
}

function category_week_wise_sale($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.category AS category,ROUND(SUM(os_orders_items.price),2) AS total_sale
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            WHERE WEEK(os_orders.delivery_date)=WEEk("'.$dt.'") - 1
                            '.$sql.'
                            GROUP BY os_items.category');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['name'] = $ci->config->item($value['category'], 'category');
    }
  }

  return $result;
}

function category_wise_day_total_qty($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();

  $sql = '';

  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.category AS category,ROUND(SUM(os_orders_items.quantity),2) AS total_qty, os_items.uom
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            WHERE os_orders.delivery_date="'.$dt.'"
                            '.$sql.'
                            GROUP BY os_items.category,os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['category'] = $ci->config->item($value['category'], 'category');
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function category_week_wise_day_total_qty($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.category AS category,ROUND(SUM(os_orders_items.quantity),2) AS total_qty, os_items.uom
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            JOIN os_clients ON os_clients.id = os_orders.client_id
                            WHERE WEEK(os_orders.delivery_date)=WEEK("'.$dt.'") - 1
                            '.$sql.'
                            GROUP BY os_items.category,os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['category'] = $ci->config->item($value['category'], 'category');
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function get_purchase_sale(){
  $dt = '2017-03-03';
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_orders_items.item_id,os_items.item_name AS name, os_items.category AS category,
                            ROUND(SUM(os_orders_items.quantity),2) AS total_qty,os_orders.delivery_date AS delivery
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id=os_orders_items.item_id 
                            WHERE os_orders.delivery_date="'.$dt.'"
                            GROUP BY os_orders_items.item_id');
               
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;
 
  if(isset($result)){
    foreach($result as $k => $item){
      $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate
                                FROM os_vendors_bills_logs
                                JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no =os_vendors_bills.bill_no
                                WHERE os_vendors_bills.bill_date ="'.$dt.'" AND os_vendors_bills_logs.item_id = '.$item['item_id'].'');

      $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
  
      if($rate['rate'] > 0) {
      
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
       
      }else {
          
        $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate,os_vendors_bills.bill_date, os_vendors_bills_logs.item_id AS item_id
                                  FROM os_vendors_bills_logs
                                  JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                                  WHERE os_vendors_bills_logs.item_id = '.$item['item_id'].'
                                  order by os_vendors_bills.bill_date DESC');

        $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
        print_r($query->result_array()); die;
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
      
        
      }
    }
  }

  $items = [];
  foreach($result as $k => $item){
    unset($item['item_id'], $item['name'], $item['delivery']);
    $key = array_search($item['category'], array_map(function($data) {return $data['category'];}, $items));
    if($key !== false) {
      $items[$key]['total_qty'] += $item['total_qty'];
      $items[$key]['total'] += $item['total'];
    }else {
      $items[] = $item;
    }

    unset($result[$k]);
  }

  return $items;
}

function get_item_wise_average_sale(){
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_orders_items.item_id,os_items.item_name AS name, os_items.category AS category,
                            ROUND(SUM(os_orders_items.quantity),2) AS total_qty,os_orders.delivery_date AS delivery,
                            ROUND(AVG((os_orders_items.price)/(os_orders_items.quantity))) AS avg_rate
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id=os_orders_items.item_id 
                            WHERE os_orders.delivery_date="'.$dt.'"
                            GROUP BY os_orders_items.item_id');
              // print_r($query->result_array());die;
  $result = $query->num_rows() > 0 ? $query->result_array() : ['avg_rate' => 1];
  return $result;
}

function get_item_wise_purchase_sale(){
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_orders_items.item_id,os_items.item_name AS name, os_items.category AS category,
                            ROUND(SUM(os_orders_items.quantity),2) AS total_qty,os_orders.delivery_date AS delivery,
                            os_items.uom AS uom
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id=os_orders_items.item_id 
                            WHERE os_orders.delivery_date="'.$dt.'"
                            GROUP BY os_orders_items.item_id');
               
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;
  if(isset($result)) {
    foreach($result as $k => $value) {
           $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }
  if(isset($result)){
    foreach($result as $k => $item){
      $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate
                                FROM os_vendors_bills_logs
                                JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no =os_vendors_bills.bill_no
                                WHERE os_vendors_bills.bill_date ="'.$dt.'" AND os_vendors_bills_logs.item_id = '.$item['item_id'].'');
  ;
      $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
  
      if($rate['rate'] > 0) {
      
        $result[$k]['rate'] =  $rate['rate'];
       
      }else {
          
        $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate,os_vendors_bills.bill_date, os_vendors_bills_logs.item_id AS item_id
                                  FROM os_vendors_bills_logs
                                  JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                                  WHERE os_vendors_bills_logs.item_id = '.$item['item_id'].'
                                  order by os_vendors_bills.bill_date DESC');

        $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
 
        $result[$k]['rate'] =  $rate['rate'];
     //print_r($query->result_array());die;
        
      }
    }
  }

  $items = [];
  foreach($result as $k => $item){
    unset($item['item_id'], $item['delivery']);
    $key = array_search($item['name'], array_map(function($data) {return $data['name'];}, $items));
    if($key !== false) {
      $items[$key]['total_qty'] += $item['total_qty'];
      $items[$key]['rate'] = $item['rate'];
    }else {
      $items[] = $item;
    }

    unset($result[$k]);
  }

  return $items;
}

function get_week_purchase_sale(){
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_orders_items.item_id,os_items.item_name AS name, os_items.category AS category,
                            ROUND(SUM(os_orders_items.quantity),2) AS total_qty,os_orders.delivery_date AS delivery
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id=os_orders_items.item_id 
                            WHERE WEEK(os_orders.delivery_date)=WEEK("'.$dt.'") - 1
                            GROUP BY os_orders_items.item_id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)){
    foreach($result as $k => $item){
      $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate
                                FROM os_vendors_bills_logs
                                JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no =os_vendors_bills.bill_no
                                WHERE WEEK(os_vendors_bills.bill_date) =WEEK("'.$dt.'") - 1 AND os_vendors_bills_logs.item_id = '.$item['item_id'].'');

      $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];

      if($rate['rate'] > 0) {
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
      }else {
        $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate
                                  FROM os_vendors_bills_logs
                                  JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                                  WHERE os_vendors_bills_logs.item_id = '.$item['item_id'].'
                                  order by os_vendors_bills.bill_date DESC');

        $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
      }
    }
  }

  $items = [];
  foreach($result as $k => $item){
    unset($item['item_id'], $item['name'], $item['delivery']);
    $key = array_search($item['category'], array_map(function($data) {return $data['category'];}, $items));
    if($key !== false) {
      $items[$key]['total_qty'] += $item['total_qty'];
      $items[$key]['total'] += $item['total'];
    }else {
      $items[] = $item;
    }

    unset($result[$k]);
  }

  return $items;
}

function total_day_purchase_amt() {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $query = $ci->db->query('SELECT SUM(os_vendors_bills.bill_amt) AS purchase
                            FROM os_vendors_bills
                            WHERE os_vendors_bills.bill_date = "'.$dt.'"');
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : ['purchase' => 1];

  return $result;
}
/*function total_last_day_purchase_amt(){
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $ci->db->select('bill_date');
  
  print_r($dt);
  $query = $ci->db->query('SELECT os_orders_items.item_id,os_items.item_name AS name,os_items.category AS category,
                            ROUND(SUM(os_orders_items.quantity),2) AS total_qty,os_orders.delivery_date AS delivery
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id=os_orders_items.item_id 
                            WHERE os_orders.delivery_date="'.$dt.'"
                            GROUP BY os_items.category');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)){
    foreach($result as $k => $item){
      $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate
                                FROM os_vendors_bills_logs
                                JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no =os_vendors_bills.bill_no
                                WHERE os_vendors_bills.bill_date ="'.$dt.'" AND os_vendors_bills_logs.item_id = '.$item['item_id'].'');

      $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];

      if($rate['rate'] > 0) {
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
      }else {
        $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate
                                  FROM os_vendors_bills_logs
                                  JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                                  WHERE os_vendors_bills_logs.item_id = '.$item['item_id'].'
                                  order by os_vendors_bills.bill_date DESC');

        $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
      }
    }
  }

  $items = [];
  foreach($result as $k => $item){
    unset($item['item_id'], $item['name'], $item['delivery']);
    $items[] = $item;
    $key = array_search($item['category'], array_map(function($data) {return $data['category'];}, $items));
    if($key !== false) {
      $items[$key]['total_qty'] += $item['total_qty'];
      $items[$key]['total'] += $item['total'];
    }else {
      $items[] = $item;
    }

    unset($result[$k]);
  }

  return $items;
 /* $query = $ci->db->query('SELECT SUM(os_vendors_bills.bill_amt) AS purchase
                            FROM os_vendors_bills
                            WHERE os_vendors_bills.bill_date = "'.$dt.'"');
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : ['purchase' => 1];
  return $result;

}
function cogs_by_category(){
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();

   $query = $ci->db->query('SELECT os_orders_items.item_id,os_items.item_name AS name, os_items.category AS category,
                            ROUND(SUM(os_orders_items.quantity),2) AS total_qty,os_orders.delivery_date AS delivery
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id=os_orders_items.item_id 
                            WHERE os_orders.delivery_date="'.$dt.'"
                            GROUP BY os_orders_items.item_id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;
  if(isset($result)){
    foreach($result as $k => $item){
      $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate ,os_vendors_bills_logs.item_id AS Item_id
                                FROM os_vendors_bills_logs
                                JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no =os_vendors_bills.bill_no
                                WHERE os_vendors_bills.bill_date ="'.$dt.'" AND os_vendors_bills_logs.item_id = '.$item['item_id'].'');

      $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
      if($rate['rate'] > 0) {
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
      }else {
        $query = $ci->db->query('SELECT os_vendors_bills_logs.rate AS rate,os_vendors_bills_logs.item_id AS Item_id
                                  FROM os_vendors_bills_logs
                                  JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                                  WHERE os_vendors_bills_logs.item_id = '.$item['item_id'].'
                                  order by os_vendors_bills.bill_date DESC');

        $rate = $query->num_rows() > 0 ? $query->row_array() : ['rate' => 0];
      
        $result[$k]['total'] = $item['total_qty'] * $rate['rate'];
      }
    }
  }
  /*$query = $ci->db->query('SELECT SUM(os_vendors_bills_logs.rate * os_vendors_bills_logs.qty) AS total_rate ,os_items.category AS category
                                  FROM os_vendors_bills_logs
                                  JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                                  JOIN os_items ON os_items.id = os_vendors_bills_logs.item_id
                                  WHERE os_vendors_bills.bill_date = "'.$date.'"
                                  GROUP BY os_items.category'
                                  );
  $result = $query->num_rows() > 0 ? $query->result_array() : ['total_rate' => 1];

   return $result;*/
   
  /* return $result;
}*/
function total_week_purchase_amt() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT SUM(os_vendors_bills.bill_amt) AS purchase
                            FROM os_vendors_bills
                            WHERE WEEK(os_vendors_bills.bill_date) = WEEK("'.$dt.'") - 1');
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : ['purchase' => 1];

  return $result;
}

function avg_purchase_per_unit() {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.category, ROUND(((SUM(os_vendors_bills_logs.qty*os_vendors_bills_logs.rate))/(SUM(os_vendors_bills_logs.qty))),2) AS purchase_qty, os_items.uom
                            FROM os_vendors_bills_logs
                            JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                            JOIN os_items ON os_vendors_bills_logs.item_id = os_items.id
                            WHERE os_vendors_bills.bill_date ="'.$dt.'" AND os_items.uom !=3
                            GROUP BY os_items.category, os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['category'] = $ci->config->item($value['category'], 'category');
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function avg_week_purchase_per_unit() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.category, ROUND(((SUM(os_vendors_bills_logs.qty*os_vendors_bills_logs.rate))/(SUM(os_vendors_bills_logs.qty))),2) AS purchase_qty, os_items.uom
                            FROM os_vendors_bills_logs
                            JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                            JOIN os_items ON os_vendors_bills_logs.item_id = os_items.id
                            WHERE WEEK(os_vendors_bills.bill_date) =WEEK("'.$dt.'") - 1 AND os_items.uom !=3
                            GROUP BY os_items.category, os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['category'] = $ci->config->item($value['category'], 'category');
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function avg_sale_per_unit($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.category, ROUND((SUM(os_orders_items.price))/(SUM(os_orders_items.quantity)),2) AS avg, os_items.uom
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            WHERE os_orders.delivery_date="'.$dt.'" AND os_items.uom !=3
                            '.$sql.'
                            GROUP BY os_items.category, os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['category'] = $ci->config->item($value['category'], 'category');
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function avg_week_sale_per_unit($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.category, ROUND((SUM(os_orders_items.price))/(SUM(os_orders_items.quantity)),2) AS avg, os_items.uom
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_orders_items.item_id = os_items.id
                            WHERE WEEK(os_orders.delivery_date)=WEEK("'.$dt.'") - 1 AND os_items.uom !=3
                            '.$sql.'
                            GROUP BY os_items.category, os_items.uom');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['category'] = $ci->config->item($value['category'], 'category');
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function procurement_day_purchase_data() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.item_name AS item_name, os_vendors_bills_logs.qty AS qty, os_items.uom AS uom, os_vendors_bills_logs.rate AS rate,
                            os_vendors_bills_logs.apmc_tax AS apmc_tax, os_vendors_bills_logs.levi_tax AS levi_tax, (os_vendors_bills_logs.qty*os_vendors_bills_logs.rate) AS amount,
                            os_vendors_bills.bill_date AS Date,os_vendors.name AS vendor_name
                            FROM os_vendors_bills_logs
                            JOIN os_vendors_bills ON os_vendors_bills_logs.bill_no = os_vendors_bills.bill_no
                            JOIN os_items ON os_items.id = os_vendors_bills_logs.item_id
                            JOIN os_vendors ON os_vendors.id = os_vendors_bills.vendor_id
                            WHERE os_vendors_bills.bill_date = "'.$dt.'"');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function jit_day_purchase_data(){
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.item_name AS item_name, os_procurement_items.quantity AS qty, os_items.uom AS uom, os_procurement_items.final_price AS rate,
                              (os_procurement_items.quantity*os_procurement_items.final_price) AS amount,
                            os_procurement.procure_date AS Date
                            FROM os_procurement_items
                            JOIN os_procurement ON os_procurement.id = os_procurement_items.procure_id
                            JOIN os_items ON os_items.id = os_procurement_items.item_id
                            WHERE os_procurement.procure_date = "'.$dt.'"');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;
  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }
  return $result;
}

function jit_day_purchase_total_qty() {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $query = $ci->db->query('SELECT SUM(os_procurement_items.quantity) AS total_qty
                            FROM os_procurement_items
                            JOIN os_procurement ON os_procurement.id = os_procurement_items.procure_id
                            JOIN os_items ON os_items.id = os_procurement_items.item_id
                            WHERE os_procurement.procure_date = "'.$dt.'"');
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : ['total_qty' => 1];

  return $result;
}

function jit_day_purchase_total_price(){
  $dt = date("Y-m-d",strtotime("-1 days"));
  $ci =&get_instance();
  $query = $ci->db->query('SELECT SUM(os_procurement_items.final_price) AS total_price
                            FROM os_procurement_items
                            JOIN os_procurement ON os_procurement.id = os_procurement_items.procure_id
                            JOIN os_items ON os_items.id = os_procurement_items.item_id
                            WHERE os_procurement.procure_date = "'.$dt.'"');
          $result = $query->num_rows() > 0 ? $query->row_array() : ['total_price' => 1];
          return $result;
}

function total_actual_sale($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT ROUND(SUM(os_orders_log.final_price),2) AS sale
                            From os_orders_log
                            JOIN os_orders_items ON os_orders_items.id = os_orders_log.orders_items_id
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_clients ON os_clients.id = os_orders.client_id
                            WHERE os_orders.delivery_date = "'.$dt.'"'.$sql);
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : NULL;

  return $result;
}

function total_short_supply_qty($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.item_name, ROUND(os_orders_log.back_qty, 2) AS short_supply, os_items.uom AS uom
                            FROM os_orders_log
                            JOIN os_orders_items ON os_orders_items.id = os_orders_log.orders_items_id
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_items.id = os_orders_items.item_id
                            WHERE os_orders.delivery_date = "'.$dt.'" AND os_orders_log.reason = "Short Supply"
                            '.$sql.'
                            GROUP BY os_items.id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function total_return_qty($retailer = FALSE, $hospitality = FALSE, $all = TRUE) {
  $dt = date("Y-m-d", strtotime("-1 days"));
  $ci = &get_instance();
  $sql = '';
  if($retailer && !$all) {
    $sql = 'AND os_clients.category = 6';
  }

  if($hospitality && !$all) {
    $sql = 'AND os_clients.category != 6';
  }

  $query = $ci->db->query('SELECT os_items.item_name, ROUND(os_orders_log.back_qty, 2) AS return_qty, os_items.uom AS uom
                            FROM os_orders_log
                            JOIN os_orders_items ON os_orders_items.id = os_orders_log.orders_items_id
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_items.id = os_orders_items.item_id
                            WHERE os_orders.delivery_date = "'.$dt.'" AND os_orders_log.reason = "Return and Cancel"
                            '.$sql.'
                            GROUP BY os_items.id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function total_week_return_qty() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.item_name, ROUND(os_orders_log.back_qty, 2) AS return_qty, os_items.uom AS uom
                            FROM os_orders_log
                            JOIN os_orders_items ON os_orders_items.id = os_orders_log.orders_items_id
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            JOIN os_items ON os_items.id = os_orders_items.item_id
                            WHERE WEEK(os_orders.delivery_date) = WEEK("'.$dt.'") - 1 AND os_orders_log.reason = "Return and Cancel"
                            GROUP BY os_items.id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function total_week_actual_sale() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT ROUND(SUM(os_orders_log.final_price),2) AS sale
                            From os_orders_log
                            JOIN os_orders_items ON os_orders_items.id = os_orders_log.orders_items_id
                            JOIN os_orders_track ON os_orders_items.order_track_id = os_orders_track.id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id
                            WHERE WEEK(os_orders.delivery_date) = WEEK("'.$dt.'") - 1');
                  
  $result = $query->num_rows() > 0 ? $query->row_array() : NULL;

  return $result;
}

function items_to_procure_for_retailers() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.item_name AS NAME,os_items.alternate_name,
                            ROUND(SUM(os_orders_items.quantity),2) AS TotalQuant,os_items.uom AS uom
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id = os_orders_items.item_id 
                            JOIN os_clients ON os_orders.client_id = os_clients.id
                            WHERE os_orders.delivery_date = "'.$dt.'" AND os_clients.category = 6
                            GROUP BY os_orders_items.item_id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}

function items_to_procure_for_hospitality() {
  $dt = date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->query('SELECT os_items.item_name AS NAME,os_items.alternate_name,
                            ROUND(SUM(os_orders_items.quantity),2) AS TotalQuant,os_items.uom AS uom
                            FROM os_orders_items
                            JOIN os_orders_track ON os_orders_track.id = os_orders_items.order_track_id
                            JOIN os_orders ON os_orders.id = os_orders_track.orders_id 
                            JOIN os_items ON os_items.id=os_orders_items.item_id 
                            JOIN os_clients ON os_orders.client_id = os_clients.id
                            WHERE os_orders.delivery_date = "'.$dt.'" AND os_clients.category != 6
                            GROUP BY os_orders_items.item_id');
                  
  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['uom'] = $ci->config->item($value['uom'], 'uom');
    }
  }

  return $result;
}


function client_orders_check() {
  $date = date('Y-m-d');
  $ci = &get_instance();

  $ci->db->select('client_id');
  $ci->db->where('delivery_date', $date);
  $ci->db->group_by('client_id');

  $query = $ci->db->get('os_orders');

  $orders_clients = $query->num_rows() > 0 ? $query->result_array() : NULL;
  $ids = array_column($orders_clients, 'client_id');

  $ci->db->select('id, name, category');
  $ci->db->where('status', 1);
  $query = $ci->db->get('os_clients');

  $result = $query->num_rows() > 0 ? $query->result_array() : NULL;

  if(isset($result)) {
    foreach($result as $k => $value) {
      $result[$k]['order_placed'] = in_array($value['id'], $ids) ? 'YES' : 'NO';
      $result[$k]['category'] = $value['category'] == 6 ? 'RETAILER' : 'HOSPITALITY';
    }
  }

  return $result;
}

function client_orders_check_invoice() {
  $date = date('Y-m-d',strtotime("-1 days"));
  $ci = &get_instance();

  $ci->db->select('os_orders.id,os_orders.delivery_date,os_clients.name');
  $ci->db->where('delivery_date',$date);
  $ci->db->where('os_orders.status <=',3);
  $ci->db->where('os_orders.status !=',0);
  $ci->db->from('os_orders');
  $ci->db->join('os_clients','os_clients.id=os_orders.client_id');
  $ci->db->group_by('client_id');

  $query = $ci->db->get();

  $orders_clients = $query->num_rows() > 0 ? $query->result_array() : NULL;
  $ids = array_column($orders_clients, 'client_id');

   return $orders_clients;
}

function calculate_discount($type,$value,$total){
  if($type == 1){
    $num = number_format((float)(($value/$total)*100), 2, '.', '');
    $result = $value.' ('.$num.'%)';
  }
  if($type == 2){
    $result = $total*($value/100).' ('.$value.'%)';
  }else{
    $result = "0(0%)";
  }

  return $result;
}

function calculate_discounted_amount($type,$value,$total){
  if($type == 1){
      $num = $total - $value;
      $result = number_format(round($num), 2, '.', '');
  }elseif($type == 2){
      $num = $total - ($total*($value/100));
      $result = number_format(round($num), 2, '.', '');
  }else{
    $result = number_format(round($total), 2, '.', '');
  }
  return $result;
}

function num_to_words_with_decimal($testNumber){

  $tempNum = explode( '.' , $testNumber );

  $convertedNumber = ( isset( $tempNum[0] ) ? convert_number_to_words( $tempNum[0] ) : '' );

  //  Use the below line if you don't want 'and' in the number before decimal point
  $convertedNumber = str_replace( ' and ' ,' ' ,$convertedNumber );

  //  In the below line if you want you can replace ' and ' with ' , '
  $convertedNumber .= ( ( isset( $tempNum[0] ) and isset( $tempNum[1] ) )  ? ' and ' : '' );

  $convertedNumber .= ( isset( $tempNum[1] ) ? convert_number_to_words( $tempNum[1] ) .' paise' : '' );

  return $convertedNumber; 

}

function orders_notification()
{ 
  $d=date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->get_where('os_orders',['status'=>0,'delivery_date >='=>$d]);
  $result = ($query->num_rows() > 0) ? $query->num_rows() : NULL;
  return $result;
  }

function inward_notification(){ 
 $new = [];
 $d   = date("Y-m-d");
 $ci  = &get_instance();
 $query = $ci->db->select('os_procurement.id')->where('procure_date >=',$d)->from('os_procurement')->get();
 if($query->num_rows() > 0){
   $output = $query->result_array();
   // print_r($output);die;
     foreach ($output as $key => $value) {
       $ci->db->select('os_procurement_items.id as proc_items_id,os_procurement_items.procure_id as id');
       $query = $ci->db->get_where('os_procurement_items',['procure_id'=>$value['id'],'status !='=>5]);
       // print_r($query->result_array());die;
       $data = $query->result_array();
       // print_r($data);die;
        foreach ($data as $key1) {
         $new[$key1['id']]['id']  = $key1['id'];
       }
     }
    $result = count($new);
    return $result;
  }
}

function return_inward_notification(){
  $new=[];
  $d=date("Y-m-d");
  $ci =&get_instance();
  $ci->db->distinct();
  $ci->db->select('os_orders.id as order_id');
  $ci->db->from('os_orders_log');
  $ci->db->like(['reason'=>'return']);
  $ci->db->where(['os_orders.delivery_date >='=>$d]);
  $ci->db->join('os_orders_items', 'os_orders_items.id = os_orders_log.orders_items_id');
  $ci->db->join('os_orders_track', 'os_orders_items.order_track_id = os_orders_track.id');  
  $ci->db->join('os_orders', 'os_orders_track.orders_id = os_orders.id');
  $ci->db->join('os_clients', 'os_clients.id = os_orders.client_id');
  $query = $ci->db->get();
  
  if($query->num_rows() > 0){
     $data = $query->result_array();
      // print_r($data);die;
     foreach ($data as $key => $value) {

      $ci->db->select('os_orders_log.back_qty,os_orders_log.reason,os_orders.id as order_id,os_orders.client_id,os_clients.name as client_name,os_clients.company_name,os_orders.delivery_date,os_orders_items.item_id, os_items.item_name,os_items.uom');
      $ci->db->from('os_orders_log');
      $ci->db->where(['os_orders.id'=>$value['order_id']]);
      $ci->db->join('os_orders_items', 'os_orders_items.id = os_orders_log.orders_items_id','LEFT');
      $ci->db->join('os_orders_track', 'os_orders_items.order_track_id = os_orders_track.id','LEFT');  
      $ci->db->join('os_orders', 'os_orders_track.orders_id = os_orders.id','LEFT');
      $ci->db->join('os_clients', 'os_clients.id = os_orders.client_id','LEFT');
      $ci->db->join('os_items', 'os_items.id = os_orders_items.item_id','LEFT');
      $query = $ci->db->get();
      $output = $query->result_array();
      foreach ($output as $key1) {
        // if($value['order_id'] == $key1['order_id']){
           $new[$key1['order_id']]['order_id']      = $key1['order_id'];
        
      }
     }
     $result = count($new);
     return $result;
    }
}

function dispatch_notification()
{ 
  $d=date("Y-m-d");
  $ci = &get_instance();
  $query = $ci->db->get_where('os_orders',['status'=>0,'delivery_date >='=>$d]);
  $result = ($query->num_rows() > 0) ? $query->num_rows() : NULL;
  return $result;
  }

  function processing_notification()
  {
    $ci=&get_instance();

    $query=$ci->db->select('id')->get_where('os_inventory_processing',['status <'=>5]);
    $result=($query->num_rows() > 0) ? $query->num_rows() : NULL;
    return $result;
  }

  function is_retailer($order_id){
    $ci = &get_instance();
    $result = FALSE;
    $ci->db->select('os_clients.category')->from('os_orders');
    $ci->db->join('os_clients','os_clients.id = os_orders.client_id');
    $is_retailer = $ci->db->where(['os_orders.id' => $order_id])->get();
    if($is_retailer->num_rows() > 0){
      $check = $is_retailer->row('category');
      $result = ($check == 6) ? TRUE : FALSE ;
    }
    return $result;
  }


  function get_all_employees($id = NULL,  $search = FALSE, $search_term = NULL,$offset = 0, $limit = 12) {
  $ci = &get_instance();
  $ci->load->model('Employee_model');
  $users = $ci->Employee_model->get_employee($id,$search, $search_term,$offset, $limit); 
  if($users){
    return json_encode($users);
  }
  return json_encode([]);
}

//function to check if discount is es empty in whole array
function array_check($arr){
  $errors = [];
  foreach ($arr as $key) {
    if(empty($key['discount_value'])){
      $errors[] = "Discount Empty for Order ID: ".$key['order_id'];
    }
  }
  $arr_size = sizeof(array_column($arr,'discount_value'));
  $error_size = sizeof($errors);
  $result = ($arr_size == $error_size) ? TRUE : FALSE ;
  return $result;
}

//function to get profile
function get_profile($team_id){
  $ci = &get_instance();
  $id = $ci->db->select('id')->get_where('os_employees',['team_id'=>$team_id]);
  $result = ($id->num_rows() > 0) ? json_decode(get_all_employees($id->row('id')),true)[0] : [] ;
  return $result;
}

 function get_all_hr_info_request($id = NULL) {
  $ci = &get_instance();
  $ci->load->model('Employee_model');
  $users = $ci->Employee_model->get_hr_info($id); 
  if($users){
    return json_encode($users);
  }
  return json_encode([]);
}

function get_all_hr_notification(){
  $ci = &get_instance();
  $query = $ci->db->select('id')->get_where('os_hr_request',['status'=>1]);
  $result = ($query->num_rows() > 0) ? $query->num_rows() : NULL;
  return $result;
}

function get_all_personal_notification($employee_id){
  $ci = &get_instance();
  $query = $ci->db->select('id')->get_where('os_hr_request',['assigned_to'=>$employee_id,'status'=>1]);
  $result = ($query->num_rows() > 0) ? $query->num_rows() : NULL;
  return $result;
}

function get_rtv_info($procure_id)
{
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $result = $ci->Inventory_model->rtv_info($procure_id); 
  return $result;
}

function get_rtv_details($procure_id,$assignee_id,$vendor_id)
{
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $result = $ci->Inventory_model->rtv_details($procure_id,$assignee_id,$vendor_id); 
  return $result;
}

function get_all_saleable($id=null){
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $query = $ci->Inventory_model->get_salable($id);   
  $result = $query['status'] ? $query['data'] : [];
  return $result;
}

function get_wastage_items($id=NULL)
{
  $ci = &get_instance();
  $ci->load->model('Inventory_model');
  $result = $ci->Inventory_model->get_wastage($id); 
  return $result;
}

function get_vendor_bill_items($id,$bill_no){
  $ci = &get_instance();
  $query = $ci->db->select('os_vendors_bills_logs.id,bill_id,bill_no,item_id,os_items.item_name,rate,qty,apmc_tax,levi_tax')->join('os_items','os_items.id=os_vendors_bills_logs.item_id')->get_where('os_vendors_bills_logs',['bill_id'=>$id,'bill_no'=>$bill_no]);
  $result=$query->result_array();
  return $result;
}

function invoice_weekly_report(){
  $ci = &get_instance();
  $ci->load->model('Orders_model');
  $query=$ci->db->select('id')->get('os_clients');
 $res=$query->result_array();
    // print_r($res);die;
     $data=[];
    // $res=[1,2,3,4,5,6];
  foreach($res as $id)
  {
     $client_id=$id;
     $data['client_id'][]=(int)$id['id'];    
   
  }
//print_r( $data['client_id']);
  $data['start_date']="2017-01-01";
  $data['end_date']="2017-01-02";
  $res = $ci->Orders_model->invoice_report($data); 
 // print_r( $res);die;
  return $res;
}