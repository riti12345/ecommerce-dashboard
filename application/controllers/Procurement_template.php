<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Procurement_template extends CI_Controller { 
    public function __construct() { 
        
        parent::__construct();
         $this->load->library('excel');
     


        require_once APPPATH . 'third_party/PHPExcel.php';
        $this->excel = new PHPExcel();

        }
  
        public function download(){
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
         
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/home.php */