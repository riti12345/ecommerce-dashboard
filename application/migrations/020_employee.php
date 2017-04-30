<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Employee extends CI_Migration {
    public function up() {
        $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("name varchar(50) NOT NULL");
        $this->dbforge->add_field("email varchar(50) NOT NULL");
        $this->dbforge->add_field("phone varchar(20) NOT NULL");
        $this->dbforge->add_field("designation varchar(50) NOT NULL");
        $this->dbforge->add_field("localadd varchar(50) NOT NULL");
        $this->dbforge->add_field("permanentadd varchar(50) NOT NULL");
        $this->dbforge->add_field("doj date NOT NULL");
        $this->dbforge->add_field("dol date NOT NULL");
        $this->dbforge->add_field("company_assets varchar(50) NOT NULL");
        $this->dbforge->add_field("reporting_manager varchar(50) NOT NULL");
        $this->dbforge->add_field("status tinyint(4) NOT NULL DEFAULT '1'");
        $this->dbforge->add_field("added_by int(3) NOT NULL");
        $this->dbforge->add_field("added_on datetime NOT NULL");
        $this->dbforge->add_field("updated_by int(3) NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_employees');
    }

    public function down() {
        $this->dbforge->drop_table('os_employees');
    }
}
?>