<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once APPPATH.'/third_party/mpdf/mpdf.php';
 
class M_pdf {
 
    public $param;
    public $pdf;
 
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
        $this->pdf->SetDisplayMode('fullpage');  
        $this->pdf->setFooter(' {PAGENO}/{nb}');
        $this->pdf->useOnlyCoreFonts = true;
        $this->pdf->shrink_tables_to_fit=1;
        $this->pdf->list_indent_first_level = 0; 
    }
}
