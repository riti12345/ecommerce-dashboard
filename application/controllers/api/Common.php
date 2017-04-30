<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 */
class Common extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['createpdf_post']['limit'] = 100; // 100 requests per hour per user/key
    }

    
    public function createpdf_post()
    {
       $data1=$this->input->post();
       foreach($data1 as $key=>$value)
       {
           $var=$key;
          
       $count=count($data1[$var]);
      
       for($i=0;$i<$count;$i++)
       {
           $data[$i][$var]=$data1[$var][$i];
       }
       }
      
        //load the view and saved it into $html variable
        $html=$this->load->view('dashboard', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");  
    }

}
