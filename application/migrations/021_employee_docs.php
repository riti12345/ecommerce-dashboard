<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Employee_docs extends CI_Migration {
    public function up() {
        $this->dbforge->add_field("id tinyint(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("employee_id int(11) NOT NULL");
        $this->dbforge->add_field("doc_url varchar(250) DEFAULT NULL");
        $this->dbforge->add_field("status tinyint(1) NOT NULL DEFAULT '1'");
        $this->dbforge->add_field("type tinyint(1) DEFAULT NULL");
        $this->dbforge->add_field("added_by int(11) NOT NULL");
        $this->dbforge->add_field("added_on datetime NOT NULL");
        $this->dbforge->add_field("updated_by int(11) NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
		
        $this->dbforge->create_table('os_employees_docs');
    }

    public function down() {
        $this->dbforge->drop_table('os_employees_docs');
    }
}
?>