<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OS_Loader extends CI_Loader {
    
    public function page_data($template_name, $vars = array(), $return = FALSE) {
        if($return):
        $content = $this->view('templates/header', $vars, $return);
        $content = $this->view($template_name, $vars, $return);
        $content = $this->view('templates/footer', $vars, $return);
        
        return $content;
        else:
            $this->view('templates/header', $vars);
            $this->view($template_name, $vars);
            $this->view('templates/footer', $vars);
        endif;
    }
}