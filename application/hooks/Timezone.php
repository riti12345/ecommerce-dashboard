<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timezone {

    public function set_timezone()
    {
        $ci = & get_instance();
        //$ci->load->model('Organization');

        //$orgID = $CI->Organization->GetOrgIDFromSubdomain();

        //   $query = $CI->db->query("
        //      SELECT `Timezone`
        //      FROM `organizations`
        //      WHERE `OrganizationID` = '$orgID'
        //   ");

        // $row = $query->row();

        // Where TimeZone is something like America/Vancouver
        $timezone = 'Asia/Kolkata';//$row->Timezone;

        $ci->db->query("SET time_zone='".$timezone."'");

        date_default_timezone_set($timezone);
    }
}

}