<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends OS_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function add() { 
        $data=$this->input->post();
        $errors = [];
        if(!isset($data['name']) || empty($data['name'])) {
            $errors[] = 'Please provide name';
        } 
        
        if(!isset($data['email']) || empty($data['email'])) {
            $errors[] = 'Please provide email';
        }
        
        if(!isset($data['message']) || empty($data['message'])) {
            $errors[] = 'Please provide message';
        }
        
        if(empty($errors)) {
            $result = $this->admin_model->contact_form($data);
            if($result) {
                $this->output->set_status_header(200);
                $response = array(
                    'status' => $result,
                    'data' => 'Thank you, will get back ASAP...!'
                );
                echo json_encode($response);
            }else {
                $this->output->set_status_header(400);
                $response = array(
                'status' => FALSE,
                'error' => $errors
                );
                echo json_encode($response);
            }
        }
    }
}
