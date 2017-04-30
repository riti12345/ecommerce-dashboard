<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migrate extends OS_Controller {
    
    public function __construct() {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))  redirect(base_url());
    }

    public function index() {
        // load migration library
        $this->load->library('migration');

        if ( ! $this->migration->current()) {
            echo 'Error: ' . $this->migration->error_string();
        } else {
            echo 'Migrations ran successfully!';
        }   
    }    
}