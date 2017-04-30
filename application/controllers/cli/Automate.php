<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Automate extends OS_Controller {

  public function __construct() {
    parent::__construct();
    if(!is_cli()) exit('This script can only be accessed via the command line');
    // Load the excel Library
    $this->load->library("excel");
  } 
  
  public function total_order() {
    $dt = date("Y-m-d");
    $attach = [];
    $from = 'noreply@ordersquare.com';
    $from_name =  'Procurement';
    $to = 'aditya@ordersquare.com, dhaval@ordersquare.com, riti.verma@ordersquare.com, ahmad.nazeeb@ordersquare.com, mudassir.ansari@ordersquare.com';
    $subject = 'procurement items | '.$dt;

    $order_items_for_retailers = items_to_procure_for_retailers();
    $order_items_for_hospitality = items_to_procure_for_hospitality();

    if(isset($order_items_for_retailers) && !empty($order_items_for_retailers)) {
        $this->excel->stream('order_items_for_retailers'.$dt.'.xls', $order_items_for_retailers);
        $attach[] = 'exported/order_items_for_retailers'.$dt.'.xls';
    }

    if(isset($order_items_for_hospitality) && !empty($order_items_for_hospitality)) {
        $this->excel->stream('order_items_for_hospitality'.$dt.'.xls', $order_items_for_hospitality);
        $attach[] = 'exported/order_items_for_hospitality'.$dt.'.xls';
    }

    $data = 'PFA, of total order items.';

    send_mail($from,$from_name, $to, $subject, $data, $attach);
  }

  public function check_clients_todays_order() {
    $dt = date("Y-m-d");
    $attach = [];
    $from = 'noreply@ordersquare.com';
    $from_name =  'client checklist for orders';
    $to = 'aditya@ordersquare.com,dhaval@ordersquare.com,riti.verma@ordersquare.com,ahmad.nazeeb@ordersquare.com,prathamesh.patil@ordersquare.com,suraj.prajapati@ordersquare.com';
    $subject = 'client orders | '.$dt;

    $orders = client_orders_check();
  
    if(isset($orders) && !empty($orders)) {
        $this->excel->stream('clients'.$dt.'.xls', $orders);
        $attach[] = 'exported/clients'.$dt.'.xls';
    }

    $data = 'PFA, of today clients orders status.';

    send_mail($from,$from_name, $to, $subject, $data, $attach);
  } 

   public function check_clients_todays_generated_invoice() {
    $dt = date("Y-m-d");
    $attach = [];
    $from = 'noreply@ordersquare.com';
    $from_name =  'client checklist for invoice';
    $to = 'aditya@ordersquare.com,dhaval@ordersquare.com,riti.verma@ordersquare.com,ahmad.nazeeb@ordersquare.com,prathamesh.patil@ordersquare.com,suraj.prajapati@ordersquare.com';
    $subject = 'client orders | '.$dt;

    $orders = client_orders_check_invoice();
    
    if(isset($orders) && !empty($orders)) {
        $this->excel->stream('clients'.$dt.'.xls', $orders);
        $attach[] = 'exported/clients'.$dt.'.xls';
         }

    $data = 'PFA, of today not generated order invoice.';

    send_mail($from,$from_name, $to, $subject, $data, $attach);
  }
}