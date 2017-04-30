<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Auth extends OS_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('admin_model');
  } 
  
  public function index() {
    ( ! $this->session->userdata('logged_in')) ? $this->load->page_data('login') : redirect('dashboard');
    // $this->output->set_status_header(401);
    // $response = array(
    //   'status' => FALSE,
    //   'error' => ['Unauthorized']
    // );
    // echo json_encode($response);
  }
  
  public function login() {
    if(isset($this->session->userdata['logged_in'])) {
      $user = get_session_data();
      $this->output->set_status_header(200);
      $response = array(
        'status' => TRUE,
        'data' => array(
          'user' => $user['user']
          )
      );
      echo json_encode($response);
    } else {
      $data = array(
        'email' => $this->input->post('email'),
        'password' => $this->input->post('pass')
      );
      $errors = array();
      if(!isset($data['email'])) {
        $errors[] = "Please provide your email";
      }
      
      if(!isset($data['password'])) {
        $errors[] = "Please provide your password";
      } else {
        $data['password'] = md5($data['password']);
      }
  
      if(empty($errors)) {
        $result = $this->admin_model->login($data);
        if($result['status']) {
          $api_key = NULL;//get_api_key_for_user_id($result['id']);
          $this->session->set_userdata('logged_in', $result['status']);
          $this->session->set_userdata('X-API-KEY', $api_key);
          $user_data = array(
            'id' => $result['id'],
            'name' => $result['username'],
            'email' => $data['email'],
            'mobile' => $result['mobile'],
            'designation' => $result['designation'],
            'permissions' => $result['permissions'],
            'X-API-KEY' => $api_key
          );
          $this->session->set_userdata('user', $user_data);
          $this->output->set_status_header(200);
          $response = array(
            'status' => $result['status'],
            'data' => array(
              'user' => $user_data
              )
          );
          echo json_encode($response);
        } else {
          $this->output->set_status_header(401);
          $response = array(
            'status' => FALSE,
            'error' => ['Unauthorized']
          );
          echo json_encode($response);
        }
      } else {
        $this->output->set_status_header(400);
        $response = array(
          'status' => FALSE,
          'error' => $errors
        );
        echo json_encode($response);
      }
    }
  }
  
  public function logout() {
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('user');
    $this->session->set_userdata('logged_out', 'successfully logged out');
    
    $this->load->library('user_agent');
    if ($this->agent->is_browser()) {
      redirect(base_url());
    }else {
      $this->output->set_status_header(200);
      $response = array(
        'status' => TRUE,
        'data' => ['successfully logged out']
      );
      echo json_encode($response);
    }
  }
}
