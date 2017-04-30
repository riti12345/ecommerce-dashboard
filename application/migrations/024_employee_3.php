<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Employee_3 extends CI_Migration {

    
    public function up() {
        $this->dbforge->drop_column('os_employees', 'department');
        $fields = [
                   
                    'team_id' => ['type' => 'int','constraint'=>11,'unsigned' => TRUE,'null'=>FALSE,'after' => 'id'],
                    'department' => ['type' => 'int','constraint'=>11,'unsigned' => TRUE,'null'=>FALSE,'after' => 'reporting_manager']
                    
                  ];
        $this->dbforge->add_column('os_employees', $fields);
    }
     public function down(){
        $this->dbforge->drop_column('os_employees', 'department');
        $this->dbforge->drop_column('os_employees', 'team_id');
    }

   }
?>