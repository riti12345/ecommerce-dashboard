<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Export extends OS_Controller {

    public function __construct() {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))  redirect(base_url());
        // Load the Library
        $this->load->library("excel");
        // Load the Model
        //$this->load->model("Your_model_name");
    }

    public function index() {
        $this->excel->setActiveSheetIndex(0);
        // Gets all the data using MY_Model.php
        $data = json_decode(get_general_rates());

        $this->excel->stream('name_of_file.xls', $data);
    }

}