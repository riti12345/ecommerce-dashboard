<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Employee_2 extends CI_Migration {

    
    public function up() {
        $this->dbforge->drop_column('os_employees', 'emergency_no');
        $fields = [
                   
                    'emergency_no' => ['type' => 'VARCHAR','constraint'=>50,'null'=>FALSE,'after' => 'department']
                    
                  ];
        $this->dbforge->add_column('os_employees', $fields);
    }
     public function down(){
        
        $this->dbforge->drop_column('os_employees', 'emergency_no');
      
    }

   }
?>