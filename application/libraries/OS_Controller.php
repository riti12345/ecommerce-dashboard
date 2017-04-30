<?php

defined('BASEPATH') OR exit('No direct script access allowed');

abstract class OS_Controller extends CI_Controller {
    var $user;
    public function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata();
    }
}