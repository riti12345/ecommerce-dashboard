<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Transport_1 extends CI_Migration {
    public function up() {
        $this->dbforge->drop_table('os_transport');
        $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("reg_no varchar(50) NOT NULL");
        $this->dbforge->add_field("owner_name varchar(50) NOT NULL");
        $this->dbforge->add_field("licence_no varchar(50) NOT NULL");
        $this->dbforge->add_field("contact int(11) unsigned NOT NULL");
        $this->dbforge->add_field("vehicle_brand varchar(50) NOT NULL");
        $this->dbforge->add_field("vehicle_model varchar(50) NOT NULL");
        $this->dbforge->add_field("status tinyint(1) unsigned NOT NULL DEFAULT '1'");
        $this->dbforge->add_field("added_by int(11) unsigned NOT NULL");
        $this->dbforge->add_field("added_on datetime NOT NULL");
        $this->dbforge->add_field("updated_by int(11) unsigned NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_transport');
    }

    public function down() {
        $this->dbforge->drop_table('os_transport');
    }
}
?>