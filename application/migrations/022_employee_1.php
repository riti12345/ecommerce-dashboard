<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Employee_1 extends CI_Migration {
    public function up() {
        $fields = [
                    'department' => ['type' => 'VARCHAR','constraint'=>100,'null'=>FALSE,'after' => 'reporting_manager'],
                    'emergency_no' => ['type' => 'VARCHAR','constraint'=>20,'null'=>FALSE,'after' => 'department'],
                    'company_no' => ['type' => 'VARCHAR','constraint'=>20,'null'=>FALSE,'after' => 'emergency_no'],
                    'company_email' => ['type' => 'VARCHAR','constraint'=>100,'null'=>FALSE,'after' => 'company_no'],
                  ];
        $this->dbforge->add_column('os_employees', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_employees', 'department');
        $this->dbforge->drop_column('os_employees', 'emergency_no');
        $this->dbforge->drop_column('os_employees', 'company_no');
        $this->dbforge->drop_column('os_employees', 'company_email');
    }
}
?>