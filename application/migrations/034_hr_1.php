<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hr_1 extends CI_Migration {
      public function up() {
        $fields = [
                    'assigned_to' => ['type' => 'INT','constraint'=>11,'unsigned' => TRUE,'null'=>FALSE,'after' => 'employee_id']
                  ];
        $this->dbforge->add_column('os_hr_request', $fields);
    }

      public function down(){
        $this->dbforge->drop_column('os_hr_request', 'assigned_to');
    }
}
