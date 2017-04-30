<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Inventory_saleable_log extends CI_Migration {
    public function up() {
        $this->dbforge->add_field("id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("table_name varchar(200) NOT NULL");
        $this->dbforge->add_field("table_id int(11) unsigned NOT NULL");
        $this->dbforge->add_field("updated_column varchar(50) NOT NULL");
        $this->dbforge->add_field("last_value varchar(100) NOT NULL");
        $this->dbforge->add_field("updated_value varchar(100) NOT NULL");
        $this->dbforge->add_field("updated_by int(11) NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_inventory_saleable_log');
    }

    public function down() {
        $this->dbforge->drop_table('os_inventory_saleable_log');
    }
}
?>