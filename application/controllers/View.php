<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class View extends OS_Controller {

  public function __construct() {
    parent::__construct();
    if ( ! $this->user['logged_in'])  redirect(base_url());
  } 
  
  public function index() {
    $this->show();
  }
  
  public function show($load = 'dashboard') {
    $view_access = [];
    $permission = $this->user['user']['permissions'];
    switch ($permission) {
      case 0:
        $this->load->page_data($load);
        break;
      case 2:
        $view_access = ['dashboard','profile','addRequest','generalRateList', 'items','addItem','itemsInfo','clients','addClient','clientRatelist','clientInfo', 'vendors','vendorsInfo','vendorHistory','vendorHistoryInfo','addVendor','vendorRatelist', 'order','addOrder','orderInfo', 'dispatch','dispatchSummary','dispatchInfo','delivery_boy','deliveryBoyHistory', 'jit','jitInfo', 'inward','inwardInfo','inwardCrates','leftOvers','salable','raw','returnInward','returnInwardCrate','returnInwardInfo','procurement','procureInfo','ProcTrackDetails','vehicleInfo','vehicleUpdates','trackVehicle','trackVehicleHistory','vendorBills' ];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
      case 3:
        $view_access = ['dashboard','profile','addRequest','generalRateList', 'items','addItem','itemsInfo','clients','addClient','clientRatelist','clientInfo', 'vendors','vendorsInfo','vendorHistory','vendorHistoryInfo','addVendor','vendorRatelist', 'order','orderInfo', 'dispatch','dispatchSummary','dispatchInfo','delivery_boy','deliveryBoyHistory', 'jit','jitInfo', 'inward','inwardInfo','inwardCrates','leftOvers','salable','raw','returnInward','returnInwardCrate','returnInwardInfo','procurement','procureInfo','ProcTrackDetails','vehicleInfo','vehicleUpdates','trackVehicle','trackVehicleHistory','vendorBills'];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
      case 4:
        $view_access = ['dashboard','profile','addRequest', 'jit', 'addJit','vendors','vendorsInfo','vendorBills','vendorHistory','vendorHistoryInfo','vendorRatelist','inward','inwardInfo','inwardCrates','leftOvers','salable','raw','returnInward','returnInwardCrate','returnInwardInfo','procurement','procureInfo','procTrackDetails','procTrackVendorDetails','rtvInfo','rtvDetails','rtv'];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
      case 5:
        $view_access = ['dashboard','profile','addRequest','dispatch', 'dispatchInfo'];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
      case 6:
        $view_access = ['dashboard','profile','addRequest','dispatch','dispatchInfo','inward','inwardInfo','inwardCrates','leftOvers','salable','raw','returnInward','returnInwardCrate','returnInwardInfo','procurement','procureInfo','ProcTrackDetails','processing','processingInfo','processingIssues','processingStart','line_Manager','lineManagerHistory'];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
       case 7:
        $view_access = ['dashboard','profile','addRequest','items','itemsInfo','clients','clientRatelist','clientInfo', 'vendors', 'vendorsInfo','vendorHistory','vendorHistoryInfo','vendorRatelist','order','orderInfo', 'generalRateList','dispatch','dispatchSummary','dispatchInfo','employees','employeeInfo','employeeReqInfo','employeeRequest','addEmployee','os_assets','addAssets','allocateAssets','assets_category','assetsSubCategory','assetsSubCategoryInfo'];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
      case 8:
        $view_access = ['dashboard','profile','addRequest', 'items', 'clients','clientRatelist','clientInfo', 'vendors', 'order','orderInfo', 'generalRateList','addClient','dispatch','dispatchSummary','dispatchInfo'];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
      case 9:
        $view_access = ['dashboard','profile','addRequest', 'jit', 'addJit','inward','inwardInfo','inwardCrates','leftOvers','salable','raw','returnInward','returnInwardCrate','returnInwardInfo','procurement','procureInfo','ProcTrackDetails','dispatch','dispatchSummary','dispatchInfo'];
        if(in_array($load, $view_access)) {
          $this->load->page_data($load);
        }else {
          $this->load->page_data('gateway');
        }
        break;
    }
  }
  
  public function download($what = '') {
    $download = ['itemlist'];
    if(in_array($what, $download)) {
      switch ($what) {
        case 'itemlist':
            $columns = 'id, item_name';
            $table = 'os_items';
            download_csv_from_database($columns, $table);
            //echo download_csv_from_database($columns, $table);
            break;
        default:
            break;
      }
    }
  }
  
  public function invoice() { // echo print_array($data);die;	
    $data = $this->input->post();
    $data['order'] = print_client_invoice($data['id']);
    $data['order']['order_id'] = 	$data['id'];
    $this->load->view('templates/invoice',$data);
  }

  public function invoice_bulk() { // echo print_array($data);die; 
    $data = $this->input->post();
    $filter = [];
    if((isset($data['client_id']) && ctype_digit($data['client_id'])) || $data['client_id'] > 0) {
        $filter['os_orders.client_id'] = $data['client_id'];
    }
    $ci = &get_instance();
    // print_r($data);die;
    $ci->db->select('os_orders.id')->order_by('delivery_date','ASC')->order_by('os_orders.id','ASC');
    $ci->db->where(['delivery_date >='=>$data['start_date'],'delivery_date <='=>$data['end_date'],'os_orders.status >= '=>4]);
    $ci->db->where($filter);
    $query = $ci->db->order_by('delivery_date','DESC')->get('os_orders')->result_array();
    $ids = array_column($query,'id');

    foreach ($ids as $key => $value) {
      $data['order'] = print_client_invoice($value);
      $data['order']['order_id'] =  $value;
      $this->load->view('templates/invoice',$data);
    }
  }

  public function dm() { // echo print_array($data);die;	
    $data = $this->input->post();
    $data['order'] = print_client_dm($data['id'],$data['order_id']);
    $data['order']['track_id'] = 	$data['id'];
    $this->load->view('templates/dm',$data);
  }

  public function dm_bulk() { // echo print_array($data);die;  
    $data = $this->input->post();
    $filter = [];
    if((isset($data['client_id']) && ctype_digit($data['client_id'])) || $data['client_id'] > 0) {
        $filter['os_orders.client_id'] = $data['client_id'];
    }
    $ci = &get_instance();
    
    $ci->db->select('os_orders_track.id,os_orders_track.orders_id')->from('os_orders_track');
    $ci->db->where(['os_orders.delivery_date >='=>$data['start_date'],'os_orders.delivery_date <='=>$data['end_date']]);
    $ci->db->where('os_orders_track.status >= 1 AND os_orders_track.status <= 3');
    $ci->db->where($filter);
    $ci->db->join('os_orders','os_orders.id = os_orders_track.orders_id');
    $query = $ci->db->order_by('os_orders.delivery_date','DESC')->get()->result_array();
    // print_r($ci->db->last_query());die;
    $ids = array_column($query,'id');
    // print_r($ids);die;
    foreach ($query as $key => $value) {
      $data['order'] = print_client_dm($value['id'],$value['orders_id']);
      $data['order']['track_id'] =  $value;
      $this->load->view('templates/dm',$data);
    }
  }

  public function dr() { 
    $data = $this->input->post();
    //echo print_array($data);die; 
    $data['order'] = print_dispatch_report($data['id']);
    $data['track_id'] =  $data['id'];
    $this->load->view('templates/dispatchReport',$data);
  }

  public function purchase_orders() { 
    $data = $this->input->post();
    //echo print_array($data);die; 
    $data['data'] = print_purchase_orders($data['assignee_id'],$data['procure_id'],$data['vendor_id']);
    $this->load->view('templates/purchaseOrder',$data);
  }  

 

function p_download(){
    $this->load->library('excel');
    require_once APPPATH . 'third_party/PHPExcel.php';
    $this->excel = new PHPExcel();

    //----------------Master List SHEET(2)-----------------------------------------------
     $objWorksheet = new PHPExcel_Worksheet($this->excel);
     $this->excel->addSheet($objWorksheet);
     $objWorksheet->setTitle('master_list');
  
     $this->excel->setActiveSheetIndex(1);
     $this->excel->getActiveSheet()->setCellValue('A1', 'vendor_name');
     $this->excel->getActiveSheet()->setCellValue('B1', 'vendor_id');
     $rs = $this->db->select('name,id')->from('os_vendors')->get();
     $vendors = implode(',',array_column($rs->result_array(),'name'));
     $exceldata="";
     foreach ($rs->result_array() as $row){
         $exceldata[] = $row;
     }
     //Fill data 
     $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
     // Define named ranges
     // $this->excel->addNamedRange( new PHPExcel_NamedRange('vendors', $this->excel->getActiveSheet(), '$I$2:$J$15') );
     //-----------------X-----------END Master List SHEET---------------X--------------------

    //----------------MAIN SHEET(1)----------------------------------------------------------
    $this->excel->setActiveSheetIndex(0);
    //name the worksheet
    $this->excel->getActiveSheet()->setTitle('proc_template');
   
    $this->excel->getActiveSheet()->setCellValue('A1', 'item_name');
    $this->excel->getActiveSheet()->setCellValue('B1', 'item_id');
    $this->excel->getActiveSheet()->setCellValue('C1', 'units');
    $this->excel->getActiveSheet()->setCellValue('D1', 'target_price');
    $this->excel->getActiveSheet()->setCellValue('E1', 'vendor_name');
    $this->excel->getActiveSheet()->setCellValue('F1', 'vendor_id');

    //retrive os_items table data
    $rs = $this->db->select('item_name,id')->from('os_items')->get();
    $exceldata="";
    foreach ($rs->result_array() as $row){
      $exceldataa[] = $row;
    }
    $this->excel->getActiveSheet()->fromArray($exceldataa, null, 'A2'); 
                            
    $this->excel->getActiveSheet()->setCellValue('F2',"IFERROR(VLOOKUP(E2,'master_list'!A:B,2,0),0)");
                                                         
    $this->excel->getActiveSheet()->setCellValue('E2','Select Vendor');
    $objValidation = $this->excel->getActiveSheet()->getCell('E2')->getDataValidation();
    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
    $objValidation->setAllowBlank(false);
    $objValidation->setShowInputMessage(true);
    $objValidation->setShowErrorMessage(true);
    $objValidation->setShowDropDown(true);
    $objValidation->setErrorTitle('Input error');
    $objValidation->setError('Value is not in list.');
    // $objValidation->setPromptTitle('Pick from list');
    // $objValidation->setPrompt('Please pick a value from the drop-down list.');
    $objValidation->setFormula1('"'.$vendors.'"');
    $this->excel->getActiveSheet()->getCell('E2')->setDataValidation($objValidation);
    
    $filename='procurement_'.date('d.m.Y').'.xlsx'; //save our workbook as this file name
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache
                   
    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');

  }//End Excel function

  

  public function purchase_jit_orders() { 
    $data = $this->input->post();
    //echo print_array($data);die; 
    $data['data'] = print_purchase_jit_orders($data['assignee_id'],$data['procure_id']);
    $this->load->view('templates/purchaseJit',$data);
  }  
  
  public function print_rtv()
  {
    $data =$this->input->post();
    {
      $data['data'] =get_rtv_details($data['procure_id'],$data['assignee_id'],$data['vendor_id']);
      $this->load->view('templates/rtv',$data);
    }
  }

}