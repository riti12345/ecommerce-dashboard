<?php 

   class Pincode_model extends CI_Model
   {
       public function get_address($pincode){    //function to view data from os_pincode_table
      
              $result=$this->db->get_where('os_pincode_table',array('pincode' => $pincode['pincode']));
              $data=$result->result_array();
              if($result->num_rows()){
               return $data; 
              }
              else {
                  return false;
              }
        }
        public function upload_csv_pincode($officename,$pincode,$divisionname,$regionname,$circlename,$Taluk,$Districtname,$statename){   
             
              $import="INSERT into os_pincode_table(officename,pincode,divisionname,regionname,circlename,Taluk,Districtname,statename)
                                                 values('$officename','$pincode','$divisionname','$regionname','$circlename','$Taluk','$Districtname','$statename')";
    
              if($this->db->query($import))
              {
                  return true;
              }
              else
              return false;
       }
   }