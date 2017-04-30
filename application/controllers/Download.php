<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Download extends OS_Controller {

  public function __construct() {
    parent::__construct();
    if ( ! $this->session->userdata('logged_in'))  redirect(base_url());
  } 
  
  public function download_csv($what = '') {
    $client_id=$this->input->get('id');
    $abc = 'grl_client_rate?id='.$client_id;
    $download = ['grl_template','crl_template','vrl_template','procurement_template','vendor_list'];
    if(in_array($what, $download)) {
      switch ($what) {
        case 'grl_template':
            $columns = 'id, item_name, "" AS price';
            $table = 'os_items';
            download_csv_from_database($columns, $table, $what);
            break;
        case 'crl_template':
            $columns = 'id, item_name, "" AS price,"" AS period';
            $table = 'os_items';
            download_csv_from_database($columns, $table, $what);
            break;
        case 'vrl_template':
            $columns = 'id, item_name, "" AS price,"" AS period';
            $table = 'os_items';
            download_csv_from_database($columns, $table, $what);
            break;
        case 'procurement_template':
            $columns = 'id, item_name, "" AS units,"" AS target_price,"" AS vendor_name,"=IFERROR(VLOOKUP(E2,procurement_template'.date("Ymd").'!I:J,2,0),"")" AS vendor_id';
            $table = 'os_items';
            download_csv_from_database($columns, $table, $what);
            break;
        case 'vendor_list':
            $columns = 'id, name AS vendor_name';
            $table = 'os_vendors';
            download_csv_from_database($columns, $table, $what);
            break;            
        default:
            break;
      }
    }
  }
}